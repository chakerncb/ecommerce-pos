<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function search($search)
    {
        return view('front.searchPage', compact('search'));
    }
}
