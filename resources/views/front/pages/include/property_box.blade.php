<div class="single-property-box @if ((new \Jenssegers\Agent\Agent())->isMobile()) horizontal-view @endif">
    @php
        $phone = \App\Properties::getPhoneNumber($property->id);
        $whatsapp = \App\Properties::getWhatsapp($property->id);
        $agency = \App\Agency::where('id', $property->agency_id)->first();
        $propertyUrl = url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id);
        $whatsapText = 'Hello, I would like to inquire about this property posted on saakin.com Reference: ' . $property->refference_code . 'Price: QR' . $property->getPrice() . '/month Type: ' . $property->propertiesTypes->types . ' Location: ' . $property->address . ' Link:' . $propertyUrl;
    @endphp
    <div class="property-item">

        @if ((new \Jenssegers\Agent\Agent())->isMobile())
            <div class="pro-slider">
                <div class="pro-slider-item property-img">
                    <img src="{{ asset('upload/properties/thumb_' . $property->featured_image) }}"
                    width="124" height="160" alt="{{ $property->property_name }}">
                </div>

                @if (count($property->gallery) > 0)
                    @foreach ($property->gallery as $gallery)
                        @if ($loop->index < 5)
                            <div class="pro-slider-item  property-img">
                                <img src="{{ asset('upload/gallery/') . '/' . $gallery->image_name }}"
                                width="124" height="160" alt="{{ $property->property_name }}">
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        @else
            <div class="property-img">
                @if ($property->featured_image)
                    <img src="{{ URL::asset('upload/properties/thumb_' . $property->featured_image) }}"
                       width="416" height="250" alt="Featured Image of Property">
                @else
                    <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}"
                        alt="Image of Property if no Featured Image found">
                @endif
            </div>

            <div class="property-author-wrap">
                <div class="property-author">
                    <span> {{ $property->getPrice() }}
                        @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                            / Month
                        @endif
                    </span>
                </div>
            </div>

        @endif

        <ul class="feature_text">
            @if ($property->featured_property == 1)
                <li class="feature_cb">
                    <span>
                        Featured
                    </span>
                </li>
            @endif
            <li class="feature_or">
                <span>
                    For {{ $property->property_purpose }}
                </span>
            </li>
        </ul>

    </div>

    <div class="property-title-box">

        @if ((new \Jenssegers\Agent\Agent())->isMobile())
            <div class="price">
                {{ $property->getPrice() }}

                @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                    / Month
                @endif
            </div>

        @endif

        <a class="text-decoration-none"
            href="{{ route('property-detail', [strtolower($property->property_purpose), $property->property_slug, $property->id]) }}">
            <h5 class="property-card__property-title">
                {{ $property->property_name }}
            </h5>
        </a>
        <p class="mb-0">
            {{ $property->propertiesTypes->types }}
        </p>
        <ul class="property-feature">
            @if ($property->bedrooms > 0)
                <li> <i class="fas fa-bed"></i>
                    <span>{{ $property->bedrooms }}</span>
                </li>
            @endif

            @if ($property->bathrooms > 0)
                <li> <i class="fas fa-bath"></i>
                    <span>{{ $property->bathrooms }}</span>
                </li>
            @endif

            <li> <i class="fas fa-chart-area"></i>
                <span>{{ $property->getSqm() }}</span>
            </li>
        </ul>

        <div class="property-location">
            <i class="fa fa-map-marker-alt"></i>
            <p class="hideAddress"> {{ $property->address }} </p>
        </div>

        @if ((new \Jenssegers\Agent\Agent())->isMobile())

            <div class="social-div mt-md-2 d-flex">
                @if (!empty($property->whatsapp))
                    <a href="tel:{{ $property->whatsapp }}" class="btn btn-monochrome btn-sm mt-1 me-1 btnCount"
                        data-telNumber="{{ $property->whatsapp }}" data-property_id={{ $property->id }}
                        data-agency_id={{ $property->agency_id }} data-button_name='Call'>

                        <i class="fas fa-phone-alt text-primary"></i>
                        <span class="d-md-inline-block">Call</span>
                    </a>
                @else
                    <a href="tel:{{ $agency->phone }}" class="btn btn-monochrome btn-sm mt-1 me-1 btnCount"
                        data-telNumber="{{ $property->Agency->phone }}" data-property_id={{ $property->id }}
                        data-agency_id={{ $property->agency_id }} data-button_name='Call'>

                        <i class="fas fa-phone-alt text-primary"></i>
                        <span class="d-md-inline-block">Call</span>
                    </a>
                @endif

                @if (!empty($property->whatsapp))
                    <a href="//api.whatsapp.com/send?phone={{ $property->whatsapp }}&text={{ urlencode($whatsapText) }}"
                        class="btn btn-monochrome btn-sm mt-1 btnCount me-1" data-property_id={{ $property->id }}
                        data-agency_id={{ $property->agency_id }} data-button_name='WhatsApp'>

                        <i class="fab fa-whatsapp text-primary"></i>
                        <span class=" d-md-inline-block">WhatsApp</span>
                    </a>
                @elseif(!empty($property->Agency->whatsapp))
                    <a href="//api.whatsapp.com/send?phone={{ $property->Agency->whatsapp }}&text={{ urlencode($whatsapText) }}"
                        class="btn btn-monochrome btn-sm mt-1 btnCount" data-property_id={{ $property->id }}
                        data-agency_id={{ $property->agency_id }} data-button_name='WhatsApp'>

                        <i class="fab fa-whatsapp text-primary"></i>
                        <span class=" d-md-inline-block">WhatsApp</span>
                    </a>
                @else
                    <button class="btn btn-monochrome btn-sm mt-1 btnCount" data-property_id={{ $property->id }}
                        data-agency_id={{ $property->agency_id }} data-button_name='Email' type="button"
                        data-bs-toggle="modal" data-bs-target="#emailAgentModal" id="emailBtn"
                        data-image="{{ asset('upload/properties/' . $property->featured_image) }}"
                        data-title="{{ $property->property_name }}"
                        data-agent="{{ $property->agent_name ?? $property->Agency->name }}"
                        data-broker="{{ $property->Agency->name ?? '' }}"
                        data-bedroom="{{ $property->bedrooms ?? '' }}"
                        data-bathroom="{{ $property->bathrooms ?? '' }}"
                        data-area="{{ $property->getSqm() ?? '' }}">
                        <i class="fas fa-envelope text-primary"></i>
                        <span class="d-md-inline-block">
                            Email
                        </span>
                    </button>
                @endif
            </div>
        @endif

    </div>
</div>
