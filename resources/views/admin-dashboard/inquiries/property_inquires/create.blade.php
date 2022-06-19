@extends('admin-dashboard.layouts.master')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

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
                        <h4 class="card-title">Add Inquiry</h4>
                        <a href="{{ url()->previous() }}">
                            <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i>
                                Back</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => 'store_proprty_inquiry', 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-row">
                                {{-- <div class="form-group col-md-6">
                                    <label>Inquiry Type</label>
                                    <select id="type" name="type" class="form-control" data-live-search="true"
                                        onchange="toggleAgency(this.value);" required>
                                        <option value="">Select Inquiry Type</option>
                                        <option value="Property-Inquiry">Property Inquiry</option>
                                        <option value="Agency-Inquiry">Agency Inquiry</option>
                                        <option value="Contact-Inquiry">Contact Inquiry</option>
                                    </select>
                                </div> --}}
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Enter Your Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                        placeholder="Enter Your Email Address">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Phone Number</label>
                                    <input type="tel" id="phone" name="phone" class="form-control"
                                        placeholder="974-00-1234" 
                                        {{-- placeholder="+974 4023 0023" --}} pattern="[0-9]{3}-[0-9]{2}-[0-9]{4}"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Property Title</label>
                                    <input class="typeahead form-control" id="property_search" type="text" name="property_title">
                                    {{-- <select id="property_title" name="property_title" class="form-control">
                                        <option value="">Select Property Title</option>
                                        @foreach ($properties as $property)
                                            <option value="{{ $property->id }}">{{ $property->property_name }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Property Purpose</label>
                                    <select class="form-control" name="property_purpose" id="property_purpose" required>
                                        <option value="">{{ trans('words.property_purpose') }}</option>
                                        @foreach ($data['purposes'] as $purpose)
                                            <option value="{{ $purpose->name }}"
                                                @if (old('property_purpose') == $purpose->id) selected @endif>
                                                {{ $purpose->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Property Type</label>
                                    <select class="form-control" id="property_type" name="property_type" required>
                                        <option value="">{{ trans('words.property_type') }}</option>
                                        @foreach ($data['types'] as $type)
                                            <option value="{{ $type->id }}"
                                                @if (old('property_type') == $type->id) selected @endif>
                                                {{ $type->types }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Bedrooms</label>
                                    <input type="number" name="bedrooms" class="form-control" id="bedrooms" min="0"
                                        placeholder="{{ trans('words.bedroom') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Bathrooms</label>
                                    <input type="number" name="bathrooms" class="form-control" id="p-bathrooms" min="0"
                                        placeholder="{{ trans('words.bathroom') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Budget</label>
                                    <input type="number" name="price" class="form-control" id="p-price" min="0"
                                        placeholder="{{ trans('words.price') }}" value="{{ old('price') }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Property Size</label>
                                    <input type="number" name="land_area" class="form-control" id="p-land_area" min="0"
                                        placeholder="{{ trans('words.land_area') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Time Frame</label>
                                    <input type="text" name="time_frame" class="form-control" id="p-time_frame"
                                        placeholder="Time Frame">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Source</label>
                                    <input type="text" name="source" class="form-control" id="p-source"
                                        placeholder="Source">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <select name="city" id="city" class="form-control" onchange="callSubCityTown(this);">
                                        <option value="">Select City</option>
                                        @foreach ($data['cities'] as $city)
                                            <option value="{{ $city->id }}"
                                                {{ old('city') == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Sub City</label>
                                    <select name="subcity" id="subcity" class="form-control" onchange="callTown(this);">
                                        <option value="">Select Sub City</option>
                                        @foreach ($data['subCities'] as $subCity)
                                            <option value="{{ $subCity->id }}"
                                                {{ old('subcity') == $subCity->id ? 'selected' : '' }}>
                                                {{ $subCity->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Town</label>
                                    <select name="town" id="town" class="form-control" onchange="callArea(this);">
                                        <option value="">Select Town</option>
                                        @foreach ($data['towns'] as $town)
                                            <option value="{{ $town->id }}"
                                                {{ old('town') == $town->id ? 'selected' : '' }}>
                                                {{ $town->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Area</label>
                                    <select name="area" id="area" class="form-control" onchange="callLatLong(this);">
                                        <option value="">Select Area</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Longitude</label>
                                    <input type="text" name="map_longitude" placeholder="{{ trans('words.longitude') }}"
                                        id="p-long" class="form-control" value="{{ old('map_longitude') }}" />
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Latitude</label>
                                    <input type="text" name="map_latitude" placeholder="{{ trans('words.latitude') }}"
                                        id="p-lat" class="form-control" value="{{ old('map_latitude') }}" />
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Subject</label>
                                    <input type="text" id="subject" name="subject" class="form-control"
                                        placeholder="Subject">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Agencies</label>
                                    <input class="typeahead form-control" id="search" type="text" name="agency_name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <textarea type="text" rows="5" id="message" name="message" class="form-control" placeholder="Your Message"></textarea>
                                </div>
                            </div>
                        </div>
                        <div id="Property-Inquiry">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Move in Date </label>
                                    <input type="date" id="movein_date" name="movein_date" class="form-control"
                                        placeholder="Move in Date">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-rounded btn-success">Save</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        var path = "{{ route('searchagency') }}";

        $("#search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('#search').val(ui.item.label);
                console.log(ui.item);
                return false;
            }
        });
    </script>

    <script type="text/javascript">
        var path = "{{ route('property_search') }}";

        $("#property_search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('#property_search').val(ui.item.label);
                console.log(ui.item);
                return false;
            }
        });
    </script>
@endsection

@push('scripts')
    <script src="{{ URL::asset('admin/js/jquery.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('admin/js/image-uploader.js') }}"></script>

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
@endpush
