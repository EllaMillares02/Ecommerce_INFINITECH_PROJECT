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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="home/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="home/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="home/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .img_design{
            width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
 
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
                        <h2>Wishlist</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Wishlist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    @if(session()->has('message'))

    <div class="alert alert-success">

        {{session()->get('message')}}

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        
    </div>

    @endif

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="shoping__cart__table" style="overflow-y: auto; max-height: 500px;">
                        <table>
                            <thead>
                                <tr>
                                    <th style="padding: 10px;"></th>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th style="padding: 40px;"></th>
                                    <th style="padding: 20px;"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $totalprice=0; ?>

                                @forelse ($wishlists as $wishlist)
                                
                                <tr>
                                    <td>
                                        <ul>
                                            <i class="fa fa-heart"></i>
                                        </ul>
                                    </td>
                                    <td class="shoping__cart__item" style="display: flex; align-items: center;">
                                        <img class="img_design" src="/product/{{$wishlist->image}}" alt="">
                                        <h5 style="margin: 0;">{{$wishlist->product_title}}</h5>
                                    </td>
                                    
                                    <td class="shoping__cart__price">
                                        @if($wishlist->product->sale && $wishlist->product->sale->title == $wishlist->product_title)
                                            <span class="badge badge-success">{{ $wishlist->product->sale->discount }}% OFF</span>

                                            @php
                                                $discountPrice = $wishlist->product->price - ($wishlist->product->price * ($wishlist->product->sale->discount / 100));
                                            @endphp

                                            <div>₱{{ number_format($discountPrice, 2) }}</div>
                                            <div style="text-decoration: line-through; color: gray;">₱{{ number_format($wishlist->product->price, 2) }}</div>
                                        @else
                                            ₱{{ number_format($wishlist->price, 2) }}
                                        @endif

                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity_wishlist">    
                                                <input type="text" value="{{$wishlist->quantity}}" min="1" data-product-id="acc-{{$wishlist->id}}" readonly style="text-align: center;">
                                        </div>
                                    </td>
                                    <th class="shoping__cart__item__close">
                                        <ul  class="icon-list">
                                            <li>
                                                <form action="{{url('add_cart',$wishlist->product_id)}}" method="Post">
                                                    <input type="hidden" name="product_name" value="{{ $wishlist->product_title }}">
                                                    <input type="hidden" name="product_price" value="{{ $wishlist->price }}">
                                                    @csrf

                                                    <button type="submit" class="icon-button" value="1" name="quantity">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </th>
                                    <td class="shoping__cart__item__close">
                                        <a href="{{url('/remove_wishlist',$wishlist->id)}}" onclick="event.preventDefault(); confirmRemove('{{ url('/remove_wishlist', $wishlist->id) }}')">
                                            <span class="icon_close"></span></a>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <i class="fa fa-heart" style="font-size: 24px; color: grey;" title="No deliveries available"></i>
                                        <p>No Products on the Wishlist at the moment.</p>
                                    </td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
    </section>
    <!-- Shoping Cart Section End -->

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
        function confirmRemove(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you really want to remove this product from your cart?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
    </script>

</body>

</html>