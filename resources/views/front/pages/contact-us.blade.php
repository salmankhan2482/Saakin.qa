@extends("front-view.layouts.main")

@section('title', ' Contact Us | Saakin.qa')
@section('description', 'For any query or getting useful information about the properties in Qatar, feel free to contact us: hello@saakin.qa')
@section('type', 'contact-us')

@section('content')


  <div class="site-banner" style="background-image: url('{{ asset('assets/images/backgrounds/bg-4.jpg') }}')">
    <div class="container">
      <h1 class="text-center">{{ getcong('contact_us_title') }}</h1>
    </div>
  </div>

  <section class="inner-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="card">
            <div class="card-body contact-address">
              <div class="d-flex">
                <div class="contact-address-icon"><i class="flaticon-map text-primary"></i></div>
                <div class="ms-3">
                  <h6>Address</h6>
                  <p>{{ getcong('contact_us_address') }}</p>
                </div>
              </div>
              <div class="d-flex">
                <div class="contact-address-icon">
                  <i class="flaticon-email text-primary"></i>
                </div>
                <div class="ms-3">
                  <h6>Email</h6>
                  <p><a href="mailto:hello@saakin.qa">{{ getcong('contact_us_email') }}</a></p>
                </div>
              </div>
              <div class="d-flex">
                <div class="contact-address-icon">
                  <i class="flaticon-call text-primary"></i>
                </div>
                <div class="ms-3">
                  <h6>Phone Number</h6>
                  <p>{{ getcong('contact_us_phone') }}</p>
                </div>
              </div>
              <div class="d-flex">
                <div class="contact-address-icon">
                  <i class="flaticon-fax text-primary"></i>
                </div>
                <div class="ms-3">
                  <h6>Fax</h6>
                  <p>{{ getcong('contact_us_fax') }}</p>
                </div>
              </div>
              <div class="agent-social-icon d-flex spbwx8 mt-3">
                <a href="{{ getcong('social_facebook') }}" target="_blank" class="fab fa-facebook-f"></a>
                <a href="{{ getcong('social_twitter') }}" target="_blank" class="fab fa-twitter"></a>
                <a href="{{ getcong('social_linkedin') }}" target="_blank" class="fab fa-linkedin"></a>
                <a href="{{ getcong('social_instagram') }}" target="_blank" class="fab fa-instagram"></a>
              </div>

            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card contact-form mt-3 mt-lg-0">
            <div class="card-body">
              @if (Session::has('flash_message_contact'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  </button>
                  {{ Session::get('flash_message_contact') }}
                </div>
              @endif

              <h4 class="mb-4 mt-2">Need assistance? Please complete the contact form</h4>
              {!! Form::open(['url' => 'contact-us', 'class' => '', 'id' => 'contactform', 'role' => 'form']) !!}

              <div class="form-control-wrap row gx-2 gy-2">
                <!--<div id="message" class="alert alert-danger alert-dismissible fade"></div>-->
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" value="{{ old('name') }}" id="name" placeholder="{{ trans('words.name') }} *" name="name" required>
                  @if ($errors->has('name'))
                    <span style="color:#fb0303">
                      {{ $errors->first('name') }}
                    </span>
                  @endif
                </div>
                <div class="form-group col-md-6">
                  <input type="email" class="form-control" name="email" placeholder="{{ trans('words.email') }} *" value="{{ old('email') }}" required>
                  @if ($errors->has('email'))
                    <span style="color:#fb0303">
                      {{ $errors->first('email') }}
                    </span>
                  @endif
                </div>
                <div class="form-group col-md-6">
                  <input type="text" name="phone" class="form-control" placeholder="{{ trans('words.phone') }}" value="{{ old('phone') }}" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" name="subject" placeholder="{{ trans('words.subject') }}" class="form-control" value="{{ old('subject') }}" required>
                </div>
                <div class="form-group col-md-12">
                  <textarea id="message" rows="4" name="your_message" class="form-control" placeholder="{{ trans('words.message') }} *" required>{{ old('your_message') }}</textarea>

                  @if ($errors->has('your_message'))
                    <span style="color:#fb0303">
                      {{ $errors->first('your_message') }}
                    </span>
                  @endif
                </div>

                <div class="form-group col-md-12 mb-0">
                  <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
              </div>
              {!! Form::close() !!}
            </div>

          </div>
        </div>
      </div>

      <div class="google-map-container mt-4">
        <div id="propertyMap" data-latitude="25.2900358" data-longitude="51.5033189"></div>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3606.5503310177724!2d51.525797114486814!3d25.319307732949923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e45c50aaabc3093%3A0x4e87313ae3dc558d!2sSaakin%20Inc!5e0!3m2!1sen!2s!4v1639136940349!5m2!1sen!2s"
          width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>

    </div>
  </section>

  <section class="py-3 py-5 bg-primary">
    <div class="container text-center">
      <a href="{{ url('real-estate-agencies') }}" class="btn btn-outline-light py-3 px-5 text-uppercase fw-bold">
        View All Agencies
      </a>
    </div>
  </section>


@endsection

@push('styles')
  <link href="{{ asset('assets/css/flaticon.css') }}" rel="stylesheet" />
@endpush
