<section class="products-filter-page section">
    <div class="filter-category-card">
        <h3>Filter :</h3>
        <div class="filter-category">
            <br>
            <div class="filter-category-title">
                <h6>by Brand</h6>
            </div>
            <select name="brand" id="brand" class="filter-category-select" wire:model="brandId" wire:change="filter">
                <option value="0">All</option>
                @foreach ($brands as $brand)
                    <option value="{{$brand->brand_id}}">{{$brand->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-category">
            <br>
            <div class="filter-category-title">
                <h6>By Category :</h6>
            </div>
            <select name="category" wire:model="categoryId" id="category" class="filter-category-select" wire:change="filter">
                <option value="0">All</option>
               @foreach ($categories as $category)
                    <option value="{{$category->category_id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-category">
            <br>
            <div class="filter-category-title">
                <h6>Filter By Price :</h6>
            </div>
            <input type="range" class="form-range" min="{{$minPrice}}" max="{{$maxPrice}}" step="100" id="customRange3" wire:model="selectedPrice" wire:change="filter">    
            <div class="price-range">
                <span>${{$minPrice}}</span>
                <span>${{$selectedPrice}}</span>
            </div>     
        </div>
        
    </div>
    <br>
    <div class="container" style="background-color: #ffffff;">
        <div class="row">
            <div class="card-header py-3 flex-column justify-content-between align-items-center"> 
                {{-- <p class="text-primary m-0 fw-bold">products</p> --}}
            </div>
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <div id="dataTable_length" class="dataTables_length" wire:model="paginationNumber" wire:change="filter" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>&nbsp;</label></div>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                </div>
            </div>
            
            @foreach ($products as $product)
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
                                <div class="button">
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
                                    <span>${{$product->price}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach

            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}</p>
                </div>
                <div class="col-md-6">
                    <nav class="justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        {{ $products->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>