@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> 
        Edit {{ $area->name }}    
        </h2>

		<a href="{{ route('propertyAreas.index') }}" class="btn btn-default-light btn-xs">
            <i class="md md-backspace"></i> 
            {{trans('words.back')}}
        </a>
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

	@if(Session::has('message'))
        <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
            {{ Session::get('message') }}
        </div>
	@endif

   	<div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(array('route' => array('propertyAreas.update', $area->id), 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">
                        City
                    </label>
                    <div class="col-sm-9">
                        <select name="city" id="city" class="form-control" onchange="callSubCityTown(this);">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ $area->property_cities_id == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">
                        Sub City
                    </label>   
                    <div class="col-sm-9">
                        <select name="subCity" id="subCity" class="form-control" onchange="callTown(this);">
                            <option value="">Select Sub City</option>
                            @foreach ($subCities as $subCity)
                                <option value="{{ $subCity->id }}" {{ $area->property_sub_cities_id == $subCity->id ? 'selected' : '' }}>
                                    {{ $subCity->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">
                        Town
                    </label>   
                    <div class="col-sm-9">
                        <select name="town" id="town" class="form-control">
                            <option value="">Select Town</option>
                            @foreach ($towns as $town)
                                <option value="{{ $town->id }}" {{ $area->property_towns_id == $town->id ? 'selected' : '' }}>
                                    {{ $town->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" value="{{ $area->name }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Latitude</label>
                    <div class="col-sm-9">
                        <input type="text" name="latitude" id="latitude" value="{{ $area->latitude }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Longitude</label>
                    <div class="col-sm-9">
                        <input type="text" name="longitude" id="longitude" value="{{ $area->longitude }}" class="form-control">
                    </div>
                </div>


                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                    	<button type="submit" class="btn btn-primary">{{ trans('words.submit') }}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>

</div>

@endsection
@section('scripts-custom')
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
                success: function (response) {
                    var subcities = response['subcities'];
                    var towns = response['towns'];
                    
                    console.log(response);

                    $("#subCity").empty();     
                    //we are making the state select empty coz we are appending new data if we dont empty it, then there will be old data and then new data 

                    $.each(subcities, function(key,value){
                    $("#subCity").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                   
                    $("#town").empty();     
                    //we are making the state select empty coz we are appending new data if we dont empty it, then there will be old data and then new data 

                    $.each(towns, function(key,value){
                    $("#town").append('<option value="'+value.id+'">'+value.name+'</option>');
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
                success: function (response) {
                    var towns = response['towns'];
                    console.log(towns);
                    $("#town").empty();     
                    //we are making the state select empty coz we are appending new data if we dont empty it, then there will be old data and then new data 

                    $.each(towns, function(key,value){
                    $("#town").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });

                }
            });

        }
    </script>
@endsection