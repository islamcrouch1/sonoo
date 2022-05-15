<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Order;
use App\Models\VendorOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator');
        $this->middleware('permission:orders-read')->only('index', 'show');
        $this->middleware('permission:orders-create')->only('create', 'store');
        $this->middleware('permission:orders-update')->only('edit', 'update');
        $this->middleware('permission:orders-delete|orders-trash')->only('destroy', 'trashed');
        $this->middleware('permission:orders-restore')->only('restore');
    }

    public function index(Request $request)
    {
        $countries = Country::all();
        if (!$request->has('from') || !$request->has('to')) {
            $request->merge(['from' => Carbon::now()->subDay(365)->toDateString()]);
            $request->merge(['to' => Carbon::now()->toDateString()]);
        }

        $orders = Order::whereDate('created_at', '>=', request()->from)
            ->whereDate('created_at', '<=', request()->to)
            ->whenSearch(request()->search)
            ->whenCountry(request()->country_id)
            ->whenStatus(request()->status)
            ->whenPaymentStatus(request()->payment_status)
            ->latest()
            ->paginate(100);

        return view('dashboard.orders.index')->with('orders', $orders)->with('countries', $countries);
    }


    public function show(Order $order)
    {
        return view('dashboard.orders.show')->with('order', $order);
    }


    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => "required|string",
        ]);

        if (!checkOrderStatus($request->status, $order->status)) {
            alertError('The status of the order cannot be changed', 'لا يمكن تغيير حالة الطلب');
            return redirect()->route('orders.index');
        }

        $order->update([
            'status' => $request->status,
        ]);

        $description_ar = "تم تغيير حالة الطلب الى " . getArabicStatus($order->status) . ' طلب رقم ' . ' #' . $order->id;
        $description_en  = "order status has been changed to " . $order->status . ' order No ' . ' #' . $order->id;

        addLog('admin', 'orders', $description_ar, $description_en);

        $title_ar = 'اشعار من الإدارة';
        $body_ar = "تم تغيير حالة الطلب الخاص بك الى " . getArabicStatus($order->status);
        $title_en = 'Notification From Admin';
        $body_en  = "Your order status has been changed to " . $order->status;
        $url = route('orders.affiliate.index');

        addNoty($order->user, Auth::user(), $url, $title_en, $title_ar, $body_en, $body_ar);

        if ($request->status == 'canceled' || $request->status == 'RTO') {

            foreach ($order->vendor_orders as $vendor_order) {
                changeOutStandingBalance($vendor_order->user, $vendor_order->total_price, $vendor_order->id, $request->status, 'sub');
            }

            foreach ($order->products as $product) {
                if ($product->pivot->product_type == '0') {
                    $product->stocks->find($product->pivot->stock_id)->update([
                        'stock' => $product->stocks->find($product->pivot->stock_id)->quantity + $product->pivot->quantity
                    ]);
                }
                // else {
                //     $product->astocks->find($product->pivot->stock_id)->update([
                //         'stock' => $product->astocks->find($product->pivot->stock_id)->stock + $product->pivot->stock
                //     ]);
                // }
            }

            // $mystock_price = 0;

            // foreach ($order->products as $product) {
            //     if ($product->pivot->product_type != '0') {
            //         $mystock_price += ($product->min_price * $product->pivot->stock);
            //     }
            // }
            changeOutStandingBalance($order->user, $order->total_commission, $order->id, $order->status, 'sub');
        }


        if ($request->status == 'returned') {
            foreach ($order->vendor_orders as $vendor_order) {
                if ($vendor_order->status == 'Waiting for the order amount to be released') {
                    changeOutStandingBalance($vendor_order->user, $vendor_order->total_price, $vendor_order->id, $request->status, 'sub');
                } else {
                    changeAvailableBalance($vendor_order->user, $vendor_order->total_price, $vendor_order->id, $request->status, 'sub');
                }
            }

            foreach ($order->products as $product) {
                if ($product->pivot->product_type == '0') {
                    $product->stocks->find($product->pivot->stock_id)->update([
                        'stock' => $product->stocks->find($product->pivot->stock_id)->quantity + $product->pivot->quantity
                    ]);
                }
                // else {
                //     $product->astocks->find($product->pivot->stock_id)->update([
                //         'stock' => $product->astocks->find($product->pivot->stock_id)->stock + $product->pivot->stock
                //     ]);
                // }
            }

            // $mystock_price = 0;

            // foreach ($order->products as $product) {
            //     if ($product->pivot->product_type != '0') {
            //         $mystock_price += ($product->min_price * $product->pivot->stock);
            //     }
            // }

            changeAvailableBalance($order->user, $order->total_commission, $order->id, $order->status, 'sub');
        }


        if ($request->status == 'delivered') {


            // $mystock_price = 0;

            // foreach ($order->products as $product) {
            //     if ($product->pivot->product_type != '0') {
            //         $mystock_price += ($product->min_price * $product->pivot->stock);
            //     }
            // }

            changeOutStandingBalance($order->user, $order->total_commission, $order->id, $order->status, 'sub');
            changeAvailableBalance($order->user, $order->total_commission, $order->id, $order->status, 'add');
        }


        foreach ($order->vendor_orders as $vendor_order) {

            $vendor_order->update([
                'status' => $request->status == 'delivered' ? 'Waiting for the order amount to be released' : $request->status,
            ]);

            $title_ar = 'اشعار من الإدارة';
            $body_ar = "تم تغيير حالة الطلب الخاص بك الى " . getArabicStatus($vendor_order->status);
            $title_en = 'Notification From Admin';
            $body_en  = "Your order status has been changed to " . $vendor_order->status;
            $url = route('orders.vendor.index');
            addNoty($vendor_order->user, Auth::user(), $url, $title_en, $title_ar, $body_en, $body_ar);
        }


        alertSuccess('request updated successfully', 'تم تحديث حالة الطلب بنجاح');
        return redirect()->route('orders.index');
    }

    public function rejectRefund(Request $request, Order $order)
    {
        $request->validate([
            'reason' => "required|string",
        ]);
        $refund = $order->refund;
        $refund->update([
            'status' => 1,
            'refuse_reason' => $request->reason
        ]);
        $title_ar = 'اشعار من الإدارة';
        $body_ar = "تم رفض طلب المرتجع الخاص بطلبك رقم " . $order->id . ' سبب الرفض : ' . $request->reason;
        $title_en = 'Notification From Admin';
        $body_en  = "Your return request has been rejected for order ID: "  . $order->id . ' the reason of refuse : ' . $request->reason;
        $url = route('orders.affiliate.index');
        addNoty($order->user, Auth::user(), $url, $title_en, $title_ar, $body_en, $body_ar);

        alertSuccess('The refund request was successfully rejected', 'تم رفض طلب المرتجع بنجاح');
        return redirect()->route('orders.index');
    }

    public function refundsIndex(Request $request)
    {

        $countries = Country::all();
        if (!$request->has('from') || !$request->has('to')) {
            $request->merge(['from' => Carbon::now()->subDay(365)->toDateString()]);
            $request->merge(['to' => Carbon::now()->toDateString()]);
        }

        $orders = Order::has('refund')
            ->whereDate('created_at', '>=', request()->from)
            ->whereDate('created_at', '<=', request()->to)
            // ->where('status', '!=', 'returned')
            ->whenSearch(request()->search)
            ->whenCountry(request()->country_id)
            ->whenStatus(request()->status)
            ->latest()
            ->paginate(100);

        return view('dashboard.orders.index')->with('orders', $orders)->with('countries', $countries);
    }



    public function mandatoryIndex(Request $request)
    {
        $countries = Country::all();
        if (!$request->has('from') || !$request->has('to')) {

            $request->merge(['from' => Carbon::now()->subDay(365)->toDateString()]);
            $request->merge(['to' => Carbon::now()->toDateString()]);
        }
        $orders = Order::where('status', 'in the mandatory period')
            ->where('updated_at', '<', now()->subMinutes(setting('mandatory_affiliate')))
            ->whereDate('created_at', '>=', request()->from)
            ->whereDate('created_at', '<=', request()->to)
            ->whenSearch(request()->search)
            ->whenCountry(request()->country_id)
            ->whenStatus(request()->status)
            ->latest()
            ->paginate(100);

        return view('dashboard.orders.index')->with('orders', $orders)->with('countries', $countries);
    }




    public function indexVendors(Request $request)
    {
        $countries = Country::all();
        if (!$request->has('from') || !$request->has('to')) {

            $request->merge(['from' => Carbon::now()->subDay(365)->toDateString()]);
            $request->merge(['to' => Carbon::now()->toDateString()]);
        }
        $orders = VendorOrder::whereDate('created_at', '>=', request()->from)
            ->whereDate('created_at', '<=', request()->to)
            ->whenSearch(request()->search)
            ->whenCountry(request()->country_id)
            ->whenStatus(request()->status)
            ->latest()
            ->paginate(100);

        return view('dashboard.orders.vendor-orders')->with('orders', $orders)->with('countries', $countries);
    }

    public function mandatoryIndexVendor(Request $request)
    {
        $countries = Country::all();
        if (!$request->has('from') || !$request->has('to')) {

            $request->merge(['from' => Carbon::now()->subDay(365)->toDateString()]);
            $request->merge(['to' => Carbon::now()->toDateString()]);
        }
        $orders = VendorOrder::where('status', 'Waiting for the order amount to be released')
            ->where('updated_at', '<', now()->subMinutes(setting('mandatory_vendor')))
            ->whereDate('created_at', '>=', request()->from)
            ->whereDate('created_at', '<=', request()->to)
            ->whenSearch(request()->search)
            ->whenCountry(request()->country_id)
            ->whenStatus(request()->status)
            ->latest()
            ->paginate(100);
        return view('dashboard.orders.vendor-orders')->with('orders', $orders)->with('countries', $countries);
    }

    public function updateStatusVendor(Request $request, VendorOrder $vendor_order)
    {
        $request->validate([
            'status' => "required|string|max:255",
        ]);

        if ($request->status == 'delivered') {
            $vendor_order->update([
                'status' => $request->status,
            ]);

            $title_ar = 'اشعار من الإدارة';
            $body_ar = "تم تغيير حالة الطلب الخاص بك الى " . getArabicStatus($vendor_order->status);
            $title_en = 'Notification From Admin';
            $body_en  = "Your order status has been changed to " . $vendor_order->status;
            $url = route('orders.vendor.index');

            addNoty($vendor_order->user, Auth::user(), $url, $title_en, $title_ar, $body_en, $body_ar);

            changeOutStandingBalance($vendor_order->user, $vendor_order->total_price, $vendor_order->id, $vendor_order->status, 'sub');
            changeAvailableBalance($vendor_order->user, $vendor_order->total_price, $vendor_order->id, $vendor_order->status, 'add');

            alertSuccess('Order status updated successfully', 'تم تحديث حالة الطلب بنجاح');
            return redirect()->route('orders-vendor');
        } else {
            alertSuccess('Order status cannot be updated', 'لا يمكن تحديث حالة الطلب');
            return redirect()->route('orders-vendor');
        }
    }
}
