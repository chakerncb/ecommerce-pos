<?php

namespace App\Livewire;


use App\Traits\CartTrait;
use Auth;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPage extends Component
{

    use CartTrait;

    protected $listeners = ['cartUpdated' => 'render' ];
    public function render()
    {
        $cartItems = Cart::content();
        $cartTotal = Cart::total();
        $cartCount = Cart::content()->count();

        return view('livewire.cart-page' , compact('cartItems' , 'cartTotal' , 'cartCount'));	
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

    public function clearCart()
    {
         $cleared = $this->destroyCart();

        if($cleared != true) {
            session()->flash('message', 'Cart is empty');
            return;
        }

        session()->flash('message', 'Cart cleared');
        $this->dispatch('cartUpdated');
    }

    // public function goToCheckout(){
    //     if(Auth::user()->check()){
    //         return redirect()->route('checkout');
    //     }
    // }


    public function increment($rowId)
    {
        $item = Cart::get($rowId);
        Cart::update($rowId, $item->qty + 1);
        $this->dispatch('cartUpdated');
    }

    public function decrement($rowId)
    {
        $item = Cart::get($rowId);
        Cart::update($rowId, $item->qty - 1);
        $this->dispatch('cartUpdated');
    }
}
