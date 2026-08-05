<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Traits\CartTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductCard extends Component
{
    use CartTrait;
    use LivewireAlert;

    public $products;
    public array $quantity = [];

    public function render()
    {
        $this->products = Product::where('is_activated', true)
                    ->latest()
                    ->take(12)
                    ->get();

        foreach ($this->products as $product) {
            $this->quantity[$product->product_id] = 1;
        }

        $categories = Category::get()->keyBy('id');

        foreach ($this->products as $product) {
            $product->category_name = $categories->get($product->category_id)->name ?? 'General';
        }

        return view('livewire.product-card');	
    }

    public function ToCart($product_id)
    {
        $added = $this->addToCart($product_id);
        
        if($added == false) {
            session()->flash('message', 'Product not found');
            return;
        }
        else {
            $this->dispatch('cartUpdated');
            session()->flash('message', 'Product added to cart');
        }

        $this->alert('success', 'Product added to cart');
    }  
    
    public function deleteMsg() {
        session()->forget('message');
    }
}
