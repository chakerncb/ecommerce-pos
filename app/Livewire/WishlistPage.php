<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\wishlist;
use App\Traits\CartTrait;
use App\Traits\WishlistTrait;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishlistPage extends Component
{
    use CartTrait;
    use WishlistTrait;
    protected $listeners = ['refreshWishlist' => 'render'];




    public function render()
    {
        $wishlist = wishlist::where(
                     'user_id',
                      auth()->id()
                    )->get();

        $products = [];
        foreach ($wishlist as $item){
            $product = Product::find($item->product_id);
            $products[] = $product;
        } 

        
        
        return view('livewire.wishlist-page' , compact('products'));
    }

    public function removeFromWishlist($product_id)
    {
        $deleted = $this->deleteFromWishlist($product_id);

        if($deleted == false) {
            session()->flash('message', 'Product not found');
            return;
        }
        else {
            $this->dispatch('refreshWishlist');
            session()->flash('message', 'Product removed from wishlist');
        }
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
    }

    public function clearWishlist()
    {
        $cleared = $this->destroyWishlist();

        if($cleared != true) {
            session()->flash('message', 'Wishlist is empty');
            return;
        }

        session()->flash('message', 'Wishlist cleared');
        $this->dispatch('refreshWishlist');

    }

}
