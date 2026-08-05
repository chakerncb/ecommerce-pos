<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index($ctgName) {
        $category = Category::where('name', $ctgName)
            ->orWhere('slug', $ctgName)
            ->orWhere('id', $ctgName)
            ->first();

        $categoryId = $category ? $category->id : 0;

        return view('front.categoryPage', ['ctgName' => $ctgName, 'categoryId' => $categoryId]);
    }
}
