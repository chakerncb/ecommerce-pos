<div class="container">
    <div class="cart-container">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col"><h4><b>Shopping Cart</b></h4></div>
                    <div class="col text-right"><a wire:click="clearCart" style="color: #0167F3;"><u>Clear All</u></a></div>
                </div>
            </div>    
            @if ($cartCount == 0)
            <div class="row border-top border-bottom">
                <div class="row main text-center">
                    <h4 class="text-muted" >No Items</h4>
                </div>
            </div>
            @endif
            @foreach ($cartItems as $item )
                <div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2"><img class="img-fluid" src="{{URL::asset('assets/src/images/product/'.$item->options->path)}}"></div>
                        <div class="col item-name">
                            <div class="row text-muted">{{$item->name}}</div>
                            <div class="row">{{$item->description}}</div>
                        </div>
                        <div class="col">
                            <a wire:click="decrement('{{$item->rowId}}')">-</a><a class="border">{{$item->qty}}</a><a wire:click="increment('{{$item->rowId}}')">+</a>
                        </div>
                        <div class="col">{{$item->price}} DA<span wire:click="removefromCart({{$item->id}})" class="close">&#10005;</span></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-4 summary">
            <div><h5><b>Summary</b></h5></div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0;">{{$cartCount}} Items</div>
                <div class="col text-right">{{$cartTotal}} DA</div>
            </div>
            <form>
                <p>SHIPPING</p>
                <p>GIVE CODE</p>
                <input id="code" placeholder="Enter your code">
            </form>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">TOTAL PRICE</div>
                <div class="col text-right">{{$cartTotal}} DA</div>
            </div>
            <a href="{{route('checkout.index')}}" class="btn">CHECKOUT</a>
        </div>
    </div>
    <div class="back-to-shop"><a href="{{route('index')}}">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
</div>