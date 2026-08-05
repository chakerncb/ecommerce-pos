@extends('front.layouts.master')

@section('content')
</header>

@if (session('success'))
<div class="success alert-message">
    {{ session('success') }}
</div>
 @elseif(session('error'))
    <div class="danger alert-message">
        {{ session('error') }}
    </div>
@endif

<!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Checkout Page</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{route('index')}}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{route('cart.store')}}">Checkout Page</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Item Details -->
    <section class="item-details section">
        <div class="container">

            <div class="checkout-container row">
                <div class="col-xl-8">
        
                    <div class="card">
                        <div class="card-body">
                            <ol class="activity-checkout mb-0 px-4 mt-3">
                                <li class="checkout-item">
                                    <div class="avatar checkout-icon p-1">
                                        <div class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bxs-receipt text-white font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="feed-item-list">
                                        <div>
                                            <h5 class="font-size-16 mb-1">Billing Info</h5>
                                            <p class="text-muted text-truncate mb-4">Enter your address info</p>
                                            <div class="mb-3">
                                                <form id="checkout_form">
                                                    @csrf	
                                                    <div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="billing-name">Name</label>
                                                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="billing-name" placeholder="Enter name" value="{{ old('name') }}">
                                                                    @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="billing-email-address">Email Address</label>
                                                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="billing-email-address" placeholder="Enter email" value="{{ old('email') }}">
                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="billing-phone">Phone</label>
                                                                    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="billing-phone" placeholder="Enter Phone no." value="{{ old('phone') }}">
                                                                    @error('phone')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
        
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-address">Address</label>
                                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="billing-address" rows="3" placeholder="Enter full address">{{ old('address') }}</textarea>
                                                            @error('address')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
        
                                                        @livewire('shipping-info')
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="checkout-item">
                                    <div class="avatar checkout-icon p-1">
                                        <div class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bxs-truck text-white font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="feed-item-list">
                                        <div>
                                            <h5 class="font-size-16 mb-1">Shipping Info</h5>
                                            <p class="text-muted text-truncate mb-4">Chose your shipping address</p>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div data-bs-toggle="collapse">
                                                            <label class="card-radio-label mb-0">
                                                                <input type="radio" name="chip_method" value="home" class="card-radio-input" checked="">
                                                                <div class="card-radio text-truncate p-3">
                                                                    <div class="card-radio text-truncate p-3 text-center">
                                                                        <span class="fs-14 mb-4 d-block">Home</span>
                                                                        <img src="{{URL::asset('assets/images/icon/home-delivery.png')}}" alt="" class="mx-auto d-block">
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            @error('chip_method')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
        
                                                    <div class="col-lg-4 col-sm-6">
                                                        <div>
                                                            <label class="card-radio-label mb-0">
                                                                <input type="radio" name="chip_method" value="agency" class="card-radio-input">
                                                                <div class="card-radio text-truncate p-3 text-center">
                                                                    <div class="card-radio text-truncate p-3 text-center">
                                                                        <span class="fs-14 mb-4 d-block">Post Office</span>
                                                                        <img src="{{URL::asset('assets/images/icon/post-office.png')}}" alt="" class="mx-auto d-block">
                                                                    </div>
                                                                </div>
                                                            </label>
                                                            @error('chip_method')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="checkout-item">
                                    <div class="avatar checkout-icon p-1">
                                        <div class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bxs-wallet-alt text-white font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="feed-item-list">
                                        <div>
                                            <h5 class="font-size-16 mb-1">Payment Info</h5>
                                            <p class="text-muted text-truncate mb-4">Select your payment method</p>
                                        </div>
                                        <div>
                                            <h5 class="font-size-14 mb-3">Payment method :</h5>
                                            <div class="row">
                                                <div class="col-lg-3 col-sm-6">
                                                    <div data-bs-toggle="collapse">
                                                        <label class="card-radio-label">
                                                            <input type="radio" name="pay_method" value="card" class="card-radio-input">
                                                            <span class="card-radio py-3 text-center text-truncate">
                                                                <i class="bx bx-credit-card d-block h2 mb-3"></i>
                                                                Credit / Debit Card
                                                            </span>
                                                        </label>
                                                        @error('pay_method')
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <label class="card-radio-label">
                                                            <input type="radio" name="pay_method" value="paypal" class="card-radio-input">
                                                            <span class="card-radio py-3 text-center text-truncate">
                                                                <i class="bx bxl-paypal d-block h2 mb-3"></i>
                                                                Paypal
                                                            </span>
                                                        </label>
                                                        @error('pay_method')
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <label class="card-radio-label">
                                                            <input type="radio" name="pay_method" value="cash" class="card-radio-input" checked="">
        
                                                            <span class="card-radio py-3 text-center text-truncate">
                                                                <i class="bx bx-money d-block h2 mb-3"></i>
                                                                <span>Cash on Delivery</span>
                                                            </span>
                                                        </label>
                                                        @error('pay_method')
                                                            <span class="invalid-feedback d-block" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
        
                    <div class="row my-4">
                        <div class="col">
                            <a href="{{route('index')}}" class="btn btn-link text-muted">
                                <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping </a>
                        </div> <!-- end col -->
                        <div class="col">
                            <div class="text-end mt-2 mt-sm-0">
                                <a id="Procced" class="btn btn-success">
                                    <i class="mdi mdi-cart-outline me-1"></i> Procced 
                                </a>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </form>
                </div>
                <div class="col-xl-4">
                    <div class="card checkout-order-summary">
                        <div class="card-body">
                            <div class="p-3 bg-light mb-3">
                                <h5 class="font-size-16 mb-0">Order Summary <span class="float-end ms-2">#MN0124</span></h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-centered mb-0 table-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0" style="width: 110px;" scope="col">Product</th>
                                            <th class="border-top-0" scope="col">Product Desc</th>
                                            <th class="border-top-0" scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item )
                                        <tr>
                                            <th scope="row"><img src="{{URL::asset('assets/src/images/product/'.$item->options->path)}}" alt="product-img" title="product-img" class="avatar-lg rounded"></th>
                                            <td>
                                                <h5 class="font-size-16 text-truncate"><a href="#" class="text-dark">{{$item->name}}</a></h5>
                                                <p class="text-muted mb-0">
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star-half text-warning"></i>
                                                </p>
                                                <p class="text-muted mb-0 mt-1">{{$item->price}} x {{$item->qty}}</p>
                                            </td>
                                            <td>{{$item->subtotal}}</td>
                                        </tr>
                                        @endforeach

                                        {{-- <tr>
                                            <th scope="row"><img src="https://www.bootdey.com/image/280x280/FF00FF/000000" alt="product-img" title="product-img" class="avatar-lg rounded"></th>
                                            <td>
                                                <h5 class="font-size-16 text-truncate"><a href="#" class="text-dark">Smartphone Dual Camera</a></h5>
                                                <p class="text-muted mb-0">
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                </p>
                                                <p class="text-muted mb-0 mt-1">$ 260 x 1</p>
                                            </td>
                                            <td>$ 260</td>
                                        </tr> --}}
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="font-size-14 m-0">Sub Total :</h5>
                                            </td>
                                            <td>
                                                {{$Cart->subtotal}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="font-size-14 m-0">Discount :</h5>
                                            </td>
                                            <td>
                                                {{$Cart->discount}}
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="font-size-14 m-0">Shipping Charge :</h5>
                                            </td>
                                            <td>
                                                Free
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h5 class="font-size-14 m-0">Estimated Tax :</h5>
                                            </td>
                                            <td>
                                                {{$Cart->tax}}
                                            </td>
                                        </tr>                              
                                            
                                        <tr class="bg-light">
                                            <td colspan="2">
                                                <h5 class="font-size-14 m-0">Total:</h5>
                                            </td>
                                            <td>
                                                {{$Cart->total}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            
        </div>
    </section>
    <!-- End Item Details -->
    @endsection


@section('scripts')
<script>
  $(document).on('click', '#Procced', function(e){
      e.preventDefault();
      var formData = new FormData($('#checkout_form')[0]);

      $.ajax({
          type: "POST",
          url: "{{route('checkout.store')}}",
          data: formData,
          processData: false,
          contentType: false,
          cache: false,
          success: function (response) {
              if(response.url) {
                  window.location.href = response.url;
              } else {
                  alert(response.message);
              }
          },
          error: function (error) {
              if (error.status === 422) {
                  var errors = error.responseJSON.errors;
                  $('.is-invalid').removeClass('is-invalid');
                  $('.invalid-feedback').remove();
                  $.each(errors, function (key, value) {
                      var input = $('[name=' + key + ']');
                      input.addClass('is-invalid');
                      input.after('<div class="invalid-feedback">' + value[0] + '</div>');
                  });
              } else {
                  alert('An error occurred. Please try again.');
              }
          }
      });
  });
</script>
@endsection