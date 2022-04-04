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
                    <h4 class="card-title">Add City Details</h4>
                    <a href="{{route('city-details')}}">
                        <button type="button"class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        {!! Form::open(array('route' => 'city_detail_store', 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Cities</label>
                                    <select name="city" id="city" class="form-control" required>
                                        <option value="">Select City</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Property Trends</label>
                                    <textarea type="text" rows="5" id="property_trends" name="property_trends" class="form-control description"
                                     placeholder="Property Trends" required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Neighborhood</label>
                                    <textarea type="text" rows="5" id="neighborhood" name="neighborhood" class="form-control"
                                     placeholder="Neighborhood" required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Lifestyle</label>
                                    <textarea type="text" rows="5" id="lifestyle" name="lifestyle" class="form-control"
                                     placeholder="Lifestyle" required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Things to Consider</label>
                                    <textarea type="text" rows="5" id="things_to_consider" name="things_to_consider" class="form-control"
                                     placeholder="Things to Consider" required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Locations</label>
                                    <textarea type="text" rows="5" id="locations" name="locations" class="form-control"
                                     placeholder="Locations" required></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Attributes</label>
                                    <textarea type="text" rows="5" id="attributes" name="attributes" class="form-control"
                                     placeholder="Attributes" required></textarea>
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

<script type="text/javascript" src="{{ asset('admin/vendor/ckfinder/ckfinder.js') }}"></script>
    <script>
        var editor = CKEDITOR.replace( 'property_trends' );
        var editor = CKEDITOR.replace( 'neighborhood' );
        var editor = CKEDITOR.replace( 'lifestyle' );
        var editor = CKEDITOR.replace( 'things_to_consider' );
        var editor = CKEDITOR.replace( 'locations' );
        var editor = CKEDITOR.replace( 'attributes' );
        CKFinder.setupCKEditor( editor );
        CKEDITOR.config.extraPlugins = 'contextmenu';
        CKEDITOR.config.extraPlugins = 'dialog';
        CKEDITOR.config.extraPlugins = 'liststyle';
        CKEDITOR.config.extraPlugins = 'dialogui';
        CKEDITOR.config.extraPlugins = 'menu';
    </script>
@endsection
