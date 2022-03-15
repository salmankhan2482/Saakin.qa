<a class="single-property-box" href="{{ route('property-detail', [strtolower($property->property_purpose), $property->property_slug, $property->id]) }}" {{-- onclick="window.location='{{ route('property-detail', [strtolower($property->property_purpose), $property->property_slug, $property->id]) }}';" --}}>

  <div class="property-item">
    @if ($property->featured_image)
      <img src="{{ URL::asset('upload/properties/thumb_' . $property->featured_image) }}" alt="Featured Image of Property">
    @else
      <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}" alt="Image of Property if no Featured Image found">
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

  {{-- for slider need small images. --}}
  {{-- <div class="property-slider">
		@if (count($property->gallery) > 0)
		<div class="property-slide">
			<img src="{{ asset('upload/properties/thumb_' . $property->featured_image) }}" alt="{{$property->property_name}}">
		</div>
		@foreach ($property->gallery as $gallery)
		@if ($loop->index < 2) <div class="property-slide">
			<img src="{{ asset('upload/gallery/') . '/' . $gallery->image_name }}" alt="{{$property->property_name}}">
	</div>
	@endif
	@endforeach
	@endif

	</div> --}}

  <div class="property-title-box">

    <h2 class="property-card__property-title">
      {{-- {{ \Illuminate\Support\Str::limit($property->property_name, 20) }} --}}
      {{ $property->property_name }}
    </h2>

    <div class="property-location">
      <p> {{ Str::limit($property->propertiesTypes->types, 36) }}</p>
    </div>

    <div class="property-location">
      <i class="fa fa-map-marker-alt"></i>
      <p> {{ Str::limit($property->address, 36) }}</p>
    </div>
    <ul class="property-feature">
      @if ($property->getProperty_type())
        <li class="liDesk">
          <i class="fas fa-bed"></i>
          <span>
            {{ $property->bedrooms }}
          </span>
        </li>
        <li class="liDesk">
          <i class="fas fa-bath"></i>
          <span>
            {{ $property->bathrooms }}
          </span>
        </li>
      @endif

      <li class="liDeskArea">
        <span class="liDeskAreaSpan">
          <i class="fas fa-chart-area"></i>
          <span>
            {{ $property->getSqm() }}
          </span>
        </span>
      </li>
    </ul>
  </div>
</a>