<div class="row">
  {{--  @if (session()->has('message'))
     <div class="alert-message gap-3" role="alert">
        {{session('message')}}
        <span wire:click="deleteMsg()"><b>&#10005;</b></span>
      </div>
    @endif --}}
    @foreach ($products as $product)
     @if ($product->stock != 0) 
     <div class="col-lg-3 col-md-6 col-12">
        {{-- Entire card is clickable; Add to Cart button sits above the overlay --}}
        <div class="single-product product-card-clickable" style="position:relative; cursor:pointer;">
            {{-- Full-card link overlay --}}
            <a href="{{route('product.details', $product->name)}}" class="product-card-overlay-link" aria-label="View {{$product->name}}"></a>

            <div class="product-image">
                <img src="{{ $product->feature_image }}" alt="{{ $product->name }}" />
                <button wire:click.stop="ToCart({{$product->product_id}})" class="btn-atc-icon" title="Add to Cart">
                   <i class="bi bi-cart-plus"></i>
                </button>
            </div>
            <div class="product-info">
                <span class="category">{{$product->category_name}}</span>
                <h4 class="title">
                    <a href="{{route('product.details', $product->name)}}">{{$product->name}}</a>
                </h4>
                <ul class="review">
                    <li><i class="lni lni-star-filled"></i></li>
                    <li><i class="lni lni-star-filled"></i></li>
                    <li><i class="lni lni-star-filled"></i></li>
                    <li><i class="lni lni-star-filled"></i></li>
                    <li><i class="lni lni-star"></i></li>
                    <li><span>4.0 Review(s)</span></li>
                </ul>
                <div class="price">
                    <span>{{$product->price}} {{ $store['site_currency']->payload }}</span>
                </div>
            </div>
        </div>
    </div>
     @endif

    @endforeach
</div>