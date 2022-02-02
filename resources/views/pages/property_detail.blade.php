@extends("front.layouts.main")

@section('content')
    <style>
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
        @media only screen and (max-width: 767px){
            .swiper-slide img{
                height: 250px;
            }

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
    </style>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <div class="single-property-details v1 mt-100">


        <div class="container desktop_detail">
            <div class="row">
                <div class="col-md-12 col-12">
                    
                    @if(count($property->gallery) > 0)
                    <div class="row">
                        <div class="col-md-8 p-1">
                            <div class="list-details-section mb-1">
                                <div class="featured_image" style="position: relative">
                                    <img src="{{asset('upload/properties/'.$property->featured_image)}}"
                                         alt="{{$property->property_name}}" width="100%" style="object-fit: cover; height: 553px">
                                    <div class="gallery_btn"><a href="javascript:void(0)"
                                                                class="gallery-link btn btn-sm btn-primary">View
                                            Gallery</a>
                                        <div class="gallery">
                                           
                                            @if(count($property->gallery)>0)
                                                @foreach($property->gallery as $gallery)
                                                    <a href="{{URL::asset('upload/gallery/'.$gallery->image_name)}}"></a>
                                                @endforeach
                                            @endif
                                        </div>
                                        <a class="googleMapPopUp btn btn-sm btn-info" rel="nofollow"
                                           href="https://maps.google.com.au/maps?q='+{{$property->address}}+'"
                                           target="_blank">View Map </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-1">
                            <div class="list-details-section mb-1">
                                <img src="{{URL::asset('upload/gallery/'.$property->gallery[1]->image_name)}}"
                                     alt="{{$property->property_name}}" width="100%" style="object-fit: cover;height: 275px">
                            </div>
                            <div class="list-details-section mb-1">
                                <img src="{{URL::asset('upload/gallery/'.$property->gallery[2]->image_name)}}"
                                     alt="{{$property->property_name}}" width="100%" style="object-fit: cover;height: 275px">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-xl-8 col-lg-12 pl-0">
                    <div class="list-details-wrap">

                        <h5 class="address"><a href="https://maps.google.com.au/maps?q='+{{$property->address}}+'"
                                               target="_blank"><i class="fa fa-map-marker"></i> {{$property->address}}</a></h5>
                        <h1 class="text text--size6 text--bold property-page__title" style="font-family: Open Sans,sans-serif;;">{{$property->property_name}}</h1>
                        <ul class="listing-address">
                            <li>
                                <div class="row">

                                    <div class="col-6">
                                        <span><i class="fas fa-building pr-1"></i> Property Type :</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="type">{{$property->propertiesTypes->types}}</span>
                                    </div>
                                </div>
                               </li>
                            <li>
                                <div class="row">

                                    <div class="col-6">
                                        <span><i class="fas fa-chart-area pr-1"></i> Property Size: </span>
                                    </div>

                                    <div class="col-6">
                                        <span class="type">{{$property->land_area}}</span>
                                    </div>
                                </div></li>
                            <li>
                                <div class="row">

                                    <div class="col-6">
                                        <span> <i class="fas fa-bed pr-1"></i>  Bedrooms :</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="type">{{$property->bedrooms}}</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">

                                    <div class="col-6"><span><i class="fas fa-bath pr-1"></i> Bathrooms :</span></div>
                                    <div class="col-6"><span class="type">{{$property->bathrooms}}</span></div>
                                </div></li>
                            <li> <div class="row">

                                    <div class="col-6"><span><i class="fa fa-tasks" aria-hidden="true"></i> Completion: </span></div>
                                    <div class="col-6"> <span class="type">Ready</span></div></div></li>

                        </ul>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Location</h3>
                                <div class="d-flex">
                                    <img src="{{asset('assets/images/c70d76248e.map.svg')}}" alt="Map"
                                         class="property-location__image">
                                    <div class="map_btn">
                                        <a href="https://maps.google.com.au/maps?q='+{{$property->address}}+'"
                                           target="_blank" class="btn btn-sm btn-info">View</a>
                                    </div>
                                    <p>{{$property->address}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Agent</h3>                                
                                <div class="d-flex">
                                @if(!empty($agency->image))
                                    <img src="{{asset('upload/agencies/'.$agency->image)}}" alt="Map"
                                         class="property-location__image">
                                @endif         
                                    <div class="d-md-block">
                                    @if(!empty($agency->name))
                                        <h5>{{$agency->name}}</h5>                                        
                                        @if(!empty($agency->email)) 
                                            <a href="mailto:{{$agency->email}}">{{$agency->email}}</a>
                                        @endif
                                        @if(!empty($agency->phone)) 
                                            <a href="tel:{{$agency->phone}}"> {{$agency->phone}}</a>
                                        @endif
                                        <a href="#"> ({{count(App\Properties::where('agency_id',$agency->id)->get())}}
                                            properties)</a>
                                    @else
                                     Agent not found        
                                    @endif        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="list-details-wrap mt-20 mb-50">
                        <h3>Description</h3>
                        <div class="panel-wrapper">
                            <a href="#desshow" class="show" id="desshow"><i class="fas fa-angle-down"></i> Read More</a>
                            <a href="#deshide" class="hide" id="deshide"><i class="fas fa-angle-up"></i> Read less</a>

                            <div class="panel">
                                {{$property->description}}
                            </div>
                            <div class="cus_fade"></div>
                        </div>
                        <hr>
                        @if($property->property_features)
                            <div class="row p-2">
                                <div class="col-md-12">
                                    <h3 class="text-left mt-2">Amenities</h3>
                                    <ul class="aminities">
                                        @foreach(explode(',',$property->property_features) as $features)
                                            <li>
                                                <strong> <i class="fas fa-check-circle pr-1"></i> </strong>{{\App\PropertyAmenity::getAmmienties($features)}}
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <hr>
                    <div class="list-details-wrap">
                        <h3>Like this property? Come back to it later, easily.</h3>
                        <a href="http://www.facebook.com/sharer.php?u={{ url('property/'.$property->property_slug.'/'.$property->id) }}"
                           target="_blank" class="btn btn-outline-dark">
                            <img src="https://simplesharebuttons.com/images/somacro/facebook.png" class="social"
                                 alt="Facebook"/> Facebook
                        </a>
                        <!-- LinkedIn -->
                        <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ url('property/'.$property->property_slug.'/'.$property->id) }}"
                           target="_blank" class="btn btn-outline-dark">
                            <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" class="social"
                                 alt="LinkedIn"/> LinkedIn
                        </a>
                        <!-- Twitter -->
                        <a href="https://twitter.com/share?url={{ url('property/'.$property->property_slug.'/'.$property->id) }}"
                           target="_blank" class="btn btn-outline-dark">
                            <img src="https://simplesharebuttons.com/images/somacro/twitter.png" class="social"
                                 alt="Twitter"/>Twitter
                        </a>


                    </div>
                    <div class="similar-listing-wrap mt-30 pb-70">
                        <div class="container">
                            <div class="col-md-12 px-0">
                                <div class="similar-listing">
                                    <div class="section-title v2">
                                        <h3>More Properties in the Same Area</h3>
                                    </div>
                                    <div class="swiper-container related-homes-slider">
                                        <div class="swiper-wrapper">
                                            @if(count($properties)>0)
                                                @foreach($properties as $property)
                                                    <div class="swiper-slide">
                                                        <div class="single-property-box">
                                                            <div class="property-item">
                                                                <a class="property-img"
                                                                   href="{{ url('property/'.$property->property_slug.'/'.$property->id) }}">
                                                                    @if($property->featured_image)
                                                                        <img
                                                                            src="{{ URL::asset('upload/properties/'.$property->featured_image) }}"
                                                                            alt="Image of Property">
                                                                    @else
                                                                        <img
                                                                            src="{{ URL::asset('assets/images/icon-no-image.svg') }}"
                                                                            alt="Image of Property">
                                                                    @endif
                                                                </a>
                                                                <ul class="feature_text">
                                                                    @if($property->featured_property==1)
                                                                        <li class="feature_cb"><span> Featured</span>
                                                                        </li>@endif
                                                                    @if($property->property_purpose==trans('words.purpose_sale'))
                                                                        <li class="feature_or"><span>For Sale</span>
                                                                        </li>
                                                                    @endif
                                                                    @if($property->property_purpose==trans('words.purpose_rent'))
                                                                        <li class="feature_or"><span>For Rent</span>
                                                                        </li>
                                                                    @endif
                                                                    <li class="feature_or"><span>For Rent</span></li>
                                                                </ul>
                                                                <div class="property-author-wrap">
                                                                    <div class="property-author">
                                                                        <span>  {{number_format($property->price)}} QAR {{$property->property_purpose=='For Rent'?'/ month':''}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="property-title-box">
                                                                <h2 class="property-card__property-title">
                                                                    {{ \Illuminate\Support\Str::limit($property->property_name, 20) }}   
                                                                </h2>
                                                                <div class="property-location">
                                                                    {{ $property->propertiesTypes->types }}
                                                                    <br>
                                                                    {{ \Illuminate\Support\Str::limit($property->address, 30) }}
                                                                </div>

                                                                <ul class="property-feature">
                                                                    <li><i class="fas fa-bed"></i><span>{{$property->bedrooms}} </span>
                                                                    </li>
                                                                    <li><i class="fas fa-bath"></i><span>{{$property->bathrooms}}  </span>
                                                                    </li>
                                                                    <li><i class="fas fa-chart-area"></i><span>{{$property->land_area}}  sqft</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                   
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-1">
                    <div class="desk card sticky" tabindex="1">
                        <div class="card-body">
                            <h2><strong>  {{number_format($property->price)}} QAR {{$property->property_purpose=='For Rent'?'/ monthly':''}}</strong></h2>
                            @if(!empty($agency->phone))
                            <div class="callgroup">
                                <a href="tel:{{$agency->phone}}" class="btn btn-danger"><i class="fas fa-phone-alt"></i>
                                    Call Now</a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-envelope-square"></i> Email Now</a>
                            </div>
                            @endif
                        </div>
                        <div class="mt-2 pl-20 pr-20">

                            <a href="#">
                                <img src="{{asset('assets/images/ad.gif')}}" alt="??" width="100%">
                            </a>

                        </div>
                    </div>


                </div>

            </div>
        </div>
        <div class="mobile_detail">
        {{dd($property)}}
            <div class="col-sm-12 p-0">

                <div class="swiper-container gallery">
                    <div class="swiper-wrapper">
                        @if(count($property->gallery)>0)
                            @foreach($property->gallery as $gallery)
                                <div class="swiper-slide">
                                    <img src="{{URL::asset('upload/gallery/'.$gallery->image_name)}}"
                                         alt="{{$property->property_name}}" width="100%" height="200px">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>

                <h4 class="text-center mob_price">{{number_format($property->price)}} QAR{{$property->property_purpose=='For Rent'?'/Month':''}}</h4>

                <div class="mobile card" id="mobsticky">
                    <div class="card-body p-2">
                        @if($agency)
                        <div class="callgroup">
                            @if($agency->phone)
                            <a href="tel:{{$agency->phone}}" class="btn btn-danger"><i class="fas fa-phone-alt"></i>
                                Call Now</a>
                            @endif
                            @if($agency->email)    
                            <a href="mailto:{{$agency->email}}" class="btn btn-danger"><i
                                    class="fas fa-envelope-square"></i> Email Now</a>
                            @endif
                            @if($agency->whatsapp)        
                            <a href="//api.whatsapp.com/send?phone={{$agency->whatsapp}}" class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="container">

                <div class="row p-2">
                    <div class="col-md-12">
                        <h4 class="text-center">{{$property->property_name}}</h4>
                        <ul class="property_loc">
                            <li>
                             <div class="row d-flex">

                                 <div class="col-6">
                                      <i class="fas fa-building pr-1"></i>Property Type:
                                 </div>

                                 <div class="col-6 p-0">
                                     <span  class="type">{{$property->propertiesTypes->types}}</span>
                                 </div>
                             </div>
                               </li>
                            <li>
                                <div class="row d-flex">


                                    <div class="col-6">
                                          <i class="fas fa-chart-area pr-1"></i>Property Size:
                                    </div>

                                    <div class="col-6 p-0">
                                        <span class="type">{{$property->land_area}}</span>
                                    </div>
                                </div>
                           </li>
                            <li>
                                <div class="row d-flex">


                                    <div class="col-6">
                                         <i class="fas fa-house-damage pr-1"></i>Bedrooms:
                                    </div>

                                    <div class="col-6 p-0">
                                        <span class="type">{{$property->bedrooms}}</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row d-flex">


                                    <div class="col-6">
                                        <i class="fas fa-shower pr-1"></i>Bathrooms:
                                    </div>

                                    <div class="col-6 p-0">
                                        <span class="type">{{$property->bathrooms}}</span>
                                    </div>
                                </div>
                            </li>
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

                        </ul>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-8 col-8">
                        <div class="wrapper">
                            <h5 class="add">Location</h5>
                            <p> {{$property->address}}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-4">
                        <div class="d-flex">
                            <img src="{{asset('assets/images/c70d76248e.map.svg')}}" alt="Map"
                                 class="property-location__image">
                            <div class="map_btn">
                                <a href="https://maps.google.com.au/maps?q='+{{$property->address}}+'"
                                   target="_blank" class="btn btn-sm btn-info">View</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-2">
                @if($agency)
                    <div class="col-md-8 col-8">
                        
                        <div class="wrapper">
                            <h5 class="add">Agent</h5>
                            <p> {{$agency->name}}</p>
                            <a href="mailto:{{$agency->email}}">{{$agency->email}}</a>
                            <a href="tel:{{$agency->phone}}"> {{$agency->phone}}</a>
                            <a href="#"> ({{count(App\Properties::where('agency_id',$agency->id)->get())}}
                                properties)</a>
                        </div>

                    </div>
                    <div class="col-md-4 col-4">
                        <div class="d-flex">
                            <img src="{{asset('upload/agencies/'.$agency->image)}}" alt="Map"
                                 class="property-location__image">

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="call_to_agent">
                            <a class="btn btn-outline-dark " href="tel:+97144090980">Call Agent</a>
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
                                {{$property->description}}
                            </div>
                            <div class="cus_fade"></div>
                        </div><!-- end panel-wrapper -->
                    </div>
                </div>
                @if($property->property_features)
                    <div class="row p-2">
                        <div class="col-md-12">
                            <h3 class="text-left mt-2">Amenities</h3>
                            <ul class="aminities">
                                @foreach(explode(',',$property->property_features) as $features)
                                    <li>
                                        <strong> <i class="fas fa-check-circle pr-1"></i> {{\App\PropertyAmenity::getAmmienties($features)}}</strong>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                @endif
            </div>

            <div class="similar-listing-wrap mt-30 pb-30">
                <div class="container">
                    <div class="col-md-12 px-0">
                        <div class="similar-listing">
                            <div class="section-title v2">
                                <h3>More available in the same area</h3>
                            </div>
                            <div class="swiper-container related-homes-slider">
                                <div class="swiper-wrapper">
                                    @if(count($properties)>0)
                                        @foreach($properties as $property)
                                            <div class="swiper-slide">
                                                <div class="single-property-box">
                                                    <div class="property-item">
                                                        <a class="property-img"
                                                           href="{{ url('property/'.$property->property_slug.'/'.$property->id) }}">
                                                            @if($property->featured_image)
                                                                <img
                                                                    src="{{ URL::asset('upload/properties/'.$property->featured_image) }}"
                                                                    alt="Image of Property">
                                                            @else
                                                                <img
                                                                    src="{{ URL::asset('assets/images/icon-no-image.svg') }}"
                                                                    alt="Image of Property">
                                                            @endif
                                                        </a>
                                                        <ul class="feature_text">
                                                            @if($property->featured_property==1)
                                                                <li class="feature_cb"><span> Featured</span>
                                                                </li>@endif
                                                            @if($property->property_purpose==trans('words.purpose_sale'))
                                                                <li class="feature_or"><span>For Sale</span>
                                                                </li>
                                                            @endif
                                                            @if($property->property_purpose==trans('words.purpose_rent'))
                                                                <li class="feature_or"><span>For Rent</span>
                                                                </li>
                                                            @endif
                                                            <li class="feature_or"><span>For Rent</span></li>
                                                        </ul>
                                                        <div class="property-author-wrap">
                                                            <div class="property-author">
                                                                <span>  {{number_format($property->price)}} QAR {{$property->property_purpose=='For Rent'?'/ month':''}}</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="property-title-box">
                                                        <h2 class="property-card__property-title">
                                                            {{ \Illuminate\Support\Str::limit($property->property_name, 20) }}
                                                        </h2>
                                                        <div class="property-location">
                                                            {{ $property->propertiesTypes->types }}
                                                            <br>
                                                            {{ \Illuminate\Support\Str::limit($property->address, 30) }}
                                                        </div>

                                                        <ul class="property-feature">
                                                            <li><i class="fas fa-bed"></i><span>{{$property->bedrooms}}</span>
                                                            </li>
                                                            <li><i class="fas fa-bath"></i><span>{{$property->bathrooms}}</span>
                                                            </li>
                                                            <li><i class="fas fa-chart-area"></i><span>{{$property->land_area}} sqft</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="card mt-2">

                            <a href="#">
                                <img src="{{asset('assets/images/ad.gif')}}"  alt="?:?" width="100%">
                            </a>

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


    <script type="text/javascript">

        // Toggle Sidebar Agent Widget
        $('.sidebar-widget-toggler > button').on('click', function () {
            $('.sidebar-agent-widget').fadeIn(300)
        })
        $('.close-agent-widget').on('click', function () {
            $('.sidebar-agent-widget').fadeOut(300)
        })
        var swiper = new Swiper('.swiper-container.gallery', {
            spaceBetween: 20,

            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                loop:true,
                dynamicBullets: true,
                dynamicMainBullets: 1,
            },
            
        });
        var similar_property = new Swiper('.related-homes-slider', {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            dots: false,
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


        $('.gallery-link').on('click', function () {
            $(this).next().magnificPopup('open');
        });

        $('.gallery').each(function () {
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
        window.onscroll = function () {
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
