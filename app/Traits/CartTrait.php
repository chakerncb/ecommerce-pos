<?php 

namespace App\Traits;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;

Trait CartTrait {

    public function addToCart($product_id)
    {
        
        $product = Product::find($product_id);

        if(!$product) {
            return false;
        }

        $image = $product->images->first();
         Cart::add(
            $product->product_id,
            $product->name,
            $this->quantity[$product_id] ?? 1,
            $product->price,
            ['path' => $image->path  ?? 'no-image.png'],
            0,
        );

        return true;
        
    }

    public function deletefromCart($product_id)
    {
        $row = Cart::search(function ($cartItem, $rowId) use ($product_id) {
            return $cartItem->id === $product_id;
        })->first();

        if(!$row) {
            return false;
        }

        Cart::remove($row->rowId);
        return true;
          
    }

    public function destroyCart(){
        Cart::destroy();
        return true;
    }   

}