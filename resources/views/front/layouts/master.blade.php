<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ $store['site_name']->payload ?? 'ChakerShop' }}</title>
    {{-- <link rel="icon" href="{{URL::asset('assets/images/logo/icon-2.png')}}"> --}}
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('assets/images/logo/icon-2.png')}}" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/LineIcons.3.0.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/tiny-slider.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/glightbox.min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/main.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" >
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
     @livewireStyles

</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            {{-- <div class="preloader-icon">
                <span></span>
                <span></span>
            </div> --}}
            <img style="width: 100%;" src="{{URL::asset('/storage/' . ($store['site_logo']->payload ?? 'assets/images/logo/preloader.gif'))}}" alt="">
        </div>
    </div>
    <!-- /End Preloader -->

    @if (session('success'))
        <div class="success alert-message">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="danger alert-message">
            {{ session('error') }}
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alertMessages = document.querySelectorAll('.alert-message');
                alertMessages.forEach(function(alert) {
                    alert.style.display = 'none';
                });
            }, 3000);
        });
    </script>



    <!-- Start Header Area --> 
    <header class="header navbar-area">
                <!-- Start Header Middle -->
                <div class="header-middle sticky-top fixed-top">
                    <div class="container">
                        <div class="row align-items-center" style="border-bottom: 1px solid #ebebeb; justify-content: space-between; border-bottom: none !important">
                            <a href="{{route('index')}}" class="col-lg-2 col-md-1 col-7">
                                <!-- Start Header Logo -->
                                    <img style="width: 200px; max-width: 200px; height: auto;"
                                     src="{{URL::asset('/storage/' . ($store['site_logo']->payload ?? 'logo.png'))}}" alt="Logo">
                                <!-- End Header Logo -->
                            </a>

                            <div class=" col-lg-5 col-md-4 ">
                            @livewire('SearchBar')   
                            </div>                         

                            <div class="col-lg-4 col-md-2 col-5 mobile-header-actions">
                                {{-- <div class="mobile-searchBar ">
                                    @livewire('SearchBar')
                                </div> --}}
                                <div class="middle-right-area">
                                    <div class="nav-hotline">
                                        <i class="lni lni-phone"></i>
                                        <h3>Hotline:
                                            <span>{{ $store['site_phone']->payload ?? '' }}</span>
                                        </h3>
                                    </div>
                                    <div class="navbar-cart">

                                     <!-- <div class="wishlist">
                                            <a href="javascript:void(0)">
                                                <i class="lni lni-heart"></i>
                                                <span class="total-items">0</span>
                                            </a> 
                                        </div> -->


                                        

                                        <div class="m-2 cart-items">
                                            @livewire('cart-preview')
                                            </div>
                                        </div>

                                        <div class="m-2">
                                               

                                            <!-- <div class="account-dropdown">
                                                <div>
                                                    <button class="account-icon">
                                                        <i class="lni lni-user"></i>
                                                      </button>
                                                </div>
                                          <div class="account-dropdown-content"> -->

                                            <!-- @guest

                                            <div class="account-items">
                                                
                                                @if (Route::has('login'))
                                                        <a class="account-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                                                @endif
                                                 @if (Route::has('register'))
                                                        <a class="account-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                                @endif 
                                            </div>
                                          
    
                                            @else

                                            <div class="header">
                                              <h4>{{ Auth::user()->name }}</h4>
                                              <p>{{ Auth::user()->email }}</p>
                                            </div>
                                            <div class="account-switch1">
                                              <p><b>Switch mode :</b></p>
                                            <div class="account-switch-mode">
                                              <div class="account-toggle-mode">
                                                <button class="light-btn" onclick="setLightMode()"><img src="{{URL::asset('assets/images/header/light-theme.png')}}" alt="dark"></button>
                                                <span>light</span>
                                              </div>
                                              <div class="account-toggle-mode">
                                              <button class="dark-btn" onclick="setDarkMode()"><img src="{{URL::asset('assets/images/header/dark-theme.png')}}" alt="light"></button>
                                              <span>dark</span>
                                            </div>
                                            </div>
                                            </div>
                                            <div class="account-items">
                                                <a class="account-item" href="{{route('wishlist.index')}}"><p><b><i class="bi bi-heart"></i>  wishlist</b></p></a>
                                                <a class="account-item" href="#"><p><b><i class="bi bi-credit-card"></i>  cards</b></p></a>
                                                <a class="account-item" href="#"><p><b><i class="bi bi-gear-wide-connected"></i>  setting</b></p></a>

                                                
                                            </div>
                                            <div class="account-get-app">
                                              <p><b>Get the app:</b></p>
                                              <div class="account-store">
                                                <a href="#">  <i class="bi bi-google-play"></i> G-play</a>
                                                <a href="#"><i class="bi bi-apple"></i> App-store</a>
                                              </div>
                                            </div>
                                          </div>
                                        
                                        </div>
                                        @endguest -->
                                        </div> 

                                        
                                        

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Header Middle -->
    
        @yield('content')

        <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="footer-logo">
                                <a href="{{route('index')}}">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12">
                            <div class="footer-newsletter">
                                <h4 class="title">
                                    Subscribe to our Newsletter
                                    <span>Get all the latest information, Sales and Offers.</span>
                                </h4>
                                <div class="newsletter-form-head">
                                    <form action="#" method="get" target="_blank" class="newsletter-form">
                                        <input name="EMAIL" placeholder="Email address here..." type="email">
                                        <div class="button">
                                            <button class="btn">Subscribe<span class="dir-part"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->
        <!-- Start Footer Middle -->
