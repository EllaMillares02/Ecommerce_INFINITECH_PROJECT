<!DOCTYPE html>
<html lang="zxx">

<head>
    <base href="/public">
    <link rel="shortcut icon" href="home/favicon.ico"> 
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Craftee | Ecommerce</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    
    <!-- Css Styles -->
    <link rel="stylesheet" href="home/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="home/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="home/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/style.css" type="text/css">

</head>

    @include('home.header')
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All Categories</span>
                        </div>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="{{ route('category.products', $category->category_name) }}">{{$category->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <div class="hero__search__form"> 
                                <form action="{{ route('search_page') }}" method="GET">
                                    <input type="text" name="query" placeholder="What do you need?" required>
                                    <button type="submit" class="site-btn">SEARCH</button>
                                </form>
                            </div>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+63 907 375 9234</h5>
                            <span>available 8:00am-5:00pm</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Craftee Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item d-none d-md-block">
                            <h4>Department</h4>
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('category.products', $category->category_name) }}">{{$category->category_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                       
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Pink
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">

                                    @php $counter = 0; @endphp
                                    <div class="latest-prdouct__slider__item">
                                        @foreach($latestProducts as $product)
                                            <a href="#" class="latest-product__item">
                                                <div class="latest-product__item__pic">
                                                    <img src="{{ asset('product/' . $product->image) }}" alt="{{ $product->title }}">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{ $product->title }}</h6>
                                                    <span>₱{{ number_format($product->price, 2) }}</span>
                                                </div>
                                            </a>
                                            @php $counter++; @endphp
                                            @if($counter % 3 == 0 && !$loop->last)
                                                </div>
                                                <div class="latest-prdouct__slider__item">
                                            @endif
                                    @endforeach
            
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">

                            @foreach ($onSaleProd as $sale)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="product/{{$sale->product->image}}" ondblclick="redirectToProduct('{{ url('product_details', $sale->product->id) }}')">

                                            @php
                                                // Ensure sizes is not null before calling sum()
                                                $totalStock = optional($sale->product->sizes)->sum('stock_quantity') ?? 0;
                                            @endphp

                                            @if($totalStock > 0)
                                                <label class="stock">In Stock</label>
                                            @else
                                                <label class="stock bg-danger">Out of Stock</label>
                                            @endif

                                            <div class="product__discount__percent">-{{(int)$sale->discount}}%</div>
                                            <ul class="product__item__pic__hover">
                                                <li>
                                                    <form action="{{url('add_wishlist',$sale->product->id)}}" method="Post">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $sale->id }}">
                                                        <input type="hidden" name="product_name"  value="{{ $sale->title }}">
                                                        <input type="hidden" name="product_price"  value="{{ $sale->price }}">
                                                        
                                                        <button type="submit" class="icon-button" value="1" name="quantity">
                                                            <i class="fa fa-heart"></i>
                                                        </button>
                                                    </form>
                                                  </li>
                                                  <li>
                                                    <form action="{{ url('/checkout') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="image" value="/product/{{ $sale->product->image }}">
                                                        <input type="hidden" name="product_id" value="{{ $sale->id }}">
                                                        <input type="hidden" name="productName" value="{{ $sale->title }}">
                                                        <input type="hidden" name="product_price" value="{{ $sale->price }}">
                                                        <button type="submit" class="icon-button" value="1" name="quantity">
                                                            <i><b>BUY</b></i></a></li>
                                                        </button>
                                                    </form>
                                                <li>
                                                <li>
                                                    <form action="{{url('add_cart',$sale->product->id)}}" method="Post">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $sale->id }}">
                                                        <input type="hidden" name="product_name"  value="{{ $sale->title }}">
                                                        <input type="hidden" name="product_price"  value="{{ $sale->price }}">
                    
                                                        <button type="submit" class="icon-button" value="1" name="quantity">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                            
                                        </div>

                                        @php
                                            $originalPrice = $sale->price; 
                                            $discount = $sale->discount; 
                                            $discounted_price = $originalPrice - ($originalPrice * ($discount / 100));
                                        @endphp

                                        <div class="product__discount__item__text">
                                            <h5><a href="#">{{$sale->title}}</a></h5>
                                            <div class="product__item__price"> ₱{{ number_format($discounted_price, 2) }} 
                                                <span> ₱{{ number_format($sale->product->price, 2) }}</span></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                

                    <div class="filter__item">

                        <div class="section-title product__discount__title">
                            <h2>Our Products</h2>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="default">Default</option>
                                        <option value="price_asc">Price: Low to High</option>
                                        <option value="price_desc">Price: High to Low</option>
                                        <option value="rating_desc">Rating: High to Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ $productCount }}</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2" id="grid-view" title="Grid View"></span>
                                    <span class="icon_ul" id="list-view" title="List View"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="product-container" >

                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="product/{{$product->image}}" ondblclick="redirectToProduct('{{ url('product_details', $product->id) }}')">

                                    <div class="overlay" id="cart-overlay-{{ $product->id }}"  style="display: none;">
                                        <form action="{{ url('add_cart', $product->id) }}" method="POST">
                                            @csrf
                        
                                            @if($product->flavors && $product->flavors->isNotEmpty())
                                                <div class="flavors-section">
                                                    <label>Select a Color:</label>
                                                    <div class="flavors-buttons">
                                                        @foreach($product->flavors as $index => $flavor)
                                                            <label class="flavor-option">
                                                                <input type="radio" name="selected_flavor" value="{{ $flavor->id }}" {{ $index === 0 ? 'checked' : '' }} 
                                                                onclick="showSizesForFlavor({{ $flavor->id }})" required="">
                                                                <span>{{ $flavor->name }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            @if($product->sizes && $product->sizes->isNotEmpty())
                                                <div class="sizes-section">
                                                    <label>Select a Size:</label>
                                                    <div class="sizes-buttons">
                                                        @foreach($product->flavors as $flavorIndex => $flavor)
                                                            <div class="flavor-sizes" id="sizes-for-flavor-{{ $flavor->id }}" 
                                                                style="display: {{ $flavorIndex === 0 ? 'block' : 'none' }};">
                                                                @foreach($flavor->sizes as $sizeIndex => $size)
                                                                    <label class="size-option">
                                                                        <input type="radio" name="selected_size" value="{{ $size->id }}" 
                                                                            data-price="{{ $size->price }}"
                                                                            onclick="updateProductInfo('{{ $product->id }}', '{{ $product->title }}', '{{ $flavor->name }}', '{{ $size->size }}', {{ $size->price }})" 
                                                                            {{ $flavorIndex === 0 && $sizeIndex === 0 ? 'checked' : '' }} required="">
                                                                        <span>{{ $size->size }}</span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="product_name" id="product-name-{{ $product->id }}" value="">
                                            <input type="hidden" name="product_price" id="product-price-{{ $product->id }}" value="">
                                        
                                            <input type="hidden" name="quantity" value="1" min="1">
                                                <input type="submit" class="btn btn-warning btn-sm mt-2" value="ADD TO CART">
                                                <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="hideOverlay(this)">Cancel</button>
                                            </form>
                                        
                                    </div>


                                    <div class="overlay" id="wishlist-overlay-{{ $product->id }}" style="display: none;">
                                        <form action="{{ url('add_wishlist', $product->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="product_name" id="wishlist-product-name-{{ $product->id }}" value="">
                                            <input type="hidden" name="product_price" id="wishlist-product-price-{{ $product->id }}" value="">
                        
                                            @if($product->flavors && $product->flavors->isNotEmpty())
                                                <div class="flavors-section">
                                                    <label>Select a Color:</label>
                                                    <div class="flavors-buttons">
                                                        @foreach($product->flavors as $index => $flavor)
                                                            <label class="flavor-option">
                                                                <input type="radio" name="selected_flavor" value="{{ $flavor->id }}" {{ $index === 0 ? 'checked' : '' }} 
                                                                onclick="showSizesForFlavor({{ $flavor->id }})" required="">
                                                                <span>{{ $flavor->name }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            @if($product->sizes && $product->sizes->isNotEmpty())
                                                <div class="sizes-section">
                                                    <label>Select a Size:</label>
                                                    <div class="sizes-buttons">
                                                        @foreach($product->flavors as $flavorIndex => $flavor)
                                                            <div class="flavor-sizes" id="wish-sizes-for-flavor-{{ $flavor->id }}" 
                                                                style="display: {{ $flavorIndex === 0 ? 'block' : 'none' }};">
                                                                @foreach($flavor->sizes as $sizeIndex => $size)
                                                                    <label class="size-option">
                                                                        <input type="radio" name="selected_size" value="{{ $size->id }}" 
                                                                            data-price="{{ $size->price }}"
                                                                            onclick="updateProductInfoForWishlist('{{ $product->id }}', '{{ $product->title }}', '{{ $flavor->name }}', '{{ $size->size }}', {{ $size->price }})" 
                                                                            {{ $flavorIndex === 0 && $sizeIndex === 0 ? 'checked' : '' }} required="">
                                                                        <span>{{ $size->size }}</span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            <input type="hidden" name="quantity" value="1" min="1">

                                            <input type="submit" class="btn btn-warning btn-sm mt-2" value="ADD TO WISHLIST">
                                                <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="hideOverlay(this)">Cancel</button>
                                            </form>
                                        </div>

                                        <div class="overlay" id="buy-overlay-{{ $product->id }}" style="display: none;">
                                            <form action="{{ url('/checkout') }}" method="POST" >
                                                @csrf
                                                <input type="hidden" name="quantity" value="1" min="1">
                                                <input type="hidden" name="image" value="/product/{{ $product->image }}">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="productName" id="buy-product-name-{{ $product->id }}" value="">
                                                <input type="hidden" name="product_price" id="buy-product-price-{{ $product->id }}" value="">
                                                
                                                            @if($product->flavors && $product->flavors->isNotEmpty())
                                                                <div class="flavors-section">
                                                                    <label>Select a Color:</label>
                                                                    <div class="flavors-buttons">
                                                                        @foreach($product->flavors as $index => $flavor)
                                                                            <label class="flavor-option">
                                                                                <input type="radio" name="selected_flavor" value="{{ $flavor->id }}" {{ $index === 0 ? 'checked' : '' }} 
                                                                                onclick="showSizesForFlavor({{ $flavor->id }})" required="">
                                                                                <span>{{ $flavor->name }}</span>
                                                                            </label>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                
                                                            @if($product->sizes && $product->sizes->isNotEmpty())
                                                                <div class="sizes-section">
                                                                    <label>Select a Size:</label>
                                                                    <div class="sizes-buttons">
                                                                        @foreach($product->flavors as $flavor)
                                                                            <div class="flavor-sizes" id="buy-sizes-for-flavor-{{ $flavor->id }}" style="display: none;">
                                                                                @foreach($flavor->sizes as $size)
                                                                                    <label class="size-option">
                                                                                        <input type="radio" name="selected_size" value="{{ $size->id }}" data-price="{{ $size->price }}"
                                                                                        onclick="updateProductInfoForBuy('{{ $product->id }}', '{{ $product->title }}', '{{ $flavor->name }}', '{{ $size->size }}', {{ $size->price }})" required="">
                                                                                        <span>{{ $size->size }}</span>
                                                                                    </label>
                                                                                @endforeach
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endif
                
                                                <input type="submit" class="btn btn-warning btn-sm mt-2" value="BUY NOW">
                                                    <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="hideOverlay(this)">Cancel</button>
                                                </form>
                                            </div>
                                    
                                        @php
                                            // Ensure sizes is not null before calling sum()
                                            $totalStock = optional($product->sizes)->sum('stock_quantity') ?? 0;
                                        @endphp
                                        
                                        @if($totalStock > 0)
                                            <label class="stock">In Stock</label>
                                        @else
                                            <label class="stock bg-danger">Out of Stock</label>
                                        @endif
                                        
                                        

                                    <ul class="product__item__pic__hover">

                                        <li>
                                            <button type="button" class="icon-button" onclick="showOverlay('wishlist', {{ $product->id }})">
                                                <i class="fa fa-heart"></i>
                                            </button> 
                                        </li>

                                        <li>
                                            <button type="button" class="icon-button" onclick="showOverlay('buy', {{ $product->id }})">
                                                <i><b>BUY</b></i></a></li>
                                            </button>
                                        <li>

                                        <li>
                                            <button type="button" class="icon-button" onclick="showOverlay('cart', {{ $product->id }})">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>                                           
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{$product->title}}</a></h6>

                                    @if($product->discount_price!=null)
                                        <h5>₱{{$product->discount_price}}</h5>

                                        <h5 style="text-decoration: line-through; color: gray;">₱{{$product->price}}</h5>

                                        @else
                                            <h5 id="product-price-change-{{ $product->id }}">₱{{ $product->price }}</h5>
                                            <h5>&nbsp;</h5>
                                    @endif
  
                                </div>
                            </div>
                        </div>

                    @endforeach

                    </div>
                    
                        {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
                 
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    
    
    @include('home.footer')

    <!-- Js Plugins -->
    <script src="home/js/jquery-3.3.1.min.js"></script>
    <script src="home/js/bootstrap.min.js"></script>
    <script src="home/js/jquery.nice-select.min.js"></script>
    <script src="home/js/jquery-ui.min.js"></script>
    <script src="home/js/jquery.slicknav.js"></script>
    <script src="home/js/mixitup.min.js"></script>
    <script src="home/js/owl.carousel.min.js"></script>
    <script src="home/js/main.js"></script>
    <script>
       // Function to show the overlay for the product
       function showOverlay(type, productId) {
        document.body.style.overflow = 'hidden';
    // Find the overlay element based on type and productId
    const overlay = document.getElementById(`${type}-overlay-${productId}`);
    
    // Check if the overlay exists and set its display to block
    if (overlay) {
        overlay.style.display = 'flex'; // Or 'block' depending on your layout
    } else {
        console.error(`Overlay element for ${type} with ID ${productId} not found`);
    }
}


// Hide the overlay when "Cancel" is clicked
function hideOverlay(button) {
    const overlay = button.closest('.overlay');
    overlay.style.display = 'none';
    document.body.style.overflow = '';
}

function showSizesForFlavor(flavorId) {
    // Hide all size sections
    document.querySelectorAll('.flavor-sizes').forEach(section => {
        section.style.display = 'none';
    });

    // Show the sizes for the selected flavor
    const selectedSizeSection = document.getElementById(`sizes-for-flavor-${flavorId}`);
    if (selectedSizeSection) {
        selectedSizeSection.style.display = 'block';
    }

    const wishselectedSizeSection = document.getElementById(`wish-sizes-for-flavor-${flavorId}`);
    if (wishselectedSizeSection) {
        wishselectedSizeSection.style.display = 'block';
    }

    const buyselectedSizeSection = document.getElementById(`buy-sizes-for-flavor-${flavorId}`);
    if (buyselectedSizeSection) {
        buyselectedSizeSection.style.display = 'block';
    }
}

// Initial load to show sizes for the first flavor
document.addEventListener('DOMContentLoaded', () => {
    const firstFlavor = document.querySelector('[name="selected_flavor"]:checked');
    if (firstFlavor) {
        showSizesForFlavor(firstFlavor.value);
    }
});


let selectedFlavor = null;

function setSelectedFlavor(flavorName) {
    selectedFlavor = flavorName;
}
function getSelectedFlavor() {
    // Return the selected flavor stored in the global variable
    return selectedFlavor || "Default Flavor"; // Provide a fallback if no flavor is selected
}

// Function to update product info when either size or flavor changes
function updateProductInfo(productId, productName, flavorName, sizeName, sizePrice) {
    // Combine product name with flavor and size
    const productNameField = document.getElementById(`product-name-${productId}`);
    productNameField.value = `${productName} ${flavorName} ${sizeName}`;
    
    // Update product price with selected size price
    const productPriceField = document.getElementById(`product-price-${productId}`);
    productPriceField.value = sizePrice;

    const productPriceFieldChange = document.getElementById(`product-price-change-${productId}`);
    if (productPriceFieldChange) {
        productPriceFieldChange.textContent = '₱' + sizePrice; // Update the price
    } else {
        console.error(`Product price element not found for productId: ${productId}`);
    }
}

// Function to update product info for Wishlist (flavor, size, price)
function updateProductInfoForWishlist(productId, productName, flavorName, sizeName, sizePrice) {
    // Combine product name with flavor and size for Wishlist
    const productNameField = document.getElementById(`wishlist-product-name-${productId}`);
    productNameField.value = `${productName} ${flavorName} ${sizeName}`;
    
    // Update product price with selected size price for Wishlist
    const productPriceField = document.getElementById(`wishlist-product-price-${productId}`);
    productPriceField.value = sizePrice;

    const productPriceFieldChange = document.getElementById(`product-price-change-${productId}`);
    if (productPriceFieldChange) {
        productPriceFieldChange.textContent = '₱' + sizePrice; // Update the price
    } else {
        console.error(`Product price element not found for productId: ${productId}`);
    }
    
}

// Function to update product info for Wishlist (flavor, size, price)
function updateProductInfoForBuy(productId, productName, flavorName, sizeName, sizePrice) {
    // Combine product name with flavor and size for Wishlist
    const productNameField = document.getElementById(`buy-product-name-${productId}`);
    productNameField.value = `${productName} ${flavorName} ${sizeName}`;
    
    // Update product price with selected size price for Wishlist
    const productPriceField = document.getElementById(`buy-product-price-${productId}`);
    productPriceField.value = sizePrice;

    const productPriceFieldChange = document.getElementById(`product-price-change-${productId}`);
    if (productPriceFieldChange) {
        productPriceFieldChange.textContent = '₱' + sizePrice; // Update the price
    } else {
        console.error(`Product price element not found for productId: ${productId}`);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const flavorRadios = document.querySelectorAll('input[name="selected_flavor"]:checked');
    const sizeRadios = document.querySelectorAll('input[name="selected_size"]:checked');

    flavorRadios.forEach((radio) => {
        setSelectedFlavor(radio.nextElementSibling.innerText); // Use the flavor name
    });

    sizeRadios.forEach((radio) => {
        const productId = radio.closest('form').querySelector('input[name="product_id"]').value;
        const productName = radio.closest('form').querySelector('input[name="product_name"]').value;
        const flavorName = getSelectedFlavor();
        const sizeName = radio.nextElementSibling.innerText;
        const sizePrice = radio.dataset.price;

        updateProductInfo(productId, productName, flavorName, sizeName, sizePrice);
        updateProductInfoForWishlist(productId, productName, flavorName, sizeName, sizePrice);
    });
});
window.onload = function() {
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        if (radio.defaultChecked) {
            radio.checked = true;
        }
    });
};

