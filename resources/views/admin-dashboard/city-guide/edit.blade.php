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
            <a href="{{route('cities.index')}}">
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
                        {!! Form::open(array('route' => ['cities.update', $city->id], 'method'=>'PATCH','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

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
                                <div class="form-group col-md-4">
                                    <label>Featured Image (Choose Image 584px × 515px)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="city_image" id="city_image" class="custom-file-input">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <img src="{{asset('upload/cities/'.$city->city_image)}}" alt="{{$city->name}}" width="130"  />
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Meta Title</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="Meta Title" value="{{ $city->meta_title }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Meta Description</label>
                                    <textarea type="text" id="meta_description" rows="5" name="meta_description" class="form-control" placeholder="Meta Description">{{ $city->meta_description }}</textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Meta Keywords</label>
                                    <textarea type="text" id="meta_keyword" rows="5" name="meta_keyword" class="form-control" placeholder="Meta Keywords">{{ $city->meta_keyword }}</textarea>
                                </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
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
