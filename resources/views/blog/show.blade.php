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
        <section class="wow fadeIn parallax" data-stellar-background-ratio="0.5" style="background-image:url('../assets/images/blog/portfolio6.jpg') ;">
            <div class="opacity-medium bg-extra-dark-gray"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 d-flex flex-column justify-content-center text-center extra-small-screen page-title-large">
                        <!-- start page title -->
                        <h1 class="text-white-2 alt-font font-weight-600 letter-spacing-minus-1 margin-10px-bottom">Kegiatan Kami</h1>
                        <span class="text-white-2 opacity6 alt-font">Mari Kenali Lebih Dekat Tentang Kami</span>
                        <!-- end page title --> 
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title section --> 
        <!-- start post content section --> 
        <section>
            <div class="container">
                <div class="row flex-lg-row-reverse">
                    <!-- start left sidepost -->
                    @include('blog.leftsidepost')
                    <!-- end left sidepost -->                   
                    <main class="col-12 col-lg-9 left-sidebar md-margin-60px-bottom sm-margin-40px-bottom pr-0 md-no-padding-left">

                        <!-- start main post -->
                        @foreach ( $posts as $post )
                            @include('blog.mainpost')
                        @endforeach 
                        <!-- end main post -->
                        
                        
                        <!-- start pagination -->

                        <div>
                            Showing
                            {{ $posts->firstItem() }}
                            to
                            {{ $posts->lastItem() }}
                            {{-- of
                            {{ $posts->total() }}
                            entries --}}
                        </div>
                        <div class="col-12 text-center ">
                            {{ $posts->links() }}
                        </div>
                        <!-- end pagination -->

                    </main>

                    

                </div>
            </div>
        </section>
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