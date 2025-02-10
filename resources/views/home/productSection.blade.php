 <!-- Latest Product Section Begin -->
 <section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div class="latest-product__slider owl-carousel">

                            @php $counter = 0; @endphp
                            <div class="latest-prdouct__slider__item">
                                @foreach($latestProducts as $product)
                                    <a href="{{url('product_details',$product->id)}}" class="latest-product__item">
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
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Top Rated Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        
                        @php $counter = 0; @endphp
                        <div class="latest-prdouct__slider__item">
                            @foreach($topProducts as $product)
                                <a href="{{url('product_details',$product->id)}}" class="latest-product__item">
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
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Review Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        @php $counter = 0; @endphp
                        <div class="latest-prdouct__slider__item">
                            @foreach($reviewProducts as $product)
                                <a href="{{url('product_details',$product->id)}}" class="latest-product__item">
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
</section>
<!-- Latest Product Section End -->