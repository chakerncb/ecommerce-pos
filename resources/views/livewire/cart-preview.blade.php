<div>
    <a href="#" class="main-btn">
    <!-- <a href="{{route('cart.store')}}" class="main-btn"> -->
        <i class="lni lni-cart"></i>
        <span class="total-items">{{$cartCount}}</span>
    </a>
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{$cartCount}} Items</span>
            <!-- <a href="{{route('cart.store')}}">View Cart</a> -->
    </div>
   <ul class="shopping-list">
        @foreach ($cartItems as $item)
        <li>
            <a wire:click="removefromCart({{$item->id}})" class="remove" title="Remove this item"><i
                    class="lni lni-close"></i></a>
            <div class="cart-img-head">
                <a class="cart-img" href="{{route('product.details', $item->name)}}"><img src="{{ ($item->options->path && filter_var($item->options->path, FILTER_VALIDATE_URL)) ? $item->options->path : URL::asset('assets/src/images/product/no-image.png') }}" alt="{{ $item->name }}"></a>
            </div>

            <div class="content">
                <h4><a href="{{route('product.details', $item->name)}}">{{$item->name}}</a></h4>
                <p class="quantity">{{$item->qty}}x - <span class="amount">{{$item->price}}  {{ $store['site_currency']->payload ?? 'DA' }}</span></p>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="bottom">
        <div class="total">
            <span>Total</span>
            <span class="total-amount">{{$cartTotal}} {{ $store['site_currency']->payload ?? 'DA' }}</span>
        </div>
        <div class="button">
            <a href="{{route('checkout.index')}}" class="btn animate">Checkout</a>
        </div>
    </div>
</div>
