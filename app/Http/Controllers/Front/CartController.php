<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    
    public function index() {
    
        // $items = Cart::content();
        // return $items;

        return view('front.cart');
        
    }
}
