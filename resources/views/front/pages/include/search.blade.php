<style>
    .desktop-search-li {
        margin-left:-4px; 
        width: 100%; 
        display: block;  
        position: absolute;  
        z-index: 1; 
        overflow: auto; 
        max-height: 30vh;"
    }

    .mobile-search-li {
        width: 75vw; 
        margin-top: -10px; 
        margin-left: -15px; 
        display: block; 
        position: absolute; 
        z-index: 1; 
        overflow: auto; 
        max-height: 30vh;
    }
</style>

<div class="hero v2 section-padding" style="background-image: url('{{ 'assets/images/backgrounds/bg-7.jpg' }}')">
    <div class="overlay op-6"></div>
    <!--Listing filter starts-->
    <div class="container pos-abs">
        <div class="row">
            <div class="col-md-6 ml-auto mr-auto">
                <div class="header-text v1">
                    <h1>Find your Property</h1>
                </div>
            </div>
            
            <div class="col-md-10  ml-auto mr-auto desktop">
                <form action="{{ url('properties') }}" class="hero__form v2 filter listing-filter bg-cb" method="get"
                    style="border-radius: 15px !important; padding: 25px !important;">
                    <input type="hidden" name="property_purpose" id="property_purpose" value="Rent">
                    <input type="hidden" name="bedrooms" id="bedrooms">
                    <input type="hidden" name="bathrooms" id="bathrooms">
                   
                    <div class="row">
                        <div class="col-12">
                            <div class="choose-type-btns">
                                <a class="rent active" onclick="setPropertyPurpose('Rent')">Rent</a>
                                <a class="buyy" onclick="setPropertyPurpose('Sale')">Buy</a>
                            </div>
                        </div>
                        <div class="col-md-5 col-12">
                            <div class="input-search">
                                <input type="text"  id="country" data-purpose="" placeholder="Enter Place Name" class="form-control" autocomplete="off">
                            </div>
                            <div id="country_list" class="col-md-12 col-12" ></div> 
                        </div>
                        
                        <div id="extra_keywords" style="display: none;"></div>
                        
                        <div class="col-md-2 col-12">
                            <select name="property_type" class="hero__form-input form-control custom-select" onchange="setPropertyType(this)">
                                <option value="" selected>Property Type</option>
                                @foreach ($propertyTypes as $propertyType)
                                    <option value="{{ $propertyType->id }}">{{ $propertyType->types }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-12 bed-and-bath">
                            <div class="dropdown js-dropdown">
                                <div class="btn dropdown-toggle btn-select bedbathdrop" style="height: 44px;"
                                    type="button" id="dropdownMenuButton">
                                    Beds & Baths
                                </div>
                                <div class="dropdown-menu custom-dropdown" id="bathroomDropdown" aria-labelledby="dropdownMenuButton"
                                    style="min-width:25.5rem !important;">
                                    <div class="col-md-12 mb-3">
                                        <label style="display: block !important; font-weight:bold">Bedrooms</label>
                                        <a class="dropdown-item item-in-line bedrooms" href="javascript:;"
                                            onclick="bedrooms(this);">Any</a>
                                        <a class="dropdown-item item-in-line bedrooms" href="javascript:;"
                                            onclick="bedrooms(this);">1</a>
                                        <a class="dropdown-item item-in-line bedrooms" href="javascript:;"
                                            onclick="bedrooms(this);">2</a>
                                        <a class="dropdown-item item-in-line bedrooms" href="javascript:;"
                                            onclick="bedrooms(this);">3</a>
                                        <a class="dropdown-item item-in-line bedrooms" href="javascript:;"
                                            onclick="bedrooms(this);">4</a>
                                        <a class="dropdown-item item-in-line bedrooms" href="javascript:;"
                                            onclick="bedrooms(this);">5</a>
                                        <a class="dropdown-item item-in-line bedrooms" href="javascript:;"
                                            onclick="bedrooms(this);">6+</a>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="checkbox" name="exact_bedrooms" value="1"> Use exact values
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label style="display: block !important; font-weight:bold">Bathrooms</label>
                                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;"
                                            onclick="bathrooms(this);">Any</a>
                                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;"
                                            onclick="bathrooms(this);">1</a>
                                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;"
                                            onclick="bathrooms(this);">2</a>
                                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;"
                                            onclick="bathrooms(this);">3</a>
                                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;"
                                            onclick="bathrooms(this);">4</a>
                                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;"
                                            onclick="bathrooms(this);">5</a>
                                        <a class="dropdown-item item-in-line bathrooms second-bath-option" href="javascript:;"
                                            onclick="bathrooms(this);">6+</a>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <input type="checkbox" name="exact_bathrooms" value="1"> Use exact values
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 price-area">
                            <div class="dropdown js-dropdown">
                                <div class="btn dropdown-toggle btn-select minMaxDiv" style="height: 44px;"
                                    type="button" id="dropdownMenuButton">
                                    Price
                                </div>
                                <div class="dropdown-menu custom-dropdown" aria-labelledby="dropdownMenuButton"
                                    style="min-width:25.5rem !important;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select name="min_price" onchange="setMin(this);"
                                                class="hero__form-input form-control custom-select">
                                                <option value="">Min Price</option>
                                                <option value="5000">QAR 5000</option>
                                                <option value="10000">QAR 10000</option>
                                                <option value="15000">QAR 15000</option>
                                                <option value="20000">QAR 20000</option>
                                                <option value="25000">QAR 25000</option>
                                                <option value="30000">QAR 30000</option>
                                                <option value="40000">QAR 40000</option>
                                                <option value="50000">QAR 50000</option>
                                                <option value="60000">QAR 60000</option>
                                                <option value="70000">QAR 70000</option>
                                                <option value="90000">QAR 90000</option>
                                                <option value="100000">QAR 100000</option>
                                                <option value="125000">QAR 125000</option>
                                                <option value="150000">QAR 150000</option>
                                            </select>
                                        </div>
                                        <span class="separator">-</span>
                                        <div class="col-md-6">
                                            <select name="max_price" onchange="setMax(this);"
                                                class="hero__form-input form-control custom-select">
                                                <option value="">Max Price</option>
                                                <option value="5000">QAR 5000</option>
                                                <option value="10000">QAR 10000</option>
                                                <option value="15000">QAR 15000</option>
                                                <option value="20000">QAR 20000</option>
                                                <option value="25000">QAR 25000</option>
                                                <option value="30000">QAR 30000</option>
                                                <option value="40000">QAR 40000</option>
                                                <option value="50000">QAR 50000</option>
                                                <option value="60000">QAR 60000</option>
                                                <option value="70000">QAR 70000</option>
                                                <option value="90000">QAR 90000</option>
                                                <option value="100000">QAR 100000</option>
                                                <option value="125000">QAR 125000</option>
                                                <option value="150000">QAR 150000</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 area-1">
                            <div class="dropdown js-dropdown">
                                <div class="btn dropdown-toggle btn-select" style="height: 44px;" type="button"
                                    id="dropdownMenuButton">
                                    Area
                                </div>
                                <div class="dropdown-menu custom-dropdown" aria-labelledby="dropdownMenuButton"
                                    style="min-width:25.5rem !important;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select name="min_area"
                                                class="hero__form-input  form-control custom-select">
                                                <option value="">Min Area</option>
                                                <option value="500">500 sqm</option>
                                                <option value="600">600 sqm</option>
                                                <option value="700">700 sqm</option>
                                                <option value="800">800 sqm</option>
                                                <option value="900">900 sqm</option>
                                                <option value="1000">1000 sqm</option>
                                                <option value="1100">1100 sqm</option>
                                                <option value="1200">1200 sqm</option>
                                                <option value="1300">1300 sqm</option>
                                                <option value="1400">1400 sqm</option>
                                                <option value="1500">1500 sqm</option>
                                                <option value="1600">1600 sqm</option>
                                                <option value="1700">1700 sqm</option>
                                                <option value="1800">1800 sqm</option>
                                                <option value="1900">1900 sqm</option>
                                                <option value="2000">2000 sqm</option>
                                                <option value="2500">2500 sqm</option>
                                                <option value="3000">3000 sqm</option>
                                                <option value="4000">4000 sqm</option>
                                                <option value="5000">5000 sqm</option>
                                            </select>
                                        </div>
                                        <span class="separator">-</span>
                                        <div class="col-md-6 ">
                                            <select name="max_area"
                                                class="hero__form-input  form-control custom-select">
                                                <option value="">Max Area</option>
                                                <option value="500">500 sqm</option>
                                                <option value="600">600 sqm</option>
                                                <option value="700">700 sqm</option>
                                                <option value="800">800 sqm</option>
                                                <option value="900">900 sqm</option>
                                                <option value="1000">1000 sqm</option>
                                                <option value="1100">1100 sqm</option>
                                                <option value="1200">1200 sqm</option>
                                                <option value="1300">1300 sqm</option>
                                                <option value="1400">1400 sqm</option>
                                                <option value="1500">1500 sqm</option>
                                                <option value="1600">1600 sqm</option>
                                                <option value="1700">1700 sqm</option>
                                                <option value="1800">1800 sqm</option>
                                                <option value="1900">1900 sqm</option>
                                                <option value="2000">2000 sqm</option>
                                                <option value="2500">2500 sqm</option>
                                                <option value="3000">3000 sqm</option>
                                                <option value="4000">4000 sqm</option>
                                                <option value="5000">5000 sqm</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 col-12">
                            <button type="submit" class="btn btn-block v3"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="explore__form-checkbox-list full-filter" style="display: none;">
                            <div class="row">
                                <div class="col-md-4 col-12 all-furnishings">
                                    <select name="furnishings" class="hero__form-input  form-control custom-select">
                                        <option value="">All furnishings</option>
                                        <option value="109">Furnished</option>
                                        <option value="120">Unfurnished</option>
                                        <option value="101">Partly furnished</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-12 area-2">
                                    <div class="dropdown js-dropdown">
                                        <div class="btn dropdown-toggle btn-select  minMaxArea" style="height: 44px;" type="button"
                                            id="dropdownMenuButton">
                                            Area
                                        </div>
                                        <div class="dropdown-menu custom-dropdown" aria-labelledby="dropdownMenuButton"
                                            style="min-width:25.5rem !important;">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select name="min_area" onchange="minAreaFunction(this);"
                                                        class="hero__form-input  form-control custom-select">
                                                        <option value="">Min Area</option>
                                                        <option value="500">500 sqm</option>
                                                        <option value="600">600 sqm</option>
                                                        <option value="700">700 sqm</option>
                                                        <option value="800">800 sqm</option>
                                                        <option value="900">900 sqm</option>
                                                        <option value="1000">1000 sqm</option>
                                                        <option value="1100">1100 sqm</option>
                                                        <option value="1200">1200 sqm</option>
                                                        <option value="1300">1300 sqm</option>
                                                        <option value="1400">1400 sqm</option>
                                                        <option value="1500">1500 sqm</option>
                                                        <option value="1600">1600 sqm</option>
                                                        <option value="1700">1700 sqm</option>
                                                        <option value="1800">1800 sqm</option>
                                                        <option value="1900">1900 sqm</option>
                                                        <option value="2000">2000 sqm</option>
                                                        <option value="2500">2500 sqm</option>
                                                        <option value="3000">3000 sqm</option>
                                                        <option value="4000">4000 sqm</option>
                                                        <option value="5000">5000 sqm</option>
                                                    </select>
                                                </div>
                                                <span class="separator">-</span>
                                                <div class="col-md-6 ">
                                                    <select name="max_area"  onchange="maxAreaFunction(this);"
                                                        class="hero__form-input  form-control custom-select">
                                                        <option value="">Max Area</option>
                                                        <option value="500">500 sqm</option>
                                                        <option value="600">600 sqm</option>
                                                        <option value="700">700 sqm</option>
                                                        <option value="800">800 sqm</option>
                                                        <option value="900">900 sqm</option>
                                                        <option value="1000">1000 sqm</option>
                                                        <option value="1100">1100 sqm</option>
                                                        <option value="1200">1200 sqm</option>
                                                        <option value="1300">1300 sqm</option>
                                                        <option value="1400">1400 sqm</option>
                                                        <option value="1500">1500 sqm</option>
                                                        <option value="1600">1600 sqm</option>
                                                        <option value="1700">1700 sqm</option>
                                                        <option value="1800">1800 sqm</option>
                                                        <option value="1900">1900 sqm</option>
                                                        <option value="2000">2000 sqm</option>
                                                        <option value="2500">2500 sqm</option>
                                                        <option value="3000">3000 sqm</option>
                                                        <option value="4000">4000 sqm</option>
                                                        <option value="5000">5000 sqm</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="input-search">
                                        <select name="ameneties[]" id="ameneties" 
                                            class="hero__form-input form-control custom-select" multiple>
                                            @foreach ($amenities as $amenity)
                                                <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-12 position-relative">
                                    <div class="commercial-checkbox">
                                        <input type="checkbox" name="commercial" value="1" id="commercial">
                                        <label for="commercial">Show commercial properties only</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-lg-none d-md-none col-md-12 col-sm-12 pl-0">
                            <div class="submit_btn w-100">
                                <button type="submit" class="btn btn-block v3">Search</button>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <div class="dropdown-filter">Show <span id="gowa">more</span> search options</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-10  ml-auto mr-auto mobile">
                <form action="{{ url('properties') }}" class="hero__form v2 filter listing-filter bg-cb" method="get">
                    <input type="hidden" name="property_purpose" class="property_purpose" value="Rent">
                    <input type="hidden" name="bedrooms" id="bedrooms">
                    <input type="hidden" name="bathrooms" id="bathrooms">
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="choose-type-btns">
                                <a  class="rent active" onclick="setPropertyPurpose('Rent')" > Rent </a>
                                <a class="buy" onclick="setPropertyPurpose('Sale')"> Buy </a>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="input-group mb-2">
                                <input type="text" name="keywordMbl" class="countryMbl" id="countryMbl" placeholder="Search Location" value="{{ Request::get('keywordMbl') }}" autocomplete="off" style="padding: 4px 15px 4px 10px !important;">
                                    
                                <div class="input-group-append" style="width: 40px;">
                                    <button class="btn btn-secondary" type="submit" style="width: 100px;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="country_list_mbl" class="col-md-12 col-12" ></div> 
                            <div class="extra_keywords" style="display: none;"></div>
                            
                        </div>
                        <div class="col-12">
                            <div class="commercial-checkbox">
                                <input type="checkbox" name="commercial" value="1" id="commercial">
                                <label for="commercial">Show commercial properties only</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section('scripts-custom')
    
<script>
    
        var deleteLink = document.getElementsByClassName("second-bath-option");
    // document.querySelectorAll('.second-bath-option');
        for (var i = 0; i < deleteLink.length; i++) {
            deleteLink[i].addEventListener('click', function(event) {
                document.getElementById("bathroomDropdown").style.display = "none";
            });
        }

        var bednumber = 0;
        var bathnumber = 0;
        var minPrice = 0;
        var maxPrice = 0;
        var minArea = 0;
        var maxArea = 0;

        function bedrooms(valx) {
            $('.bedrooms').removeClass('btn-secondary');
            $(valx).addClass('btn-secondary');
            var valv = $(valx).html();
            $('#bedrooms').val(valv);
            bednumber = valv;
            showBedBath();
        }

        function bathrooms(valx) {
            $('.bathrooms').removeClass('btn-secondary');
            $(valx).addClass('btn-secondary');
            var valv = $(valx).html();
            $('#bathrooms').val(valv);
            bathnumber = valv;
            showBedBath();
        }

        function showBedBath() {
            var bedResult = (bednumber == 1 ? bednumber + " Bed" : bednumber + " Beds");
            var bathResult = (bathnumber == 1 ? bathnumber + " Bath" : bathnumber + " Baths");
            $('.bedbathdrop').text(bedResult + ' ' + bathResult);
        }

        function setMin(selectObject) {
            minPrice = selectObject.value;
            $('.minMaxDiv').text('From QAR ' + minPrice);
        }

        function setMax(selectObject) {
            maxPrice = selectObject.value;
            $('.minMaxDiv').text(minPrice + '-' + maxPrice + ' QAR');
        }

        function minAreaFunction(min) {
            minArea = min.value;
            $('.minMaxArea').text('From sqm ' + minArea);
        }

        function maxAreaFunction(max) {
            maxArea = max.value;
            $('.minMaxArea').text(minArea + '-' + maxArea + ' sqm');
        }

</script>
@endsection