<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Product;
use App\Models\ShippingRate;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $rates = ShippingRate::where('country_id', $user->country->id)->get();
        foreach ($user->cart->products as $product) {
            if ($product->pivot->vendor_price != $product->vendor_price || $product->stocks->find($product->pivot->stock_id) == NULL) {
                $user->cart->products()->wherePivot('stock_id', $product->pivot->stock_id)->detach();
                alertError('Some prices of the products in your cart have been updated, please check the order again', 'تم تحديث بعض أسعار المنتجات الموجودة بسلة مشترياتك يرجى مراجعة الطلب مرة أخرى');
                return redirect()->route('cart');
            }
        }
        return view('affiliate.cart.index', compact('user', 'rates'));
    }


    public function store(Request $request)
    {

        $product = Product::find($request->product_id);
        $stock = $request->stock_id;
        $product_type = $request->product_type;

        if ($product_type == '0') {
            $av_stock = Stock::find($stock);
            $quantity = $av_stock->quantity;
        }

        // else {
        //     $av_stock = Astock::find($stock);
        //     $stock = $av_stock->stock;
        // }

        $max = $product->max_price;
        $min = $product->price;


        if ($request->quantity > $quantity || $request->quantity <= 0) {
            return 2;
        }


        if ($request->selected_price < $min || $request->selected_price > $max) {
            return 3;
        }

        if ($request->vendor_price != $product->vendor_price) {
            return 4;
        }


        $cart = Auth()->user()->cart;

        if ($cart->products()->where('stock_id', $request->stock_id)->count() > 0) {
            return 0;
        }

        $selected_price = ceil($request->selected_price);

        $cart->products()->attach($product->id, ['stock_id' => $request->stock_id, 'quantity' => $request->quantity, 'price' => $selected_price, 'vendor_price' => $product->vendor_price, 'product_type' => $product_type]);


        return 1;
    } //end of products


    public function destroy($product, $stock)
    {
        $product = Product::find($product);
        $user = Auth::user();
        $cart = $user->cart;
        $cart->products()->wherePivot('stock_id', $stock)->detach();
        return redirect()->route('cart');
    }
}
