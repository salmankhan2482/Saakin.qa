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
                    <h4 class="card-title">Agencies Page Content</h4>
                    <a href="{{ route('dashboard.index')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        {!! Form::open(array('route' => ['agency-landing-pages.update'],'method'=> 'PUT', 
                        'class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form',
                        'enctype' => 'multipart/form-data')) !!}
                        
                        <input type="hidden" name="id" value="{{ isset($data['page_info']->id) ? $data['page_info']->id : null }}">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Page Title</label>
                                    <input type="text" id="page_title" name="page_title" class="form-control" placeholder="Page Title" value="{{ isset($data['page_title']) ? $data['page_title'] : null }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <div class="card-body">
                                        <textarea id="page_content" 
                                        name="page_content">{{ isset($data['page_info']->page_content) ? stripslashes($data['page_info']->page_content) : null }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Meta Title</label>
                                    <input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="Meta Title" value="{{ isset($data['page_info']->meta_title) ? stripslashes($data['page_info']->meta_title) : null }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Meta Description</label>
                                    <input type="text" id="meta_description" name="meta_description" class="form-control" placeholder="Meta Description" value="{{ isset($data['page_info']->meta_description) ? stripslashes($data['page_info']->meta_description) : null }}">
                                </div>
                            </div>
                            <div class="form-row">
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Meta Keywords</label>
                                    <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" placeholder="Meta Keywords" value="{{ isset($data['page_info']->meta_keyword) ? stripslashes($data['page_info']->meta_keyword) : null }}">
                                </div>
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
<script src="{{ URL::asset('admin/js/jquery.js') }}"></script>

<script type="text/javascript" src="{{ asset('admin/vendor/ckfinder/ckfinder.js') }}"></script>
<script>
    
var editor = CKEDITOR.replace( 'page_content' );
CKFinder.setupCKEditor( editor );

</script>
@endsection