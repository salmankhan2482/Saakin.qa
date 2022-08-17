@extends("front.layouts.main")

@section('content')
    <div class="site-banner" style="background-image: url('{{ asset('assets/images/backgrounds/bg-4.jpg') }}')">
        <div class="container">
            <h1 class="text-center">Profile</h1>
        </div>
    </div>

    <section class="inner-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        @if (Auth::user()->image_icon)
                            <img src="{{ URL::asset('upload/members/' . Auth::user()->image_icon . '-b.jpg') }}"
                                alt="Profile Image" height="50%" class="card-img-top">
                        @else
                            <img src="{{ URL::asset('site_assets/img/agent-img3.jpg') }}" alt="Default Agent Pic"
                                class="profile-avatar">
                        @endif
                        <div class="card-body" style="text-align: center">
                            <h5 class="card-title">{{ Auth::user()->name }}</h5>
                            <p class="card-text">{{ Auth::user()->email }}</p>
                        </div>
                        <ul class="list-group property-type-list list-unstyled p-3">
                            <li>
                                <a href="{{ URL::to('save-search') }}">
                                    <i class="fa fa-user icon"></i> Saved Search
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('profile') }}">
                                    <i class="fa fa-user icon"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('change_pass') }}">
                                    <i class="fa fa-lock icon"></i> Password
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::to('logout') }}">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card contact-form mt-3 mt-lg-0">
                        <div class="card-body">

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


                            {!! Form::open(['url' => 'profile', 'class' => '', 'name' => 'profile_form', 'id' => 'profile_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-control-wrap row gx-2 gy-2">
                                <!--<div id="message" class="alert alert-danger alert-dismissible fade"></div>-->
                                <div class="form-group col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" id="name"
                                        placeholder="{{ trans('words.name') }} *" name="name" required>
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="{{ trans('words.email') }} *" value="{{ Auth::user()->email }}"
                                        required>
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone"
                                    value="{{ Auth::user()->phone }}" required>
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('user_icon') ? ' has-error' : '' }}">
                                    <input type="file" name="user_icon" class="form-control" placeholder="Choose File"
                                        value="{{ old('user_icon') }}" required>
                                </div>
                                <div class="form-group col-md-12 {{ $errors->has('about') ? ' has-error' : '' }}">
                                    <textarea id="about" rows="4" name="about" class="form-control" placeholder="{{ trans('words.about') }} *"
                                        required>{{ Auth::user()->about }}</textarea>
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('facebook') ? ' has-error' : '' }}">
                                    <input type="text" name="facebook" class="form-control"
                                        placeholder="Facebook Profile Link" value="{{ Auth::user()->facebook }}"
                                        required>
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('instagram') ? ' has-error' : '' }}">
                                    <input type="text" name="instagram" class="form-control"
                                        placeholder="Instagram Profile Link" value="{{ Auth::user()->instagram }}"
                                        required>
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('twitter') ? ' has-error' : '' }}">
                                    <input type="text" name="twitter" class="form-control"
                                        placeholder="Twitter Profile Link" value="{{ Auth::user()->twitter }}" required>
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('linkedin') ? ' has-error' : '' }}">
                                    <input type="text" name="linkedin" class="form-control"
                                        placeholder="Linkedin Profile Link" value="{{ Auth::user()->linkedin }}"
                                        required>
                                </div>
                                <div class="form-group col-md-12 mb-0">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
