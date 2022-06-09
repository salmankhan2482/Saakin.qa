{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
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

                    @if(Session::has('flash_error_message'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            {{ Session::get('flash_error_message') }}
                        </div>
                    @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Member</h4>
                    <a href="{{route('users.index')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="panel-body">
                        {!! Form::open(array('route' => 'users.store', 'method'=> 'POST', 'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.name')}} *</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">Phone *</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">Whatsapp *</label>
                                <input type="text" name="whatsapp" placeholder="Whatsapp Number" class="form-control" required>
                        </div>        
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.profile_picture')}}</label>
                            <div class="col-sm-6">
                                <input type="file" name="image_icon" class="form-control" style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                            </div>
                        </div>
        
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.user_type')}} *</label>
                                <select name="usertype" id="basic" class="show-tick form-control" onchange="toggleAgency(this.value);">
                                    <option value="Agents">{{trans('words.agent')}}</option>
                                    {{-- <option value="User">{{trans('words.user')}}</option> --}}
                                </select>
                        </div>
                        
                        <div class="col-6">
                            <label for="" class="control-label">Assign Role *</label>
                                {!! Form::select('roles[]', $roles,[], array('class' => ['form-control', 'select2', 'js-example-basic-multiple'],'multiple')) !!}
                        </div>
        
                        <div id="user_agency" class="col-6">
                            <label for="" class="control-label">{{trans('words.agency')}} *</label>
                                @if(Auth::user()->usertype=='Agency')
                                    <input type="hidden" name="agency_id" id="agency_id" class="form-control" value="{{Auth::user()->agency_id}}">
                                    <input type="text" name="agency_" id="agency_" class="form-control" value="{{Auth::user()->agency->name}}" disabled>
                                @else
                                <select name="agency_id" id="agency_id" class="selectpicker show-tick form-control" >
                                    <option value="" selected>Select Agency</option>
                                    @foreach($agencies as $agency)
                                        <option value="{{$agency->id}}">{{$agency->name}}</option>
                                    @endforeach
                                </select>
                                @endif
                        </div>
        
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.status')}}</label>
                                <select name="status" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                                    <option value="1">{{trans('words.active')}}</option>
                                    <option value="0">{{trans('words.inactive')}}</option>
                                </select>
                        </div>
                        <hr />
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.email')}} *</label>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.password')}} *</label>
                                <input type="password" name="password" value="" class="form-control" required>
                        </div>
        
                        <hr>
                        <div class="col-6">
                            <br>
                            <button type="submit" class="btn btn-rounded btn-success">
                                {{ isset($user->name) ? trans('words.save_changes') : trans('words.submit') }}
                            </button>
                        </div>
                    </div>
        
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function toggleAgency(utype){
        if(utype == "Agents"){
            document.getElementById("user_agency").style.display="block";
        } else {
            document.getElementById("user_agency").style.display="none";
        }
    }
    </script>
@endsection
