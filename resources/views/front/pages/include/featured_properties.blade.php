<style>
    @media (max-width: 767px){
        .desktopFeaturesPropsLis{
            display: none;
        }

        .trending-places{
            padding-top: 10px !important;
        }
        .text-justify{
            padding-bottom: 10px !important;
        }
    }
    @media only screen and (min-width: 800px) {
        
        .liDeskAreaSpan{
            float: left;
            margin-left: 15px;
        }

        .property-feature .liDesk{
            margin-left: -15px;
        }
    }   
</style>

<div class="trending-places pb-50 bg-light pt-50">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h2>Featured Properties</h2>
                    <p class="text-justify">Saakin is the fastest growing Qatar Real Estate Directory you can find Properties for Rent in Qatar. For apartments on rent real estate agents in Qatar bring you the best apartments in Doha,
                        <span id="dots">...</span>
                        <span id="more"> 
                            The Pearl, West Bay, and properties from all over the country thourgh Qatar property
                            directory.
                        </span>
                        <button onclick="myFunction()"  class="myBtn btn btn-sm btn-info-outline">Read more</button></p>
                </div>
            </div>
            <!-- Add Arrows -->
            <div class="container desktopFeaturesPropsLis">
                <div class="tab-pane fade show active property-grid" id="grid-view">
                    <div class="row row-10-padding">
                        @foreach ($featured_properties as $property)
                            <div class="col-md-6 col-lg-4 col-sm-12">
                                @include('front.pages.include.property_box')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card-list featured_mobile">
                    <div class="card-list__item">
                        <div class="property-card__section">
                            @if (count($featured_properties) > 0)

                            @foreach ($featured_properties as $property)

                                    <div class="property-card">
                                        <div class="property-card__image">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">
                                                    @if (count($property->gallery) > 0)
                                                        <div class="swiper-slide">
                                                            <img src="{{ asset('upload/properties/thumb_' . $property->featured_image) }}" 
                                                            alt="{{$property->property_name}}">
                                                        </div>
                                                        @foreach ($property->gallery as $gallery)
                                                            @if($loop->index < 2)
                                                            <div class="swiper-slide">
                                                                <img src="{{ asset('upload/gallery/') . '/' . $gallery->image_name }}" 
                                                                alt="{{$property->property_name}}">
                                                            </div>
                                                            @endif
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
                                                    <a class="property-card__title-link" href="javascript:;">
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
        </div>
        <div class="row mt-5">

            <div class="col-md-3 text-center mt-2 ml-auto mr-auto">
                <a href="{{ route('featured-properties') }}" class="btn v3">See All Featured Properties</a>
            </div>
        </div>
    </div>

</div>



<script src="{{asset('assets/js/swiper.js')}}"></script>
<script src="{{asset('assets/js/Jquery.min.js')}}"></script>
        
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/carousel.autoplay.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/carousel.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.controls.umd.js"></script>
<script>

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



