
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

<body>

    @include('home.header')

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
                            <form action="{{ route('search_page') }}" method="GET">
                                <input type="text" name="query" placeholder="What do you need?" required>
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+63 907 802 4442</h5>
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
                        <h2>{{$product->title}}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <a href="{{ route('category.products', $product->category) }}">{{$product->category}}</a>
                            <span>{{$product->title}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="product/{{$product->image}}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="product/{{$product->image}}"
                                src="product/{{$product->image}}" alt="">
                            @foreach ($product->images as $image)
                                <img  data-imgbigurl="{{ asset('product/' . $image->path) }}" class="img_size" src="{{ asset('product/' . $image->path) }}" alt="Product Image">
                            @endforeach  
                            <img data-imgbigurl="img/product/details/product-details-5.jpg"
                                src="img/product/details/thumb-3.jpg" alt="">
                            <img data-imgbigurl="img/product/details/product-details-4.jpg"
                                src="img/product/details/thumb-4.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$product->title}}</h3>
                        <div class="product__details__rating">
                            @php
                                // Determine the number of full and half stars
                                $fullStars = floor($averageRating);
                                $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                $emptyStars = 5 - $fullStars - $halfStar;
                            @endphp

                            @for ($i = 0; $i < $fullStars; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            
                            @for ($i = 0; $i < $halfStar; $i++)
                                <i class="fa fa-star-half-o"></i>
                            @endfor
                            
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <i class="fa fa-star-o"></i> <!-- Use an empty star icon for remaining stars -->
                            @endfor

                            <span>({{ $reviewsCount }} reviews)</span>
                        </div>
                        
                        <div class="product__details__price" id="dynamic-price">
                            @if($product->discount_price != null) 
                                ₱<span id="current-price" 
                                      data-discount-price="{{ $product->discount_price }}" 
                                      data-original-price="{{ $product->price }}">
                                    {{ number_format($product->discount_price, 2) }}
                                </span>
                                <span style="text-decoration: line-through; color: gray;">₱{{ number_format($product->price, 2) }}</span>
                            @elseif($onSaleProd)
                                ₱<span id="current-price" 
                                      data-discount-price="{{ $discountPrice }}" 
                                      data-original-price="{{ $product->price }}">
                                    {{ number_format($discountPrice, 2) }}
                                </span>
                                <span style="text-decoration: line-through; color: gray;">₱{{ number_format($product->price, 2) }}</span>
                                <div>
                                    <span class="badge badge-warning">{{ $onSaleProd->discount }}% OFF</span>
                                </div>
                            @else
                                <span id="product-price-change-{{ $product->id }}" data-original-price="{{ $product->price }}">
                                    ₱{{ number_format($product->price) }}
                                </span>
                            @endif
                        </div>
                        

                        <form action="{{ url('add_cart', $product->id) }}" method="POST">
                            @csrf
                            
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name" id="product-name-{{ $product->id }}" value="">
                            <input type="hidden" name="product_price" id="product-price-{{ $product->id }}" value="">

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
                                        <div class="flavor-sizes" id="sizes-for-flavor-{{ $flavor->id }}" style="display: none;">
                                            @foreach($flavor->sizes as $size)
                                                <label class="size-option">
                                                    <input type="radio" name="selected_size" value="{{ $size->id }}" data-price="{{ $size->price }}"
                                                    onclick="updateProductInfoLine('{{ $product->id }}', '{{ $product->title }}', '{{ $flavor->name }}', '{{ $size->size }}', {{ $size->price }}); updateProductInfoForWishlist('{{ $product->id }}', '{{ $product->title }}', '{{ $flavor->name }}', '{{ $size->size }}', {{ $size->price }});
                                                    updateDisplayedPrice({{ $size->price }}, '{{ $product->id }}');"
                                                    required="">

                                                    <span>{{ $size->size }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif 

                        @php
                            $firstSentence = strtok($product->description, '.'); 
                        @endphp

                        <p>{!! $firstSentence !!}</p>

                    <div class="d-flex align-items-center">    

                            <div class="product__details__quantity">

                                <div class="quantity">
                                    <div class="pro-qty2">
                                        <input type="text" value="1" name="quantity" min="1">
                                    </div>
                                </div>
                            </div>

                            <input type="submit" class="primary-btn"  value="ADD TO CART" title="Please Select a Color or Size First.">
                            
                        </form>
                        
                        <form action="{{url('add_wishlist',$product->id)}}" method="Post">
                            @csrf                                            
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="product_name" id="wishlist-product-name-{{ $product->id }}" value="">
                            <input type="hidden" name="product_price" id="wishlist-product-price-{{ $product->id }}" value="">

                            <input type="hidden" name="quantity" value="1" min="1">

                            <label class="heart-icon ml-1 mr-3">
                                <input type="submit" value="ADD TO WISHLIST" style="display: none;" title="Please Select a Color or Size First.">
                                <span class="icon_heart_alt"></span>
                            </label>                            
                           
                        </form>

                        <form action="{{ url('checkout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="1" min="1">
                            <input type="hidden" name="image" value="/product/{{ $product->image }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="productName" id="buy-product-name-{{ $product->id }}" value="">
                            <input type="hidden" name="product_price" id="buy-product-price-{{ $product->id }}" value="">
                            <div class="button-container">
                                <input type="submit" class="buy-to-cart-btn primary-btn" value="BUY NOW" title="Please Select a Color or Size First.">
                            </div>                            
                        </form>
                        
                    </div>

                        <ul>
                            <li><b>Brand</b> <span>{{ $product->brand}}</span></li>
                            <li><b>Availability</b> <span> Size: 
                                @foreach ($product->sizes as $size)
                                    @if ($size->flavor_id == $flavor->id)
                                    {{ $size->size }} - <samp> {{ $size->stock_quantity }} in stock </samp><br>
                                    @endif
                                @endforeach
                            </span></li>
                            <li><b>Delivery</b> <span>2-5 Days Shipping of orders <samp>Free pickup today</samp></span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=" id="facebook-share" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=" id="twitter-share" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="https://www.instagram.com/" id="instagram-share" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    <a href="https://www.pinterest.com/pin/create/button/?url=" id="pinterest-share" target="_blank">
                                        <i class="fa fa-pinterest"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>({{ $product->reviews->count() }})</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Description</h6>
                                    <p>{!! $product->description !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>{!! $product->information !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <div class="reviews-section">
                                        <h3>Product Reviews</h3>
                                        @forelse ($product->reviews as $review)
                                            <div class="review">
                                                <div class="review-header">
                                                    <span class="review-user">{{ $review->user->name }}</span>
                                                    <div class="review-rating">
                                                        @php
                                                            // Determine the number of full and half stars
                                                            $fullStars = floor($review->rating);
                                                            $halfStar = ($review->rating - $fullStars) >= 0.5 ? 1 : 0;
                                                        @endphp
                                    
                                                        @for ($i = 0; $i < $fullStars; $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                    
                                                        @for ($i = 0; $i < $halfStar; $i++)
                                                            <i class="fa fa-star-half-o"></i>
                                                        @endfor
                                    
                                                        @for ($i = 0; $i < (5 - $fullStars - $halfStar); $i++)
                                                            <i class="fa fa-star-o"></i> <!-- Empty star -->
                                                        @endfor
                                                    </div>
                                                </div>
                                                <p class="review-comment">{{ $review->review_text }}</p>
                                            </div>
                                        @empty
                                                <div class="review text-center">
                                                    <ul>
                                                        <i class="fa fa-star" style="font-size: 24px; color: grey;" title="No reviews available"></i>
                                                        <i class="fa fa-star" style="font-size: 24px; color: grey;" title="No reviews available"></i>
                                                        <i class="fa fa-star" style="font-size: 24px; color: grey;" title="No reviews available"></i>
                                                        <i class="fa fa-star" style="font-size: 24px; color: grey;" title="No reviews available"></i>
                                                        <i class="fa fa-star" style="font-size: 24px; color: grey;" title="No reviews available"></i>
                                                    </ul>
                                                    <p>No User Product Reviews  at the Moment.</p>
                                                </div>
                                        @endforelse
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($relatedProducts as $product)
                        <div class="col-lg-4 col-md-6 col-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="product/{{$product->image}}" ondblclick="redirectToProduct('{{ url('product_details',  $product->id) }}')">

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
                                        </li>
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
                        @empty
                            <div class="text-center" style="color: lightgrey; margin-left: 20%;">
                                <h6>No Related Products  at the Moment.</h6>
                            </div>
                        @endforelse
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

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

    function updateProductInfoLine(productId, productTitle, flavorName, sizeName, price) {
        // Update Add to Cart form
        document.getElementById(`product-name-${productId}`).value = `${productTitle} (${flavorName}, ${sizeName})`;
        document.getElementById(`product-price-${productId}`).value = price;

        // Update Wishlist form
        document.getElementById(`wishlist-product-name-${productId}`).value = `${productTitle} (${flavorName}, ${sizeName})`;
        document.getElementById(`wishlist-product-price-${productId}`).value = price;

        // Update Buy Now form
        document.getElementById(`buy-product-name-${productId}`).value = `${productTitle} (${flavorName}, ${sizeName})`;
        document.getElementById(`buy-product-price-${productId}`).value = price;

        
    }

    function showSizesForFlavor(flavorId) {
        // Hide all size sections
        document.querySelectorAll('.flavor-sizes').forEach(section => {
            section.style.display = 'none';
        });

        // Show the selected flavor's sizes
        const selectedFlavorSection = document.getElementById(`sizes-for-flavor-${flavorId}`);
        if (selectedFlavorSection) {
            selectedFlavorSection.style.display = 'block';
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
@foreach ($relatedProducts as $product)
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
@foreach ($relatedProducts as $product)
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

// JavaScript to dynamically add the current URL for sharing
const currentUrl = encodeURIComponent(window.location.href);

document.getElementById('facebook-share').href += currentUrl;
document.getElementById('twitter-share').href += currentUrl;
document.getElementById('pinterest-share').href += currentUrl;

function redirectToProduct(url) {
    window.location.href = url; // Redirects to the specified URL
}

function updateDisplayedPrice(selectedPrice, productId) {
    // Get the container for the price
    const priceContainer = document.getElementById('dynamic-price');
    const priceSpan = priceContainer.querySelector('#current-price');
    const lineThroughPrice = priceContainer.querySelector('span[style*="text-decoration: line-through"]');
    
    // Retrieve the original price and discount price
    const originalPrice = parseFloat(priceSpan.dataset.originalPrice);
    const discountPrice = parseFloat(priceSpan.dataset.discountPrice);

    // Update price based on discount logic
    if (!isNaN(discountPrice)) {
        // No discount, use the selected size's price
        priceSpan.textContent = `${selectedPrice.toFixed(2)}`;
    }

    // Update line-through price if it exists
    if (lineThroughPrice) {
        lineThroughPrice.textContent = `${selectedPrice.toFixed(2)}`;
    }
}
document.addEventListener('DOMContentLoaded', function () {
    // Get all forms (for both wishlist and checkout)
    document.querySelectorAll('form').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            // Get the necessary input values
            let productName = form.querySelector('[name="product_name"]').value;
            let productPrice = form.querySelector('[name="product_price"]').value;

            // Check if the required fields are filled
            if (!productName || !productPrice) {
                event.preventDefault(); // Prevent form submission
                alert('Product name and price must be filled!');
            }
        });
    });
});


</script>


</body>

</html>