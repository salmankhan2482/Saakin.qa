@extends("admin.admin_app")

@section('content')

    <div id="main">
        <div class="page-header">
            <h2> {{ trans('words.edit') . ' ' . trans('words.property') }}</h2>
            <a href="{{ URL::to('admin/properties') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i>
                {{ trans('words.back') }}</a>
        </div>
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
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open([
    'url' => ['admin/properties/edit/' . $property->id],
    'method' => 'POST',
    'class' => 'form-horizontal
            padding-15',
    'name' => 'type_form',
    'id' => 'update_property',
    'role' => 'form',
    'enctype' => 'multipart/form-data',
]) !!}
                <fieldset>
                    <legend>Basic Details</legend>
                    @if (Auth::User()->usertype == 'Admin')
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Property Agency *</label>
                                <select class="form-control" name="agency_id" required>
                                    <option value="">Select an Agency</option>
                                    @foreach (\App\Agency::orderBy('name', 'asc')->get() as $agency)
                                        <option value="{{ $agency->id }}" @if ($agency->id == $property->agency_id) selected
                                    @endif>{{ $agency->name }}</option>
                    @endforeach
                    </select>
            </div>

        </div>
        @endif
        <div class="form-group">
            <div class="col-md-12">
                <label>Property Title *</label>
                <input type="text" class="form-control" placeholder="{{ trans('words.property_name') }}"
                    name="property_name" id="p-title" value="{{ stripslashes($property->property_name) }}" required />
            </div>

        </div>
        </fieldset>
        <fieldset>
            <legend>Property Details</legend>
            <div class="form-group">
                <div class="col-md-4">
                    <input type="hidden" name="age" value="0" />
                    <input type="hidden" name="build_area" value="0">
                    <input type="hidden" name="rental_period" value="Monthly">
                    <input type="hidden" name="rooms" value="0">
                    <input type="hidden" name="garage" value="0">
                    <label>Property Purpose</label>
                    <select class="form-control" name="property_purpose" id="property_purpose" required>
                        <option value="">{{ trans('words.property_purpose') }}</option>
                        @foreach ($purposes as $purpose)
                            <option value="{{ $purpose->name }}" @if ($property->property_purpose == $purpose->name) selected
                        @endif>{{ $purpose->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Property Type</label>
                    <select class="form-control" id="property_type" name="property_type" required>
                        <option value="">{{ trans('words.property_type') }}</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" 
                                @if ($property->property_type == $type->id) selected @endif>
                        {{ $type->types }}
                    </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Property Size</label>
                    <input type="number" name="land_area" class="form-control" id="p-land"
                        placeholder="{{ trans('words.land_area') }} sq.ft" value="{{ $property->land_area }}"
                        required>
                </div>
            </div>

            <div class="form-group">

                <div class="col-md-4">
                    <label>Number of Beds</label>
                    <select id="bedrooms" name="bedrooms"
                        class="listing-input hero__form-input  form-control custom-select">
                        <option value="">{{ trans('words.bedroom') }}</option>
                        <option value="1" @if ($property->bedrooms == '1') selected @endif>1</option>
                        <option value="2" @if ($property->bedrooms == '2') selected @endif>2</option>
                        <option value="3" @if ($property->bedrooms == '3') selected @endif>3</option>
                        <option value="4" @if ($property->bedrooms == '4') selected @endif>4</option>
                        <option value="5" @if ($property->bedrooms == '5') selected @endif>5</option>
                        <option value="6" @if ($property->bedrooms == '6') selected @endif>6</option>
                        <option value="7" @if ($property->bedrooms == '7') selected @endif>7</option>
                        <option value="8" @if ($property->bedrooms == '8') selected @endif>8</option>
                        <option value="9" @if ($property->bedrooms == '9') selected @endif>9</option>
                        <option value="10" @if ($property->bedrooms == '10') selected @endif>10</option>

                    </select>
                </div>
                <div class="col-md-4">
                    <label>Number of Baths</label>
                    <select name="bathrooms" id="bathrooms"
                        class="listing-input hero__form-input  form-control custom-select">
                        <option value="">{{ trans('words.bathroom') }}</option>
                        <option value="1" @if ($property->bathrooms == '1') selected @endif>1</option>
                        <option value="2" @if ($property->bathrooms == '2') selected @endif>2</option>
                        <option value="3" @if ($property->bathrooms == '3') selected @endif>3</option>
                        <option value="4" @if ($property->bathrooms == '4') selected @endif>4</option>
                        <option value="5" @if ($property->bathrooms == '5') selected @endif>5</option>
                        <option value="6" @if ($property->bathrooms == '6') selected @endif>6</option>
                        <option value="7" @if ($property->bathrooms == '7') selected @endif>7</option>
                        <option value="8" @if ($property->bathrooms == '8') selected @endif>8</option>
                        <option value="9" @if ($property->bathrooms == '9') selected @endif>9</option>
                        <option value="10" @if ($property->bathrooms == '10') selected @endif>10</option>
                    </select>
                </div>
                <div class="col-md-4 ">
                    <label>Property Price</label>

                    <input type="number" name="price" class="form-control" id="p-price" min="0"
                        placeholder="{{ trans('words.price') }}" value="{{ $property->price }}" required>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group">
                <div class="col-md-6">
                    <label>Address</label>
                    <input type="text" placeholder="{{ trans('words.address') }}" name="address" id="address"
                        value="{{ $property->address }}" class="form-control" autocomplete="off" required>
                </div>
                <div class="col-md-6">
                    <label>Area</label>
                    <input type="text" placeholder="Enter City" class="form-control" autocomplete="off"
                        value="{{ $property->city }}" name="city" id="city" required>
                </div>

            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <label>Agent Name</label>
                    <input type="text" placeholder="Agent Name" class="form-control" autocomplete="off"
                        value="{{ $property->agent_name }}" name="agent_name" id="agent_name">

                </div>
                <div class="col-md-4">
                    <label>Agent Whatsapp</label>
                    <input type="text" placeholder="Whatsapp Number" class="form-control" autocomplete="off"
                        value="{{ $property->whatsapp }}" name="whatsapp" id="whatsapp">

                </div>
                <div class="col-md-2">
                    <label>Agent Picture</label>
                    <input type="file" name="agent_picture" id="agent_picture" class="form-control">
                </div>
                <div class="col-md-2">
                    @if (!empty($property->agent_picture))
                        <img src="{{ URL::asset('upload/properties/' . $property->agent_picture) }}"
                            alt="{{ $property->agent_name . '-' . $property->id }}">
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <label>Longitude</label>
                    <input type="text" name="map_longitude" placeholder="{{ trans('words.longitude') }}" id="p-long"
                        class="form-control" value="{{ $property->map_longitude }}" readonly />
                </div>
                <div class="col-md-6">
                    <label>Latitude</label>
                    <input type="text" name="map_latitude" placeholder="{{ trans('words.latitude') }}" id="p-lat"
                        class="form-control" value="{{ $property->map_latitude }}" readonly />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea class="form-control" rows="4" name="description" id="description" required
                        placeholder="{{ trans('words.description') }}">{{ $property->description }}</textarea>
                </div>
            </div>
        </fieldset>
        <input type="hidden" name="video_code" class="form-control" value="0">



        <fieldset>
            <div class="form-group">
                <div class="col-md-4">
                    <label>{{ trans('words.featured_image') }}</label>
                    <input type="file" name="featured_image" class="form-control">
                </div>
                <div class="col-md-8">
                    @if (!empty($property->featured_image))
                        <img src="{{ URL::asset('upload/properties/thumb_' . $property->featured_image) }}"
                            alt="{{ $property->property_name . ' - featured image' }}">
                    @endif
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>{{ trans('words.amenities') }}</legend>


            <div class="form-group">
                <div class="col-md-12">
                    <label>{{ trans('words.amenities') }}</label>

                    <div class="row">
                        @php
                            $HiddenProducts = explode(',', $property->property_features);
                        @endphp
                        @if (count($amenities) > 0)

                            @foreach ($amenities as $amenity)
                                <div class="col-md-3 custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="property_features[]"
                                        value="{{ $amenity->id }}" @if (in_array($amenity->id, $HiddenProducts)) checked
                                    @endif/><label class="custom-control-label"
                                        for="customCheck">{{ $amenity->name }}</label>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>

        </fieldset>

        <fieldset>
            <div class="form-group">
                <div class="col-md-6">
                    <button type="submit" id="updateProperty"
                        class="btn btn-primary">{{ trans('words.save_changes') }}</button>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </fieldset>

        {!! Form::close() !!}
    </div>
    </div>

    </div>

@endsection
@php
$image[] = ['id' => $property->id, 'src' => url('') . '/upload/properties/' . $property->featured_image];
$json_arry = json_encode($image);
@endphp
@section('scripts-custom')
    <script>
        $('#update_property').validate({
            rules: {
                "property_name": {
                    "required": true
                },
                "address": {
                    "required": true
                },
                "city": {
                    "required": true
                },
                "description": {
                    "required": true
                },
                "property_type": {
                    "required": true
                },
                "property_purpose": {
                    "required": true
                },
                "rooms": {
                    "required": true
                },


            },


        });

        $('#property_type').on('change', function() {
            var proprty_type = $(this).val();
            const proprty_type_id = ['4', '7', '13', '15', '16', '17', '23', '27', '34', '35'];
            if (proprty_type_id.includes(proprty_type) == true) {
                console.log(proprty_type);
                $('#bathrooms').prop('required', false).removeClass('error').attr("aria-required", "false");
                $('#bedrooms').prop('required', false).removeClass('error').attr("aria-required", "false");
            } else {
                $('#bathrooms').prop('required', true).removeClass('error').attr("aria-required", "true");
                $('#bedrooms').prop('required', true).removeClass('error').attr("aria-required", "true");
            }
        });

        $('#updateProperty').on('click', function() {
            if ($('#updateProperty').valid()) {
                $('#update_property').submit();
            }
        });

        function initialize() {
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                document.getElementById('p-long').value = place.geometry.location.lat();
                document.getElementById('p-lat').value = place.geometry.location.lng();
            });
        }

        function initializex() {
            var input = document.getElementById('city');
            var autocomplete = new google.maps.places.Autocomplete(input);

        }
        google.maps.event.addDomListener(window, 'load', initializex);
        google.maps.event.addDomListener(window, 'load', initialize);
        CKEDITOR.replace('description');
    </script>
@endsection
