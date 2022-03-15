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
saakin.com

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
                                    {{ $saleProperties->links('front.pages.include.pagination') }}
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