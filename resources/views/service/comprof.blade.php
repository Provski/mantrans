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
        <section class="wow fadeIn parallax" data-stellar-background-ratio="0.5" style="background-image:url('assets/images/portfolio/portfolio.jpg');">
            <div class="opacity-medium bg-extra-dark-gray"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 d-flex flex-column justify-content-center text-center extra-small-screen page-title-large">
                        <!-- start page title -->
                        <h1 class="text-white-2 alt-font font-weight-600 letter-spacing-minus-1 margin-10px-bottom">Temukan Layanan Kami</h1>
                        <!-- end page title -->
                        <!-- start sub title -->
                        <span class="text-white-2 opacity6 alt-font">Pilihlah Dari Berbagai Macam Layanan Kami</span>
                        <!-- end sub title -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title section -->
        <!-- start service section -->
        <section class="wow fadeIn padding-90px-top md-padding-50px-top sm-padding-30px-top">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- start filter navigation -->
                        <ul class="portfolio-filter nav nav-tabs justify-content-center border-0 portfolio-filter-tab-1 font-weight-600 alt-font text-uppercase text-center margin-80px-bottom text-small md-margin-40px-bottom sm-margin-20px-bottom">
                            <li class="nav active"><a href="javascript:void(0);" data-filter="*" class="light-gray-text-link text-very-small">All</a></li>
                            <li class="nav"><a href="javascript:void(0);" data-filter=".live" class="light-gray-text-link text-very-small">Live Streaming</a></li>
                            <li class="nav"><a href="javascript:void(0);" data-filter=".web" class="light-gray-text-link text-very-small">Web</a></li>
                            <li class="nav"><a href="javascript:void(0);" data-filter=".network" class="light-gray-text-link text-very-small">Network</a></li>
                            <li class="nav"><a href="javascript:void(0);" data-filter=".education" class="light-gray-text-link text-very-small">Edutainment</a></li>
                            <li class="nav"><a href="javascript:void(0);" data-filter=".esport" class="light-gray-text-link text-very-small">eSport</a></li>
                            <li class="nav"><a href="javascript:void(0);" data-filter=".meeting" class="light-gray-text-link text-very-small">Meeting - Convention - Concert</a></li>
                            <li class="nav"><a href="javascript:void(0);" data-filter=".equipment" class="light-gray-text-link text-very-small">Rental & Support</a></li>
                        </ul>                                                                           
                        <!-- end filter navigation -->
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 px-3 p-md-0">
                        <div class="filter-content overflow-hidden">
                            <ul class="portfolio-grid work-3col hover-option4 gutter-medium">
                                <li class="grid-sizer"></li>

                                <!-- start list service -->
                                @include('service.listcomprof')
                                <!-- end list service -->  
                                 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end service section -->

        <!-- start call to action section -->
        <section class="wow fadeIn padding-50px-tb border-top border-color-extra-light-gray">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 md-margin-30px-bottom text-center text-lg-left wow fadeInDown">
                        <span class="alt-font text-extra-large text-extra-dark-gray margin-5px-top sm-no-margin-top d-inline-block w-100">Kami akan senang mendengar tentang memulai proyek baru Anda?</span>
                    </div>
                    <div class="col-12 col-lg-4 text-center text-lg-left wow fadeInDown"> 
                        <a href="/contact" class="btn btn-medium btn-rounded btn-transparent-dark-gray" data-wow-delay="0.4s">Mulai Proyek Baru<i class="ti-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- end call to action section -->

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