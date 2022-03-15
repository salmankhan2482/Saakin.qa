@extends("front.layouts.main")

@if ($property->meta_title != null)
  @section('title', $property->meta_title . ' | ' . 'Saakin.com')
  @section('description', $property->meta_description ?? $property_des)
  @section('keyword', $property->meta_keyword)
  @section('type', 'property')
  @section('url', url()->current())
  @section('image', asset('upload/properties/' . $property->featured_image))
@else
  @section('title', $property->property_name . ' | ' . 'Saakin.com')
  @section('description', $property_des)
  @section('keyword', $property->meta_keyword)
  @section('type', 'property')
  @section('url', url()->current())
  @section('image', asset('upload/properties/' . $property->featured_image))
@endif
@section('content')
  @php
  $phone = \App\Properties::getPhoneNumber($property->id);
  $whatsapp = \App\Properties::getWhatsapp($property->id);
  $agency = \App\Agency::where('id', $property->agency_id)->first();
  $propertyUrl = url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id);
  $whatsapText =
      'Hello,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             I would like to inquire about this property posted on saakin.com Reference: ' .
      $property->refference_code .
      'Price: QR ' .
      $property->getPrice() .
      '/month Type: ' .
      $property->propertiesTypes->types .
      'Location: ' .
      $property->address .
      'Link:' .
      $propertyUrl;
  @endphp

  <div class="inner-content">

    <div class="container">
      <p class="text-end fs-sm">
        Properties for {{ $property->property_purpose }} in {{ $property->address }}
      </p>

      <div class="position-relative">
        <div class="gallery_btn position-absolute bottom-0 start-0 p-3" style="z-index: 1;">
          <a href="javascript:void(0)" data-fancybox-trigger="gallery" data-fancybox-index="0" class="btn btn-sm btn-primary">
            View Gallery
          </a>
          <a class="googleMapPopUp btn btn-sm btn-info" rel="nofollow" data-fancybox data-type="iframe" data-preload="false" data-width="640" data-height="480"
            href="https://maps.google.com/maps?q={{ $property->address }}&output=embed" target="_blank">View Map </a>
        </div>
        <div class="grid single-gallery">
          <div class="gallery-item">
            <a data-caption="{{ $property->property_name }}" data-fancybox="gallery" href="{{ asset('upload/properties/' . $property->featured_image) }}">
              <img src="{{ asset('upload/properties/' . $property->featured_image) }}" alt="{{ $property->property_name }}">
            </a>
          </div>
          @if (count($property_gallery_images) > 0)
            @foreach ($property_gallery_images as $gallery)
              <div class="gallery-item">
                <a data-caption="{{ $property->property_name }}" data-fancybox="gallery" href="{{ URL::asset('upload/gallery/' . $gallery->image_name) }}">
                  <img src="{{ URL::asset('upload/gallery/' . $gallery->image_name) }}" alt="{{ $property->property_name }}" />
                </a>
              </div>
            @endforeach
          @endif
        </div>
      </div>

      <div class="row gx-2">
        <div class="col-lg-8 mt-4">
          <div class="list-details-wrap">
            <h5 class="address">
              <a class="text-decoration-none" data-fancybox data-type="iframe" data-preload="false" data-width="640" data-height="480"
                href="https://maps.google.com/maps?q={{ $property->address }}&output=embed" target="_blank">
                <i class="fa fa-map-marker"></i>
                {{ $property->address }}
              </a>
            </h5>

            <h1 class="h2 mt-3 mb-4">{{ $property->property_name }}</h1>

            <div class="grid prop-type-info">
              <div><i class="fas fa-building pr-1"></i> Property Type :</div>
              <div>{{ $property->propertiesTypes->types }}</div>

              @if ($property->getProperty_type())
                @if ($property->bedrooms)
                  <div><i class="fas fa-bed pr-1"></i> Bedrooms :</div>
                  <div>{{ $property->bedrooms }}</div>
                @endif
              @endif

              <div>
                <i class="fas fa-chart-area pr-1"></i> Property Size:
              </div>
              <div>
                {{ $property->getSqm() }}
              </div>

              <div>
                <i class="far fa-edit"></i> Property Purpose :
              </div>
              <div>
                {{ $property->property_purpose }}
              </div>
              @if ($property->getProperty_type())
                @if ($property->bathrooms)
                  <div><i class="fas fa-bath pr-1"></i> Bathrooms:</span></div>
                  <div>{{ $property->bathrooms }}</div>
                @endif
              @endif
              <div><i class="fa fa-tasks" aria-hidden="true"></i>Completion:</div>
              <div>Ready</div>
            </div>

            <hr>
            <div class="row">
              <div class="col-md-6">
                <h4 class="mb-4">Location</h4>
                <div class="d-flex align-items-center">
                  <div class="me-3 position-relative rounded-img">
                    <img src="{{ asset('assets/images/70d76248e.jpg') }}" alt="Map" width="120">
                    <div class="map_btn position-absolute bottom-0  start-50 translate-middle-x pb-2">
                      <a data-fancybox data-type="iframe" data-preload="false" data-width="640" data-height="480" href="https://maps.google.com/maps?q={{ $property->address }}&output=embed"
                        class="btn btn-sm btn-info">View</a>
                    </div>
                  </div>
                  <address class="mb-0">
                    {{ $property->address }}<br><br>{{ $property->city }}
                  </address>
                </div>
              </div>

              <div class="col-md-6">
                <h4 class="mb-4">Agent</h4>
                @if (!empty($property->whatsapp) && !empty($property->agent_name))
                  <div class="grid" style="--template: 120px auto; --gap: 1rem">
                    <div class="rounded-img">
                      <!-- agent pic on desktop -->
                      @if (!empty($property->agent_picture))
                        <a class="d-block" href="{{ 'agency/' . Str::slug($agency->name, '-') . '/' . $agency->id }}">
                          <img src="{{ asset('upload/properties/' . $property->agent_picture) }}" alt="{{ $property->agent_name }}" width="120">
                        </a>
                      @else
                        <a class="d-block rounded-img" href="{{ url('agency/' . Str::slug($agency->name, '-') . '/' . $agency->id) }}">
                          <img src="{{ asset('upload/agencies/no-image.png') }}" alt="{{ $property->agent_name }}" width="120">
                        </a>
                      @endif
                    </div>

                    <div class="d-md-block">
                      <h5>{{ $property->agent_name }}</h5>
                      <div class="grid mt-3" style="--template: 50px auto; --gap: .5rem">
                        <div>
                          <a href="{{ url('agency/' . Str::slug($agency->name, '-') . '/' . $agency->id) }}">
                            <img src="{{ asset('upload/agencies/' . $agency->image) }}" class="rounded-circle" alt="{{ $property->agent_name }}" width="50">
                          </a>
                        </div>
                        <div>
                          <a class="link-dark text-decoration-none fw-bold" href="{{ url('agency/' . Str::slug($agency->name, '-') . '/' . $agency->id) }}">{{ $agency->name }}</a><br>
                          <a class="link-dark text-decoration-none fw-bold" href="{{ url('agency/' . Str::slug($agency->name, '-') . '/' . $agency->id) }}">
                            ({{ count(
                                App\Properties::where('status', '1')->where('agency_id', $agency->id)->get(),
                            ) }}
                            properties)
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  <div class="grid align-items-center" style="--template: 120px auto; --gap: 1rem">
                    @if (!empty($agency->image))
                      <div class="rounded-img">
                        <a href="{{ url('agency/' . Str::slug($agency->name, '-') . '/' . $agency->id) }}">
                          <img src="{{ asset('upload/agencies/' . $agency->image) }}" alt="{{ $agency->name }}">
                        </a>
                      </div>
                    @endif
                    <div class="d-md-block">
                      @if (!empty($agency->name))
                        <h5>
                          <a class="link-dark text-decoration-none fw-bold" href="{{ url('agency/' . Str::slug($agency->name, ' -') . '/' . $agency->id) }}">
                            {{ $agency->name }}
                          </a>
                        </h5>
                        <a class="link-dark text-decoration-none" href="{{ url('agency/' . Str::slug($agency->name, '-') . '/' . $agency->id) }}">
                          ({{ count(
                              App\Properties::where('status', '1')->where('agency_id', $agency->id)->get(),
                          ) }}
                          properties)</a>
                      @else
                        Agent not found
                      @endif
                    </div>

                  </div>
                @endif
              </div>
            </div>
          </div>
          <hr class="my-4">

          <div class="list-details-wrap mt-20">
            <h4>Description</h4>
            <div class="panel-wrapper">

              <div class="content_description pb-3 less-content" id="content_description">
                {!! nl2br(strip_tags($property->description)) !!}
              </div>

              <a class="link-dark text-decoration-none" role="button" id="read-more" onclick="readMoreReadLess('more')">
                <i class="fas fa-angle-down"></i>
                Read More
              </a>

              <a class="link-dark text-decoration-none" role="button" id="read-less" style="display: none;" onclick="readMoreReadLess('less')">
                <i class="fas fa-angle-up"></i>
                Read less
              </a>
            </div>

            <hr>
            @if ($property->property_features)
              <div class="aminities-wrap text-dark">
                <h4 class="mb-3">Amenities</h4>
                <div class="grid" style="--template: 1fr 1fr; --gap: .5rem">
                  @foreach (explode(',', $property->property_features) as $features)
                    @php
                      $ameniti = \App\PropertyAmenity::getAmmienties($features);
                    @endphp
                    @if ($ameniti)
                      <div class="fw-bold">
                        <i class="fas fa-check-circle"></i> {{ $ameniti }}
                      </div>
                    @endif
                  @endforeach

                </div>
              </div>
            @endif
          </div>
          {{-- <hr> --}}
          {{-- desktop social share links --}}
          <div class="mt-4">
            <h5 class="border-bottom pb-3 mb-3">Share This Property</h5>
            <div class="d-flex flex-wrap align-items-center spbwx12">
              <div>
                <button class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-size:1em;">
                    <path
                      d="M19.155 9.204a4.6 4.6 0 0 0 .009-6.422c-1.587-1.646-4.236-1.721-5.918-.169-.027.026-.648.663-1.689 1.734L11 4.92l-.557-.574a358.648 358.648 0 0 0-1.69-1.734c-1.681-1.552-4.33-1.477-5.917.17a4.6 4.6 0 0 0 .009 6.42l7.97 8.222.01.01a.26.26 0 0 0 .36-.01l7.97-8.221zm-6.964-7.677c2.3-2.123 5.922-2.02 8.091.23a6.07 6.07 0 0 1-.011 8.474l-7.97 8.222c-.679.701-1.812.732-2.53.07-.037-.034-.037-.034-.072-.07l-7.97-8.222a6.07 6.07 0 0 1-.011-8.474c2.169-2.25 5.792-2.353 8.09-.23.052.046.416.42 1.192 1.217.776-.798 1.14-1.17 1.191-1.217z">
                    </path>
                  </svg> Save to shortlist
                </button>
              </div>
              <div>or share</div>
              <div>
                <a href="#!" class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #4267b2;">
                    <path
                      d="M20 10.061C20 4.505 15.523 0 10 0S0 4.505 0 10.061C0 15.083 3.657 19.245 8.438 20v-7.03h-2.54V10.06h2.54V7.845c0-2.522 1.492-3.915 3.777-3.915 1.094 0 2.238.197 2.238.197v2.476h-1.26c-1.243 0-1.63.775-1.63 1.57v1.888h2.773l-.443 2.908h-2.33V20c4.78-.755 8.437-4.917 8.437-9.939">
                    </path>
                  </svg>
                  Facebook</a>
              </div>
              <div>
                <a href="#!" class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #e60019;">
                    <path
                      d="M10.008 0C4.481 0 0 4.474 0 9.992c0 4.235 2.636 7.853 6.36 9.309-.091-.79-.166-2.007.032-2.87.181-.781 1.17-4.967 1.17-4.967s-.297-.6-.297-1.48c0-1.39.807-2.426 1.812-2.426.857 0 1.269.641 1.269 1.406 0 .855-.544 2.138-.832 3.33-.239.995.502 1.81 1.483 1.81 1.779 0 3.146-1.875 3.146-4.573 0-2.393-1.721-4.062-4.184-4.062-2.85 0-4.522 2.13-4.522 4.334 0 .855.329 1.776.74 2.278.083.098.092.189.067.287-.074.313-.247.995-.28 1.135-.041.181-.149.222-.338.132-1.252-.584-2.035-2.401-2.035-3.873 0-3.15 2.29-6.045 6.615-6.045 3.468 0 6.17 2.467 6.17 5.773 0 3.446-2.175 6.217-5.19 6.217-1.013 0-1.969-.526-2.29-1.151l-.626 2.377c-.222.871-.832 1.957-1.244 2.623.94.288 1.928.444 2.966.444C15.519 20 20 15.526 20 10.008 20.016 4.474 15.535 0 10.008 0z">
                    </path>
                  </svg>
                  Pinterest</a>
              </div>
              <div>
                <a href="#!" class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #1da1f3;">
                    <path
                      d="M20 10c0 5.525-4.475 10-10 10S0 15.525 0 10 4.475 0 10 0s10 4.475 10 10zM7.843 15.79c4.373 0 6.763-4.051 6.763-7.562 0-.116 0-.231-.004-.342a5.228 5.228 0 0 0 1.187-1.377c-.423.21-.882.352-1.365.419.493-.331.868-.85 1.045-1.472a4.519 4.519 0 0 1-1.508.645c-.434-.518-1.05-.838-1.735-.838-1.312 0-2.376 1.19-2.376 2.657 0 .209.02.413.064.606-1.977-.11-3.727-1.169-4.9-2.778a2.91 2.91 0 0 0-.32 1.334c0 .92.419 1.736 1.06 2.21a2.15 2.15 0 0 1-1.075-.33v.032c0 1.29.818 2.359 1.907 2.607a2.136 2.136 0 0 1-1.074.044c.3 1.058 1.178 1.824 2.218 1.846-.813.711-1.839 1.136-2.953 1.136-.192 0-.38-.011-.566-.039a6.13 6.13 0 0 0 3.632 1.201z">
                    </path>
                  </svg>
                  Twitter</a>
              </div>
              <div>
                <a href="#!" class="btn btn-monochrome btn-sm share-btn"><svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #ef5e4e;">
                    <path
                      d="M10 20C4.477 20 0 15.523 0 10S4.477 0 10 0s10 4.477 10 10-4.477 10-10 10zm5.259-14.966A1.001 1.001 0 0 0 15 5H5c-.09 0-.176.012-.259.034l4.552 4.552a1 1 0 0 0 1.414 0l4.552-4.552zm.707.707l-4.552 4.552a2 2 0 0 1-2.828 0L4.034 5.74C4.012 5.824 4 5.911 4 6v7a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V6c0-.09-.012-.176-.034-.259z">
                    </path>
                  </svg> Email</a>
              </div>
            </div>
          </div>
          {{-- <div class="row">
            <div class="col-12">
              <div class="modal-header" style="padding: 0.5rem">
                <h5>Share This Property</h5>
              </div>
              <div class="modal-body">
                <div class="list-details-wrap text-center">
                  <a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}" target="_blank" class="col-2 btn btn-outline">
                    <img src="https://simplesharebuttons.com/images/somacro/facebook.png" class="social" alt="Facebook">
                  </a>
                  <!-- copy url -->
                  <button class="col-2 btn btn-outline popup" value="copy" style="background: none !important" onclick="copyToClipboard('copy_{{ $property->id }}')">
                    <span class="popuptext mypopup" id="copy">copied!</span>
                    <img src="{{ asset('upload/copy-icon.png') }}" class="social" alt="Copy Property URL">

                  </button>
                  <!-- Twitter -->
                  <a href="https://twitter.com/share?url={{ url()->current() }}" target="_blank" class="col-2 btn btn-outline">
                    <img src="https://simplesharebuttons.com/images/somacro/twitter.png" class="social" alt="Twitter">
                  </a>

                  <!-- WhatsApp -->
                  <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank" class="col-2 btn btn-outline">
                    <img src="{{ asset('upload/whatsapp.png') }}" class="social socialw" alt="WhatsApp">
                  </a>

                  <a href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}" target="_blank" class="col-2 btn">
                    <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" class="social" alt="Pinterest">
                  </a>

                </div>
              </div>

            </div>
          </div> --}}


        </div>

        <div class="col-lg-4 mt-4">
          <div class="desk card sticky-lg-top call-email-block" tabindex="1">
            <div class="card-body">
              <h2 class="h3">
                <strong>{{ $property->getPrice() }}
                  @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                    / Month
                  @endif
                </strong>
              </h2>

              <div class="callgroup">
                @if (!empty($property->whatsapp))
                  <a href="tel:{{ $property->whatsapp }}" class="btn btn-primary btn-call">
                    <i class="fas fa-phone-alt"></i>
                    Call Now
                  </a>
                @else
                  <a href="tel:{{ $agency->phone }}" class="btn btn-primary btn-call">
                    <i class="fas fa-phone-alt"></i>
                    Call Now
                  </a>
                @endif
                @if (!empty($property->whatsapp))
                  <a href="//api.whatsapp.com/send?phone={{ $property->whatsapp }}&text={{ urlencode($whatsapText) }}" class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                @elseif(!empty($agency->whatsapp))
                  <a href="//api.whatsapp.com/send?phone={{ $agency->whatsapp }}&text={{ urlencode($whatsapText) }}" class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                @endif
                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#exampleModal" id="emailBtn" data-image="{{ asset('upload/properties/' . $property->featured_image) }}"
                  data-title="{{ $property->property_name }}" data-agent="{{ $property->agent_name ?? $agency->name }}" data-broker="{{ $agency->name ?? '' }}"
                  data-bedroom="{{ $property->bedrooms ?? '' }}" data-bathroom="{{ $property->bathrooms ?? '' }}" data-area="{{ $property->getSqm() ?? '' }}">
                  <i class="fas fa-envelope"></i>
                  Email Now
                </button>
              </div>

              <div class="call-detail-block">
                <div class="num-btn-holder">
                  <a href="#"><i class="fas fa-phone-alt"></i>
                    {{ $property->whatsapp ?? $agency->phone }}
                  </a>

                  <a class="btn-email" id="emailBtn" data-toggle="modal" data-target="#exampleModal" data-image="{{ asset('upload/properties/' . $property->featured_image) }}"
                    data-image="{{ $property->featured_image }}" data-title="{{ $property->property_name }}" data-agent="{{ $property->agent_name ?? $agency->name }}"
                    data-broker="{{ $agency->name ?? '' }}" data-bedroom="{{ $property->bedrooms ?? '' }}" data-bathroom="{{ $property->bathrooms ?? '' }}"
                    data-area="{{ $property->getSqm() ?? '' }}">
                    <i class="fas fa-envelope"></i>
                    Email
                  </a>


                </div>
                <div class="detail-block">
                  <p>Mention the reference: <strong>{{ $property->refference_code }}</strong></p>
                </div>
              </div>

              <div class="text-center border-top pt-3 mt-3">
                <button class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-size:1em;">
                    <path
                      d="M19.155 9.204a4.6 4.6 0 0 0 .009-6.422c-1.587-1.646-4.236-1.721-5.918-.169-.027.026-.648.663-1.689 1.734L11 4.92l-.557-.574a358.648 358.648 0 0 0-1.69-1.734c-1.681-1.552-4.33-1.477-5.917.17a4.6 4.6 0 0 0 .009 6.42l7.97 8.222.01.01a.26.26 0 0 0 .36-.01l7.97-8.221zm-6.964-7.677c2.3-2.123 5.922-2.02 8.091.23a6.07 6.07 0 0 1-.011 8.474l-7.97 8.222c-.679.701-1.812.732-2.53.07-.037-.034-.037-.034-.072-.07l-7.97-8.222a6.07 6.07 0 0 1-.011-8.474c2.169-2.25 5.792-2.353 8.09-.23.052.046.416.42 1.192 1.217.776-.798 1.14-1.17 1.191-1.217z">
                    </path>
                  </svg> Save to shortlist
                </button>
              </div>
            </div>
          </div>
          <!-- desktop report this -->
          <div class="text-center mt-3">
            <a href="javascript:void(0)" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="{{ auth()->check() ? '#reportModal' : '#user-login-popup' }}">
              <i class="fas fa-flag"></i>
              Report this Property
            </a>
            @if ($message = Session::get('message'))
              <div class="alert alert-info alert-block d-flex">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
            @endif
          </div>

        </div>
      </div>

      <div class="col-lg-8 mt-4">
        @if (count($properties) > 0)
          <h3 class="mb-4">{{ $properties->count() }} More Properties in the Same Area</h3>
          <div class="pro-same-slider">
            @foreach ($properties as $propx)
              <div class="single-property-box border">
                <div class="property-item">
                  <a class="property-img" href="{{ url(strtolower($property->property_purpose) . '/' . $propx->property_slug . '/' . $propx->id) }}">
                    @if ($propx->featured_image)
                      <img src="{{ URL::asset('upload/properties/thumb_' . $propx->featured_image) }}" alt="{{ $propx->property_name }}">
                    @else
                      <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}" alt="{{ $propx->property_name }}">
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
                    {{ \Illuminate\Support\Str::limit($property->property_name) }}
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
                      <li style="width: 30% !important;">
                        <i class="fas fa-bed fas-icon"></i>
                        <span>{{ $propx->bedrooms }} </span>
                      </li>
                      <li style="width: 30% !important;">
                        <i class="fas fa-bath fas-icon"></i>
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

        @endif
      </div>
    </div>

    {{-- <div class="mobile_detail">

      <div class="col-sm-12 p-0">

        <div class="swiper-container swiper-container-gallery">
          <div class="slick-gallery">
            <div class="slide">
              <img src="{{ asset('upload/properties/' . $property->featured_image) }}" alt="{{ $property->property_name }}" width="100%">
            </div>
            @if (count($property_gallery_images) > 0)
              @foreach ($property_gallery_images as $pgi)
                <div class="slide">
                  <img src="{{ URL::asset('upload/gallery/' . $pgi->image_name) }}" alt="{{ $property->property_name }}" width="100%">
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
                    @if (!empty($property->whatsapp) or !empty($agency->phone))
                      <a href="tel:{{ $property->whatsapp ?? $agency->phone }}" class="btn btn-danger">
                        <i class="fas fa-phone-alt"></i>
                        Call Now
                      </a>
                    @endif

                    @if (!empty($property->whatsapp))
                      <a href="//api.whatsapp.com/send?phone={{ $property->whatsapp }}&text={{ urlencode($whatsapText) }}" class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                    @elseif(!empty($agency->whatsapp))
                      <a href="//api.whatsapp.com/send?phone={{ $agency->whatsapp }}&text={{ urlencode($whatsapText) }}" class="btn btn-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                    @endif


                    @if ($agency->email)
                      <a class="btn btn-danger" id="emailBtn" data-toggle="modal" data-target="#exampleModal" data-image="{{ asset('upload/properties/' . $property->featured_image) }}"
                        data-image="{{ $property->featured_image }}" data-title="{{ $property->property_name }}" data-agent="{{ $property->agent_name ?? $agency->name }}"
                        data-broker="{{ $agency->name ?? '' }}" data-bedroom="{{ $property->bedrooms ?? '' }}" data-bathroom="{{ $property->bathrooms ?? '' }}"
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
              <p> {{ $property->address }}<br>{{ $property->city }}</p>
            </div>
          </div>
          <div class="col-md-4 col-6">
            <div class="d-flex property-map-block">
              <div class="map-holder">
                <img src="{{ asset('assets/images/70d76248e.JPG') }}" alt="Map" class="property-location__image">
                <div class="map_btn">
                  <a href="https://maps.google.com.au/maps?q='+{{ $property->address }}+'" target="_blank" class="btn btn-sm btn-info">View</a>
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

                <a href="{{ url('agency/' . Str::slug($agency->name, ' -') . '/' . $agency->id) }}">
                  <p> {{ $agency->name }}</p>
                </a>

                <a href="{{ url('agency/' . Str::slug($agency->name, ' -') . '/' . $agency->id) }}">
                  ({{ count(App\Properties::where('status', '1')->where('agency_id', $agency->id)->get()) }}
                  properties)
                </a>
              </div>

            </div>
            <div class="col-md-4 col-6">
              <div class="d-flex">
                <a class="agent-img" href="{{ url('agency/' . Str::slug($agency->name, ' -') . '/' . $agency->id) }}">
                  <img src="{{ asset('upload/agencies/' . $agency->image) }}" alt="Map" class="property-location__image">
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
                    <li style="width:100% !important; font-size: 13px !important; color: #000 !important; font-weight: bold !important; letter-spacing: 1px !important;">
                      <strong> <i class="fas fa-check-circle pr-1"></i> </strong>{{ $ameniti }}
                    </li>
                  @endif
                @endforeach

              </ul>
            </div>
          </div>
        @endif
      </div>



      <div class="container">
        <div class="modal-content" style="padding: 0 10px 5px 5px;">
          <div class="modal-header" style="padding: 0.5rem">
            <h5 class="modal-title" id="exampleModalLongTitle">Share This Property</h5>
          </div>
          <div class="modal-body ">
            <div class="list-details-wrap text-center">
              <a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}" target="_blank" class="btn btn-outline">
                <img src="https://simplesharebuttons.com/images/somacro/facebook.png" class="social" alt="Facebook">
              </a>
              <!-- LinkedIn -->
              <button class="col-2 btn btn-outline" value="copy" style="background: none !important" onclick="copyToClipboard('copy_{{ $property->id }}')">
                <img src="{{ asset('upload/copy-icon.png') }}" class="social" alt="LinkedIn">
              </button>
              <!-- Twitter -->
              <a href="https://twitter.com/share?url={{ url()->current() }}" target="_blank" class="btn btn-outline">
                <img src="https://simplesharebuttons.com/images/somacro/twitter.png" class="social" alt="Twitter">
              </a>

              <!-- WhatsApp -->
              <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank" class="btn btn-outline mt-1">
                <img src="{{ asset('upload/whatsapp.png') }}" class="social" alt="WhatsApp">
              </a>


              <a href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}" target="_blank" class="btn btn-outline mt-1">
                <img src="{{ asset('upload/pinterest.png') }}" class="social" alt="Pintrest">
              </a>

            </div>
          </div>

        </div>
      </div>
      <div class="text-center" style="padding: 10px 0px 20px 0px !important;">
        <a href="" style="text-decoration: underline !important; margin: 10px 16px; float:left;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='#222'" data-bs-toggle="modal"
          data-bs-target="{{ auth()->check() ? '#reportModal' : '#user-login-popup' }}">
          <i class="fas fa-flag"></i>
          Report this Property

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
                        <a class="property-img" href="{{ url(strtolower($property->property_purpose) . '/' . $propx->property_slug . '/' . $propx->id) }}">
                          @if ($propx->featured_image)
                            <img src="{{ URL::asset('upload/properties/thumb_' . $propx->featured_image) }}" alt="{{ $propx->property_name }}">
                          @else
                            <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}" alt="{{ $propx->property_name }}">
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

    </div> --}}

  </div>
@endsection

@push('styles')
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.css' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/fancybox.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.controls.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/carousel.css" />

  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick.css') }}" />
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick-theme.css') }}" />
@endpush

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/fancybox.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/carousel.autoplay.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/carousel.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.controls.umd.js"></script>
  <script type="text/javascript" src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $(".pro-same-slider").slick({
        arrows: false,
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      });
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

    function copyToClipboard(id) {
      var copyUrl = window.location.href;
      // console.log(copyUrl);
      navigator.clipboard.writeText(copyUrl);
      var popup = document.getElementById("copy");
      popup.classList.toggle("show");
    }

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

    $(".btn-call").click(function() {
      $(".call-email-block").addClass("call-active");
    });
  </script>
@endpush