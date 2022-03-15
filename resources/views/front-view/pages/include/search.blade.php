<div class="site-banner home-banner" style="background-image: url('{{ 'assets/images/backgrounds/bg-7.jpg' }}')">
  <!--Listing filter starts-->
  <div class="container">
    <h1>Find your Property</h1>
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card mt-3 mt-lg-5">
          <div class="card-body">
            <div class="desktop">
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
                  <div class="flex-grow-1">
                    <div class="input-group-overlay input-search">
                      <div class="input-group-prepend-overlay">
                        <span class="input-group-text" id="country"><i class="fa fa-search"></i></span>
                      </div>

                      <input type="text" name="keyword" id="country" data-purpose="" placeholder="Enter Place Name" class="form-control prepended-form-control" autocomplete="off"
                        aria-label="Enter Place Name" aria-describedby="country">
                    </div>
                    <div id="country_list" class="col-md-12 col-12"></div>
                  </div>

                  @if ((new \Jenssegers\Agent\Agent())->isDesktop())
                    {{-- Property Type --}}
                    <div class="">
                      <select name="property_type" data-style="form-select" class="hero__form-input form-select custom-select" onchange="setPropertyType(this)">
                        <option value="" selected>Property Type</option>
                        @foreach ($propertyTypes as $propertyType)
                          <option value="{{ $propertyType->id }}">{{ $propertyType->types }}</option>
                        @endforeach
                      </select>
                    </div>

                    {{-- Beds and Baths --}}
                    <div class="commercial-filter">
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
                          <span class="input-group-text" id="keywordextra"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" name="keywordextra" id="keywordextra" class="form-control prepended-form-control" placeholder="View of Water, Gym, or Security" autocomplete="off"
                          value="{{ Request::get('keyword') }}">
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

                {{-- <div class="row">
									<div class="explore__form-checkbox-list full-filter" style="display: none;">
										<div class="row">
											<div class="col-md-2 col-12 all-furnishings">
												<select name="furnishings" class="hero__form-input  form-control custom-select">
													<option value="">All furnishings</option>
													<option value="109">Furnished</option>
													<option value="120">Unfurnished</option>
													<option value="101">Partly furnished</option>
												</select>
											</div>
											<div class="col-md-3 col-12 area-2">
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
																<select name="max_area" onchange="maxAreaFunction(this);"
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
											<div class="col-md-7 col-12">
												<div class="input-search">
													<input type="text" name="keywordextra" id="keywordextra"
														placeholder="View of Water, Gym, or Security" autocomplete="off"
														value="{{ Request::get('keyword') }}">
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
								</div> --}}
              </form>
            </div>

            {{-- <div class="col-md-10  ml-auto mr-auto mobile">
							<form action="{{ url('properties') }}" class="hero__form v2 filter listing-filter bg-cb" method="get">
								<input type="hidden" name="property_purpose" class="property_purpose" value="Rent">
								<input type="hidden" name="bedrooms" id="bedrooms">
								<input type="hidden" name="bathrooms" id="bathrooms">

								<div class="row">
									<div class="col-12">
										<div class="choose-type-btns">
											<a class="rent active" onclick="setPropertyPurpose('Rent')"> Rent </a>
											<a class="buy" onclick="setPropertyPurpose('Sale')"> Buy </a>
										</div>
									</div>
									<div class="col-md-12">

										<div class="input-group mb-2">
											<input type="text" name="keywordMbl" class="countryMbl" id="countryMbl"
												placeholder="Search Location" value="{{ Request::get('keywordMbl') }}" autocomplete="off"
												style="padding: 4px 15px 4px 10px !important;">

											<div class="input-group-append" style="width: 40px;">
												<button class="btn btn-secondary" type="submit" style="width: 100px;">
													<i class="fa fa-search"></i>
												</button>
											</div>
										</div>
										<div id="country_list_mbl" class="col-md-12 col-12"></div>

									</div>
									<div class="col-12">
										<div class="commercial-checkbox">
											<input type="checkbox" name="commercial" value="1" id="commercial">
											<label for="commercial">Show commercial properties only</label>
										</div>
									</div>
								</div>
							</form>
						</div> --}}

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@push('scripts')
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
          $(".commercial-filter").hide();
        } else {
          $(".commercial-filter").show();
        }
      });
    });

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
