@extends("front.layouts.main")
@section('head_title', trans('words.add_property').' | '.getcong('site_name') )
@section('head_url', Request::url())
@section('content')
    <div class="overlay"></div>
    <div class="spanner">
        <div class="loader"></div>
        <p>Uploading music file, please be patient.</p>
    </div>
    <style>
        .spanner{
            position:absolute;
            top: 50%;
            left: 0;
            background: #2a2a2a55;
            width: 100%;
            display:block;
            text-align:center;
            height: 300px;
            color: #FFF;
            transform: translateY(-50%);
            z-index: 1000;
            visibility: hidden;
        }

        .overlay{
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            visibility: hidden;
        }

        .loader,
        .loader:before,
        .loader:after {
            border-radius: 50%;
            width: 2.5em;
            height: 2.5em;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
            -webkit-animation: load7 1.8s infinite ease-in-out;
            animation: load7 1.8s infinite ease-in-out;
        }
        .loader {
            color: #ffffff;
            font-size: 10px;
            margin: 80px auto;
            position: relative;
            text-indent: -9999em;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }
        .loader:before,
        .loader:after {
            content: '';
            position: absolute;
            top: 0;
        }
        .loader:before {
            left: -3.5em;
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }
        .loader:after {
            left: 3.5em;
        }
        @-webkit-keyframes load7 {
            0%,
            80%,
            100% {
                box-shadow: 0 2.5em 0 -1.3em;
            }
            40% {
                box-shadow: 0 2.5em 0 0;
            }
        }
        @keyframes load7 {
            0%,
            80%,
            100% {
                box-shadow: 0 2.5em 0 -1.3em;
            }
            40% {
                box-shadow: 0 2.5em 0 0;
            }
        }

        .show{
            visibility: visible;
        }

        .spanner, .overlay{
            opacity: 0;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
        }

        .spanner.show, .overlay.show {
            opacity: 1
        }
        .bootstrap-tagsinput{
            border: 1px solid #ddd;
            /* margin-top: 25px; */
            border-radius: 3px;
            width: 100%;
            padding: 10px 20px;
            height: 45px;
            font-weight: 300;
            font-size: 14px;
        }
        .prev {
            float: left
        }

        .next {
            float: right
        }

        .steps {
            list-style: none;
            width: 100%;
            overflow: hidden;
            margin: 0;
            padding: 0
        }

        .steps li {
            color: #b0b1b3;
            font-size: 24px;
            float: left;
            padding: 10px;
            transition: all .3s;
            -moz-transition: all .3s;
            -webkit-transition: all .3s;
            -o-transition: all .3s
        }

        .steps li span {
            font-size: 11px;
            display: block
        }

        .steps li.current {
            color: #000
        }

        .breadcrumb {
            height: 50px
        }

        .breadcrumb li {
            background: #eee;
            font-size: 14px
        }

        .breadcrumb li.current:after {
            border-top: 25px solid transparent;
            border-bottom: 25px solid transparent;
            border-left: 6px solid #666;
            content: ' ';
            position: absolute;
            top: 0;
            right: -6px
        }

        .breadcrumb li.current {
            background: #666;
            color: #eee;
            position: relative
        }

        .breadcrumb li:last-child:after {
            border: none
        }
      #p-map {
            width: 100%;
            height: 340px;
            border: 1px solid #50AEE6;
        }
        .bootstrap-tagsinput{
            padding-left: 0
        }
        .label-info {
            background-color: #5bc0de;
        }
        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: bold;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25em;
        }
        .gmnoprint,button.gm-control-active.gm-fullscreen-control{
            display:none;
        }
