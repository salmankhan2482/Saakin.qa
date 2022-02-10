@extends("admin.admin_app")

@section('content')

    <div id="main">
        <div class="page-header">
            <h2>{{ trans('words.add') . ' ' . trans('words.property') }}</h2>
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
                {!! Form::open(['url' => ['admin/properties/create'], 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                <fieldset>
                    <legend>Basic Details</legend>
                    @if (Auth::User()->usertype == 'Admin')
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Property Agency *</label>
                                <select class="form-control" name="agency_id" required>
                                    <option value="">Select an Agency</option>
                                    @foreach (\App\Agency::orderBy('name', 'asc')->get() as $agency)
                                        <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    @endif
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Property Title *</label>
                            <input type="text" class="form-control" placeholder="{{ trans('words.property_name') }}"
                                name="property_name" id="p-title" value="{{ old('property_name') }}" required />
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
                                    <option value="{{ $purpose->name }}" @if (old('property_purpose') == $purpose->id) selected @endif>{{ $purpose->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Property Type</label>
                            <select class="form-control" id="property_type" name="property_type" required>
                                <option value="">{{ trans('words.property_type') }}</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" @if (old('property_type') == $type->id) selected @endif>
                                        {{ $type->types }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Property Size</label>
                            <input type="number" name="land_area" class="form-control" id="p-land"
                                placeholder="{{ trans('words.land_area') }} sq.ft" value="{{ old('land_area') }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-md-4">
                            <label>Number of Beds</label>
                            <select id="bedrooms" name="bedrooms"
                                class="listing-input hero__form-input  form-control custom-select">
                                <option value="">{{ trans('words.bedroom') }}</option>
                                <option value="1" @if (old('bedrooms') == '1') selected @endif>1</option>
                                <option value="2" @if (old('bedrooms') == '2') selected @endif>2</option>
                                <option value="3" @if (old('bedrooms') == '3') selected @endif>3</option>
                                <option value="4" @if (old('bedrooms') == '4') selected @endif>4</option>
                                <option value="5" @if (old('bedrooms') == '5') selected @endif>5</option>
                                <option value="6" @if (old('bedrooms') == '6') selected @endif>6</option>
                                <option value="7" @if (old('bedrooms') == '7') selected @endif>7</option>
                                <option value="8" @if (old('bedrooms') == '8') selected @endif>8</option>
                                <option value="9" @if (old('bedrooms') == '9') selected @endif>9</option>
                                <option value="10" @if (old('bedrooms') == '10') selected @endif>10</option>

                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Number of Baths</label>
                            <select name="bathrooms" id="bathrooms"
                                class="listing-input hero__form-input  form-control custom-select">
                                <option value="">{{ trans('words.bathroom') }}</option>
                                <option value="1" @if (old('bathroom') == '1') selected @endif>1</option>
                                <option value="2" @if (old('bathroom') == '2') selected @endif>2</option>
                                <option value="3" @if (old('bathroom') == '3') selected @endif>3</option>
                                <option value="4" @if (old('bathroom') == '4') selected @endif>4</option>
                                <option value="5" @if (old('bathroom') == '5') selected @endif>5</option>
                                <option value="6" @if (old('bathroom') == '6') selected @endif>6</option>
                                <option value="7" @if (old('bathroom') == '7') selected @endif>7</option>
                                <option value="8" @if (old('bathroom') == '8') selected @endif>8</option>
                                <option value="9" @if (old('bathroom') == '9') selected @endif>9</option>
                                <option value="10" @if (old('bathroom') == '10') selected @endif>10</option>
                            </select>
                        </div>
                        <div class="col-md-4 ">
                            <label>Property Price</label>

                            <input type="number" name="price" class="form-control" id="p-price" min="0"
                                placeholder="{{ trans('words.price') }}" value="{{ old('price') }}" required>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Address</label>
                            <input type="text" placeholder="{{ trans('words.address') }}" name="address" id="address"
                                value="{{ old('address') }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Area</label>
                            <input type="text" placeholder="Enter Area" class="form-control" name="city" id="city"
                                value="{{ old('city') }}" required>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label>Agent Name</label>
                            <input type="text" placeholder="Agent Name" class="form-control"
                                value="{{ old('agent_name') }}" name="agent_name" id="agent_name"
                                value="{{ old('agent_name') }}">

                        </div>
                        <div class="col-md-4">
                            <label>Agent Whatsapp</label>
                            <input type="text" placeholder="Whatsapp Number" class="form-control"
                                value="{{ old('whatsapp') }}" name="whatsapp" id="whatsapp"
                                value="{{ old('whatsapp') }}">

                        </div>
                        <div class="col-md-4">
                            <label>Agent Picture</label>
                            <input type="file" name="agent_picture" id="agent_picture" class="form-control"
                                value="{{ old('agent_picture') }}">

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Longitude</label>
                            <input type="text" name="map_longitude" placeholder="{{ trans('words.longitude') }}"
                                id="p-long" class="form-control" value="{{ old('map_longitude') }}" readonly />
                        </div>
                        <div class="col-md-6">
                            <label>Latitude</label>
                            <input type="text" name="map_latitude" placeholder="{{ trans('words.latitude') }}" id="p-lat"
                                class="form-control" value="{{ old('map_latitude') }}" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Description</label>
                            <textarea class="form-control" rows="4" name="description" id="p-desc" required
                                placeholder="{{ trans('words.description') }}">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </fieldset>
                <input type="hidden" name="video_code" class="form-control" value="0">
                <fieldset>
                    <legend>Gallery</legend>

                    <div class="form-group">
                        <div class="col-md-8">
                            <label>Gallery Image(s)</label>
                            <div class="gallery_image"></div>
                        </div>
                        <div class="col-md-4">
                            <label>Featured Image</label>
                            <input type="file" name="featured_image" class="form-control" required>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <legend>Amenities</legend>
                        <div class="col-md-12">

                            <div class="row">
                                @if (count($amenities) > 0)
                                    @foreach ($amenities as $amenity)
                                        <div class="col-md-4 custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="property_features[]"
                                                value="{{ $amenity->id }}" /><label class="custom-control-label"
                                                for="customCheck">{{ $amenity->name }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                    </div>
                </fieldset>


                <fieldset>
                    <legend>Property Documents</legend>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="custom-file">
                                <input type="file" name="property_document" class="custom-file-input" multiple=""
                                    id="property_document" aria-describedby="property_document"
                                    style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                                <label class="custom-file-label" for="property_document">Choose Document ONLY (584px ×
                                    515px)</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <button id="SaveProperty" type="submit" class="btn btn-primary">Save Property</button>
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

@section('scripts-custom')
    <script>
        $('.gallery_image').imageUploader({
            maxFiles: 10,
            extensions: ['.jpg', '.jpeg', '.png', '.gif'],
            mimes: ['image/jpeg', 'image/png', 'image/gif'],

        });

        $("form[name='type_form']").parsley();

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

        google.maps.event.addDomListener(window, 'load', initialize);
        google.maps.event.addDomListener(window, 'load', initializex);
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
        CKEDITOR.replace('description');
    </script>
@endsection
