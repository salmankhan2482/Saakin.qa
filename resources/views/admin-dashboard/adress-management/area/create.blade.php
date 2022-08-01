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
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Area</h4>
                        <a href="{{ route('propertyAreas.index') }}">
                            <button type="button" class="btn rounded action-btn btn-xs btn-info">
                              <i class="fa fa-arrow-left"></i>
                              Back
                           </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => 'propertyAreas.store', 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Cities</label>
                                    <select id="city" name="city" class="form-control" onchange="callSubCityTown(this);">
                                        <option selected>Select City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sub-Cities</label>
                                    <select id="subCity" name="subCity" class="form-control" onchange="callTown(this);">
                                        <option selected>Select Sub-City</option>
                                        @foreach ($subCities as $subCity)
                                            <option value="{{ $subCity->id }}">{{ $subCity->name }}</option>
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
                                            <option value="{{ $town->id }}">{{ $town->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Enter a Location">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Latitude</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control"
                                        placeholder="25.2773946">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Longitude</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control"
                                        placeholder="51.4985448">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn rounded action-btn btn-xs btn-success">Save</button>
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
@section('scripts')
<script src="{{ URL::asset('admin/js/jquery.js') }}"></script>

    @php
    $settings = App\Settings::where('id', 1)
        ->get()
        ->first();
    @endphp
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key={{ $settings->google_map_key }}&callback=initMap&region=qa"
        type="text/javascript"></script>
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

                    if (subcities == '') {
                        $("#subCity").empty();
                        $("#subCity").append('<option value="">No Result Found</option>');
                    } else {
                        $("#subCity").empty();
                        $.each(subcities, function(key, value) {
                            $("#subCity").append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                    }


                    if (towns === 'No Records Found') {
                        $("#town").empty();
                        $("#town").append('<option value="">No Result Found</option>');
                    } else if (towns == '') {
                        $("#town").empty();
                        $("#town").append('<option value="">No Result Found</option>');
                    } else {
                        $("#town").empty();
                        $.each(towns, function(key, value) {
                            $("#town").append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                    }
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
                    if (towns == '') {
                        $("#town").empty();
                        $("#town").append('<option value="">No Result Found</option>');
                    } else {
                        $("#town").empty();
                        $.each(towns, function(key, value) {
                            $("#town").append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                    }

                }
            });

        }
    </script>
@endsection
