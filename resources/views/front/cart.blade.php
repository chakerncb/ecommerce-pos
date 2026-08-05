@extends('front.layouts.master')

@section('content')
</header>
<main>

<!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Cart</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{route('index')}}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{route('cart.store')}}">Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Item Details -->
    <section class="item-details section">
      @livewire('cart-page')
    </section>

</main>
    <!-- End Item Details -->
    @endsection