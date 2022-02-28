@extends("admin.admin_app")

@section("content")

<div id="main">
    <div class="page-header">
        <h2> {{ trans('words.edit').' '.trans('words.property') }}</h2>
        <a href="{{ URL::to('admin/properties') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i>
            {{trans('words.back')}}</a>
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
    @if(Session::has('flash_message'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        {{ Session::get('flash_message') }}
    </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-body">
            {!! Form::open(array('url' => array('admin/properties/edit/'.$property->id),
            'method'=>'POST','class'=>'form-horizontal
            padding-15','name'=>'type_form','id'=>'update_property','role'=>'form','enctype' => 'multipart/form-data'))
            !!}
            <fieldset>
                <legend>Basic Details</legend>
                @if(Auth::User()->usertype=="Admin")
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Property Agency *</label>
                        <select class="form-control" name="agency_id" required>
                            <option value="">Select an Agency</option>
                            @foreach(\App\Agency::orderBy("name","asc")->get() as $agency)
                            <option value="{{$agency->id}}" @if($agency->id==$property->agency_id) selected
                                @endif>{{$agency->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                @endif
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Property Title *</label>
                        <input type="text" class="form-control" placeholder="{{trans('words.property_name')}}"
                            name="property_name" id="p-title" value="{{stripslashes($property->property_name)}}"
                            required />
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
                            <option value="">{{trans('words.property_purpose')}}</option>
                            @foreach($purposes as $purpose)
                            <option value="{{$purpose->name}}" @if($property->property_purpose==$purpose->name) selected
                                @endif>{{$purpose->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Property Type</label>
                        <select class="form-control" id="property_type" name="property_type" required>
                            <option value="">{{trans('words.property_type')}}</option>
                            @foreach($types as $type)
                            <option value="{{$type->id}}" @if($property->property_type==$type->id) selected
                                @endif>{{$type->types}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Property Size</label>
                        <input type="number" name="land_area" class="form-control" id="p-land"
                            placeholder="{{trans('words.land_area')}} sq.ft" value="{{$property->land_area}}" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4">
                        <label>Number of Beds</label>
                        <select id="bedrooms" name="bedrooms"
                            class="listing-input hero__form-input  form-control custom-select" >
                            <option value="">{{trans('words.bedroom')}}</option>
                            <option value="1" @if($property->bedrooms=='1') selected @endif>1</option>
                            <option value="2" @if($property->bedrooms=='2') selected @endif>2</option>
                            <option value="3" @if($property->bedrooms=='3') selected @endif>3</option>
                            <option value="4" @if($property->bedrooms=='4') selected @endif>4</option>
                            <option value="5" @if($property->bedrooms=='5') selected @endif>5</option>
                            <option value="6" @if($property->bedrooms=='6') selected @endif>6</option>
                            <option value="7" @if($property->bedrooms=='7') selected @endif>7</option>
                            <option value="8" @if($property->bedrooms=='8') selected @endif>8</option>
                            <option value="9" @if($property->bedrooms=='9') selected @endif>9</option>
                            <option value="10" @if($property->bedrooms=='10') selected @endif>10</option>

                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Number of Baths</label>
                        <select name="bathrooms" id="bathrooms" class="listing-input hero__form-input  form-control custom-select"
                            >
                            <option value="">{{trans('words.bathroom')}}</option>
                            <option value="1" @if($property->bathrooms=='1') selected @endif>1</option>
                            <option value="2" @if($property->bathrooms=='2') selected @endif>2</option>
                            <option value="3" @if($property->bathrooms=='3') selected @endif>3</option>
                            <option value="4" @if($property->bathrooms=='4') selected @endif>4</option>
                            <option value="5" @if($property->bathrooms=='5') selected @endif>5</option>
                            <option value="6" @if($property->bathrooms=='6') selected @endif>6</option>
                            <option value="7" @if($property->bathrooms=='7') selected @endif>7</option>
                            <option value="8" @if($property->bathrooms=='8') selected @endif>8</option>
                            <option value="9" @if($property->bathrooms=='9') selected @endif>9</option>
                            <option value="10" @if($property->bathrooms=='10') selected @endif>10</option>
                        </select>
                    </div>
                    <div class="col-md-4 ">
                        <label>Property Price</label>

                        <input type="number" name="price" class="form-control" id="p-price" min="0"
                            placeholder="{{trans('words.price')}}" value="{{$property->price}}" required>
                    </div>
                </div>
            </fieldset>
            <fieldset>

                <div class="form-group">
                    <div class="col-md-6">
                        <label>City</label>
                        <select name="city" id="city" class="form-control" onchange="callSubCityTown(this);"> 
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ $property->city == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="col-md-6">
                        <label>Sub City</label>
                        <select name="subcity" id="subcity" class="form-control" onchange="callTown(this);">
                            <option value="">Select Sub City</option>
                        @foreach ($subCities as $subCity)
                            <option value="{{ $subCity->id }}" {{ $property->subcity == $subCity->id ? 'selected' : '' }}>
                                {{ $subCity->name }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Town</label>
                        <select name="town" id="town" class="form-control" onchange="callArea(this);">
                            <option value="">Select Town</option>
                        @foreach ($towns as $town)
                            <option value="{{ $town->id }}" {{ $property->town == $town->id ? 'selected' : '' }}>
                                {{ $town->name }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Area</label>
                        <select name="area" id="area" class="form-control" onchange="callLatLong(this);">
                            <option value="">Select Area</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" {{ $property->area == $area->id ? 'selected' : '' }}>
                                    {{ $area->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Longitude</label>
                        <input type="text" name="map_longitude" placeholder="{{trans('words.longitude')}}"
                               id="p-long" class="form-control" value="{{ $property->map_longitude }}" />
                    </div>
                    <div class="col-md-6">
                        <label>Latitude</label>
                        <input type="text" name="map_latitude" placeholder="{{trans('words.latitude')}}"
                               id="p-lat" class="form-control" value="{{ $property->map_latitude }}" />
                    </div>
                </div>
                

            <div class="form-group">
                <div class="col-md-4">
                        <label>Agent Name</label>
                        <input type="text" placeholder="Agent Name" class="form-control" autocomplete="off" value="{{$property->agent_name}}" name="agent_name" id="agent_name">
                        
                </div>
                <div class="col-md-4">
                    <label>Agent Whatsapp</label>
                    <input type="text" placeholder="Whatsapp Number" class="form-control" autocomplete="off" value="{{$property->whatsapp}}" name="whatsapp" id="whatsapp">
                    
                </div>
                <div class="col-md-2">
                    <label>Agent Picture</label>
                    <input type="file" name="agent_picture" id="agent_picture" class="form-control">                          
                </div>
                <div class="col-md-2">
                @if(!empty($property->agent_picture))
                <img src="{{ URL::asset('upload/properties/'.$property->agent_picture) }}" 
                    alt="{{ $property->property_name.'- agent picture' }}">
                @endif
                </div>
            </div>

                    

            <div class="form-group">
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea class="form-control" rows="4" name="description" id="description" required
                                placeholder="{{trans('words.description')}}">{{$property->description}}</textarea>
                </div>
            </div>
        </fieldset>
        <input type="hidden" name="video_code" class="form-control" value="0">



        <fieldset>
            <div class="form-group">
                <div class="col-md-4">
                    <label>{{ trans('words.featured_image') }}</label>
                    <input type="file" name="featured_image"  class="form-control">
                </div>
                <div class="col-md-8">
                    @if(!empty($property->featured_image))
                    <img src="{{ URL::asset('upload/properties/thumb_'.$property->featured_image) }}"   
                        alt="{{ $property->property_name.'- featured image' }}">
                    @endif
                </div>
            </div>
        </fieldset>

        <fieldset>
                <legend>{{trans('words.amenities')}}</legend>


                <div class="form-group">
                    <div class="col-md-12">
                        <label>{{trans('words.amenities')}}</label>

                        <div class="row">
                            
                            @if(count($amenities)>0)

                            @foreach($amenities as $amenity)
                            <div class="col-md-3 custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="property_amenities[]"
                                    value="{{$amenity->id}}" 
                                    {{ $property->amenities->contains($amenity->id) ? 'checked' : '' }}>
                                    
                                    <label class="custom-control-label" for="customCheck">
                                        {{$amenity->name}}
                                    </label>
                            </div>
                            @endforeach
                            @endif
                        </div>

                    </div>
                </div>

            </fieldset>




            <fieldset>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>{{trans('words.meta_title')}}</label>
                            <input class="form-control" rows="4" name="meta_title" id="p-desc" value="{{$property->meta_title}}"
                                      placeholder="{{trans('words.meta_title')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label>{{trans('words.meta_description')}}</label>
                            <textarea class="form-control" rows="4" name="meta_description" id="meta_description"
                                      placeholder="{{trans('words.meta_description')}}">{{$property->meta_description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label>{{trans('words.meta_keyword')}}</label>
                            <textarea class="form-control" rows="4" name="meta_keyword" id="meta_keyword"
                                      placeholder="{{trans('words.meta_keyword')}}">{{$property->meta_keyword}}</textarea>
                        </div>
                    </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <button type="submit" id="updateProperty"
                                        class="btn btn-primary">{{trans('words.save_changes')}}</button>
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
$image[] = ['id'=>$property->id,'src'=>url('').'/upload/properties/'.$property->featured_image];
$json_arry = json_encode($image);
@endphp
@section('scripts-custom')
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
                success: function (response) {
                    var subcities = response['subcities'];
                    var towns = response['towns'];
                    var areas = response['areas'];
                    
                    clearEveryThing('subcity', 'town', 'area', 'p-lat', 'p-long');
                    
                    if(subcities == '<option value="">No Result Found</option>'){
                        $("#subcity").append('<option value="">No Result Found</option>');
                    }else{
                        $.each(subcities, function(key,value){
                            $("#subcity").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $("#subcity").append('<option value="">Select Sub City</option>');

                    }    


                    if(towns === '<option value="">No Result Found</option>'){     
                        $("#town").append('<option value="">No Result Found</option>');
                    }else{     
                        $.each(towns, function(key,value){
                            $("#town").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $("#town").append('<option value="">Select Town</option>');

                    }
                    
                    if(areas === '<option value="">No Result Found</option>'){
                        $("#area").append('<option value="">No Result Found</option>');
                    }
                    else{
                        $("#area").empty();     
                        $.each(areas, function(key,value){
                            $("#area").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $("#area").append('<option value="">Select Area</option>');

                    }
                    
                    assingLatLong(areas[0].latitude, areas[0].longitude, towns[0].latitude, 
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
                success: function (response) {
                    var subcities = response['subcities'];
                    var towns = response['towns'];
                    var areas = response['areas'];

                    clearEveryThing('', 'town', 'area', 'p-lat', 'p-long');

                    if(towns == '<option value="">No Result Found</option>'){
                        $("#town").append('<option value="">No Result Found</option>');
                    }
                    else{
                        $.each(towns, function(key,value){
                        $("#town").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $("#town").append('<option value="">Select Town</option>');

                    }

                    if(areas == '<option value="">No Result Found</option>'){
                        $("#area").append('<option value="">No Result Found</option>');
                    }
                    else{
                        $.each(areas, function(key,value){
                            $("#area").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $("#area").append('<option value="">Select Area</option>');

                    }

                    assingLatLong(areas[0].latitude, areas[0].longitude, towns[0].latitude, 
                            towns[0].longitude, subcities[0].latitude, subcities[0].longitude);
                }
            });

        }
    
    
        function callArea(data) {
            var id = data.value;
            
            $.ajax({
                type: "GET",
                url: "{{ route('callArea') }}",
                async: true,
                data: {
                    id: id // as you are getting in request('id') 
                },
                success: function (response) {
                    var areas = response['areas'];
                    var subcities = response['subcities'];
                    var towns = response['towns'];

                    clearEveryThing('', '', 'area', 'p-lat', 'p-long');

                    if(areas === '<option value="">No Result Found</option>'){
                        $("#area").append('<option value="">No Result Found</option>');

                    }else{
                        $("#area").empty();     
                        $.each(areas, function(key,value){
                            $("#area").append('<option value="'+value.id+'">'+value.name+'</option>');
                            $("#p-lat").val(value.latitude);
                            $("#p-long").val(value.longitude);
                        });
                        $("#area").append('<option value="">Select Area</option>');

                    }

                    assingLatLong(areas[0].latitude, areas[0].longitude, towns[0].latitude, 
                            towns[0].longitude, subcities[0].latitude, subcities[0].longitude);

                }
            });

        }

        function callLatLong(data) {
            var id = data.value;
            var pre = $("#town").val();
            console.log(pre);
            $.ajax({
                type: "GET",
                url: "{{ route('callLatLong') }}",
                async: true,
                data: {
                    id: id, 
                    pre: pre
                },
                success: function (response) {
                    
                    var subcities = response['subcities'];
                    var towns = response['towns'];
                    var areas = response['latLong'];
                    console.log(areas);
                    $("#p-lat").val('');
                    $("#p-long").val('');
                    
                    assingLatLong(areas.latitude, areas.longitude, towns.latitude ?? '', 
                            towns.longitude ?? '', subcities.latitude ?? '', subcities.longitude ?? '');

                }
            });

        }

        function assingLatLong(alat, alon, tlat, tlon, slat, slon){
            if(alat && alon){
                $("#p-lat").val(alat);
                $("#p-long").val(alon);
            }else if(tlat && tlon){
                $("#p-lat").val(tlat);
                $("#p-long").val(tlon);
            }else if(slat && slon){
                $("#p-lat").val(slat);
                $("#p-long").val(slon);
            }
        }

        function clearEveryThing(subcity, town, area, p_lat, p_long ){
            $(`#${subcity}`).empty(); 
            $(`#${town}`).empty();
            $(`#${area}`).empty();    
            $(`#${p_lat}`).val('');
            $(`#${p_long}`).val('');
        }

    
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

    $('#property_type').on('change', function(){
        var proprty_type = $(this).val();
            const proprty_type_id = ['4','7','13','15','16','17','23','27','34','35'];
            if(proprty_type_id.includes(proprty_type)==true)
            {
                console.log(proprty_type);
                $('#bathrooms').prop('required',false).removeClass('error').attr("aria-required","false");
                $('#bedrooms').prop('required',false).removeClass('error').attr("aria-required","false");
            } 
            else
            {
                $('#bathrooms').prop('required',true).removeClass('error').attr("aria-required","true");
                $('#bedrooms').prop('required',true).removeClass('error').attr("aria-required","true");
            }
        });

    $('#updateProperty').on('click', function () {
        if ($('#updateProperty').valid()) {
            $('#update_property').submit();
        }
    });
    
    

    CKEDITOR.replace( 'description' );
</script>
@endsection