<!--        
        <div class="footer-middle">
            <div class="container">
                <div class="bottom-inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="single-footer f-contact">
                                <h3>Get In Touch With Us</h3>
                                @if(!empty($store['site_phone']->payload ?? null))
                                    <p class="phone">Phone: {{ $store['site_phone']->payload }}</p>
                                @endif
                                <ul>
                                    <li><span>Monday-Friday: </span> 9.00 am - 8.00 pm</li>
                                    <li><span>Saturday: </span> 10.00 am - 6.00 pm</li>
                                </ul>
                                @if(!empty($store['site_email']->payload ?? null))
                                    <p class="mail">
                                        <a href="mailto:{{ $store['site_email']->payload }}">{{ $store['site_email']->payload }}</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="single-footer our-app">
                                <h3>Our Mobile App</h3>
                                <ul class="app-btn">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="lni lni-apple"></i>
                                            <span class="small-title">Download on the</span>
                                            <span class="big-title">App Store</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="lni lni-play-store"></i>
                                            <span class="small-title">Download on the</span>
                                            <span class="big-title">Google Play</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="single-footer f-link">
                                <h3>Information</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">About Us</a></li>
                                    <li><a href="javascript:void(0)">Contact Us</a></li>
                                    <li><a href="javascript:void(0)">Downloads</a></li>
                                    <li><a href="javascript:void(0)">Sitemap</a></li>
                                    <li><a href="javascript:void(0)">FAQs Page</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="single-footer f-link">
                                <h3>Shop Departments</h3>
                                <ul>
                                    <li><a href="javascript:void(0)">Computers & Accessories</a></li>
                                    <li><a href="javascript:void(0)">Smartphones & Tablets</a></li>
                                    <li><a href="javascript:void(0)">TV, Video & Audio</a></li>
                                    <li><a href="javascript:void(0)">Cameras, Photo & Video</a></li>
                                    <li><a href="javascript:void(0)">Headphones</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div> -->

        <!-- End Footer Middle -->
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="inner-content">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-12">
                            <div class="payment-gateway">
                                <span>We Accept:</span>
                                <img src="assets/images/footer/credit-cards-footer.png" alt="#">
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="copyright">
                                <p>Designed and Developed by<a href="https://www.linkedin.com/in/chaker-necibi" rel="nofollow"
                                        target="_blank">Chaker Necibi</a></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <ul class="socila">
                                <li>
                                    <span>Follow Us On:</span>
                                </li>
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    @livewireScripts
    <script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/tiny-slider.js')}}"></script>
    <script src="{{URL::asset('assets/js/glightbox.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/main.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    <x-livewire-alert::flash />
    @yield('scripts')
    <script type="text/javascript">
        //========= Hero Slider 
        tns({
            container: '.hero-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        });

        //======== Brand Slider
        tns({
            container: '.brands-logo-carousel',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 6,
                }
            }
        });
        
    </script>
</body>

</html>