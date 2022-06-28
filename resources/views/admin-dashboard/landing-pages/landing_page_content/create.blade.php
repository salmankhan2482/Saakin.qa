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
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Landing Page Content</h4>
                    <a href="{{ route('landing-pages.index')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        {!! Form::open(array('route' => ['landing-pages.store'], 'method' => 'POST',
                            'class'=>'form-horizontal padding-15',
                            'name'=>'type_form','id'=>'type_form',
                            'role'=>'form',
                            'enctype' => 'multipart/form-data')) !!}
                        
                        <input type="hidden" name="id" value="{{ isset($page_info->id) ? $page_info->id : null }}">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Property Purpose</label>
                                    <select id="property_purposes_id" name="property_purposes_id" class="form-control">
                                        <option value="">Select Property Purpose</option>
                                        @foreach ($data['property_purposes'] as $purpose)
                                        <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Property Type</label>
                                    <select id="property_types_id" name="property_types_id" class="form-control">
                                        <option value="">Select Property Types</option>
                                        @foreach ($data['property_types'] as $type)
                                        <option value="{{ $type->id }}">{{ $type->types }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <select id="property_cities_id" name="property_cities_id" class="form-control" onchange="callSubCities(this);">
                                        <option value="">Select City</option>
                                        @foreach ($data['cities'] as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sub-City</label>
                                    <select id="subCity" name="property_sub_cities_id" class="form-control">
                                        <option value="">Select Sub-City</option>
                                        @foreach ($data['subcities'] as $subcity)
                                        <option value="{{ $subcity->id }}">{{ $subcity->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <textarea type="text" id="page_content" name="page_content" class="form-control" placeholder="Page Content"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Meta Title</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="Meta Title" value="{{ isset($page_info->meta_title) ? stripslashes($page_info->meta_title) : null }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Meta Description</label>
                                    <input type="text" id="meta_description" name="meta_description" class="form-control" placeholder="Meta Description" value="{{ isset($page_info->meta_description) ? stripslashes($page_info->meta_description) : null }}">
                                </div>
                            </div>
                            <div class="form-row">
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Meta Keywords</label>
                                    <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" placeholder="Meta Keywords" value="{{ isset($page_info->meta_keyword) ? stripslashes($page_info->meta_keyword) : null }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-rounded btn-success">Save</button>
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

<script type="text/javascript" src="{{ asset('admin/vendor/ckfinder/ckfinder.js') }}"></script>
<script>
    var editor = CKEDITOR.replace( 'page_content' );
CKFinder.setupCKEditor( editor );

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
                        console.log('a');
                        $("#subCity").empty();     
                        $("#subCity").append('<option value="">No Result Found</option>');
                    }else{
                        $("#subCity").empty();     
                        $.each(subcities, function(key,value){
                           $("#subCity").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                        $("#subCity").append('<option value="">Select Sub-City</option>');
                    }

                }
            });

        }
</script>
@endsection