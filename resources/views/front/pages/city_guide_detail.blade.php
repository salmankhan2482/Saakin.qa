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
      <p class="text-center">{!! $cityGuide->long_description ??'' !!}</p>


      <ul id="cityGideNav" class="cityGideNav list-unstyled spbwx16 can-scroll-x d-flex sticky-top bg-white justify-content-md-center py-2 mb-3 border-bottom">
        <li>
          <a class="nav-link" href="#propertyTrends">
            <svg class="icon-guide">
              <use xlink:href="#home-inspection"></use>
            </svg> Property Trends</a>
        </li>
        <li><a class="nav-link" href="#neighborhood"><svg class="icon-guide">
              <use xlink:href="#town-city"></use>
            </svg> NeighborHood</a></li>
        <li><a class="nav-link" href="#lifestyle"><svg class="icon-guide">
              <use xlink:href="#life-style"></use>
            </svg> Life Style</a></li>
        <li><a class="nav-link" href="#thingsToConsider"><svg class="icon-guide">
              <use xlink:href="#address-location"></use>
            </svg> Things To Consider</a></li>
        <li><a class="nav-link" href="#locations"><svg class="icon-guide">
              <use xlink:href="#home-location"></use>
            </svg> Locations</a></li>
        <li><a class="nav-link" href="#attributes"><svg class="icon-guide">
              <use xlink:href="#grid-view"></use>
            </svg> Attributes</a></li>
      </ul>

      <div class="fs-sm">
        <div id="propertyTrends">
          <h5 class="p-3 rounded bg-dark" style="--bs-bg-opacity:.05;">Property Trends</h5>
          {!! $cityGuideContent->property_trends ??'' !!}
          {{-- <ul class="sub-details">
            <li>Buy</li>
            <li>Rent</li>
            <li>ROI</li>
          </ul> --}}
        </div>
        <div id="neighborhood">
          <h5 class="p-3 rounded bg-dark" style="--bs-bg-opacity:.05;">NeighborHood</h5>
          {{-- <ul class="sub-details">
            <li>Popular Communities</li>
            <li>Public Transport</li>
            <li>Clinics &amp; Hospitals</li>
            <li>Schools</li>
            <li>Super Markets</li>
          </ul> --}}
          {!! $cityGuideContent->neighborhood ??'' !!}
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
                      <li>
                        <i class="fas fa-bed fas-icon"></i>
                        <span>{{ $propx->bedrooms }} </span>
                      </li>
                      <li>
                        <i class="fas fa-bath fas-icon"></i>
                        <span>{{ $propx->bathrooms }}
                        </span>
                      </li>
                    @endif
                    <li>
                      <i class="fas fa-chart-area fas-icon"></i>
                      <span> {{ $propx->getSqm() }} </span>
                    </li>
                  </ul>
                </div>
              </div>
            @endforeach
          </div>

        </div>
        <div id="lifestyle">
          <h5 class="p-3 rounded bg-dark" style="--bs-bg-opacity:.05;">Lifestyle</h5>
          <ul class="sub-details">
            <li>Shopping Malls</li>
            <li>Restaurants</li>
            <li>Beaches</li>
            <li>Fitness &amp; Beauty</li>
          </ul>
          {!! $cityGuideContent->lifestyle ??'' !!}
        </div>
        <div id="thingsToConsider">
          <h5 class="p-3 rounded bg-dark" style="--bs-bg-opacity:.05;">Things to consider</h5>
          <ul class="sub-details">
            <li>Airport</li>
            <li>Metro Station</li>
            <li>Market (wholesale/food)</li>
            <li>Beach</li>
            <li>Stadiums</li>
          </ul>
          {!! $cityGuideContent->things_to_consider ??'' !!}
        </div>
        <div id="locations">
          <h5 class="p-3 rounded bg-dark" style="--bs-bg-opacity:.05;">Locations</h5>
          {{-- <ul class="sub-details">
            <li>Airport</li>
            <li>Metro Station</li>
            <li>Market (wholesale/food)</li>
            <li>Beach</li>
            <li>Stadiums</li>
          </ul> --}}
          {!! $cityGuideContent->locations ??'' !!}

        </div>
        <div id="attributes">
          <h5 class="p-3 rounded bg-dark" style="--bs-bg-opacity:.05;">Attributes</h5>
          {!! $cityGuideContent->attributes ??'' !!}
          {{-- <ul class="sub-details">
            <li>Airport</li>
            <li>Metro Station</li>
            <li>Market (wholesale/food)</li>
            <li>Beach</li>
            <li>Stadiums</li>
          </ul> --}}
        </div>
      </div>

    </div>

    <button class="btn btn-primary scrollTopBtn" onclick="scrollToTop()">
      <i class="fas fa-chevron-up"></i>
    </button>
  </div>

