@props(['product'])
<div class="row align-items-end">
        <div class="form-group quantity">
            <label for="quantity">Quantity</label>
            <input class="form-group quantity" type="number" id="quantity" wire:model="quantity.{{$product->product_id}}" min="1" max="{{$product->stock}}" class="form-control">
        </div>
    <div class="col-lg-4 col-md-4 col-12">
        <div class="button cart-button">
            <button wire:click="ToCart({{$product->product_id}})" class="btn" style="width: 100%;">Add to Cart</button>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-12">
        <div class="button cart-button">
            <button wire:click="ToWishlist({{$product->product_id}})" class="btn"><i class="lni lni-heart"></i> To Wishlist</button>
        </div>
    </div>
</div>
