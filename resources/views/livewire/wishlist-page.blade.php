<div class="container">
    <div class="top-area">
        <div class="row align-items-center">
                <div class="title">
                    <div class="row">
                        <div class="col"><h4><b>My Wishlist</b></h4></div>
                        <div class="col text-right"><a wire:click="clearWishlist" style="color: #0167F3;"><u>Clear All</u></a></div>
                    </div>
                </div>    
                @foreach ($products as $item )
                    <div class="row border-top border-bottom">
                        <div class="row main align-items-center">
                            @if ($item->images->isNotEmpty())
                            @foreach ($item->images as $image)   
                                <div class="col-4">
                                    <img class="img-fluid" src="{{URL::asset('assets/src/images/product/'.$image->path)}}" alt="Product" />
                                </div>
                                @break
                            @endforeach
                            @else
                                <div class="col-2">
                                    <img class="img-fluid" src="{{URL::asset('assets/src/images/product/no-image.png')}}" alt="Default Product" />
                                </div>
                            @endif
                            <div class="col-6">
                                <div class="row text-muted">{{$item->name}}</div>
                                <div class="row">{{$item->description}}</div>
                            </div>
                            {{-- <div class="col">
                                <a wire:click="decrement('{{$item->id}}')">-</a><a class="border">{{$item->qty}}</a><a wire:click="increment('{{$item->id}}')">+</a>
                            </div> --}}
                            <div class="col">{{$item->price}} DZD
                                <span wire:click="removeFromWishlist({{$item->product_id}})" class="close">&#10005;</span>
                            </div>

                            <div class="col">
                                <button wire:click="ToCart({{$item->product_id}})" class="btn">add To cart</button>
                            </div>

                        </div>
                    </div>
                @endforeach
                <div class="back-to-shop"><a href="{{route('index')}}">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
        </div>
    </div>
</div>