<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Traits\CartTrait;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryPage extends Component
{
    use WithPagination;
    use CartTrait;
    use LivewireAlert;
    protected $listeners = ['update' => '$refresh', 'render' => '$refresh'];
    public $categoryId;
    public $brandId = 0;

    public $paginationNumber = 12;

    public $minPrice = 0;
    public $maxPrice = 0;
    public $selectedPrice = 0;

    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;
    }

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
        $query = Product::where('category_id', '=', $this->categoryId)->where('is_activated', true);

        if ($this->maxPrice == 0) {
            $this->maxPrice = Product::max('price') ?? 1000;
            $this->selectedPrice = $this->maxPrice;
        }

        if ($this->maxPrice != 0 && $this->selectedPrice > 0) {
            $query->where('price', '>=', $this->minPrice)->where('price', '<=', $this->selectedPrice);
        }

        $products = $query->paginate($this->paginationNumber);
        $brands = Brand::all();

        return view('livewire.category-page', ['brands' => $brands, 'products' => $products]);
    }
}
