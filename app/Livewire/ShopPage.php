<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Traits\CartTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ShopPage extends Component
{
    use CartTrait;
    use LivewireAlert;
    use WithPagination;

    protected $listeners = ['update' => '$refresh', 'render' => '$refresh'];
    public $brandId = 0;
    public $categoryId = 0;
    public $minPrice = 0;
    public $maxPrice = 0;
    public $selectedPrice = 0;

    public $paginationNumber = 12;

    public function filter()
    {
        $this->resetPage();
        $this->dispatch('update');
    }

    public function ToCart($product_id)
    {
        $added = $this->addToCart($product_id);
        
        if($added == false) {
            session()->flash('message', 'Product not found');
            return;
        }

        $this->dispatch('cartUpdated');
        $this->alert('success', 'Product added to cart');
    }  

    public function render()
    {
        $query = Product::where('is_activated', true);

        if ($this->maxPrice == 0) {
            $this->maxPrice = Product::max('price') ?? 1000;
            $this->selectedPrice = $this->maxPrice;
        }

        if ($this->maxPrice != 0 && $this->selectedPrice > 0) {
            $query->where('price', '>=', $this->minPrice)->where('price', '<=', $this->selectedPrice);
        }

        if ($this->categoryId != 0) {
            $query->where('category_id', '=', $this->categoryId);
        }

        $products = $query->paginate($this->paginationNumber);
        $brands = Brand::all();
        $categories = Category::all();

        return view('livewire.shop-page', ['products' => $products, 'brands' => $brands, 'categories' => $categories]);
    }
}
