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
                    <h4 class="card-title">Edit City Details</h4>
                    <a href="{{route('city-details')}}">
                        <button type="button"class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        {!! Form::open(array('route' => ['city_detail_update', $cityDetail->id], 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Cities</label>
                                    <select id="city" name="city" class="form-control" required>
                                        <option selected>Select City</option>
                                        @foreach($cities as $city)
                                <option value="{{$city->id}}" @if($cityDetail->city_id==$city->id) selected @endif>{{$city->name}}</option>
                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Property Trends</label>
                                    <textarea type="text" rows="5" id="property_trends" name="property_trends" class="form-control description"
                                     placeholder="Property Trends" required>{{$cityDetail->property_trends}}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Neighborhood</label>
                                    <textarea type="text" rows="5" id="neighborhood" name="neighborhood" class="form-control"
                                     placeholder="Neighborhood" required>{{$cityDetail->neighborhood}}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Lifestyle</label>
                                    <textarea type="text" rows="5" id="lifestyle" name="lifestyle" class="form-control"
                                     placeholder="Lifestyle" required>{{$cityDetail->lifestyle}}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Things to Consider</label>
                                    <textarea type="text" rows="5" id="things_to_consider" name="things_to_consider" class="form-control"
                                     placeholder="Things to Consider" required>{{$cityDetail->things_to_consider}}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Locations</label>
                                    <textarea type="text" rows="5" id="locations" name="locations" class="form-control"
                                     placeholder="Locations" required>{{$cityDetail->locations}}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Attributes</label>
                                    <textarea type="text" rows="5" id="attributes" name="attributes" class="form-control"
                                     placeholder="Attributes" required>{{$cityDetail->attributes}}</textarea>
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
        var editor1 = CKEDITOR.replace( 'property_trends');
        var editor2 = CKEDITOR.replace( 'neighborhood' );
        var editor3 = CKEDITOR.replace( 'lifestyle' );
        var editor4 = CKEDITOR.replace( 'things_to_consider' );
        var editor5 = CKEDITOR.replace( 'locations' );
        var editor6 = CKEDITOR.replace( 'attributes' );
        CKFinder.setupCKEditor( editor1 );
        CKFinder.setupCKEditor( editor2 );
        CKFinder.setupCKEditor( editor3 );
        CKFinder.setupCKEditor( editor4 );
        CKFinder.setupCKEditor( editor5 );
        CKFinder.setupCKEditor( editor6 );
    </script>
@endsection
