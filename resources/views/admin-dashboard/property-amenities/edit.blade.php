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
                    <h4 class="card-title">Edit Property Amenity</h4>
                    <a href="{{route('property-amenity.index')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        {!! Form::open(array('route' => ['property-amenity.update', $data['propertyAmenity']->id], 'method'=>'PUT','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control"value="{{ $data['propertyAmenity']->name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class="col-sm-3 control-label">{{ trans('words.status') }}</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected>Select Status</option>
                                    <option value="Pending" @if($data['propertyAmenity']->status=='Pending') {{'selected'}} @endif>Pending</option>
                                    <option value="Confirmed" @if($data['propertyAmenity']->status=='Confirmed') {{'selected'}} @endif>Confirmed</option>
                                    <option value="Cancelled" @if($data['propertyAmenity']->status=='Cancelled') {{'selected'}} @endif>Cancelled</option>
                                </select>
                            </div>

                        </div>
                            <div class="form-row">
                                
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
