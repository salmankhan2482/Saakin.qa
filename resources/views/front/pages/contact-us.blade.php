@extends("front.layouts.main")

@section('title',' Contact Us | Saakin.qa')
@section('description','For any query or getting useful information about the properties in Qatar, feel free to contact us: hello@saakin.com')
@section('type','contact-us')

@section('content')
    <div class="breadcrumb-section page-title bg-h"
         style="background-image: url('{{asset('assets/images/backgrounds/bg-4.jpg')}}')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto text-center">
                    <div class="breadcrumb-menu">
                        <h1>{{getcong('contact_us_title')}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pt-60 pb-80" style="background-color:#ededed;">
        <div class="container">
            <div class="row align-items-center row-10-padding">
                <div class="col-lg-5">
                    <div class="contact-address bg-light p-4">
                        <div class="d-flex mb-3">
                            <div class="contact-address-icon"><i class="flaticon-map text-primary"></i></div>
                            <div class="ml-3">
                                <h6>Address</h6>
                                <p>{{getcong('contact_us_address')}}</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="contact-address-icon">
                                <i class="flaticon-email text-primary"></i>
                            </div>
                            <div class="ml-3">
                                <h6>Email</h6>
                                <p><a href="mailto:hello@saakin.com">{{getcong('contact_us_email')}}</a></p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="contact-address-icon">
                                <i class="flaticon-call text-primary"></i>
                            </div>
                            <div class="ml-3">
                                <h6>Phone Number</h6>
                                <p><a href="callto:{{getcong('contact_us_phone')}}"> {{getcong('contact_us_phone')}} </a></p>
                                <p><a href="callto:{{getcong('contact_us_mobile')}}"> {{getcong('contact_us_mobile')}} </a></p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <div class="contact-address-icon">
                                <i class="flaticon-fax text-primary"></i>
                            </div>
                            <div class="ml-3">
                                <h6>Fax</h6>
                                <p><a href="fax:0097470125000">{{getcong('contact_us_fax')}}</a></p>
                            </div>
                        </div>
                        <div class="social-icon-02">
                            <div class="d-flex align-items-center">
                                <h6 class="mr-3"></h6>
                                <ul class="list-unstyled mb-0 list-inline">
                                    <li><a href="{{getcong('social_facebook')}}"> <i class="fab fa-facebook-f"></i> </a>
                                    </li>
                                    <li><a href="{{getcong('social_twitter')}}"> <i class="fab fa-twitter"></i> </a>
                                    </li>
                                    <li><a href="{{getcong('social_linkedin')}}"> <i class="fab fa-linkedin"></i> </a>
                                    </li>
                                    <li><a href="{{getcong('social_instagram')}}"> <i class="fab fa-instagram"></i> </a>
                                    </li>
                                    <li><a href="//api.whatsapp.com/send?phone={{$whatsapp_number}}&text={{ urlencode($whatsapp_text) }}"> <i class="fab fa-whatsapp"></i> </a>
                                    </li>     
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 mt-4 mt-lg-0">
                    @if(Session::has('flash_message_contact'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            {{ Session::get('flash_message_contact') }}
                        </div>
                    @endif
                    <div class="contact-form bg-white w-100 p-3">
                        <h3 class="mb-4 mt-2">Need assistance? Please complete the contact form</h3>
                        {!! Form::open(array('url' => 'contact-us','class'=>'','id'=>'contactform','role'=>'form')) !!}

                        <input type="hidden" name="type" value="Contact Inquiry">
                        <div class="form-control-wrap form-row">
                            <!--<div id="message" class="alert alert-danger alert-dismissible fade"></div>-->
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" value="{{ old('name') }}" id="name"
                                       placeholder="{{trans('words.name')}} *"
                                       name="name" required>
                                @if ($errors->has('name'))
                                    <span style="color:#fb0303">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" name="email"
                                       placeholder="{{trans('words.email')}} *" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span style="color:#fb0303">
                                            {{ $errors->first('email') }}
                                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="phone" class="form-control"
                                       placeholder="{{trans('words.phone')}}" value="{{ old('phone') }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="subject" placeholder="{{trans('words.subject')}}"
                                       class="form-control" value="{{ old('subject') }}" required>
                            </div>
                            <div class="form-group col-md-12">
                                <textarea id="message" rows="4" name="your_message" class="form-control"
                                          placeholder="{{trans('words.message')}} *" required>{{ old('your_message') }}</textarea>

                                @if ($errors->has('your_message'))
                                    <span style="color:#fb0303">
                        {{ $errors->first('your_message') }}
                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g_recaptcha_confirmed'))
                                <span style="color:#fb0303">
                                    {{ $errors->first('g_recaptcha_confirmed') }}
                                </span>
                            @endif
                            </div>

                            <div class="form-group col-md-12 mb-0">
                                <button type="submit" class="btn v7">Send Message</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-60 pb-80" style="background-color: #ededed">
        <div class="container">
        <div class="google-map-container">
            <div id="propertyMap" data-latitude="25.2900358" data-longitude="51.5033189"></div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3606.5503310177724!2d51.525797114486814!3d25.319307732949923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e45c50aaabc3093%3A0x4e87313ae3dc558d!2sSaakin%20Inc!5e0!3m2!1sen!2s!4v1639136940349!5m2!1sen!2s" width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </section>
    <span class="scrolltotop"><i class="lnr lnr-arrow-up"></i></span>

    <section class="pt-5 pb-5" style="background-color:#009fff;">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-3 ml-auto mr-auto">
                    <a href="{{url('real-estate-agencies')}}" 
                    class="btn btn-block pt-3 pb-3 text-uppercase font-weight-bold btn-outline-light">
                        View All Agencies
                    </a>
                </div>
            </div>
        </div>
    </section>

    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
