<div class="site-banner home-banner" style="background-image: url('{{ 'assets/images/backgrounds/bg-7.webp' }}')">
  <!--Listing filter starts-->
  <div class="container">
    <h1 class="text-sm-center font-weight-bold">Find Your Property</h1>
    <div class="row justify-content-center">
      <div class="col-lg-10 mt-3 mt-lg-4">
        <div class="card main-searchbar-radius">
          <div class="card-body">

            <form action="{{ url('properties') }}" class="hero__form v2 filter listing-filter bg-cb" method="get">
              <input type="hidden" name="property_purpose" id="property_purpose" value="Rent">
              <input type="hidden" name="bedrooms" id="bedrooms">
              <input type="hidden" name="bathrooms" id="bathrooms">

              <div class="choose-type-btns">
                <a class="btn btn-monochrome btn-sm active rent " onclick="setPropertyPurpose('Rent')">Rent</a>
                <a class="btn btn-monochrome btn-sm buyy" onclick="setPropertyPurpose('Sale')">Buy</a>
              </div>

              <div class="d-flex spbwx8 mb-2">
                {{-- Place Name --}}
                <div class="flex-grow-1 country-list-wrap">
                  <div class="input-group-overlay input-search">
                    <div class="input-group-prepend-overlay">
                      <span class="input-group-text">
                        <i class="fa fa-search" aria-hidden="true"></i>
                      </span>
                    </div>

                    <input type="text" id="country" data-purpose="" placeholder="Search Location" class="form-control prepended-form-control" autocomplete="off" aria-label="Search Location" aria-describedby="country">
                  </div>

                  <div id="country_list" class="country-list scroll-y col-md-12 col-12"></div>
                  <div id="extra_keywords" style="display: none;"></div>

                </div>

                @if ((new \Jenssegers\Agent\Agent())->isDesktop())
                  {{-- Property Type --}}
                  <div class="">
                    <select name="property_type" data-style="form-select" class="hero__form-input form-select custom-select" onchange="setPropertyType(this)" id="propertyTypeSelect">
                      <option value="" selected>Property Type</option>
                      @foreach ($propertyTypes as $propertyType)
                        <option value="{{ $propertyType->id }}">{{ $propertyType->types }}</option>
                      @endforeach
                    </select>
                  </div>

                  {{-- Beds and Baths --}}
                  <div class="commercial-filter">
                    <div class="dropdown js-dropdown">
                      <div class="form-select dropdown-toggle bedbathdrop" type="button" data-bs-toggle="dropdown" 
                        aria-expanded="false">
                        Beds & Baths
                      </div>

                      <div class="dropdown-menu px-2 custom-dropdown"  aria-labelledby="dropdownMenuButton">
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

                        {{-- <div class="mb-3">
                          <input type="checkbox" name="exact_bedrooms" value="1"> Use exact values
                        </div> --}}

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
                        {{-- <div class="">
                          <input type="checkbox" name="exact_bathrooms" value="1"> Use exact values
                        </div> --}}
                      </div>
                    </div>
                  </div>

                  {{-- Price --}}
                  <div class="">
                    <div class="dropdown js-dropdown">
                      <div class="form-select dropdown-toggle minMaxDiv" type="button" id="pricedropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Price
                      </div>
                      <div class="dropdown-menu dropdown-menu-end price-dropdown" aria-labelledby="pricedropdownMenuButton">
                        <div class="d-flex align-items-center spbwx8">
                          <div class="flex-grow-1">
                            <select name="min_price" onchange="setMin(this);" class="hero__form-input form-control custom-select">
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
                          <div class="">
                            <span class="separator">-</span>
                          </div>
                          <div class="flex-grow-1">
                            <select name="max_price" onchange="setMax(this);" class="hero__form-input form-control custom-select">
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

                @endif

                {{-- Button --}}
                <div class="">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>

              </div>
              <div class="advanced-search-div" style="display: none;">
                <div class="d-flex spbwx8 mb-2">

                  <div class="all-furnishings commercial-filter">
                    <select name="furnishings" class="hero__form-input form-select custom-select">
                      <option value="">All furnishings</option>
                      <option value="109">Furnished</option>
                      <option value="120">Unfurnished</option>
                      <option value="101">Partly furnished</option>
                    </select>
                  </div>

                  <div class="area-2">
                    <div class="dropdown js-dropdown">
                      <div class="form-select dropdown-toggle minMaxArea" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Area
                      </div>
                      <div class="dropdown-menu price-dropdown" id="dropdownMenuButton" aria-labelledby="dropdownMenuButton">
                        <div class="d-flex spbwx8 align-items-center">
                          <div class="flex-grow-1">
                            <select name="min_area" onchange="minAreaFunction(this);" class="hero__form-input  form-control custom-select">
                              <option value="">Min Area</option>
                              <option value="50">50 sqm</option>
                              <option value="100">100 sqm</option>
                              <option value="200">200 sqm</option>
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
                          <div>
                            <span class="separator">-</span>
                          </div>
                          <div class="flex-grow-1">
                            <select name="max_area" onchange="maxAreaFunction(this);" class="hero__form-input  form-control custom-select">
                              <option value="">Max Area</option>
                              <option value="50">50 sqm</option>
                              <option value="100">100 sqm</option>
                              <option value="200">200 sqm</option>
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
                  <div class="flex-grow-1">

                    <div class="input-group-overlay input-search">
                      <div class="input-group-prepend-overlay">
                      </div>
                      <div class="multi-select">
                        <select name="amenities[]" id="amenitiesMultiselect" class="form-select" multiple="multiple">
                          <option value="">Select Extra</option>
                            @foreach ($amenities as $amenity)
                                <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="d-flex justify-content-between advanced-search-option">
                <div>
                  <div class="commercial-checkbox">
                    <input class="form-check-input" type="checkbox" name="commercial" value="1" id="commercial-checkbox">
                    <label class="form-check-label" for="commercial-checkbox">Show commercial properties only</label>
                  </div>
                </div>
                <div class="d-none d-md-block">
                  <a class="advanced-search-btn" href="javascript:void(0)">Show more search options <i class="fas fa-chevron-down"></i></a>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {

      $('.js-dropdown .dropdown-menu').click(function(e) {
        e.stopPropagation();
      });

      $('.advanced-search-btn').click(function() {
        $('.advanced-search-div').slideToggle();
        $(".advanced-search-btn i").toggleClass("fa-chevron-down fa-chevron-up");
      });

      $("#commercial-checkbox").click(function() {
        if ($(this).is(":checked")) {

          $.ajax({
            type : "GET",
            data:{"myData": "commercial" },
            url : "{{ route('commercial-property_types') }}",
            success : function(response){
                $("#propertyTypeSelect").html('');
                $("#propertyTypeSelect").append(response);
            }
          });
          $(".commercial-filter").hide();
        
        } else {

          $.ajax({
            type : "GET",
            url : "{{ route('commercial-property_types') }}",
            success : function(response){
                $("#propertyTypeSelect").html('');
                $("#propertyTypeSelect").append(response);
            }
          });
          $(".commercial-filter").show();
        
        }
      });

      $('#amenitiesMultiselect').select2({
        placeholder: "View of Water, Gym, or Security"
      });

    });

    var bednumber = 0;
    var bathnumber = 0;
    var minPrice = 0;
    var maxPrice = 0;
    var minArea = 0;
    var maxArea = 0;

    function bedrooms(valx) {
      $('.bedrooms').removeClass('bg-primary text-white border-primary');
      $(valx).addClass('bg-primary text-white border-primary');
      var valv = $(valx).html();
      $('#bedrooms').val(valv);
      bednumber = valv;
      showBedBath();
    }

    function bathrooms(valx) {
      $('.bathrooms').removeClass('bg-primary text-white border-primary');
      $(valx).addClass('bg-primary text-white border-primary');
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

    $(document).ready(function() {
      $(".choose-type-btns a").click(function() {
        $(".choose-type-btns a").removeClass("active"),
          $(this).addClass("active");
      })
    });
  </script>
@endpush
