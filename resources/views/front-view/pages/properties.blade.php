﻿@extends("front-view.layouts.main")
@if ($landing_page_content->meta_title != null)
  @section('title', $landing_page_content->meta_title . ' | ' . ' Saakin.com')
  @section('description', $landing_page_content->meta_description)
  @section('keyword', $landing_page_content->meta_keyword)
  @section('type', 'property')
  @section('url', url()->current())
@else
  @section('title', 'Properties in Qatar | Saakin.com')
  @section('description', $page_des)
  @section('type', 'property')
  @section('url', url()->current())
@endif

@section('content')

  {{-- <div class="site-banner" style="background-image: url('assets/images/backgrounds/bg-8.jpg')">
	<div class="container">
		<h1>Buy And Rent Properties in Qatar</h1>
	</div>
</div> --}}

  <div class="filter-wrap">
    <div class="container">
      <form action="{{ url('properties') }}" class="hero__form v2 filter" method="get">
        <input type="hidden" name="featured" id="featured" value="{{ request()->featured }}">
        <div class="search-filter flex-xl-nowrap">
          <div class="input-search-wrap me-2">
            <div class="input-group-overlay input-search">
              <div class="input-group-prepend-overlay">
                <span class="input-group-text" id="country"><i class="fa fa-search"></i></span>
              </div>

              <input type="text" class="typeahead form-control prepended-form-control" name="keyword" id="country" placeholder="Search Location" autocomplete="off"
                value="{{ Request::get('keyword') }}">
            </div>
            <div id="country_list" class="col-md-12 col-12"></div>
          </div>

          @if ((new \Jenssegers\Agent\Agent())->isTablet() || (new \Jenssegers\Agent\Agent())->isDesktop())
            <div class="d-flex spbwx8 order-3 order-xl-2 mt-2 mt-xl-0 me-xl-2">
              <div class="">
                <select name="property_purpose" id="property_purpose" class="hero__form-input form-select custom-select" onchange="setPropertyPurpose(value)">
                  <option value="" selected>Property Purpose</option>
                  @foreach ($propertyPurposes as $propertyPurpose)
                    <option value="{{ $propertyPurpose->name }}" @if ($request->property_purpose == $propertyPurpose->name) selected @endif>
                      {{ $propertyPurpose->name }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="">
                <select name="property_type" id="property_type" class="hero__form-input form-select custom-select" onchange="setPropertyType(this)">
                  <option value="" selected>All Type</option>
                  @foreach ($propertyTypes as $propertyType)
                    <option value="{{ $propertyType->id }}" @if ($request->property_type == $propertyType->id) selected @endif>

                      {{ $propertyType->types }}
                      ({{ $propertyType->pcount }})
                    </option>
                  @endforeach
                </select>
              </div>

              <div>
                <div class="dropdown js-dropdown">
                  <div class="form-select dropdown-toggle minMaxDiv" type="button" id="pricedropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Price
                  </div>
                  <div class="dropdown-menu price-dropdown" aria-labelledby="pricedropdownMenuButton">
                    <div class="d-flex align-items-center spbwx8">
                      <div class="flex-grow-1">
                        <select name="min_price" onchange="setMin(this);" class="hero__form-input form-control custom-select">
                          <option {{ $request->min_price == '' ? 'selected' : '' }} value="">Min
                            Price</option>
                          <option {{ $request->min_price == '5000' ? 'selected' : '' }} value="5000">
                            QAR 5,000</option>
                          <option {{ $request->min_price == '10000' ? 'selected' : '' }} value="10000">QAR
                            10,000</option>
                          <option {{ $request->min_price == '15000' ? 'selected' : '' }} value="10000">QAR
                            15,000</option>
                          <option {{ $request->min_price == '20000' ? 'selected' : '' }} value="20000">QAR
                            20,000</option>
                          <option {{ $request->min_price == '25000' ? 'selected' : '' }} value="25000">QAR
                            25,000</option>
                          <option {{ $request->min_price == '30000' ? 'selected' : '' }} value="30000">QAR
                            30,000</option>
                          <option {{ $request->min_price == '40000' ? 'selected' : '' }} value="40000">QAR
                            40,000</option>
                          <option {{ $request->min_price == '50000' ? 'selected' : '' }} value="50000">QAR
                            50,000</option>
                          <option {{ $request->min_price == '60000' ? 'selected' : '' }} value="60000">QAR
                            60,000</option>
                          <option {{ $request->min_price == '70000' ? 'selected' : '' }} value="70000">QAR
                            70,000</option>
                          <option {{ $request->min_price == '90000' ? 'selected' : '' }} value="90000">QAR
                            90,000</option>
                          <option {{ $request->min_price == '100000' ? 'selected' : '' }} value="100000">QAR
                            100,000</option>
                          <option {{ $request->min_price == '125000' ? 'selected' : '' }} value="125000">QAR
                            1,25,000</option>
                          <option {{ $request->min_price == '150000' ? 'selected' : '' }} value="150000">QAR
                            1,50,000</option>
                        </select>
                      </div>
                      <div class="">
                        <span class="separator">-</span>
                      </div>
                      <div class="flex-grow-1">
                        <select name="max_price" onchange="setMax(this);" class="hero__form-input form-control custom-select">
                          <option {{ $request->max_price == '' ? 'selected' : '' }} value="">Max
                            Price</option>
                          <option {{ $request->max_price == '5000' ? 'selected' : '' }} value="5000">QAR 5,000
                          </option>
                          <option {{ $request->max_price == '10000' ? 'selected' : '' }} value="10000">QAR
                            10,000</option>
                          <option {{ $request->max_price == '15000' ? 'selected' : '' }} value="15000">QAR
                            15,000</option>
                          <option {{ $request->max_price == '20000' ? 'selected' : '' }} value="20000">QAR
                            20,000</option>
                          <option {{ $request->max_price == '25000' ? 'selected' : '' }} value="25000">QAR
                            25,000</option>
                          <option {{ $request->max_price == '30000' ? 'selected' : '' }} value="30000">QAR
                            30,000</option>
                          <option {{ $request->max_price == '40000' ? 'selected' : '' }} value="40000">QAR
                            40,000</option>
                          <option {{ $request->max_price == '50000' ? 'selected' : '' }} value="50000">QAR
                            50,000</option>
                          <option {{ $request->max_price == '60000' ? 'selected' : '' }} value="60000">QAR
                            60,000</option>
                          <option {{ $request->max_price == '70000' ? 'selected' : '' }} value="70000">QAR
                            70,000</option>
                          <option {{ $request->max_price == '90000' ? 'selected' : '' }} value="90000">QAR
                            90,000</option>
                          <option {{ $request->max_price == '100000' ? 'selected' : '' }} value="100000">QAR
                            100,000</option>
                          <option {{ $request->max_price == '125000' ? 'selected' : '' }} value="125000">QAR
                            1,25,000</option>
                          <option {{ $request->max_price == '150000' ? 'selected' : '' }} value="150000">QAR
                            1,50,000</option>
                          <option {{ $request->max_price == '250000' ? 'selected' : '' }} value="250000">QAR
                            2,50,000</option>
                          <option {{ $request->max_price == '450000' ? 'selected' : '' }} value="450000">QAR
                            4,50,000</option>
                          <option {{ $request->max_price == '850000' ? 'selected' : '' }} value="850000">QAR
                            8,50,000</option>
                          <option {{ $request->max_price == '1000000' ? 'selected' : '' }} value="1000000">QAR
                            1,00,0000
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="dropdown js-dropdown">
                  <div class="form-select dropdown-toggle minMaxArea" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Area
                  </div>
                  <div class="dropdown-menu price-dropdown" id="dropdownMenuButton" aria-labelledby="dropdownMenuButton">
                    <div class="d-flex spbwx8 align-items-center">
                      <div class="flex-grow-1">
                        <select name="min_area" onchange="minAreaFunction(this);" class="hero__form-input  form-control custom-select">
                          <option @if ($request->min_area == '') selected @endif value="">Min Area
                          </option>
                          <option @if ($request->min_area == '500') selected @endif value="500">500
                            sqm</option>
                          <option @if ($request->min_area == '600') selected @endif value="600">600
                            sqm</option>
                          <option @if ($request->min_area == '700') selected @endif value="700">700
                            sqm</option>
                          <option @if ($request->min_area == '800') selected @endif value="800">800
                            sqm</option>
                          <option @if ($request->min_area == '900') selected @endif value="900">900
                            sqm</option>
                          <option @if ($request->min_area == '1000') selected @endif value="1000">1000
                            sqm</option>
                          <option @if ($request->min_area == '1100') selected @endif value="1100">1100
                            sqm</option>
                          <option @if ($request->min_area == '1200') selected @endif value="1200">1200
                            sqm</option>
                          <option @if ($request->min_area == '1300') selected @endif value="1300">1300
                            sqm</option>
                          <option @if ($request->min_area == '1400') selected @endif value="1400">1400
                            sqm</option>
                          <option @if ($request->min_area == '1500') selected @endif value="1500">1500
                            sqm</option>
                          <option @if ($request->min_area == '1600') selected @endif value="1600">1600
                            sqm</option>
                          <option @if ($request->min_area == '1700') selected @endif value="1700">1700
                            sqm</option>
                          <option @if ($request->min_area == '1800') selected @endif value="1800">1800
                            sqm</option>
                          <option @if ($request->min_area == '1900') selected @endif value="1900">1900
                            sqm</option>
                          <option @if ($request->min_area == '2000') selected @endif value="2000">2000
                            sqm</option>
                          <option @if ($request->min_area == '2500') selected @endif value="2500">2500
                            sqm</option>
                          <option @if ($request->min_area == '3000') selected @endif value="3000">3000
                            sqm</option>
                          <option @if ($request->min_area == '4000') selected @endif value="4000">4000
                            sqm</option>
                          <option @if ($request->min_area == '5000') selected @endif value="5000">5000
                            sqm</option>
                        </select>
                      </div>
                      <div>
                        <span class="separator">-</span>
                      </div>
                      <div class="flex-grow-1">
                        <select name="max_area" onchange="maxAreaFunction(this);" class="hero__form-input  form-control custom-select">
                          <option @if ($request->max_area == '') selected @endif value="">Max Area
                          </option>
                          <option @if ($request->max_area == '500') selected @endif value="500">500
                            sqm</option>
                          <option @if ($request->max_area == '600') selected @endif value="600">600
                            sqm</option>
                          <option @if ($request->max_area == '700') selected @endif value="700">700
                            sqm</option>
                          <option @if ($request->max_area == '800') selected @endif value="800">800
                            sqm</option>
                          <option @if ($request->max_area == '900') selected @endif value="900">900
                            sqm</option>
                          <option @if ($request->max_area == '1000') selected @endif value="1000">1000
                            sqm</option>
                          <option @if ($request->max_area == '1100') selected @endif value="1100">1100
                            sqm</option>
                          <option @if ($request->max_area == '1200') selected @endif value="1200">1200
                            sqm</option>
                          <option @if ($request->max_area == '1300') selected @endif value="1300">1300
                            sqm</option>
                          <option @if ($request->max_area == '1400') selected @endif value="1400">1400
                            sqm</option>
                          <option @if ($request->max_area == '1500') selected @endif value="1500">1500
                            sqm</option>
                          <option @if ($request->max_area == '1600') selected @endif value="1600">1600
                            sqm</option>
                          <option @if ($request->max_area == '1700') selected @endif value="1700">1700
                            sqm</option>
                          <option @if ($request->max_area == '1800') selected @endif value="1800">1800
                            sqm</option>
                          <option @if ($request->max_area == '1900') selected @endif value="1900">1900
                            sqm</option>
                          <option @if ($request->max_area == '2000') selected @endif value="2000">2000
                            sqm</option>
                          <option @if ($request->max_area == '2500') selected @endif value="2500">2500
                            sqm</option>
                          <option @if ($request->max_area == '3000') selected @endif value="3000">3000
                            sqm</option>
                          <option @if ($request->max_area == '4000') selected @endif value="4000">4000
                            sqm</option>
                          <option @if ($request->max_area == '5000') selected @endif value="5000">5000
                            sqm</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="dropdown js-dropdown">
                  <div class="form-select dropdown-toggle bedbathdrop" type="button" id="beddropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Beds & Baths
                  </div>

                  <div class="dropdown-menu px-2 custom-dropdown" id="beddropdownMenuButton" aria-labelledby="dropdownMenuButton">
                    <h6>Bedrooms</h6>
                    <div class="d-flex spbwx8 mb-3">
                      <a class="dropdown-item item-in-line bedrooms" href="javascript:;" onclick="bedrooms(this);">Any</a>
                      <a class="dropdown-item item-in-line bedrooms" href="javascript:;" onclick="bedrooms(this);">1</a>
                      <a class="dropdown-item item-in-line bedrooms" href="javascript:;" onclick="bedrooms(this);">2</a>
                      <a class="dropdown-item item-in-line bedrooms" href="javascript:;" onclick="bedrooms(this);">3</a>
                      <a class="dropdown-item item-in-line bedrooms" href="javascript:;" onclick="bedrooms(this);">4</a>
                      <a class="dropdown-item item-in-line bedrooms" href="javascript:;" onclick="bedrooms(this);">5</a>
                      <a class="dropdown-item item-in-line bedrooms" href="javascript:;" onclick="bedrooms(this);">6+</a>
                    </div>

                    <div class="mb-3">
                      <input type="checkbox" name="exact_bedrooms" value="1"> Use exact values
                    </div>

                    <div class="mb-3">
                      <h6>Bathrooms</h6>
                      <div class="d-flex spbwx8">
                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;" onclick="bathrooms(this);">Any</a>
                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;" onclick="bathrooms(this);">1</a>
                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;" onclick="bathrooms(this);">2</a>
                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;" onclick="bathrooms(this);">3</a>
                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;" onclick="bathrooms(this);">4</a>
                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;" onclick="bathrooms(this);">5</a>
                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;" onclick="bathrooms(this);">6+</a>
                      </div>
                    </div>
                    <div class="">
                      <input type="checkbox" name="exact_bathrooms" value="1"> Use exact values
                    </div>
                  </div>
                </div>

                {{-- <div class="">
                <select name="bedrooms" id="bedrooms" class="hero__form-input form-select custom-select">
                  <option value="" selected>Bed</option>
                  <option @if ($request->bedrooms == 1) selected @endif>1</option>
                  <option @if ($request->bedrooms == 2) selected @endif>2</option>
                  <option @if ($request->bedrooms == 3) selected @endif>3</option>
                  <option @if ($request->bedrooms == 4) selected @endif>4</option>
                  <option @if ($request->bedrooms == 5) selected @endif>5</option>
                  <option @if ($request->bedrooms == '6+') selected @endif>6+</option>
                </select>
              </div>
              <div class="">
                <select name="bathrooms" id="bathrooms" class="hero__form-input form-select custom-select">
                  <option value="" selected>Bath</option>
                  <option @if ($request->bathrooms == 12) selected @endif>1</option>
                  <option @if ($request->bathrooms == 2) selected @endif>2</option>
                  <option @if ($request->bathrooms == 3) selected @endif>3</option>
                  <option @if ($request->bathrooms == 4) selected @endif>4</option>
                  <option @if ($request->bathrooms == 5) selected @endif>5</option>
                  <option @if ($request->bathrooms == '6+') selected @endif>6+</option>
                </select>
              </div> --}}
              </div>
              <div class="flex-grow-1">
                <select name="furnishings" class="hero__form-input form-select custom-select">
                  <option value="">All furnishings</option>
                  <option value="109" {{ Request::get('furnishings') == 109 ? 'selected' : '' }}>
                    Furnished
                  </option>
                  <option value="120" {{ Request::get('furnishings') == 120 ? 'selected' : '' }}>
                    Unfurnished
                  </option>
                  <option value="101" {{ Request::get('furnishings') == 101 ? 'selected' : '' }}>
                    Partly furnished
                  </option>
                </select>
              </div>
              {{-- <div class="">
              <div class="input-search">
                <input type="text" class="typeahead form-control" name="keywordextra" placeholder="View of Water, Gym, or Security" autocomplete="off" value="{{ Request::get('keywordextra') }}">
              </div>
            </div> --}}

            </div>

          @endif


          {{-- <div class="position-relative mb-3">
					<div class="commercial-checkbox">
						<input type="checkbox" name="commercial" value="1" id="commercial" {{ request('commercial')==1 ? 'checked'
							: '' }}>
						<label for="commercial">Show commercial properties only</label>
					</div>
				  </div> --}}
          <div class="order-2 order-xl-3">
            <button typeof="submit" class="btn btn-primary px-4" type="submit">Filter</button>
          </div>

        </div>
      </form>
    </div>
  </div>

  <div class="inner-content">
    <div class="container">
      @if (count($properties) > 0)

        <div class="short-wrap mb-3">

          {{-- Push filter for Mobile --}}
          @if ((new \Jenssegers\Agent\Agent())->isMobile())
            <div class="row gx-2 mb-3">
              <div class="col">
                <button type="button" data-bs-toggle="offcanvas" data-bs-target="#mSearchFilter" aria-controls="mSearchFilter" class="btn btn-monochrome btn-sm w-100"
                  style="--btn-bg-color: transparent;"><i class="fas fa-sliders-h"></i>
                  Filters</button>
              </div>
              <div class="col">
                <input type="checkbox" class="btn-check" id="save-search" autocomplete="off">
                <label class="btn btn-outline-primary btn-sm w-100" for="save-search"><i class="far fa-star"></i> Save
                  Search</label>
              </div>
            </div>

            {{-- Mobile Filters --}}
            <div class="offcanvas offcanvas-top mSearchFilter" tabindex="-2" id="mSearchFilter" aria-labelledby="mSearchFilterLabel">
              <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="mSearchFilterLabel" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fas fa-times"></i> Filters</h5>
                <button class="btn btn-outline-danger btn-sm">Clear All</button>
              </div>
              <div class="offcanvas-body">
                <div class="btn-group btn-group-sm d-flex" role="group" aria-label="Sell type">
                  <input type="radio" class="btn-check" name="property-type" id="btnRent" autocomplete="off" checked>
                  <label class="btn btn-outline-primary" for="btnRent">Rent</label>

                  <input type="radio" class="btn-check" name="property-type" id="btnrBuy" autocomplete="off">
                  <label class="btn btn-outline-primary" for="btnrBuy">Buy</label>
                </div>
                <div class="commercial-checkbox my-3 fs-sm">
                  <input class="form-check-input" type="checkbox" name="commercial" value="1" id="commercial-checkbox">
                  <label class="form-check-label" for="commercial-checkbox">Show commercial properties only</label>
                </div>

                <div class="mb-3 border-bottom">
                  <label class="form-label"><i class="fas fa-building"></i> Property type</label>
                  <div class="filter-property-type d-flex flex-nowrap overflow-auto pb-3 spbwx8">
                    <input type="radio" class="btn-check" name="type" id="any" autocomplete="off" checked>
                    <label class="btn btn-monochrome btn-sm" for="any">Any</label>

                    <input type="radio" class="btn-check" name="type" id="apartment" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="apartment">Apartment</label>

                    <input type="radio" class="btn-check" name="type" id="villa" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="villa">Villa</label>

                    <input type="radio" class="btn-check" name="type" id="townhouse" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="townhouse">Townhouse</label>
                  </div>
                </div>

                <div class="mb-3 border-bottom">
                  <label class="form-label"><i class="fas fa-money-bill"></i> Price period</label>
                  <div class="filter-property-type pb-3 spbwx8">
                    <input type="radio" class="btn-check" name="period" id="monthly" autocomplete="off" checked>
                    <label class="btn btn-monochrome btn-sm" for="monthly">Monthly</label>

                    <input type="radio" class="btn-check" name="period" id="weekly" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="weekly">Weekly</label>
                  </div>
                </div>

                <div class="mb-3 pb-3 border-bottom">
                  <label class="form-label"><i class="fas fa-money-bill"></i> Price (QAR)</label>
                  <div class="row gx-2">
                    <div class="col">
                      <select class="form-select">
                        <option>From</option>
                      </select>
                    </div>
                    <div class="col">
                      <select class="form-select">
                        <option>To</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="mb-3 border-bottom">
                  <label class="form-label"><i class="fas fa-bed"></i> Bedrooms</label>
                  <div class="filter-property-type d-flex flex-nowrap overflow-auto pb-3 spbwx8">
                    <input type="radio" class="btn-check" name="bedrooms" id="bedAny" autocomplete="off" checked>
                    <label class="btn btn-monochrome btn-sm" for="bedAny">Any</label>

                    <input type="radio" class="btn-check" name="bedrooms" id="bedroom1" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="bedroom1">1 Bedroom</label>

                    <input type="radio" class="btn-check" name="bedrooms" id="bedroom2" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="bedroom2">2 Bedroom</label>

                    <input type="radio" class="btn-check" name="bedrooms" id="bedroom3" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="bedroom3">3 Bedroom</label>

                    <input type="radio" class="btn-check" name="bedrooms" id="bedroom3" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="bedroom4">4 Bedroom</label>

                    <input type="radio" class="btn-check" name="bedrooms" id="bedroom5" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="bedroom4">5 Bedroom</label>

                    <input type="radio" class="btn-check" name="bedrooms" id="bedroom1" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="bedroom6">6+ Bedroom</label>
                  </div>
                </div>

                <div class="mb-3 border-bottom">
                  <label class="form-label"><i class="fas fa-bath"></i> Bathrooms</label>
                  <div class="filter-property-type d-flex flex-nowrap overflow-auto pb-3 spbwx8">
                    <input type="radio" class="btn-check" name="bathrooms" id="bathAny" autocomplete="off" checked>
                    <label class="btn btn-monochrome btn-sm" for="bathAny">Any</label>

                    <input type="radio" class="btn-check" name="bathrooms" id="bathroom1" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="bathroom1">1 Bathroom</label>

                    <input type="radio" class="btn-check" name="bathrooms" id="bathroom2" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="bathroom2">2 Bathroom</label>

                    <input type="radio" class="btn-check" name="bathrooms" id="bathroom3" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="bathroom3">3 Bathroom</label>

                    <input type="radio" class="btn-check" name="bathrooms" id="bathroom4" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="bathroom4">4 Bathroom</label>

                    <input type="radio" class="btn-check" name="bathrooms" id="bathroom5" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="bathroom5">5 Bathroom</label>

                    <input type="radio" class="btn-check" name="bathrooms" id="bathroom6" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="bathroom6">6+ Bathroom</label>
                  </div>
                </div>

                <div class="mb-3 pb-3 border-bottom">
                  <label class="form-label"><i class="fas fa-chart-area"></i> Property Size (sqm)</label>
                  <div class="row gx-2">
                    <div class="col">
                      <select class="form-select">
                        <option>From</option>
                      </select>
                    </div>
                    <div class="col">
                      <select class="form-select">
                        <option>To</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="mb-3 border-bottom">
                  <label class="form-label"><i class="fas fa-couch"></i> Furnishing</label>
                  <div class="filter-property-type d-flex flex-nowrap overflow-auto pb-3 spbwx8">
                    <input type="radio" class="btn-check" name="furnishing" id="allFurnishing" autocomplete="off" checked>
                    <label class="btn btn-monochrome btn-sm" for="allFurnishing">All Furnishing</label>

                    <input type="radio" class="btn-check" name="furnishing" id="furnished" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="furnished">Furnished</label>

                    <input type="radio" class="btn-check" name="furnishing" id="unFurnished" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="unFurnished">Unfurnished</label>

                    <input type="radio" class="btn-check" name="furnishing" id="partlyFurnished" autocomplete="off">
                    <label class="btn btn-monochrome btn-sm" for="partlyFurnished">Partly furnished</label>
                  </div>
                </div>

                <div>
                  <label class="form-label"><i class="fas fa-search"></i> Keywords</label>
                  <input class="form-control" type="text" placeholder="Keywords: e.g. beach, chiller free">
                </div>
              </div>

              <div class="p-3 bg-white border-top sticky-bottom">
                <button class="btn btn-primary w-100">Show 6966 results</button>
              </div>

            </div>
          @endif

          <div class="mb-3">
            <h1 class="h6">Buy And Rent Properties in Qatar <small class="d-block fs-sm fw-normal mt-2">6959
                results</small></h1>
          </div>

          {{-- Short design for desktop and tablet --}}
          @if ((new \Jenssegers\Agent\Agent())->isTablet() || (new \Jenssegers\Agent\Agent())->isDesktop())
            <div>
              <form action="{{ url('properties') }}" name="frmSortBy" id="frmSortBy" class="form-inline form-1" method="get">
                <input type="hidden" name="featured" id="featured" value="{{ request()->get('featured') }}">
                <input type="hidden" name="property_type" value="{{ request()->property_type }}">
                <input type="hidden" name="property_purpose" value="{{ request()->property_purpose }}" />
                <input type="hidden" name="bedrooms" value="{{ request()->bedrooms }}" />
                <input type="hidden" name="bathrooms" value="{{ request()->bathrooms }}" />
                <input type="hidden" name="min_price" value="{{ request()->min_price }}" />
                <input type="hidden" name="max_price" value="{{ request()->max_price }}" />
                <input type="hidden" name="min_area" value="{{ request()->min_area }}" />
                <input type="hidden" name="max_area" value="{{ request()->max_area }}" />
                <input type="hidden" name="furnishings" value="{{ request()->furnishings }}" />
                <input type="hidden" name="keywordextra" value="{{ request()->keywordextra }}" />
                <input type="hidden" name="keyword" value="{{ request()->keyword }}" />
                <input type="hidden" name="keywordMbl" value="{{ request()->keywordMbl }}" />
                <input type="hidden" name="commercial" value="{{ request()->commercial }}" />

                <div class="d-flex align-items-center justify-content-between">
                  <div class="">
                    <input type="checkbox" class="btn-check" id="save-search" autocomplete="off">
                    <label class="btn btn-outline-primary btn-sm" for="save-search"><i class="far fa-star"></i> Save
                      Search</label>
                  </div>
                  {{-- Sort By --}}
                  <div>
                    <div class="form-group d-flex align-items-center spbwx8">
                      <label class="fs-sm">Short by:</label>
                      <div class="short-by">
                        <select name="sort_by" id="sort_by" class="hero__form-input form-select form-select-sm custom-select" onchange="document.getElementById('frmSortBy').submit();">
                          <option value="featured" @if ($request->sort_by == 'featured') selected @endif>
                            Featured
                          </option>
                          <option value="newest" @if ($request->sort_by == 'newest') selected @endif>
                            Newest
                          </option>
                          <option value="low_price" @if ($request->sort_by == 'low_price') selected @endif>
                            Price (Low)
                          </option>
                          <option value="high_price" @if ($request->sort_by == 'high_price') selected @endif>
                            Price (High)
                          </option>
                          <option value="beds_least" @if ($request->sort_by == 'beds_least') selected @endif>
                            Beds (Least)
                          </option>
                          <option value="beds_most" @if ($request->sort_by == 'beds_most') selected @endif>
                            Beds (Most)
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          @endif
        </div>

        <div class="location-wrap">
          <div class="location-item">
            <a href="#!">Apartment <span>(583)</span></a>
          </div>
          <div class="location-item">
            <a href="#!">Apartment <span>(583)</span></a>
          </div>
          <div class="location-item">
            <a href="#!">Apartment <span>(583)</span></a>
          </div>
          <div class="location-item">
            <a href="#!">Apartment <span>(583)</span></a>
          </div>
          <div class="location-item">
            <a href="#!">Apartment <span>(583)</span></a>
          </div>
          <div class="location-item">
            <a href="#!">Apartment <span>(583)</span></a>
          </div>
          <div class="location-item">
            <a href="#!">Apartment <span>(583)</span></a>
          </div>
          <div class="location-item moreLess">
            <a href="#!">Apartment <span>(583)</span></a>
          </div>
          <div class="location-item moreLess">
            <a href="#!">Apartment <span>(583)</span></a>
          </div>
          <div class="location-item moreLess">
            <a href="#!">Apartment <span>(583)</span></a>
          </div>
          <div class="location-item moreLess">
            <a href="#!">Apartment <span>(583)</span></a>
          </div>
          <div class="location-item moreLess">
            <a href="#!">Apartment <span>(583)</span></a>
          </div>
          <div class="location-item">
            <a href="javascript:void(0)" onclick="showLessOrMore()" id="myBtn">
              Show more <i class="fas fa-chevron-down"></i>
            </a>
          </div>
        </div>

        {{-- list view --}}
        <div class="row gx-3">
          <div class="col-lg-9">
            @foreach ($properties as $property)
              @php
                $phone = \App\Properties::getPhoneNumber($property->id);
                $whatsapp = \App\Properties::getWhatsapp($property->id);
                $agency = \App\Agency::where('id', $property->agency_id)->first();
                $propertyUrl = url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id);
                $whatsapText = 'Hello, I would like to inquire about this property posted on saakin.com Reference: ' . $property->refference_code . 'Price: QR' . $property->getPrice() . '/month Type: ' . $property->propertiesTypes->types . ' Location: ' . $property->address . ' Link:' . $propertyUrl;
              @endphp
              <div class="single-property-box horizontal-view">
                {{--  --}}
                <div class="property-item">
                  <div class="pro-slider">
                    <div class="pro-slider-item">
                      <img src="{{ asset('upload/properties/thumb_' . $property->featured_image) }}" alt="{{ $property->property_name }}">
                    </div>

                    @if (count($property->gallery) > 0)
                      @foreach ($property->gallery as $gallery)
                        @if ($loop->index < 5)
                          <div class="pro-slider-item">
                            <img src="{{ asset('upload/gallery/') . '/' . $gallery->image_name }}" alt="{{ $property->property_name }}">
                          </div>
                        @endif
                      @endforeach
                    @endif
                  </div>

                  <ul class="feature_text">
                    @if ($property->featured_property == 1)
                      <li class="feature_cb"><span> Featured </span></li>
                    @endif
                    @if ($property->property_purpose == 1)
                      <li class="feature_or"><span> For Rent </span></li>
                    @elseif($property->property_purpose == 2)
                      <li class="feature_or"><span> For Sale</span></li>
                    @elseif($property->property_purpose != '' || $property->property_purpose != null)
                      <li class="feature_or">
                        <span> {{ $property->property_purpose }}</span>
                      </li>
                    @endif
                  </ul>
                </div>

                {{--  --}}
                <div class="property-title-box">
                  <div class="price">
                    {{ $property->getPrice() }}

                    @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                      / Month
                    @endif
                  </div>
                  <a class="text-decoration-none" href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}">
                    <h5 class="property-card__property-title">
                      {{ $property->property_name }}
                    </h5>
                  </a>
                  <div class="property-location">
                    <i class="fa fa-map-marker-alt"></i>
                    <p>{{ $property->address }}, {{ $property->city }}</p>
                  </div>
                  <ul class="property-feature">
                    @if ($property->getProperty_type())
                      <li><i class="fas fa-bed"></i>
                        <span>{{ $property->bedrooms }} Bedrooms</span>
                      </li>
                      <li><i class="fas fa-bath"></i>
                        <span>{{ $property->bathrooms }} Bath</span>
                      </li>
                    @endif
                    <li><i class="fas fa-chart-area"></i>
                      <span>{{ $property->getSqm() }}</span>
                    </li>

                  </ul>

                  <div class="social-div mt-md-2">
                    @if (!empty($property->whatsapp))
                      <a href="" class="btn btn-outline-primary btn-sm btnCall mt-2" data-telNumber="{{ $property->whatsapp }}">
                        <i class="fas fa-phone-alt"></i>
                        Call Now
                      </a>
                    @else
                      <a href="" class="btn btn-outline-primary btn-sm btnCall mt-2" data-telNumber="{{ $property->Agency->phone }}">
                        <i class="fas fa-phone-alt"></i>
                        Call Now
                      </a>
                    @endif

                    @if (!empty($property->whatsapp))
                      <a href="//api.whatsapp.com/send?phone={{ $property->whatsapp }}&text={{ urlencode($whatsapText) }}" class="btn btn-outline-success btn-sm mt-2">
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp
                      </a>
                    @elseif(!empty($property->Agency->whatsapp))
                      <a href="//api.whatsapp.com/send?phone={{ $property->Agency->whatsapp }}&text={{ urlencode($whatsapText) }}" class="btn btn-outline-success btn-sm mt-2">
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp
                      </a>
                    @endif

                    <button class="btn btn-outline-primary btn-sm mt-2" type="button" data-toggle="modal" data-target="#exampleModal" id="emailBtn"
                      data-image="{{ asset('upload/properties/' . $property->featured_image) }}" data-title="{{ $property->property_name }}"
                      data-agent="{{ $property->agent_name ?? $property->Agency->name }}" data-broker="{{ $property->Agency->name ?? '' }}" data-bedroom="{{ $property->bedrooms ?? '' }}"
                      data-bathroom="{{ $property->bathrooms ?? '' }}" data-area="{{ $property->getSqm() ?? '' }}">
                      <i class="fas fa-envelope"></i>
                      Email Now
                    </button>
                  </div>
                </div>
                @if ((new \Jenssegers\Agent\Agent())->isTablet() || (new \Jenssegers\Agent\Agent())->isDesktop())
                  <div class="property-card-extra p-3 d-none d-md-block">
                    <div class="property-type">Premium</div>
                    <div>
                      <img src="{{ asset('upload/properties/thumb_' . $property->featured_image) }}" alt="{{ $property->property_name }}" width="110">
                    </div>
                  </div>
                @endif
              </div>
            @endforeach

            {{-- Pagination starts --}}
            <div>
              @if ($properties->total() > getcong('pagination_limit'))
                {{ $properties->links('front-view.pages.include.pagination') }}
              @endif
            </div>
            {{-- Pagination ends --}}
          </div>

          <div class="col-lg-3">
            <div class="list-sidebar mt-3 mt-lg-0">
              <div class="sidebar-links p-3">
                <h6>What is Lorem Ipsum?</h6>
                <ul>
                  <li><a href="#!">Luxury 2 Bed Apt. For Rent in Medina</a></li>
                  <li><a href="#!">Luxury 2 Bed Apt. For Rent in Medina</a></li>
                  <li><a href="#!">Luxury 2 Bed Apt. For Rent in Medina</a></li>
                  <li><a href="#!">Luxury 2 Bed Apt. For Rent in Medina</a></li>
                  <li><a href="#!">Luxury 2 Bed Apt. For Rent in Medina</a></li>
                </ul>
              </div>
              <div class="sidebar-links p-3">
                <h6>What is Lorem Ipsum?</h6>
                <ul>
                  <li><a href="#!">Luxury 2 Bed Apt. For Rent in Medina</a></li>
                  <li><a href="#!">Luxury 2 Bed Apt. For Rent in Medina</a></li>
                  <li><a href="#!">Luxury 2 Bed Apt. For Rent in Medina</a></li>
                  <li><a href="#!">Luxury 2 Bed Apt. For Rent in Medina</a></li>
                  <li><a href="#!">Luxury 2 Bed Apt. For Rent in Medina</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      @else
        <div class="alert alert-info" role="alert">
          Record Not Found!
        </div>

      @endif

      <div class="mt-3">
        @if ($properties->onFirstPage())
          {!! $landing_page_content->page_content !!}
        @endif
      </div>

    </div>
  </div>

