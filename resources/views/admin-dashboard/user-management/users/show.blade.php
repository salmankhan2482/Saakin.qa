{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Show {{ $user->name ?? '' }} 's Profile</h4>
                </div>
                <div class="card-body">
                   
                    <div class="panel-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.name')}} *</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.phone')}} *</label>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">Whatsapp Number *</label>
                            <input type="text" name="whatsapp" value="{{ $user->whatsapp }}" class="form-control" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">Facebook</label>
                            <input type="text" name="facebook" value="{{ $user->facebook }}" class="form-control" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">Twitter</label>
                            <input type="text" name="twitter" value="{{ $user->twitter }}" class="form-control" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">Instagram</label>
                            <input type="text" name="instagram" value="{{ $user->instagram }}" class="form-control" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="control-label">Linkedin</label>
                            <input type="text" name="linkedin" value="{{ $user->linkedin }}" class="form-control" readonly>
                        </div>
                        <div class="col-12">
                            <label for="" class="control-label">{{trans('words.about')}}</label>
                            <textarea name="about" cols="50" rows="5" class="form-control" readonly>{{ $user->about }}</textarea>
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
                            </div>
                        </div>
        
                        <div class="col-6">
                            <label for="" class="control-label">{{trans('words.user_type')}} *</label>
                            <select name="usertype" id="basic" class="selectpicker show-tick form-control" disabled>
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
                                    value="{{ Auth::user()->agency_id }}" readonly>
                                <input type="text" name="agency_" id="agency_" class="form-control"
                                    value="{{ Auth::user()->agency->name }}" readonly>
                            @else
                                <select name="agency_id" id="agency_id" class="selectpicker show-tick form-control" disabled>
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
                            <select name="status" id="basic" class="selectpicker show-tick form-control" disabled>
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
                            <input type="text" name="email" value="{{ $user->email }}" class="form-control"  readonly>
                        </div>
                        <hr>
                    </div>
        
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
