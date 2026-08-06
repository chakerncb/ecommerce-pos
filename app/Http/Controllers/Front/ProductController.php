<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index($name) {
        $slug = Str::slug($name);

        $product = Product::where('id', $name)
            ->orWhere('slug', $name)
            ->orWhere('slug', $slug)
            ->orWhere('name', $name)
            ->orWhere('name->en', $name)
            ->orWhere('name->ar', $name)
            ->orWhere('name', 'like', '%' . $name . '%')
            ->first();

        if (!$product) {
            return redirect()->route('index');
        }

        $category = $product->category?->name ?? 'General';

        return view('front.product-details', compact('product', 'category'));
    }

    public function addToCart($name) {
        return 'add to cart ' . $name;
    }
}
