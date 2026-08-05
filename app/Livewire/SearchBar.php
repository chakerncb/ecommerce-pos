<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class SearchBar extends Component
{
    protected $listeners = ['update' => '$refresh'];
    public $searchContent = '';
    public $products = [];

    public function searchGo()
    {
        return redirect()->route('search', ['search' => $this->searchContent]);
    }

    public function search()
    {
        if ($this->searchContent) {
            $query = Product::where('is_activated', true)
                ->where('name', 'like', '%' . $this->searchContent . '%');

            $productsResult = $query->take(4)->get();

            $categoriesResult = Category::get()->keyBy('id');

            foreach ($productsResult as $product) {
                $product->category_name = $categoriesResult->get($product->category_id)->name ?? 'General';
            }

            $this->products = $productsResult;
        } else {
            $this->products = [];
        }

        $this->dispatch('update');
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
