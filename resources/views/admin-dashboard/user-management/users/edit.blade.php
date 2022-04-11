{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
@section('style')

@endsection
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
                    <h4 class="card-title">Edit User</h4>
                    <a href="{{route('users.index')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">

                    <div class="panel-body">
                        {!! Form::open(array('route' => ['users.update', $user->id], 'method'=> 'PUT', 'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.name')}} *</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.phone')}} *</label>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">Whatsapp Number *</label>
                            <input type="text" name="whatsapp" value="{{ $user->whatsapp }}" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">Facebook</label>
                            <input type="text" name="facebook" value="{{ $user->facebook }}" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">Twitter</label>
                            <input type="text" name="twitter" value="{{ $user->twitter }}" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">Instagram</label>
                            <input type="text" name="instagram" value="{{ $user->instagram }}" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">Linkedin</label>
                            <input type="text" name="linkedin" value="{{ $user->linkedin }}" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="" class="control-label">{{trans('words.about')}}</label>
                            <textarea name="about" cols="50" rows="5" class="form-control">{{ $user->about }}</textarea>
                        </div>
        
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.profile_picture')}}</label>
                            <div class="media">
                                <div class="media-left">
                                    @if (isset($user->image_icon))
                                        <img src="{{ URL::asset('upload/members/' . $user->image_icon) }}" width="80"
                                            alt="person">
                                    @endif
                                </div>
                                <div class="media-body media-middle">
                                    <input type="file" name="image_icon" class="form-control"
                                        style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                                </div>
                            </div>
                        </div>
        
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.user_type')}} *</label>
                            <select name="usertype" id="basic" class="selectpicker show-tick form-control"
                                data-live-search="true" onchange="toggleAgency(this.value);">
                                <option value="Agents" @if ($user->usertype == 'Agents') selected @endif>
                                    {{ trans('words.agent') }}
                                </option>
                                <option value="Agency" @if ($user->usertype == 'Agency') selected @endif>
                                    {{ trans('words.agency') }}
                                </option>
                                <option value="User" @if ($user->usertype == 'User') selected @endif>
                                    {{ trans('words.user') }}
                                </option>
                            </select>
                        </div>
                        
                        <div class="col-6">
                            <label for="" class="control-label">Assign Role *</label>
                            {!! Form::select('roles[]', $roles, $userRole, ['class' => ['form-control', 'select2', 'js-example-basic-multiple'], 'multiple']) !!}
                        </div>
                        @php
                            $display = 'none';
                            if ($user->usertype == 'Agents') {
                                $display = 'block';
                            }
                        @endphp
        
                        <div id="user_agency" class="col-6">
                            <label for="" class="control-label">{{trans('words.agency')}} *</label>
                            @if (Auth::user()->usertype == 'Agency')
                                <input type="hidden" name="agency_id" id="agency_id" class="form-control"
                                    value="{{ Auth::user()->agency_id }}">
                                <input type="text" name="agency_" id="agency_" class="form-control"
                                    value="{{ Auth::user()->agency->name }}" disabled>
                            @else
                                <select name="agency_id" id="agency_id" class="selectpicker show-tick form-control"
                                    data-live-search="true">
                                    <option value="" selected>Select Agency</option>
                                    @foreach ($agencies as $agency)
                                        <option value="{{ $agency->id }}" @if ($agency->id == $user->agency_id) selected @endif>
                                            {{ $agency->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
        
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.status')}}</label>
                            <select name="status" id="basic" class="selectpicker show-tick form-control"
                                    data-live-search="true">
                                <option value="1" @if ($user->status == '1') selected @endif>
                                    {{ trans('words.active') }}
                                </option>
                                <option value="0" @if ($user->status == '0') selected @endif>
                                    {{ trans('words.inactive') }}
                                </option>
                        </select>
                        </div>
                        <hr />
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.email')}} *</label>
                            <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.password')}} *</label>
                            <input type="password" name="password" value="" class="form-control">
                        </div>
        
                        <hr>
                        <div class="col-6">
                            <br>
                            <button type="submit" class="btn btn-rounded btn-success">
                                {{ isset($user->name) ? trans('words.save') : trans('words.submit') }}
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
