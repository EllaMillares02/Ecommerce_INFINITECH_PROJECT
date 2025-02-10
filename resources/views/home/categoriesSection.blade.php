   <!-- Categories Section Begin -->
   <section class="categories">
    <div class="container">
        <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($category as $category)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="prod_category/{{$category->image}}">
                                <h5><a href="{{ route('category.products', $category->category_name) }}">{{$category->category_name}}</a></h5>
                            </div>
                        </div>
                    @endforeach
                </div>  
        </div>
    </div>
</section>
<!-- Categories Section End -->

