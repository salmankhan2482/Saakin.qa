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
                    <h4 class="card-title">Edit City</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">

                        {!! Form::open(array('route' => ['city_detail_update', $cityDetail->id] , 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}


                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="City Name" value="{{ $city->name }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Short Description</label>
                                    <textarea type="text" rows="5" id="short_description" name="short_description" class="form-control"
                                     placeholder="Short Description" required>{{ $city->short_description }}</textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Long Description</label>
                                    <textarea type="text" rows="5" id="long_description" name="long_description" class="form-control"
                                     placeholder="Long Description" required>{{ $city->long_description }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label>Things to Consider</label>
                                    <textarea type="text" rows="5" id="things_to_consider" name="things_to_consider" class="ckeditor"
                                     placeholder="Things to Consider">{{ $cityDetail->things_to_consider ??'' }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Locations</label>
                                    <textarea type="text" rows="5" id="locations" name="locations" class="ckeditor"
                                     placeholder="Locations">{{ $cityDetail->locations ??'' }}</textarea>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">

                                    <label>Attributes</label>
                                    <textarea type="text" rows="5" id="attributes" name="attributes" class="ckeditor" placeholder="City Attributes">{{ $cityDetail->attributes ??'' }}</textarea>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Meta Keywords</label>
                                    <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" placeholder="Meta Keywords">
                                </div> --}}
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