#searchInput {
    left: 0 !important;
}
        .searchInputformError.parentFormsubmit-property-main-form.formError{
            top: 50px !important;
            left: 1050px !important;
        }
        .parentFormsubmit-property-main-form.formError {
            margin-top: -40px !important;
        }
    </style>

    <div class="breadcrumb-section page-title bg-h"
         style="background-image: url('{{asset('assets/images/backgrounds/bg-4.jpg')}}')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto text-center">
                    <div class="breadcrumb-menu">
                        <h2>Submit Property</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="list-details-section section-padding add_list pt-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div id="property_message" class="alert alert-success" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> </button>
                        Your property has been submitted successfully!
                    </div>

                    <form id="submit-property-main-form" enctype="multipart/form-data">
                     @csrf
                        <fieldset>
                            <legend>Basic Details</legend>
                            <div class="row">
                            @if(Auth::user()->usertype=='Admin') 
                            <div class="col-md-8">
                                    <div class="form-group">                                                                              
                                        <label>Agency</label>
                                        <select class="listing-input hero__form-input  form-control custom-select validate[required]" data-errormessage-value-missing="Agency is required!" name="agency_id">
                                            <option value="">Select an Agency</option>
                                                @foreach($agencies as $agency)
                                                    <option value="{{$agency->id}}" @if(old('agency_id')==$agency->id) selected @endif>{{$agency->name}}</option>
                                                @endforeach
                                </select>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Property Title</label>
                                        <input type="text" class="form-control filter-input validate[required]"
                                               placeholder="{{trans('words.property_name')}}" name="property_name"
                                               id="p-title" value="{{ old('property_name') }}"
                                               data-errormessage-value-missing="Property Title is required!">
                                        @if ($errors->has('property_name'))
                                            <span style="color:#fb0303">
                                                {{ $errors->first('property_name') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Featured Image</label>
                                        <div class="custom-file">
                                            <input type="file" name="featured_image" class="custom-file-input validate[required]"
                                                   id="featured_image" aria-describedby="featured_image" data-errormessage-value-missing="Featured Image is required!">
                                            <label class="custom-file-label" for="featured_image">Choose Image ONLY (584px ×
                                                515px)</label>
                                        </div>
                                        <div class="mt-2 row custom-file-gallery"></div>
                                    </div>
                                </div>
                                <div class="col-md-12" >
                                    <label>Address</label>
                                    <input type="text"  placeholder="{{trans('words.address')}}" name="address"
                                           id="searchInput" style="left:0 !important;" value="{{ old('address') }}" class="form-control filter-input validate[required]"  data-errormessage-value-missing="Address is required!">

                                    @if ($errors->has('address'))
                                        <span style="color:#fb0303">
                                            {{ $errors->first('address') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                         <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="map_longitude" placeholder="{{trans('words.longitude')}}"
                                           id="lng" class="form-control filter-input" value="{{ old('map_longitude') }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="map_latitude" placeholder="{{trans('words.latitude')}}"
                                           id="lat" class="form-control filter-input" value="{{ old('map_latitude') }}" readonly>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" rows="5" cols="50" placeholder="{{trans('words.description')}}" class="form-control validate[required]" data-errormessage-value-missing="Description is required!">{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                            <span style="color:#fb0303">
                                                {{ $errors->first('description') }}
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Gallery</legend>
                            <div class="row mb-10">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-images"></div>
                                    </div>
                                </div>

                                <div class="col-md-12 ">
                                    <label>Property Video Link</label>
                                    <input type="url" name="video_code" class="form-control filter-input" placeholder="https://www.youtube.com/watch?v=dqD0SqMNtks">
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Property Details</legend>
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Property Life</label>
                                    <input type="number" name="age" class="form-control filter-input" id="p-age"
                                           placeholder="Property life" value="{{ old('age') }}" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Land Area</label>
                                    <input type="number" name="land_area" class="form-control filter-input validate[required]" data-errormessage-value-missing="Land Area is required!" id="p-land"
                                           placeholder="{{trans('words.land_area')}}" value="{{ old('land_area') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Build Area</label>
                                    <input type="number" name="build_area" class="form-control filter-input validate[required]" data-errormessage-value-missing="Build Area is required!" id="p-build"
                                           placeholder="{{trans('words.build_area')}}" value="{{ old('build_area') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Property Price</label>
                                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                    <input type="number" name="price" class="form-control filter-input validate[required]" data-errormessage-value-missing="Property Price is required!" id="p-price"
                                           placeholder="{{trans('words.price')}}" value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Property Type</label>
                                <select class="listing-input hero__form-input  form-control custom-select validate[required]" data-errormessage-value-missing="Property Type is required!" name="property_type">
                                    <option value="">{{trans('words.property_type')}}</option>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}" @if(old('property_type')==$type->id) selected @endif>{{$type->types}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Property Purpose</label>
                                <select class="listing-input hero__form-input  form-control custom-select validate[required]" data-errormessage-value-missing="Property Purpose is required!" name="property_purpose" >
                                    <option value="">{{trans('words.property_purpose')}}</option>
                                    <option value="1" @if(old('property_purpose')==1) selected @endif>{{trans('words.for_sale')}}</option>
                                    <option value="2" @if(old('property_purpose')==2) selected @endif>{{trans('words.for_rent')}}</option>
                                </select>

                                @if ($errors->has('property_purpose'))
                                    <span style="color:#fb0303">
                                            {{ $errors->first('property_purpose') }}
                                        </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label>Rental Period</label>
                                <select name="rental_period" class="listing-input hero__form-input  form-control custom-select" id="rental_period">
                                    <option value="">Select Rental Period</option>
                                    <option value="Daily" @if(old('rental_period')=="Daily") selected @endif>Daily</option>
                                    <option value="Weekly" @if(old('rental_period')=="Weekly") selected @endif>Weekly</option>
                                    <option value="Monthly" @if(old('rental_period')=="Monthly") selected @endif>Monthly</option>
                                    <option value="Yearly" @if(old('rental_period')=="Yearly") selected @endif>Yearly</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Number of Rooms</label>
                                    <select id="p-room" name="rooms" class="listing-input hero__form-input  form-control custom-select validate[required]" data-errormessage-value-missing="No of Room is required!">
                                        <option value="">{{trans('words.room')}}</option>
                                        <option value="1" @if(old('room')=='1') selected @endif>1</option>
                                        <option value="2" @if(old('room')=='2') selected @endif>2</option>
                                        <option value="3" @if(old('room')=='3') selected @endif>3</option>
                                        <option value="4" @if(old('room')=='4') selected @endif>4</option>
                                        <option value="5" @if(old('room')=='5') selected @endif>5</option>
                                        <option value="6" @if(old('room')=='6') selected @endif>6</option>
                                        <option value="7" @if(old('room')=='7') selected @endif>7</option>
                                        <option value="7+" @if(old('room')=='7+') selected @endif>7+</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Number of Bedrooms</label>

                                    <select id="p-bedroom" name="bedrooms" class="listing-input hero__form-input  form-control custom-select validate[required]" data-errormessage-value-missing="No of Bedrooms is required!">
                                        <option value="">{{trans('words.bedroom')}}</option>
                                        <option value="1" @if(old('bedrooms')=='1') selected @endif>1</option>
                                        <option value="2" @if(old('bedrooms')=='2') selected @endif>2</option>
                                        <option value="3" @if(old('bedrooms')=='3') selected @endif>3</option>
                                        <option value="4" @if(old('bedrooms')=='4') selected @endif>4</option>
                                        <option value="5" @if(old('bedrooms')=='5') selected @endif>5</option>
                                        <option value="6" @if(old('bedrooms')=='6') selected @endif>6</option>
                                        <option value="7" @if(old('bedrooms')=='7') selected @endif>7</option>
                                        <option value="7+" @if(old('bedrooms')=='7+') selected @endif>7+</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Number of Bath</label>
                                    <select name="bathrooms" class="listing-input hero__form-input  form-control custom-select validate[required]" data-errormessage-value-missing="No of Bathrooms is required!">
                                        <option value="">{{trans('words.bathroom')}}</option>
                                        <option value="1" @if(old('bathroom')=='1') selected @endif>1</option>
                                        <option value="2" @if(old('bathroom')=='2') selected @endif>2</option>
                                        <option value="3" @if(old('bathroom')=='3') selected @endif>3</option>
                                        <option value="4" @if(old('bathroom')=='4') selected @endif>4</option>
                                        <option value="5" @if(old('bathroom')=='5') selected @endif>5</option>
                                        <option value="6" @if(old('bathroom')=='6') selected @endif>6</option>
                                        <option value="7" @if(old('bathroom')=='7') selected @endif>7</option>
                                        <option value="7+" @if(old('bathroom')=='7+') selected @endif>7+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Number of Garages</label>
                                    <select id="garage" name="garage" class="listing-input hero__form-input  form-control custom-select">
                                        <option value="">{{trans('words.garages')}}</option>
                                        <option value="1" @if(old('garage')=='1') selected @endif>1</option>
                                        <option value="2" @if(old('garage')=='2') selected @endif>2</option>
                                        <option value="3" @if(old('garage')=='3') selected @endif>3</option>
                                        <option value="4" @if(old('garage')=='4') selected @endif>4</option>
                                        <option value="5" @if(old('garage')=='5') selected @endif>5</option>
                                        <option value="+5" @if(old('garage')=='+5') selected @endif>+5</option>
                                    </select>

                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label>Amenities</label>
                                    <div class="row">
                                    @if(count($amenities)>0)
                                        @foreach($amenities as $amenity)
                                            <div class="col-md-3">
                                                <input type="checkbox" name="property_features[]"
                                                       value="{{$amenity->id}}"/><label for="customCheck">{{$amenity->name}}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                            </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Neighbourhood</legend>
                            <div class="nearby_container">

                                <div id="nearby_plans" class="nearbyplan-container-wrapper-0 box box-default">
                                    <div class="row ">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" class="form-control filter-input" name="nearby_category_name[]" value="{{ old('nearby_category_name') }}" placeholder="Food/Education/Health">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control filter-input" name="nearby_title[]" value="{{ old('nearby_title') }}" placeholder="KFC/City School/All Hospital">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Distance</label>
                                        <input type="text" class="form-control filter-input" name="nearby_distance[]" value="{{ old('nearby_distance') }}" placeholder="1.5 KM">

                                    </div>
                                </div>
                                <hr/>
                            </div>
                            </div>

                            </div>
                            <div class="text-right mb-10">
                            <button type="button" class="btn btn-primary sales_product"
                                    onclick="addnegihbourhoodFields()"><i class="fa fa-plus"></i> Add More
                            </button>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Floor Plan</legend>
                            <div class="floorplan_container">
                                <div id="floorplans" class="floorplan-container-wrapper-0 box box-default">
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Floor Name</label>
                                                <input type="text" class="form-control filter-input" name="floor_name[]" value="{{ old('floor_name') }}" placeholder="Floor Name">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Floor Size</label>
                                                <input type="number" class="form-control filter-input" name="floor_size[]" value="{{ old('floor_size') }}" placeholder="Floor Size">

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Floor Room</label>
                                                <input type="number" class="form-control filter-input" name="floor_room[]" value="{{ old('floor_room') }}" placeholder="Floor Room">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Floor Bathroom</label>
                                                <input type="number" class="form-control filter-input" name="floor_bathroom[]" value="{{ old('floor_bathroom') }}" placeholder="Floor Bathroom">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Floor Image</label>
                                                <div class="custom-file">
                                                    <input type="file" name="floor_plan_image[]" class="custom-file-input" multiple
                                                           id="floor_plan_image" aria-describedby="floor_plan_image">
                                                    <label class="custom-file-label" for="floor_plan_image">Choose Image ONLY (584px ×
                                                        515px)</label>
                                                </div>
                                                <div class="mt-2 row custom-file-gallery"></div>
                                                 </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mb-10">
                                <button type="button" class="btn btn-primary sales_product"
                                        onclick="addfloorplanFields()"><i class="fa fa-plus"></i> Add More
                                </button>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Property Documents</legend>

                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="property_document" class="custom-file-input" multiple
                                           id="property_document" aria-describedby="property_document">
                                    <label class="custom-file-label" for="property_document">Choose Document ONLY (584px ×
                                        515px)</label>
                                </div>
                                <div class="mt-2 row custom-file-gallery"></div>
                            </div>
                            <input id="SubmitProperty" type="button" class="btn btn-primary float-right" value="Save Property"/>
                        </fieldset>

                    </form>
                </div>
            </div>
        </div>


        <!-- <span class="scrolltotop"><i class="lnr lnr-arrow-up"></i></span> -->
    </div>

@endsection

@section('scripts-custom')
    <script>CKEDITOR.replace( 'p-desc' );</script>
    <script>CKEDITOR.replace( 'f-desc' );</script>

    <script>
        $('.input-images').imageUploader();

        //$('.input-documents').imageUploader();

        var counter = 1;

        function addnegihbourhoodFields() {
            clone = $("#nearby_plans").first().clone();
            clone.attr('class', 'nearbyplan-container-wrapper-' + counter + ' box box-default').appendTo(".nearby_container");
            clone.prepend('<button type="button" class="btn btn-danger" onclick="removenearbyFields(this)" style="float: right">&times;</button>').appendTo(".nearby_container");
            clone.find('input[type="number"]').val('');
            clone.find('input[type="text"]').val('');
            counter++;
        }

        function addfloorplanFields() {
            clone = $("#floorplans").first().clone();
            clone.attr('class', 'floorplan-container-wrapper-' + counter + ' box box-default').appendTo(".floorplan_container");
            clone.prepend('<button type="button" class="btn btn-danger" onclick="removefloorplanFields(this)" style="float: right">&times;</button>').appendTo(".floorplan_container");
            clone.find('input[type="number"]').val('');
            clone.find('input[type="text"]').val('');
            counter++;
        }

        function removenearbyFields(element) {
            $(element).parent().remove();
        }

        function removefloorplanFields(element) {
            $(element).parent().remove();
        }

        $( function() {
            var $signupForm = $( '#submit-property-main-form' );

            $signupForm.validationEngine();

            $signupForm.formToWizard({
                submitButton: 'SaveProperty',
                showProgress: true, //default value for showProgress is also true
                nextBtnName: 'Next',
                prevBtnName: 'Previous',
                nextBtnClass:       'btn next btn-primary',
                prevBtnClass:       'btn prev btn-primary',
                showStepNo: false,
                validateBeforeNext: function() {
                    return $signupForm.validationEngine( 'validate' );
                }
            });

            $( '#txt_stepNo' ).change( function() {
                $signupForm.formToWizard( 'GotoStep', $( this ).val() );
            });

            $( '#btn_next' ).click( function() {
                $signupForm.formToWizard( 'NextStep' );
            });

            $( '#btn_prev' ).click( function() {
                $signupForm.formToWizard( 'PreviousStep' );
            });
            if($signupForm.valid()) {
                $(document).on('click', '#SubmitProperty' , function (e) {
                    e.preventDefault();
                    if (e.keyCode == 13) {
                        e.preventDefault();
                        return false;
                    }
                    $.ajax({
                        url: '{{ route('add-new-property') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: new FormData(document.getElementById("submit-property-main-form")),
                        processData: false,
                        contentType: false,
                        beforesubmit:function(response)
                        {
                            $("div.spanner").addClass("show");
                            $("div.overlay").addClass("show");
                        },
                        success: function (data) {

                            toastr.success(data.message);
                            setTimeout(function () {
                               window.location.href= '{{url('/')}}';
                            },1000)
                        },
                        error: function(json){
                            if (json.status === 422) {
                                var resJSON = json.responseJSON;
                                swal("Error!", resJSON, "error");
                            } else {
                                // Error
                                // Incorrect credentials
                                // alert('Incorrect credentials. Please try again.')
                            }
                        }
                    });
                });
            }
        });
        // function initialize() {
        //     var input = document.getElementById('address');
        //     var autocomplete = new google.maps.places.Autocomplete(input);
        //     google.maps.event.addListener(autocomplete, 'place_changed', function () {
        //         var place = autocomplete.getPlace();
        //       $('#searchInput').val(place);
        //     });
        // }
        // google.maps.event.addDomListener(window, 'load', initialize);
        /* script */
function initializes() {
  var latlng = new google.maps.LatLng(28.5355161,77.39102649999995);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 20
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
  });
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(20);
        }

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);

    });
    // this function will work on marker move event into map
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {
              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}
function bindDataToForm(address,lat,lng){
  document.getElementById('lat').value = lat;
  document.getElementById('lng').value = lng;
}
google.maps.event.addDomListener(window, 'load', initializes);
    </script>

@endsection
