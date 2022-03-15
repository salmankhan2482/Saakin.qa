<header class="header">
  {{-- <div class="top-head">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-lg-3">
          <div class="d-flex justify-content-between align-items-center d-lg-block">
            <div class="site-logo">
              @if (Request::is('property/*'))
              <a href="{{ URL::to('/') }}">
                <img src="{{ URL::asset('assets/images/Whitelogo.png') }}" alt="Saakin" height="32">
              </a>
              @else
              <a href="{{ URL::to('/') }}">
                <img src="{{ URL::asset('upload/logo.png') }}" alt="Saakin" height="32">
              </a>
              @endif
            </div>

            <a href="javascript:{}" class="toggleBtnMenu d-lg-none"><i class="toggler-menu icon fa fa-bars fa-2x"
                aria-hidden="true"></i></a>
          </div>
        </div>
        <div class="col-lg-9">

          <div class="mainMenu">
            <div class="body-overlay"></div>
            <nav class="maindiv">
              <div class="menuHeader d-flex justify-content-between d-lg-none">
                <a href="#!" rel="home" class="home-icon">
                  <i class="fa fa-home"></i>
                </a>
                <a href="javascript:{}" class="closeMenu"><i class="fa fa-times"></i></a>
              </div>
              <ul>
                <li class="current_page_item">
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


                @if (!Auth::user())
                <li><a href="#" data-bs-toggle="modal" data-bs-target="#user-login-popup">Login</a></li>
                @else
                <li><a href="{{ url('logout') }}">Logout</a></li>
                @endif


                @if (Auth::user())
                @if (Auth::user()->usertype == 'Agency')
                <a class="btn btn-primary" href="{{ URL::to('admin/properties/create') }}">
                  Submit Property</a>
                @elseif(Auth::user()->usertype=='Admin')
                <a class="btn btn-primary" href="{{ URL::to('admin/properties/create') }}">
                  Submit Property
                </a>
                @else
                <a class="btn btn-primary" href="{{ url('submit-property') }}">Submit
                  Property</a>
                @endif
                @else
                <a data-bs-toggle="modal" data-bs-target="{{ '#user-login-popup' }}" class="btn btn-primary" href="#">
                  Submit Property
                </a>
                @endif
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>--}}


  <nav class="navbar navbar-expand-md navbar-dark">
    <div class="container-fluid">

      <div class="navbar-brand py-0 ">
        <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        @if (Request::is('property/*'))
        <a href="{{ URL::to('/') }}">
          <img src="{{ URL::asset('assets/images/Whitelogo.png') }}" alt="Saakin" height="32">
        </a>
        @else
        <a href="{{ URL::to('/') }}">
          <img src="{{ URL::asset('upload/logo.png') }}" alt="Saakin" height="32">
        </a>
        @endif
      </div>

      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <div id="offcanvasNavbarLabel">
            <a href="{{ URL::to('/') }}">
              <img src="{{ URL::asset('upload/' . getcong('site_favicon')) }}" alt="fav icon" width="45">
            </a>
          </div>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('property-purpose', ['buy', 'sale']) }}">
                Buy
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('property-purpose', ['rent', 'rent']) }}">
                Rent
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('city-guide') }}">
                City Guide
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('real-estate-agencies') }}">
                Real Estate Agencies
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('blogs') }}">
                Blogs
              </a>
            </li>
          </ul>
          <ul class="navbar-nav pe-3 align-items-center d-none d-md-flex">
            <li class="nav-item">
              <a class="nav-link" href="#">Login</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal"
                data-bs-target="#user-login-popup">Submit Property</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>

{{-- <header class="header transparent scroll-hide ">
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
              <img src="{{ URL::asset('assets/images/Whitelogo.png') }}" alt="Saakin" class="img-fluid">
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
                <li><a href="#" data-bs-toggle="modal" data-bs-target="#user-login-popup">Login</a></li>
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
                <a data-bs-toggle="modal" data-bs-target="{{ '#user-login-popup' }}" class="btn v6" href="#">
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
                  <img src="{{ URL::asset('upload/' . getcong('site_favicon')) }}" alt="fav icon" width="45">
                </a>
              </div>


              <div class="site-mobile-menu-body position-relative">
                @if (!Auth::user())
                <a href="{{ url('login') }}" class="btn btn-block btn_mb_login btn-outline-secondary">Register/Sign
                  In</a>
                @else
                <a href="{{ url('logout') }}" class="btn btn-block btn_mb_login btn-outline-secondary">Logout</a>

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
</header> --}}