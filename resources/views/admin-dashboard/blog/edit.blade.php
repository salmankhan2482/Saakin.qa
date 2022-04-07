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
                    <h4 class="card-title">Edit Blog</h4>
                    <a href="{{route('blogs.index')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        {!! Form::open(array('route' => ['blogs.update',$blog->id] , 'method'=>'PATCH','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label>Blog Category</label>
                                    <select id="category" name="category" class="form-control" required>
                                        <option selected>Select Blog Category</option>
                                        @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($blog->category_id==$category->id) selected @endif>{{$category->category}}</option>
                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Title</label>
                                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter Blog Title" value="{{$blog->title}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    
                                        <textarea type="text" rows="5" id="description" name="description" class="form-control" placeholder="Blog Description">{{$blog->description}}</textarea>
                                    
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label>Featured Image (Choose Image 584px × 515px)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="blog_image" id="blog_image" class="custom-file-input">
                                            <label class="custom-file-label" for="blog_image">Choose file</label>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-1">
                                    <img src="{{asset('upload/blogs/'.$blog->image)}}" alt="{{$blog->title}}" width="80" />
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Meta Title</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="Meta Title" value="{{$blog->meta_title}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Meta Description</label>
                                    <textarea type="text" id="meta_description" rows="5" name="meta_description" class="form-control" placeholder="Meta Description">{{$blog->meta_description}}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Meta Keywords</label>
                                    <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" placeholder="Meta Keywords" value="{{$blog->meta_keywords}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Status</label>
                                    <select type="text" name="status" class="form-control">
                                        <option value="1" {{ $blog->status == 1 ? 'selected' : '' }} >Publish</option>
                                        <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
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
@section('scripts')
<script type="text/javascript" src="{{ asset('admin/vendor/ckfinder/ckfinder.js') }}"></script>
<script>
    var editor = CKEDITOR.replace( 'description' );
CKFinder.setupCKEditor( editor );
</script>
@endsection