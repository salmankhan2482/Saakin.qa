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
                    <h4 class="card-title">Edit Landing Page Content</h4>
                    <a href="{{ route('landing-pages.index')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        {!! Form::open(array('route' => ['landing-pages.update', $data['landing_page_content']->id], 
                            'method' => 'PUT',
                            'class'=>'form-horizontal padding-15',
                            'name'=>'type_form','id'=>'type_form',
                            'role'=>'form',
                            'enctype' => 'multipart/form-data')) !!}
                        
                        <input type="hidden" name="id" value="{{ isset($data['landing_page_content']->id) ? $data['landing_page_content']->id : null }}">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Property Purpose</label>
                                    <select id="property_purposes_id" name="property_purposes_id" class="form-control">
                                        <option value="">Select Property Purpose</option>
                                        @foreach ($data['property_purposes'] as $purpose)
                                        <option value="{{ $purpose->id }}" 
                                        {{ $data['landing_page_content']->property_purposes_id == $purpose->id ? 'selected' : '' }}>
                                            {{ $purpose->name }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Property Types</label>
                                    <select name="property_types_id" class="form-control">
                                        <option value="">Select Property Types</option>
                                        @foreach ($data['property_types'] as $type)
                                        <option value="{{ $type->id }}"
                                        {{ $data['landing_page_content']->property_types_id == $type->id ? 'selected' : '' }}>
                                            {{ $type->types }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <select id="city" name="city" class="form-control">
                                        <option value="">Select City</option>

                                        @foreach ($data['cities'] as $city)
                                        <option value="{{ $city->id }}"
                                        {{ $data['landing_page_content']->property_cities_id == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sub-City</label>
                                    <select id="subcity" name="subcity" class="form-control">
                                        <option value="">Select Sub-City</option>
                    
                                        @foreach ($data['subcities'] as $subcity)
                                        <option value="{{ $subcity->id }}"
                                        {{ $data['landing_page_content']->property_sub_cities_id == $subcity->id ? 'selected' : '' }}>
                                            {{ $subcity->name }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Town</label>
                                    <select id="town" name="town" class="form-control">
                                        <option value="">Select Town</option>

                                        @foreach ($data['towns'] as $town)
                                        <option value="{{ $town->id }}"
                                        {{ $data['landing_page_content']->property_towns_id == $town->id ? 'selected' : '' }}>
                                            {{ $town->name }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Area</label>
                                    <select id="area" name="area" class="form-control">
                                        <option value="">Select Area</option>

                                        @foreach ($data['areas'] as $area)
                                        <option value="{{ $area->id }}"
                                        {{ $data['landing_page_content']->property_areas_id == $area->id ? 'selected' : '' }}>
                                            {{ $area->name }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    
                                        <textarea type="text" id="page_content" name="page_content" class="form-control" placeholder="Page Content">
                                            {{ isset($data['landing_page_content']->page_content) ? stripslashes($data['landing_page_content']->page_content) : null }}
                                        </textarea>
                                    
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Meta Title</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="Meta Title" value="{{ isset($data['landing_page_content']->meta_title) ? stripslashes($data['landing_page_content']->meta_title) : null }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Meta Description</label>
                                    <input type="text" id="meta_description" name="meta_description" class="form-control" placeholder="Meta Description" value="{{ isset($data['landing_page_content']->meta_description) ? stripslashes($data['landing_page_content']->meta_description) : null }}">
                                </div>
                            </div>
                            <div class="form-row">
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Meta Keywords</label>
                                    <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" placeholder="Meta Keywords" value="{{ isset($data['landing_page_content']->meta_keyword) ? stripslashes($data['landing_page_content']->meta_keyword) : null }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-rounded btn-success">Update</button>
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


jQuery(document).ready(function(){

jQuery('#city').change(function(){
    let cid = jQuery(this).val();
    jQuery('#town').html('<option value="">Select Town</option>')
    jQuery('#area').html('<option value="">Select Area</option>')
    jQuery.ajax({
        url: '/getSubcity',
        type: 'post',
        data: 'cid='+cid+'&_token={{csrf_token()}}',
        success: function(result){
             jQuery('#subcity').html(result)
             

        }

    });

});

jQuery('#subcity').change(function(){
    let sid = jQuery(this).val();
    jQuery('#area').html('<option value="">Select Area</option>')
    jQuery.ajax({
        url: '/getTown',
        type: 'post',
        data: 'sid='+sid+'&_token={{csrf_token()}}',
        success: function(result){
             jQuery('#town').html(result)
             

        }

    });

});

jQuery('#town').change(function(){
    let tid = jQuery(this).val();
    
    jQuery.ajax({
        url: '/getArea',
        type: 'post',
        data: 'tid='+tid+'&_token={{csrf_token()}}',
        success: function(result){
             jQuery('#area').html(result)
             

        }

    });

});

});

</script>
@endsection