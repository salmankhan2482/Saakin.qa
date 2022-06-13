@extends("front.layouts.main")

@if ($property->meta_title != null)
  @section('title', $property->meta_title . ' | ' . 'Saakin.qa')
  @section('description', $property->meta_description ?? $property_des)
  @section('keyword', $property->meta_keyword)
  @section('type', 'property')
  @section('url', url()->current())
  @section('image', asset('upload/properties/' . $property->featured_image))
@else
  @section('title', $property->property_name . ' | ' . 'Saakin.qa')
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

  $whatsapText = 'Hello, I would like to inquire about this property posted on saakin.qa
  
  Reference: ' . $property->refference_code . '
  Price: QR ' . $property->getPrice() . '/month Type: ' . $property->propertiesTypes->types . '
  Location: ' . $property->address . '
  
  Link: ' 
  . $propertyUrl;
  @endphp

  <div class="inner-content">

    <div class="container">

      @if ((new \Jenssegers\Agent\Agent())->isTablet() || (new \Jenssegers\Agent\Agent())->isDesktop())
        <div class="row d-none d-md-flex">
          <div class="col">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  
                <li class="breadcrumb-item">
                  <a href="{{ route('cpt-purpose', [$property->property_purpose == 'Sale' ? 'buy' : 'rent',  Str::slug($property->propertyCity->name), 
                  Str::slug($property->propertiesTypes->plural) . '-for-' . strtolower($property->property_purpose)]) }}">

                    {{ $property->propertyCity->name }}
                    
                  </a>
                </li>

                @isset($property->propertySubCity->name)
                  <li class="breadcrumb-item">
                    <a href="{{ route('cpt-purpose', [$property->property_purpose == 'Sale' ? 'buy' : 'rent',  Str::slug($property->propertyCity->name), Str::slug($property->propertiesTypes->plural) . '-for-' . strtolower($property->property_purpose) . '-' . Str::slug($property->propertySubCity->name)]) }}">

                      {{ $property->propertySubCity->name }}

                    </a>
                  </li>
                @endisset
                
                @isset($property->propertyTown->name)
                  <li class="breadcrumb-item">
                    <a href="{{ route('cpt-purpose', [$property->property_purpose == 'Sale' ? 'buy' : 'rent',  Str::slug($property->propertyCity->name), Str::slug($property->propertiesTypes->plural) . '-for-' . strtolower($property->property_purpose) . '-' . Str::slug($property->propertySubCity->name. '-' . Str::slug($property->propertyTown->name))]) }}">
                      
                      {{ $property->propertyTown->name }}

                    </a>
                  </li>
                @endisset
                
                @isset($property->propertyArea->name)
                  <li class="breadcrumb-item">
                    <a href="{{ route('cpt-purpose', [$property->property_purpose == 'Sale' ? 'buy' : 'rent',  Str::slug($property->propertyCity->name), Str::slug($property->propertiesTypes->plural) . '-for-' . strtolower($property->property_purpose) . '-' . Str::slug($property->propertySubCity->name. '-' . Str::slug($property->propertyTown->name).'-' .Str::slug($property->propertyArea->name))]) }}">
                      
                      {{ $property->propertyArea->name }}
                    
                    </a>

                  </li>
                @endisset

              </ol>
            </nav>
          </div>
          <div class="col">
            <p class="text-end fs-sm">
              Properties for {{ $property->property_purpose }} in {{ $property->address }}
            </p>
          </div>
        </div>
      @endif

      <div class="position-relative">
        <div class="gallery_btn position-absolute bottom-0 start-0 p-3 d-none d-md-block @if ((new \Jenssegers\Agent\Agent())->isMobile()) mb-3 @endif" style="z-index: 1;">
          <a href="javascript:void(0)" data-fancybox-trigger="gallery" data-fancybox-index="0" class="btn btn-sm btn-primary">
            View Gallery
          </a>
          <a class="googleMapPopUp btn btn-sm btn-info" rel="nofollow" data-fancybox data-type="iframe" data-preload="false" 
            data-width="640" data-height="480" href="https://maps.google.com/maps?q={{ $property->address }}&output=embed" target="_blank">
            View Map
           </a>
           <a data-fancybox-index="0" class="btn btn-sm btn-primary">
            <i class="fa fa-eye">  {{ $property_counter}}</i>
          </a>
        </div>
        <div class="grid single-gallery @if ((new \Jenssegers\Agent\Agent())->isMobile()) single-gallery-slider @endif">
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

      <div class="grid details-content">
        <div class="mt-4">
          <div class="list-details-wrap">
            <div class="d-sm-none pb-4 text-center">
              <h2 class="h3">
                <strong>{{ $property->getPrice() }}
                  @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                    / Month
                  @endif
                </strong>
              </h2>

              <div class="btn-group btn-group-sm d-flex share-btns" role="group" aria-label="Share Link">
                <button type="button" class="btn btn-monochrome">
                  <i class="far fa-heart"></i><br> Save
                </button>
                <button type="button" class="btn btn-monochrome" data-bs-toggle="modal" data-bs-target="#shareModal">
                  <i class="far fa-share-square"></i><br>
                  Share</button>
                <button type="button" class="btn btn-monochrome" data-bs-toggle="modal" data-bs-target="{{ auth()->check() ? '#reportModal' : '#user-login-popup' }}">
                  <i class="far fa-flag"></i><br>
                  Report</button>
              </div>

            </div>

            <h6 class="text-primary">
              <?php $buyOrRent = $property->property_purpose == 'Sale' ? 'buy' : 'rent';  ?>
              @if(isset($property->propertyArea->name))
                
              <a href="{{ route('cpt-purpose', [$buyOrRent, Str::slug($property->propertyCity->name) ,Str::slug($property->propertiesTypes->plural) . '-for-' . strtolower($property->property_purpose) . '-' . Str::slug($property->propertySubcity->name) . '-' . Str::slug($property->propertyTown->name) .'-' .Str::slug($property->propertyArea->name)]) }}">
              
              {{$property->propertiesTypes->types.' for '. $property->property_purpose.' in '.$property->propertyArea->name }}
                
              </a>
              
              @elseif (isset($property->propertyTown->name))
                
              <a href="{{ route('cpt-purpose', [$buyOrRent, Str::slug($property->propertyCity->name) ,Str::slug($property->propertiesTypes->plural) . '-for-' . strtolower($property->property_purpose) . '-' . Str::slug($property->propertySubcity->name) . '-' . Str::slug($property->propertyTown->name)]) }}">

              {{$property->propertiesTypes->types.' for '. $property->property_purpose.' in '.$property->propertyTown->name }}
                
              </a>              
              @elseif (isset($property->propertySubcity->name))
              
              <a href="{{ route('cpt-purpose', [$buyOrRent, Str::slug($property->propertyCity->name),Str::slug($property->propertiesTypes->plural) . '-for-' . strtolower($property->property_purpose) . '-' . Str::slug($property->propertySubcity->name)]) }}">
                  
              {{$property->propertiesTypes->types.' for '. $property->property_purpose.' in '.$property->propertySubcity->name }}
                  
                </a>
              @endisset
              
            </h6>

            <h1 class="h2 mt-3 mb-4">{{ $property->property_name }}</h1>

            <div class="grid prop-type-info">
              <div>
                <i class="fas fa-building pr-1"></i> Property Type :
              </div>
              <div>
                {{ $property->propertiesTypes->types }}
              </div>
            
              <div>
                <i class="fas fa-chart-area pr-1"></i> Property Size:
              </div>
              <div>
                {{ $property->getSqm() }}
              </div>

              @if ($property->getProperty_type())
                @if ($property->bedrooms)
                  <div><i class="fas fa-bed pr-1"></i> Bedrooms :</div>
                  <div>{{ $property->bedrooms }}</div>
                @endif
              @endif

              @if ($property->getProperty_type())
                @if ($property->bathrooms)
                  <div><i class="fas fa-bath pr-1"></i> Bathrooms:</span></div>
                  <div>{{ $property->bathrooms }}</div>
                @endif
              @endif

              <div>
                <i class="far fa-edit"></i> Property Purpose :
              </div>
              <div>
                {{ $property->property_purpose }}
              </div>

              <div>
                <i class="fa fa-tasks" aria-hidden="true"></i>Completion:
              </div>
              <div>
                Ready
              </div>
            </div>

            <hr>
            <div class="row">
              <div class="col-md-6 col-lg-12 col-xl-6">
                <h4 class="mb-4">Location</h4>
                <div class="d-flex align-items-center">
                  <div class="me-3 position-relative rounded-img" style="min-width: 120px;">
                    <img src="{{ asset('assets/images/new.map.svg') }}" alt="Map" width="120">
                    <div class="map_btn position-absolute bottom-0  start-50 translate-middle-x pb-2">
                      <a data-fancybox data-type="iframe" data-preload="false" data-width="640" data-height="480" href="https://maps.google.com/maps?q={{ $property->address }}&output=embed"
                        class="btn btn-sm btn-info">View</a>
                    </div>
                  </div>
                  <address class="mb-0">
                    @isset($property->propertyArea->name)
                      {{ $property->propertyArea->name }}
                    @endisset
                    <br>

                    {{ $property->propertyCity->name }}, 
                    
                    @isset($property->propertySubCity->name)
                    {{ $property->propertySubCity->name }},    
                    @endisset 
                    
                    @isset($property->propertyTown->name)
                    {{ $property->propertyTown->name }},    
                    @endisset 

                  </address>
                </div>
              </div>

              <div class="col-md-6 col-lg-12 col-xl-6 mt-4 mt-md-0 mt-lg-4 mt-xl-0">
                <h4 class="mb-4">Agent</h4>
                @if (!empty($property->whatsapp) && !empty($property->agent_name))
                  <div class="grid" style="--template: 120px auto; --gap: 1rem">
                    <div class="rounded-img">
                      <!-- agent pic on desktop -->
                      @if (!empty($property->agent_picture))

                        <a class="d-block" href="{{ route('agency_detail', [Str::slug($agency->name),$agency->id] ) }}">

                          <img src="{{ asset('upload/properties/' . $property->agent_picture) }}" alt="{{ $property->agent_name }}" width="120">
                        </a>
                      @else
                        <a class="d-block rounded-img" 
                          href="{{ route('agency_detail', [Str::slug($agency->name),$agency->id] ) }}">
                          <img src="{{ asset('upload/agencies/no-image.png') }}" alt="{{ $property->agent_name }}" width="120">
                        </a>
                      @endif
                    </div>

                    <div class="d-md-block">
                      <h5>{{ $property->agent_name }}</h5>
                      <div class="grid mt-3" style="--template: 50px auto; --gap: .5rem">
                        <div>

                          <a href="{{ route('agency_detail', [Str::slug($agency->name),$agency->id] )}}">
                            <img src="{{ asset('upload/agencies/' . $agency->image) }}" class="rounded-circle" alt="{{ $property->agent_name }}" width="50">
                          </a>
                        </div>
                        <div>
                          <a class="link-dark text-decoration-none fw-bold" href="{{ route('agency_detail', [Str::slug($agency->name),$agency->id] ) }}">
                            {{ $agency->name }}
                          </a>
                          <br>
                          <a class="link-dark text-decoration-none fw-bold"  href="{{ route('agency_detail', [Str::slug($agency->name),$agency->id] ) }}">
                            ({{ App\Properties::where('status', '1')->where('agency_id', $agency->id)->count()  }} Properties)
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  <div class="grid align-items-center" style="--template: 120px auto; --gap: 1rem">
                    @if (!empty($agency->image))
                      <div class="rounded-img">
                        <a href="{{ route('agency_detail', [Str::slug($agency->name),$agency->id] ) }}">
                          <img src="{{ asset('upload/agencies/' . $agency->image) }}" alt="{{ $agency->name }}">
                        </a>
                      </div>
                    @endif
                    <div class="d-md-block">
                      @if (!empty($agency->name))
                        <h5>
                          <a class="link-dark text-decoration-none fw-bold" href="{{ route('agency_detail', [Str::slug($agency->name),$agency->id] ) }}">
                            {{ $agency->name }}
                          </a>
                        </h5>
                        <a class="link-dark text-decoration-none" href="{{ route('agency_detail', [Str::slug($agency->name),$agency->id] ) }}">
                          ({{ App\Properties::where('status', '1')->where('agency_id', $agency->id)->count()}} Properties)
                        </a>
                      @else
                        Agent not found
                      @endif
                    </div>

                  </div>
                @endif
              </div>
            </div>
          </div>

          <div class="fixed-bottom w-100 bg-white d-sm-none" tabindex="1">
            <div class="card-body text-center shadow">
              <div class="callgroup text-center justify-content-center d-flex">
                @if (!empty($property->whatsapp))
                  <a href="tel:{{ $property->whatsapp }}" 
                    class="btn btn-primary btn-sm btn-call me-1 btnCount" 
                    data-property_id={{ $property->id }} 
                    data-agency_id={{ $property->agency_id }} 
                    data-button_name='Call'>
                    <i class="fas fa-phone-alt"></i>
                    Call Now
                  </a>
                @else
                  <a href="tel:{{ $agency->phone }}" 
                    class="btn btn-primary btn-sm btn-call me-1 btnCount"
                    data-property_id={{ $property->id }} 
                    data-agency_id={{ $property->agency_id }} 
                    data-button_name='Call'>
                    <i class="fas fa-phone-alt"></i>
                    Call Now
                  </a>
                @endif
                @if (!empty($property->whatsapp))
                  <a href="//api.whatsapp.com/send?phone={{ $property->whatsapp }}&text={{ urlencode($whatsapText) }}" 
                    class="btn btn-sm btn-success me-1 btnCount" 
                    data-property_id={{ $property->id }} 
                    data-agency_id={{ $property->agency_id }} 
                    data-button_name='WhatsApp'>
                    <i class="fab fa-whatsapp"></i> 
                    WhatsApp
                  </a>
                @elseif(!empty($agency->whatsapp))
                  <a href="//api.whatsapp.com/send?phone={{ $agency->whatsapp }}&text={{ urlencode($whatsapText) }}" 
                    class="btn btn-sm btn-success me-1 btnCount"
                    data-property_id={{ $property->id }} 
                    data-agency_id={{ $property->agency_id }} 
                    data-button_name='WhatsApp'>
                    <i class="fab fa-whatsapp"></i> 
                    WhatsApp
                  </a>
                @endif
                <button class="btn btn-danger btn-sm btnCount" 
                  type="button" 
                  data-property_id={{ $property->id }}
                  data-agency_id={{ $property->agency_id }}
                  data-button_name='Email' 
                  data-bs-toggle="modal" 
                  data-bs-target="#emailAgentModal" 
                  id="emailBtn"
                  data-image="{{ asset('upload/properties/' . $property->featured_image) }}" data-title="{{ $property->property_name }}"
                  data-agent="{{ $property->agent_name ?? $agency->name }}" 
                  data-broker="{{ $agency->name ?? '' }}" 
                  data-bedroom="{{ $property->bedrooms ?? '' }}"
                  data-bathroom="{{ $property->bathrooms ?? '' }}" 
                  data-area="{{ $property->getSqm() ?? '' }}">
                  <i class="fas fa-envelope"></i>
                  Email Now
                </button>
              </div>
              <div class="call-detail-block">
                <div class="num-btn-holder">
                  <a href="#"><i class="fas fa-phone-alt"></i>
                    {{ $property->whatsapp ?? $agency->phone }}
                  </a>

                  <a class="btn-email btnCount" 
                    id="emailBtn"
                    data-property_id={{ $property->id }}
                    data-agency_id={{ $property->agency_id }}
                    data-button_name='Email' 
                    data-bs-toggle="modal" 
                    data-bs-target="#emailAgentModal" 
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
                <div class="grid amenities-grid">
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
            @else
            <div class="aminities-wrap text-dark">
              <h4 class="mb-3">Amenities</h4>
              <div class="grid amenities-grid">
                @foreach ($property->amenities as $amenity)
                <div class="fw-bold">
                  <i class="fas fa-check-circle"></i> {{ $amenity->name }}
                </div>
                @endforeach

              </div>
            </div>
            @endif
          </div>

          {{-- @if (!(new \Jenssegers\Agent\Agent())->isMobile()) --}}

          <div class="mt-4 d-none d-sm-block">
            <h5 class="border-bottom pb-3 mb-2">Share This Property</h5>
            <div class="d-flex flex-wrap align-items-center spbwx12 spbwy8">
              <div class="mt-2"></div>
              
              <div>
                <a href="http://www.facebook.com/sharer.php?u={{url()->current()}}" class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #4267b2;">
                    <path
                      d="M20 10.061C20 4.505 15.523 0 10 0S0 4.505 0 10.061C0 15.083 3.657 19.245 8.438 20v-7.03h-2.54V10.06h2.54V7.845c0-2.522 1.492-3.915 3.777-3.915 1.094 0 2.238.197 2.238.197v2.476h-1.26c-1.243 0-1.63.775-1.63 1.57v1.888h2.773l-.443 2.908h-2.33V20c4.78-.755 8.437-4.917 8.437-9.939">
                    </path>
                  </svg>
                  Facebook
                </a>
              </div>
              <div>
                <a href="https://pinterest.com/pin/create/button/?url={{url()->current()}}" class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #e60019;">
                    <path
                      d="M10.008 0C4.481 0 0 4.474 0 9.992c0 4.235 2.636 7.853 6.36 9.309-.091-.79-.166-2.007.032-2.87.181-.781 1.17-4.967 1.17-4.967s-.297-.6-.297-1.48c0-1.39.807-2.426 1.812-2.426.857 0 1.269.641 1.269 1.406 0 .855-.544 2.138-.832 3.33-.239.995.502 1.81 1.483 1.81 1.779 0 3.146-1.875 3.146-4.573 0-2.393-1.721-4.062-4.184-4.062-2.85 0-4.522 2.13-4.522 4.334 0 .855.329 1.776.74 2.278.083.098.092.189.067.287-.074.313-.247.995-.28 1.135-.041.181-.149.222-.338.132-1.252-.584-2.035-2.401-2.035-3.873 0-3.15 2.29-6.045 6.615-6.045 3.468 0 6.17 2.467 6.17 5.773 0 3.446-2.175 6.217-5.19 6.217-1.013 0-1.969-.526-2.29-1.151l-.626 2.377c-.222.871-.832 1.957-1.244 2.623.94.288 1.928.444 2.966.444C15.519 20 20 15.526 20 10.008 20.016 4.474 15.535 0 10.008 0z">
                    </path>
                  </svg>
                  Pinterest
                </a>
              </div>
              <div>
                <a href="https://twitter.com/share?url={{url()->current()}}" class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #1da1f3;">
                    <path
                      d="M20 10c0 5.525-4.475 10-10 10S0 15.525 0 10 4.475 0 10 0s10 4.475 10 10zM7.843 15.79c4.373 0 6.763-4.051 6.763-7.562 0-.116 0-.231-.004-.342a5.228 5.228 0 0 0 1.187-1.377c-.423.21-.882.352-1.365.419.493-.331.868-.85 1.045-1.472a4.519 4.519 0 0 1-1.508.645c-.434-.518-1.05-.838-1.735-.838-1.312 0-2.376 1.19-2.376 2.657 0 .209.02.413.064.606-1.977-.11-3.727-1.169-4.9-2.778a2.91 2.91 0 0 0-.32 1.334c0 .92.419 1.736 1.06 2.21a2.15 2.15 0 0 1-1.075-.33v.032c0 1.29.818 2.359 1.907 2.607a2.136 2.136 0 0 1-1.074.044c.3 1.058 1.178 1.824 2.218 1.846-.813.711-1.839 1.136-2.953 1.136-.192 0-.38-.011-.566-.039a6.13 6.13 0 0 0 3.632 1.201z">
                    </path>
                  </svg>
                  Twitter
                </a>
              </div>
              <div>
                <button class="btn btn-monochrome btn-sm share-btn popup" value="copy" style="background: none !important" 
                  onclick="copyToClipboard('copy_{{ $property->id }}')" >

                <span class="popuptext mypopup" id="copy">copied!</span>
                    <img src="{{asset('upload/copy-icon.png')}}" style="height: 1rem" class="social" alt="Copy URL"> 
                    Copy Link
                </button>
              </div>
              <div>
                <a href="https://api.whatsapp.com/send?text={{url()->current()}}" class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="05 06 22 20" class="btn-icon" style="--icon-color: #25d366;">
                  <path 
                    d=" M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z"></path>
                  </svg> 
                  WhatsApp
                </a>
              </div>
            </div>
          </div>

          {{-- @endif --}}
        </div>

        <div class="mt-4 d-none d-sm-block">
          <div class="card sticky-lg-top call-email-block" tabindex="1">
            <div class="card-body">
              <h2 class="h3">
                <strong>{{ $property->getPrice() }}
                  @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                    / Month
                  @endif
                </strong>
              </h2>

              <div class="callgroup text-center justify-content-center">
                @if (!empty($property->whatsapp))
                  <a href="tel:{{ $property->whatsapp }}" 
                    class="btn btn-primary btn-call btnCount"
                    data-property_id={{ $property->id }} 
                    data-agency_id={{ $property->agency_id }} 
                    data-button_name='Call'>
                    <i class="fas fa-phone-alt"></i>
                    Call Now
                  </a>
                @else
                  <a href="tel:{{ $agency->phone }}" 
                    class="btn btn-primary btn-call btnCount"
                    data-property_id={{ $property->id }} 
                    data-agency_id={{ $property->agency_id }} 
                    data-button_name='Call'>
                    <i class="fas fa-phone-alt"></i>
                    Call Now
                  </a>
                @endif
                @if (!empty($property->whatsapp))
                  <a href="//api.whatsapp.com/send?phone={{ $property->whatsapp }}&text={{ urlencode($whatsapText) }}" 
                      class="btn btn-success btnCount"
                      data-property_id={{ $property->id }} 
                      data-agency_id={{ $property->agency_id }} 
                      data-button_name='WhatsApp'>
                    <i class="fab fa-whatsapp"></i> 
                    WhatsApp
                  </a>
                @elseif(!empty($agency->whatsapp))
                  <a href="//api.whatsapp.com/send?phone={{ $agency->whatsapp }}&text={{ urlencode($whatsapText) }}" 
                    class="btn btn-success btnCount"
                    data-property_id={{ $property->id }} 
                    data-agency_id={{ $property->agency_id }} 
                    data-button_name='WhatsApp'>
                    <i class="fab fa-whatsapp"></i> 
                    WhatsApp
                  </a>
                @endif
                <button 
                  class="btn btn-danger btnCount" 
                  type="button" 
                  data-property_id={{ $property->id }}
                  data-agency_id={{ $property->agency_id }}
                  data-button_name='Email'
                  data-bs-toggle="modal" 
                  data-bs-target="#emailAgentModal" id="emailBtn" data-image="{{ asset('upload/properties/' . $property->featured_image) }}"
                  data-title="{{ $property->property_name }}" 
                  data-agent="{{ $property->agent_name ?? $agency->name }}" 
                  data-broker="{{ $agency->name ?? '' }}"
                  data-bedroom="{{ $property->bedrooms ?? '' }}" 
                  data-bathroom="{{ $property->bathrooms ?? '' }}" 
                  data-area="{{ $property->getSqm() ?? '' }}">
                  <i class="fas fa-envelope"></i>
                  Email Now
                </button>
              </div>

              <div class="call-detail-block">
                <div class="num-btn-holder">
                  <a href="#"><i class="fas fa-phone-alt"></i>
                    {{ $property->whatsapp ?? $agency->phone }}
                  </a>

                  <a class="btn-email btnCount" 
                    id="emailBtn"
                    data-property_id={{ $property->id }}
                    data-agency_id={{ $property->agency_id }}
                    data-button_name='Email' 
                    data-bs-toggle="modal" 
                    data-bs-target="#emailAgentModal" 
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

              <div class="text-center border-top pt-3 mt-3">
                <button class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-size:1em;">
                    <path
                      d="M19.155 9.204a4.6 4.6 0 0 0 .009-6.422c-1.587-1.646-4.236-1.721-5.918-.169-.027.026-.648.663-1.689 1.734L11 4.92l-.557-.574a358.648 358.648 0 0 0-1.69-1.734c-1.681-1.552-4.33-1.477-5.917.17a4.6 4.6 0 0 0 .009 6.42l7.97 8.222.01.01a.26.26 0 0 0 .36-.01l7.97-8.221zm-6.964-7.677c2.3-2.123 5.922-2.02 8.091.23a6.07 6.07 0 0 1-.011 8.474l-7.97 8.222c-.679.701-1.812.732-2.53.07-.037-.034-.037-.034-.072-.07l-7.97-8.222a6.07 6.07 0 0 1-.011-8.474c2.169-2.25 5.792-2.353 8.09-.23.052.046.416.42 1.192 1.217.776-.798 1.14-1.17 1.191-1.217z">
                    </path>
                  </svg> Add to Shortlist
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
            {{-- @if ($message = Session::get('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
            </div>
            @endif --}}

            @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    @if (Session::has('flash_message_email_modal'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
            </button>
            {{ Session::get('flash_message_email_modal') }}
        </div>
    @endif
          </div>

        </div>
      </div>

        @if (count($properties) > 0)
        <div class="col-lg-8 mt-4">
          <h3 class="mb-4">{{ $properties->count() }} More Properties in the Same Area</h3>
          <div class="@if ((new \Jenssegers\Agent\Agent())->isMobile()) pro-same-m d-flex can-scroll-x spbwx16 @else pro-same-slider @endif">
            @foreach ($properties as $propx)
              <div class="single-property-box border">
                <div class="property-item">
                  <a style="--img-container-height: 155px" class="property-img stretched-link" href="{{ url(strtolower($property->property_purpose) . '/' . $propx->property_slug . '/' . $propx->id) }}">
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
                <div class="property-title-box" >
                  <a class="text-decoration-none stretched-link" href="{{ url(strtolower($property->property_purpose) . '/' . $propx->property_slug . '/' . $propx->id) }}">
                    <h5 class="property-card__property-title">
                      {{ \Illuminate\Support\Str::limit($property->property_name) }}
                    </h5>
                  </a> 
                  <div class="property-location">
                    <p>
                      {{ $propx->propertiesTypes->types }}
                      <br>
                      <span class="hideAddress">
                        {{ $property->address }}
                      </span>
                    </p>
                  </div>

                  <ul class="property-feature">
                    @if ($propx->getProperty_type())
                      <li class="me-1">
                        <i class="fas fa-bed fas-icon"></i>
                        <span>{{ $propx->bedrooms }} </span>
                      </li>
                      <li class="me-1">
                        <i class="fas fa-bath fas-icon"></i>
                        <span>{{ $propx->bathrooms }}
                        </span>
                      </li>
                    @endif
                    <li class="me-1">
                      <i class="fas fa-chart-area fas-icon"></i>
                      <span> {{ $propx->getSqm() }} </span>
                    </li>
                  </ul>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        @endif
    </div>

    @if ((new \Jenssegers\Agent\Agent())->isMobile())
    {{-- shareModal --}}
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="shareModalLabel">Share This Property</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="d-flex flex-wrap text-center justify-content-center">
              <div class="col-5 m-1">
                <a href="http://www.facebook.com/sharer.php?u={{url()->current()}}" class="btn btn-monochrome share-btn w-100">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #4267b2;">
                    <path
                      d="M20 10.061C20 4.505 15.523 0 10 0S0 4.505 0 10.061C0 15.083 3.657 19.245 8.438 20v-7.03h-2.54V10.06h2.54V7.845c0-2.522 1.492-3.915 3.777-3.915 1.094 0 2.238.197 2.238.197v2.476h-1.26c-1.243 0-1.63.775-1.63 1.57v1.888h2.773l-.443 2.908h-2.33V20c4.78-.755 8.437-4.917 8.437-9.939">
                    </path>
                  </svg>
                  Facebook
                </a>
              </div>
              <div class="col-5 m-1">
                <a href="https://twitter.com/share?url={{url()->current()}}" class="btn btn-monochrome share-btn w-100">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #1da1f3;">
                    <path
                      d="M20 10c0 5.525-4.475 10-10 10S0 15.525 0 10 4.475 0 10 0s10 4.475 10 10zM7.843 15.79c4.373 0 6.763-4.051 6.763-7.562 0-.116 0-.231-.004-.342a5.228 5.228 0 0 0 1.187-1.377c-.423.21-.882.352-1.365.419.493-.331.868-.85 1.045-1.472a4.519 4.519 0 0 1-1.508.645c-.434-.518-1.05-.838-1.735-.838-1.312 0-2.376 1.19-2.376 2.657 0 .209.02.413.064.606-1.977-.11-3.727-1.169-4.9-2.778a2.91 2.91 0 0 0-.32 1.334c0 .92.419 1.736 1.06 2.21a2.15 2.15 0 0 1-1.075-.33v.032c0 1.29.818 2.359 1.907 2.607a2.136 2.136 0 0 1-1.074.044c.3 1.058 1.178 1.824 2.218 1.846-.813.711-1.839 1.136-2.953 1.136-.192 0-.38-.011-.566-.039a6.13 6.13 0 0 0 3.632 1.201z">
                    </path>
                  </svg>
                  Twitter
                </a>
              </div>
              
              <div class="col-5 m-1">
                <a href="https://pinterest.com/pin/create/button/?url={{url()->current()}}" class="btn btn-monochrome share-btn w-100">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #e60019;">
                    <path
                      d="M10.008 0C4.481 0 0 4.474 0 9.992c0 4.235 2.636 7.853 6.36 9.309-.091-.79-.166-2.007.032-2.87.181-.781 1.17-4.967 1.17-4.967s-.297-.6-.297-1.48c0-1.39.807-2.426 1.812-2.426.857 0 1.269.641 1.269 1.406 0 .855-.544 2.138-.832 3.33-.239.995.502 1.81 1.483 1.81 1.779 0 3.146-1.875 3.146-4.573 0-2.393-1.721-4.062-4.184-4.062-2.85 0-4.522 2.13-4.522 4.334 0 .855.329 1.776.74 2.278.083.098.092.189.067.287-.074.313-.247.995-.28 1.135-.041.181-.149.222-.338.132-1.252-.584-2.035-2.401-2.035-3.873 0-3.15 2.29-6.045 6.615-6.045 3.468 0 6.17 2.467 6.17 5.773 0 3.446-2.175 6.217-5.19 6.217-1.013 0-1.969-.526-2.29-1.151l-.626 2.377c-.222.871-.832 1.957-1.244 2.623.94.288 1.928.444 2.966.444C15.519 20 20 15.526 20 10.008 20.016 4.474 15.535 0 10.008 0z">
                    </path>
                  </svg>
                  Pinterest
                </a>
              </div>
              
              <div class="col-5 m-1">
                <a href="https://api.whatsapp.com/send?text={{url()->current()}}" class="btn btn-monochrome share-btn w-100">
                  <svg viewBox="05 06 22 20" class="btn-icon" style="--icon-color: #25d366;">
                    <path 
                      d=" M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z">
                    </path>
                  </svg>
                  WhatsApp
                </a>
              </div>
              
              <div class="col m-1">
                  <button class="btn btn-monochrome btn-sm share-btn popup" value="copy" style="background: none !important" 
                    onclick="copyToClipboard('copy_{{ $property->id }}')" >
  
                  <span class="popuptext mypopup" id="copy">copied!</span>
                      <img src="{{asset('upload/copy-icon.png')}}" style="height: 1rem" class="social" alt="Copy URL"> 
                      Copy Link
                  </button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    @endif

  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
 
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick.css') }}" />
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick-theme.css') }}" />
@endpush

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
  <script type="text/javascript" src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>

  @if ((new \Jenssegers\Agent\Agent())->isMobile())
  <script type="text/javascript">
    $(document).ready(function() {
      $(".single-gallery-slider").slick({
        dots: true,
        autoplay: false,
        autoplaySpeed: 2000,
        speed: 10,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
      });
    });
  </script>
@endif

  <script type="text/javascript">
    $(document).ready(function() {

      $(".pro-same-slider").slick({
        arrows: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 2000,
        speed: 10,
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
      console.log(copyUrl);
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
