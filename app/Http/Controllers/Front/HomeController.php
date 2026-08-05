<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
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
        
        return view('front.index')->with([
            'categories' => $categories,
            'store' => $store
        ]);
    }

    public function shop()
    {
        return view('front.shop');
    }
}
