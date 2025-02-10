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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="home/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="home/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="home/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="home/css/style.css" type="text/css">

    <style>
        .star-rating {
          font-size: 1.5rem;
          color: #ddd;
          cursor: pointer;
        }
        .star-rating .active {
          color: #f39c12;
        }
        .card {
          max-width: 500px;
          margin: 20px auto;
          padding: 20px;
          box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-rate {
          background-color: #6c757d;
          color: #fff;
        }
        .btn-rate:hover {
          background-color: #5a6268;
        }
        .product-image {
        max-width: 100px; 
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
                        <h2>Rate Now</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Rate Now</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="container mt-5">
        @if(session()->has('message'))

            <div class="alert alert-success">

                {{session()->get('message')}}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                
            </div>
                
            @endif
            
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Leave a Review</h4>
                @php
                    $productTitles = explode(', ', $order->product_title);     
                    $images = explode(', ', $order->image);        
                    $productsCount = count($productTitles);
                    $productIds = explode(', ', $order->product_id);
                    $productsDisplay = [];
                    for ($i = 0; $i < $productsCount; $i++) {
                        $productsDisplay[] = '<img class="img_design" src="' . $images[$i] . '" alt="" style="width: 30px; margin-right: 5px;"> ' . $productTitles[$i];
                    }
                    $productsList = implode(', ', $productsDisplay);
                @endphp
                <div class="d-flex align-items-center justify-content-center mb-4">
                    {!! $productsList !!} 
                </div>
    
                <form id="review-form" action="{{ route('submit.reviews') }}" method="POST">
                    @csrf <!-- Add CSRF token for security -->
                    @for ($i = 0; $i < $productsCount; $i++)
                        <div class="form-group">
                            <label for="review-text-{{ $i }}">Your Review for {{ $productTitles[$i] }}:</label>
                            <textarea name="reviews[{{ $i }}][text]" class="form-control" id="review-text-{{ $i }}" rows="4" placeholder="Write your review here..." required></textarea>
                            <input type="hidden" name="reviews[{{ $i }}][product_id]" value="{{ $productIds[$i] }}"> <!-- Store the actual product ID -->
                        </div>
                        <div class="form-group text-center">
                            <label>Rate {{ $productTitles[$i] }}:</label>
                            <div id="star-rating-{{ $i }}" class="star-rating mt-2">
                                <!-- Ensure to include a hidden input to store the rating -->
                                <input type="hidden" name="reviews[{{ $i }}][rating]" id="rating-{{ $i }}" required>
                                <i class="fas fa-star" data-star="1" onclick="setRating({{ $i }}, 1)"></i>
                                <i class="fas fa-star" data-star="2" onclick="setRating({{ $i }}, 2)"></i>
                                <i class="fas fa-star" data-star="3" onclick="setRating({{ $i }}, 3)"></i>
                                <i class="fas fa-star" data-star="4" onclick="setRating({{ $i }}, 4)"></i>
                                <i class="fas fa-star" data-star="5" onclick="setRating({{ $i }}, 5)"></i>
                            </div>
                        </div>
                        <hr style="margin-bottom: 20px;">
                    @endfor
                
                    <div class="text-center">
                        <button type="submit" class="btn btn-rate btn-sm">Rate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
        
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
        $(document).ready(function () {
        // Create an array to hold ratings for each product
        let ratings = [];
    
        // Handle star hover effect for each rating group
        $('[id^=star-rating]').each(function(index) {
            $(this).find('i').hover(function() {
                const starValue = $(this).data('star');
                highlightStars(index, starValue);
            }, function() {
                highlightStars(index, ratings[index] || 0); // Reset to current rating on mouse out
            });
    
            // Handle star click
            $(this).find('i').on('click', function() {
                const starValue = $(this).data('star');
                ratings[index] = starValue; // Store the rating for this specific product
                setRating(index, starValue); // Set the rating value in the hidden input
                highlightStars(index, starValue);
            });
        });
    
        // Highlight stars based on rating
        function highlightStars(index, starCount) {
            $(`#star-rating-${index} i`).each(function() {
                const starValue = $(this).data('star');
                $(this).toggleClass('active', starValue <= starCount);
            });
        }

        // Function to set the rating in the hidden input
        function setRating(index, rating) {
            document.getElementById('rating-' + index).value = rating; 
        }
    });
        </script>
        
    

    
</body>

</html>