<?php

namespace App\Livewire;

use App\Traits\CartTrait;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartPreview extends Component
{
    use CartTrait;

    protected $listeners = ['cartUpdated' => 'render' , 'clearItem' => 'removefromCart' ];
    public function render()
    {
        $cartItems = Cart::content();
        $cartTotal = Cart::total();
        $cartCount = Cart::content()->count();

        return view('livewire.cart-preview', compact('cartItems' , 'cartTotal' , 'cartCount'));
    }
    

    public function removefromCart($product_id)
    {
        $deleted = $this->deletefromCart($product_id);

        if($deleted == false) {
            session()->flash('message', 'Product not found');
            return;
        }
        else {
            $this->dispatch('cartUpdated');        
            session()->flash('message', 'Product removed from cart');
        }

    }
}
