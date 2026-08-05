<div>
    <!-- Start Main Menu Search -->
    <div class="main-menu-search"> 
        <!-- navbar search start -->
        <div class="navbar-search search-style-5">
             <div class="search-select">
                <div class="dropdown show">
                    <a class="m-2" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="lni lni-world"></i>
                    </a>
                    <div class="dropdown-menu p-2" aria-labelledby="dropdownMenuLink">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="search-input">
                <input type="text" wire:keydown.enter="searchGo" placeholder="Search ..." wire:model="searchContent" wire:keydown.debounce.300ms="search"/>
            </div>
            <div class="search-btn">
                <button wire:click="searchGo"><i class="lni lni-search-alt"></i></button>
            </div>
            @if ($products)
            <div class="search-result-card">
                <div class="card-body">
                    @foreach ($products as $result)
                        <a href="{{route('product.details', $result->name)}}" style="color: black;">
                            <div class="list border-bottom">
                                <img src="{{ URL::asset('assets/src/images/product/' . $result->images->first()->path) }}" alt="Product" />
                                <div class="d-flex flex-column ml-3">
                                  <span>{{ $result->name }}</span> 
                                  <a href=""><small>{{ $result->category_name }}</small></a>
                                </div>                   
                              </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <!-- navbar search Ends -->
    </div>
    <!-- End Main Menu Search -->
</div>