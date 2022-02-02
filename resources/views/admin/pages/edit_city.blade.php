@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ trans('words.edit').' '.trans('words.city') }}</h2>
		<a href="{{ URL::to('admin/cities') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> {{trans('words.back')}}</a>
	</div>
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
        <span aria-hidden="true">&times;</span></button>
            {{ Session::get('flash_message') }}
        </div>
	@endif

   	<div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(array('url' => array('admin/city/update/'.$city->id), 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.name')}}</label>
                      <div class="col-sm-9">
                        <input type="text" name="name" id="name"  value="{{ $city->name }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Short Description</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="short_description" id="short_description" rows="4" class="form-control" required>{{ $city->short_description }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Long Description</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="long_description" id="long_description" rows="7" class="form-control" required>{{ $city->long_description }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Attributes</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="attributes" id="attributes" rows="2" class="form-control" required>{{ $city->attributes }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Image</label>
                    <div class="col-sm-9 col-md-6">
                        <input type="file" name="city_image" class="form-control"
                               id="city_image" aria-describedby="city_image" style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                        <label class="custom-file-label" for="city_image">Choose Image ONLY (584px × 515px)</label>
                    </div>
                    <div class="col-sm-9 col-md-3">
                        <img src="{{asset('upload/cities/'.$city->city_image)}}" alt="{{$city->name}}" width="80" />
                    </div>
                </div>


                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                    	<button type="submit" class="btn btn-primary">{{ trans('words.submit') }}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>

</div>

@endsection
