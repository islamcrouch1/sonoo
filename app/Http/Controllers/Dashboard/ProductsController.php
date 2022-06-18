<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadministrator|administrator|affiliate|vendor');
        $this->middleware('permission:products-read')->only('index', 'show');
        $this->middleware('permission:products-create')->only('create', 'store');
        $this->middleware('permission:products-update|products-trash')->only('edit', 'update');
        $this->middleware('permission:products-delete|products-trash')->only('destroy', 'trashed');
        $this->middleware('permission:products-restore')->only('restore');
    }



    public function index()
    {
        $categories = Category::whereNull('parent_id')->get();
        $countries = Country::all();

        $products = Product::whenSearch(request()->search)
            ->whenCategory(request()->category_id)
            ->whenCountry(request()->country_id)
            ->whenStatus(request()->status)
            ->latest()
            ->paginate(100);

        return view('Dashboard.products.index')->with('products', $products)->with('categories', $categories)->with('countries', $countries);
    }

    public function show(Product $product)
    {
        $scountry = Country::findOrFail(Auth()->user()->country_id);

        $categories = Category::with('products')
            ->where('country_id', $scountry->id)
            ->where('parent', $product->categories()->first()->id)
            ->get();

        return view('Dashboard.products.show', compact('categories', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        $countries = Country::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('Dashboard.products.create', compact('colors', 'categories', 'countries', 'sizes'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => "required|string",
            'name_en' => "required|string",
            'sku' => "required|string|unique:products",
            'images' => "required|array",
            'description_ar' => "required|string",
            'description_en' => "required|string",
            'vendor_price' => "required|string",
            'categories' => "required|array",
            'status' => "required|string",
            'colors'  => "array|required",
            'sizes'  => "array|required",
            'extra_fee'  => "required|numeric",
            'vendor_id' => "required|string",
        ]);

        if (!checkVendor($request->vendor_id)) {
            alertError('The vendor ID entered is incorrect', 'رقم التاجر المدخل غير صحيح');
            return redirect()->route('products.index');
        }

        $product = Product::create([
            'vendor_id' => $request['vendor_id'],
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
            'sku' => $request['sku'],
            'description_ar' => $request['description_ar'],
            'description_en' => $request['description_en'],
            'vendor_price' => $request['vendor_price'],
            'extra_fee' => $request['extra_fee'],
            'country_id' => 1,
            'status' => $request['status'],
            'admin_id' => Auth::id(),
        ]);

        $product->categories()->attach($request['categories']);

        CalculateProductPrice($product);

        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                Image::make($file)->save(public_path('storage/images/products/' . $file->hashName()), 80);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->hashName(),
                ]);
            }
        }

        foreach ($request->colors as $color) {
            foreach ($request->sizes as $size) {
                $stock = Stock::create([
                    'color_id' => $color,
                    'size_id' => $size,
                    'product_id' => $product->id,
                    'quantity' => 0,
                ]);
            }
        }

        if ($request['limited'] == 'on') {
            $product->update([
                'unlimited' => 1,
            ]);
        }


        $description_ar = ' تم إضافة منتج ' . '  منتج رقم' . ' #' . $product->id . ' - SKU ' . $product->sku;
        $description_en  = "product added " . " product ID " . ' #' . $product->id . ' - SKU ' . $product->sku;
        addLog('admin', 'products', $description_ar, $description_en);

        alertSuccess('Product Created successfully, Please enter stock according to colors and sizes', 'تم إنشاء المنتج بنجاح, يرجى ادخال المخزون على حسب الألوان والمقاسات');
        return redirect()->route('products.stock.create', ['product' => $product->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $categories = Category::whereNull('parent_id')->get();
        $countries = Country::all();
        $product = Product::find($product);
        return view('Dashboard.products.edit', compact('categories', 'countries', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_ar' => "required|string",
            'name_en' => "required|string",
            'sku' => "required|string|unique:products,sku," . $product->id,
            'images' => "array",
            'description_ar' => "required|string",
            'description_en' => "required|string",
            'vendor_price' => "required|string",
            'categories' => "required|array",
            'extra_fee'  => "required|numeric",
        ]);

        if ($files = $request->file('images')) {

            foreach ($product->images as $image) {
                Storage::disk('public')->delete('/images/products/' . $image->image);
                $image->delete();
            }

            foreach ($files as $file) {
                Image::make($file)->save(public_path('storage/images/products/' . $file->hashName()), 80);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $file->hashName(),
                ]);
            }
        }


        if ($product->status != $request->status) {

            $title_ar = 'اشعار من الإدارة';
            $title_en = 'Notification From Admin';

            switch ($request->status) {
                case 'active':
                    $body_ar = "تم تغيير حالة المنتج الخاص بك الى نشط";
                    $body_en  = "Your product status has been changed to Active";
                    break;
                case 'rejected':
                    $body_ar = "تم تغيير حالة المنتج الخاص بك الى مرفوض";
                    $body_en  = "Your product status has been changed to Rejected";
                    break;
                case 'pause':
                    $body_ar = "تم تغيير حالة المنتج الخاص بك الى معطل مؤقتا";
                    $body_en  = "Your product status has been changed to paused";
                    break;
                case 'pending':
                    $body_ar = "تم تغيير حالة المنتج الخاص بك الى معلق";
                    $body_en  = "Your product status has been changed to pending";
                    break;
                default:
                    # code...
                    break;
            }

            $url = route('vendor-products.index');
            addNoty($product->vendor, Auth::user(), $url, $title_en, $title_ar, $body_en, $body_ar);
        }

        $product->update([
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
            'sku' => $request['sku'],
            'description_ar' => $request['description_ar'],
            'description_en' => $request['description_en'],
            'vendor_price' => $request['vendor_price'],
            'status' => $request['status'],
            'extra_fee' => $request['extra_fee'],
            'admin_id' => Auth::id(),
        ]);


        $product->categories()->detach();
        $product->categories()->attach($request['categories']);

        CalculateProductPrice($product);

        $product->update([
            'unlimited' => $request['limited'] == 'on' ? 1 : 0,
        ]);

        $description_ar = ' تم تعديل منتج ' . '  منتج رقم' . ' #' . $product->id . ' - SKU ' . $product->sku;
        $description_en  = "product updated " . " product ID " . ' #' . $product->id . ' - SKU ' . $product->sku;
        addLog('admin', 'products', $description_ar, $description_en);

        alertSuccess('Product updated successfully', 'تم تحديث المنتج بنجاح');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {


        $product = Product::withTrashed()->where('id', $product)->first();
        if ($product->trashed() && auth()->user()->hasPermission('products-delete')) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete('/images/products/' . $image->image);
                $image->delete();
            }
            foreach ($product->stocks as $stock) {
                if ($stock->image != null) {
                    Storage::disk('public')->delete('/images/products/' . $stock->image);
                    $stock->delete();
                }
            }
            $product->forceDelete();
            alertSuccess('product deleted successfully', 'تم حذف المنتج بنجاح');
            return redirect()->route('products.trashed');
        } elseif (!$product->trashed() && auth()->user()->hasPermission('products-trash') && checkProductForTrash($product)) {
            $product->delete();
            alertSuccess('product trashed successfully', 'تم حذف المنتج مؤقتا');
            return redirect()->route('products.index');
        } else {
            alertError('Sorry, you do not have permission to perform this action, or the product cannot be deleted at the moment', 'نأسف ليس لديك صلاحية للقيام بهذا الإجراء ، أو المنتج لا يمكن حذفها حاليا');
            return redirect()->back();
        }
    }


    public function trashed()
    {
        $categories = Category::all();
        $countries = Country::all();
        $products = Product::onlyTrashed()
            ->whenSearch(request()->search)
            ->whenCategory(request()->category_id)
            ->whenCountry(request()->country_id)
            ->paginate(100);
        return view('Dashboard.products.index')->with('products', $products)->with('categories', $categories)->with('countries', $countries);
    }

    public function restore($product)
    {
        $product = Product::withTrashed()->where('id', $product)->first()->restore();
        alertSuccess('Product restored successfully', 'تم استعادة المنتج بنجاح');
        return redirect()->route('products.index');
    }

    public function stockCreate($product)
    {
        $product = Product::findOrFail($product);
        return view('Dashboard.products.stock ')->with('product', $product);
    }


    public function stockStore(Request $request, Product $product)
    {
        $request->validate([
            'stock' => "required|array",
            'limit' => "required|array",
            'image' => "nullable|array"
        ]);

        $stock = $request->stock;
        $limit = $request->limit;

        foreach ($product->stocks as $index => $product_stock) {
            if ($request->has('image')) {
                if (array_key_exists($product_stock->id, $request->image)) {
                    Image::make($request->image[$product_stock->id][0])->save(public_path('storage/images/products/' . $request->image[$product_stock->id][0]->hashName()), 60);
                    $product_stock->update([
                        'image' => $request->image[$product_stock->id][0]->hashName(),
                    ]);
                }
            }
            $product_stock->update([
                'quantity' => $stock[$index],
                'limit' => $limit[$index],
            ]);
        }

        alertSuccess('Product stock updated successfully', 'تم تحديث مخزون المنتج بنجاح');
        return redirect()->route('products.index');
    }

    public function colorCreate($product)
    {
        $colors = Color::all();
        $sizes = Size::all();
        $product = Product::find($product);
        return view('Dashboard.products.color', compact('colors', 'sizes', 'product'));
    }

    public function colorStore(Request $request, Product $product)
    {
        $request->validate([
            'color' => "required|string",
            'size' => "required|string",
        ]);

        foreach ($product->stocks as $stock) {
            if ($request->color == $stock->color->id && $request->size == $stock->size->id) {
                alertError('This item is already in the product, please modify the product to increase the stock', 'هذا العنصر موجود بالفعل في المنتج يرجى التعديل على المنتج لزيادة المخزون');
                return redirect()->route('products.stock.create', ['product' => $product->id]);
            }
        }

        $stock = Stock::create([
            'color_id' => $request['color'],
            'size_id' => $request['size'],
            'product_id' => $product->id,
        ]);

        alertSuccess('Inventory has been added to the product successfully', 'تم اضافة المخزون الى المنتج بنجاح');
        return redirect()->route('products.stock.create', ['product' => $product->id]);
    }

    public function colorDestroy(Stock $stock)
    {
        $product_id = $stock->product_id;
        $stock->delete();
        alertSuccess('Stock deleted successfully', 'تم حذف المخزون بنجاح');
        return redirect()->route('products.stock.create', ['product' => $product_id]);
    }


    public function myStockShow($lang, Product $product)
    {

        $scountry = Country::findOrFail(Auth()->user()->country_id);

        $categories = Category::with('products')
            ->where('country_id', $scountry->id)
            ->where('parent', 'null')
            ->get();

        $categories = Category::with('products')
            ->where('country_id', $scountry->id)
            ->where('parent', $product->categories()->first()->id)
            ->get();


        return view('Dashboard.aff-prod.mystock_product', compact('categories', 'product'));
    }

    public function myStockOrder($lang, Request $request, Product $product)
    {

        $user = Auth::user();


        $request->validate([
            'quantity' => 'required|array',
            'payment' => 'required|string',
        ]);

        $vendor_price = $request->price;

        $count = 0;
        $check_quantity = 0;
        $quantity_count = 0;

        foreach ($request->quantity as $quantity1) {

            $quantity_count += $quantity1;
        }

        $total_price = $quantity_count * $product->min_price;



        foreach ($product->stocks as $key => $stock) {

            if ($request->quantity[$key] > $stock->stock) {
                $count = $count + 1;
            }
            if ($request->quantity[$key] <= 0) {
                $check_quantity += 1;
            }
        }



        if ($count > 0) {

            if (app()->getLocale() == 'ar') {

                session()->flash('success', 'تم تحديث الكميات المتاحة لهذا المنتج .. يرجى مراجعة الكميات المطلوبة ومحاولة عمل الطلب مرة أخرى');
            } else {

                session()->flash('success', 'The quantities available for this product have been updated.. Please review the required quantities and try to make the order again');
            }


            return redirect()->route('mystock.add', ['lang' => app()->getLocale(), 'product' => $product->id]);
        }

        if ($check_quantity == $key + 1) {

            if (app()->getLocale() == 'ar') {

                session()->flash('success', 'يرجى إضافة كميات الى طلبك لكي يمكنك من اتمام الطلب');
            } else {

                session()->flash('success', 'Please add quantities to your order so that you can complete the order');
            }


            return redirect()->route('mystock.add', ['lang' => app()->getLocale(), 'product' => $product->id]);
        }


        if ($vendor_price != $product->vendor_price) {

            if (app()->getLocale() == 'ar') {

                session()->flash('success', 'تم تحديث سعر هذا المنتج .. يرجى مراجعة السعر الحالي للمنتج');
            } else {

                session()->flash('success', 'The price of this product has been updated.. Please check the current price of the product');
            }


            return redirect()->route('mystock.add', ['lang' => app()->getLocale(), 'product' => $product->id]);
        }




        $order = Aorder::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'country_id' => Auth::user()->country->id,
            'total_price' => $total_price,
            'product_id' => $product->id,
            'status' => 'pending'
        ]);


        foreach ($product->stocks as $key => $stock) {

            $stock = Astock::create([
                'product_id' => $product->id,
                'color_id' => $stock->color_id,
                'aorder_id' => $order->id,
                'size_id' => $stock->size_id,
                'image' => $stock->image == NULL ? NULL : $stock->image,
                'stock' => $request->quantity[$key],
            ]);
        }

        return redirect()->route('mystock.orders', ['lang' => app()->getLocale(), 'user' => $user->id]);
    }

    public function myStockorders($lang, $user)
    {
        $orders = Aorder::where('user_id', $user)
            ->whenSearch(request()->search)
            ->whenStatus(request()->status)
            ->latest()
            ->paginate(100);

        $user = User::find($user);

        return view('Dashboard.orders.mystock_orders')->with('orders', $orders)->with('user', $user);
        // return view('Dashboard.orders.mystock_orders' , compact($orders , $user));


    }



    public function myStockordersAdmin($lang, Request $request)
    {


        if (!$request->has('from') || !$request->has('to')) {

            $request->merge(['from' => Carbon::now()->subDay(365)->toDateString()]);
            $request->merge(['to' => Carbon::now()->toDateString()]);
        }

        $orders = Aorder::whereDate('created_at', '>=', request()->from)
            ->whereDate('created_at', '<=', request()->to)
            ->whenSearch(request()->search)
            ->whenStatus(request()->status)
            ->latest()
            ->paginate(100);


        return view('Dashboard.all_orders.stock_orders')->with('orders', $orders);
    }

    public function myStockCancel($lang, Aorder $order)
    {

        if ($order->status == 'pending') {

            $order->update([
                'status' => 'canceled'
            ]);
        }

        return redirect()->back();
    }

    public function myStockProduct($lang, Product $product, Aorder $order)
    {

        $scountry = Country::findOrFail(Auth()->user()->country_id);

        $categories = Category::with('products')
            ->where('country_id', $scountry->id)
            ->where('parent', 'null')
            ->get();

        $categories = Category::with('products')
            ->where('country_id', $scountry->id)
            ->where('parent', $product->categories()->first()->id)
            ->get();


        return view('Dashboard.aff-prod.sproduct', compact('categories', 'product', 'order'));
    }

    public function myStockProducts($lang)
    {
        // $category = Category::all();

        $scountry = Country::findOrFail(Auth()->user()->country_id);

        $user = Auth::user();


        $orders = Aorder::where('user_id', $user->id)
            ->latest()
            ->paginate(100);



        return view('Dashboard.aff-prod.mystock_products', compact('orders', 'user'));
    }

    public function myStockordersChange($lang, Request $request, Aorder $order)
    {



        $request->validate([

            'status' => "required|string|max:255",

        ]);

        $product = $order->product;
        $astocks = $product->astocks->where('order_id', $order->id)->values();





        if ($order->status == 'pending' && $request->status == 'confirmed') {
            $order->update([
                'status' => 'confirmed'
            ]);


            foreach ($product->stocks as $key => $stock) {
                $stock->update([
                    'stock' => $stock->stock - $astocks[$key]->stock
                ]);
            }
        }

        if ($order->status == 'pending' && $request->status == 'rejected') {
            $order->update([
                'status' => 'rejected'
            ]);
        }


        switch ($order->status) {
            case "pending":
                $status_en = "pending";
                $status_ar = "معلق";
                break;
            case "confirmed":
                $status_en = "confirmed";
                $status_ar = "مؤكد";
                break;
            case "rejected":
                $status_en = "rejected";
                $status_ar = "مرفوض";
                break;
            case "canceled":
                $status_en = "canceled";
                $status_ar = "ملغي";
                break;
            default:
                break;
        }




        $title_ar = 'اشعار من الإدارة';
        $body_ar = "تم تغيير حالة الطلب الخاص بك الى " . $status_ar;
        $title_en = 'Notification From Admin';
        $body_en  = "Your order status has been changed to " . $status_en;


        $notification1 = Notification::create([
            'user_id' => $order->user->id,
            'user_name'  => Auth::user()->name,
            'user_image' => asset('storage/images/users/' . Auth::user()->profile),
            'title_ar' => $title_ar,
            'body_ar' => $body_ar,
            'title_en' => $title_en,
            'body_en' => $body_en,
            'date' => $order->updated_at,
            'status' => 0,
            'url' =>  route('mystock.orders', ['lang' => app()->getLocale(), 'user' => $order->user->id]),
        ]);



        $date =  Carbon::now();
        $interval = $notification1->created_at->diffForHumans($date);

        $data = [
            'notification_id' => $notification1->id,
            'user_id' => $order->user->id,
            'user_name'  => Auth::user()->name,
            'user_image' => asset('storage/images/users/' . Auth::user()->profile),
            'title_ar' => $title_ar,
            'body_ar' => $body_ar,
            'title_en' => $title_en,
            'body_en' => $body_en,
            'date' => $interval,
            'status' => $notification1->status,
            'url' =>  route('mystock.orders', ['lang' => app()->getLocale(), 'user' => $order->user->id]),
            'change_status' => route('notification-change', ['lang' => app()->getLocale(), 'user' => $order->user->id, 'notification' => $notification1->id]),

        ];


        try {
            event(new NewNotification($data));
        } catch (Exception $e) {
        }


        return redirect()->route('stock.orders', app()->getLocale());
    }



    public function updateStatusBulk(Request $request)
    {

        $request->validate([
            'selected_status' => "required|string|max:255",
            'selected_items' => "required|array",
        ]);

        foreach ($request->selected_items as $product) {

            $product = Product::findOrFail($product);

            if ($product->status != $request->selected_status) {

                $this->changeStatus($product, $request->selected_status);

                alertSuccess('Products status updated successfully', 'تم تحديث حالة المنتجات بنجاح');
            } else {
                alertError('The status of some products cannot be changed', 'لا يمكن تغيير حالة بعض المنتجات');
            }
        }

        return redirect()->route('products.index');
    }

    public function updateStatus(Request $request, Product $product)
    {

        $request->validate([
            'status' => "required|string|max:255",
        ]);


        if ($product->status != $request->status) {

            $this->changeStatus($product, $request->status);

            alertSuccess('Product status updated successfully', 'تم تحديث حالة المنتج بنجاح');
        } else {
            alertError('Product status cannot be updated', 'لا يمكن تحديث حالة المنتج');
        }

        return redirect()->route('products.index');
    }

    private function changeStatus($product, $status)
    {
        $title_ar = 'اشعار من الإدارة';
        $title_en = 'Notification From Admin';

        switch ($status) {
            case 'active':
                $body_ar = "تم تغيير حالة المنتج الخاص بك الى نشط";
                $body_en  = "Your product status has been changed to Active";
                break;
            case 'rejected':
                $body_ar = "تم تغيير حالة المنتج الخاص بك الى مرفوض";
                $body_en  = "Your product status has been changed to Rejected";
                break;
            case 'pause':
                $body_ar = "تم تغيير حالة المنتج الخاص بك الى معطل مؤقتا";
                $body_en  = "Your product status has been changed to paused";
                break;
            case 'pending':
                $body_ar = "تم تغيير حالة المنتج الخاص بك الى معلق";
                $body_en  = "Your product status has been changed to pending";
                break;
            default:
                # code...
                break;
        }

        $url = route('vendor-products.index');
        addNoty($product->vendor, Auth::user(), $url, $title_en, $title_ar, $body_en, $body_ar);

        $product->update([
            'status' => $status,
            'admin_id' => Auth::id(),
        ]);

        $description_ar = ' تم تعديل منتج ' . '  منتج رقم' . ' #' . $product->id . ' - SKU ' . $product->sku;
        $description_en  = "product updated " . " product ID " . ' #' . $product->id . ' - SKU ' . $product->sku;
        addLog('admin', 'products', $description_ar, $description_en);
    }
}
