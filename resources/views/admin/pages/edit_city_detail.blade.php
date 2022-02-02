@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ trans('words.edit').' '.trans('words.city_detail') }}</h2>
		<a href="{{ URL::to('admin/city-detail/list') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> {{trans('words.back')}}</a>
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
                {!! Form::open(array('url' => array('admin/city-detail/update/'.$cityDetail->id), 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.city')}}</label>
                    <div class="col-sm-9">
                        <select name="city" id="city" class="form-control" required>
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}" @if($cityDetail->city_id == $city->id) selected @endif>{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.title')}}</label>
                      <div class="col-sm-9">
                        <input type="text" name="name" id="name"  value="{{ $cityDetail->title }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Short Description</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="short_description" id="short_description" rows="4" class="form-control" required>{{ $cityDetail->short_description }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Long Description</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="long_description" id="long_description" rows="7" class="form-control" required>{{ $cityDetail->long_description }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Property Trends</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="property_trends" id="property_trends" rows="7"
                            class="form-control">{{ $cityDetail->property_trends }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Neighborhood</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="neighborhood" id="neighborhood" rows="7"
                            class="form-control">{{ old('neighborhood') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Lifestyle</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="lifestyle" id="lifestyle" rows="7"
                            class="form-control">{{ old('lifestyle') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Things to Consider</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="things_to_consider" id="things_to_consider" rows="7"
                            class="form-control">{{ old('things_to_consider') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Locations</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="locations" id="locations" rows="7"
                            class="form-control">{{ old('locations') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Attributes</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="attributes" id="attributes" rows="7"
                            class="form-control">{{ old('attributes') }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Image1</label>
                    <div class="col-sm-9 col-md-6">
                        <input type="file" name="city_image1" class="form-control"
                               id="city_image1" aria-describedby="city_image1" style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                        <label class="custom-file-label" for="city_image1">Choose Image ONLY (584px × 515px)</label>
                    </div>
                    <div class="col-sm-9 col-md-3">
                        <img src="{{asset('upload/cities/'.$cityDetail->image1)}}" alt="{{$cityDetail->image1}}" width="80" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Image2</label>
                    <div class="col-sm-9 col-md-6">
                        <input type="file" name="city_image2" class="form-control"
                               id="city_image2" aria-describedby="city_image2" style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                        <label class="custom-file-label" for="city_image2">Choose Image ONLY (584px × 515px)</label>
                    </div>
                    <div class="col-sm-9 col-md-3">
                        <img src="{{asset('upload/cities/'.$cityDetail->image2)}}" alt="{{$cityDetail->image2}}" width="80" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Image3</label>
                    <div class="col-sm-9 col-md-6">
                        <input type="file" name="city_image3" class="form-control"
                               id="city_image3" aria-describedby="city_image3" style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                        <label class="custom-file-label" for="city_image3">Choose Image ONLY (584px × 515px)</label>
                    </div>
                    <div class="col-sm-9 col-md-3">
                        <img src="{{asset('upload/cities/'.$cityDetail->image3)}}" alt="{{$cityDetail->image3}}" width="80" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Image4</label>
                    <div class="col-sm-9 col-md-6">
                        <input type="file" name="city_image4" class="form-control"
                               id="city_image4" aria-describedby="city_image4" style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                        <label class="custom-file-label" for="city_image4">Choose Image ONLY (584px × 515px)</label>
                    </div>
                    <div class="col-sm-9 col-md-3">
                        <img src="{{asset('upload/cities/'.$cityDetail->image4)}}" alt="{{$cityDetail->image4}}" width="80" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Image5</label>
                    <div class="col-sm-9 col-md-6">
                        <input type="file" name="city_image5" class="form-control"
                               id="city_image5" aria-describedby="city_image5" style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                        <label class="custom-file-label" for="city_image5">Choose Image ONLY (584px × 515px)</label>
                    </div>
                    <div class="col-sm-9 col-md-3">
                        <img src="{{asset('upload/cities/'.$cityDetail->image5)}}" alt="{{$cityDetail->image5}}" width="80" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Image6</label>
                    <div class="col-sm-9 col-md-6">
                        <input type="file" name="city_image6" class="form-control"
                               id="city_image6" aria-describedby="city_image6" style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                        <label class="custom-file-label" for="city_image6">Choose Image ONLY (584px × 515px)</label>
                    </div>
                    <div class="col-sm-9 col-md-3">
                        <img src="{{asset('upload/cities/'.$cityDetail->image6)}}" alt="{{$cityDetail->image6}}" width="80" />
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
@section('scripts-custom')
<script type="text/javascript" src="{{ asset('site_assets/ckfinder/ckfinder.js') }}"></script>
<script>
     var editor = CKEDITOR.replace( 'property_trends' );
     var editor = CKEDITOR.replace( 'neighborhood' );
     var editor = CKEDITOR.replace( 'lifestyle' );
     var editor = CKEDITOR.replace( 'things_to_consider' );
     var editor = CKEDITOR.replace( 'locations' );
     var editor = CKEDITOR.replace( 'attributes' );
CKFinder.setupCKEditor( editor );
    </script>
@endsection