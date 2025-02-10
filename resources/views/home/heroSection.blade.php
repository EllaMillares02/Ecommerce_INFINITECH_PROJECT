 <!-- Hero Section Begin -->
 <section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Categories</span>
                    </div>
                    <ul>
                    @foreach ($category as $category)
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
                            <h5>+63 907 375 9234</h5>
                            <span>available 8:00am-5:00pm</span>
                        </div>
                    </div>
                </div>
                <div class="banner__slider owl-carousel" style="top: -13px;">
                    @foreach($banners as $banner)
                        <div class="hero__item set-bg" data-setbg="{{ asset('img/hero/' . $banner->image_path) }}">
                            <div class="hero__text">
                                <div style="margin-bottom: 250px"></div>
                                <a href="{{ url('show_shop') }}" class="primary-btn">SHOP NOW</a>
                            </div>
                        </div>
                    @endforeach
                    <div class="hero__item set-bg" data-setbg="img/hero/crafts.png">
                        <div class="hero__text">
                            <div style="display: flex; justify-content: center; align-items: center; margin-left: 270px; margin-top: 200px;">
                                <a href="{{ url('blogs') }}" class="primary-btn">See More!</a>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->