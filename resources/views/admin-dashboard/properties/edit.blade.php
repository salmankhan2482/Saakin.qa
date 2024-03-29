@extends('admin-dashboard.layouts.master')
@section('style')
    <link href="{{ asset('admin/css/image-uploader.css') }}" type="text/css" rel="stylesheet" />
@endsection
@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('flash_message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('flash_message') }}
        </div>
    @endif
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Property</h4>
                        <a href="{{ url()->previous() }}">
                           <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i>
                              Back
                           </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="panel-body">
                                {!! Form::open(['route' => ['properties.update', $data['property']->id], 'method' => 'PUT', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                                <fieldset>
                                    <legend>Basic Details</legend>
                                    <div class="row">

                                        @if (Auth::User()->usertype == 'Admin')
                                            <div class="col-6">
                                                <label>Property Agency *</label>
                                                <select class="form-control" name="agency_id" required>
                                                    <option value="">Select an Agency</option>

                                                    @foreach (\App\Agency::orderBy('name', 'asc')->get() as $agency)
                                                        <option value="{{ $agency->id }}"
                                                            @if ($agency->id == $data['property']->agency_id) selected @endif>
                                                            {{ $agency->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        <div class="col-6">
                                            <label>Property Title *</label>
                                            <input type="text" class="form-control" name="property_name" id="p-title"
                                                value="{{ stripslashes($data['property']->property_name) }}" required />
                                        </div>
                                    </div>

                                </fieldset>
                                <fieldset>
                                    <legend>Property Details</legend>
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="hidden" name="age" value="0" />
                                            <input type="hidden" name="build_area" value="0">
                                            <input type="hidden" name="rental_period" value="Monthly">
                                            <input type="hidden" name="rooms" value="0">
                                            <input type="hidden" name="garage" value="0">
                                            <label>Property Purpose</label>
                                            <select class="form-control" name="property_purpose" id="property_purpose"
                                                required>
                                                <option value="">{{ trans('words.property_purpose') }}</option>

                                                @foreach ($data['purposes'] as $purpose)
                                                    <option value="{{ $purpose->name }}"
                                                        @if ($data['property']->property_purpose == $purpose->name) selected @endif>
                                                        {{ $purpose->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label>Property Type</label>
                                            <select class="form-control" id="property_type" name="property_type" required>
                                                <option value="">{{ trans('words.property_type') }}</option>

                                                @foreach ($data['types'] as $type)
                                                    <option value="{{ $type->id }}"
                                                        @if ($data['property']->property_type == $type->id) selected @endif>
                                                        {{ $type->types }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label>Reference Code</label>
                                            <input type="text" name="reference_code" class="form-control" id="p-reference_code"
                                                   placeholder="Reference Code"
                                                value="{{ $data['property']->refference_code }}" required>
                                        </div>

                                        <div class="col-3">
                                            <label>Number of Beds</label>
                                            <select id="bedrooms" name="bedrooms"
                                                class="listing-input hero__form-input  form-control custom-select">
                                                <option value="">{{ trans('words.bedroom') }}</option>
                                                <option value="1" @if ($data['property']->bedrooms == '1') selected @endif>1
                                                </option>
                                                <option value="2" @if ($data['property']->bedrooms == '2') selected @endif>2
                                                </option>
                                                <option value="3" @if ($data['property']->bedrooms == '3') selected @endif>3
                                                </option>
                                                <option value="4" @if ($data['property']->bedrooms == '4') selected @endif>4
                                                </option>
                                                <option value="5" @if ($data['property']->bedrooms == '5') selected @endif>5
                                                </option>
                                                <option value="6" @if ($data['property']->bedrooms == '6') selected @endif>6
                                                </option>
                                                <option value="7" @if ($data['property']->bedrooms == '7') selected @endif>7
                                                </option>
                                                <option value="8" @if ($data['property']->bedrooms == '8') selected @endif>8
                                                </option>
                                                <option value="9" @if ($data['property']->bedrooms == '9') selected @endif>9
                                                </option>
                                                <option value="10" @if ($data['property']->bedrooms == '10') selected @endif>10
                                                </option>

                                            </select>
                                        </div>

                                        <div class="col-3">
                                            <label>Number of Baths</label>
                                            <select name="bathrooms" id="bathrooms"
                                                class="listing-input hero__form-input  form-control custom-select">
                                                <option value="">{{ trans('words.bathroom') }}</option>
                                                <option value="1" @if ($data['property']->bathrooms == '1') selected @endif>1
                                                </option>
                                                <option value="2" @if ($data['property']->bathrooms == '2') selected @endif>2
                                                </option>
                                                <option value="3" @if ($data['property']->bathrooms == '3') selected @endif>3
                                                </option>
                                                <option value="4" @if ($data['property']->bathrooms == '4') selected @endif>4
                                                </option>
                                                <option value="5" @if ($data['property']->bathrooms == '5') selected @endif>5
                                                </option>
                                                <option value="6" @if ($data['property']->bathrooms == '6') selected @endif>6
                                                </option>
                                                <option value="7" @if ($data['property']->bathrooms == '7') selected @endif>7
                                                </option>
                                                <option value="8" @if ($data['property']->bathrooms == '8') selected @endif>8
                                                </option>
                                                <option value="9" @if ($data['property']->bathrooms == '9') selected @endif>9
                                                </option>
                                                <option value="10" @if ($data['property']->bathrooms == '10') selected @endif>10
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-3">
                                            <label>Property Price</label>
                                            <input type="number" name="price" class="form-control" id="p-price" min="0"
                                                value="{{ $data['property']->price }}" required>
                                        </div>

                                        <div class="col-3">
                                            <label>Property Size</label>
                                            <input type="number" name="land_area" class="form-control" id="p-land"
                                                value="{{ $data['property']->land_area }}" required>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>Location</legend>
                                    <div class="row">
                                        <div class="col-6">
                                            <label>City</label>
                                            <select name="city" id="city" class="form-control"
                                                onchange="callSubCityTown(this);">
                                                <option value="">Select City</option>
                                                @foreach ($data['cities'] as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ $data['property']->city == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label>Sub City</label>
                                            <select name="subcity" id="subcity" class="form-control"
                                                onchange="callTown(this);">
                                                <option value="">Select Sub City</option>
                                                @foreach ($data['subCities'] as $subCity)
                                                    <option value="{{ $subCity->id }}"
                                                        {{ $data['property']->subcity == $subCity->id ? 'selected' : '' }}>
                                                        {{ $subCity->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label>Town</label>
                                            <select name="town" id="town" class="form-control" onchange="callArea(this);">
                                                <option value="">Select Town</option>
                                                @foreach ($data['towns'] as $town)
                                                    <option value="{{ $town->id }}"
                                                        {{ $data['property']->town == $town->id ? 'selected' : '' }}>
                                                        {{ $town->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label>Area</label>
                                            <select name="area" id="area" class="form-control"
                                                onchange="callLatLong(this);">
                                                <option value="">Select Area</option>
                                                @foreach ($data['areas'] as $area)
                                                    <option value="{{ $area->id }}"
                                                        {{ $data['property']->area == $area->id ? 'selected' : '' }}>
                                                        {{ $area->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label>Longitude</label>
                                            <input type="text" name="map_longitude" id="p-long" class="form-control"
                                                value="{{ $data['property']->map_longitude }}" />
                                        </div>

                                        <div class="col-6">
                                            <label>Latitude</label>
                                            <input type="text" name="map_latitude" id="p-lat" class="form-control"
                                                value="{{ $data['property']->map_latitude }}" />
                                        </div>

                                    </div>


                                </fieldset>
                                <fieldset>
                                    <legend>Agent</legend>
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Agent Name</label>
                                            <input type="text" class="form-control" autocomplete="off"
                                                value="{{ $data['property']->agent_name }}" name="agent_name"
                                                id="agent_name">
                                        </div>

                                        <div class="col-6">
                                            <label>Agent Whatsapp</label>
                                            <input type="text" class="form-control" autocomplete="off"
                                                value="{{ $data['property']->whatsapp }}" name="whatsapp" id="whatsapp">
                                        </div>

                                        <div class="col-6">
                                            <label>Agent Picture</label>
                                            <input type="file" name="agent_picture" id="agent_picture"
                                                class="form-control">
                                            @if (!empty($data['property']->agent_picture))
                                                <img src="{{ URL::asset('upload/properties/' . $data['property']->agent_picture) }}"
                                                    alt="{{ $data['property']->property_name . '- agent picture' }}"
                                                    class="mt-1" width="200">
                                            @endif
                                        </div>
                                        <div class="col-6">
                                            <label>Featured Image</label>
                                            <input type="file" name="featured_image" class="form-control">
                                            @if (!empty($data['property']->featured_image))
                                                <img src="{{ URL::asset('upload/properties/thumb_' . $data['property']->featured_image) }}"
                                                    alt="{{ $data['property']->property_name . '- featured image' }}"
                                                    class="mt-1">
                                            @endif
                                        </div>


                                    </div>
                                </fieldset>
                                <input type="hidden" name="video_code" class="form-control" value="0">
                                <div class="row">
                                    <div class="col-12">
                                        <label>Description</label>
                                        <textarea class="form-control" rows="4" name="description" id="p-desc"
                                            required>{{ $data['property']->description }}</textarea>
                                    </div>
                                </div>

                                <fieldset>
                                    <legend>Gallery</legend>
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Gallery Image(s)</label>
                                            <div class="container">
                                                @if (!empty($data['property_gallery_images']))
                                                    @foreach ($data['property_gallery_images'] as $gallery_image)
                                                        <img src="{{ URL::asset('upload/gallery/' . $gallery_image) }}"
                                                            alt="{{ $gallery_image }}" width="100" height="100" />
                                                        {{-- <img src="{{ URL::asset('upload/gallery'.$data['property_gallery_images']) }}"  alt="{{ $data['property_gallery_images'].'- Gallery Image' }}" class="mt-1"> --}}
                                                    @endforeach
                                                @endif
                                            </div>
                                            <input type="file" name="images[]" class="form-control gallery_image mt-4" multiple value="{{$data['property_gallery_images']}}">
                                            {{-- <div class="gallery_image mt-4"> --}}
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <legend>Amenities</legend>
                                        <div class="col-md-12">

                                            <div class="row">
                                                @if (count($data['amenities']) > 0)
                                                    @foreach ($data['amenities'] as $amenity)
                                                        <div class="col-md-4 custom-control custom-checkbox">
                                                            <input type="checkbox" name="property_amenities[]"
                                                                value="{{ $amenity->id }}"
                                                                {{ $data['property']->amenities->contains($amenity->id) ? 'checked' : '' }}>
                                                            <label>
                                                                {{ $amenity->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </fieldset>


                                <fieldset>
                                    <legend>Property Documents & Meta</legend>
                                    <div class="row">
                                        <div class="col-6">
                                            <label>
                                                Choose Document ONLY (584px × 515px)
                                            </label>
                                            <input type="file" name="property_document" multiple="" class="form-control">
                                        </div>

                                        <div class="col-6">
                                            <label>{{ trans('words.meta_title') }}</label>
                                            <input class="form-control" rows="4" name="meta_title" id="p-desc"
                                                value="{{ $data['property']->meta_title }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <label>{{ trans('words.meta_description') }}</label>
                                            <textarea class="form-control" rows="4" name="meta_description"
                                                id="meta_description">{{ $data['property']->meta_description }}</textarea>
                                        </div>

                                        <div class="col-6">
                                            <label>{{ trans('words.meta_keyword') }}</label>
                                            <textarea class="form-control" rows="4" name="meta_keyword"
                                                id="meta_keyword">{{ $data['property']->meta_keyword }}</textarea>
                                        </div>
                                    </div>

                                </fieldset>
                                <div class="m-4">
                                    <button id="SaveProperty" type="submit" class="btn btn-rounded btn-success">Update
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ URL::asset('admin/js/jquery.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('admin/js/image-uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/parsley.min.js') }}"></script>


    <script>
        function callSubCityTown(data) {
            var id = data.value;

            $.ajax({
                type: "GET",
                url: "{{ route('callSubCityTown') }}",
                async: true,
                data: {
                    id: id // as you are getting in request('id') 
                },
                success: function(response) {
                    var subcities = response['subcities'];
                    var towns = response['towns'];
                    var areas = response['areas'];

                    clearEveryThing('subcity', 'town', 'area', 'p-lat', 'p-long');

                    if (subcities == '<option value="">No Result Found</option>') {
                        $("#subcity").append('<option value="">No Result Found</option>');
                    } else {
                        $.each(subcities, function(key, value) {
                            $("#subcity").append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                        $("#subcity").append('<option value="">Select Sub City</option>');
                    }


                    if (towns === '<option value="">No Result Found</option>') {
                        $("#town").append('<option value="">No Result Found</option>');
                    } else {
                        $.each(towns, function(key, value) {
                            $("#town").append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                        $("#town").append('<option value="">Select Town</option>');

                    }

                    if (areas === '<option value="">No Result Found</option>') {
                        $("#area").append('<option value="">No Result Found</option>');
                    } else {
                        $("#area").empty();
                        $.each(areas, function(key, value) {
                            $("#area").append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                        $("#area").append('<option value="">Select Area</option>');

                    }

                    assignLatLong(areas[0].latitude, areas[0].longitude, towns[0].latitude,
                        towns[0].longitude, subcities[0].latitude, subcities[0].longitude);

                }
            });

        }

        function callTown(data) {
            var id = data.value;

            $.ajax({
                type: "GET",
                url: "{{ route('callTown') }}",
                async: true,
                data: {
                    id: id // as you are getting in request('id') 
                },
                success: function(response) {
                    var subcities = response['subcities'];
                    var towns = response['towns'];
                    var areas = response['areas'];

                    clearEveryThing('', 'town', 'area', 'p-lat', 'p-long');

                    if (towns == '<option value="">No Result Found</option>') {
                        $("#town").append('<option value="">No Result Found</option>');
                    } else {
                        $.each(towns, function(key, value) {
                            $("#town").append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                        $("#town").append('<option value="">Select Town</option>');

                    }

                    if (areas == '<option value="">No Result Found</option>') {
                        $("#area").append('<option value="">No Result Found</option>');
                    } else {
                        $.each(areas, function(key, value) {
                            $("#area").append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                        $("#area").append('<option value="">Select Area</option>');
                    }

                    assignLatLong(areas[0].latitude, areas[0].longitude, towns[0].latitude,
                        towns[0].longitude, subcities[0].latitude, subcities[0].longitude);
                }
            });

        }

        function callArea(data) {
            var id = data.value;
            var pre = $("#subcity").val();

            $.ajax({
                type: "GET",
                url: "{{ route('callArea') }}",
                async: true,
                data: {
                    id: id, // as you are getting in request('id') 
                    pre: pre
                },
                success: function(response) {
                    var areas = response['areas'];
                    var subcities = response['subcities'];
                    var towns = response['towns'];
                    console.log(subcities);
                    clearEveryThing('', '', 'area', 'p-lat', 'p-long');

                    if (areas === '<option value="">No Result Found</option>') {
                        $("#area").append('<option value="">No Result Found</option>');

                    } else if (areas === '<option value="">No Result Found</option>') {
                        $("#town").append('<option value="">No Result Found</option>');

                    } else {
                        $("#area").empty();
                        $.each(areas, function(key, value) {
                            $("#area").append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                            $("#p-lat").val(value.latitude);
                            $("#p-long").val(value.longitude);
                        });
                        $("#area").append('<option value="">Select Area</option>');

                    }

                    assignLatLong(areas[0].latitude, areas[0].longitude, towns[0].latitude,
                        towns[0].longitude, subcities.latitude, subcities.longitude);
                }
            });

        }

        function callLatLong(data) {
            var id = data.value;
            var pre = $("#town").val();

            $.ajax({
                type: "GET",
                url: "{{ route('callLatLong') }}",
                async: true,
                data: {
                    id: id,
                    pre: pre
                },
                success: function(response) {
                    var subcities = response['subcities'];
                    var towns = response['towns'];
                    var areas = response['latLong'];
                    console.log(areas);
                    $("#p-lat").val('');
                    $("#p-long").val('');

                    assignLatLong(areas.latitude, areas.longitude, towns.latitude ?? '',
                        towns.longitude ?? '', subcities.latitude ?? '', subcities.longitude ?? '');

                }
            });

        }

        function assignLatLong(alat, alon, tlat, tlon, slat, slon) {
            if (alat && alon) {
                $("#p-lat").val(alat);
                $("#p-long").val(alon);
            } else if (tlat && tlon) {
                $("#p-lat").val(tlat);
                $("#p-long").val(tlon);
            } else if (slat && slon) {
                $("#p-lat").val(slat);
                $("#p-long").val(slon);
            }
        }

        function clearEveryThing(subcity, town, area, p_lat, p_long) {
            $(`#${subcity}`).empty();
            $(`#${town}`).empty();
            $(`#${area}`).empty();
            $(`#${p_lat}`).val('');
            $(`#${p_long}`).val('');
        }

        $('.gallery_image').imageUploader({
            maxFiles: 10,
            extensions: ['.jpg', '.jpeg', '.png', '.gif'],
            mimes: ['image/jpeg', 'image/png', 'image/gif'],

        });

        $("form[name='type_form']").parsley();

        $(document).on('change', '#property_purpose', function() {
            var val = $('#property_purpose').val();
            if (val == 'For Rent') {
                $('.rental_period').css('display', 'block');
            } else {
                $('.rental_period').css('display', 'none');
            }
        });


        $('#property_type').on('change', function() {
            var proprty_type = $(this).val();
            const proprty_type_id = ['4', '7', '13', '15', '16', '17', '23', '27', '34', '35', '36'];
            if (proprty_type_id.includes(proprty_type) == true) {

                console.log(proprty_type);
                $('#bathrooms').prop('required', false).removeClass('error').attr("aria-required", "false");
                $('#bedrooms').prop('required', false).removeClass('error').attr("aria-required", "false");
            } else {
                $('#bathrooms').prop('required', true).removeClass('error').attr("aria-required", "true");
                $('#bedrooms').prop('required', true).removeClass('error').attr("aria-required", "true");
            }
        });
        CKEDITOR.replace('description');
    </script>
@endsection
