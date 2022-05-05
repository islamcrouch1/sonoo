<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class AffiliateProductsController extends Controller
{
    public function index()
    {


        $country = Country::findOrFail(Auth()->user()->country_id);
        $slides1 = Slide::where('slider_id', 1)->get();
        $slides2 = Slide::where('slider_id', 2)->get();
        $slides3 = Slide::where('slider_id', 3)->get();


        $categories = Category::with('products')
            ->where('country_id', $country->id)
            ->where('parent_id', 'null')
            ->get();

        $products = Product::where('country_id', $country->id)
            ->whereHas('stocks', function ($query) {
                $query->where('quantity', '!=', '0');
            })
            ->where('status', "active")
            ->whenSearch(request()->search)
            ->latest()
            ->paginate(20);

        return view('affiliate.products.index', compact('categories', 'products', 'slides1', 'slides2', 'slides3'));
    }

    public function affiliateProduct($lang, Product $product)
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


        return view('dashboard.aff-prod.product', compact('categories', 'product'));
    }
}
