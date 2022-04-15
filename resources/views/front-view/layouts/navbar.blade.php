<header class="header">

  <nav class="navbar navbar-expand-md navbar-dark">
    <div class="container-fluid">

      <div class="navbar-brand py-0 @if ((new \Jenssegers\Agent\Agent())->isMobile()) mobile-navbar @endif">
        <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        @if (Request::is('property/*'))
          <a href="{{ URL::to('/') }}">
            <img src="{{ URL::asset('assets/images/Whitelogo.png') }}" class="ms-3" alt="Saakin" height="32">
          </a>
        @else
          <a href="{{ URL::to('/') }}">
            <img src="{{ URL::asset('upload/logo.png') }}" class="ms-3" alt="Saakin" height="32">
          </a>
        @endif

        {{-- for Mobile --}}
        @if ((new \Jenssegers\Agent\Agent())->isMobile())
        <div class="d-flex d-md-none align-items-center ms-auto login-btns">
            @if (!Auth::user())
              <a class="fs-sm me-2" href="#" data-bs-toggle="modal" data-bs-target="#user-login-popup">Login</a>
            @else
              <a class="fs-sm me-2" href="{{ url('logout') }}" class="nav-link">Logout</a>
            @endif

            @if (Auth::user())
              @if (Auth::user()->usertype == 'Agency')
                <a class="btn btn-primary btn-sm" href="{{ URL::to('admin/properties/create') }}">
                  Submit Property</a>
              @elseif(Auth::user()->usertype == 'Admin')
                <a class="btn btn-primary btn-sm" href="{{ URL::to('admin/properties/create') }}">
                  Submit Property
                </a>
              @else
                <a class="btn btn-primary btn-sm" href="{{ url('submit-property') }}">Submit
                  Property</a>
              @endif
            @else
              <a data-bs-toggle="modal" data-bs-target="{{ '#user-login-popup' }}" class="btn btn-primary btn-sm" href="#">
                Submit Property
              </a>
            @endif
          </div>
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
                Guide
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('real-estate-agencies') }}">
                Real Estate Agencies
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('blogs') }}">
                Blog
              </a>
            </li>
          </ul>
          <ul class="navbar-nav pe-3 align-items-center d-none d-md-flex">
            @if (!Auth::user())
              <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#user-login-popup">Login</a></li>
            @else
              <li class="nav-item"><a href="{{ url('logout') }}" class="nav-link">Logout</a></li>
            @endif

            @if (Auth::user())
              @if (Auth::user()->usertype == 'Agency')
                <li class="nav-item">
                  <a class="btn btn-primary btn-sm" href="{{ URL::to('admin/properties/create') }}">
                    Submit Property</a>
                </li>
              @elseif(Auth::user()->usertype == 'Admin')
                <li class="nav-item">
                  <a class="btn btn-primary btn-sm" href="{{ URL::to('admin/properties/create') }}">
                    Submit Property
                  </a>
                </li>
              @else
                <li class="nav-item">
                  <a class="btn btn-primary btn-sm" href="{{ url('submit-property') }}">Submit
                    Property</a>
                </li>
              @endif
            @else
              <li class="nav-item">
                <a data-bs-toggle="modal" data-bs-target="{{ '#user-login-popup' }}" class="btn btn-primary btn-sm" href="#">
                  Submit Property
                </a>
              </li>
            @endif

          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>

