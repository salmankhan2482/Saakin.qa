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
                    <h4 class="card-title">Add City</h4>
                    <a href="{{route('cities.index')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> 
                           Back
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        {!! Form::open(array('route' => 'cities.store', 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="City Name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sequence ID</label>
                                    <input type="number" id="sequence_id" name="sequence_id" class="form-control" placeholder="0" >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Long Description</label>
                                    <textarea type="text" rows="5" id="long_description" name="long_description" class="form-control"
                                     placeholder="Long Description" required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Map Link</label>
                                    <input type="txt" id="map" name="map" class="form-control" placeholder="Map Link" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Featured Image (Choose Image 584px × 515px)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="city_image" id="city_image" class="custom-file-input">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Meta Title</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="Meta Title">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Meta Description</label>
                                    <textarea type="text" id="meta_description" rows="5" name="meta_description" class="form-control" placeholder="Meta Description"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Meta Keywords</label>
                                    <textarea type="text" id="meta_keyword" rows="5" name="meta_keyword" class="form-control" placeholder="Meta Keywords"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-rounded btn-success">Save</button>
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
<script type="text/javascript" src="{{ asset('admin/vendor/ckfinder/ckfinder.js') }}"></script>
    <script>
        var editor = CKEDITOR.replace( 'long_description' );
        CKFinder.setupCKEditor( editor );
        CKEDITOR.config.extraPlugins = 'contextmenu';
        CKEDITOR.config.extraPlugins = 'dialog';
        CKEDITOR.config.extraPlugins = 'liststyle';
        CKEDITOR.config.extraPlugins = 'dialogui';
        CKEDITOR.config.extraPlugins = 'menu';
    </script>
@endsection
