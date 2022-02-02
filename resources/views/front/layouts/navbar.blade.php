<header class="header transparent scroll-hide ">
    <div class="site-navbar-wrap v1 @if (Request::is('property/*')){{ 'detail_nav' }}@endif">
        <div class="container-fluid">
            <div class="site-navbar">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 col-6">
                        <div class="d-lg-none float-left mr-2">
                            <a href="#" class="mobile-bar js-menu-toggle">
                                <span class="lnr lnr-menu"></span>
                            </a>
                        </div>
                        @if (Request::is('property/*'))
                            <a class="navbar-brand" href="{{ URL::to('/') }}">
                                <img src="{{ URL::asset('assets/images/Whitelogo.png') }}" alt="Saakin"
                                    class="img-fluid">
                            </a>
                        @else
                            <a class="navbar-brand white-logo" href="{{ URL::to('/') }}">
                                <img src="{{ URL::asset('upload/logo.png') }}" alt="Saakin" class="img-fluid">
                            </a>
                        @endif

                    </div>
                    <div class="col-lg-8 col-md-8 col--sm-6 col-xs-6 ml-auto col-6">
                        <div class="menu-btn text-right float-right ">
                            <ul class="user-btn v2">
                                @if (!Auth::user())
                                    <li><a href="#" data-toggle="modal" data-target="#user-login-popup">Login</a></li>
                                @else
                                    <li><a href="{{ url('logout') }}">Logout</a></li>
                                @endif
                            </ul>
                            <div class="add-list float-right ml-3">
                                @if (Auth::user())
                                    @if (Auth::user()->usertype == 'Agency')
                                        <a class="btn v6" href="{{ URL::to('admin/properties/create') }}">
                                            Submit Property</a>
                                    @elseif(Auth::user()->usertype=='Admin')
                                        <a class="btn v6" href="{{ URL::to('admin/properties/create') }}">
                                            Submit Property
                                        </a>
                                    @else
                                        <a class="btn v6" href="{{ url('submit-property') }}">Submit
                                            Property</a>
                                    @endif
                                @else
                                    <a data-toggle="modal" data-target="{{ '#user-login-popup' }}"
                                        class="btn v6" href="#">
                                        Submit Property
                                    </a>
                                @endif
                            </div>
                        </div>

                        <nav class="site-navigation text-right float-right">
                            <div class="container" style="padding-top: 4px !important">
                                <ul class="site-menu js-clone-nav d-none d-lg-block">

                                    <li>
                                        <a href="{{ route('property-purpose', ['buy', 'sale']) }}">
                                            Buy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('property-purpose', ['rent', 'rent']) }}">
                                            Rent
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('city-guide') }}">
                                            City Guide
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('real-estate-agencies') }}">
                                            Real Estate Agencies
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('blogs') }}">
                                            Blogs
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <!--mobile-menu starts -->
                        <div class="site-mobile-menu">
                            <div class="site-mobile-menu-header">
                                <div class="site-mobile-menu-close js-menu-toggle"><span class="lnr lnr-cross"></span>
                                </div>
                                <a href="{{ URL::to('/') }}">
                                    <img src="{{ URL::asset('upload/' . getcong('site_favicon')) }}" alt="fav icon"
                                        width="45">
                                </a>
                            </div>


                            <div class="site-mobile-menu-body position-relative">
                                @if (!Auth::user())
                                    <a href="{{ url('login') }}"
                                        class="btn btn-block btn_mb_login btn-outline-secondary">Register/Sign In</a>
                                @else
                                    <a href="{{ url('logout') }}"
                                        class="btn btn-block btn_mb_login btn-outline-secondary">Logout</a>

                                @endif
                            </div>

                        </div>
                        <!--mobile-menu ends-->
                    </div>
                    <!--<div class="col-lg-3 col-md-4 col-4"></div>-->
                </div>
            </div>
        </div>
    </div>
</header>
