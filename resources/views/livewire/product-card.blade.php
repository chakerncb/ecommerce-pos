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
        <div class="single-product">
            <div class="product-image">
                @if ($product->images->isNotEmpty())
                    @foreach ($product->images as $image)   
                        <img src="{{URL::asset('assets/src/images/product/'.$image->path)}}" alt="Product" />
                        @break
                    @endforeach
                @else
                    <img src="{{URL::asset('assets/src/images/product/no-image.png')}}" alt="Default Product" />
                @endif
                 <div class="button" >
                    <button wire:click="ToCart({{$product->product_id}})" class="btn"><i class="lni lni-cart"></i> Add To Cart</button>
                </div>
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
                    <span>{{$product->price}} DA</span>
                </div>
            </div>
        </div>
    </div>
     @endif

    @endforeach
</div>