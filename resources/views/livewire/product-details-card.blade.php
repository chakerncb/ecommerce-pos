@props(['product'])
<div class="product-details-actions-wrapper">
    {{-- Quantity Section --}}
    <div class="qty-selector-container">
        <label class="qty-label">Quantity</label>
        <div class="qty-controls">
            <button type="button" wire:click="decrementQuantity({{$product->product_id}})" class="qty-btn qty-btn-minus" aria-label="Decrease quantity">−</button>
            <span class="qty-val">{{ $quantity[$product->product_id] ?? 1 }}</span>
            <button type="button" wire:click="incrementQuantity({{$product->product_id}})" class="qty-btn qty-btn-plus" aria-label="Increase quantity">+</button>
        </div>
        <div class="qty-stock-info">
            Max. {{ $product->stock ?? 1 }} pcs/shopper
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="details-action-row">
        {{-- Buy Now --}}
        <button wire:click="BuyNow({{$product->product_id}})" class="btn btn-buy-now">
            Buy now
        </button>
        {{-- Add to Cart --}}
        <button wire:click="ToCart({{$product->product_id}})" class="btn btn-atc-details">
            Add to cart
        </button>
    </div>
</div>