@endsection

@push('styles')
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick.css') }}" />
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick-theme.css') }}" />
@endpush

@push('scripts')

  <?xml version="1.0" encoding="UTF-8" ?>
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="0" height="0" style="display:none;">
    <symbol id="address-location" x="0px" y="0px" viewBox="0 0 122.88 117.55" style="enable-background:new 0 0 122.88 117.55" xml:space="preserve">
      <style type="text/css">
        .st0 {
          fill-rule: evenodd;
          clip-rule: evenodd;
        }

      </style>
      <g>
        <path class="st0"
          d="M78.81,82.78c-4.35,4.77-9.42,9.05-15.12,12.51c-0.7,0.51-1.65,0.58-2.43,0.08 c-8.41-5.35-15.48-11.78-21.03-18.76c-7.66-9.61-12.49-20.27-14.14-30.53c-1.68-10.41-0.11-20.42,5.07-28.56 c2.04-3.22,4.65-6.15,7.83-8.68C46.3,3.01,54.65-0.06,62.96,0c8.01,0.06,15.91,3.05,22.74,9.28c2.4,2.18,4.42,4.68,6.07,7.39 c5.57,9.17,6.77,20.87,4.32,32.73c-2.41,11.71-8.41,23.62-17.28,33.35V82.78L78.81,82.78L78.81,82.78z M25.32,74.54 c1.98,0,3.59,1.61,3.59,3.59c0,1.98-1.61,3.59-3.59,3.59h-6.74l-8.88,28.67h103.22l-9.64-28.67h-5.57c-1.98,0-3.59-1.61-3.59-3.59 c0-1.98,1.61-3.59,3.59-3.59h10.7l14.46,43.01H0l13.32-43.01H25.32L25.32,74.54z M61.38,18.51c9.88,0,17.88,8.01,17.88,17.87 c0,9.88-8.01,17.88-17.88,17.88c-9.88,0-17.87-8-17.87-17.88C43.49,26.51,51.5,18.51,61.38,18.51L61.38,18.51L61.38,18.51z" />
      </g>
    </symbol>
    <symbol id="grid-view" data-name="Layer 1" viewBox="0 0 122.88 112.13">
      <defs>
        <style>
          .cls-1 {
            fill-rule: evenodd;
          }

        </style>
      </defs>
      <title>grid-view</title>
      <path class="cls-1"
        d="M6.65,81.89H23.59a6.67,6.67,0,0,1,6.65,6.65v16.95a6.66,6.66,0,0,1-6.65,6.64H6.65A6.66,6.66,0,0,1,0,105.49V88.54a6.67,6.67,0,0,1,6.65-6.65ZM99.29,0h16.94a6.67,6.67,0,0,1,6.65,6.65V23.59a6.67,6.67,0,0,1-6.65,6.65H99.29a6.67,6.67,0,0,1-6.65-6.65V6.65A6.67,6.67,0,0,1,99.29,0ZM53,0H69.91a6.67,6.67,0,0,1,6.65,6.65V23.59a6.67,6.67,0,0,1-6.65,6.65H53a6.67,6.67,0,0,1-6.65-6.65V6.65A6.67,6.67,0,0,1,53,0ZM6.65,0H23.59a6.67,6.67,0,0,1,6.65,6.65V23.59a6.67,6.67,0,0,1-6.65,6.65H6.65A6.67,6.67,0,0,1,0,23.59V6.65A6.67,6.67,0,0,1,6.65,0ZM99.29,41h16.94a6.66,6.66,0,0,1,6.65,6.64v17a6.66,6.66,0,0,1-6.65,6.64H99.29a6.66,6.66,0,0,1-6.65-6.64v-17A6.66,6.66,0,0,1,99.29,41ZM53,41H69.91a6.66,6.66,0,0,1,6.65,6.64v17a6.66,6.66,0,0,1-6.65,6.64H53a6.66,6.66,0,0,1-6.65-6.64v-17A6.66,6.66,0,0,1,53,41ZM6.65,41H23.59a6.66,6.66,0,0,1,6.65,6.64v17a6.66,6.66,0,0,1-6.65,6.64H6.65A6.66,6.66,0,0,1,0,64.54v-17A6.66,6.66,0,0,1,6.65,41ZM99.29,81.89h16.94a6.67,6.67,0,0,1,6.65,6.65v16.95a6.66,6.66,0,0,1-6.65,6.64H99.29a6.66,6.66,0,0,1-6.65-6.64V88.54a6.67,6.67,0,0,1,6.65-6.65ZM53,81.89H69.91a6.67,6.67,0,0,1,6.65,6.65v16.95a6.66,6.66,0,0,1-6.65,6.64H53a6.66,6.66,0,0,1-6.65-6.64V88.54A6.67,6.67,0,0,1,53,81.89Z" />
    </symbol>
    <symbol id="home-inspection" data-name="Layer 1" viewBox="0 0 118.43 122.88">
      <defs>
        <style>
          .cls-1 {
            fill-rule: evenodd;
          }

        </style>
      </defs>
      <title>home-inspection</title>
      <path class="cls-1"
        d="M11.1,56.77A9,9,0,0,1,5,57.06,7.3,7.3,0,0,1,.05,50.89a9.59,9.59,0,0,1,2.31-7.1h0a2.06,2.06,0,0,1,.33-.33L57.68.53a2,2,0,0,1,2.6-.1L115.4,43.27h0a1.31,1.31,0,0,1,.24.23,9.06,9.06,0,0,1,2.58,8.36,7.78,7.78,0,0,1-1.76,3.35,7.65,7.65,0,0,1-3.12,2.12,8.44,8.44,0,0,1-6.54-.43q0,22.79,0,45.56H85.64c.07-.34.13-.69.19-1a28.14,28.14,0,0,0,.32-2.91H101.4v-44c0-1-37.81-30.86-42-34.11-4.43,3.37-42.93,33-42.93,34.27V98.51h14.4a28.54,28.54,0,0,0,.33,2.88l.06.39c0,.23.08.45.13.68H11.09q0-22.83,0-45.69Zm49.48-16V53.62H72.13v0A13,13,0,0,0,60.58,40.75Zm0,15.59v9.23H72.13V56.34Zm-2.72,9.22V56.34H46.31v9.23H57.86Zm0-11.94V40.75A13,13,0,0,0,46.31,53.59v0ZM59.22,38A15.64,15.64,0,0,1,74.84,53.58v14.7H43.59V53.58A15.65,15.65,0,0,1,59.22,38Zm-.31,38.9A20,20,0,0,1,78.56,97.3a20.38,20.38,0,0,1-.94,5.71,20.06,20.06,0,0,1-2.13,4.57l7.6,8.61a1,1,0,0,1-.08,1.36l-5.81,5.09a1,1,0,0,1-1.35-.09l-7.26-8.3a20.28,20.28,0,0,1-4.64,2,20,20,0,0,1-19.88-5.4l0,0a20,20,0,0,1,14.89-33.9Zm11.14,9a16.19,16.19,0,0,0-5.13-3.58l0,0a16,16,0,0,0-21,8.28l0,0a16.08,16.08,0,0,0-.22,12.19A16.17,16.17,0,0,0,47,108a16,16,0,0,0,5.13,3.57,15.79,15.79,0,0,0,6.09,1.33,16,16,0,0,0,11.41-4.46,16.23,16.23,0,0,0,3.57-5.12,16.09,16.09,0,0,0,.24-12.24,16.06,16.06,0,0,0-3.37-5.26ZM90.36,3.42l16.55.68V26.45L90.36,15.53V3.42Z" />
    </symbol>
    <symbol id="home-location" x="0px" y="0px" viewBox="0 0 92.26 122.88" style="enable-background:new 0 0 92.26 122.88" xml:space="preserve">
      <style type="text/css">
        .st0 {
          fill-rule: evenodd;
          clip-rule: evenodd;
        }

      </style>
      <g>
        <path class="st0"
          d="M47.49,116.85c6.31-4.01,11.98-8.87,16.92-14.29c10.73-11.75,17.97-26.11,20.87-40.2 c2.88-13.91,1.52-27.54-4.85-38.06c-1.81-3.02-4.08-5.78-6.78-8.26c-7.74-7.05-16.6-10.41-25.52-10.5 c-9.37-0.07-18.87,3.45-27.27,10.14c-3.58,2.86-6.53,6.15-8.82,9.78c-5.9,9.28-7.69,20.8-5.74,32.85 c1.97,12.23,7.78,25.02,17.04,36.61c6.44,8.08,14.54,15.58,24.18,21.91L47.49,116.85L47.49,116.85L47.49,116.85z M46.13,23.84 L22.76,46.73l5.7,2.99l17.52-18.39L63.8,49.72l5.7-2.99L46.13,23.84L46.13,23.84z M29.71,51.2L29.71,51.2l16.45-16.45l16.4,16.45h0 v16.14H50.58v-11.4h-8.99v11.4l-11.88,0V51.2L29.71,51.2z M68.52,106.27c-5.6,6.12-12.09,11.61-19.42,16.06 c-0.88,0.66-2.13,0.75-3.13,0.11c-10.8-6.87-19.85-15.13-26.99-24.09C9.15,86.02,2.94,72.34,0.83,59.16 c-2.16-13.36-0.14-26.2,6.51-36.68c2.63-4.13,5.97-7.89,10.07-11.14C26.78,3.88,37.51-0.07,48.17,0 c10.28,0.09,20.42,3.9,29.22,11.93c3.09,2.81,5.67,5.99,7.78,9.48c7.15,11.77,8.69,26.81,5.56,42.01 c-3.11,15.04-10.8,30.33-22.19,42.8L68.52,106.27L68.52,106.27L68.52,106.27z" />
      </g>
    </symbol>
    <symbol id="life-style" x="0px" y="0px" viewBox="0 0 122.88 94.15" style="enable-background:new 0 0 122.88 94.15" xml:space="preserve">
      <g>
        <path
          d="M6.33,50.34l-1.56,0.83c0,0-0.01,0.01-0.01,0.01c-0.11,0.05-0.23,0.07-0.35,0.04c-0.12-0.03-0.23-0.09-0.31-0.2 c0,0-0.01-0.01-0.01-0.01l-3.96-5.16l0,0c0,0-0.01-0.01-0.02-0.02c-0.01-0.01-0.01-0.02-0.02-0.03l0-0.01 c-0.08-0.12-0.1-0.26-0.08-0.39c0.02-0.13,0.1-0.26,0.22-0.34l8.79-6.05c0.02-0.02,0.04-0.03,0.06-0.04 c0.11-0.06,0.24-0.08,0.36-0.06c0.12,0.02,0.23,0.09,0.31,0.19c0.02,0.02,0.03,0.05,0.05,0.07c0.51,0.91,1.06,1.67,1.63,2.27 c0.58,0.61,1.17,1.06,1.77,1.34c0.27,0.13,0.54,0.22,0.8,0.28c0.27,0.06,0.53,0.08,0.79,0.08c0.26-0.01,0.52-0.05,0.78-0.12 c0.26-0.07,0.51-0.18,0.77-0.33c0.53-0.3,1.04-0.74,1.52-1.33c0.47-0.58,0.92-1.3,1.33-2.16c0,0,0-0.01,0-0.01 c0-0.01,0.01-0.02,0.01-0.03c0.01-0.01,0.01-0.03,0.02-0.04l0,0c0.08-0.12,0.2-0.2,0.34-0.23c0.13-0.03,0.28,0,0.4,0.08l0,0 l9.05,6.01c0,0,0.01,0,0.01,0.01l0,0l0,0v0l0.01,0.01l0,0l0,0l0,0c0.12,0.09,0.19,0.22,0.2,0.35c0.02,0.13-0.02,0.28-0.1,0.39 l-3.99,5.24l0,0c-0.07,0.1-0.18,0.17-0.29,0.2c-0.12,0.03-0.24,0.02-0.36-0.03l-1.76-0.81c-0.21,1.06-0.36,2.11-0.46,3.15 c-0.1,1.11-0.15,2.22-0.14,3.31c0.01,1.16,0.08,2.32,0.2,3.48c0.12,1.15,0.29,2.31,0.49,3.47c0,0.01,0,0.02,0,0.02 c0,0.01,0,0.01,0,0.02l0,0.01c0,0.01,0,0.03,0,0.04c0,0.15-0.06,0.28-0.16,0.38l0,0v0l0,0c-0.1,0.1-0.23,0.16-0.38,0.16v0 L6.86,64.43c-0.02,0-0.05,0-0.07,0c-0.02,0-0.05-0.01-0.07-0.01c-0.14-0.03-0.26-0.12-0.33-0.23c-0.07-0.11-0.1-0.26-0.07-0.4 c0.24-1.08,0.44-2.18,0.57-3.3c0.13-1.12,0.21-2.26,0.21-3.42c0-1.1-0.06-2.22-0.19-3.38C6.78,52.6,6.59,51.49,6.33,50.34 L6.33,50.34L6.33,50.34z M107.47,42.48L92.06,56.35l3.56,1.87l11.76-11.07l11.95,11.07l3.56-1.87L107.47,42.48L107.47,42.48z M97.22,59.42L97.22,59.42l10.26-9.85l10.23,9.85h0v10.07h-7.48v-7.12h-5.61v7.12h-7.41V59.42L97.22,59.42z M56.96,6.98 c1.19,0.15,2.47-0.13,3.85-0.87c-0.14,1.03-0.15,2.15-0.02,3.37c-0.67-0.06-1.34-0.19-2.01-0.4c-7.98-2.51-12.4,6.67-8.26,13.94 c1.24,2.18,2.74,4.42,5.07,6.45c2.21,1.59,4.16,1.37,5.96,0.39c1.43,0.68,2.95,0.95,4.58,0.34c2.39-0.9,4.83-4.45,5.98-6.65 c2.51-4.8,3.36-10.96-2.24-13.96c-1.53-0.82-3.44-1.06-5.86-0.52c-0.58,0.2-1.15,0.32-1.72,0.38c0-0.01,0-0.02,0-0.04 c-0.2-1.86-0.06-3.44,0.38-4.79c0.43-1.32,1.16-2.42,2.15-3.33c0.3-0.28,0.32-0.75,0.04-1.05c-0.28-0.3-0.75-0.32-1.05-0.04 c-1.17,1.08-2.04,2.39-2.56,3.97c-0.07,0.2-0.13,0.41-0.18,0.63c-1.49-2.65-4.03-4.03-8.2-3.39l-1.64,0.17 C52.43,4.06,53.91,6.6,56.96,6.98L56.96,6.98L56.96,6.98z M52.94,20.14c0.3-0.1,0.62,0.06,0.72,0.36c0.32,0.96,0.8,1.82,1.39,2.6 c0.61,0.79,1.33,1.51,2.15,2.17c0.24,0.2,0.28,0.55,0.08,0.8c-0.2,0.24-0.55,0.28-0.8,0.08c-0.88-0.72-1.67-1.5-2.33-2.36 c-0.67-0.88-1.21-1.84-1.57-2.93C52.48,20.56,52.64,20.24,52.94,20.14L52.94,20.14L52.94,20.14z M16,90.96 c0.51,1.14,0,2.48-1.15,2.99c-1.14,0.51-2.48,0-2.99-1.15c-1.27-2.84-2.31-5.79-3.07-8.83c-0.75-2.99-1.25-6.08-1.48-9.25 c-0.04-0.56-0.07-1.2-0.1-1.92c-0.03-0.78-0.04-1.42-0.04-1.93c0-1.26,1.02-2.27,2.27-2.27c1.26,0,2.27,1.02,2.27,2.27 c0,0.73,0.01,1.32,0.02,1.77c0.02,0.51,0.05,1.1,0.1,1.76c0.21,2.9,0.66,5.73,1.35,8.47C13.9,85.68,14.84,88.38,16,90.96L16,90.96z M28.01,34.35c-0.93,0.83-2.36,0.75-3.2-0.18c-0.83-0.93-0.75-2.36,0.18-3.2c2.12-1.89,4.6-3.83,7.16-5.5 c2.29-1.5,4.67-2.79,6.93-3.67c1.17-0.45,2.48,0.13,2.93,1.3c0.45,1.17-0.13,2.48-1.3,2.93c-1.94,0.75-4.04,1.9-6.09,3.24 C32.24,30.82,29.95,32.61,28.01,34.35L28.01,34.35z M80.97,26.12c-1.14-0.51-1.65-1.86-1.14-3c0.52-1.14,1.86-1.65,3-1.14 c3.55,1.61,6.9,3.58,9.98,5.88c3.1,2.31,5.95,4.96,8.5,7.9c0.82,0.95,0.72,2.38-0.23,3.2c-0.95,0.82-2.38,0.72-3.2-0.23 c-2.31-2.67-4.93-5.1-7.79-7.23C87.26,29.39,84.21,27.58,80.97,26.12L80.97,26.12z M109.43,77.38c0.16-1.24,1.3-2.12,2.54-1.95 c1.24,0.16,2.12,1.3,1.95,2.54c-0.34,2.56-0.85,5.04-1.53,7.44c-0.69,2.47-1.56,4.85-2.57,7.14c-0.51,1.15-1.85,1.67-2.99,1.16 c-1.15-0.51-1.67-1.85-1.16-2.99c0.94-2.11,1.73-4.3,2.36-6.54C108.66,81.96,109.13,79.69,109.43,77.38L109.43,77.38z M51.4,80.84 c3.3,9.71,17.09,10.07,20.19,0c3.65,3.28,14.45,3.94,18.47,6.18c1.27,0.71,2.42,1.61,3.34,2.83c0.62,0.82,1.45,2.33,2.07,4.02 H27.52c0.63-1.69,1.45-3.2,2.07-4.02c0.92-1.22,2.07-2.12,3.34-2.83C36.95,84.78,47.75,84.12,51.4,80.84L51.4,80.84L51.4,80.84z M48.87,60.71c-0.69,0.03-1.22,0.17-1.57,0.41c-0.2,0.14-0.35,0.31-0.45,0.52c-0.11,0.23-0.16,0.51-0.15,0.84 c0.03,0.95,0.53,2.19,1.49,3.62l0.01,0.02l0,0l3.12,4.96c1.25,1.99,2.56,4.02,4.2,5.51c1.57,1.43,3.47,2.4,5.99,2.41 c2.72,0.01,4.72-1,6.33-2.52c1.68-1.58,3.01-3.73,4.32-5.89l3.52-5.79c0.66-1.5,0.89-2.5,0.74-3.08c-0.09-0.35-0.48-0.52-1.13-0.55 c-0.14-0.01-0.28-0.01-0.43,0c-0.16,0-0.32,0.02-0.49,0.03c-0.09,0.01-0.18,0-0.27-0.02c-0.31,0.02-0.63,0-0.96-0.05l1.2-4.83 c-8.94,1.41-15.62-5.23-25.07-1.33l0.68,5.79C49.57,60.77,49.21,60.76,48.87,60.71L48.87,60.71L48.87,60.71z M76.49,59.59 c0.87,0.26,1.42,0.81,1.65,1.7c0.25,0.98-0.02,2.37-0.86,4.26l0,0c-0.02,0.03-0.03,0.07-0.05,0.1l-3.56,5.86 c-1.37,2.26-2.76,4.52-4.62,6.26c-1.92,1.8-4.29,3-7.54,2.99c-3.03-0.01-5.31-1.16-7.18-2.87c-1.81-1.65-3.19-3.78-4.5-5.87 l-3.12-4.96c-1.14-1.7-1.73-3.26-1.77-4.54c-0.02-0.6,0.08-1.15,0.31-1.62c0.23-0.5,0.59-0.92,1.07-1.25 c0.23-0.15,0.48-0.28,0.76-0.39c-0.2-2.69-0.28-5.59-0.15-8.43c0.07-0.67,0.2-1.35,0.38-2.02c0.8-2.85,2.8-4.15,5.27-5.73 c1.36-0.87,2.86-1.53,4.42-1.97c0.99-0.28-0.84-3.45,0.18-3.56c4.96-0.51,12.98,4.02,16.44,7.76c1.73,1.88,2.82,3.37,3.06,6.66 L76.49,59.59L76.49,59.59L76.49,59.59z" />
      </g>
    </symbol>
    <symbol id="town-city" x="0px" y="0px" viewBox="0 0 122.88 86.59" style="enable-background:new 0 0 122.88 86.59" xml:space="preserve">
      <g>
        <path
          d="M53.65,50.1h-0.71v34.17h13.7v-17.2c0-0.55,0.44-0.99,0.99-0.99h11.49c0.55,0,0.99,0.44,0.99,0.99v17.2h40.44V32.4H96.02 v51.86h-2.32V2.32H52.89v39.89l2.98,4.75c0.19,0.3,0.28,0.62,0.28,0.95c0,0.42-0.15,0.81-0.4,1.14c-0.15,0.2-0.34,0.38-0.55,0.53 l-0.13,0.09C54.65,49.93,54.13,50.1,53.65,50.1L53.65,50.1z M109.67,3.62c5.55-3.84,5.97,3.76,11.42-0.98v7.74 c-5.2,4.68-6.32-2.88-11.42,0.96V3.62L109.67,3.62z M108.3,1.51c0.59,0,1.06,0.47,1.06,1.06c0,0.39-0.21,0.73-0.52,0.91h0.05v9.31 c2.98,4.14,13.99,18.96,13.99,19v53.64c0,0.64-0.52,1.16-1.16,1.16c-23.72,0-47.44,0-71.15,0v0H34.49H21.65H4.55 c-0.75,0-1.35-0.61-1.35-1.35V50.1H2.49c-0.47,0-1-0.17-1.42-0.43c-0.26-0.17-0.5-0.38-0.68-0.61C0.15,48.72,0,48.33,0,47.91 c0-0.32,0.09-0.65,0.28-0.95c2.74-4.37,5.66-8.78,8.28-13.21c0.42-0.76,0.81-1.46,2.07-1.46h34.87c1.26,0,1.65,0.7,2.08,1.47 L47.72,34l2.84,4.52V2.04c0-0.56,0.23-1.07,0.6-1.44v0C51.53,0.23,52.04,0,52.6,0h41.37c0.56,0,1.07,0.23,1.44,0.6l0.09,0.1 c0.32,0.36,0.51,0.83,0.51,1.35v28.04l11.69-17.47V3.48h0.05c-0.31-0.18-0.52-0.52-0.52-0.91C107.24,1.99,107.71,1.51,108.3,1.51 L108.3,1.51z M68.63,84.26h9.51V68.05h-9.51V84.26L68.63,84.26z M21.85,55.58h11.58v7.7H21.85V55.58L21.85,55.58z M24.74,66.16 h6.65c1.22,0,2.34,0.5,3.14,1.31c0.81,0.81,1.31,1.92,1.31,3.14v13.28h14.4V50.1H5.9v33.79h14.4V70.61c0-1.22,0.5-2.34,1.31-3.14 C22.41,66.66,23.52,66.16,24.74,66.16L24.74,66.16z M31.4,68.86h-6.65c-0.48,0-0.91,0.2-1.23,0.51C23.2,69.69,23,70.13,23,70.61 v13.28h10.14V70.61c0-0.48-0.2-0.91-0.51-1.23C32.31,69.06,31.88,68.86,31.4,68.86L31.4,68.86z M40.11,69.5h6.67v7.7h-6.67V69.5 L40.11,69.5z M40.11,55.58h6.67v7.7h-6.67V55.58L40.11,55.58z M9.37,69.5h6.67v7.7H9.37V69.5L9.37,69.5z M9.37,55.58h6.67v7.7H9.37 V55.58L9.37,55.58z M57.89,6.69h30.98v24.38H57.89V6.69L57.89,6.69z M102.15,63.51h12.81c0.11,0,0.2,0.07,0.2,0.14v3.78 c0,0.07-0.09,0.14-0.2,0.14h-12.81c-0.1,0-0.2-0.06-0.2-0.14v-3.78C101.96,63.58,102.05,63.51,102.15,63.51L102.15,63.51z M102.15,55.23h12.81c0.11,0,0.2,0.07,0.2,0.14v3.78c0,0.07-0.09,0.14-0.2,0.14h-12.81c-0.1,0-0.2-0.06-0.2-0.14v-3.78 C101.96,55.3,102.05,55.23,102.15,55.23L102.15,55.23z M102.15,46.95h12.81c0.11,0,0.2,0.07,0.2,0.14v3.78 c0,0.07-0.09,0.14-0.2,0.14h-12.81c-0.1,0-0.2-0.06-0.2-0.14v-3.78C101.96,47.02,102.05,46.95,102.15,46.95L102.15,46.95z M81.62,53.4h6.84c0.11,0,0.2,0.09,0.2,0.2v6.84c0,0.11-0.09,0.2-0.2,0.2h-6.84c-0.11,0-0.2-0.09-0.2-0.2V53.6 C81.43,53.49,81.52,53.4,81.62,53.4L81.62,53.4z M69.87,53.4h6.84c0.11,0,0.2,0.09,0.2,0.2v6.84c0,0.11-0.09,0.2-0.2,0.2h-6.84 c-0.11,0-0.2-0.09-0.2-0.2V53.6C69.67,53.49,69.76,53.4,69.87,53.4L69.87,53.4z M58.12,53.4h6.84c0.11,0,0.2,0.09,0.2,0.2v6.84 c0,0.11-0.09,0.2-0.2,0.2h-6.84c-0.11,0-0.2-0.09-0.2-0.2V53.6C57.92,53.49,58.01,53.4,58.12,53.4L58.12,53.4z M81.62,40.13h6.84 c0.11,0,0.2,0.09,0.2,0.2v6.84c0,0.11-0.09,0.2-0.2,0.2h-6.84c-0.11,0-0.2-0.09-0.2-0.2v-6.84C81.43,40.22,81.52,40.13,81.62,40.13 L81.62,40.13z M69.87,40.13h6.84c0.11,0,0.2,0.09,0.2,0.2v6.84c0,0.11-0.09,0.2-0.2,0.2h-6.84c-0.11,0-0.2-0.09-0.2-0.2v-6.84 C69.67,40.22,69.76,40.13,69.87,40.13L69.87,40.13z M58.12,40.13h6.84c0.11,0,0.2,0.09,0.2,0.2v6.84c0,0.11-0.09,0.2-0.2,0.2h-6.84 c-0.11,0-0.2-0.09-0.2-0.2v-6.84C57.92,40.22,58.01,40.13,58.12,40.13L58.12,40.13z" />
      </g>
    </symbol>
  </svg>


  <script type="text/javascript" src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $(document).on("scroll", onScroll);

      //smoothscroll
      $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();

        $(document).off("scroll");

        var navHeight = jQuery('.cityGideNav').outerHeight() + 20;
        var target = this.hash,
          menu = target;
        $target = $(target);

        $('html, body').stop().animate({
          scrollTop: jQuery($target).offset().top - navHeight
        }, 500, 'swing', function() {
          window.location.hash = target;
          $(document).on("scroll", onScroll);
        });
      });
    });

    function onScroll(event) {
      var scrollPos = $(document).scrollTop();
      var navHeight = jQuery('.cityGideNav').outerHeight() + 20;
      $('#cityGideNav .nav-link').each(function() {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        // console.log(currLink);
        if (refElement.offset().top - navHeight <= scrollPos && refElement.offset().top - navHeight + refElement.height() > scrollPos) {
          $('#cityGideNav .nav-link').removeClass("active");
          currLink.addClass("active");
        } else {
          currLink.removeClass("active");
        }
      });
    }
  </script>

  <script>
    function scrollToTop() {
      $(window).scrollTop(0);
    }

    $(document).ready(function() {

      $(".pro-same-slider").slick({
        arrows: false,
        dots: false,
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