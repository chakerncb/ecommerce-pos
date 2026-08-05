<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsTable extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $listeners = ['updateTable' => 'render'];

    public $start = 0;
    public $limits = 10;
    // public $products;
    // public $categories;
    public $page = 1;
    public $filter = 'all';

    public $searchContent = '';


    public function filterByCtg()
    {
        $this->resetPage();
        $this->dispatch('updateTable');         
     }

    public function search() {
        $this->resetPage();
        $this->dispatch('updateTable');
    }

    public function deleteProduct($product_id) {

        if(!$product_id) {
            $this->alert('error', 'Product Not Found');
            return;
        }

        $product = Product::find($product_id);
        $product->delete();
        $this->alert('success', 'Product Deleted Successfully');
        $this->dispatch('updateTable');	

    }

    public function render()
    {
        $query = Product::with('images')->select(
            'product_id',
            'name',
            'main_price',
            'price',
            'description',
            'stock',
            'category_id',
            'code',

        );


         if ($this->filter !== 'all') {
            $query->where('category_id', $this->filter);
        }

        if ($this->searchContent) {
            $query->where('name', 'like', "%{$this->searchContent}%")->orWhere('code', 'like', "%{$this->searchContent}%");
        }

        $products = $query->paginate(10);

        $categories = Category::select('category_id', 'name')->get()->keyBy('category_id');


        foreach ($products as $product) {
            $product->category_name = $categories->get($product->category_id)->name ?? 'Unknown';
        }

        return view('livewire.admin.products-table' , compact('products', 'categories'));
    }
}
