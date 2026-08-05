<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class CategoriesTable extends Component
{

    public $start = 0;
    public $limits = 10;
    public $subsetOrders;
    public $page = 1;

    protected $listeners = ['updateCategory' => 'render'];

    public function loadMore()
    {
        if($this->start + $this->limits < Category::count()) {
            $this->start += 10;
            $this->page++;
            $this->render();  
        }
    }

    public function loadLess()
    {
        if($this->start > 0) {
            $this->start -= 10;
            $this->page--;
            $this->render();
        }
    }

    public function updateCategory()
    {
       $this->dispatch('updateCategory');
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            $this->render();
        }
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.admin.categories-table' , compact('categories'));
    }
}
