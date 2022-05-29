<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price', 'address', 'status', 'country_id', 'user_name', 'wallet_balance', 'shipping_rate_id', 'total_commission', 'total_profit', 'notes', 'client_phone', 'client_name', 'special_mark', 'house', 'phone2', 'shipping',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function refund()
    {
        return $this->hasOne(Refund::class);
    }


    public function prefunds()
    {
        return $this->hasMany(Prefund::class);
    }

    public function histories()
    {
        return $this->hasMany(OrderHistory::class)->orderBy('id');
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function order_notes()
    {
        return $this->hasMany(OrderNote::class);
    }



    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('stock_id', 'selling_price', 'quantity', 'total_selling_price', 'total_commission', 'commission_per_item', 'profit_per_item', 'product_type', 'vendor_price', 'size_ar', 'size_en', 'color_ar', 'color_en')
            ->withTimestamps();
    }

    public function shipping_rate()
    {
        return $this->belongsTo(ShippingRate::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function vendor_orders()
    {
        return $this->hasMany(VendorOrder::class);
    }

    public static function getOrders($status = null, $from = null, $to = null)
    {

        $orders = DB::table('order_product')->select('id', 'order_id', 'created_at', 'updated_at', 'product_id', 'vendor_price', 'selling_price', 'commission_per_item', 'profit_per_item', 'total_selling_price', 'total_commission', 'quantity', 'stock_id', 'product_type', 'color_en', 'size_en')
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get()->toArray();

        foreach ($orders as $index => $order) {

            $product = Product::where('id', $order->product_id)->first();
            $orders[$index]->product_name_ar = $product->name_ar;
            $orders[$index]->product_name_en = $product->name_en;

            $orders[$index]->affiliate_id = $product->orders->where('id', $order->order_id)->first()->user_id;
            $orders[$index]->status = $product->orders->where('id', $order->order_id)->first()->status;
            $orders[$index]->customer_name = $product->orders->where('id', $order->order_id)->first()->client_name;
            $orders[$index]->customer_phone = $product->orders->where('id', $order->order_id)->first()->client_phone;
            $orders[$index]->customer_phone2 = $product->orders->where('id', $order->order_id)->first()->phone2;
            $orders[$index]->address = $product->orders->where('id', $order->order_id)->first()->address;
            $orders[$index]->house = $product->orders->where('id', $order->order_id)->first()->house;
            $orders[$index]->special_mark = $product->orders->where('id', $order->order_id)->first()->special_mark;
            $orders[$index]->notes = $product->orders->where('id', $order->order_id)->first()->notes;

            $orders[$index]->SKU = $product->sku;
            $orders[$index]->vendor_id = $product->vendor_id;


            if ($order->product_type == '0') {
                $orders[$index]->product_type = 'Sonoo stock';
            } else {
                $orders[$index]->product_type = 'Affiliate stock';
            }

            $order2 = Order::find($order->order_id);
            $total = intval($order2->shipping_rate->cost) + $order->total_selling_price;
            $orders[$index]->total_selling_price = $total;

            if ($status != null) {
                if ($orders[$index]->status != $status) {

                    unset($orders[$index]);
                }
            }
        }

        $description_ar =  'تم تنزيل شيت الطلبات';
        $description_en  = 'Orders file has been downloaded ';
        addLog('admin', 'exports', $description_ar, $description_en);

        return $orders;
    }


    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('id', 'like', "%$search%")
                ->orWhere('total_price', 'like', "%$search%")
                ->orWhere('user_name', 'like', "%$search%")
                ->orWhere('client_name', 'like', "%$search%")
                ->orWhere('client_phone', 'like', "%$search%");
        });
    }


    public function scopeWhenCountry($query, $country_id)
    {
        return $query->when($country_id, function ($q) use ($country_id) {
            return $q->where('country_id', 'like', "%$country_id%");
        });
    }

    public function scopeWhenStatus($query, $status)
    {
        return $query->when($status, function ($q) use ($status) {
            return $q->where('Status', 'like', "%$status%");
        });
    }
    public function scopeWhenPaymentStatus($query, $payment_status)
    {
        return $query->when($payment_status, function ($q) use ($payment_status) {
            return $q->where('payment_status', 'like', "%$payment_status%");
        });
    }
}
