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
                <a href="{{ route('agencies.index') }}">
                    <button type="button" class="btn btn-rounded btn-dark">Back</button>
                </a>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Property</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => 'properties.store', 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'add_agency', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Select Agency*</label>
                                    <select id="agency_id" name="agency_id" class="form-control">
                                        <option selected>Select Agency</option>
                                        @foreach(\App\Agency::orderBy("name","asc")->get() as $agency)
                                        <option value="{{$agency->id}}">{{$agency->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Property Title* </label>
                                    <input type="text" name="property_name" id="property_name" placeholder="Property Name"
                                        value="{{ old('phone') }}" class="form-control" required>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label>Property Purpose*</label>
                                    <select id="property_purpose" name="property_purpose" class="form-control" required>
                                        <option selected>Select Property Purpose</option>
                                        @foreach($purposes as $purpose)
                                        <option value="{{$purpose->name}}"
                                                @if(old('property_purpose')==$purpose->id) selected @endif>{{$purpose->name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Property Type*</label>
                                    <select id="property_type" name="property_type" class="form-control" required>
                                        <option selected>Property Type</option>
                                        @foreach($types as $type)
                                    <option value="{{$type->id}}"
                                            @if(old('property_type')==$type->id) selected @endif>{{$type->types}}</option>
                                @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Property Size *</label>
                                    <input type="number" name="land_area" id="land_area" placeholder="Land Area SQFT" value="{{ old('email') }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label>Number of Beds*</label>
                                    <select id="bedrooms" name="bedrooms" class="form-control">
                                        <option selected>Bedrooms</option>
                                        <option value="1" @if(old('bedrooms')=='1') selected @endif>1</option>
                                        <option value="2" @if(old('bedrooms')=='2') selected @endif>2</option>
                                        <option value="3" @if(old('bedrooms')=='3') selected @endif>3</option>
                                        <option value="4" @if(old('bedrooms')=='4') selected @endif>4</option>
                                        <option value="5" @if(old('bedrooms')=='5') selected @endif>5</option>
                                        <option value="6" @if(old('bedrooms')=='6') selected @endif>6</option>
                                        <option value="7" @if(old('bedrooms')=='7') selected @endif>7</option>
                                        <option value="8" @if(old('bedrooms')=='8') selected @endif>8</option>
                                        <option value="9" @if(old('bedrooms')=='9') selected @endif>9</option>
                                        <option value="10" @if(old('bedrooms')=='10') selected @endif>10</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Number of Baths*</label>
                                    <select id="bathrooms" name="bathrooms" class="form-control">
                                        <option selected>Bathrooms</option>
                                        <option value="1" @if(old('bathroom')=='1') selected @endif>1</option>
                                <option value="2" @if(old('bathroom')=='2') selected @endif>2</option>
                                <option value="3" @if(old('bathroom')=='3') selected @endif>3</option>
                                <option value="4" @if(old('bathroom')=='4') selected @endif>4</option>
                                <option value="5" @if(old('bathroom')=='5') selected @endif>5</option>
                                <option value="6" @if(old('bathroom')=='6') selected @endif>6</option>
                                <option value="7" @if(old('bathroom')=='7') selected @endif>7</option>
                                <option value="8" @if(old('bathroom')=='8') selected @endif>8</option>
                                <option value="9" @if(old('bathroom')=='9') selected @endif>9</option>
                                <option value="10" @if(old('bathroom')=='10') selected @endif>10</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Property Price * </label>
                                    <input type="number" name="price" id="price" placeholder="Price" value="{{ old('price') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Cities*</label>
                                    <select id="city" name="city" class="form-control" onchange="callSubCityTown(this);">
                                        <option selected>Select City</option>
                                        @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Sub-Cities*</label>
                                    <select id="subcity" name="subcity" class="form-control" onchange="callTown(this);">
                                        <option selected>Select Sub-City</option>
                                        @foreach ($subCities as $subCity)
                                <option value="{{ $subCity->id }}" {{ old('subcity') == $subCity->id ? 'selected' : '' }}>
                                    {{ $subCity->name }}
                                </option>
                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Town*</label>
                                    <select id="town" name="town" class="form-control"  onchange="callArea(this);">
                                        <option selected>Select Town</option>
                                        @foreach ($towns as $town)
                                <option value="{{ $town->id }}" {{ old('town') == $town->id ? 'selected' : '' }}>
                                    {{ $town->name }}
                                </option>
                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Area*</label>
                                    <select id="agency_id" name="agency_id" class="form-control" onchange="callLatLong(this);">
                                        <option selected>Select Area</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label>Longitude</label>
                                    <input type="text" name="map_longitude" id="map_longitude" placeholder="Longitude"
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Latitude</label>
                                    <input type="text" name="map_latitude" id="map_latitude" placeholder="Latitude"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <div class="card-body">
                                        <textarea name="description" rows="5" class="summernote"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label>Agent Name</label>
                                    <input type="text" name="agent_name" id="agent_name"
                                    placeholder="Agent Name" class="form-control">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Agent WhatsApp</label>
                                    <input type="number" name="whatsapp" id="whatsapp"
                                    placeholder="Whatsapp Number" class="form-control">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Agent Picture</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="agent_picture" id="agent_picture" class="custom-file-input">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label>Gallery Images</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="gallery_image" multiple class="custom-file-input">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Featured Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="featured_image" class="custom-file-input" required>
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Amenities</label>
                                    <hr>
                                    <div class="row">
                                        @if (count($amenities) > 0)
                                            @foreach ($amenities as $amenity)
                                                <div class="col-6 col-sm-4">
                                                    <div class="custom-control custom-checkbox mb-3">
                                                        <input type="checkbox" class=""
                                                            name="property_amenities[]" value="{{ $amenity->id }}"
                                                        >
                                                        <label class=""
                                                            for="">{{ $amenity->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Documents (Choose Document ONLY (584px ×
                                        515px)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="property_document" class="custom-file-input">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{ trans('words.meta_title') }}</label>
                                    <input type="text" placeholder="Meta Title" name="meta_title" id="meta_title"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label>{{ trans('words.meta_description') }}</label>
                                    <textarea type="text" placeholder="Meta Description" name="meta_description"
                                        id="meta_description" rows="4" class="form-control"></textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>{{ trans('words.meta_keyword') }}</label>
                                    <textarea type="text" placeholder="Meta Description" name="meta_keyword"
                                        id="meta_keyword" rows="4" class="form-control"></textarea>
                                </div>

                            </div>

                            <hr>
                            <div class="form-group col-md-12">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-primary" id="add_new_Agency">
                                        {{ trans('words.submit') }}
                                    </button>
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
                        towns[0].longitude, subcities[0].longitude, subcities[0].longitude);

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
                        towns[0].longitude, subcities[0].longitude, subcities[0].longitude);
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
                        towns[0].longitude, subcities[0].longitude, subcities[0].longitude);

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
                        towns.longitude ?? '', subcities.longitude ?? '', subcities.longitude ?? '');

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


    $('.gallery_image').imageUploader({
        maxFiles: 10,
        extensions: ['.jpg', '.jpeg', '.png', '.gif'],
        mimes: ['image/jpeg', 'image/png', 'image/gif'],

    });

    $("form[name='type_form']").parsley();
    
    $(document).on('change','#property_purpose',function (){
        var val = $('#property_purpose').val();
        if(val == 'For Rent'){
            $('.rental_period').css('display','block');
        }else{
            $('.rental_period').css('display','none');
        }
    });

    
    $('#property_type').on('change', function(){
        var proprty_type = $(this).val();
        const proprty_type_id = ['4', '7', '13', '15', '16', '17', '23', '27', '34', '35','36'];
        if (proprty_type_id.includes(proprty_type) == true) {

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
    CKEDITOR.replace( 'description' );
</script>
@endsection
