@extends("front.layouts.main")

@if ($agency->meta_title !=null)

@section('title',$agency->meta_title .  '  |  ' . 'saakin.qa')
@section('description',$agency->meta_description)
@section('keyword',$agency->meta_keyword)
@section('type','agency')
@section('url',url()->current())
@section('image', asset('upload/agencies/'.$agency->image))

@else
@section('title',$agency->name .  '  |  ' . 'saakin.qa')
@section('description',$agency_des)
@section('type','agency')
@section('url',url()->current())
@section('image', asset('upload/agencies/'.$agency->image))

@endif
@section('content')
    <style>
        .row.single-property-box {
            margin-left: 0;
            margin-right: 0;
        }

        .property-item {
            padding: 0;
        }

    </style>
    <!--Breadcrumb section starts-->

    <div class="breadcrumb-section bg-h" style="background-image:  url('/assets/images/backgrounds/agencies.jpg')">

        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <div class="breadcrumb-menu">
                        <h1 style="color: white">{{ $agency->name }} Profile</h1>
                        <span><a href="#">Home</a></span>
                        <span>{{ $agency->name }} Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Breadcrumb section ends-->
    <!-- Agent section starts -->
<div class="agent-section">
<div class="container">
<div class="row">
<div class="col-xl-8 order-xl-12 order-xl-2 order-1">
    <div class="agent-details-wrapper">
        <div class="row mb-50">
            <div class="col-lg-5 col-md-6 col-sm-5 text-center">
                <img class="img-fluid" src="{{ asset('upload/agencies/' . $agency->image) }}"
                    alt="{{ $agency->name }}">
            </div>
            <div class="col-lg-7 col-md-6 col-sm-7">
                <div class="agent-details">
                    <h3>{{ $agency->name }}</h3>
                    <div class="address-list">

                        <div>
                            <span>
                                Phone:
                            </span>
                            <a href="call:{{ $agency->phone }}">{{ $agency->phone }}</a>
                        </div>

                        <div>
                            <span>
                                Email:
                            </span>
                            <a href="mailto:{{ $agency->email }}">{{ $agency->email }}</a>
                        </div>

                        <div>
                            <span>
                                Location:
                            </span>
                            {{ $agency->head_office }}
                        </div>
                    </div>
                    @if (!empty($user))
                        <ul class="social-buttons style1">
                            @if (!empty($user->facebook))
                                <li><a href="{{ $user->facebook }}" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a></li>
                            @endif
                            @if (!empty($user->twitter))
                                <li><a href="{{ $user->twitter }}" target="_blank"><i
                                            class="fab fa-twitter"></i></a>
                                </li>
                            @endif
                            @if (!empty($user->instagram))
                                <li><a href="{{ $user->instagram }}" target="_blank"><i
                                            class="fab fa-instagram"></i></a></li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="agent-bio">
                    <h3>About {{ $agency->name }}</h3>
                    <div class="panel-wrapper">
                        <a href="#desshow" class="show" id="desshow"><i class="fas fa-angle-down"></i> Read
                            More</a>
                        <a href="#deshide" class="hide" id="deshide"><i class="fas fa-angle-up"></i> Read
                            less</a>

                        <div class="panel" id="mongo">
                            {!! nl2br($agency->agency_detail) !!}

                        </div>
                        <div class="cus_fade" style=" height: 50px !important; margin-top: -9px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h3>Our Properties</h3>
                <div class="agent-listings">
                    <ul class="nav nav-tabs list-details-tab">
                        <li class="nav-item" id="all_property_tab">
                            <a data-toggle="tab" class="nav-link" id="all_property_trigger" href="#all_property">All Property</a>
                        </li>
                        <li class="nav-item" id="for_sale_tab">
                            <a data-toggle="tab" class="nav-link" id="for_sale_trigger" href="#for_sale">For Sale</a>
                        </li>
                        <li class="nav-item" id="for_rent_tab">
                            <a data-toggle="tab" class="nav-link" id="for_rent_trigger" href="#for_rent">For Rent</a>
                        </li> 
                    </ul>
                    <div class="tab-content mt-30 add_list_content">
                        <div class="tab-pane fade show active" id="all_property">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-list featured_mobile">
                                        <div class="card-list__item">
                                            <div class="property-card__section">
                                                @if (count($properties) > 0)

                                                @foreach ($properties as $property)

                                                        <div class="property-card">
                                                            <div class="property-card__image">
                                                                <div class="swiper-container">
                                                                    <div class="swiper-wrapper">
                                                                        @if (count($property->gallery) > 0)
                                                                            <div class="swiper-slide">
                                                                                <img
                                                                                    src="{{ asset('upload/properties/thumb_' . $property->featured_image) }}" alt="{{$property->property_name}}">
                                                                            </div>
                                                                            @foreach ($property->gallery as $gallery)
                                                                                <div class="swiper-slide">
                                                                                    <img
                                                                                        src="{{ asset('upload/gallery/') . '/' . $gallery->image_name }}"
                                                                                        alt="{{$property->property_name}}">
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    <!-- Add Pagination -->
                                                                    <div class="swiper-pagination"></div>
                                                                </div>
                                                            </div>
                                                            <div class="property-card__content">
                                                                <div class="property-card__info-area"
                                                                    onclick="window.location
                                                           ='{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}';">
                                                                    <div class="property-card__title ">
                                                                        <a class="property-card__title-link" href="javascript:void();">
                                                                            {{ $property->getPrice() }} @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                                                                                / Month
                                                                            @endif
                                                                        </a>

                                                                    </div>
                                                                    <h2 class="property-card__property-title">
                                                                        {{ \Illuminate\Support\Str::limit($property->property_name, 20) }}
                                                                    </h2>
                                                                    <div class="property-card__location">
                                                                        {{ $property->propertiesTypes->types }}
                                                                        <br>
                                                                        {{ \Illuminate\Support\Str::limit($property->address, 30) }}
                                                                    </div>
                                                                    <div class="property-card__info ">
                                                                        @if ($property->getProperty_type())
                                                                            <i class="fas fa-bed"></i> <span>{{ $property->bedrooms }}
                                                                            </span>
                                                                            <i class="fas fa-bath"></i>
                                                                            <span>{{ $property->bathrooms }}
                                                                            </span>
                                                                        @endif
                                                                        <i class="fas fa-chart-area"></i>
                                                                        <span>{{ $property->getSqm() }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="property-card__actions mt-0">

@php
$phone = \App\Properties::getPhoneNumber($property->id);
$whatsapp = \App\Properties::getWhatsapp($property->id);
$agency = \App\Agency::where("id",$property->agency_id)->first();
$propertyUrl = url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id);
$whatsapText = 'Hello,
I would like to inquire about this property posted on
saakin.qa

