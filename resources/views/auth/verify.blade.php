<!doctype html>
<html class="no-js" lang="en">

    <!-- start head -->
    @include('partials.auth-head')
    <!-- end head -->

    <body class="bg-gradient-primary">

        <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                        <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="card">
                                            <div class="text-center card-header">
                                                <h1 class="h4 text-gray-900 mb-4">{{ __('Verify Your Email Address') }}</h1>
                                            </div>
                                            <div class="card-body">
                                                @if (session('resent'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                                    </div>
                                                @endif
                                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                                {{ __('If you did not receive the email') }},
                                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
            <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
            <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
            <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    </body>

</html>
