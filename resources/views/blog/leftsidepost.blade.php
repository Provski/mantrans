<aside class="col-12 col-lg-3">
    <div class="margin-45px-bottom sm-margin-25px-bottom">
        <div class="text-extra-dark-gray margin-20px-bottom alt-font text-uppercase font-weight-600 text-small aside-title"><span>Categories</span></div>
        <ul class="list-style-6 margin-50px-bottom text-small">
            @foreach ($categories as $category )
                <li><a href="{{ route('blog.category', $category->id) }}">{{ $category->category }}</a><span>{{ $category->post->count() }}</span></li>
            @endforeach
        </ul>   
    </div>
    <div class="margin-50px-bottom">
        <div class="text-extra-dark-gray margin-20px-bottom alt-font text-uppercase font-weight-600 text-small aside-title"><span>Follow Us</span></div>
        <div class="social-icon-style-1 text-center">
            <ul class="extra-small-icon">
                <li><a class="facebook" href="http://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <li><a class="twitter" href="http://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                <li><a class="google" href="http://google.com" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
                <li><a class="dribbble" href="http://dribbble.com" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                <li><a class="linkedin" href="http://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
        </div>
    </div>
    
    <div class="bg-deep-pink padding-30px-all text-white-2 text-center margin-45px-bottom sm-margin-25px-bottom">
    @foreach( $quotes as $quote )
        <i class="fas fa-quote-left icon-small margin-15px-bottom d-block"></i>
        <span class="text-extra-large font-weight-300 margin-20px-bottom d-block">{{ $quote->content}}</span>
        <a class="btn btn-very-small btn-transparent-white border text-uppercase" href="portfolio-boxed-grid-overlay.html">Explore Portfolio</a>
    @endforeach
    </div>
</aside>