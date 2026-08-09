@props(['product'])
<div class="row align-items-end">
        <div class="form-group quantity">
            <label for="quantity">Quantity</label>
            <input class="form-group quantity" type="number" id="quantity" wire:model="quantity.{{$product->product_id}}" min="1" max="{{$product->stock}}" class="form-control">
        </div>
    <div class="col-12">
        <div class="details-action-row">
            {{-- Add to Cart --}}
            <button wire:click="ToCart({{$product->product_id}})" class="btn btn-atc-details">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right:6px;vertical-align:-2px"><path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>
                Add to Cart
            </button>
            {{-- Buy Now --}}
            <button wire:click="BuyNow({{$product->product_id}})" class="btn btn-buy-now">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right:6px;vertical-align:-2px"><path d="M8 1a2 2 0 0 1 2 2v.017A4 4 0 0 1 12 7v1.5h.5a1 1 0 0 1 1 1V13a1 1 0 0 1-1 1h-9a1 1 0 0 1-1-1V9.5a1 1 0 0 1 1-1H4V7a4 4 0 0 1 2-3.46V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v.05A4.002 4.002 0 0 1 4 7v1.5h8V7a4 4 0 0 0-3-3.874V3a1 1 0 0 0-1-1zm-2.5 9a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/></svg>
                Buy Now
            </button>
        </div>
    </div>
</div>
