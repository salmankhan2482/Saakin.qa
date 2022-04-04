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
	 @if(Session::has('flash_message'))
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
            <a href="{{route('property-purpose.index')}}">
                <button type="button" class="btn btn-rounded btn-dark">Back</button>
            </a>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Popular Search</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        {!! Form::open(array('route' => ['popularSearches.update', $data['search']->id], 'method'=>'PUT','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $data['search']->name }}">
                            </div>
                            
                            
                            <div class="form-group col-md-6">
                                <label>Property Purpose</label>
                                <select name="purpose" class="form-control">
                                    <option value="Rent" {{ $data['search']->property_purpose == 'Rent' ? 'selected' : ''}}>
                                        Rent
                                    </option>
                                    <option value="Sale" {{ $data['search']->property_purpose == 'Sale' ? 'selected' : ''}}>
                                        Sale
                                    </option>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Property Type</label>
                                <select name="type" class="form-control">
                                    <option value="">No Type</option>
                                    @foreach ($data['types'] as $type)
                                        <option value="{{ $type->id }}" {{ $data['search']->type_id == $type->id ? 'selected' : '' }}>
                                            {{ $type->types }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>City</label>
                                <select name="city" id="city" class="form-control" onchange="callSubCityTown(this);">
                                    <option value="">No City</option>
                                    @foreach ($data['cities'] as $city)
                                        <option value="{{ $city->id }}" 
                                            {{ $data['search']->city_id == $city->id ? 'selected' : '' }} >
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Sub City</label>
                                <select name="subcity" id="subcity" class="form-control" onchange="callTown(this);">
                                    <option value="">No Sub City</option>
                                    @foreach ($data['subcities'] as $subcity)
                                        <option value="{{ $subcity->id }}" 
                                            {{ $data['search']->subcity_id == $subcity->id ? 'selected' : '' }}>
                                            {{ $subcity->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Town</label>
                                <select name="town" id="town" class="form-control" onchange="callArea(this);">
                                    <option value="">No Town</option>
                                    @foreach ($data['towns'] as $town)
                                        <option value="{{ $town->id }}" 
                                            {{ $data['search']->town_id == $town->id ? 'selected' : '' }}>
                                            {{ $town->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Area</label>
                                <select name="area" id="area" class="form-control">
                                    <option value="">No Area</option>
                                    @foreach ($data['areas'] as $area)
                                        <option value="{{ $area->id }}" 
                                            {{ $data['search']->area_id == $area->id ? 'selected' : '' }}>
                                            {{ $area->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Bedroom</label>
                                <select name="bedrooms" class="form-control">
                                    <option value="0" {{ $data['search']->bedrooms == 0 ? 'selected' : '' }}>No Bedroom</option>
                                    <option value="1" {{ $data['search']->bedrooms == 1 ? 'selected' : '' }}>1 Bedroom</option>
                                    <option value="2" {{ $data['search']->bedrooms == 2 ? 'selected' : '' }}>2 Bedrooms</option>
                                    <option value="3" {{ $data['search']->bedrooms == 3 ? 'selected' : '' }}>3 Bedrooms</option>
                                    <option value="4" {{ $data['search']->bedrooms == 4 ? 'selected' : '' }}>4 Bedrooms</option>
                                    <option value="5" {{ $data['search']->bedrooms == 5 ? 'selected' : '' }}>5 Bedrooms</option>
                                    <option value="6+" {{ $data['search']->bedrooms == "6+" ? 'selected' : '' }}>6+ Bedrooms</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Furnishings</label>
                                <select name="furnishings" class="form-control">
                                    <select name="furnishings" class="hero__form-input form-select custom-select">
                                        <option value="">
                                            All furnishings
                                        </option>
                                        <option value="109" {{ $data['search']->furnishings  == 109 ? 'selected' : '' }}>
                                            Furnished
                                        </option>
                                        <option value="120" {{ $data['search']->furnishings  == 120 ? 'selected' : '' }}>
                                            Unfurnished
                                        </option>
                                        <option value="101" {{ $data['search']->furnishings  == 101 ? 'selected' : '' }}>Partly 
                                            furnished
                                        </option>
                                    </select>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label>Count</label>
                                <input type="number" class="form-control" name="count" value="{{ $data['search']->count }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Link</label>
                                <textarea name="link" class="form-control" cols="10" rows="5">{{ $data['search']->link }}</textarea>
                            </div>
                            
                            
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group col-md-6">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-primary">Save</button>
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

                    clearEveryThing('subcity', 'town', 'area');

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

                    clearEveryThing('', 'town', 'area');

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
                    clearEveryThing('', '', 'area');

                    if (areas === '<option value="">No Result Found</option>') {
                        $("#area").append('<option value="">No Result Found</option>');

                    } else if (areas === '<option value="">No Result Found</option>') {
                        $("#town").append('<option value="">No Result Found</option>');

                    } else {
                        $("#area").empty();
                        $.each(areas, function(key, value) {
                            $("#area").append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                        $("#area").append('<option value="">Select Area</option>');

                    }

                }
            });
        }


        function clearEveryThing(subcity, town, area, p_lat, p_long) {
            $(`#${subcity}`).empty();
            $(`#${town}`).empty();
            $(`#${area}`).empty();
        }

       
    </script>

@endsection
