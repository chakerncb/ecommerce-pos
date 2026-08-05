<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //
    public function index()
    {
        // 
        
        // $wishlist = wishlist::where('user_id', auth()->id())->get();

        // return $wishlist;

        return view('front.wishlist');


    }
}
