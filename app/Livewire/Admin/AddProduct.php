<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;

class AddProduct extends Component
{
    public function render()
    {
        $categories = Category::select('category_id', 'name')->get();
        $brands = Brand::select('brand_id', 'name')->get();

        return view('livewire.admin.add-product' , compact('categories' , 'brands'));
    }
}
