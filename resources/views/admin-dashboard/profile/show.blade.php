@extends('admin-dashboard.layouts.master')
@section('content')
    <!-- row -->
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo">
                                @if ($data['user']->usertype == 'Agency')
                                    <img src="{{ asset('assets/images/profile.jpg') }}"
                                        class="img-fluid" alt="Agency Img" />
                                @else
                                    <img src="{{ asset('assets/images/profile.jpg') }}"
                                        class="img-fluid" alt="">
                                @endif

                            </div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                @if ($data['user']->usertype == 'Agency')
                                    <img src="{{ asset('upload/agencies/' . $data['user']->agency->image) }}"
                                        class="img-fluid rounded-circle" alt="Agency Img" />
                                @else
                                    <img src="{{ asset('upload/agencies/' . $data['user']->image_icon) }}"
                                        class="img-fluid rounded-circle" alt="">
                                @endif
                            </div>
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    <h4 class="text-primary mb-0">{{ $data['user']->name }}</h4>
                                    <p>{{ $data['user']->usertype }}</p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{ $data['user']->email }}</h4>
                                </div>
                                <div class="dropdown ml-auto">
                                    <a href="#" class="btn btn-primary light sharp rounded">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#about-me" data-toggle="tab"
                                        class="nav-link active show">About Me</a>
                                </li>
                                <li class="nav-item"><a href="#profile-settings" data-toggle="tab"
                                        class="nav-link">Setting</a>
                                </li>
                                <li class="nav-item"><a href="#password" data-toggle="tab"
                                        class="nav-link">Password</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="about-me" class="tab-pane fade active show">
                                    <div class="profile-about-me">
                                        <div class="pt-4 border-bottom-1 pb-3">
                                            <h4 class="text-primary">About Me</h4>
                                            <p class="mb-2">{{ $data['user']->about }}</p>
                                        </div>
                                    </div>
                                    <div class="profile-lang  mb-5">
                                        <h4 class="text-primary mb-2">Status</h4>
                                        <a href="javascript:void()" class="text-muted pr-3 f-s-16">
                                            <i class="flag-icon flag-icon-us"></i>
                                            {{ $data['user']->status == 1 ? 'Active' : 'Inactive' }}
                                        </a>
                                    </div>
                                    <div class="profile-personal-info">
                                        <h4 class="text-primary mb-4">Social Contacts</h4>
                                        <div class="row mb-4 mb-sm-4">
                                            <div class="col-sm-3">
                                                <h5 class="f-w-500">Phone <span
                                                        class="pull-right d-none d-sm-block">:</span></h5>
                                            </div>
                                            <div class="col-sm-9"><span>{{ $data['user']->phone }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4 mb-sm-4">
                                            <div class="col-sm-3">
                                                <h5 class="f-w-500">WhatsApp <span
                                                        class="pull-right d-none d-sm-block">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9"><span>{{ $data['user']->whatsapp }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4 mb-sm-4">
                                            <div class="col-sm-3">
                                                <h5 class="f-w-500">Facebook <span
                                                        class="pull-right d-none d-sm-block">:</span></h5>
                                            </div>
                                            <a class="col-sm-9" href="{{ $data['user']->facebook }}">
                                                {{ $data['user']->facebook }}
                                            </a>
                                        </div>
                                        <div class="row mb-4 mb-sm-4">
                                            <div class="col-sm-3">
                                                <h5 class="f-w-500">Twitter <span
                                                        class="pull-right d-none d-sm-block">:</span>
                                                </h5>
                                            </div>
                                            <a class="col-sm-9" href="{{ $data['user']->twitter }}">
                                                {{ $data['user']->twitter }}
                                            </a>
                                        </div>
                                        <div class="row mb-4 mb-sm-4">
                                            <div class="col-sm-3">
                                                <h5 class="f-w-500">Instagram <span
                                                        class="pull-right d-none d-sm-block">:</span></h5>
                                            </div>
                                            <a class="col-sm-9" href="{{ $data['user']->instagram }}">
                                                {{ $data['user']->instagram }}
                                            </a>
                                        </div>
                                        <div class="row mb-4 mb-sm-4">
                                            <div class="col-sm-3">
                                                <h5 class="f-w-500">Linkedin <span
                                                        class="pull-right d-none d-sm-block">:</span></h5>
                                            </div>
                                            <a class="col-sm-9" href="{{ $data['user']->linkedin }}">
                                                {{ $data['user']->linkedin }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="profile-settings" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            @if (Session::has('flash_message_profile'))
                                                <div class="alert alert-success">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    </button>
                                                    {{ Session::get('flash_message_profile') }}
                                                </div>
                                            @endif

                                            <h4 class="text-primary">Account Setting</h4>
                                            {!! Form::open([
                                                'url' => 'admin/profile', 'class' => 'form-horizontal padding-15',  'name' => 'account_form','id' => 'account_form',  'role' => 'form', 'enctype' => 'multipart/form-data', ]) !!}

                                                @if ($data['user']->usertype == 'Agency')
                                                    <div class="media">
                                                        <div class="media-left">
                                                            @if ($data['user']->agency->image)
                                                                <img src="{{ URL::asset('upload/agencies/' . $data['user']->agency->image) }}"
                                                                    width="80" alt="person">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="media-body media-middle">
                                                        <input type="file" name="user_icon" class="filestyle">
                                                    </div>
                                                @else
                                                    <div class="media">
                                                        <div class="media-left">
                                                            @if ($data['user']->image_icon)
                                                                <img src="{{ URL::asset('upload/agencies/' . $data['user']->image_icon) }}"
                                                                    width="80" alt="person">
                                                            @endif
                                                        </div>
                                                        <div class="media-body media-middle">
                                                            <input type="file" name="user_icon" class="filestyle"><br>
                                                            <small class="text-muted bold">Size 80x80px</small>
                                                            
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Name</label>
                                                        <input name="name" type="text" value="{{ $data['user']->name }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Email</label>
                                                        <input name="email" type="email"
                                                            value="{{ $data['user']->email }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Phone</label>
                                                        <input name="phone" type="text"
                                                            value="{{ $data['user']->phone }}" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>WhatsApp</label>
                                                        <input name="whatsapp" type="text"
                                                            value="{{ $data['user']->whatsapp }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>About</label>
                                                    <textarea name="about" type="text" class="form-control" rows="7">{{ $data['user']->about }}</textarea>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <label>Facebook</label>
                                                        <input name="facebook" type="text"
                                                            value="{{ $data['user']->facebook }}"
                                                            class="form-control">
                                                    </div>

                                                    <div class="form-group col-6">
                                                        <label>Twitter</label>
                                                        <input name="twitter" type="text"
                                                            value="{{ $data['user']->twitter }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <label>Instagram</label>
                                                        <input name="instagram" type="text"
                                                            value="{{ $data['user']->instagram }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label>Linkedin</label>
                                                        <input name="linkedin" type="text"
                                                            value="{{ $data['user']->instagram }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <button class="btn btn-primary" type="submit">Update</button>
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <div id="password" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            @if (Session::has('flash_message_profile'))
                                                <div class="alert alert-success">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    </button>
                                                    {{ Session::get('flash_message_profile') }}
                                                </div>
                                            @endif

                                            <h4 class="text-primary">Password</h4>
                                            {!! Form::open([
                                                'url' => 'admin/profile_pass',
                                                'class' => 'form-horizontal
                                                            padding-15',
                                                'name' => 'pass_form',
                                                'id' => 'pass_form',
                                                'role' => 'form',
                                            ]) !!}
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>New Password</label>
                                                        <input name="password" type="password" value=""
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Confirm Password</label>
                                                        <input name="password_confirmation" type="password"
                                                            value="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <button class="btn btn-primary" type="submit">Update</button>
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
