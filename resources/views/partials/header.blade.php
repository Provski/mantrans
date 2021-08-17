<header>
    <!-- start navigation -->
    <nav class="navbar navbar-default bootsnav nav-box-width bg-white navbar-expand-lg">
        <div class="container-fluid nav-header-container">
            <!-- start logo -->
            <div class="col-auto pl-0">
                <a href="/" title="Mantrans" class="logo"><img src="{{ asset('assets/images/favicon/logo.png') }}" data-rjs="{{ asset('assets/images/favicon/logo@2x.png') }}" class="logo-dark" alt="Mantrans"><img src="{{ asset('assets/images/favicon/logo.png') }}" data-rjs="{{ asset('assets/images/favicon/logo@2x.png') }}" alt="Mantrans" class="logo-light default"></a>
            </div>
            <!-- end logo -->
            <div class="col accordion-menu pr-0 pr-md-3">
                <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar-collapse-toggle-1">
                    <span class="sr-only">toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-end" id="navbar-collapse-toggle-1">
                    <ul id="accordion" class="nav navbar-nav no-margin alt-font text-normal" data-in="fadeIn" data-out="fadeOut">
                        <!-- start menu item -->
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <!-- end menu item -->

                        <!-- start menu item -->
                        <li class="dropdown simple-dropdown"><a href="#">Sekilas</a><i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                            <!-- start sub menu -->
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/about">Tentang Kami</a>
                                </li>
                                <li><a href="/ourvalues">Nilai Kami</a>
                                </li>
                                <li><a href="/contact">Kontak Kami</a>
                                </li>
                                <li><a href="/team">Team</i></a>
                                </li>
                            </ul>
                        </li>
                        <!-- end menu item -->

                        <!-- start menu item -->
                        <li class="dropdown simple-dropdown"><a href="/service">Layanan</a><i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                            <!-- start sub menu -->
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/mantransnetwork">Mantransnetwork</a>
                                </li>
                                <li><a href="/mantransequipment">Mantransequipment</a>
                                </li>
                            </ul>
                        </li>
                        <!-- end menu item -->

                        <!-- start menu item -->
                        <li>
                            <a href="{{ route('blog.show') }}">Blog</a>
                        </li>
                        <!-- end menu item -->

                        <!-- start menu item -->
                        <li>
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('blog.admin') }}">Admin Menu</a>
                            </li>
                        @endguest
                        </li>
                        <!-- end menu item -->
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navigation --> 
</header>