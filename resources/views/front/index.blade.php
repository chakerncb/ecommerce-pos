@extends('front.layouts.master')

@section('content')
        <!-- Start Header Bottom -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="nav-inner">
                        <!-- Start Mega Category Menu -->
                        <div class="mega-category-menu">
                            <span class="cat-button"><i class="lni lni-menu"></i>All Categories</span>
                            <ul class="sub-category">
                                @foreach ($categories as $category )
                                <li><a href="{{route('category.index', $category->name)}}">{{$category->name}}</a></li>
                                @endforeach
                                <!-- {{-- <li><a href="product-grids.html">Electronics <i class="lni lni-chevron-right"></i></a>
                                    <ul class="inner-sub-category">
                                        <li><a href="product-grids.html">Digital Cameras</a></li>
                                        <li><a href="product-grids.html">Camcorders</a></li>
                                        <li><a href="product-grids.html">Camera Drones</a></li>
                                        <li><a href="product-grids.html">Smart Watches</a></li>
                                        <li><a href="product-grids.html">Headphones</a></li>
                                        <li><a href="product-grids.html">MP3 Players</a></li>
                                        <li><a href="product-grids.html">Microphones</a></li>
                                        <li><a href="product-grids.html">Chargers</a></li>
                                        <li><a href="product-grids.html">Batteries</a></li>
                                        <li><a href="product-grids.html">Cables & Adapters</a></li>
                                    </ul>
                                </li>
                                <li><a href="product-grids.html">accessories</a></li>
                                <li><a href="product-grids.html">Televisions</a></li>
                                <li><a href="product-grids.html">best selling</a></li>
                                <li><a href="product-grids.html">top 100 offer</a></li>
                                <li><a href="product-grids.html">sunglass</a></li>
                                <li><a href="product-grids.html">watch</a></li>
                                <li><a href="product-grids.html">man’s product</a></li>
                                <li><a href="product-grids.html">Home Audio & Theater</a></li>
                                <li><a href="product-grids.html">Computers & Tablets </a></li>
                                <li><a href="product-grids.html">Video Games </a></li>
                                <li><a href="product-grids.html">Home Appliances </a></li>
                                 --}} -->
                            </ul>
                        </div>
                        <!-- End Mega Category Menu -->
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a href="{{route('index')}}" class="active" aria-label="Toggle navigation">Home</a>
                                    </li>
                                    <li class="nav-item mobile-categories">
                                        <a class="dd-menu collapsed" href="#" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">Categories</a>
                                        <ul class="sub-menu collapse" id="submenu-1-2">
                                            @foreach ($categories as $category )
                                            <li><a href="{{route('category.index', $category->name)}}">{{$category->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <!-- {{-- <li class="nav-item">
                                        <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-3" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">Shop</a>
                                        <ul class="sub-menu collapse" id="submenu-1-3">
                                            <li class="nav-item"><a href="product-grids.html">Shop Grid</a></li>
                                            <li class="nav-item"><a href="product-list.html">Shop List</a></li>
                                            <li class="nav-item"><a href="product-details.html">shop Single</a></li>
                                            <li class="nav-item"><a href="cart.html">Cart</a></li>
                                            <li class="nav-item"><a href="checkout.html">Checkout</a></li>
                                        </ul>
                                    </li> --}}
                                    {{-- <li class="nav-item">
                                        <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-4" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">Blog</a>
                                        <ul class="sub-menu collapse" id="submenu-1-4">
                                            <li class="nav-item"><a href="blog-grid-sidebar.html">Blog Grid Sidebar</a>
                                            </li>
                                            <li class="nav-item"><a href="blog-single.html">Blog Single</a></li>
                                            <li class="nav-item"><a href="blog-single-sidebar.html">Blog Single
                                                    Sibebar</a></li>
                                        </ul>
                                    </li> --}} -->
                                    <li class="nav-item">
                                        <a href="{{route('shop.index')}}" aria-label="Toggle navigation">Shop</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" aria-label="Toggle navigation">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" aria-label="Toggle navigation">Contact Us</a>
                                    </li>
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav>
                        <!-- End Navbar -->
                    </div>
                </div>

                <div class="social-container col-lg-4 col-md-6 col-12">
                    <div class="nav-social">
                        <h5 class="title">Follow Us:</h5>
                        <ul>
                            <li class="mt-2">
                                <a href="https://www.facebook.com/profile.php?id=61575759597035"><i class="lni lni-facebook-filled"></i></a>
                            </li>
                            <!-- <li class="mt-2">
                                <a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                            </li> -->
                            <li class="mt-2">
                                <a href="javascript:void(0)"><i class="lni lni-instagram"></i></a>
                            </li>
                            <!-- <li class="mt-2">
                                <a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                            </li> -->
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Header Bottom -->
    </header>
    <!-- End Header Area -->

    <!-- Start Hero Area -->
    <section class="hero-area">
        <div class="container pubs-container">
            <!-- {{-- <div class="row slider-row"> --}}
                {{-- <div class="col-lg-8 col-12 custom-padding-right"> --}}  -->
                    <div class="slider-head">
                        <!-- Start Hero Slider -->
                        <div class="hero-slider">

                            <!-- Start Banner Slide (always first) -->
                            <div class="single-slider single-slider--banner"
                                style="background-image: URL('{{ URL::asset('assets/banner.png') }}');">
                                {{-- SVG wave background decoration --}}
                                <svg class="hero-svg-bg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 650" preserveAspectRatio="none" aria-hidden="true">
                                    <path d="M0,200 C360,320 720,80 1440,250 L1440,650 L0,650 Z" fill="rgba(255,255,255,0.06)"/>
                                    <path d="M0,350 C400,200 900,450 1440,300 L1440,650 L0,650 Z" fill="rgba(255,255,255,0.04)"/>
                                </svg>
                                <div class="content content--banner">
                                    <div class="button">
                                        <a href="{{ route('shop.index') }}" class="btn btn-hero">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Banner Slide -->

                            @if(isset($trendingProducts) && count($trendingProducts) > 0)
                                @foreach ($trendingProducts as $product)
                                    @php
                                        $hasImg = !empty($product->feature_image);
                                        $currentPrice = $product->price;
                                        $discount = $product->discount ?? 0;
                                        $originalPrice = $discount > 0 ? round($currentPrice / (1 - $discount / 100), 2) : null;
                                        $categoryLabel = $product->category->name ?? strtoupper(substr($product->name, 0, 8));
                                    @endphp
                                    <!-- Start Product Slide -->
                                    <div class="single-slider single-slider--product">

                                        <div class="tp-banner">
                                            {{-- Left: copy --}}
                                            <div class="tp-copy">
                                                <span class="tp-eyebrow">Trending now</span>
                                                <h2 class="tp-title">{{ $product->name }}</h2>
                                                <div class="tp-price-row">
                                                    @if($originalPrice)
                                                        <span class="tp-price-old">{{ number_format($originalPrice, 2) }} {{ $store['site_currency']->payload ?? 'DA' }}</span>
                                                    @endif
                                                    <span class="tp-price-new">{{ number_format($currentPrice, 2) }}<sup>{{ $store['site_currency']->payload ?? 'DA' }}</sup></span>
                                                </div>
                                                <a href="{{ route('product.details', $product->name) }}" class="tp-cta">
                                                    Shop now
                                                    <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </a>
                                            </div>

                                            {{-- Right: hang tag --}}
                                            <div class="tp-tag-wrap">
                                                <div class="tp-perforation"></div>
                                                <div class="tp-tag">
                                                    @if($hasImg)
                                                        <img src="{{ $product->feature_image }}" alt="{{ $product->name }}">
                                                    @else
                                                        {{-- Placeholder with product initials --}}
                                                        <div class="tp-tag-placeholder">
                                                            <span>{{ strtoupper(substr($product->name, 0, 2)) }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="tp-tag-label">{{ $categoryLabel }}</div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End Product Slide -->
                                @endforeach
                            @endif

                        </div>
                        <!-- End Hero Slider -->
                    </div>
                <!-- {{-- </div> --}}
                {{-- <div class="col-lg-4 col-12"> --}}
                    {{-- <div class="row"> --}}
                        {{-- <div class="col-lg-12 col-md-6 col-12 md-custom-padding"> --}}
                            {{-- <div class="hero-small-banner"
                                style="background-image: URL({{URL::asset('assets/images/hero/slider-bnr.jpg')}});">
                                <div class="content">
                                    <h2>
                                        <span>New line required</span>
                                        iPhone 12 Pro Max
                                    </h2>
                                    <h3>$259.99</h3>
                                </div>
                            </div> --}} -->
                            <!-- End Small Banner -->
                        <!-- {{-- </div> --}}
                        {{-- <div class="col-lg-12 col-md-6 col-12"> --}} -->
                            <!-- Start Small Banner -->
                            <!-- {{-- <div class="hero-small-banner style2">
                                <div class="content">
                                    <h2>Weekly Sale!</h2>
                                    <p>Saving up to 50% off all online store items this week.</p>
                                    <div class="button">
                                        <a class="btn" href="product-grids.html">Shop Now</a>
                                    </div>
                                </div>
                            </div> --}} -->
                            <!-- Start Small Banner -->
                        <!-- {{-- </div> --}}
                    {{-- </div> --}}
                {{-- </div> --}}
            {{-- </div> --}} -->
        </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Trending Product Area -->
    <section class="trending-product section" style="margin-top: 12px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Product</h2>
                        <p>Discover the latest trends in our collection, carefully curated to bring 
                            you the best in style and quality.</p>
                    </div>
                </div>
            </div>
               @livewire('product-card')
        </div>

        <!-- {{-- Browse All CTA --}} -->
        <div class="trending-cta-wrap">
            <a href="{{ route('shop.index') }}" class="trending-cta-btn" id="browse-all-products">
                Browse All Products
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                </svg>
            </a>
        </div>

    </section>
    <!-- End Trending Product Area -->

    <!--  Start Call Action Area -->
    <!-- <section class="call-action section">
        <div class="container">
            <div class="row ">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="inner">
                        <div class="content">
                            <h2 class="wow fadeInUp" data-wow-delay=".4s">Currently You are using free<br>
                                Lite version of ShopGrids</h2>
                            <p class="wow fadeInUp" data-wow-delay=".6s">Please, purchase full version of the template
                                to get all pages,<br> features and commercial license.</p>
                            <div class="button wow fadeInUp" data-wow-delay=".8s">
                                <a href="javascript:void(0)" class="btn">Purchase Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- End Call Action Area --> 

    <!-- Start Banner Area -->
    <!-- <section class="banner section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner" style="background-image:url({{URL::asset('assets/images/banner/banner-1-bg.jpg')}})">
                        <div class="content">
                            <h2>Smart Watch 2.0</h2>
                            <p>Space Gray Aluminum Case with <br>Black/Volt Real Sport Band </p>
                            <div class="button">
                                <a href="product-grids.html" class="btn">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner custom-responsive-margin"
                        style="background-image:url({{URL::asset('assets/images/banner/banner-2-bg.jpg')}})">
                        <div class="content">
                            <h2>Smart Headphone</h2>
                            <p>Lorem ipsum dolor sit amet, <br>eiusmod tempor
                                incididunt ut labore.</p>
                            <div class="button">
                                <a href="product-grids.html" class="btn">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- End Banner Area -->

    <!-- Start Shipping Info -->
    <section class="shipping-info">
        <div class="container">
            <ul>
                <!-- Free Shipping -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>Free Shipping</h5>
                        <span>On order over 1000 {{ $store['site_currency']->payload ?? 'DZD' }}</span>
                    </div>
                </li>
                <!-- Money Return -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>24/7 Support.</h5>
                        <span>Live Chat Or Call.</span>
                    </div>
                </li>
                <!-- Support 24/7 -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment.</h5>
                        <span>Secure Payment Services.</span>
                    </div>
                </li>
                <!-- Safe Payment -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-reload"></i>
                    </div>
                    <div class="media-body">
                        <h5>Easy Return.</h5>
                        <span>Hassle Free Shopping.</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- End Shipping Info -->

    @endsection

    