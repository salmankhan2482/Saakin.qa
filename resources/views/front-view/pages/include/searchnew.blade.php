<div class="hero v2 section-padding" style="background-image: url('{{'assets/images/backgrounds/bg-4.jpg'}}')">
    <div class="overlay op-6"></div>
    <!--Listing filter starts-->
    <div class="container pos-abs">
        <div class="row">
            <div class="col-md-6 ml-auto mr-auto">
                <div class="header-text v1">
                    <h1>Qatar Real Estate Directory and City Guide</h1>
                </div>
            </div>

            <div class="col-md-10  ml-auto mr-auto desktop">
                <form action="{{url('properties')}}" class="hero__form v2 filter listing-filter bg-cb" method="get"
                    style="border-radius: 15px !important; padding: 25px !important;">
                    <div class="row">
                        <div class="col-md-12 form-group" style="padding:1px !important">
                            <div class="btn-group" role="group" aria-label="Property Purpose">
                                <input type="hidden" name="property_purpose" id="property_purpose" value="1">
                                <input type="hidden" name="bedrooms" id="bedrooms" value="1">
                                <input type="hidden" name="bathrooms" id="bathrooms" value="1">
                                @foreach($propertyPurposes as $propertyPurpose)
                                <button type="button" class="btn btn-secondary property_purpose"
                                    id="property_purpose_{{$propertyPurpose->id}}"
                                    data-id="{{$propertyPurpose->id}}">{{$propertyPurpose->name}}</button>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-6" style="padding:1px !important">
                            <div class="input-search">
                                <input type="text" class="typeahead" name="keyword" id="keyword"
                                    placeholder="Enter Property, Location, Landmark ..." autocomplete="off"
                                    value="{{Request::get('keyword')}}">
                            </div>
                        </div>
                        <div class="col-md-3" style="padding:1px !important">
                            <select name="property_type" class="hero__form-input  form-control custom-select  mb-20">
                                <option value="" selected>Property Type</option>
                                @foreach($propertyTypes as $propertyType)
                                <option value="{{$propertyType->id}}">{{$propertyType->types}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2" style="padding:1px !important">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" style="height: 44px;" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Beds & Baths
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                    style="min-width:25.5rem !important;">
                                    <div class="col-md-12">
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
                                            onclick="bedrooms(this);">6</a>
                                        <a class="dropdown-item item-in-line bedrooms" href="javascript:;"
                                            onclick="bedrooms(this);">7</a>
                                    </div>
                                    <div class="col-md-12" style="margin:15px 0px !important;">
                                        <input type="checkbox" name="exact_bedrooms" value="1"> Use exact values
                                    </div>
                                    <div class="col-md-12">
                                        <label style="display: block !important; font-weight:bold">Bathrooms</label>
                                        <a class="dropdown-item item-in-line bathrooms" href="javascript:;"
                                            onclick="bathrooms(this);">Any</a>
                                        <a class="dropdown-item item-in-line bathrooms" href="javascript:;"
                                            onclick="bathrooms(this);">1</a>
                                        <a class="dropdown-item item-in-line bathrooms" href="javascript:;"
                                            onclick="bathrooms(this);">2</a>
                                        <a class="dropdown-item item-in-line bathrooms" href="javascript:;"
                                            onclick="bathrooms(this);">3</a>
                                        <a class="dropdown-item item-in-line bathrooms" href="javascript:;"
                                            onclick="bathrooms(this);">4</a>
                                        <a class="dropdown-item item-in-line bathrooms" href="javascript:;"
                                            onclick="bathrooms(this);">5</a>
                                        <a class="dropdown-item item-in-line bathrooms" href="javascript:;"
                                            onclick="bathrooms(this);">6</a>
                                        <a class="dropdown-item item-in-line bathrooms" href="javascript:;"
                                            onclick="bathrooms(this);">7</a>
                                    </div>
                                    <div class="col-md-12" style="margin:15px 0px !important;">
                                        <input type="checkbox" name="exact_bathrooms" value="1"> Use exact values
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1" style="padding:1px !important">
                            <button type="submit" class="btn btn-block v3"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="explore__form-checkbox-list full-filter" style="display: none;">
                            <div class="row">

                                <div class="col-lg-3 col-md-6 col-6">
                                    <select name="min_price"
                                        class="hero__form-input  form-control custom-select  mb-20">
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
                                <div class="col-lg-3 col-md-6 col-6">
                                    <select name="max_price"
                                        class="hero__form-input  form-control custom-select  mb-20">
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
                                <div class="col-lg-3 col-md-6 col-6">
                                    <select name="min_area" class="hero__form-input  form-control custom-select  mb-20">
                                        <option value="">Min Area</option>
                                        <option value="500">500 sqft</option>
                                        <option value="600">600 sqft</option>
                                        <option value="700">700 sqft</option>
                                        <option value="800">800 sqft</option>
                                        <option value="900">900 sqft</option>
                                        <option value="1000">1000 sqft</option>
                                        <option value="1100">1100 sqft</option>
                                        <option value="1200">1200 sqft</option>
                                        <option value="1300">1300 sqft</option>
                                        <option value="1400">1400 sqft</option>
                                        <option value="1500">1500 sqft</option>
                                        <option value="1600">1600 sqft</option>
                                        <option value="1700">1700 sqft</option>
                                        <option value="1800">1800 sqft</option>
                                        <option value="1900">1900 sqft</option>
                                        <option value="2000">2000 sqft</option>
                                        <option value="2500">2500 sqft</option>
                                        <option value="3000">3000 sqft</option>
                                        <option value="4000">4000 sqft</option>
                                        <option value="5000">5000 sqft</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <select name="max_area" class="hero__form-input  form-control custom-select  mb-20">
                                        <option value="">Max Area</option>
                                        <option value="500">500 sqft</option>
                                        <option value="600">600 sqft</option>
                                        <option value="700">700 sqft</option>
                                        <option value="800">800 sqft</option>
                                        <option value="900">900 sqft</option>
                                        <option value="1000">1000 sqft</option>
                                        <option value="1100">1100 sqft</option>
                                        <option value="1200">1200 sqft</option>
                                        <option value="1300">1300 sqft</option>
                                        <option value="1400">1400 sqft</option>
                                        <option value="1500">1500 sqft</option>
                                        <option value="1600">1600 sqft</option>
                                        <option value="1700">1700 sqft</option>
                                        <option value="1800">1800 sqft</option>
                                        <option value="1900">1900 sqft</option>
                                        <option value="2000">2000 sqft</option>
                                        <option value="2500">2500 sqft</option>
                                        <option value="3000">3000 sqft</option>
                                        <option value="4000">4000 sqft</option>
                                        <option value="5000">5000 sqft</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-lg-none d-md-none col-md-12 col-sm-12 pl-0">
                            <div class="submit_btn w-100">
                                <button type="submit" class="btn btn-block v3">Search</button>
                            </div>
                        </div>


                        <div class="col-md-12 dropdown-filter">Show <span id="gowa">more</span> search options<i
                                class="fas fa-angle-double-down"></i></div>


                    </div>
                </form>
            </div>
            <div class="col-md-10  ml-auto mr-auto mobile">
                <form action="{{url('properties')}}" class="hero__form v2 filter listing-filter bg-cb" method="get">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="input-group">
                                <input type="text" class="typeahead" name="keyword" id="keyword"
                                    placeholder="Search Property" style="width: 88%;height: 35px;padding:0 0 0 10px"
                                    value="{{Request::get('keyword')}}">
                                <div class="input-group-append" style="width: 40px;">
                                    <button class="btn btn-secondary" type="submit" style="width: 100px;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
