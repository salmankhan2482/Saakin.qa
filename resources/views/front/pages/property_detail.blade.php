@extends("front.layouts.main")

@section('schem-markup')
<script type="application/ld+json" data-schema="2950-post-Custom">
    {
        "@context": "https://schema.org/", 
        "@type": "Property", 
        "name":"{{ $property->property_name }}",
        "image": "{{ asset('upload/properties/' . $property->featured_image) }}",
        "description": "{{ $property_des }}",
        "brand": "{{ $agency->name }}",
        "sku": "{{ $property->propertiesTypes->types }}",
        "offers": {
        "@type": "{{ $property->property_purpose }}",
        "url": "{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}",
        "priceCurrency": "QAR",
        "price": "{{ $property->price }}",
        "priceValidUntil": "2022-12-31",
        "availability": "https://schema.org/InStock",
        "itemCondition": "https://schema.org/NewCondition"
        },
        "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.9",
        "bestRating": "5",
        "worstRating": "0",
        "ratingCount": "500"
        }
    }
</script>

@endsection

@if ( $property->meta_title !=null)

@section('title',$property->meta_title .  '  |  ' . 'Saakin.qa')
@section('description',$property->meta_description ?? $property_des)
@section('keyword',$property->meta_keyword)
@section('type','property')
@section('url',url()->current())
@section('image', asset('upload/properties/'.$property->featured_image))

@else

@section('title',$property->property_name .  '  |  ' . 'Saakin.qa')
@section('description',$property_des)
@section('keyword',$property->meta_keyword)
@section('type','property')
@section('url',url()->current())
@section('image', asset('upload/properties/'.$property->featured_image))

@endif









