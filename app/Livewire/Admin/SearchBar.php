<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class SearchBar extends Component
{

    public $content= '';

    public function search()
    {
        $this->emit('search', $this->content);
    }
    public function render()
    {
        return view('livewire.admin.search-bar');
    }
}

