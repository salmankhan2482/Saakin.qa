@extends("front.layouts.main")

@if ($agency->meta_title != null)
    @section('title', $agency->meta_title . ' | ' . 'Saakin.qa')
    @section('description', $agency->meta_description)
    @section('keyword', $agency->meta_keyword)
    @section('type', 'agency')
    @section('url', url()->current())
    @section('image', asset('upload/agencies/' . $agency->image))
@else
    @section('title', $agency->name . ' | ' . 'Saakin.qa')
    @section('description', $agency_des)
    @section('type', 'agency')
    @section('url', url()->current())
    @section('image', asset('upload/agencies/' . $agency->image))
@endif
@section('content')

    <div class="site-banner" style="background-image: url('/assets/images/backgrounds/agencies.jpg')">
        <div class="container">
            <h1 class="text-center">{{ $agency->name }} Profile</h1>
            <div class="text-white fs-sm d-flex justify-content-center spbwx8">
                <span><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></span>
                <span>/</span>
                <span>{{ $agency->name }} Profile</span>
            </div>
        </div>
    </div>

    <div class="inner-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="agent-details-wrapper">
                        <div class="d-md-flex mb-3 mb-md-4">
                            <div class="agent-logo mx-auto ms-md-0 me-md-4 mb-3 mb-md-0">
                                <img class="img-fluid" src="{{ asset('upload/agencies/' . $agency->image) }}"
                                    alt="{{ $agency->name }}">
                            </div>
                            <div class="agent-bio">
                                <h3>{{ $agency->name }}</h3>
                                <table class="agent-info mb-3" cellspacing="1">
                                    <tr>
                                        <th>Phone:</th>
                                        <td><a href="tel:{{ $agency->phone }}">{{ $agency->phone }}</a></td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td><a href="mailto:{{ $agency->email }}">{{ $agency->email }}</a></td>
                                    </tr>
                                    <tr>
                                        <th>Location:</th>
                                        <td>{{ $agency->head_office }}</td>
                                    </tr>
                                </table>

                                @if (!empty($user))
                                    <div class="agent-social-icon d-flex spbwx8">
                                        @if (!empty($user->facebook))
                                            <a href="{{ $user->facebook }}" target="_blank"
                                                class="fab fa-facebook-f"></a>
                                        @endif
                                        @if (!empty($user->twitter))
                                            <a href="{{ $user->twitter }}" target="_blank" class="fab fa-twitter"></a>
                                        @endif
                                        @if (!empty($user->instagram))
                                            <a href="{{ $user->instagram }}" target="_blank"
                                                class="fab fa-instagram"></a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <h3>About {{ $agency->name }}</h3>

                        <div class="content_description pb-3 less-content" id="content_description"
                            style="--content-height: 90px;">
                            {!! nl2br($agency->agency_detail) !!}
                        </div>

                        <a class="link-dark text-decoration-none" role="button" id="read-more"
                            onclick="readMoreReadLess('more')">
                            <i class="fas fa-angle-down"></i>
                            Read More
                        </a>

                        <a class="link-dark text-decoration-none" role="button" id="read-less" style="display: none;"
                            onclick="readMoreReadLess('less')">
                            <i class="fas fa-angle-up"></i>
                            Read less
                        </a>


                        <div class="d-flex align-items-center justify-content-between mt-4">
                            <h5 class="mb-0">Our Properties</h5>
                    
                            <form method="GET" action="{{route('agency_detail', [Str::slug($agency->name), $agency->id])}}" id="sortForm">
                            <div class="">
                                <select name="sortSelect" id="sortSelect" class="agency-select form-select" style="width: 150px">
                                    <option value="All Properties" {{ request('sortSelect') == 'All Properties' ? 'selected' : '' }}>
                                        All
                                    </option>
                                    <option value="Rent" {{ request('sortSelect') == 'Rent' ? 'selected' : '' }}>
                                        Rent
                                    </option>
                                    <option value="Sale" {{ request('sortSelect') == 'Sale' ? 'selected' : '' }}>
                                        Sale
                                    </option>
                                </select>
                            </div>
                            </form>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row gy-4 mt-1">
                                        @foreach ($properties as $property)
                                            <div class="col-md-6">
                                                @include('front.pages.include.property_box')
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center">

                                            <div class="post-nav nav-res pt-20 pb-60">
                                                <div class="row">
                                                    <div class="col-md-12  col-xs-12 ">
                                                        <div class="page-num text-center">

                                                            @if ($properties->total() > getcong('pagination_limit'))
                                                                {{ $properties->links('front.pages.include.pagination') }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-right mt-3 mt-lg-0">
                        <div class="card">
                            <div class="card-body">

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        </button>
                                    </div>
                                @endif

                                @if (Session::has('flash_message_contact_agency'))
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                        </button>
                                        {{ Session::get('flash_message_contact_agency') }}
                                    </div>
                                @endif

                                <h4 class="widget-title">Contact us</h4>
                                <form action="{{ url('agency-contact') }}" id="" method="POST">
                                    @csrf

                                    <input type="hidden" name="subject" class="form-control" value="">
                                    <input type="hidden" name="agency_id" id="agency_id" value="{{ $agency->id }}" />
                                    <input type="hidden" name="agency_name" id="agency_name" value="{{ $agency->name }}" />
                                    <input type="hidden" name="agency_mail" value="{{ $agency->email }}">
                                    <input type="hidden" name="type" value="Agency Inquiry">

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <div class="mb-2">
                                            <input class="form-control" type="text" name="name" id="name"
                                                placeholder="Your name" required>
                                            @if ($errors->has('name'))
                                                <span class="d-block invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <div class="mb-2">
                                            <input class="form-control" type="text" name="phone" id="phone"
                                                placeholder="Phone" required>
                                            @if ($errors->has('phone'))
                                                <span class="d-block invalid-feedback">
                                                    {{ $errors->first('phone') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="mb-2">
                                            <input class="form-control" type="text" name="email" id="email"
                                                placeholder="Email" required>
                                            @if ($errors->has('email'))
                                                <span class="d-block invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                        <div class="mb-2">
                                            <input class="form-control" type="text" name="subject" id="subject"
                                                placeholder="Subject" required>
                                            @if ($errors->has('subject'))
                                                <span class="d-block invalid-feedback">
                                                    {{ $errors->first('subject') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <textarea class="form-control" name="your_message" rows="4" placeholder="Your Message" required></textarea>
                                    </div>
                                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        <div class="mb-2">
                                            {!! NoCaptcha::renderJs() !!}
                                            {!! NoCaptcha::display() !!}
                                            @if ($errors->has('g-recaptcha-response'))
                                                <span class="help-block">
                                                    {{ $errors->first('g-recaptcha-response') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        Send Message
                                    </button>
                                </form>
                                @if ($message = Session::get('flash_message_contact'))
                                    <div class="alert alert-info alert-block mt-2">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h4>Property Types</h4>
                                <ul class="property-type-list list-unstyled">
                                    @if (count($propertyTypes) > 0)
                                        @foreach ($propertyTypes as $propertyType)
                                            <li>
                                                <a
                                                    href="{{ url('properties?property_type=' . $propertyType->id . '&agent=' . $agency->id) }}">
                                                    <i class="fas fa-chevron-right"></i>
                                                    {{ $propertyType->property_type }}
                                                    <span>({{ $propertyType->property_count }})</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>No Property</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts-custom')

    <script>
        var form = document.getElementById("sortForm");
        document.getElementById("sortSelect").addEventListener("change", function() {
            form.submit();
        });
        
        function readMoreReadLess(text) {
            if (text == 'more') {
                $(document).ready(function() {
                    $('.content_description').addClass('full-content');
                    $('.content_description').removeClass('less-content');
                    $("#read-more").css('display', 'none');
                    $("#read-less").css('display', 'block');
                });
            } else {
                $('.content_description').addClass('less-content');
                $('.content_description').removeClass('full-content');
                $("#read-more").css('display', 'block');
                $("#read-less").css('display', 'none');
            }
        }
    </script>
    @include('front.pages.include.mobileSliderCode')
@endsection
