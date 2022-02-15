@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		<h2>  
            Add Role
        </h2>
		<a href="{{ route('roles.index') }}" class="btn btn-default-light btn-xs">
            <i class="md md-backspace"></i> 
            {{trans('words.back')}}
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
                <span aria-hidden="true">&times;</span>
            </button>
		    {{ Session::get('flash_message') }}
		</div>
	@endif

   	<div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(array('route' => 'roles.store', 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.title')}}</label>
                      <div class="col-sm-9">
                        <input type="text" name="title" id="title" placeholder="Title" value="" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Menu Options </label>
                    <div class="col-sm-9">
                        <select class="form-control js-example-basic-multiple" name="menuoptions_id[]" multiple="multiple">
                            <option value="">Menu Options</option>
                            @foreach($menuOptions as $menuOption)
                                <option value="{{$menuOption->id}}">{{$menuOption->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Permissions </label>
                    <div class="col-sm-9">
                        <select name="permissions_id[]" class="form-control js-example-basic-multiple" required multiple="multiple">
                            <option value="">Permissions</option>
                            @foreach($permissions as $permission)
                                <option value="{{$permission->id}}">{{$permission->title}}</option>
                            @endforeach
                        </select>
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
