@extends("front-view.layouts.main")
@if ($cityGuide->meta_title != null)
  @section('title', $cityGuide->meta_title . ' | ' . 'Saakin.qa')
  @section('description', $cityGuide->meta_description)
  @section('keyword', $cityGuide->meta_keyword)
  @section('type', 'City Guide Saakin.qa')
  @section('url', url()->current())
  @section('image', asset('upload/cities/' . $cityGuide->city_image))
@else
  @section('title', $cityGuide->name . ' | ' . 'Saakin.qa')
  @section('description', $cityGuide->short_description)
  @section('keyword', $cityGuide->attributes)
  @section('type', 'City Guide Saakin.qa')
  @section('url', url()->current())
  @section('image', asset('upload/cities/' . $cityGuide->city_image))
@endif
@section('content')

  <div class="site-banner" style="background-image: url({{ asset('upload/cities/' . $cityGuide->city_image) }}); background-position: center;">
    <div class="container">
      <h1 class="text-center">{{ $cityGuide->name }}</h1>
      <div class="text-white fs-sm d-flex justify-content-center spbwx8">
        <span><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></span>
        <span>/</span>
        <span><a href="{{ url('/city-guide') }}" class="text-white text-decoration-none">City Guide</a></span>
        <span>/</span>
        <span> {{ $cityGuide->name }}</span>
      </div>
    </div>
  </div>

  <div class="inner-content">
    <div class="container">
      <h3 class="mb-4 text-center">Welcome to {{ $cityGuide->name }}</h3>
      <p class="text-center">{{ $cityGuide->short_description }}</p>

      <nav id="cityGideNav" class="cityGideNav spbwx16 can-scroll-x d-flex sticky-top bg-white justify-content-md-center py-2 mb-3 border-bottom">
        <a class="nav-link" href="#guidePropertyTrends">
          <svg class="icon-guide">
            <use xlink:href="#home-inspection"></use>
          </svg> Property Trends</a>
        <a class="nav-link" href="#guideNeighborHood"><svg class="icon-guide">
            <use xlink:href="#town-city"></use>
          </svg> NeighborHood</a>
        <a class="nav-link" href="#guideLifeStyle"><svg class="icon-guide">
            <use xlink:href="#lifestyle"></use>
          </svg> Life Style</a>
        <a class="nav-link" href="#guideThingsToConsider"><svg class="icon-guide">
            <use xlink:href="#address-location"></use>
          </svg> Things To Consider</a>
        <a class="nav-link" href="#guideLocations"><svg class="icon-guide">
            <use xlink:href="#home-location"></use>
          </svg> Locations</a>
        <a class="nav-link" href="#guideAttributes"><svg class="icon-guide">
            <use xlink:href="#grid-view"></use>
          </svg> Attributes</a>
      </nav>
      <div class="fs-sm" data-bs-spy="scroll" data-bs-target="#cityGideNav" data-bs-offset="100" tabindex="0">
        <div id="guidePropertyTrends">
          <h5 class="p-3 rounded bg-dark" style="--bs-bg-opacity:.05;">Property Trends</h5>
          {!! $cityGuideContent->property_trends ??'' !!}
          {{-- <ul class="sub-details">
            <li>Buy</li>
            <li>Rent</li>
            <li>ROI</li>
          </ul> --}}

        </div>
        <div id="guideNeighborHood">
          <h5 class="p-3 rounded bg-dark" style="--bs-bg-opacity:.05;">NeighborHood</h5>
          <ul class="sub-details">
            <li>Popular Communities</li>
            <li>Public Transport</li>
            <li>Clinics &amp; Hospitals</li>
            <li>Schools</li>
            <li>Super Markets</li>
          </ul>
          <div class="p-2 border mb-3">
            <iframe class="d-block"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d714.7768477657363!2d74.3806660590514!3d31.549670099468507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3919053f257c413f%3A0x4600666a4d2dbdf1!2sServaid%20Pharmacy!5e0!3m2!1sen!2s!4v1648668166597!5m2!1sen!2s"
              width="100%" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          <div class="mb-3 @if ((new \Jenssegers\Agent\Agent())->isMobile()) pro-same-m d-flex can-scroll-x spbwx16 @else pro-same-slider @endif">
            @foreach ($propertiesForRent as $propx)
              <div class="single-property-box border">
                <div class="property-item">
                  <a class="property-img" href="{{ url(strtolower($propx->property_purpose) . '/' . $propx->property_slug . '/' . $propx->id) }}">
                    @if ($propx->featured_image)
                      <img src="{{ URL::asset('upload/properties/thumb_' . $propx->featured_image) }}" alt="{{ $propx->property_name }}">
                    @else
                      <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}" alt="{{ $propx->property_name }}">
                    @endif
                  </a>
                  <ul class="feature_text">
                    @if ($propx->featured_property == 1)
                      <li class="feature_cb"><span> Featured</span>
                      </li>
                    @endif
                    @if (!empty($propx->property_purpose))
                      <li class="feature_or">
                        <span>{{ $propx->property_purpose }}</span>
                      </li>
                    @endif

                  </ul>
                  <div class="property-author-wrap">
                    <div class="property-author">
                      <span>{{ $propx->getPrice() }}
                        @if ($propx->property_purpose == 'For Rent' || $propx->property_purpose == 'Rent')
                          / Month
                        @endif
                      </span>
                    </div>
                  </div>
                </div>
                <div class="property-title-box">
                  <h2 class="property-card__property-title ">
                    {{ \Illuminate\Support\Str::limit($propx->property_name) }}
                  </h2>
                  <div class="property-location">
                    <p class="text-truncate">
                      {{ $propx->propertiesTypes->types }}
                      <br>
                      {{ $propx->address }}
                    </p>
                  </div>

                  <ul class="property-feature">
                    @if ($propx->getProperty_type())
                      <li style="width: 30% !important;">
                        <i class="fas fa-bed fas-icon"></i>
                        <span>{{ $propx->bedrooms }} </span>
                      </li>
                      <li style="width: 30% !important;">
                        <i class="fas fa-bath fas-icon"></i>
                        <span>{{ $propx->bathrooms }}
                        </span>
                      </li>
                    @endif
                    <li style="width: 40% !important;">
                      <i class="fas fa-chart-area fas-icon"></i>
                      <span> {{ $propx->getSqm() }} </span>
                    </li>
                  </ul>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <div id="guideLifeStyle">
          <h5 class="p-3 rounded bg-dark" style="--bs-bg-opacity:.05;">Lifestyle</h5>
          <ul class="sub-details">
            <li>Shopping Malls</li>
            <li>Restaurants</li>
            <li>Beaches</li>
            <li>Fitness &amp; Beauty</li>
          </ul>
        </div>
        <div id="guideThingsToConsider">
          <h5 class="p-3 rounded bg-dark" style="--bs-bg-opacity:.05;">Things to consider</h5>
          <ul class="sub-details">
            <li>Airport</li>
            <li>Metro Station</li>
            <li>Market (wholesale/food)</li>
            <li>Beach</li>
            <li>Stadiums</li>
          </ul>
        </div>
        <div id="guideLocations">
          <h5 class="p-3 rounded bg-dark" style="--bs-bg-opacity:.05;">Locations</h5>
          <ul class="sub-details">
            <li>Airport</li>
            <li>Metro Station</li>
            <li>Market (wholesale/food)</li>
            <li>Beach</li>
            <li>Stadiums</li>
          </ul>
        </div>
        <div id="guideAttributes">
          <h5 class="p-3 rounded bg-dark" style="--bs-bg-opacity:.05;">Attributes</h5>
          <ul class="sub-details">
            <li>Airport</li>
            <li>Metro Station</li>
            <li>Market (wholesale/food)</li>
            <li>Beach</li>
            <li>Stadiums</li>
          </ul>
        </div>
      </div>

    </div>
  </div>

@endsection

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick-theme.css') }}" />
@endpush

@push('scripts')
  @php
  include_once 'assets/images/svgsprite/icons.svg';
  @endphp

  <script type="text/javascript" src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>

  <script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
      target: '#cityGideNav'
    })

    $(document).ready(function() {

      $(".pro-same-slider").slick({
        arrows: false,
        dots: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [{
            breakpoint: 991,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });
    });
  </script>
@endpush
