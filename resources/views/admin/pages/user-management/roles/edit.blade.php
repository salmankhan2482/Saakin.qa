@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		<h2>  
            Edit Role
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
                {!! Form::open(array('route' => ['roles.update', $role->id], 'method'=>'PATCH','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">{{trans('words.title')}}</label>
                      <div class="col-sm-8">
                        <input type="text" name="title" id="title" value="{{ $role->title }}" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4">Menu Options*
                        <span class="btn btn-info btn-xs select-all">Select all</span>
                        <span class="btn btn-info btn-xs deselect-all">Deselect all</span>
                    </label>

                    <div class="col-sm-8">
                        <select name="menu_options[]"  class="form-control select2 js-example-basic-multiple" multiple="multiple">
                            @foreach($menuOptions as $menuOption)
                                <option value="{{ $menuOption->id }}" 
                                    {{ $role->menuoptions->contains($menuOption->id) ? 'selected' : ''  }}>
                                    {{ $menuOption->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-4">Permission*
                        <span class="btn btn-info btn-xs select-all">Select all</span>
                        <span class="btn btn-info btn-xs deselect-all">Deselect all</span>
                    </label>
                    <div class="col-sm-8">
                        <select name="permissions[]" class="form-control select2 js-example-basic-multiple" required multiple="multiple">
                            @foreach($permissions as $permission)
                                <option value="{{$permission->id}}"
                                    {{ $role->rolepermissions->contains($permission->id) ? 'selected' : '' }}>
                                    {{$permission->title}}
                                </option>
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
