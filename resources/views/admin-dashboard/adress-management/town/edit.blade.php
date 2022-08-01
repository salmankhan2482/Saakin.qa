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
                        <h4 class="card-title">Edit Town</h4>
                        <a href="{{ route('propertyTowns.index') }}">
                            <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => ['propertyTowns.update', $town->id], 'method' => 'PATCH', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Cities</label>
                                    <select id="city" name="city" class="form-control" onchange="callSubCities(this);">
                                        <option selected>Select City</option>
                                        @foreach ($cities as $city)
                                            <option {{ $town->property_cities_id == $city->id ? 'selected' : '' }}
                                                value="{{ $city->id }}">
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sub-Cities</label>
                                    <select id="subCity" name="subCity" class="form-control">
                                        <option selected>Select Sub-City</option>
                                        @foreach ($subCities as $subCity)
                                            <option value="{{ $subCity->id }}"
                                                {{ $town->property_sub_cities_id == $subCity->id ? 'selected' : '' }}>
                                                {{ $subCity->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Enter a Location" value="{{ $town->name }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Latitude</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control"
                                        placeholder="25.2773946" value="{{ $town->latitude }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Longitude</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control"
                                        placeholder="51.4985448" value="{{ $town->longitude }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn brounded action-btn btn-xs btn-success">Update</button>
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
    
    @php $settings = App\Settings::where("id",1)->get()->first(); @endphp
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key={{$settings->google_map_key}}&callback=initMap&region=qa" type="text/javascript"></script>
    
    <script>
        function initialize() {
            var input = document.getElementById('name');
            var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('longitude').value = place.geometry.location.lat();
                document.getElementById('latitude').value = place.geometry.location.lng();
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
        
        function callSubCities(data) {
            var id = data.value;
            
            $.ajax({
                type: "GET",
                url: "{{ route('callSubCities') }}",
                async: true,
                data: {
                    id: id // as you are getting in request('id') 
                },
                success: function (response) {
                    var subcities = response['subcities'];

                    if(subcities == ''){
                        $("#subCity").empty();     
                        $("#subCity").append('<option value="">No Result Found</option>');
                    }else{

                        $("#subCity").empty();     
                        $.each(subcities, function(key,value){
                        $("#subCity").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }

                }
            });

        }
    </script>
@endsection
