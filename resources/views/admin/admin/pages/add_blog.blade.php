@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ trans('words.add').' '.trans('words.blog') }}</h2>
		<a href="{{ route('blogs.index') }}" class="btn btn-default-light btn-xs">
            <i class="md md-backspace"></i> {{trans('words.back')}}
        </a>
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
                {!! Form::open(array('route' => 'blog.store', 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.category')}}</label>
                    <div class="col-sm-9">
                        <select name="category" id="category" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.title')}}</label>
                      <div class="col-sm-9">
                        <input type="text" name="title" id="title"  value="" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="description" id="description" rows="7" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Image</label>
                    <div class="col-sm-9">
                        <input type="file" name="blog_image" class="form-control" required
                               id="blog_image" aria-describedby="blog_image" style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                        <label class="custom-file-label" for="blog_image">Choose Image ONLY (584px × 515px)</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.meta_title')}}</label>
                      <div class="col-sm-9">
                        <input type="text" name="meta_title" id="title" placeholder="Title" value="" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.meta_desription')}}</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="meta_description" placeholder="Description" id="description" rows="7" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.meta_keywords')}}</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="meta_keyword" class="form-control" rows="5" placeholder="Add Keywords for your Blog"></textarea>
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
<script>
     CKEDITOR.replace( 'description');
    </script>
@endsection
