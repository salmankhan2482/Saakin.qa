@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> Edit Gallery Image</h2>
		<a href="{{ URL::to('admin/properties/gallery/'.$property_id) }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> {{trans('words.back')}}</a>
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
                {!! Form::open(array('url' => array('admin/properties/gallery/'.$property_id.'/edit/'.$gid), 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                <div class="form-group">
                    <label for="" class="col-sm-3 col-md-3 control-label">Gallery Image</label>
                      <div class="col-sm-9 col-md-6">
                        <input type="file" name="gallery_image" id="gallery_image"  value="" class="form-control">
                    </div>
                    <div class="col-sm-3 col-md-3">
                        @if(isset($property_gallery_image->image_name))
                            <img src="{{ URL::asset('upload/gallery/'.$property_gallery_image->image_name) }}" width="100" 
                                alt="{{$property_gallery_image->image_name}}">
                        @endif
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
