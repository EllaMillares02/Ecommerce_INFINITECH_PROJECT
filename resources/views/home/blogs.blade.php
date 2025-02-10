 <!-- Blog Section Begin -->
 <section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" style="width: 100%; height: 250px; object-fit: cover;">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> {{ \Carbon\Carbon::parse($blog->date)->format('F d, Y') }}</li>
                            </ul>
                            <h5><a href="{{ route('blog_details', $blog->id) }}">{{ $blog->title }}</a></h5>
                            <p>{{ $blog->subtitle }}</p> 
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Blog Section End -->