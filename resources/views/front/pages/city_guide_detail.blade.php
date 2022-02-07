@extends("front.layouts.main")
@if ($cityGuide->meta_title !=null)

@section('title',$cityGuide->meta_title .  '  |  ' . 'Saakin.com')
@section('description',$cityGuide->meta_description)
@section('keyword',$cityGuide->meta_keyword)
@section('type','City Guide Saakin.com')
@section('url',url()->current())
@section('image', asset('upload/cities/'.$cityGuide->city_image))

@else

@section('title',$cityGuide->name .  '  |  ' . 'Saakin.com')
@section('description',$cityGuide->short_description)
@section('keyword',$cityGuide->attributes)
@section('type','City Guide Saakin.com')
@section('url',url()->current())
@section('image', asset('upload/cities/'.$cityGuide->city_image))

@endif
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

<style>
    .guide.img-fluid {
        height: 350px;
        width: 100%;
    }
    .li-fixed{
        display: inline-block;
        padding: 20px 20px;
        margin: 0;
        color: #515151;
        font-family: lato;
        cursor: pointer;
    }

    .f-nav{  /* To fix main menu container */
        z-index: 9999;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
    }
    #city-guide-container {
        text-align: center; /* Assuming your main layout is centered */
        margin-bottom: 50px;
    }
    #main-menu {
        display: inline-block;
        width: 1024px; /* Your menu's width */
    }

    @media (max-width: 700px) {
        .li-fixed{
            padding: 20px 4px;
            font-size: 14px;
            display: inline-block;
            margin: 0;
            color: #5a5a5a;
            font-family: 'Open Sans',sans-serif;
        }

        .icons-container{
            padding: 0px;
            overflow-x: auto;
            white-space: nowrap;
            justify-content: normal !important;
        }
        .li-fixed{
            padding: 10px 4px;
        }
    }

    .icons-container{
        justify-content: center;
    }
    .selectedLi{
        color: #009fff !important;
    }

    @media only screen and (max-width: 767px){
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

    }

    .property-card__property-title{
        white-space: nowrap !important;
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
    .property-salman {
        list-style: none outside none; margin:0; padding: 0; text-align:center; padding:3px 0; overflow:hidden; display: flex;
    align-items: stretch; /* Default */
    justify-content: space-between;
    }
    .property-salman li{
        display:block; float:left; margin: 0 2%;
    }
    .feature_text {
        position: absolute;
        top: 5px;
        right: 3px;
        z-index: 100;
    }

    .fas-icon{
        margin-right: 0px !important;
    }

    .slick-gallery.slick-slider {
        display: block;
    }

    .slick-gallery.slick-slider .slide {
        min-width: auto;
    }

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

</style>
<!--Breadcrumb section starts-->
<div class="breadcrumb-section property-amenities-wrap bg-fixed bg-h" style="background-image: url({{asset('upload/cities/'.$cityGuide->city_image)}});background-position: center;" >
    <div class="overlay op-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <div class="breadcrumb-menu">
                    <h1>{{$cityGuide->name}}</h1>
                    <span><a href="{{ url('/') }}">Home</a></span>
                    <span>City Guide / {{$cityGuide->name}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Breadcrumb section ends-->

    <div class="guide_d">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 ml-auto mr-auto col-md-12" style="height: auto !important;">
                    <div class="property-amenities-box topArea_v1 text-center" style="height: auto !important">
                        <h2 class="mb-1 fontfamily">Welcome to {{$cityGuide->name}}</h2>
                        <p>{{$cityGuide->short_description}}</p>

                        <div class="row mt-3">
                            <div class="col-md-8 text-left">
                                <h6 class="mb-2 border-bottom pb-2">Key Details</h6>
                                <ul class="property-info_v1">
                                    @if(count($cityGuideDetails) > 0)
                                        @foreach($cityGuideDetails as $cityGuideDetail)
                                            <li>
                                                <strong>{{$cityGuideDetail->title}}</strong>
                                                <p>{{$cityGuideDetail->short_description}}</p>
                                            </li>
                                        @endforeach
                                    @endif

                                </ul>
                                <div class="area-key-details">
                                    <strong class="key-title">
                                        Property trends
                                    </strong>
                                    <ul class="sub-details">
                                        <li>Buy</li>
                                        <li>Rent</li>
                                        <li>ROI</li>
                                    </ul>
                                    <strong class="key-title">
                                        Neighbourhood</strong>
                                    <ul class="sub-details">
                                        <li>Popular Communities</li>
                                        <li>Public Transport</li>
                                        <li>Clinics &amp; Hospitals</li>
                                        <li>Schools</li>
                                        <li>Super Markets</li>
                                    </ul>
                                    <strong class="key-title">
                                        Lifestyle
                                    </strong>
                                    <ul class="sub-details">
                                        <li>Shopping Malls</li>
                                        <li>Restaurants</li>
                                        <li>Beaches</li>
                                        <li>Fitness &amp; Beauty</li>
                                    </ul>
                                    <strong class="key-title">Things to consider</strong>
                                    <ul class="sub-details">
                                        <li>Airport</li>
                                        <li>Metro Station</li>
                                        <li>Market (wholesale/food)</li>
                                        <li>Beach</li>
                                        <li>Stadiums</li>
                                    </ul>
                                    <strong class="key-title">Locations</strong>
                                    <ul class="sub-details">
                                        <li>Airport</li>
                                        <li>Metro Station</li>
                                        <li>Market (wholesale/food)</li>
                                        <li>Beach</li>
                                        <li>Stadiums</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 text-left">
                                <h6 class="mb-2 border-bottom pb-2">Attributes</h6>
                                <p class="font-13">{{$cityGuide->attributes}}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="city-guide-container" style="background-color: white">
                <div class="container d-flex icons-container">
                        <ul>
                            <li class="li-fixed" onclick="toScroll('propertyTrends');">
                                <div class="propertyTrendsDiv" style="
                                background: url(/assets/images/cityGuide/propertyTrends.png) no-repeat 50% 50%;
                                background-size: auto 100%; height: 50px; ">
                                    &nbsp;
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="activeLi propertyTrends">
                                        Property trends
                                    </a>
                                </div>
                            </li>
                            <li class="li-fixed" onclick="toScroll('neighborhood');">
                                <div class="neighborhoodDiv" style="
                                background: url(/assets/images/cityGuide/neighborHood.png) no-repeat 50% 50%;
                                background-size: auto 100%; height: 50px; ">
                                    &nbsp;
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="activeLi neighborhood">
                                        Neighbourhood
                                    </a>
                                </div>
                            </li>
                            <li class="li-fixed" onclick="toScroll('lifestyle');">
                                <div class="lifestyleDiv" style="
                                background: url(/assets/images/cityGuide/lifeStyle.png) no-repeat 50% 50%;
                                background-size: auto 100%; height: 50px; ">
                                    &nbsp;
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="activeLi lifestyle">
                                        Lifestyle
                                    </a>
                                </div>
                            </li>


                            <li class="li-fixed" onclick="toScroll('thingsToConsider');">
                                <div class="thingsToConsiderDiv" style="
                                background: url(/assets/images/cityGuide/thingsToConsider.png) no-repeat 50% 50%;
                                background-size: auto 100%; height: 50px; ">
                                    &nbsp;
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="activeLi thingsToConsider">
                                        Things to consider
                                    </a>
                                </div>
                            </li>

                            <li class="li-fixed" onclick="toScroll('locations');">
                                <div class="locationsDiv" style="
                                background: url(/assets/images/cityGuide/locations.png) no-repeat 50% 50%;
                                background-size: auto 100%; height: 50px; ">
                                    &nbsp;
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="activeLi locations">
                                        Locations
                                    </a>
                                </div>
                            </li>

                            <li class="li-fixed" onclick="toScroll('attributes');">
                                <div class="attributesDiv" style="
                                background: url(/assets/images/cityGuide/attributes.png) no-repeat 50% 50%;
                                background-size: auto 100%; height: 50px; ">
                                    &nbsp;
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="activeLi attributes">
                                        Attributes
                                    </a>
                                </div>
                            </li>
                        </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="guide_d pt-5" id="data-div">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 ml-auto mr-auto col-md-12 " style="height: auto !important;">
                    <div class="property-amenities-box topArea_v1 text-center dddiv" style="margin-top:120px; height: auto !important">

                        <div id="propertyTrends" class="scrollingDiv">
                            <h2>Property Trends</h2>

                            <p> {!! $cityGuideContent->property_trends ??'' !!} </p>

                        </div>

                        <div id="neighborhood" class="scrollingDiv">
                            <h2>NeighborHood</h2>
                            <p> {!! $cityGuideContent->neighborhood ??'' !!} </p>

                            {{-- properties for rent slider --}}
                            @if (count($propertiesForRent) > 0)

                            <div class="similar-listing-wrap ">
                                <div class="container">
                                    <div class="col-md-12 px-0">
                                        <div class="similar-listing">
                                            <div class="section-title v2">
                                                <h3>{{ $propertiesForRent->count() }} Properties for Rent</h3>
                                            </div>
                                            <div class="slider owl-carousel">
                                                @foreach ($propertiesForRent as $propx)
                                                    <div class="card">
                                                        <div class="property-item">
                                                            <a class="property-img"
                                                                href="{{ url(strtolower($propx->property_purpose) . '/' . $propx->property_slug . '/' . $propx->id) }}">
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
                                                                {{ \Illuminate\Support\Str::limit($propx->property_name, 20) }}
                                                            </h2>
                                                            <div class="property-location">
                                                                <p>
                                                                    {{ \Illuminate\Support\Str::limit($propx->propertiesTypes->types, 20) }}
                                                                    <br>
                                                                    {{ \Illuminate\Support\Str::limit($propx->address, 20) }}
                                                                </p>
                                                            </div>
                                                            <ul class="property-salman">
                                                                @if ($propx->getProperty_type())
                                                                    <li>
                                                                        <i class="fas fa-bed"></i>
                                                                        <span>
                                                                            {{ $propx->bedrooms }}
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <i class="fas fa-bath"></i>
                                                                        <span>
                                                                            {{ $propx->bathrooms }}
                                                                        </span>
                                                                    </li>
                                                                @endif
                                                                <li class="{{ !$propx->getProperty_type() ? 'onlyArea' : '' }}">
                                                                    <span>
                                                                        <i class="fas fa-chart-area"></i>
                                                                        <span>
                                                                            {{ $propx->getSqm() }}
                                                                        </span>
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
                            
                            {{-- properties for Sale slider --}}
                            @if (count($propertiesForSale) > 0)

                            <div class="similar-listing-wrap mb-20">
                                <div class="container">
                                    <div class="col-md-12 px-0">
                                        <div class="similar-listing">
                                            <div class="section-title v2">
                                                <h3>{{ $propertiesForSale->count() }} Properties for Sale</h3>
                                            </div>
                                            <div class="slider owl-carousel">
                                                @foreach ($propertiesForSale as $propx)
                                                    <div class="card">
                                                        <div class="property-item">
                                                            <a class="property-img"
                                                                href="{{ url(strtolower($propx->property_purpose) . '/' . $propx->property_slug . '/' . $propx->id) }}">
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
                                                                {{ \Illuminate\Support\Str::limit($propx->property_name, 20) }}
                                                            </h2>
                                                            <div class="property-location">
                                                                <p>
                                                                    {{ \Illuminate\Support\Str::limit($propx->propertiesTypes->types, 20) }}
                                                                    <br>
                                                                    {{ \Illuminate\Support\Str::limit($propx->address, 20) }}
                                                                </p>
                                                            </div>
                                                            <ul class="property-salman">
                                                                @if ($propx->getProperty_type())
                                                                    <li>
                                                                        <i class="fas fa-bed"></i>
                                                                        <span>
                                                                            {{ $propx->bedrooms }}
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <i class="fas fa-bath"></i>
                                                                        <span>
                                                                            {{ $propx->bathrooms }}
                                                                        </span>
                                                                    </li>
                                                                @endif
                                                                <li class="{{ !$propx->getProperty_type() ? 'onlyArea' : '' }}">
                                                                    <span>
                                                                        <i class="fas fa-chart-area"></i>
                                                                        <span>
                                                                            {{ $propx->getSqm() }}
                                                                        </span>
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

                        <div id="lifestyle" class="scrollingDiv">
                            <h2>Life Style</h2>
                            <p> {!! $cityGuideContent->lifestyle ??'' !!} </p>
                        </div>

                        <div id="thingsToConsider" class="scrollingDiv">
                            <h2>Things To Consider</h2>
                            <p> {!! $cityGuideContent->things_to_consider ??'' !!} </p>
                        </div>

                        <div id="locations" class="scrollingDiv">
                            <h2>Locations</h2>
                            <p> {!! $cityGuideContent->locations ??'' !!} </p>
                        </div>

                        <div id="attributes" class="scrollingDiv">
                            <h2>Attributes</h2>
                            <p> {!! $cityGuideContent->attributes ??'' !!} </p>
                        </div>

                        <div id="finishingScroll"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="pt-30 v2 mb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 mr-auto ml-auto">
                    <a href="{{url('properties').$url}}" class="btn btn-block v3">
                        Properties in {{$cityGuide->name}}
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="section-title v1"><h2>Around The Block</h2></div>

            <h5 class="mt-35 w-100 mb-0 d-inline-block">{{$cityGuide->name}}:</h5>
            {{$cityGuide->long_description}}

            @if(count($cityGuideDetails) > 0)
                @foreach($cityGuideDetails as $i => $cityGuideDetail)
                    <h5 class="mt-35 w-100 mb-0 d-inline-block">{{($i+1)}}:- {{$cityGuideDetail->title}}</h5>
                    <p>{{$cityGuideDetail->long_description}}</p>
                    <div class="row mb-4">
                        <div class="col-md-6 text-center mt-4">
                            <img src="{{asset('upload/cities/'.$cityGuideDetail->image1)}}"
                                alt="{{$cityGuide->name}}" class="guide img-fluid">
                        </div>
                        <div class="col-md-6 text-center mt-4">
                            <img src="{{asset('upload/cities/'.$cityGuideDetail->image2)}}"
                                alt="{{$cityGuide->name}}" class="guide img-fluid">
                        </div>
                        <div class="col-md-6 text-center mt-4">
                            <img src="{{asset('upload/cities/'.$cityGuideDetail->image3)}}"
                                alt="{{$cityGuide->name}}" class="guide img-fluid">
                        </div>
                        <div class="col-md-6 text-center mt-4">
                            <img src="{{asset('upload/cities/'.$cityGuideDetail->image4)}}"
                                alt="{{$cityGuide->name}}" class="guide img-fluid">
                        </div>
                    </div>
                @endforeach
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

    <script>

        let old = 0;
        function toScroll(id){
            document.getElementById(id).scrollIntoView();
            document.getElementById(id).style.paddingTop = '110px';
            old = $(this).scrollTop();
        }

        // to add color image and active link
        function addClass(item){
            $( `.${item}` ).last().addClass( "selectedLi" );
            $( `.${item}Div` ).css({
                'background':'url(/assets/images/cityGuide/'+item+'Color.png) no-repeat 50% 50%',
                'background-size' : 'auto 100%',
                'height': '30px',
            });
        }

        // to remove color image and active link
        function removeClass(item){
            $( `.${item}` ).last().removeClass( "selectedLi" );
            $( `.${item}Div` ).css({
                'background':'url(/assets/images/cityGuide/'+item+'.png) no-repeat 50% 50%',
                'background-size' : 'auto 100%',
                'height': '30px',
            });
        }

        $(window).scroll(function () {
            var windowScrollingValue = $(this).scrollTop();
            var propertyTrendsValue = $('#propertyTrends').offset();
            var neighborhoodValue = $('#neighborhood').offset();
            var lifestyleValue = $('#lifestyle').offset();
            var locationsValue = $('#locations').offset();
            var thingsToConsiderValue = $('#thingsToConsider').offset();
            var attributesValue = $('#attributes').offset();
            var finishingScrollValue = $('#finishingScroll').offset();


            if (windowScrollingValue >= (propertyTrendsValue.top - 110)
                && windowScrollingValue < neighborhoodValue.top - 110) {

                    addClass('propertyTrends');
                    removeClass('neighborhood');
                    removeClass('lifestyle');
                    removeClass('locations');
                    removeClass('thingsToConsider');
                    removeClass('attributes');
                    
            }
            else if (windowScrollingValue >= (neighborhoodValue.top - 110)
                && windowScrollingValue < lifestyleValue.top - 110) {
                    
                    addClass('neighborhood');
                    removeClass('propertyTrends');
                    removeClass('lifestyle');
                    removeClass('locations');
                    removeClass('thingsToConsider');
                    removeClass('attributes');

            }else if (windowScrollingValue >= (lifestyleValue.top - 110)
                && windowScrollingValue < thingsToConsiderValue.top - 110) {
                    
                    addClass('lifestyle');
                    removeClass('neighborhood');
                    removeClass('propertyTrends');
                    removeClass('locations');
                    removeClass('thingsToConsider');
                    removeClass('attributes');

            }else if (windowScrollingValue >= (thingsToConsiderValue.top - 110)
                && windowScrollingValue < locationsValue.top - 110) {

                    addClass('thingsToConsider');
                    removeClass('locations');
                    removeClass('lifestyle');
                    removeClass('neighborhood');
                    removeClass('propertyTrends');
                    removeClass('attributes');

            }else if (windowScrollingValue >= (locationsValue.top - 110)
                && windowScrollingValue < attributesValue.top - 110) {

                    addClass('locations');
                    removeClass('neighborhood');
                    removeClass('lifestyle');
                    removeClass('thingsToConsider');
                    removeClass('propertyTrends');
                    removeClass('attributes');

            }else if (windowScrollingValue >= (attributesValue.top - 110)
                && windowScrollingValue < finishingScrollValue.top - 110) {

                    addClass('attributes');
                    removeClass('neighborhood');
                    removeClass('lifestyle');
                    removeClass('thingsToConsider');
                    removeClass('propertyTrends');
                    removeClass('locations');

            }else{

                    removeClass('neighborhood');
                    removeClass('attributes');
                    removeClass('lifestyle');
                    removeClass('thingsToConsider');
                    removeClass('propertyTrends');
                    removeClass('locations');
            }

            var nav = $('#city-guide-container');
            if ($(this).scrollTop() > 1000) {
                nav.addClass("f-nav");
                nav.removeClass("d-none");
            } else {
                nav.addClass("d-none");
                nav.removeClass("f-nav");
            }
        });

        $(".slider").owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
        });


    </script>
@endsection

