<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($name) {
        $product = Product::where('name', $name)
            ->orWhere('slug', $name)
            ->orWhere('id', $name)
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
