<!doctype html>
<html class="no-js" lang="en">

    <!-- start head -->
    @include('partials.head')
    <!-- end head -->

    <body>   
        <!-- start header -->
        @include('partials.header')
        <!-- end header -->

        @foreach ($authors as $author)
        <!-- start about section -->
        <section class="wow fadeIn parallax" data-stellar-background-ratio="0.5" style="background-image:url('{{ asset('storage/images/author/'. $author->post_author)}}">
            <div class="container-fluid padding-five-lr">
                <div class="row justify-content-end">                  
                    <div class="col-12 col-lg-5">
                        <div class="padding-ten-all md-padding-70px-all sm-padding-25px-all bg-white box-shadow-light">
                            <i class="fas fa-quote-left text-deep-pink icon-large margin-15px-bottom"></i>
                            <h5 class="text-extra-dark-gray margin-50px-bottom md-margin-20px-bottom alt-font">Hello, {{ $author->introduction }}</h5>
                            <ul class="text-medium list-style-3">
                                <li><span class="width-30 d-inline-block">Name:</span>{{ $author->author }}</li>
                                <li><span class="width-30 d-inline-block">Email:</span><a href="mailto:{{ $author->email }}">{{ $author->email }}</a></li>
                                <li><span class="width-30 d-inline-block">Nationality:</span>{{ $author->nationality }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end about section -->

        <!-- start information section -->
        <section class="wow fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-12 col-lg-5 offset-lg-1 offset-xl-0 col-md-6 wow fadeIn last-paragraph-no-margin" data-wow-delay="0.2s">
                        <figure class="wp-caption alignleft">
                            <div class="position-relative icon-with-paragraph">
                                <span class="text-deep-pink position-absolute left-0 top-0 alt-font special-char-extra-large d-none d-lg-block">*</span> 
                                <h5 class="font-weight-300 text-extra-dark-gray width-90 padding-nineteen-left lg-padding-twenty-left lg-width-100 md-no-padding-left sm-margin-five-bottom">{{ $author->motivation }}</h5>
                            </div>
                            {{-- <figcaption class="wp-caption-text">
                                There is no sincerer love than the love of food.
                            </figcaption> --}}
                        </figure>
                        <p class="text-medium font-weight-300 line-height-26 lg-width-100">{{ Str::ucfirst($author->about_author) }}</p>
                    </div>
                </div>
            </div>
        </section>
        @endforeach

        <!-- end information section -->
        
        @foreach ($quotes as $quote)
        <!-- start features box section -->
        <section class="wow fadeIn">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8 col-md-10 text-center">
                        <i class="fas fa-quote-left icon-small text-deep-pink d-block margin-25px-bottom"></i>
                        <h5 class="alt-font text-extra-dark-gray font-weight-600 margin-5px-bottom">{{ $quote->title }}</h5>
                        <h5 class="alt-font text-extra-dark-gray font-weight-300">{{ $quote->content }}</h5>
                        <span class="text-uppercase text-extra-small alt-font letter-spacing-3 text-medium-gray">{{ $quote->name }}</span>
                    </div>
                </div>
            </div>
        </section>
        @endforeach
        <!-- end features box section -->

        <!-- end information section -->


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