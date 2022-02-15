@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ trans('words.add').' '.trans('words.user') }}</h2>
		<a href="{{ URL::to('admin/users') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> {{trans('words.back')}}</a>
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

    @if(Session::has('flash_error_message'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            {{ Session::get('flash_error_message') }}
        </div>
    @endif

   	<div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(array('url' => array('admin/users/adduser'),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.name')}} *</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.phone')}} *</label>
                    <div class="col-sm-9">
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Whatsapp Number *</label>
                    <div class="col-sm-9">
                        <input type="text" name="whatsapp" placeholder="Whatsapp Number" class="form-control" required>
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.about')}}</label>
                    <div class="col-sm-9">
						<textarea name="about" cols="50" rows="5" class="form-control">{{ old('about') }}</textarea>
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Facebook</label>
                    <div class="col-sm-9">
                        <input type="text" name="facebook" value="{{ old('facebook') }}" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Twitter</label>
                    <div class="col-sm-9">
                        <input type="text" name="twitter" value="{{ old('twitter') }}" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Instagram</label>
                    <div class="col-sm-9">
                        <input type="text" name="instagram" value="{{ old('instagram') }}" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Linkedin</label>
                    <div class="col-sm-9">
                        <input type="text" name="linkedin" value="{{ old('linkedin') }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.profile_picture')}}</label>
                    <div class="col-sm-6">
                        <input type="file" name="image_icon" class="form-control" style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                    </div>
                </div>

				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.user_type')}} *</label>
                    <div class="col-sm-4">
                        <select name="usertype" id="basic" class="selectpicker show-tick form-control" data-live-search="true" onchange="toggleAgency(this.value);">
                            <option value="Agents">{{trans('words.agent')}}</option>
                            <option value="User">{{trans('words.user')}}</option>
						</select>
                    </div>
                </div>
				
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Assign Role *</label>
                    <div class="col-sm-4">
                        <select name="roles[]"  class="form-control select2 js-example-basic-multiple" multiple="multiple">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
						</select>
                    </div>
                </div>

                <div id="user_agency" class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.agency')}} *</label>
                    <div class="col-sm-4">
                        @if(Auth::user()->usertype=='Agency')
                            <input type="hidden" name="agency_id" id="agency_id" class="form-control" value="{{Auth::user()->agency_id}}">
                            <input type="text" name="agency_" id="agency_" class="form-control" value="{{Auth::user()->agency->name}}" disabled>
                        @else
                        <select name="agency_id" id="agency_id" class="selectpicker show-tick form-control" data-live-search="true" >
                            <option value="" selected>Select Agency</option>
                            @foreach($agencies as $agency)
                                <option value="{{$agency->id}}">{{$agency->name}}</option>
                            @endforeach
                        </select>
                            @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.status')}}</label>
                    <div class="col-sm-4">
                        <select name="status" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                            <option value="1">{{trans('words.active')}}</option>
                            <option value="0">{{trans('words.inactive')}}</option>
                        </select>
                    </div>
                </div>
				<hr />
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.email')}} *</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.password')}} *</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" value="" class="form-control" required>
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                    	<button type="submit" class="btn btn-primary">{{ isset($user->name) ? trans('words.save_changes') : trans('words.submit') }}</button>

                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>


</div>

@endsection

<script>
    function toggleAgency(utype){
        if(utype == "Agents"){
            document.getElementById("user_agency").style.display="block";
        } else {
            document.getElementById("user_agency").style.display="none";
        }
    }
</script>
