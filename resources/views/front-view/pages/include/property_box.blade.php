<a class="single-property-box" href="{{ route('property-detail', [strtolower($property->property_purpose), $property->property_slug, $property->id]) }}">

    <div class="property-item">
        <div class="property-img">
            @if ($property->featured_image)
                <img src="{{ URL::asset('upload/properties/thumb_' . $property->featured_image) }}" alt="Featured Image of Property">
            @else
                <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}" alt="Image of Property if no Featured Image found">
            @endif
        </div>

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

        <div class="property-author-wrap">
            <div class="property-author">
                <span> {{ $property->getPrice() }}
                    @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                        / Month
                    @endif
                </span>
            </div>
        </div>

    </div>

    <div class="property-title-box" onclick="window.location='{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}';" style="cursor: pointer;">

        <h2 class="property-card__property-title">
            {{ $property->property_name }}
        </h2>
        
        <ul class="property-feature">
            <li class="pe-2">
                <span>{{ Str::limit($property->propertiesTypes->types, 36) }}</span>
            </li>
            @if ($property->getProperty_type())
                <li>
                    <i class="fas fa-bed"></i>
                    <span>
                        {{ $property->bedrooms }}
                    </span>
                </li>
                <li>
                    <i class="fas fa-bath"></i>
                    <span>
                        {{ $property->bathrooms }}
                    </span>
                </li>
            @endif

            <li>
                <span>
                    <i class="fas fa-chart-area"></i>
                    <span>
                        {{ $property->getSqm() }}
                    </span>
                </span>
            </li>
        </ul>

        <div class="property-location mt-2">
            <i class="fa fa-map-marker-alt"></i>
            <p>{{ Str::limit($property->address, 36) }}</p>
      </div>
    </div>
</a>
