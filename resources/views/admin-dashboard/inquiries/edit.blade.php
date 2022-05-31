@extends('admin-dashboard.layouts.master')
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
        <div class="page-titles">
            <ol class="breadcrumb">
                <a href="{{ route('propertyAreas.index') }}">
                    <button type="button" class="btn btn-rounded btn-dark">Back</button>
                </a>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Area</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => ['propertyAreas.update', $area->id], 'method' => 'PATCH', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Cities</label>
                                    <select id="city" name="city" class="form-control" onchange="callSubCityTown(this);">
                                        <option selected>Select City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ $area->property_cities_id == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sub-Cities</label>
                                    <select id="subCity" name="subCity" class="form-control" onchange="callTown(this);">
                                        <option selected>Select Sub-City</option>
                                        @foreach ($subCities as $subCity)
                                            <option value="{{ $subCity->id }}"
                                                {{ $area->property_sub_cities_id == $subCity->id ? 'selected' : '' }}>
                                                {{ $subCity->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Towns</label>
                                    <select id="town" name="town" class="form-control">
                                        <option selected>Select Town</option>
                                        @foreach ($towns as $town)
                                            <option value="{{ $town->id }}"
                                                {{ $area->property_towns_id == $town->id ? 'selected' : '' }}>
                                                {{ $town->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Enter a Location" value="{{ $town->name }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Latitude</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control"
                                        placeholder="25.2773946" value="{{ $town->latitude }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Longitude</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control"
                                        placeholder="51.4985448" value="{{ $town->longitude }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts-custom')
    <script>
        function initialize() {
            var input = document.getElementById('name');
            var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                document.getElementById('longitude').value = place.geometry.location.lat();
                document.getElementById('latitude').value = place.geometry.location.lng();
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
        google.maps.event.addDomListener(window, 'load', initializex);

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

                    console.log(response);

                    $("#subCity").empty();
                    //we are making the state select empty coz we are appending new data if we dont empty it, then there will be old data and then new data 

                    $.each(subcities, function(key, value) {
                        $("#subCity").append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });

                    $("#town").empty();
                    //we are making the state select empty coz we are appending new data if we dont empty it, then there will be old data and then new data 

                    $.each(towns, function(key, value) {
                        $("#town").append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });

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
                    var towns = response['towns'];
                    console.log(towns);
                    $("#town").empty();
                    //we are making the state select empty coz we are appending new data if we dont empty it, then there will be old data and then new data 

                    $.each(towns, function(key, value) {
                        $("#town").append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });

                }
            });

        }
    </script>
@endsection
