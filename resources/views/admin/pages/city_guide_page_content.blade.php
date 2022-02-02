@extends("admin.admin_app")

@section("content")

<div id="main">
  <div class="page-header">
    <h2> {{ $page_title }}</h2>    
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
                {!! Form::open(array('url' => array('admin/city-guide-page-content'),'class'=>'form-horizontal padding-15','name'=>'settings_form','id'=>'settings_form','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                <input type="hidden" name="id" value="{{ isset($page_info->id) ? $page_info->id : null }}">
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.title')}}*</label>
                      <div class="col-sm-9">
                        <input type="text" name="page_title" value="{{ isset($page_title) ? $page_title : null }}" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.description')}}</label>
                    <div class="col-sm-9">
                        <textarea id="page_content" name="page_content" class="form-control">{{ isset($page_info->page_content) ? stripslashes($page_info->page_content) : null }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.meta_title')}}</label>
                    <div class="col-sm-9">
                        <input id="meta_title" name="meta_title" class="form-control" value="{{ isset($page_info->meta_title) ? stripslashes($page_info->meta_title) : null }}"></input>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.meta_description')}}</label>
                    <div class="col-sm-9">
                        <textarea id="meta_description" name="meta_description" class="form-control">{{ isset($page_info->meta_description) ? stripslashes($page_info->meta_description) : null }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.meta_keyword')}}</label>
                    <div class="col-sm-9">
                        <textarea id="meta_keyword" name="meta_keyword" class="form-control">{{ isset($page_info->meta_keyword) ? stripslashes($page_info->meta_keyword) : null }}</textarea>
                    </div>
                </div>
                
                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                      <button type="submit" class="btn btn-primary">{{trans('words.save_changes')}}</button>
                         
                    </div>
                </div>
                
                {!! Form::close() !!} 
            </div>
        </div>
   
    
</div>

@endsection
@section('scripts-custom')
    <script>
        CKEDITOR.replace( 'page_content' );
    </script>
@endsection