Reference: '.$property->refference_code.'
Price: QR '.$property->getPrice().'/month
Type: '.$property->propertiesTypes->types.'
Location: '.$property->address.'

Link:'.$propertyUrl;
@endphp

                                                                    @if ($phone != '#')
                                                                        <a class="btn btn-outline-success call_btn"
                                                                            href="tel:{{ $phone }}">
                                                                            <i class="fas fa-phone-alt"></i> Call
                                                                        </a>
                                                                    @endif
                                                                    @if ($whatsapp != '#' && $whatsapp != '')
                                                                        <a href="//api.whatsapp.com/send?phone={{ $whatsapp }}&text={{ urlencode(trim($whatsapText)) }}"
                                                                            class="btn btn-success call_btn">
                                                                            <i class="fab fa-whatsapp"></i>
                                                                            WhatsApp
                                                                        </a>
                                                                    @else
                                                                    <a class="btn btn-outline-success call_btn"
                                                                    id="emailBtn"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-image="{{asset('upload/properties/thumb_' . $property->featured_image) }}"
                                                                        data-title="{{ $property->property_name }}"
                                                                        data-agent="{{ $property->agent_name ?? $agency->name }}"
                                                                        data-broker="{{ $agency->name ?? '' }}"
                                                                        data-bedroom="{{ $property->bedrooms ?? '' }}"
                                                                        data-bathroom="{{ $property->bathrooms ?? '' }}"
                                                                        data-area="{{ $property->getSqm() ?? '' }}"
                                                                    >
                                                                        <i class="fas fa-envelope"></i> Email
                                                                    </a>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- all properties mobiel section ends here  --}}

                                @if (count($properties) > 0)
                                    @foreach ($properties as $property)
                                        <div class="related-homes-slider slider_desktop p-1">
                                            <div  class="single-property-box p-1"  style="cursor: pointer;" onclick="window.location='{{ route('property-detail', [strtolower($property->property_purpose), $property->property_slug, $property->id]) }}';" >

                                                <div class="property-item">
                                                    @if ($property->featured_image)
                                                        <img src="{{ URL::asset('upload/properties/thumb_' . $property->featured_image) }}"
                                                        alt="Featured Image of Property {{$property->property_name}}">
                                                    @else
                                                        <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}" alt="Svg For Featured Image">
                                                    @endif

                                                    <ul class="feature_text">
                                                        @if ($property->featured_property == 1)
                                                            <li class="feature_cb"><span> Featured</span></li>
                                                        @endif
                                                        <li class="feature_or">
                                                            <span>For {{ $property->property_purpose }}</span>
                                                        </li>
                                                    </ul>

                                                    <div class="property-author-wrap">
                                                        <div class="property-author">
                                                            <span>
                                                                {{ $property->getPrice() }}
                                                                @if ($property->property_purpose == 'For Rent'
                                                                    || $property->property_purpose == 'Rent') / Month
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="property-title-box" style="padding-bottom: 5px !important;">
                                                    <h2 class="property-card__property-title">
                                                        {{ \Illuminate\Support\Str::limit($property->property_name, 20) }}
                                                    </h2>
                                                    <div class="property-location">
                                                        <p> {{ Str::limit($property->propertiesTypes->types, 36) }}</p>
                                                    </div>

                                                    <div class="property-location">
                                                        <i class="fa fa-map-marker-alt"></i>
                                                        <p> {{ Str::limit($property->address, 36) }}</p>
                                                    </div>
                                                    <ul class="property-feature" style="padding: 0px">
                                                        @if ($property->getProperty_type())
                                                            <li style="text-align: left;">
                                                                <i class="fas fa-bed"></i>
                                                                <span>
                                                                    {{ $property->bedrooms }}
                                                                </span>
                                                            </li>
                                                            <li style="text-align: left;">
                                                                <i class="fas fa-bath"></i>
                                                                <span>
                                                                    {{ $property->bathrooms }}
                                                                </span>
                                                            </li>
                                                        @endif
                                                        <li style="text-align: left;">
                                                            <i class="fas fa-chart-area"></i>
                                                            <span>
                                                                {{ $property->getSqm() }}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                    <div class="col-12">
                                        <div class="text-center">

                                            <div class="post-nav nav-res pt-20 pb-60">
                                                <div class="row">
                                                    <div class="col-md-12  col-xs-12 ">
                                                        <div class="page-num text-center">

                                                            @if($properties->total() > getcong('pagination_limit'))
                                                                {{$properties->appends(['properties' => $properties->currentPage(), 'saleProperties' => $saleProperties->currentPage(), 'rentProperties' => $rentProperties->currentPage()])->links()}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p>No Record Founds</p>
                                @endif
                            </div>
                        </div>
{{-- all properties tab ends here --}}


                        <div class="tab-pane fade" id="for_sale">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-list featured_mobile">
                                        <div class="card-list__item">
                                            <div class="property-card__section">
                                                @if (count($saleProperties) > 0)
                                                @foreach ($saleProperties as $property)
                                                    @if ($property->property_purpose == 'Sale' || $property->property_purpose == 2 || $property->property_purpose == 'For Sale')
                                                        <div class="property-card">
                                                            <div class="property-card__image">
                                                                <div class="swiper-container">
                                                                    <div class="swiper-wrapper">
                                                                        @if (count($property->gallery) > 0)
                                                                            <div class="swiper-slide">
                                                                                <img
                                                                                    src="{{ asset('upload/properties/thumb_' . $property->featured_image) }}"
                                                                                    alt="{{$property->property_name}}">
                                                                            </div>
                                                                            @foreach ($property->gallery as $gallery)
                                                                                <div class="swiper-slide">
                                                                                    <img
                                                                                        src="{{ asset('upload/gallery/') . '/' . $gallery->image_name }}"
                                                                                        alt="{{$property->property_name}}">

                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    <!-- Add Pagination -->
                                                                    <div class="swiper-pagination"></div>
                                                                </div>
                                                            </div>
                                                            <div class="property-card__content">
                                                                <div class="property-card__info-area"
                                                                    onclick="window.location
                                                           ='{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}';">
                                                                    <div class="property-card__title ">
                                                                        <a class="property-card__title-link" href="javascript:void(0);">
                                                                            {{ $property->getPrice() }} @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                                                                                / Month
                                                                            @endif
                                                                        </a>

                                                                    </div>
                                                                    <h2 class="property-card__property-title">
                                                                        {{ \Illuminate\Support\Str::limit($property->property_name, 20) }}
                                                                    </h2>
                                                                    <div class="property-card__location">
                                                                        {{ $property->propertiesTypes->types }}
                                                                        <br>
                                                                        {{ \Illuminate\Support\Str::limit($property->address, 30) }}
                                                                    </div>
                                                                    <div class="property-card__info ">
                                                                        @if ($property->getProperty_type())
                                                                            <i class="fas fa-bed"></i> <span>{{ $property->bedrooms }}
                                                                            </span>
                                                                            <i class="fas fa-bath"></i>
                                                                            <span>{{ $property->bathrooms }}
                                                                            </span>
                                                                        @endif
                                                                        <i class="fas fa-chart-area"></i>
                                                                        <span>{{ $property->getSqm() }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="property-card__actions mt-0">

@php
$phone = \App\Properties::getPhoneNumber($property->id);
$whatsapp = \App\Properties::getWhatsapp($property->id);
$agency = \App\Agency::where("id",$property->agency_id)->first();
$propertyUrl = url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id);
$whatsapText = 'Hello,
I would like to inquire about this property posted on
saakin.qa

Reference: '.$property->refference_code.'
Price: QR '.$property->getPrice().'/month
Type: '.$property->propertiesTypes->types.'
Location: '.$property->address.'

Link:'.$propertyUrl;
@endphp

                                                                    @if ($phone != '#')
                                                                        <a class="btn btn-outline-success call_btn"
                                                                            href="tel:{{ $phone }}">
                                                                            <i class="fas fa-phone-alt"></i> Call
                                                                        </a>
                                                                    @endif
                                                                    @if ($whatsapp != '#' && $whatsapp != '')
                                                                        <a href="//api.whatsapp.com/send?phone={{ $whatsapp }}&text={{ urlencode(trim($whatsapText)) }}"
                                                                            class="btn btn-success call_btn">
                                                                            <i class="fab fa-whatsapp"></i>
                                                                            WhatsApp
                                                                        </a>
                                                                    @else
                                                                    <a class="btn btn-outline-success call_btn"
                                                                    id="emailBtn"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-image="{{asset('upload/properties/thumb_' . $property->featured_image) }}"
                                                                        data-title="{{ $property->property_name }}"
                                                                        data-agent="{{ $property->agent_name ?? $agency->name }}"
                                                                        data-broker="{{ $agency->name ?? '' }}"
                                                                        data-bedroom="{{ $property->bedrooms ?? '' }}"
                                                                        data-bathroom="{{ $property->bathrooms ?? '' }}"
                                                                        data-area="{{ $property->getSqm() ?? '' }}"
                                                                    >
                                                                        <i class="fas fa-envelope"></i> Email
                                                                    </a>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                @if (count($saleProperties) > 0)
                                    @foreach ($saleProperties as $property)
                                        @if ($property->property_purpose == 'Sale' || $property->property_purpose == 2 || $property->property_purpose == 'For Sale')

                                        <div class="related-homes-slider slider_desktop p-1">
                                            <div  class="single-property-box p-1"  style="cursor: pointer;" onclick="window.location='{{ route('property-detail', [strtolower($property->property_purpose), $property->property_slug, $property->id]) }}';" >

                                                <div class="property-item">
                                                    @if ($property->featured_image)
                                                        <img src="{{ URL::asset('upload/properties/thumb_' . $property->featured_image) }}"
                                                        alt="{{$property->property_name.' - featured image'}}">
                                                    @else
                                                        <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}"
                                                        alt="{{'featured image svg'}}">
                                                    @endif

                                                    <ul class="feature_text">
                                                        @if ($property->featured_property == 1)
                                                            <li class="feature_cb"><span> Featured</span></li>
                                                        @endif
                                                        <li class="feature_or">
                                                            <span>For {{ $property->property_purpose }}</span>
                                                        </li>
                                                    </ul>

                                                    <div class="property-author-wrap">
                                                        <div class="property-author">
                                                            <span>
                                                                {{ $property->getPrice() }}
                                                                @if ($property->property_purpose == 'For Rent'
                                                                    || $property->property_purpose == 'Rent') / Month
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="property-title-box" style="padding-bottom: 5px !important;">
                                                    <h2 class="property-card__property-title">
                                                        {{ \Illuminate\Support\Str::limit($property->property_name, 20) }}
                                                    </h2>
                                                    <div class="property-location">
                                                        <p> {{ Str::limit($property->propertiesTypes->types, 36) }}</p>
                                                    </div>

                                                    <div class="property-location">
                                                        <i class="fa fa-map-marker-alt"></i>
                                                        <p> {{ Str::limit($property->address, 36) }}</p>
                                                    </div>
                                                    <ul class="property-feature" style="padding: 0px">
                                                        @if ($property->getProperty_type())
                                                            <li style="text-align: left;">
                                                                <i class="fas fa-bed"></i>
                                                                <span>
                                                                    {{ $property->bedrooms }}
                                                                </span>
                                                            </li>
                                                            <li style="text-align: left;">
                                                                <i class="fas fa-bath"></i>
                                                                <span>
                                                                    {{ $property->bathrooms }}
                                                                </span>
                                                            </li>
                                                        @endif
                                                        <li style="text-align: left;">
                                                            <i class="fas fa-chart-area"></i>
                                                            <span>
                                                                {{ $property->getSqm() }}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        @endif
                                    @endforeach
                                    <div class="col-12">
                                        <div class="text-center">

                                            <div class="post-nav nav-res pt-20 pb-60">
                                                <div class="row">
                                                    <div class="col-md-12  col-xs-12 ">
                                                        <div class="page-num text-center">
                                                            @if($saleProperties->total() > getcong('pagination_limit'))
                                                           
                                                                {{$saleProperties->appends(['saleProperties' => $saleProperties->currentPage(), 'rentProperties' => $rentProperties->currentPage(), 'properties' => $properties->currentPage()])->links()}}

                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p>No Record Founds</p>
                                @endif

                            </div>
                        </div>
                        {{-- sale tab ends here --}}

                        <div class="tab-pane fade" id="for_rent">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-list featured_mobile">
                                        <div class="card-list__item">
                                            <div class="property-card__section">
                                                @if (count($rentProperties) > 0)
                                                @foreach ($rentProperties as $property)
                                                @if ($property->property_purpose == 'Rent' || $property->property_purpose == 1 || $property->property_purpose == 'For Rent')
                                                        <div class="property-card">
                                                            <div class="property-card__image">
                                                                <div class="swiper-container">
                                                                    <div class="swiper-wrapper">
                                                                        @if (count($property->gallery) > 0)
                                                                            <div class="swiper-slide">
                                                                                <img
                                                                                    src="{{ asset('upload/properties/thumb_' . $property->featured_image) }}"
                                                                                    alt="{{$property->property_name}}">
                                                                            </div>
                                                                            @foreach ($property->gallery as $gallery)
                                                                                <div class="swiper-slide">
                                                                                    <img
                                                                                        src="{{ asset('upload/gallery/') . '/' . $gallery->image_name }}"
                                                                                        alt="{{$property->property_name}}">
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    <!-- Add Pagination -->
                                                                    <div class="swiper-pagination"></div>
                                                                </div>
                                                            </div>
                                                            <div class="property-card__content">
                                                                <div class="property-card__info-area"
                                                                    onclick="window.location
                                                           ='{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}';">
                                                                    <div class="property-card__title ">
                                                                        <a class="property-card__title-link" href="javascript:void(0);">
                                                                            {{ $property->getPrice() }} @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                                                                                / Month
                                                                            @endif
                                                                        </a>

                                                                    </div>
                                                                    <h2 class="property-card__property-title">
                                                                        {{ \Illuminate\Support\Str::limit($property->property_name, 20) }}
                                                                    </h2>
                                                                    <div class="property-card__location">
                                                                        {{ $property->propertiesTypes->types }}
                                                                        <br>
                                                                        {{ \Illuminate\Support\Str::limit($property->address, 30) }}
                                                                    </div>
                                                                    <div class="property-card__info ">
                                                                        @if ($property->getProperty_type())
                                                                            <i class="fas fa-bed"></i> <span>{{ $property->bedrooms }}
                                                                            </span>
                                                                            <i class="fas fa-bath"></i>
                                                                            <span>{{ $property->bathrooms }}
                                                                            </span>
                                                                        @endif
                                                                        <i class="fas fa-chart-area"></i>
                                                                        <span>{{ $property->getSqm() }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="property-card__actions mt-0">

@php
$phone = \App\Properties::getPhoneNumber($property->id);
$whatsapp = \App\Properties::getWhatsapp($property->id);
$agency = \App\Agency::where("id",$property->agency_id)->first();
$propertyUrl = url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id);
$whatsapText = 'Hello,
I would like to inquire about this property posted on
saakin.qa

