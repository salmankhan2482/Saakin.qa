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
                            <div class="cover-photo"></div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                @if ($data['user']->usertype == 'Agency')
                                    <img  src="{{ asset('upload/agencies/'.$data['user']->agency->image ) }}" class="img-fluid rounded-circle" alt="Agency Img"/>
                                @else
                                    <img  src="{{ asset('upload/agencies/'.$data['user']->image_icon) }}" class="img-fluid rounded-circle" alt="">
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-statistics">
                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col">
                                                <h3 class="m-b-0">150</h3><span>Follower</span>
                                            </div>
                                            <div class="col">
                                                <h3 class="m-b-0">140</h3><span>Place Stay</span>
                                            </div>
                                            <div class="col">
                                                <h3 class="m-b-0">45</h3><span>Reviews</span>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="javascript:void()" class="btn btn-primary mb-1 mr-1">Follow</a> 
                                            <a href="javascript:void()" class="btn btn-primary mb-1">Send Message</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4 class="text-black">Today Highlights</h4>
                            </div>
                            <div class="card-body pt-3">
                                <div class="profile-blog">
                                    <img  src="{{ asset('admin/images/profile/1.jpg') }}" alt="" class="img-fluid mb-4 w-100">
                                    <h4><a href="{!! url('/post-details'); !!}" class="text-black">Darwin Creative Agency Theme</a></h4>
                                    <p class="mb-0">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4 class="text-black">Interest</h4>
                            </div>
                            <div class="card-body pt-3">
                                <div class="profile-interest">
                                    <h5 class="text-primary d-inline"></h5>
                                    <div class="row sp4" id="lightgallery">
                                        <a href="admin/images/profile/2.jpg" data-exthumbimage="admin/images/profile/2.jpg" data-src="admin/images/profile/2.jpg" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="{{ asset('admin/images/profile/2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                        <a href="admin/images/profile/3.jpg" data-exthumbimage="admin/images/profile/3.jpg" data-src="admin/images/profile/3.jpg" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="{{ asset('admin/images/profile/3.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                        <a href="admin/images/profile/4.jpg" data-exthumbimage="admin/images/profile/4.jpg" data-src="admin/images/profile/4.jpg" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="{{ asset('admin/images/profile/4.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                        <a href="admin/images/profile/3.jpg" data-exthumbimage="admin/images/profile/3.jpg" data-src="admin/images/profile/3.jpg" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="{{ asset('admin/images/profile/2.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                        <a href="admin/images/profile/4.jpg" data-exthumbimage="admin/images/profile/4.jpg" data-src="admin/images/profile/4.jpg" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="{{ asset('admin/images/profile/3.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                        <a href="admin/images/profile/2.jpg" data-exthumbimage="admin/images/profile/2.jpg" data-src="admin/images/profile/2.jpg" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="{{ asset('admin/images/profile/4.jpg') }}" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">							
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h4 class="text-black">All latest properties</h4>
                            </div>
                            <div class="card-body pt-3">
                                <div class="profile-news">
                                   @foreach ($data['latestProperties'] as $single)
                                    <div class="media pt-3 pb-3">
                                        @if ($single->featured_image)
                                            <img src="{{ URL::asset('upload/properties/thumb_'.$single->featured_image) }}" 
                                                alt="{{ 'ID ='.$single->id  }}" width="100px">
                                        @else
                                            <img  src="{{ asset('admin/images/profile/5.jpg') }}" alt="image" class="mr-3 rounded" width="75">
                                        @endif

                                        <div class="media-body ml-1">
                                            <h5 class="m-b-5">
                                                <a href="{{ route('property-detail', [strtolower($single->property_purpose), $single->property_slug, $single->id]) }}" class="text-black">
                                                    {{ $single->property_name }}
                                                </a>
                                            </h5>
                                            <p class="mb-0">
                                                {{ $single->property_purpose }}
                                            </p>
                                        </div>
                                    </div>
                                   @endforeach
                                </div>
                                <a href="{{ route('property.index') }}" class="btn btn-success">See All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link active show">Posts</a>
                                    </li>
                                    <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link">About Me</a>
                                    </li>
                                    <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link">Setting</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="my-posts" class="tab-pane fade active show">
                                        <div class="my-post-content pt-3">
                                            <div class="post-input">
                                                <textarea name="textarea" id="textarea" cols="30" rows="5" class="form-control bg-transparent" placeholder="Please type what you want...."></textarea> 
                                                <a href="javascript:void()" class="btn btn-primary light px-3"><i class="fa fa-link"></i> </a>
                                                <a href="javascript:void()" class="btn btn-primary light mr-1 px-3"><i class="fa fa-camera"></i> </a><a href="javascript:void()" class="btn btn-primary">Post</a>
                                            </div>
                                            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                                <img  src="{{ asset('admin/images/profile/8.jpg') }}" alt="" class="img-fluid">
                                                <a class="post-title" href="{!! url('/post-details'); !!}">
                                                    <h3 class="text-black">Collection of textile samples lay spread</h3>
                                                </a>
                                                <p>A wonderful serenity has take possession of my entire soul like these sweet morning of spare which enjoy whole heart.A wonderful serenity has take possession of my entire soul like these sweet morning
                                                    of spare which enjoy whole heart.</p>
                                                <button class="btn btn-primary mr-2"><span class="mr-2"><i
                                                            class="fa fa-heart"></i></span>Like</button>
                                                <a href="{!! url('/post-details'); !!}" class="btn btn-secondary">
                                                    <span class="mr-2"><i class="fa fa-reply"></i></span>Reply
                                                </a>
                                            </div>
                                            <div class="profile-uoloaded-post border-bottom-1 pb-5">
                                                <img  src="{{ asset('admin/images/profile/9.jpg') }}" alt="" class="img-fluid">
                                                <a class="post-title" href="{!! url('/post-details'); !!}">
                                                    <h3 class="text-black">Collection of textile samples lay spread</h3>
                                                </a>
                                                <p>A wonderful serenity has take possession of my entire soul like these sweet morning of spare which enjoy whole heart.A wonderful serenity has take possession of my entire soul like these sweet morning
                                                    of spare which enjoy whole heart.</p>
                                                <button class="btn btn-primary mr-2"><span class="mr-2"><i
                                                            class="fa fa-heart"></i></span>Like</button>
                                                <a href="{!! url('/post-details'); !!}" class="btn btn-secondary">
                                                    <span class="mr-2"><i class="fa fa-reply"></i></span>Reply
                                                </a>
                                            </div>
                                            <div class="profile-uoloaded-post">
                                                <img  src="{{ asset('admin/images/profile/8.jpg') }}" alt="" class="img-fluid">
                                                <a class="post-title" href="{!! url('/post-details'); !!}">
                                                    <h3 class="text-black">Collection of textile samples lay spread</h3>
                                                </a>
                                                <p>A wonderful serenity has take possession of my entire soul like these sweet morning of spare which enjoy whole heart.A wonderful serenity has take possession of my entire soul like these sweet morning
                                                    of spare which enjoy whole heart.</p>
                                                <button class="btn btn-primary mr-2"><span class="mr-2"><i
                                                            class="fa fa-heart"></i></span>Like</button>
                                                <a href="{!! url('/post-details'); !!}" class="btn btn-secondary">
                                                    <span class="mr-2"><i class="fa fa-reply"></i></span>Reply
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="about-me" class="tab-pane fade">
                                        <div class="profile-about-me">
                                            <div class="pt-4 border-bottom-1 pb-3">
                                                <h4 class="text-primary">About Me</h4>
                                                <p class="mb-2">{{$data['user']->about}}</p>
                                            </div>
                                        </div>
                                        <div class="profile-skills mb-5">
                                            <h4 class="text-primary mb-2">Roles</h4>
                                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1">
                                                User
                                            </a>
                                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1">
                                                {{ $data['user']->usertype }}
                                            </a>
                                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1">Photoshop</a>
                                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1">Bootstrap</a>
                                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1">Responsive</a>
                                            <a href="javascript:void()" class="btn btn-primary light btn-xs mb-1">Crypto</a>
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
                                                    <h5 class="f-w-500">Phone <span class="pull-right d-none d-sm-block">:</span></h5>
                                                </div>
                                                <div class="col-sm-9"><span>{{ $data['user']->phone }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-4 mb-sm-4">
                                                <div class="col-sm-3">
                                                    <h5 class="f-w-500">WhatsApp <span class="pull-right d-none d-sm-block">:</span>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-9"><span>{{ $data['user']->whatsapp }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-4 mb-sm-4">
                                                <div class="col-sm-3">
                                                    <h5 class="f-w-500">Facebook <span class="pull-right d-none d-sm-block">:</span></h5>
                                                </div>
                                                <a class="col-sm-9" href="{{ $data['user']->facebook }}">
                                                    {{ $data['user']->facebook }}
                                                </a>
                                            </div>
                                            <div class="row mb-4 mb-sm-4">
                                                <div class="col-sm-3">
                                                    <h5 class="f-w-500">Twitter <span class="pull-right d-none d-sm-block">:</span>
                                                    </h5>
                                                </div>
                                                <a class="col-sm-9" href="{{ $data['user']->twitter }}">
                                                    {{ $data['user']->twitter }}
                                                </a>
                                            </div>
                                            <div class="row mb-4 mb-sm-4">
                                                <div class="col-sm-3">
                                                    <h5 class="f-w-500">Instagram <span class="pull-right d-none d-sm-block">:</span></h5>
                                                </div>
                                                <a class="col-sm-9" href="{{ $data['user']->instagram }}">
                                                    {{ $data['user']->instagram }}
                                                </a>                                              
                                            </div>
                                            <div class="row mb-4 mb-sm-4">
                                                <div class="col-sm-3">
                                                    <h5 class="f-w-500">Linkedin <span class="pull-right d-none d-sm-block">:</span></h5>
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
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        </button>
                                                        {{ Session::get('flash_message_profile') }}
                                                    </div>
                                                @endif
                                                
                                                <h4 class="text-primary">Account Setting</h4>
                                                <form method="POST" action="{{ url('admin/profile') }}" enctype="multipart/form-data">
                                                    @csrf

                                                    @if ($data['user']->usertype == 'Agency')
                                                        <div class="media">
                                                            <div class="media-left">
                                                                @if ($data['user']->agency->image)
                                                                <img src="{{ URL::asset('upload/agencies/' . $data['user']->agency->image) }}" width="200" alt="person">
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
                                                                    <img src="{{ URL::asset('upload/agencies/' . $data['user']->image_icon ) }}" width="80" alt="person">
                                                                @endif
                                                            </div>
                                                            <div class="media-body media-middle">
                                                                <input type="file" name="user_icon" class="filestyle">
                                                                <small class="text-muted bold">Size 80x80px</small>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="form-row mt-5">
                                                        <div class="form-group col-md-6">
                                                            <label>Name</label>
                                                            <input name="name" type="text" value="{{ $data['user']->name }}" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Email</label>
                                                            <input name="email" type="email" value="{{ $data['user']->email }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Password</label>
                                                            <input name="password" type="password" class="form-control">
                                                        </div>
                                                        
                                                        <div class="form-group col-md-6">
                                                            <label>Confirm Password</label>
                                                            <input name="password_confirmation" type="password" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Phone</label>
                                                            <input name="phone" type="text" value="{{ $data['user']->phone }}"  class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>WhatsApp</label>
                                                            <input name="whatsapp" type="text" value="{{ $data['user']->whatsapp }}"  class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>About</label>
                                                        <textarea name="about" type="text" class="form-control" rows="4" >{{ $data['user']->about }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Facebook</label>
                                                        <input name="facebook" type="text" value="{{ $data['user']->facebook }}" class="form-control">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label>Twitter</label>
                                                        <input name="twitter" type="text" value="{{ $data['user']->twitter }}" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Instagram</label>
                                                        <input name="instagram" type="text" value="{{ $data['user']->instagram }}" class="form-control">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label>Linkedin</label>
                                                        <input name="linkedin" type="text" value="{{ $data['user']->instagram }}" class="form-control">
                                                    </div>
                                                    
                                                    <button class="btn btn-primary" type="submit">Update</button>
                                                </form>
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
    </div>
			
@endsection