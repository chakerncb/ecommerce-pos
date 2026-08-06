<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index($ctgName) {
        $slug = Str::slug($ctgName);

        $category = Category::where('id', $ctgName)
            ->orWhere('slug', $ctgName)
            ->orWhere('slug', $slug)
            ->orWhere('name', $ctgName)
            ->orWhere('name->en', $ctgName)
            ->orWhere('name->ar', $ctgName)
            ->orWhere('name', 'like', '%' . $ctgName . '%')
            ->first();

        $categoryId = $category ? $category->id : 0;

        return view('front.categoryPage', ['ctgName' => $ctgName, 'categoryId' => $categoryId]);
    }
}