@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <style>
        #emailBtn{
            color: white !important;
        }
        .property-item img {
            min-height: 150px;
            max-height: 150px;
        }
        .property-title-box {
            min-height: 125px;
        }
        .property-title-box {
            padding: 5px;
        }
        .feature_text {
            position: absolute;
            top: 5px;
            right: 3px;
            z-index: 100;
        }
        .address{
            padding:0;
        }
        .btn-danger{
         background-color:    #ef5e4e;
        }

        .property-feature {
            margin-left: -10px!important
        }

        .fas-icon{
            margin-right: 0px !important;
        }
        @media only screen and (max-width: 767px){
            .property-feature {
                margin-left: -3px!important
            }

            .swiper-slide img{
                height: 250px;
            }

            .property-title-box {
                min-height: 110px;
            }
            .property-location{
                line-height: 50px;
            }
            .owl-item{
                min-width: 200px !important;
            }
            .owl-stage{
                display: flex !important;
                width: 100% !important;
            }
            .social{
                height: 30px;
                width: 30px !important;
            }

        }
        .social{
                height: 30px;
                width: 30px !important;
            }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .slick-gallery {
            display: flex;
            overflow: hidden;
        }

        .slick-gallery .slide {
            min-width: 100%;
            flex-shrink: 0;
            width: 100%;
        }

        .slick-gallery.slick-slider {
            display: block;
        }

        .slick-gallery.slick-slider .slide {
            min-width: auto;
        }

        .slick-gallery .slick-dots {
            position: absolute;
            left: 0;
            right: 0;
            text-align: center;
            bottom: 10px;
        }

        .slick-gallery .slick-dots li {
            margin: 0 4px;
            display: inline-block;
        }

        .slick-gallery .slick-dots li.slick-active button {
            opacity: 1;
            height: 12px;
            width: 12px;
            background: #fff;
        }

        .slick-gallery .slick-dots button {
            border: none;
            background: #000;
            opacity: 0.2;
            height: 8px;
            width: 8px;
            border-radius: 100%;
            font-size: 0;
            line-height: 0;
            padding: 0;
            outline: none !important;
        }

        .swiper-pagination-bullet-active {
            color: #fff;
            background: #fff;
        }
        .content_description {
            grid-column: col-start 6 / span 6;
            grid-row: row-start 2 / span 6;
            background: #fff;
            height: 190px;
            overflow: hidden;
            position: relative;
        }

        .content_description_button{
            bottom: -1em;
            z-index: 100;
            padding: 5px;
            cursor: pointer;
        }

        /* slider css  */
        .slider {
            max-width: 100%;
            display: flex;
        }

        .slider .card {
            flex: 1;
            margin: 0 10px;
            background: #fff;
        }

        .slider .card .img {
            height: 150px;
            width: 100%;
        }

        .slider .card .img img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .slider .card .content {
            padding: 10px 20px;
        }

        .card .content .title {
            font-size: 25px;
            font-weight: 600;
        }

        .card .content .sub-title {
            font-size: 20px;
            font-weight: 600;
            color: #e74c3c;
            line-height: 20px;
        }

        .card .content p {
            text-align: justify;
            margin: 10px 0;
        }

        .card .content .btn {
            display: block;
            text-align: left;
            margin: 10px 0;
        }

        .card .content .btn button {
            background: #e74c3c;
            color: #fff;
            border: none;
            outline: none;
            font-size: 17px;
            padding: 5px 8px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.2s;
        }

        .card .content .btn button:hover {
            transform: scale(0.9);
        }
        .popup {
            position: relative;
            display: inline-block;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            }

            /* The actual popup */
            .popup .popuptext {
            visibility: hidden;
            width: 160px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -80px;
            }

            /* Popup arrow */
            .popup .popuptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
            }

            /* Toggle this class - hide and show the popup */
            .popup .show {
            visibility: visible;
            -webkit-animation: fadeIn 1s;
            animation: fadeIn 1s;
            }

            /* Add animation (fade in the popup) */
            @-webkit-keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
            }

            @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity:1 ;}
            }

    </style>
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
<div class="single-property-details v1 mt-60">

        <div class="container desktop_detail">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="float-right">
                                <p>
                                    Properties for {{ $property->property_purpose }} in {{ $property->address }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-8 p-1">
                            <div class="list-details-section mb-1">
                                <div class="featured_image" style="position: relative">
                                    <a data-caption="{{ $property->property_name }}" data-fancybox="gallery"
                                        href="{{ asset('upload/properties/' . $property->featured_image) }}">
                                        <img src="{{ asset('upload/properties/' . $property->featured_image) }}"
                                            alt="{{ $property->property_name }}" width="100%"
                                            style="object-fit: cover; height: 553px">
                                        </a>
                                    <div class="gallery_btn">
                                        <a href="javascript:void(0)"
                                            class="gallery-link btn btn-sm btn-primary">
                                            View Gallery
                                        </a>
                                        <div class="gallery">

                                            @if (count($property_gallery_images) > 0)
                                                @foreach ($property_gallery_images as $gallery)
                                                    <a href="{{ URL::asset('upload/gallery/' . $gallery->image_name) }}"></a>
                                                @endforeach
                                            @endif
                                        </div>

                                        <a class="googleMapPopUp btn btn-sm btn-info" rel="nofollow" data-fancybox
                                            data-type="iframe" data-preload="false" data-width="640" data-height="480"
                                            href="https://maps.google.com/maps?q={{ $property->propertyArea->name ?? ''}}
                                            {{  $property->propertyTown->name ?? '' }}
                                            {{  $property->propertySubCity->name ?? ''  }}
                                            {{  $property->propertyCity->name ?? '' }}&output=embed"
                                            target="_blank">View Map </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-1" style="max-height: 562px; overflow: hidden !important">
                            @php
                                $limit = 2;
                                $cnt = 0;
                            @endphp
                            @if (count($property_gallery_images) > 0)
                                @foreach ($property_gallery_images as $gallery)

                                    <div class="list-details-section mb-1">
                                        <a data-caption="{{ $property->property_name }}" data-fancybox="gallery"
                                            href="{{ URL::asset('upload/gallery/' . $gallery->image_name) }}">
                                            <img src="{{ URL::asset('upload/gallery/' . $gallery->image_name) }}"
                                                alt="{{ $property->property_name }}" width="100%"
                                                style="object-fit: cover;height: 275px" />
                                        </a>

                                    </div>

                                @endforeach
                            @endif

                        </div>
                    </div>

                </div>
                <div class="col-xl-7 col-lg-12 pl-0">
                    <div class="list-details-wrap">

                        <h5 class="address">
                            <a
                                data-fancybox data-type="iframe" data-preload="false" data-width="640"
                                data-height="480" href="https://maps.google.com/maps?q={{ $property->propertyArea->name ?? ''}}
                                {{  $property->propertyTown->name ?? '' }}
                                {{  $property->propertySubCity->name ?? ''  }}
                                {{  $property->propertyCity->name ?? '' }}&output=embed"
                                target="_blank"
                            >
                            <i class="fa fa-map-marker"></i>
                                {{ $property->address }}
                            </a>
                        </h5>

                        <h1
                            class="text text--size6 text--bold property-page__title"
                            style="font-family: Open Sans,sans-serif;"
                            >
                                {{ $property->property_name }}</h1>
                            <ul class="listing-address">
                                <li>
                                    <div class="row">
                                        <div class="col-6">
                                            <span><i class="fas fa-building pr-1"></i> Property Type :</span>
                                        </div>

                                        <div class="col-6">
                                            <span class="type">{{ $property->propertiesTypes->types }}</span>
                                        </div>
                                    </div>
                                </li>

                                @if ($property->getProperty_type())
                                    @if ($property->bedrooms)
                                        <li>
                                            <div class="row">

                                                <div class="col-6">
                                                    <span> <i class="fas fa-bed pr-1"></i> Bedrooms :</span>
                                                </div>

                                                <div class="col-6">
                                                    <span class="type">{{ $property->bedrooms }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endif

                                <li>
                                    <div class="row">

                                        <div class="col-6">
                                            <span><i class="fas fa-chart-area pr-1"></i> Property Size: </span>
                                        </div>


                                        <div class="col-6">
                                            <span class="type"> {{ $property->getSqm() }} </span>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="row">

                                        <div class="col-6">
                                            <span><i class="far fa-edit"></i> Property Purpose :</span>
                                        </div>

                                        <div class="col-6">
                                            <span class="type">{{ $property->property_purpose }}</span>
                                        </div>
                                    </div>
                                </li>

                                @if ($property->getProperty_type())

                                    @if ($property->bathrooms)
                                        <li>
                                            <div class="row">

                                                <div class="col-6"><span><i class="fas fa-bath pr-1"></i> Bathrooms
                                                        :</span></div>
                                                <div class="col-6"><span
                                                        class="type">{{ $property->bathrooms }}</span></div>
                                            </div>
                                        </li>
                                    @endif
                                @endif

                                <li>
                                    <div class="row">

                                        <div class="col-6"><span><i class="fa fa-tasks" aria-hidden="true"></i>
                                                Completion:
                                            </span></div>
                                        <div class="col-6"> <span class="type">Ready</span></div>
                                    </div>
                                </li>


                            </ul>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Location</h3>
                                <div class="d-flex property-map-block">
                                    <div class="map-holder">
                                        <img src="{{ asset('assets/images/70d76248e.JPG') }}" alt="Map"
                                            class="property-location__image">
                                        <div class="map_btn">
                                            <a  data-fancybox
                                                data-type="iframe"
                                                data-preload="false"
                                                data-width="640"
                                                data-height="480"
                                                href="https://maps.google.com/maps?q={{ $property->propertyArea->name ?? ''}}
                                                {{  $property->propertyTown->name ?? '' }}
                                                {{  $property->propertySubCity->name ?? ''  }}
                                                {{  $property->propertyCity->name ?? '' }}&output=embed"
                                                class="btn btn-sm btn-info">View</a>
                                        </div>
                                    </div>
                                    <p style="width: 11em !important;">
                                        @if (isset($property->propertyArea->name))
                                            {{ $property->propertyArea->name }}
                                        @elseif(isset($property->propertyTown->name))
                                            {{ $property->propertyTown->name }}
                                        @elseif(isset($property->propertySubCity->name))
                                            {{ $property->propertySubCity->name }}
                                        @elseif(isset($property->propertyCity->name))
                                            {{ $property->propertyCity->name }}
                                        @endif
                                        
                                        <br>
                                        
                                        {{ $address ? $address :  $property->address }}

                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h3>Agent</h3>
                                @if (!empty($property->whatsapp) && !empty($property->agent_name))
                                    <div class="d-flex">

                                        <!-- agent pic on desktop -->
                                        @if (!empty($property->agent_picture))
                                        <a class="agent-img" href="{{url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)}}">
                                            <img src="{{ asset('upload/properties/' . $property->agent_picture) }}"
                                                class="property-location__image rounded-circle" alt="Agent Pic" style="width: 120px;">
                                        </a>
                                        @else
                                        <a class="agent-img" href="{{url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)}}">
                                            <img src="{{ asset('upload/agencies/no-image.png') }}"
                                                class="property-location__image rounded-circle" alt="Agent No Pic" style="width: 120px;">
                                        </a>
                                        @endif
                                        <div class="d-md-block">
                                            <h5 style="margin-left: 15px;">{{ $property->agent_name }}</h5>
                                            <div class="col-md-12">
                                                <a
                                                    href="{{url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)}}">
                                                    <img
                                                        src="{{ asset('upload/agencies/' . $agency->image) }}"
                                                        class="property-location__image"
                                                        style="width: 50px; float: left;"
                                                        alt="Agency Pic">
                                                </a>
                                                <h5 style="font-size: 13px; float: left; margin:0px !important">
                                                    <a  href="{{url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)}}">
                                                        {{ $agency->name }}
                                                    </a>
                                                </h5>
                                                <h5 style="font-size: 13px; float: left; margin:0px !important">
                                                    <a  href="{{url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)}}">
                                                        ({{ count(App\Properties::where('status', '1')->where('agency_id', $agency->id)->get()) }}
                                                        properties)
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex">

                                        @if (!empty($agency->image))
                                        <div>
                                            <a class="agent-img"  href="{{url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)}}">
                                                <img src="{{ asset('upload/agencies/' . $agency->image) }}" alt="Map"
                                                    class="property-location__image rounded">
                                            </a>
                                        </div>
                                        @endif
                                        <div class="d-md-block">
                                            @if (!empty($agency->name))
                                                <div>
                                                    <h5 style="margin-left: 15px">
                                                        <a  href="{{url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)}}">
                                                            {{ $agency->name }}
                                                        </a>
                                                    </h5>
                                                    <a
                                                        style="margin-left: 15px"
                                                        href="{{url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)}}"
                                                    >
                                                        ({{ count(App\Properties::where('status', '1')->where('agency_id', $agency->id)->get()) }}
                                                        properties)</a>
                                                </div>
                                            @else
                                                Agent not found
                                            @endif
                                        </div>

                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="list-details-wrap mt-20">
                        <h3>Description</h3>
                        <div class="panel-wrapper" id>

                            <div class="content_description" id="content_description">
                                {!! nl2br(strip_tags($property->description)) !!}
                            </div>

                            <a class="content_description_button" id="read-more"
                                    onclick="readMoreReadLess('more')" style="">
                                <i class="fas fa-angle-down"></i>
                                Read More
                            </a>

                            <a class="content_description_button panel" id="read-less"
                                    style="display: none;" onclick="readMoreReadLess('less')">
                                <i class="fas fa-angle-up"></i>
                                Read less
                            </a>

                            <div class="cus_fade" style=" height: 50px !important; margin-top: -9px;"></div>
                        </div>


                        <hr>
                        @if ($property->property_features)
                            <div class="row p-2">
                                <div class="col-md-12">
                                    <h3 class="text-left mt-2">Amenities</h3>
                                    <ul class="aminities">
                                        @foreach (explode(',', $property->property_features) as $features)
                                            @php
                                                $ameniti = \App\PropertyAmenity::getAmmienties($features);
                                            @endphp
                                            @if ($ameniti)

                                                <li
                                                    style="font-size: 13px !important; color: #000 !important; font-weight: bold !important; letter-spacing: 1px !important;">
                                                    <strong> <i class="fas fa-check-circle pr-1"></i>
                                                    </strong>{{ $ameniti }}
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- <hr> --}}
                    {{-- desktop social share links --}}
                        <div class="row p-2" style="border: none !important; background-color: white !important;">
                            <div style="padding: 0 10px 5px 5px;" class="col-12">
                                <div class="modal-header" style="padding: 0.5rem">
                                  <h5 class="modal-title" id="exampleModalLongTitle">Share This Property</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="list-details-wrap text-center">
                                        <a href="http://www.facebook.com/sharer.php?u={{url()->current()}}" target="_blank" class="col-2 btn btn-outline">
                                            <img src="https://simplesharebuttons.com/images/somacro/facebook.png" class="social" alt="Facebook">
                                        </a>
                                        <!-- copy url -->
                                        <button
                                            class="col-2 btn btn-outline popup"
                                            value="copy" style="background: none !important"
                                            onclick="copyToClipboard('copy_{{ $property->id }}')"
                                        >
                                        <span class="popuptext mypopup" id="copy">copied!</span>
                                            <img src="{{asset('upload/copy-icon.png')}}" class="social" alt="Copy Property URL">

                                        </button>
                                        <!-- Twitter -->
                                        <a href="https://twitter.com/share?url={{url()->current()}}" target="_blank" class="col-2 btn btn-outline">
                                            <img src="https://simplesharebuttons.com/images/somacro/twitter.png" class="social" alt="Twitter">
                                        </a>

                                        <!-- WhatsApp -->
                                        <a href="https://api.whatsapp.com/send?text={{url()->current()}}" target="_blank" class="col-2 btn btn-outline">
                                            <img src="{{asset('upload/whatsapp.png')}}" class="social socialw" alt="WhatsApp">
                                        </a>



                                        <a href="https://pinterest.com/pin/create/button/?url={{url()->current()}}" target="_blank" class="col-2 btn">
                                            <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" class="social" alt="Pinterest">

                                        </a>

                                    </div>
                                </div>

                              </div>
                        </div>
                    @if (count($properties) > 0)
                        <div class="similar-listing-wrap mt-30 pb-70">
                            <div class="container">
                                <div class="col-md-12 px-0">
                                    <div class="similar-listing">
                                        <div class="section-title v2">
                                            <h3> {{ $properties->count() }} More Properties in the Same Area</h3>
                                        </div>
                                        <div style="padding: 0px !important">
                                            <div class="slider owl-carousel">
                                                @foreach ($properties as $propx)
                                                    <div class="card">
                                                        <div class="property-item">
                                                            <a class="property-img"
                                                                href="{{ url(strtolower($property->property_purpose) . '/' . $propx->property_slug . '/' . $propx->id) }}">
                                                                @if ($propx->featured_image)
                                                                    <img src="{{ URL::asset('upload/properties/thumb_' . $propx->featured_image) }}"
                                                                        alt="{{ $propx->property_name }}">
                                                                @else
                                                                    <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}"
                                                                        alt="{{ $propx->property_name }}">
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
                                                            <h2 class="property-card__property-title">
                                                        {{ \Illuminate\Support\Str::limit($property->property_name, 20) }}
                                                            </h2>
                                                            <div class="property-location">
                                                                <p>
                                                                    {{ $propx->propertiesTypes->types }}
                                                                    <br>
                                                                    {{ $property->address }}
                                                                </p>
                                                            </div>

                                                            <ul class="property-feature" >
                                                                @if ($propx->getProperty_type())
                                                                    <li style="width: 30% !important;">
                                                                        <i class="fas fa-bed fas-icon"></i>
                                                                        <span>{{ $propx->bedrooms }} </span>
                                                                    </li>
                                                                    <li style="width: 30% !important;" >
                                                                        <i class="fas fa-bath fas-icon" ></i>
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-6 col-lg-5 p-1">
                    <div class="desk card sticky call-email-block" tabindex="1">
                        <div class="card-body">
                            <h2>
                                <strong>{{ $property->getPrice() }}
                                    @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                                        / Month
                                    @endif
                                </strong>
                            </h2>

                                <div class="callgroup">
                                    @if (!empty($property->whatsapp))
                                    <a href="tel:{{ $property->whatsapp }}" class="btn btn-danger btn-call">
                                        <i class="fas fa-phone-alt"></i>
                                        Call Now
                                    </a>
                                    @else
                                    <a href="tel:{{ $agency->phone }}" class="btn btn-danger btn-call">
                                        <i class="fas fa-phone-alt"></i>
                                        Call Now
                                    </a>
                                    @endif
                                    @if (!empty($property->whatsapp))
                                        <a href="//api.whatsapp.com/send?phone={{ $property->whatsapp }}&text={{ urlencode($whatsapText) }}"
                                            class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                    @elseif(!empty($agency->whatsapp))
                                        <a href="//api.whatsapp.com/send?phone={{ $agency->whatsapp }}&text={{ urlencode($whatsapText) }}"
                                            class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                    @endif
                                    <button
                                        class="btn btn-danger"
                                        type="button"
                                        data-toggle="modal"
                                        data-target="#exampleModal"
                                        id="emailBtn"
                                        data-image="{{ asset('upload/properties/' . $property->featured_image) }}"
                                        data-title="{{ $property->property_name }}"
                                        data-agent="{{ $property->agent_name ?? $agency->name }}"
                                        data-broker="{{ $agency->name ?? '' }}"
                                        data-bedroom="{{ $property->bedrooms ?? '' }}"
                                        data-bathroom="{{ $property->bathrooms ?? '' }}"
                                        data-area="{{ $property->getSqm() ?? '' }}"
                                    >
                                        <i class="fas fa-envelope-square"></i>
                                        Email Now
                                    </button>
                                </div>

                            <div class="call-detail-block">
                                <div class="num-btn-holder">
                                    <a href="#"><i class="fas fa-phone-alt"></i>
                                        {{ $property->whatsapp ?? $agency->phone }}
                                    </a>

                                <a
                                    style="color: #ef5e4e !important;"
                                    class="btn-email"
                                    id="emailBtn"
                                    data-toggle="modal"
                                    data-target="#exampleModal"
                                    data-image="{{ asset('upload/properties/' . $property->featured_image) }}"
                                    data-image="{{ $property->featured_image }}"
                                    data-title="{{ $property->property_name }}"
                                    data-agent="{{ $property->agent_name ?? $agency->name }}"
                                    data-broker="{{ $agency->name ?? '' }}"
                                    data-bedroom="{{ $property->bedrooms ?? '' }}"
                                    data-bathroom="{{ $property->bathrooms ?? '' }}"
                                    data-area="{{ $property->getSqm() ?? '' }}">
                                    <i class="fas fa-envelope"></i>
                                    Email
                                </a>
                                </div>
                                <div class="detail-block">
                                    <p>Mention the reference: <strong>{{ $property->refference_code }}</strong></p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2 pl-20 pr-20">
                        </div>
                    </div>
                      <!-- desktop report this -->
                    <div class="text-center">
                       <a
                        href=""
                        style="text-decoration: underline !important;"
                        onmouseover="this.style.color='blue'"
                        onmouseout="this.style.color='#222'"
                        data-toggle="modal"
                        data-target="{{ auth()->check() ? '#reportModal' : '#user-login-popup'}}"
                        >
                           <i class="fas fa-flag"></i>
                           Report this Property
                        </a>
                        @if ($message = Session::get('message'))
                        <div class="alert alert-info alert-block d-flex" >
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <div class="mobile_detail">

            <div class="col-sm-12 p-0">

                <div class="swiper-container swiper-container-gallery">
                    <div class="slick-gallery">
                        <div class="slide">
                            <img src="{{ asset('upload/properties/' . $property->featured_image) }}"
                                alt="{{ $property->property_name }}" width="100%">
                        </div>
                        @if (count($property_gallery_images) > 0)
                            @foreach ($property_gallery_images as $pgi)

                                <div class="slide">
                                    <img src="{{ URL::asset('upload/gallery/' . $pgi->image_name) }}"
                                        alt="{{ $property->property_name }}" width="100%">
                                </div>

                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-center">
                        <p>
                            Properties for {{ $property->property_purpose }} in {{ $property->address }}
                        </p>
                    </div>
                </div>
                <div class="container">
                    <h4 class="text-center mob_price">{{ $property->getPrice() }}
                        @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                            / Month
                        @endif
                    </h4>

                    <div class="mobile card" id="mobsticky" style="text-align: center !important;">
                        <div class="container">
                            <div class="card-body p-2" style="text-align: center !important;">
                                @if ($agency)
                                    <div class="callgroupxxx" style="text-align: center !important;">
                                    @if (!empty($property->whatsapp) OR !empty($agency->phone))
                                        <a href="tel:{{ $property->whatsapp ?? $agency->phone }}" class="btn btn-danger">
                                            <i class="fas fa-phone-alt"></i>
                                            Call Now
                                        </a>
                                    @endif

                                    @if (!empty($property->whatsapp))
                                        <a href="//api.whatsapp.com/send?phone={{ $property->whatsapp }}&text={{ urlencode($whatsapText) }}"
                                            class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                    @elseif(!empty($agency->whatsapp))
                                        <a href="//api.whatsapp.com/send?phone={{ $agency->whatsapp }}&text={{ urlencode($whatsapText) }}"
                                            class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                    @endif


                                        @if ($agency->email)
                                            <a
                                                class="btn btn-danger"
                                                id="emailBtn"
                                                data-toggle="modal"
                                                data-target="#exampleModal"
                                                data-image="{{ asset('upload/properties/' . $property->featured_image) }}"
                                                data-image="{{ $property->featured_image }}"
                                                data-title="{{ $property->property_name }}"
                                                data-agent="{{ $property->agent_name ?? $agency->name }}"
                                                data-broker="{{ $agency->name ?? '' }}"
                                                data-bedroom="{{ $property->bedrooms ?? '' }}"
                                                data-bathroom="{{ $property->bathrooms ?? '' }}"
                                                data-area="{{ $property->getSqm() ?? '' }}">
                                                <i class="fas fa-envelope"></i> Email Now
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">

                <div class="row p-2">
                    <div class="col-md-12" style="padding: 0px !important;">
                        <h4 class="text-center">{{ $property->property_name }}</h4>
                        <ul class="property_loc">
                            <li>
                                <div class="row d-flex">

                                    <div class="col-6">
                                        <i class="fas fa-building pr-1"></i>Property Type:
                                    </div>

                                    <div class="col-6 p-0">
                                        <span class="type">{{ $property->propertiesTypes->types }}</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row d-flex">

                                    <div class="col-6">
                                        <i class="fas fa-building pr-1"></i>Property Purpose:
                                    </div>


                                    <div class="col-6 p-0">
                                        <span class="type">{{ $property->property_purpose }}</span>
                                    </div>
                                </div>
                            </li>

                            @if ($property->getProperty_type())
                                @if ($property->bedrooms)

                                    <li>
                                        <div class="row d-flex">


                                            <div class="col-6">

                                                <i class="fas fa-house-damage pr-1"></i>Bedrooms:
                                            </div>

                                            <div class="col-6 p-0">
                                                <span class="type">{{ $property->bedrooms }}</span>

                                            </div>
                                        </div>
                                    </li>
                                @endif

                                @if ($property->bathrooms)
                                    <li>
                                        <div class="row d-flex">


                                            <div class="col-6">
                                                <i class="fas fa-shower pr-1"></i>Bathrooms:
                                            </div>

                                            <div class="col-6 p-0">
                                                <span class="type">{{ $property->bathrooms }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endif
                            <li>
                                <div class="row d-flex">

                                    <div class="col-6">
                                        <i class="fa fa-tasks" aria-hidden="true"></i>Completion:
                                    </div>


                                    <div class="col-6 p-0">
                                        <span class="type">Ready</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row d-flex">


                                    <div class="col-6">
                                        <i class="fas fa-chart-area pr-1"></i>Property Size:
                                    </div>

                                    <div class="col-6 p-0">
                                        <span class="type">{{ $property->getSqm() }}</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-md-8 col-6">
                        <div class="wrapper">
                            <h5 class="add">Location</h5>
                            <p> 
                                @if (isset($property->propertyArea->name))
                                    {{ $property->propertyArea->name }}
                                @elseif(isset($property->propertyTown->name))
                                    {{ $property->propertyTown->name }}
                                @elseif(isset($property->propertySubCity->name))
                                    {{ $property->propertySubCity->name }}
                                @elseif(isset($property->propertyCity->name))
                                    {{ $property->propertyCity->name }}
                                @endif
                                
                                <br>
                                
                                {{ $address ? $address :  $property->address }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="d-flex property-map-block">
                            <div class="map-holder">
                                <img src="{{ asset('assets/images/70d76248e.JPG') }}" alt="Map"
                                    class="property-location__image">
                                <div class="map_btn">
                                    <a href="https://maps.google.com/maps?q='+{{ $property->propertyArea->name ?? ''}} {{  $property->propertyTown->name ?? '' }} {{  $property->propertySubCity->name ?? ''  }} {{  $property->propertyCity->name ?? '' }}+'" target="_blank"
                                        class="btn btn-sm btn-info">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-2 agent-wrapper">
                    @if ($agency)
                        <div class="col-md-8 col-6">

                            <div class="wrapper">
                                <h5 class="add">Agent</h5>

                                <a href="{{url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)}}">
                                    <p> {{ $agency->name }}</p>
                                </a>

                                <a href="{{url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)}}">
                        ({{  count(App\Properties::where('status', '1')->where('agency_id', $agency->id)->get())  }}
                                    properties)
                                </a>
                            </div>

                        </div>
                        <div class="col-md-4 col-6">
                            <div class="d-flex">
                                <a class="agent-img" href="{{url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)}}">
                                <img src="{{ asset('upload/agencies/' . $agency->image) }}" alt="Map"
                                    class="property-location__image">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="call_to_agent">
                                <a class="btn btn-outline-dark " href="tel:{{ $property->whatsapp ?? $agency->phone }}">
                                    Call Agent
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row p-2">
                    <div class="col-md-12 col-12">
                        <h5>Description</h5>
                        <div class="panel-wrapper">
                            <a href="#show" class="show" id="show">Read more</a>
                            <a href="#hide" class="hide" id="hide">Read less</a>
                            <div class="panel">
                                {!! nl2br(strip_tags($property->description)) !!}
                            </div>
                            <div class="cus_fade" style=" height: 50px !important; margin-top: -9px;"></div>
                        </div>
                    </div>
                </div>

                @if ($property->property_features)
                    <div class="row p-2">
                        <div class="col-md-12">
                            <h3 class="text-left mt-2">Amenities</h3>
                            <ul class="aminities">
                                @foreach (explode(',', $property->property_features) as $features)
                                    @php
                                        unset($ameniti);
                                        $ameniti = \App\PropertyAmenity::getAmmienties($features);
                                    @endphp
                                    @if ($ameniti)

                                        <li
                                            style="width:100% !important; font-size: 13px !important; color: #000 !important; font-weight: bold !important; letter-spacing: 1px !important;">
                                            <strong> <i class="fas fa-check-circle pr-1"></i> </strong>{{ $ameniti }}
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>
                @endif
            </div>

             {{-- mbl social links --}}

            <div class="container" >
                <div class="modal-content" style="padding: 0 10px 5px 5px;">
                    <div class="modal-header" style="padding: 0.5rem">
                      <h5 class="modal-title" id="exampleModalLongTitle">Share This Property</h5>
                    </div>
                    <div class="modal-body ">
                        <div class="list-details-wrap text-center">
                            <a href="http://www.facebook.com/sharer.php?u={{url()->current()}}" target="_blank" class="btn btn-outline">
                                <img src="https://simplesharebuttons.com/images/somacro/facebook.png" class="social" alt="Facebook">
                            </a>
                            <!-- LinkedIn -->
                            <button
                                class="col-2 btn btn-outline"
                                value="copy" style="background: none !important"
                                onclick="copyToClipboard('copy_{{ $property->id }}')"
                            >
                                <img src="{{asset('upload/copy-icon.png')}}" class="social" alt="LinkedIn">
                            </button>
                            <!-- Twitter -->
                            <a href="https://twitter.com/share?url={{url()->current()}}" target="_blank" class="btn btn-outline">
                                <img src="https://simplesharebuttons.com/images/somacro/twitter.png" class="social" alt="Twitter">
                            </a>

                            <!-- WhatsApp -->
                            <a href="https://api.whatsapp.com/send?text={{url()->current()}}" target="_blank" class="btn btn-outline mt-1">
                                <img src="{{asset('upload/whatsapp.png')}}" class="social" alt="WhatsApp">
                            </a>


                            <a href="https://pinterest.com/pin/create/button/?url={{url()->current()}}" target="_blank" class="btn btn-outline mt-1">
                                <img src="{{asset('upload/pinterest.png')}}" class="social" alt="Pintrest">
                            </a>

                        </div>
                    </div>

                  </div>
            </div>
            <div class="text-center" style="padding: 10px 0px 20px 0px !important;">
                <a
                 href=""
                 style="text-decoration: underline !important; margin: 10px 16px; float:left;"
                 onmouseover="this.style.color='blue'"
                 onmouseout="this.style.color='#222'"
                 data-toggle="modal"
                 data-target="{{ auth()->check() ? '#reportModal' : '#user-login-popup'}}"
                 >
                    <i class="fas fa-flag"></i>
                    Report this Property
                    {{-- mbl report this property --}}
                 </a>


                    @if ($message = Session::get('message'))
                    <div class="alert alert-info alert-block" style="width: 100% !important; display: flex;">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
             </div>

            @if (count($properties) > 0)

                <div class="similar-listing-wrap mt-30 pb-70">
                    <div class="container">
                        <div class="col-md-12 px-0">
                            <div class="similar-listing">
                                <div class="section-title v2">
                                    <h3>{{ $properties->count() }} More Properties in the Same Area</h3>
                                </div>
                                <div class="slider owl-carousel">
                                    @foreach ($properties as $propx)
                                        <div class="card">
                                            <div class="property-item">
                                                <a class="property-img"
                                                    href="{{ url(strtolower($property->property_purpose) . '/' . $propx->property_slug . '/' . $propx->id) }}">
                                                    @if ($propx->featured_image)
                                                        <img src="{{ URL::asset('upload/properties/thumb_' . $propx->featured_image) }}"
                                                            alt="{{ $propx->property_name }}">
                                                    @else
                                                        <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}"
                                                            alt="{{ $propx->property_name }}">
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
                                                <h2 class="property-card__property-title">
                                                    {{ \Illuminate\Support\Str::limit($property->property_name, 20) }}
                                                </h2>
                                                <div class="property-location">
                                                    <p>
                                                        {{ $propx->propertiesTypes->types }}
                                                        <br>
                                                        {{ $property->address }}
                                                    </p>
                                                </div>
                                                <ul class="property-feature">
                                                    @if ($propx->getProperty_type())
                                                        <li><i class="fas fa-bed"></i><span>{{ $propx->bedrooms }}
                                                            </span>
                                                        </li>
                                                        <li><i class="fas fa-bath"></i><span>{{ $propx->bathrooms }}
                                                            </span>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <span style="float: left; margin-left: 0.3rem; margin-top:4px;
                                                                    color: #5a5a5a">
                                                            <i class="fas fa-chart-area"></i><span>{{ $property->getSqm() }}</span>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </div>
@endsection
@section('scripts-custom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/carousel.autoplay.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/carousel.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.controls.umd.js"></script>

    <script type="text/javascript">

        function readMoreReadLess(text) {
            if(text == 'more'){
                $(document).ready(function() {
                    $('.content_description').css('height', 'auto');
                    $("#read-more").css('display', 'none');
                    $("#read-less").css('display', 'block');
                });
            }else{
                    $('.content_description').css('height', '190px');
                    $("#read-more").css('display', 'block');
                    $("#read-less").css('display', 'none');
            }
        }

        function copyToClipboard(id) {
            var copyUrl = window.location.href;
            console.log(copyUrl);
            navigator.clipboard.writeText(copyUrl);
            var popup = document.getElementById("copy");
            popup.classList.toggle("show");
        }

        $(".slider").owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
        });


        // Toggle Sidebar Agent Widget
        $('.sidebar-widget-toggler > button').on('click', function() {
            $('.sidebar-agent-widget').fadeIn(300)
        })
        $('.close-agent-widget').on('click', function() {
            $('.sidebar-agent-widget').fadeOut(300)
        })
        $('#desshow').on('click', function() {
            $('#mongo').css('color', 'black');
        })
        $('#deshide').on('click', function() {
            $('#mongo').css('color', 'gray')
        })



        jQuery(function() {
            $('.slick-gallery').slick({
                infinite: true,
                slidesToShow: 1,
                dots: true,
                speed: 300,
                arrows: false,
                slidesToScroll: 1,
                adaptiveHeight: true
            });
        });


        var similar_property = new Swiper('.related-homes-slider', {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            dots: true,
            centeredSlides: true,
            // Responsive breakpoints
            breakpoints: {
                '480': {
                    slidesPerView: 1.5,
                    spaceBetween: 10,
                },
                '640': {
                    slidesPerView: 2,
                    spaceBetween: 15,
                },
            },
            cssMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination'
            },
            mousewheel: true,
            keyboard: true
        });


        $('.gallery-link').on('click', function() {
            $(this).next().magnificPopup('open');
        });

        $('.gallery').each(function() {
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true
                },
                fixedContentPos: false
            });
        });
        window.onscroll = function() {
            stickyFunction()
        };
        var header = document.getElementById('mobsticky');
        var sticky = header.offsetTop;

        function stickyFunction() {
            console.log(window.pageYOffset + sticky)
            if (window.pageYOffset > sticky) {
                header.classList.add("mobile_sticky");
            } else {
                header.classList.remove("mobile_sticky");
            }
        }
    </script>

@endsection