@endsection

@push('styles')
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick.css') }}" />
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick-theme.css') }}" />
@endpush


@push('scripts')
  <script type="text/javascript" src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      $('.js-dropdown .dropdown-menu').click(function(e) {
        e.stopPropagation();
      });

      $(".pro-slider").slick({
        arrows: false,
        dots: true
      });
    });

    let click = 0;
    var elements = document.getElementsByClassName("btnCall");

    var myFunction = function() {
      var attribute = this.getAttribute("data-telNumber");
      this.innerText = attribute;
      // this.href = "tel:"+attribute;
      if (click == 0) {
        this.href = "javaScript:void();";
        click++;
      } else {
        this.href = "tel:" + attribute;
        click = 0;

      }
    };

    for (var i = 0; i < elements.length; i++) {
      elements[i].addEventListener('click', myFunction, false);
    }

    function FormSubmit(coming) {
      var value = coming.value;
      $("#sort_by").val(value);
      document.getElementById('frmSortBy').submit();
    }

    function openNav() {
      document.getElementById("mySidebar").style.width = "80%";
    }

    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";

    }

    function showLessOrMore() {
      var btnText = document.getElementById("myBtn");
      var elems = document.getElementsByClassName('moreLess');

      if (btnText.innerHTML == 'Show Less <i class="fas fa-chevron-up"></i>') {
        btnText.innerHTML = 'Show More <i class="fas fa-chevron-down"></i>'
        for (var i = 0; i < elems.length; i += 1) {
          elems[i].style.display = 'none';
        }
      } else {
        btnText.innerHTML = 'Show Less <i class="fas fa-chevron-up"></i>'
        for (var i = 0; i < elems.length; i += 1) {
          elems[i].style.display = 'block';
        }
      }
    }
  </script>
@endpush