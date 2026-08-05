<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use App\Models\Store;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SettingsPage extends Component
{
    use LivewireAlert;
    protected $listeners = ['update' => 'render'];

    public function profileUpdate($status , $message) {

        if($status == true){
            $this->alert('success' , $message);
            $this->dispatch('update');
         } else {
            $this->alert('error' , $message);
          }
    }


    public function storeUpdate($status , $message) {

        if($status == true){
            $this->alert('success' , $message);
            $this->dispatch('update');
         } else {
            $this->alert('error' , $message);
          }
    }

    public function render()
    {
        $admin = Admin::find(auth()->guard('admin')->user()->id);
        $store = Store::first();

        return view('livewire.admin.settings-page' , compact('admin' , 'store'));
    }
}
