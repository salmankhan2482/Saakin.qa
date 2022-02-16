@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2>  
            Edit Menu Options
        </h2>
		<a href="{{ route('menuOptions.index') }}" class="btn btn-default-light btn-xs">
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
                {!! Form::open(array('route' => ['menuOptions.update', $menu->id], 'method'=>'PATCH','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.title')}}</label>
                      <div class="col-sm-9">
                        <input type="text" name="title" id="title" value="{{ $menu->title }}" value="" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Parent </label>
                    <div class="col-sm-9">
                        <select name="parent_id" id="parent_id" class="form-control" >
                            <option value="">Select Parent Menu</option>
                            @foreach($menuOptions as $menuOption)
                                <option value="{{$menuOption->id}}" {{ $menu->parent_id ==  $menuOption->id ? 'selected' : ''}}>
                                    {{$menuOption->title}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Route</label>
                      <div class="col-sm-9">
                        <input type="text" name="route" id="route" value="{{ $menu->route }}" value="" class="form-control" >
                    </div>
                </div>
               
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Url</label>
                      <div class="col-sm-9">
                        <input type="text" name="url" id="url" value="{{ $menu->url }}" value="" class="form-control" >
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Icon</label>
                      <div class="col-sm-9">
                        <input type="text" name="icon" id="icon" value="{{ $menu->icon }}" value="" class="form-control" >
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
