<!doctype html>
<html class="no-js" lang="en">

    <!-- start head -->
    @include('partials.head')
    <!-- end head -->

    <body>
        <!-- start header -->
        @include('partials.header')
        <!-- end header -->

        <!-- start page title section -->
        @foreach($authors as $author)
        <section class="wow fadeIn cover-background background-position-top top-space" style="background-image:url('/assets/images/about/videostreaming1.jpg') ;">
            <div class="opacity-medium bg-extra-dark-gray"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 d-flex justify-content-center flex-column text-center page-title-large padding-30px-tb">
                        <!-- start sub title -->
                        <span class="text-white-2 opacity6 alt-font margin-10px-bottom d-block text-uppercase text-small">{{ $author->created_at->format('d-m-Y') }}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;by <a href="{{ route('blog.about-author', $author->id) }}" class="text-white-2">{{ $author->author }}</a>&nbsp;&nbsp;&nbsp;</a></span>
                        <!-- end sub title -->
                        <!-- start page title -->
                        <h5 class="text-white-2 alt-font font-weight-600 margin-10px-bottom">{{ $author->motivation }}</h5>
                        <!-- end page title -->
                    </div>
                </div>
            </div>
        </section>
        @endforeach
        <!-- end page title section -->

        <!-- start blog content section -->
        @foreach ( $categories as $category)
        <section class="wow fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 mx-auto text-center last-paragraph-no-margin">
                        <h2 class="alt-font text-extra-dark-gray font-weight-600 mb-0">{{ $category->category }}</h2>
                        <img src="{{ url('storage/images/category/'. $category->post_category) }}" alt="" class="width-100 margin-40px-tb md-margin-30px-tb">
                        <p>{{ $category->about_category }}</p>
                    </div>
                    <div class="col-12 col-lg-10 mx-auto text-center margin-60px-tb md-margin-30px-tb">
                        @foreach( $quotes as $quote )
                        <div class="bg-light-gray padding-ten-all md-padding-35px-all sm-padding-25px-all">
                            <i class="fas fa-quote-left icon-small text-deep-pink d-block margin-25px-bottom sm-margin-15px-bottom"></i>
                            <h5 class="alt-font text-extra-dark-gray font-weight-600">{{ $quote->content }}</h5>
                            <span class="text-uppercase text-extra-small alt-font letter-spacing-3 text-medium-gray">{{ $quote->name }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endforeach
        <!-- end blog content section -->

        <!-- start footer --> 
        @include('partials.footer')
        <!-- end footer -->

        <!-- start scroll to top -->
        @include('partials.arrowscrollup')
        <!-- end scroll to top  -->

        <!-- start js script -->
        @include('partials.scripts')
        <!-- end js script -->
        
    </body>
</html>