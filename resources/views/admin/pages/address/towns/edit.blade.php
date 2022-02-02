@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> 
        Edit {{ $town->name }}    
        </h2>

		<a href="{{ route('propertyTowns.index') }}" class="btn btn-default-light btn-xs">
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
                {!! Form::open(array('route' => array('propertyTowns.update', $town->id), 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">
                        City
                    </label>
                    <div class="col-sm-9">
                        <select name="city" id="city" class="form-control" onchange="callSubCities(this);">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option 
                                        {{ $town->property_cities_id == $city->id ? 'selected' : '' }}
                                        value="{{ $city->id }}"> 

                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">
                        Add Sub City
                    </label>   
                    <div class="col-sm-9">
                        <select name="subCity" id="subCity" class="form-control">
                            <option value="" >Select Sub City</option>
                            @foreach ($subCities as $subCity)
                                <option value="{{ $subCity->id }}" {{ $town->property_sub_cities_id == $subCity->id ? 'selected' : '' }}>
                                    {{ $subCity->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name"  value="{{ $town->name }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Latitude</label>
                    <div class="col-sm-9">
                        <input type="text" name="latitude" id="latitude" value="{{ $town->latitude }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Longitude</label>
                    <div class="col-sm-9">
                        <input type="text" name="longitude" id="longitude" value="{{ $town->longitude }}" class="form-control">
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