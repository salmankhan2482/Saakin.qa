{{-- input to store the value and then using for search purpose --}}
<input type="hidden" id="globalPropertyPurposeValue" value="{{ $request->property_purpose ?? 'Rent' }}">
<input type="hidden" id="globalPropertyTypeValue" value="{{ $type->id ?? '' }}">

<footer class="site_footer">
  <div class="container">
    <div class="d-md-flex justify-content-between border-bottom pb-4 mb-4">
      <div class="d-sm-flex align-items-center spbwx8 mb-3 mb-md-0">
        <h5 class="title text-white mb-sm-0">Sign up for the newsletter</h5>
        <div class="value-input-wrap newsletter">
          @include('front-view.pages.include.newsletter')
        </div>
      </div>
      <div class="d-flex align-items-center justify-content-center justify-content-md-betwee">
        <span class="text-white fs-6 d-none d-md-none">Follow us on</span>
        <div class="sm-icon">
          <a class="fab fa-facebook-f" target="_blank" href="{{ getcong('social_facebook') }}"></a>
          <a class="fab fa-instagram" target="_blank" href="{{ getcong('social_instagram') }}"></a>
          <a class="fab fa-linkedin-in" target="_blank" href="{{ getcong('social_linkedin') }}"></a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-3">
        <h5 class="title text-white">{{ getcong('footer_widget1_title') }}</h5>
        <ul class="footer-links">
          {!! stripslashes(getcong('footer_widget1')) !!}
        </ul>
      </div>
      <div class="col-md-6 col-lg-3">
        <h5 class="title text-white">{{ getcong('footer_widget1_title') }}</h5>
        <ul class="footer-links">
          {!! stripslashes(getcong('footer_widget1')) !!}
        </ul>
      </div>
      <div class="col-md-6 col-lg-3">
        <h5 class="title text-white">{{ getcong('footer_widget2_title') }}</h5>
        <ul class="footer-links">
          {!! stripslashes(getcong('footer_widget2')) !!}
        </ul>
      </div>
      <div class="col-md-6 col-lg-3">
        <h5 class="title text-white">{{ getcong('footer_widget3_title') }}</h5>
        <ul class="footer-links">
          {!! stripslashes(getcong('footer_widget3')) !!}
        </ul>
      </div>

    </div>
  </div>

  <div class="bottom-area border-top mt-3 pt-3">
    <div class="container">
      <div class="d-flex justify-content-center justify-content-lg-start align-items-center item-separator text-center">

        @if ((new \Jenssegers\Agent\Agent())->isDesktop())
          <div>
            <a href="{{ URL::to('/') }}">
              <img src="{{ URL::asset('upload/logo.png') }}" alt="{{ getcong('site_name') . 'Logo Pic' }}" width="100">
            </a>
          </div>
        @endif

        <div class="text-white">
          Copyright © 2017 - {{ now()->year }} | <a href="https://www.saakin.com" class="text-decoration-none" target="_blank">SAAKIN
            INC</a>. | All
          Rights Reserved.
        </div>
        @if ((new \Jenssegers\Agent\Agent())->isDesktop())
          <div>
            <ul class="d-flex list-unstyled spbwx8 my-0 footer-links">
              {!! stripslashes(getcong('footer_widget3')) !!}
            </ul>
          </div>
        @endif
      </div>
    </div>
  </div>
</footer>


@include('front-view.modals.userlogin')
@include('front-view.pages.include.emailModal')
@include('front-view.modals.propertyReportModal')
@include('front-view.layouts.jsscripts')