Reference: '.$property->refference_code.'
Price: QR '.$property->getPrice().'/month
Type: '.$property->propertiesTypes->types.'
Location: '.$property->address.'

Link:'.$propertyUrl;
@endphp

                                                                    @if ($phone != '#')
                                                                        <a class="btn btn-outline-success call_btn"
                                                                            href="tel:{{ $phone }}">
                                                                            <i class="fas fa-phone-alt"></i> Call
                                                                        </a>
                                                                    @endif
                                                                    @if ($whatsapp != '#' && $whatsapp != '')
                                                                        <a href="//api.whatsapp.com/send?phone={{ $whatsapp }}&text={{ urlencode(trim($whatsapText)) }}"
                                                                            class="btn btn-success call_btn">
                                                                            <i class="fab fa-whatsapp"></i>
                                                                            WhatsApp
                                                                        </a>
                                                                    @else
                                                                    <a class="btn btn-outline-success call_btn"
                                                                    id="emailBtn"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        data-image="{{asset('upload/properties/thumb_' . $property->featured_image) }}"
                                                                        data-title="{{ $property->property_name }}"
                                                                        data-agent="{{ $property->agent_name ?? $agency->name }}"
                                                                        data-broker="{{ $agency->name ?? '' }}"
                                                                        data-bedroom="{{ $property->bedrooms ?? '' }}"
                                                                        data-bathroom="{{ $property->bathrooms ?? '' }}"
                                                                        data-area="{{ $property->getSqm() ?? '' }}"
                                                                    >
                                                                        <i class="fas fa-envelope"></i> Email
                                                                    </a>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                @if (count($rentProperties) > 0)
                                    @foreach ($rentProperties as $property)
                                    @if ($property->property_purpose == 'Rent' || $property->property_purpose == 1 || $property->property_purpose == 'For Rent')

                                        <div class="related-homes-slider slider_desktop p-1">
                                            <div  class="single-property-box p-1"  style="cursor: pointer;" onclick="window.location='{{ route('property-detail', [strtolower($property->property_purpose), $property->property_slug, $property->id]) }}';" >

                                                <div class="property-item">
                                                    @if ($property->featured_image)
                                                        <img src="{{ URL::asset('upload/properties/thumb_' . $property->featured_image) }}" alt="featured Image">
                                                    @else
                                                        <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}"
                                                        alt="Svg for featured image">
                                                    @endif

                                                    <ul class="feature_text">
                                                        @if ($property->featured_property == 1)
                                                            <li class="feature_cb"><span> Featured</span></li>
                                                        @endif
                                                        <li class="feature_or">
                                                            <span>For {{ $property->property_purpose }}</span>
                                                        </li>
                                                    </ul>

                                                    <div class="property-author-wrap">
                                                        <div class="property-author">
                                                            <span>
                                                                {{ $property->getPrice() }}
                                                                @if ($property->property_purpose == 'For Rent'
                                                                    || $property->property_purpose == 'Rent') / Month
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="property-title-box" style="padding-bottom: 5px !important;">
                                                    <h2 class="property-card__property-title">
                                                    {{ \Illuminate\Support\Str::limit($property->property_name, 20) }}
                                                    </h2>
                                                    <div class="property-location">
                                                        <p> {{ Str::limit($property->propertiesTypes->types, 36) }}</p>
                                                    </div>

                                                    <div class="property-location">
                                                        <i class="fa fa-map-marker-alt"></i>
                                                        <p> {{ Str::limit($property->address, 36) }}</p>
                                                    </div>
                                                    <ul class="property-feature" style="padding: 0px">
                                                        @if ($property->getProperty_type())
                                                            <li style="text-align: left;">
                                                                <i class="fas fa-bed"></i>
                                                                <span>
                                                                    {{ $property->bedrooms }}
                                                                </span>
                                                            </li>
                                                            <li style="text-align: left;">
                                                                <i class="fas fa-bath"></i>
                                                                <span>
                                                                    {{ $property->bathrooms }}
                                                                </span>
                                                            </li>
                                                        @endif
                                                        <li style="text-align: left;">
                                                            <i class="fas fa-chart-area"></i>
                                                            <span>
                                                                {{ $property->getSqm() }}
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        @endif
                                    @endforeach
                                    <div class="col-12">
                                        <div class="text-center">

                                            <div class="post-nav nav-res pt-20 pb-60">
                                                <div class="row">
                                                    <div class="col-md-12  col-xs-12 ">
                                                        <div class="page-num text-center">
                                                            @if($rentProperties->total() > getcong('pagination_limit'))
                                                            
                                                                {{$rentProperties->appends(['rentProperties' => $rentProperties->currentPage(), 'saleProperties' => $saleProperties->currentPage(), 'properties' => $properties->currentPage()])->links()}}
                                                            
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p>No Record Founds</p>
                                @endif

                            </div>
                        </div>
                        {{-- rent tab ends here --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 order-xl-12 order-xl-1 order-2">
    <div class="sidebar-right">
        <div class="widget">
            @if(Session::has('flash_message_contact_agency'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            </button>
                            {{ Session::get('flash_message_contact_agency') }}
                        </div>
            @endif
            <h3 class="widget-title">Contact us</h3>
            <form action="{{ url('agency-contact') }}" id="" method="POST">
                @csrf
                <input type="hidden" name="subject" class="form-control" value="">
                <input type="hidden" name="agency_id" id="agency_id" value="{{ $agency->id }}" />
                <input type="hidden" name="agency_name" id="agency_name" value="{{ $agency->name }}" />
                <input type="hidden" name="agency_mail" value="{{$agency->email}}">
                <input type="hidden" name="type" value="Agency Inquiry">
                <div class="chat-group mt-1">
                    <input class="chat-field" type="text" name="name" id="name" placeholder="Your name"
                        required>
                </div>
                <div class="chat-group mt-1">
                    <input class="chat-field" type="text" name="phone" id="phone" placeholder="Phone"
                        required>
                </div>
                <div class="chat-group mt-1">
                    <input class="chat-field" type="text" name="email" id="email" placeholder="Email"
                        required>
                </div>
                <div class="chat-group mt-1">
                    <input class="chat-field" type="text" name="subject" id="subject"
                        placeholder="Subject" required>
                </div>
                <div class="chat-group mt-1">
                    <textarea class="form-control chat-msg" name="your_message" rows="4"
                        placeholder="Your Message" required></textarea>
                </div>
                <div class="chat-button mt-3">
                    <button type="submit" class="chat-btn" >
                        Send Message
                    </button>
                </div>
            </form>
            @if ($message = Session::get('flash_message_contact'))
            <div class="alert alert-info alert-block mt-2">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>

        <div class="widget categories">
            <h3 class="widget-title">Property Types</h3>
            <ul class="icon">
                @if (count($propertyTypes) > 0)
                    @foreach ($propertyTypes as $propertyType)
                        <li>
                            <a href="{{url('properties?property_type='.$propertyType->id.'&agent='.$agency->id) }}">
                                {{ $propertyType->property_type }}
                            </a>
                        <span>
                            <a href="{{url('properties?property_type='.$propertyType->id.'&agent='.$agency->id) }}">
                                ({{ $propertyType->property_count }})
                            </a>
                        </span>

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

@endsection


@section('scripts-custom')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/carousel.autoplay.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/carousel.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.controls.umd.js"></script>


<script>

    $('a[data-toggle="tab"]').on('click', function (e) {
        var href = $(e.target).attr('href').replace('#','');
        localStorage.setItem('activeTab', href);

        $(".nav-item").removeClass("active");
        $(`#${href}_tab`).addClass("active");
    });

    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $(`#${activeTab}_tab`).addClass("active");
        $(`#${activeTab}_trigger`)[0].click();

    }else{
        $("#all_property_tab").addClass("active");
        $(`#all_property_trigger`)[0].click();
    }

    function FormSubmit(coming) {
        var value = coming.value;
        $("#sort_by").val(value);
        document.getElementById('frmSortBy').submit();
    }

    //DOTS SLIDER
    var newswiper = new Swiper('.related-homes-slider', {
        slidesPerView: 3,
        spaceBetween: 26,

        dots: true,
        slidesPerColumn: 2,
        grid: {
            rows: 2,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            767: {
                slidesPerView: 1,

            },
            991: {
                slidesPerView: 2,
                spaceBetween: 20,
            }
        }
    });

    //DOTS SLIDER
    $(document).ready(function() {
        var width = $(window).width();
        console.log(width)
        if (width < 768) {
            var swiper = new Swiper('.swiper-container', {
                loop: true,
                dots: true,

                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                    dynamicMainBullets: 1,
                },
            });
        }
    });

    </script>
@endsection
