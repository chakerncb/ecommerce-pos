<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\wishlist;
use App\Traits\CartTrait;
use App\Traits\WishlistTrait;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductDetailsCard extends Component
{
    use CartTrait;
    use WishlistTrait;
    use LivewireAlert;

    protected $listeners = ['confirm'];
    public $product;
    public $quantity = [];

    public function mount($product)
    {
        $this->product = $product;
        $this->products = Product::all();
        foreach ($this->products as $product) {
            $this->quantity[$product->product_id] = 1;
        }
    }

    public function incrementQuantity($product_id)
    {
        if (isset($this->quantity[$product_id])) {
            $max = $this->product->stock ?? 99;
            if ($this->quantity[$product_id] < $max) {
                $this->quantity[$product_id]++;
            }
        }
    }

    public function decrementQuantity($product_id)
    {
        if (isset($this->quantity[$product_id]) && $this->quantity[$product_id] > 1) {
            $this->quantity[$product_id]--;
        }
    }

    public function render()
    {
        return view('livewire.product-details-card', ['product' => $this->product]);
    }

    public function ToCart($product_id)
    {
        $added = $this->addToCart($product_id);
        
        if($added == false) {
            session()->flash('message', 'Product not found');
            return;
        }
        else {
            $this->dispatch('cartUpdated');
            session()->flash('message', 'Product added to cart');
        }

        $this->alert('success', 'Product added to cart');
    }

    public function BuyNow($product_id)
    {
        $added = $this->addToCart($product_id);

        if ($added == false) {
            $this->alert('error', 'Product not found');
            return;
        }

        $this->dispatch('cartUpdated');
        return redirect()->route('checkout.index');
    }


    public function ToWishlist($product_id)
    {
        if (auth()->check()) {
            $added = $this->addToWishlist($product_id);

            if($added == false) {
                // session()->flash('message', 'Product not found');
                $this->alert('warning', 'Product not found');
                return;
            }
                           
            $this->dispatch('cartUpdated');
            $this->alert('success', 'Product added to wishlist');
        } else {

            $this->alert('warning', 'You need to login first' , [
                'position' => 'center',
                'onConfirmed' => 'confirm',
                'showConfirmButton' => true,
                'confirmButtonText' => 'Login',
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancel',
            ]);
                
        }
       
    }

    public function confirm()
    {
            return redirect()->route('login');
    }

}
