<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Traits\StoreInfoTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use StoreInfoTrait;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {            
        $categories = Category::where('is_active', 1)->get()->keyBy('id');
        $store = $this->getStoreInfo();
        $trendingProducts = Product::where('is_trend', 1)->where('is_activated', 1)->get();
        
        return view('front.index')->with([
            'categories' => $categories,
            'store' => $store,
            'trendingProducts' => $trendingProducts,
        ]);
    }

    public function shop()
    {
        return view('front.shop');
    }
}
