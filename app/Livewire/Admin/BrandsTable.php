<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;

class BrandsTable extends Component
{
    public $start = 0;
    public $limits = 10;
    public $subsetOrders;
    public $page = 1;

    protected $listeners = ['updateBrand' => 'render'];

    public function loadMore()
    {
        if($this->start + $this->limits < Brand::count()) {
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

    public function updatebrand()
    {
       $this->dispatch('updateBrand');
    }

    public function delete($id)
    {
        $brand = Brand::find($id);

        if ($brand) {
            $brand->delete();
            $this->render();
        }
    }

    public function render()
    {
        $brands = Brand::all();

        return view('livewire.admin.brands-table' , compact('brands'));
    }
}
