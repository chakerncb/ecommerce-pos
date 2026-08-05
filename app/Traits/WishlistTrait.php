<?php 

namespace App\Traits;

use App\Models\Product;
use App\Models\wishlist;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;

Trait WishlistTrait {

    public function addToWishlist($product_id)
    {
        $product = Product::find($product_id);

        if(!$product) {
            return false;
        }
        
        wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product_id,
            'quantity' => $this->quantity[$product_id] ?? 1,
        ]);
        return true;
    }

    public function deleteFromWishlist($product_id)
    {
        $wishlist = wishlist::where(
            'user_id',
            auth()->id()
        )->where('product_id', $product_id)->first();

        if(!$wishlist) {
            return false;
        }

        $wishlist->delete();
        return true;

    }

    public function destroyWishlist()
    {
        $wishlist = wishlist::where(
            'user_id',
            auth()->id()
        )->get();

        if(!$wishlist) {
            return false;
        }

        foreach ($wishlist as $item){
            $item->delete();
        }
        return true;

    }

}