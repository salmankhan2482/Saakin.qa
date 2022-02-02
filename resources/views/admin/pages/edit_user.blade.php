@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ trans('words.edit').': '. $user->name }}</h2>

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
                {!! Form::open(array('url' => array('admin/users/edituser/'.$user->id),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.phone')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Whatsapp Number</label>
                    <div class="col-sm-9">
                        <input type="text" name="whatsapp" value="{{ $user->whatsapp }}" placeholder="Whatsapp Number" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.about')}}</label>
                    <div class="col-sm-9">

						<textarea name="about" cols="50" rows="5" class="form-control">{{ $user->about }}</textarea>
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Facebook</label>
                    <div class="col-sm-9">
                        <input type="text" name="facebook" value="{{ $user->facebook }}" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Twitter</label>
                    <div class="col-sm-9">
                        <input type="text" name="twitter" value="{{ $user->twitter }}" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Instagram</label>
                    <div class="col-sm-9">
                        <input type="text" name="instagram" value="{{ $user->instagram }}" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">Linkedin</label>
                    <div class="col-sm-9">
                        <input type="text" name="linkedin" value="{{ $user->linkedin }}" class="form-control">
                    </div>
                </div>
				<div class="form-group">
                    <label for="avatar" class="col-sm-3 control-label">{{trans('words.profile_picture')}}</label>
                    <div class="col-sm-9">
                        <div class="media">
                            <div class="media-left">
                                @if(isset($user->image_icon))
									<img src="{{ URL::asset('upload/members/'.$user->image_icon) }}" width="80" alt="person">
								@endif
                            </div>
                            <div class="media-body media-middle">
                                <input type="file" name="image_icon" class="form-control" style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                            </div>
                        </div>
                    </div>
                </div>

				<div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.user_type')}}</label>
                    <div class="col-sm-4">
                        <select name="usertype" id="basic" class="selectpicker show-tick form-control" data-live-search="true" onchange="toggleAgency(this.value);">
                            <option value="Agents" @if($user->usertype=='Agents') selected @endif>{{trans('words.agent')}}</option>
                            <option value="User" @if($user->usertype=='User') selected @endif>{{trans('words.user')}}</option>
						</select>
                    </div>
                </div>
                @php
                    $display = "none";
                    if($user->usertype=="Agents") {
                        $display = "block";
                    }
                @endphp

                <div id="user_agency" class="form-group" style="display: {{$display}}">
                    <label for="" class="col-sm-3 control-label">{{trans('words.agency')}}</label>
                    <div class="col-sm-4">
                        @if(Auth::user()->usertype=='Agency')
                            <input type="hidden" name="agency_id" id="agency_id" class="form-control" value="{{Auth::user()->agency_id}}">
                            <input type="text" name="agency_" id="agency_" class="form-control" value="{{Auth::user()->agency->name}}" disabled>
                        @else
                        <select name="agency_id" id="agency_id" class="selectpicker show-tick form-control" data-live-search="true">
                            <option value="" selected>Select Agency</option>
                            @foreach($agencies as $agency)
                                <option value="{{$agency->id}}" @if($agency->id==$user->agency_id) selected @endif>{{$agency->name}}</option>
                            @endforeach
                        </select>
                            @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.status')}}</label>
                    <div class="col-sm-4">
                        <select name="status" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                            <option value="1" @if($user->status=='1') selected @endif>{{trans('words.active')}}</option>
                            <option value="0" @if($user->status=='0') selected @endif>{{trans('words.inactive')}}</option>
                        </select>
                    </div>
                </div>
				<hr />
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.email')}}</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.password')}}</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" value="" class="form-control">
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                    	<button type="submit" class="btn btn-primary">{{ trans('words.save_changes') }}</button>
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