// Automatically select and update product info for single size products
@foreach ($products as $product)
    @if($product->sizes && $product->sizes->count() === 1)
        document.addEventListener("DOMContentLoaded", function() {
            const singleSizeRadio = document.querySelector('#cart-overlay-{{ $product->id }} input[name="selected_size"][data-price="{{ $product->sizes[0]->price }}"]');
            if (singleSizeRadio) {
                singleSizeRadio.checked = true;
                const selectedFlavor = document.querySelector('#cart-overlay-{{ $product->id }} input[name="selected_flavor"]:checked');
                const flavorName = selectedFlavor ? selectedFlavor.nextElementSibling.innerText : '{{ $product->flavors[0]->name }}'; // default to first flavor
                updateProductInfo('{{ $product->id }}', '{{ $product->title }}', flavorName, '{{ $product->sizes[0]->size }}', {{ $product->sizes[0]->price }});
            }
        });
    @endif
@endforeach


// Automatically select and update product info for single size products in Wishlist
@foreach ($products as $product)
    @if($product->sizes && $product->sizes->count() === 1)
        document.addEventListener("DOMContentLoaded", function() {
            const singleSizeRadio = document.querySelector(`#wishlist-overlay-{{ $product->id }} input[name="selected_size"][data-price="{{ $product->sizes[0]->price }}"]`);
            if (singleSizeRadio) {
                singleSizeRadio.checked = true;
                const selectedFlavor = document.querySelector(`#wishlist-overlay-{{ $product->id }} input[name="selected_flavor"]:checked`);
                const flavorName = selectedFlavor ? selectedFlavor.nextElementSibling.innerText : '{{ $product->flavors[0]->name }}'; // default to first flavor
                updateProductInfoForWishlist('{{ $product->id }}', '{{ $product->title }}', flavorName, '{{ $product->sizes[0]->size }}', {{ $product->sizes[0]->price }});
            }
        });
    @endif
@endforeach

function redirectToProduct(url) {
    window.location.href = url; // Redirects to the specified URL
}

    </script>


</body>

</html>