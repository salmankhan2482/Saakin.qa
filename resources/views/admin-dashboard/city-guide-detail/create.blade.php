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
            <a href="{{route('city-details')}}">
                <button type="button" class="btn btn-rounded btn-dark">Back</button>
            </a>
        </ol>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add City Detail</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        {!! Form::open(array('route' => 'cities.store', 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                            <div class="form-row">
                                <div class="col-12">
                                    <label>City</label>
                                    <select class="form-control" name="city" required>
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
                                    <textarea type="text" rows="5" id="property_trends" name="property_trends" class="ckeditor"
                                     placeholder="Property Trends"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Neighborhood</label>
                                    <textarea type="text" rows="5" id="description" name="neighborhood" class="ckeditor"
                                     placeholder="Neighborhood"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Lifestyle</label>
                                    <textarea type="text" rows="5" id="description" name="lifestyle" class="ckeditor"
                                     placeholder="Lifestyle"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Things to Consider</label>
                                    <textarea type="text" rows="5" id="description" name="things_to_consider" class="ckeditor"
                                     placeholder="Things to Consider"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Locations</label>
                                    <textarea type="text" rows="5" id="description" name="locations" class="ckeditor"
                                     placeholder="Locations"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Attributes</label>
                                    <textarea type="text" rows="5" id="description" name="attributes" class="ckeditor" placeholder="City Attributes"></textarea>
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
        var editor = CKEDITOR.replace( 'ckeditor' );
        CKFinder.setupCKEditor( editor );
    </script>
@endsection
