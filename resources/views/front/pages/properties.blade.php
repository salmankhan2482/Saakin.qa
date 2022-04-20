@extends("front-view.layouts.main")
@if ($landing_page_content != null)

@section('title', $landing_page_content->meta_title . ' | '.' Saakin.qa')
@section('description', $landing_page_content->meta_description)
@section('keyword', $landing_page_content->meta_keyword)
@section('type','property')
@section('url',url()->current())

@else

@section('title','Properties in Qatar | Saakin.qa')
@section('description',$page_des)
@section('type','property')
@section('url',url()->current())

@endif

@section('content')


    <div class="filter-wrap">
        <div class="container">
            <form action="{{ url('properties') }}" class="hero__form v2 filter" method="get">
                <input type="hidden" name="featured" id="featured" value="{{ request()->featured }}">
                <div class="search-filter flex-nowrap flex-sm-wrap flex-xl-nowrap">

                    <div class="flex-grow-1 country-list-wrap me-2">
                        <div class="input-group-overlay input-search">
                            <div class="input-group-prepend-overlay">
                                <span class="input-group-text"> <i class="fa fa-search"></i> </span>
                            </div>

                            <input type="text" id="country" data-purpose="" placeholder="Search Location"
                                class="form-control prepended-form-control" autocomplete="off" aria-label="Search Location"
                                aria-describedby="country" value="{{ $data['keyword'] ?? '' }}">
                        </div>
                        <div id="country_list" class="country-list scroll-y col-md-12 col-12"></div>
                        <div id="extra_keywords" style="display: none;">
                            <input type="hidden" id="city_id" name="city" value="{{ request('city') }}">
                            <input type="hidden" id="sub_city_id" name="subcity" value="{{ request('subcity') }}">
                            <input type="hidden" id="town_id" name="town" value="{{ request('town') }}">
                            <input type="hidden" id="area_id" name="area" value="{{ request('area') }}">
                        </div>
                    </div>


                    @if ((new \Jenssegers\Agent\Agent())->isTablet() || (new \Jenssegers\Agent\Agent())->isDesktop())
                        <div class="d-flex spbwx8 order-3 order-xl-2 mt-2 mt-xl-0 me-xl-2">
                            <div class="">
                                <select name="property_purpose" id="property_purpose"
                                    class="hero__form-input form-select custom-select @isset($request->property_purpose) active-search @endisset"
                                    onchange="setPropertyPurpose(value)">

                                    <option value="" selected>Property Purpose</option>
                                    @foreach ($propertyPurposes as $propertyPurpose)
                                        <option value="{{ $propertyPurpose->name }}"
                                            @if (ucfirst($request->property_purpose) == $propertyPurpose->name) selected @endif>
                                            {{ $propertyPurpose->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="">
                                <select name="property_type" id="property_type" onchange="setPropertyType(this)"
                                    class="hero__form-input form-select custom-select @isset($request->property_type) active-search @endisset">
                                    <option value="" selected>All Type</option>
                                    @foreach ($propertyTypes as $propertyType)
                                        <option value="{{ $propertyType->id }}"
                                            @if ($request->property_type == $propertyType->id) selected @endif>
                                            {{ $propertyType->types }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <div class="dropdown js-dropdown">
                                    <div type="button" id="pricedropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        class="form-select dropdown-toggle minMaxDiv  @if (isset($request->min_price) or isset($request->max_price)) active-search @endif">
                                        Price
                                    </div>
                                    <div class="dropdown-menu price-dropdown" aria-labelledby="pricedropdownMenuButton">
                                        <div class="d-flex align-items-center spbwx8">
                                            <div class="flex-grow-1">
                                                <select name="min_price"
                                                    class="hero__form-input form-control custom-select">
                                                    <option {{ $request->min_price == '' ? 'selected' : '' }} value="">
                                                        Min
                                                        Price</option>
                                                    <option {{ $request->min_price == '5000' ? 'selected' : '' }}
                                                        value="5000">
                                                        QAR 5,000</option>
                                                    <option {{ $request->min_price == '10000' ? 'selected' : '' }}
                                                        value="10000">QAR
                                                        10,000</option>
                                                    <option {{ $request->min_price == '15000' ? 'selected' : '' }}
                                                        value="10000">QAR
                                                        15,000</option>
                                                    <option {{ $request->min_price == '20000' ? 'selected' : '' }}
                                                        value="20000">QAR
                                                        20,000</option>
                                                    <option {{ $request->min_price == '25000' ? 'selected' : '' }}
                                                        value="25000">QAR
                                                        25,000</option>
                                                    <option {{ $request->min_price == '30000' ? 'selected' : '' }}
                                                        value="30000">QAR
                                                        30,000</option>
                                                    <option {{ $request->min_price == '40000' ? 'selected' : '' }}
                                                        value="40000">QAR
                                                        40,000</option>
                                                    <option {{ $request->min_price == '50000' ? 'selected' : '' }}
                                                        value="50000">QAR
                                                        50,000</option>
                                                    <option {{ $request->min_price == '60000' ? 'selected' : '' }}
                                                        value="60000">QAR
                                                        60,000</option>
                                                    <option {{ $request->min_price == '70000' ? 'selected' : '' }}
                                                        value="70000">QAR
                                                        70,000</option>
                                                    <option {{ $request->min_price == '90000' ? 'selected' : '' }}
                                                        value="90000">QAR
                                                        90,000</option>
                                                    <option {{ $request->min_price == '100000' ? 'selected' : '' }}
                                                        value="100000">QAR
                                                        100,000</option>
                                                    <option {{ $request->min_price == '125000' ? 'selected' : '' }}
                                                        value="125000">QAR
                                                        1,25,000</option>
                                                    <option {{ $request->min_price == '150000' ? 'selected' : '' }}
                                                        value="150000">QAR
                                                        1,50,000</option>
                                                </select>
                                            </div>
                                            <div class="">
                                                <span class="separator">-</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <select name="max_price"
                                                    class="hero__form-input form-control custom-select">
                                                    <option {{ $request->max_price == '' ? 'selected' : '' }} value="">
                                                        Max
                                                        Price</option>
                                                    <option {{ $request->max_price == '5000' ? 'selected' : '' }}
                                                        value="5000">QAR 5,000
                                                    </option>
                                                    <option {{ $request->max_price == '10000' ? 'selected' : '' }}
                                                        value="10000">QAR
                                                        10,000</option>
                                                    <option {{ $request->max_price == '15000' ? 'selected' : '' }}
                                                        value="15000">QAR
                                                        15,000</option>
                                                    <option {{ $request->max_price == '20000' ? 'selected' : '' }}
                                                        value="20000">QAR
                                                        20,000</option>
                                                    <option {{ $request->max_price == '25000' ? 'selected' : '' }}
                                                        value="25000">QAR
                                                        25,000</option>
                                                    <option {{ $request->max_price == '30000' ? 'selected' : '' }}
                                                        value="30000">QAR
                                                        30,000</option>
                                                    <option {{ $request->max_price == '40000' ? 'selected' : '' }}
                                                        value="40000">QAR
                                                        40,000</option>
                                                    <option {{ $request->max_price == '50000' ? 'selected' : '' }}
                                                        value="50000">QAR
                                                        50,000</option>
                                                    <option {{ $request->max_price == '60000' ? 'selected' : '' }}
                                                        value="60000">QAR
                                                        60,000</option>
                                                    <option {{ $request->max_price == '70000' ? 'selected' : '' }}
                                                        value="70000">QAR
                                                        70,000</option>
                                                    <option {{ $request->max_price == '90000' ? 'selected' : '' }}
                                                        value="90000">QAR
                                                        90,000</option>
                                                    <option {{ $request->max_price == '100000' ? 'selected' : '' }}
                                                        value="100000">QAR
                                                        100,000</option>
                                                    <option {{ $request->max_price == '125000' ? 'selected' : '' }}
                                                        value="125000">QAR
                                                        1,25,000</option>
                                                    <option {{ $request->max_price == '150000' ? 'selected' : '' }}
                                                        value="150000">QAR
                                                        1,50,000</option>
                                                    <option {{ $request->max_price == '250000' ? 'selected' : '' }}
                                                        value="250000">QAR
                                                        2,50,000</option>
                                                    <option {{ $request->max_price == '450000' ? 'selected' : '' }}
                                                        value="450000">QAR
                                                        4,50,000</option>
                                                    <option {{ $request->max_price == '850000' ? 'selected' : '' }}
                                                        value="850000">QAR
                                                        8,50,000</option>
                                                    <option {{ $request->max_price == '1000000' ? 'selected' : '' }}
                                                        value="1000000">QAR
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
                                    <div type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        class="form-select dropdown-toggle minMaxArea @if (isset($request->min_area) or isset($request->max_area)) active-search @endif">
                                        Area
                                    </div>
                                    <div class="dropdown-menu price-dropdown" id="dropdownMenuButton"
                                        aria-labelledby="dropdownMenuButton">
                                        <div class="d-flex spbwx8 align-items-center">
                                            <div class="flex-grow-1">
                                                <select name="min_area"
                                                    class="hero__form-input  form-control custom-select">
                                                    <option @if ($request->min_area == '') selected @endif value="">
                                                        Min Area
                                                    </option>
                                                    <option @if ($request->min_area == '50') selected @endif value="50">
                                                        50 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '100') selected @endif value="100">
                                                        100 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '200') selected @endif value="200">
                                                        200 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '500') selected @endif value="500">
                                                        500 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '600') selected @endif value="600">
                                                        600 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '700') selected @endif value="700">
                                                        700 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '800') selected @endif value="800">
                                                        800 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '900') selected @endif value="900">
                                                        900 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1000') selected @endif
                                                        value="1000">
                                                        1000 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1100') selected @endif
                                                        value="1100">
                                                        1100 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1200') selected @endif
                                                        value="1200">
                                                        1200 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1300') selected @endif
                                                        value="1300">
                                                        1300 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1400') selected @endif
                                                        value="1400">
                                                        1400 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1500') selected @endif
                                                        value="1500">
                                                        1500 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1600') selected @endif
                                                        value="1600">
                                                        1600 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1700') selected @endif
                                                        value="1700">
                                                        1700 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1800') selected @endif
                                                        value="1800">
                                                        1800 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1900') selected @endif
                                                        value="1900">
                                                        1900 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '2000') selected @endif
                                                        value="2000">
                                                        2000 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '2500') selected @endif
                                                        value="2500">
                                                        2500 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '3000') selected @endif
                                                        value="3000">
                                                        3000 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '4000') selected @endif
                                                        value="4000">
                                                        4000 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '5000') selected @endif
                                                        value="5000">
                                                        5000 sqm
                                                    </option>
                                                </select>
                                            </div>
                                            <div>
                                                <span class="separator">-</span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <select name="max_area"
                                                    class="hero__form-input  form-control custom-select">
                                                    <option @if ($request->max_area == '') selected @endif value="">
                                                        Max Area
                                                    </option>
                                                    <option @if ($request->max_area == '50') selected @endif value="50">
                                                        50 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '100') selected @endif value="100">
                                                        100 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '200') selected @endif value="200">
                                                        200 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '500') selected @endif value="500">
                                                        500 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '600') selected @endif value="600">
                                                        600 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '700') selected @endif value="700">
                                                        700 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '800') selected @endif value="800">
                                                        800 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '900') selected @endif value="900">
                                                        900 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1000') selected @endif
                                                        value="1000">
                                                        1000 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1100') selected @endif
                                                        value="1100">
                                                        1100 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1200') selected @endif
                                                        value="1200">
                                                        1200 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1300') selected @endif
                                                        value="1300">
                                                        1300 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1400') selected @endif
                                                        value="1400">
                                                        1400 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1500') selected @endif
                                                        value="1500">
                                                        1500 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1600') selected @endif
                                                        value="1600">
                                                        1600 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1700') selected @endif
                                                        value="1700">
                                                        1700 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1800') selected @endif
                                                        value="1800">
                                                        1800 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1900') selected @endif
                                                        value="1900">
                                                        1900 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '2000') selected @endif
                                                        value="2000">
                                                        2000 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '2500') selected @endif
                                                        value="2500">
                                                        2500 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '3000') selected @endif
                                                        value="3000">
                                                        3000 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '4000') selected @endif
                                                        value="4000">
                                                        4000 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '5000') selected @endif
                                                        value="5000">
                                                        5000 sqm
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>

                                <input type="hidden" name="bedrooms" id="bedroomInput"
                                    value="{{ request('bedrooms') ?? '' }}">
                                <input type="hidden" name="bathrooms" id="bathroomInput"
                                    value="{{ request('bathrooms') ?? '' }}">

                                <div class="dropdown js-dropdown">
                                    <div type="button" id="beddropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        class="form-select dropdown-toggle bedbathdrop @if (isset($request->bedrooms) or isset($request->bathrooms)) active-search @endif">
                                        Beds & Baths
                                    </div>
                                    <div class="dropdown-menu px-2 custom-dropdown" id="beddropdownMenuButton"
                                        aria-labelledby="dropdownMenuButton">
                                        <h6>Bedrooms</h6>
                                        <div class="d-flex spbwx8 mb-3">
                                            <li class="dropdown-item item-in-line bedrooms {{ request('bedrooms') == '' ? 'bg-info' : '' }}"
                                                onclick="bedrooms(this);" data-value=""> Any
                                            </li>
                                            <li class="dropdown-item item-in-line bedrooms {{ request('bedrooms') == '1' ? 'bg-info' : '' }}"
                                                onclick="bedrooms(this);" data-value="1">1
                                            </li>
                                            <li class="dropdown-item item-in-line bedrooms {{ request('bedrooms') == '2' ? 'bg-info' : '' }}"
                                                onclick="bedrooms(this);" data-value="2">2
                                            </li>

                                            <li class="dropdown-item item-in-line bedrooms{{ request('bedrooms') == '3' ? 'bg-info' : '' }}"
                                                onclick="bedrooms(this);" data-value="3">3
                                            </li>
                                            <li class="dropdown-item item-in-line bedrooms {{ request('bedrooms') == '4' ? 'bg-info' : '' }}"
                                                onclick="bedrooms(this);" data-value="4">4
                                            </li>
                                            <li class="dropdown-item item-in-line bedrooms {{ request('bedrooms') == '5' ? 'bg-info' : '' }}"
                                                onclick="bedrooms(this);" data-value="5">5
                                            </li>
                                            <li class="dropdown-item item-in-line bedrooms {{ request('bedrooms') == '6+' ? 'bg-info' : '' }}"
                                                onclick="bedrooms(this);" data-value="6+">6+
                                            </li>
                                        </div>

                                        <div class="mb-3">
                                            <input type="checkbox" name="exact_bedrooms" value="1"> Use exact values
                                        </div>

                                        <div class="mb-3">
                                            <h6>Bathrooms</h6>
                                            <div class="d-flex spbwx8">
                                                <li class="dropdown-item item-in-line bathrooms {{ request('bathrooms') == '' ? 'bg-info' : '' }}"
                                                    onclick="bathrooms(this);" data-value=""> Any
                                                </li>

                                                <li class="dropdown-item item-in-line bathrooms {{ request('bathrooms') == '1' ? 'bg-info' : '' }}"
                                                    onclick="bathrooms(this);" data-value="1"> 1
                                                </li>

                                                <li class="dropdown-item item-in-line bathrooms {{ request('bathrooms') == '2' ? 'bg-info' : '' }}"
                                                    onclick="bathrooms(this);" data-value="2"> 2
                                                </li>

                                                <li class="dropdown-item item-in-line bathrooms {{ request('bathrooms') == '3' ? 'bg-info' : '' }}"
                                                    onclick="bathrooms(this);" data-value="3"> 3
                                                </li>

                                                <li class="dropdown-item item-in-line bathrooms {{ request('bathrooms') == '4' ? 'bg-info' : '' }}"
                                                    onclick="bathrooms(this);" data-value="4"> 4
                                                </li>

                                                <li class="dropdown-item item-in-line bathrooms {{ request('bathrooms') == '5' ? 'bg-info' : '' }}"
                                                    onclick="bathrooms(this);" data-value="5"> 5
                                                </li>

                                                <li class="dropdown-item item-in-line bathrooms {{ request('bathrooms') == '6+' ? 'bg-info' : '' }}"
                                                    onclick="bathrooms(this);" data-value="6+"> 6+
                                                </li>
                                            </div>
                                        </div>
                                        <div class="">
                                            <input type="checkbox" name="exact_bathrooms" value="1"> Use exact values
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="flex-grow-1">
                                <select name="furnishings"
                                    class="hero__form-input form-select custom-select @if (isset($request->furnishings)) active-search @endif">
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
                        </div>

                    @endif

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
                                <button type="button" data-bs-toggle="offcanvas" data-bs-target="#mSearchFilter"
                                    aria-controls="mSearchFilter" class="btn btn-monochrome btn-sm w-100"
                                    style="--btn-bg-color: transparent;">
                                    <i class="fas fa-sliders-h"></i>
                                    Filters
                                </button>
                            </div>
                            <div class="col">
                                <button type="button" data-bs-toggle="offcanvas" data-bs-target="#mSortingModal"
                                    aria-controls="mSortingModal" class="btn btn-monochrome btn-sm w-100"
                                    style="--btn-bg-color: transparent;">
                                    <i class="fas fa-sliders-h"></i>
                                    Sort By
                                </button>
                            
                            </div>
                        </div>
                        {{-- Mobile Filters --}}
                        <form action="{{ url('properties') }}" method="GET">
                            <div class="offcanvas offcanvas-top mSearchFilter" tabindex="-2" id="mSearchFilter"
                                aria-labelledby="mSearchFilterLabel">
                                <div class="offcanvas-header border-bottom">
                                    <h5 class="offcanvas-title" id="mSearchFilterLabel" data-bs-dismiss="offcanvas"
                                        aria-label="Close"><i class="fas fa-times"></i>
                                        Filters
                                    </h5>
                                </div>

                                <div class="offcanvas-body">
                                    <div class="btn-group btn-group-sm d-flex" role="group" aria-label="Sell type">

                                        <input type="radio" class="btn-check" name="property_purpose" id="btnRent"
                                            value="Rent" {{ request('property_purpose') != 'Sale' ? 'checked' : '' }}>
                                        <label class="btn btn-monochrome btn-sm" for="btnRent">Rent</label>

                                        <input type="radio" class="btn-check" name="property_purpose" id="btnSale"
                                            value="Sale" {{ request('property_purpose') == 'Sale' ? 'checked' : '' }}>
                                        <label class="btn btn-monochrome btn-sm" for="btnSale">Buy</label>

                                    </div>

                                    <div class="mb-3 border-bottom mt-2">
                                        <label class="form-label"><i class="fas fa-building"></i> Property Type</label>
                                        <div class="filter-property-type d-flex flex-nowrap overflow-auto pb-3 spbwx8">

                                            @foreach ($propertyTypes as $pt)
                                                <input type="radio" class="btn-check" name="property_type"
                                                    id="ptAny{{ $pt->id }}" value="{{ $pt->id }}"
                                                    {{ request('property_type') == $pt->id ? 'checked' : '' }}>
                                                <label class="btn btn-monochrome btn-sm" for="ptAny{{ $pt->id }}">
                                                    {{ $pt->types }}
                                                </label>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="mb-3 pb-3 border-bottom">
                                        <label class="form-label"><i class="fas fa-money-bill"></i>
                                            Price (QAR)
                                        </label>
                                        <div class="row gx-2">
                                            <div class="col">
                                                <select name="min_price" class="form-control">
                                                    <option {{ $request->min_price == '' ? 'selected' : '' }} value="">
                                                        Min Price
                                                    </option>
                                                    <option {{ $request->min_price == '5000' ? 'selected' : '' }}
                                                        value="5000"> QAR 5,000</option>
                                                    <option {{ $request->min_price == '10000' ? 'selected' : '' }}
                                                        value="10000">QAR 10,000</option>
                                                    <option {{ $request->min_price == '15000' ? 'selected' : '' }}
                                                        value="10000">QAR 15,000</option>
                                                    <option {{ $request->min_price == '20000' ? 'selected' : '' }}
                                                        value="20000">QAR 20,000</option>
                                                    <option {{ $request->min_price == '25000' ? 'selected' : '' }}
                                                        value="25000">QAR 25,000</option>
                                                    <option {{ $request->min_price == '30000' ? 'selected' : '' }}
                                                        value="30000">QAR 30,000</option>
                                                    <option {{ $request->min_price == '40000' ? 'selected' : '' }}
                                                        value="40000">QAR 40,000</option>
                                                    <option {{ $request->min_price == '50000' ? 'selected' : '' }}
                                                        value="50000">QAR 50,000</option>
                                                    <option {{ $request->min_price == '60000' ? 'selected' : '' }}
                                                        value="60000">QAR 60,000</option>
                                                    <option {{ $request->min_price == '70000' ? 'selected' : '' }}
                                                        value="70000">QAR 70,000</option>
                                                    <option {{ $request->min_price == '90000' ? 'selected' : '' }}
                                                        value="90000">QAR 90,000</option>
                                                    <option {{ $request->min_price == '100000' ? 'selected' : '' }}
                                                        value="100000">QAR 100,000</option>
                                                    <option {{ $request->min_price == '125000' ? 'selected' : '' }}
                                                        value="125000">QAR 1,25,000</option>
                                                    <option {{ $request->min_price == '150000' ? 'selected' : '' }}
                                                        value="150000">QAR 1,50,000</option>

                                                </select>
                                            </div>
                                            <div class="col">
                                                <select name="max_price" class="form-control">
                                                    <option {{ $request->max_price == '' ? 'selected' : '' }} value="">
                                                        Max Price</option>
                                                    <option {{ $request->max_price == '5000' ? 'selected' : '' }}
                                                        value="5000">QAR 5,000</option>
                                                    <option {{ $request->max_price == '10000' ? 'selected' : '' }}
                                                        value="10000">QAR 10,000</option>
                                                    <option {{ $request->max_price == '15000' ? 'selected' : '' }}
                                                        value="15000">QAR 15,000</option>
                                                    <option {{ $request->max_price == '20000' ? 'selected' : '' }}
                                                        value="20000">QAR 20,000</option>
                                                    <option {{ $request->max_price == '25000' ? 'selected' : '' }}
                                                        value="25000">QAR 25,000</option>
                                                    <option {{ $request->max_price == '30000' ? 'selected' : '' }}
                                                        value="30000">QAR 30,000</option>
                                                    <option {{ $request->max_price == '40000' ? 'selected' : '' }}
                                                        value="40000">QAR 40,000</option>
                                                    <option {{ $request->max_price == '50000' ? 'selected' : '' }}
                                                        value="50000">QAR 50,000</option>
                                                    <option {{ $request->max_price == '60000' ? 'selected' : '' }}
                                                        value="60000">QAR 60,000</option>
                                                    <option {{ $request->max_price == '70000' ? 'selected' : '' }}
                                                        value="70000">QAR 70,000</option>
                                                    <option {{ $request->max_price == '90000' ? 'selected' : '' }}
                                                        value="90000">QAR 90,000</option>
                                                    <option {{ $request->max_price == '100000' ? 'selected' : '' }}
                                                        value="100000">QAR 100,000</option>
                                                    <option {{ $request->max_price == '125000' ? 'selected' : '' }}
                                                        value="125000">QAR 1,25,000</option>
                                                    <option {{ $request->max_price == '150000' ? 'selected' : '' }}
                                                        value="150000">QAR 1,50,000</option>
                                                    <option {{ $request->max_price == '250000' ? 'selected' : '' }}
                                                        value="250000">QAR 2,50,000</option>
                                                    <option {{ $request->max_price == '450000' ? 'selected' : '' }}
                                                        value="450000">QAR 4,50,000</option>
                                                    <option {{ $request->max_price == '850000' ? 'selected' : '' }}
                                                        value="850000">QAR 8,50,000</option>
                                                    <option {{ $request->max_price == '1000000' ? 'selected' : '' }}
                                                        value="1000000">QAR 1,00,0000</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 border-bottom">
                                        <label class="form-label"><i class="fas fa-bed"></i> Bedrooms</label>
                                        <div class="filter-property-type d-flex flex-nowrap overflow-auto pb-3 spbwx8">

                                            <input type="radio" class="btn-check" name="bedrooms" id="bedAny" value=""
                                                {{ request('bedrooms') == '' ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bedAny">Any</label>

                                            <input type="radio" class="btn-check" name="bedrooms" id="bedroom1"
                                                value="1" {{ request('bedrooms') == '1' ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bedroom1">1</label>

                                            <input type="radio" class="btn-check" name="bedrooms" id="bedroom2"
                                                value="2" {{ request('bedrooms') == '2' ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bedroom2">2</label>

                                            <input type="radio" class="btn-check" name="bedrooms" id="bedroom3"
                                                value="3" {{ request('bedrooms') == '3' ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bedroom3">3</label>

                                            <input type="radio" class="btn-check" name="bedrooms" id="bedroom4"
                                                value="4" {{ request('bedrooms') == '4' ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bedroom4">4</label>

                                            <input type="radio" class="btn-check" name="bedrooms" id="bedroom5"
                                                value="5" {{ request('bedrooms') == '5' ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bedroom5">5</label>

                                            <input type="radio" class="btn-check" name="bedrooms" id="bedroom6"
                                                value="6+" {{ request('bedrooms') == '6+' ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bedroom6">6+</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 border-bottom">
                                        <label class="form-label"><i class="fas fa-bath"></i> Bathrooms</label>
                                        <div class="filter-property-type d-flex flex-nowrap overflow-auto pb-3 spbwx8">

                                            <input type="radio" class="btn-check" name="bathrooms" id="bathAny"
                                                value="" {{ request('bathrooms') == '' ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bathAny">Any</label>

                                            <input type="radio" class="btn-check" name="bathrooms" id="bathroom1"
                                                value="1" {{ request('bathrooms') == 1 ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bathroom1">1</label>

                                            <input type="radio" class="btn-check" name="bathrooms" id="bathroom2"
                                                value="2" {{ request('bathrooms') == 2 ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bathroom2">2</label>

                                            <input type="radio" class="btn-check" name="bathrooms" id="bathroom3"
                                                value="3" {{ request('bathrooms') == 3 ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bathroom3">3</label>

                                            <input type="radio" class="btn-check" name="bathrooms" id="bathroom4"
                                                value="4" {{ request('bathrooms') == 4 ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bathroom4">4</label>

                                            <input type="radio" class="btn-check" name="bathrooms" id="bathroom5"
                                                value="5" {{ request('bathrooms') == 5 ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bathroom5">5</label>

                                            <input type="radio" class="btn-check" name="bathrooms" id="bathroom6"
                                                value="6+" {{ request('bathrooms') == '6+' ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="bathroom6">6+</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 pb-3 border-bottom">
                                        <label class="form-label"><i class="fas fa-chart-area"></i>
                                            Property Size (sqm)
                                        </label>
                                        <div class="row gx-2">
                                            <div class="col">
                                                <select name="min_area" class="form-control">
                                                    <option @if ($request->min_area == '') selected @endif value="">
                                                        Min Area
                                                    </option>
                                                    <option @if ($request->min_area == '50') selected @endif value="50">
                                                        50 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '100') selected @endif value="100">
                                                        100 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '200') selected @endif value="200">
                                                        200 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '500') selected @endif value="500">
                                                        500 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '600') selected @endif value="600">
                                                        600 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '700') selected @endif value="700">
                                                        700 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '800') selected @endif value="800">
                                                        800 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '900') selected @endif value="900">
                                                        900 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1000') selected @endif
                                                        value="1000">
                                                        1000 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1100') selected @endif
                                                        value="1100">
                                                        1100 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1200') selected @endif
                                                        value="1200">
                                                        1200 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1300') selected @endif
                                                        value="1300">
                                                        1300 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1400') selected @endif
                                                        value="1400">
                                                        1400 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1500') selected @endif
                                                        value="1500">
                                                        1500 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1600') selected @endif
                                                        value="1600">
                                                        1600 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1700') selected @endif
                                                        value="1700">
                                                        1700 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1800') selected @endif
                                                        value="1800">
                                                        1800 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '1900') selected @endif
                                                        value="1900">
                                                        1900 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '2000') selected @endif
                                                        value="2000">
                                                        2000 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '2500') selected @endif
                                                        value="2500">
                                                        2500 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '3000') selected @endif
                                                        value="3000">
                                                        3000 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '4000') selected @endif
                                                        value="4000">
                                                        4000 sqm
                                                    </option>
                                                    <option @if ($request->min_area == '5000') selected @endif
                                                        value="5000">
                                                        5000 sqm
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select name="max_area" class="form-control">
                                                    <option @if ($request->max_area == '') selected @endif value="">
                                                        Max Area
                                                    </option>
                                                    <option @if ($request->max_area == '50') selected @endif value="50">
                                                        50 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '100') selected @endif value="100">
                                                        100 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '200') selected @endif value="200">
                                                        200 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '500') selected @endif value="500">
                                                        500 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '600') selected @endif value="600">
                                                        600 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '700') selected @endif value="700">
                                                        700 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '800') selected @endif value="800">
                                                        800 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '900') selected @endif value="900">
                                                        900 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1000') selected @endif
                                                        value="1000">
                                                        1000 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1100') selected @endif
                                                        value="1100">
                                                        1100 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1200') selected @endif
                                                        value="1200">
                                                        1200 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1300') selected @endif
                                                        value="1300">
                                                        1300 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1400') selected @endif
                                                        value="1400">
                                                        1400 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1500') selected @endif
                                                        value="1500">
                                                        1500 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1600') selected @endif
                                                        value="1600">
                                                        1600 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1700') selected @endif
                                                        value="1700">
                                                        1700 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1800') selected @endif
                                                        value="1800">
                                                        1800 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '1900') selected @endif
                                                        value="1900">
                                                        1900 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '2000') selected @endif
                                                        value="2000">
                                                        2000 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '2500') selected @endif
                                                        value="2500">
                                                        2500 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '3000') selected @endif
                                                        value="3000">
                                                        3000 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '4000') selected @endif
                                                        value="4000">
                                                        4000 sqm
                                                    </option>
                                                    <option @if ($request->max_area == '5000') selected @endif
                                                        value="5000">
                                                        5000 sqm
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 border-bottom">
                                        <label class="form-label"><i class="fas fa-couch"></i> Furnishing</label>
                                        <div class="filter-property-type d-flex flex-nowrap overflow-auto pb-3 spbwx8">

                                            <input type="radio" class="btn-check" name="furnishings" id="furnished"
                                                value="109" {{ request('furnishings') == 109 ? 'checked' : '' }}>
                                            <label for="furnished" class="btn btn-monochrome btn-sm">
                                                Furnished
                                            </label>

                                            <input type="radio" class="btn-check" name="furnishings" id="unFurnished"
                                                value="120" {{ request('furnishings') == 120 ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="unFurnished">
                                                Unfurnished
                                            </label>

                                            <input type="radio" class="btn-check" name="furnishings"
                                                id="partlyFurnished" value="101"
                                                {{ request('furnishings') == 101 ? 'checked' : '' }}>
                                            <label class="btn btn-monochrome btn-sm" for="partlyFurnished">
                                                Partly furnished
                                            </label>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label"><i class="fas fa-search"></i> Keywords</label>
                                        <input class="form-control" type="text"
                                            placeholder="Keywords: e.g. beach, chiller free">
                                    </div>
                                </div>

                                <div class="p-3 bg-white border-top sticky-bottom">
                                    <input type="submit" class="btn btn-info form-control d-block fs-sm fw-normal mt-2"
                                        value="Search">
                                </div>

                            </div>
                        </form>
                        
                        <div class="offcanvas offcanvas-top mSearchFilter" tabindex="-2" id="mSortingModal" aria-labelledby="mSearchFilterLabel" style="height: 60vh !important;">
                            <form action="{{ url("properties") }}" method="GET">
                                
                                <input type="hidden" name="city" value="{{ request('city') }}">
                                <input type="hidden" name="subcity" value="{{ request('subcity') }}">
                                <input type="hidden" name="town" value="{{ request('town') }}">
                                <input type="hidden" name="area" value="{{ request('area') }}">
                                <input type="hidden" name="property_purpose" value="{{ request('property_purpose') }}">
                                <input type="hidden" name="property_type" value="{{ request('property_type') }}">
                                <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                                <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                                <input type="hidden" name="min_area" value="{{ request('min_area') }}">
                                <input type="hidden" name="max_area" value="{{ request('max_area') }}">
                                <input type="hidden" name="bedrooms" value="{{ request('bedrooms') }}">
                                <input type="hidden" name="bathrooms" value="{{ request('bathrooms') }}">
                                <input type="hidden" name="furnishings" value="{{ request('furnishings') }}">
                                
                                <div class="offcanvas-header border-bottom">
                                    <h5 class="offcanvas-title" id="mSearchFilterLabel" data-bs-dismiss="offcanvas" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                        Sorting
                                    </h5>
                                </div>

                                <div class="offcanvas-body">
                                    <div class="mb-3 spbwx8">
                                        <input type="radio" class="btn-check" name="sort_by" id="btnnewest" value="newest"
                                        @if ($request->sort_by == 'newest') checked @endif>
                                        <label class="btn btn-monochrome btn-sm" for="btnnewest">Newest</label>
                                    </div>
                            
                                    <div class="mb-3 spbwx8">
                                        <input type="radio" class="btn-check" name="sort_by" id="btnfeatured" value="featured"
                                        @if ($request->sort_by == 'featured') checked @endif>
                                        <label class="btn btn-monochrome btn-sm" for="btnfeatured">Featured</label>
                                    </div>
                              
                                    <div class="mb-3 spbwx8">
                                        <input type="radio" class="btn-check" name="sort_by" id="btnlow_price" value="low_price"
                                        @if ($request->sort_by == 'low_price') checked @endif>
                                        <label class="btn btn-monochrome btn-sm" for="btnlow_price">Low Price</label>
                                    </div>
                                
                                    <div class="mb-3 spbwx8">
                                        <input type="radio" class="btn-check" name="sort_by" id="btnhigh_price" value="high_price" @if ($request->sort_by == 'high_price') checked @endif>
                                        <label class="btn btn-monochrome btn-sm" for="btnhigh_price">High Price</label>
                                    </div>
                           
                                    <div class="mb-3 spbwx8">
                                        <input type="radio" class="btn-check" name="sort_by" id="btnbeds_least" value="beds_least" @if ($request->sort_by == 'beds_least') checked @endif>
                                        <label class="btn btn-monochrome btn-sm" for="btnbeds_least">Beds Least</label>
                                    </div>
                            
                                    <div class="mb-3 spbwx8">
                                        <input type="radio" class="btn-check" name="sort_by" id="btnbeds_most" value="beds_most"
                                        @if ($request->sort_by == 'beds_most') checked @endif>
                                        <label class="btn btn-monochrome btn-sm" for="btnbeds_most">Beds Most</label>
                                    </div>
                                </div>

                                <div class="p-3 bg-white border-top sticky-bottom">
                                    <input type="submit" class="btn btn-info form-control d-block fs-sm fw-normal mt-2" value="Sort">
                                </div>

                            </form>
                        </div>
                    @endif

                    <div class="mb-3">
                        <h1 class="h6">{{ $heading_info ?? '' }}
                            <small class="d-block fs-sm fw-normal mt-2">{{ $properties->total() }} results</small>
                        </h1>
                    </div>

                    {{-- Short design for desktop and tablet --}}
                    @if ((new \Jenssegers\Agent\Agent())->isTablet() || (new \Jenssegers\Agent\Agent())->isDesktop())
                        <div>
                            <form action="{{ url('properties') }}" name="frmSortBy" id="frmSortBy"
                                class="form-inline form-1" method="get">
                                <input type="hidden" name="featured" value="{{ request()->featured }}" id="featured">
                                <input type="hidden" name="property_type" value="{{ request()->property_type }}">
                                <input type="hidden" name="property_purpose"
                                    value="{{ request()->property_purpose }}" />
                                <input type="hidden" name="city" value="{{ request()->city }}" />
                                <input type="hidden" name="subcity" value="{{ request()->subcity }}" />
                                <input type="hidden" name="town" value="{{ request()->town }}" />
                                <input type="hidden" name="area" value="{{ request()->area }}" />
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
                                        <label class="btn btn-outline-primary btn-sm" for="save-search">
                                            <i class="far fa-star"></i>
                                            Save Search
                                        </label>
                                    </div>
                                    {{-- Sort By --}}
                                    <div>
                                        <div class="form-group d-flex align-items-center spbwx8">
                                            <label class="fs-sm">Sort by:</label>
                                            <div class="short-by">
                                                <select name="sort_by" id="sort_by"
                                                    class="hero__form-input form-select form-select-sm custom-select"
                                                    onchange="document.getElementById('frmSortBy').submit();">
                                                    <option value="newest"
                                                        @if ($request->sort_by == 'newest') selected @endif>
                                                        Newest
                                                    </option>

                                                    <option value="featured"
                                                        @if ($request->sort_by == 'featured') selected @endif>
                                                        Featured
                                                    </option>
                                                    
                                                    <option value="low_price"
                                                        @if ($request->sort_by == 'low_price') selected @endif>
                                                        Price (Low)
                                                    </option>
                                                    <option value="high_price"
                                                        @if ($request->sort_by == 'high_price') selected @endif>
                                                        Price (High)
                                                    </option>
                                                    <option value="beds_least"
                                                        @if ($request->sort_by == 'beds_least') selected @endif>
                                                        Beds (Least)
                                                    </option>
                                                    <option value="beds_most"
                                                        @if ($request->sort_by == 'beds_most') selected @endif>
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
                @if (request('property_purpose') && request('property_type') && request('city') && request('subcity') && request('town') && request('area'))
                    {{-- nothing to show --}}
                @elseif(request('property_purpose') && request('property_type') && request('city') && request('subcity') && request('town') && $data['result']->count() > 0)
                    <div class="location-wrap">
                        @foreach ($data['result'] as $area)
                            <div class="location-item {{ $loop->index > 8 ? 'moreLess' : '' }}">

                                <a
                                    href="{{ url("properties?featured=$request->featured&city=$request->city&subcity=$request->subcity&town=$request->town&area=$area->id&property_purpose=$request->property_purpose&property_type=$request->property_type&min_price=$request->min_price&max_price=$request->max_price&min_area=$request->min_area&max_area=$request->max_area&bedrooms=$request->bedrooms&bathrooms=$request->bathrooms&furnishings=$request->furnishings") }}">

                                    {{ $area->name }}
                                    <span>({{ $area->pcount }})</span>

                                </a>

                            </div>
                        @endforeach
                        <div class="location-item">
                            <a href="javascript:void(0)" onclick="showLessOrMore()" id="myBtn">
                                Show more <i class="fas fa-chevron-down"></i>
                            </a>
                        </div>

                    @if((new \Jenssegers\Agent\Agent())->isTablet() || (new \Jenssegers\Agent\Agent())->isDesktop())
                    <div class="location-item">
                        @if (count($data['result']) > 8)
                        <a href="javascript:void(0)" onclick="showLessOrMore()" id="myBtn">
                            Show more <i class="fas fa-chevron-down"></i>
                        </a>
                        @endif
                    </div>  
                    @endif
                </div>
                

                @elseif(request('property_purpose') && request('property_type') && request('city') && request('subcity') && $data['result']->count() > 0)
                    <div class="location-wrap">
                        @foreach ($data['result'] as $town)
                            <div class="location-item {{ $loop->index > 8 ? 'moreLess' : '' }}">

                                <a
                                    href="{{ url("properties?featured=$request->featured&city=$request->city&subcity=$request->subcity&town=$town->id&area=$request->area&property_purpose=$request->property_purpose&property_type=$request->property_type&min_price=$request->min_price&max_price=$request->max_price&min_area=$request->min_area&max_area=$request->max_area&bedrooms=$request->bedrooms&bathrooms=$request->bathrooms&furnishings=$request->furnishings") }}">

                                    {{ $town->name }}
                                    <span>({{ $town->pcount }})</span>

                                </a>

                            </div>
                        @endforeach
                        <div class="location-item">
                            <a href="javascript:void(0)" onclick="showLessOrMore()" id="myBtn">
                                Show more <i class="fas fa-chevron-down"></i>
                            </a>
                        </div>

                    @if((new \Jenssegers\Agent\Agent())->isTablet() || (new \Jenssegers\Agent\Agent())->isDesktop())
                    <div class="location-item">
                        @if (count($data['result']) > 8)
                        <a href="javascript:void(0)" onclick="showLessOrMore()" id="myBtn">
                            Show more <i class="fas fa-chevron-down"></i>
                        </a>
                        @endif
                    </div>  
                    @endif
                </div>
                

                @elseif(request('property_purpose') && request('property_type') && request('city') && $data['result']->count() > 0)
                    <div class="location-wrap">
                        @foreach ($data['result'] as $subcity)
                            <div class="location-item {{ $loop->index > 8 ? 'moreLess' : '' }}">

                                <a
                                    href="{{ url("properties?featured=$request->featured&city=$request->city&subcity=$subcity->id&town=$request->town&area=$request->area&property_purpose=$request->property_purpose&property_type=$request->property_type&min_price=$request->min_price&max_price=$request->max_price&min_area=$request->min_area&max_area=$request->max_area&bedrooms=$request->bedrooms&bathrooms=$request->bathrooms&furnishings=$request->furnishings") }}">

                                    {{ $subcity->name }}
                                    <span>({{ $subcity->pcount }})</span>

                                </a>

                            </div>
                        @endforeach
                        <div class="location-item">
                            <a href="javascript:void(0)" onclick="showLessOrMore()" id="myBtn">
                                Show more <i class="fas fa-chevron-down"></i>
                            </a>
                        </div>

                    @if((new \Jenssegers\Agent\Agent())->isTablet() || (new \Jenssegers\Agent\Agent())->isDesktop())
                    <div class="location-item">
                        @if (count($data['result']) > 8)
                        <a href="javascript:void(0)" onclick="showLessOrMore()" id="myBtn">
                            Show more <i class="fas fa-chevron-down"></i>
                        </a>
                        @endif
                    </div>  
                    @endif
                </div>
                

                @elseif(request('property_purpose') && request('property_type') && $data['result']->count() > 0)
                    <div class="location-wrap">
                        @foreach ($data['result'] as $city)
                            <div class="location-item {{ $loop->index > 8 ? 'moreLess' : '' }}">

                                <a
                                    href="{{ url("properties?featured=&city=$city->id&subcity=$request->subcity&town=$request->town&area=$request->area&property_purpose=$request->property_purpose&property_type=$request->property_type&min_price=$request->min_price&max_price=$request->max_price&min_area=$request->min_area&max_area=$request->max_area&bedrooms=$request->bedrooms&bathrooms=$request->bathrooms&furnishings=$request->furnishings") }}">

                                    {{ $city->name }}
                                    <span>({{ $city->pcount }})</span>

                                </a>

                            </div>
                        @endforeach
                        <div class="location-item">
                            <a href="javascript:void(0)" onclick="showLessOrMore()" id="myBtn">
                                Show more <i class="fas fa-chevron-down"></i>
                            </a>
                        </div>

                    @if((new \Jenssegers\Agent\Agent())->isTablet() || (new \Jenssegers\Agent\Agent())->isDesktop())
                    <div class="location-item">
                        @if (count($data['result']) > 8)
                        <a href="javascript:void(0)" onclick="showLessOrMore()" id="myBtn">
                            Show more <i class="fas fa-chevron-down"></i>
                        </a>
                        @endif
                    </div>  
                    @endif
                </div>
                
                @elseif(request('property_purpose') && request('property_type') == '' && request('city') == '' && request('subcity') == '' && request('town') == '' && request('area') == '')
                
                <div class="location-wrap">
                    @foreach ($propertyTypes as $propertyType)
                        <div class="location-item {{ $loop->index > 8 ? 'moreLess' : '' }}">
                            <a href="{{ url("properties?featured=&city=$request->city&subcity=$request->subcity&town=$request->town&area=$request->area&property_purpose=$request->property_purpose&property_type=$propertyType->id&min_price=$request->min_price&max_price=$request->max_price&min_area=$request->min_area&max_area=$request->max_area&bedrooms=$request->bedrooms&bathrooms=$request->bathrooms&furnishings=$request->furnishings") }}">

                                {{ $propertyType->types }} <span>({{ $propertyType->pcount }})</span>
                            
                            </a>
                        </div>
                    @endforeach
                    @if((new \Jenssegers\Agent\Agent())->isTablet() || (new \Jenssegers\Agent\Agent())->isDesktop())
                    <div class="location-item">
                        @if (count($data['result']) > 8)
                        <a href="javascript:void(0)" onclick="showLessOrMore()" id="myBtn">
                            Show more <i class="fas fa-chevron-down"></i>
                        </a>
                        @endif
                    </div>  
                    @endif
                </div>

                @endif

                {{-- list view --}}
                <div class="row gx-3">
                    <div class="col-lg-9">
                        @foreach ($properties as $property)
                            @php
                                $phone = \App\Properties::getPhoneNumber($property->id);
                                $whatsapp = \App\Properties::getWhatsapp($property->id);
                                $agency = \App\Agency::where('id', $property->agency_id)->first();
                                $propertyUrl = url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id);
                                $whatsapText = 'Hello, I would like to inquire about this property posted on saakin.qa Reference: ' . $property->refference_code . 'Price: QR' . $property->getPrice() . '/month Type: ' . $property->propertiesTypes->types . ' Location: ' . $property->address . ' Link:' . $propertyUrl;
                            @endphp
                            <div class="single-property-box horizontal-view"  @if (!(new \Jenssegers\Agent\Agent())->isMobile())style="height: 32vh;" @endif>
                                {{--  --}}
                                <div class="property-item">
                                    <div class="pro-slider">
                                        <div class="pro-slider-item">
                                            <img src="{{ asset('upload/properties/thumb_' . $property->featured_image) }}"
                                                alt="{{ $property->property_name }}">
                                        </div>

                                        @if (count($property->gallery) > 0)
                                            @foreach ($property->gallery as $gallery)
                                                @if ($loop->index < 5)
                                                    <div class="pro-slider-item">
                                                        <img src="{{ asset('upload/gallery/') . '/' . $gallery->image_name }}"
                                                            alt="{{ $property->property_name }}">
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


                                <div class="property-title-box"> 

                                    <div class="price">
                                        {{ $property->getPrice() }}

                                        @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                                            / Month
                                        @endif
                                    </div>
                                    <a class="text-decoration-none"
                                        href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}">
                                        <h5 class="property-card__property-title">
                                            {{ $property->property_name }}
                                        </h5>
                                    </a>
                                    <span>{{ Str::limit($property->propertiesTypes->types, 36) }}</span>
                                    <ul class="property-feature">

                                        @if ($property->getProperty_type())
                                            <li>
                                                <i class="fas fa-bed"></i>
                                                <span>{{ $property->bedrooms }} </span>
                                            </li>
                                            <li>
                                                <i class="fas fa-bath"></i>
                                                <span>{{ $property->bathrooms }} </span>
                                            </li>
                                        @endif
                                        <li>
                                            <i class="fas fa-chart-area"></i>
                                            <span>{{ $property->getSqm() }}</span>
                                        </li>
                                    </ul>
                                    <div class="property-location">
                                        <i class="fa fa-map-marker-alt"></i>
                                        <p class="hideAddress">
                                            {{ $property->address }}, {{ $property->propertyCity->name ?? '' }}
                                        </p>
                                    </div>
                                    <div class="social-div mt-md-2 d-flex">
                                        @if (!empty($property->whatsapp))
                                            <a href="" class="btn btn-monochrome btn-sm btnCall mt-1 me-1 btnCount"
                                                data-telNumber="{{ $property->whatsapp }}"
                                                data-property_id={{ $property->id }}
                                                data-agency_id={{ $property->agency_id }} data-button_name='Call'>

                                                <i class="fas fa-phone-alt text-primary"></i>
                                                <span class="d-md-inline-block">Call</span>
                                            </a>
                                        @else
                                            <a href="" class="btn btn-monochrome btn-sm btnCall mt-1 me-1 btnCount"
                                                data-telNumber="{{ $property->Agency->phone }}"
                                                data-property_id={{ $property->id }}
                                                data-agency_id={{ $property->agency_id }} data-button_name='Call'>

                                                <i class="fas fa-phone-alt text-primary"></i>
                                                <span class="d-md-inline-block">Call</span>
                                            </a>
                                        @endif

                                        @if ((new \Jenssegers\Agent\Agent())->isMobile())
                                            @if (!empty($property->whatsapp))
                                                <a href="//api.whatsapp.com/send?phone={{ $property->whatsapp }}&text={{ urlencode($whatsapText) }}"
                                                    class="btn btn-monochrome btn-sm mt-1 me-1 btnCount"
                                                    data-property_id={{ $property->id }}
                                                    data-agency_id={{ $property->agency_id }}
                                                    data-button_name='WhatsApp'>

                                                    <i class="fab fa-whatsapp text-primary"></i>
                                                    <span class=" d-md-inline-block">WhatsApp</span>
                                                </a>
                                            @else
                                                <button class="btn btn-monochrome btn-sm mt-1 btnCount"
                                                    data-property_id={{ $property->id }}
                                                    data-agency_id={{ $property->agency_id }} data-button_name='Email'
                                                    type="button" data-bs-toggle="modal" data-bs-target="#emailAgentModal"
                                                    id="emailBtn"
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
                                        @else
                                            @if (!empty($property->whatsapp))
                                                <a href="//api.whatsapp.com/send?phone={{ $property->whatsapp }}&text={{ urlencode($whatsapText) }}"
                                                    class="btn btn-monochrome btn-sm mt-1 btnCount me-1"
                                                    data-property_id={{ $property->id }}
                                                    data-agency_id={{ $property->agency_id }}
                                                    data-button_name='WhatsApp'>

                                                    <i class="fab fa-whatsapp text-primary"></i>
                                                    <span class=" d-md-inline-block">WhatsApp</span>
                                                </a>
                                            @elseif(!empty($property->Agency->whatsapp))
                                                <a href="//api.whatsapp.com/send?phone={{ $property->Agency->whatsapp }}&text={{ urlencode($whatsapText) }}"
                                                    class="btn btn-monochrome btn-sm mt-1 btnCount"
                                                    data-property_id={{ $property->id }}
                                                    data-agency_id={{ $property->agency_id }}
                                                    data-button_name='WhatsApp'>

                                                    <i class="fab fa-whatsapp text-primary"></i>
                                                    <span class=" d-md-inline-block">WhatsApp</span>
                                                </a>
                                            @endif

                                            <button class="btn btn-monochrome btn-sm mt-1 btnCount"
                                                data-property_id={{ $property->id }}
                                                data-agency_id={{ $property->agency_id }} data-button_name='Email'
                                                type="button" data-bs-toggle="modal" data-bs-target="#emailAgentModal"
                                                id="emailBtn"
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
                                </div>
                                @if ((new \Jenssegers\Agent\Agent())->isTablet() || (new \Jenssegers\Agent\Agent())->isDesktop())
                                    <div class="property-card-extra p-3 d-none d-md-block">
                                        <div class="property-type">
                                            @if ($property->featured_property == 1)
                                                Featured
                                            @endif
                                        </div>
                                        <div>
                                            <img src="{{ asset('upload/agencies/' . $property->Agency->image) }}"
                                                width="80" alt="{{ $property->property_name }}">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="col-lg-9 order-lg-3">
                        {{-- Pagination starts --}}
                        <div>
                            @if ($properties->total() > getcong('pagination_limit'))
                                {{ $properties->links('front-view.pages.include.pagination') }}
                            @endif
                        </div>
                        {{-- Pagination ends --}}
                    </div>
                </div>
            @else
                <div class="mb-3">
                    <h1 class="h6">{{ $heading_info ?? '' }}
                        <small class="d-block fs-sm fw-normal mt-2">{{ $properties->total() }} results</small>
                    </h1>
                </div>
                <div class="alert alert-info" role="alert">
                    Record Not Found!
                </div>

            @endif

        </div>
    </div>

    <div class="bg-dark py-4 border-top" style="--bs-bg-opacity: .03;">
        <div class="container">
            @if ($properties->onFirstPage())
                {!! $landing_page_content->page_content !!}
            @endif
        </div>
    </div>

@endsection

@push('styles')
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick.css') }}" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick-theme.css') }}" />

    <style>
        .social-div .btn-monochrome {
            --btn-bg-color: #fff;
            --btn-border-color: #e8e1e0;
            --btn-text-color: #2d383f;
            --btn-hover-bg-color: #f7f5f5;
            --btn-hover-border-color: #e8e1e0;
            --btn-hover-text-color: #403b45;
        }

    </style>
@endpush


@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>

    <script type="text/javascript">
        var bednumber = $("#bedroomInput").val();
        var bathnumber = $("#bathroomInput").val();
        showBedBath();

        function bedrooms(valx) {
            $('.bedrooms').removeClass('bg-info');
            $(valx).addClass('bg-info');
            var valv = $(valx).html();
            $('#bedrooms').val(valv);
            bednumber = valv;
            $("#bedroomInput").val($(valx).data('value'));
            showBedBath();
        }

        function bathrooms(valx) {
            $('.bathrooms').removeClass('bg-info');
            $(valx).addClass('bg-info');
            var valv = $(valx).html();
            $('#bathrooms').val(valv);
            bathnumber = valv;
            $("#bathroomInput").val($(valx).data('value'));
            showBedBath();
        }

        function showBedBath() {
            var bedResult = (bednumber == 1 ? bednumber + " Bed" : bednumber + " Beds");
            var bathResult = (bathnumber == 1 ? bathnumber + " Bath" : bathnumber + " Baths");
            $('.bedbathdrop').text(bedResult + ' ' + bathResult);
        }

        $(document).ready(function() {

            $('.js-dropdown .dropdown-menu').click(function(e) {
                e.stopPropagation();
            });

            $(".pro-slider").slick({
                dots: true,
                // autoplay: true,
                autoplaySpeed: 2000,
                speed: 10,
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
