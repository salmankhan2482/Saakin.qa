@extends("front.layouts.main")

@section('head_title', trans('words.sign_in') . ' | ' . getcong('site_name'))
@section('head_url', Request::url())
@section('title', 'Sign in | Saakin.qa')
@section('description', 'Sign-in to your Saakin Account')
@section('type', 'saakin-sign-in')
@section('url', Request::url())

@section('content')
    <div class="site-banner" style="background-image: url('{{ asset('assets/images/citys/9.jpg') }}')">
        <div class="container">
            <h1 class="text-center">Login/Register</h1>
        </div>
    </div>
    <section class="property-listing boxed-view clearfix">
        <div class="container">
            <!--User Login section starts-->
            <div class="user-login-section p-4 mt-30 mb-30">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card mt-3 mt-lg-0">
                                <div class="card-body">
                                    <ul class="ui-list nav nav-tabs d-flex justify-content-center" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#login" role="tab"
                                                aria-selected="true">
                                                Login
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#register" role="tab"
                                                aria-selected="false">
                                                Register
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="login-wrapper">
                                        <div class="ui-dash tab-content">
                                            <div class="tab-pane fade show active" id="login" role="tabpanel">
                                                @if (Session::has('flash_message'))
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                        role="alert">
                                                        {{ Session::get('flash_message') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"> </button>
                                                    </div>
                                                @endif

                                                @if (Session::has('login_error_flash_msg'))
                                                    @if (count($errors) > 0)

                                                        <div class="alert alert-danger alert-dismissible fade show"
                                                            role="alert">
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="alert" aria-label="Close"> </button>
                                                        </div>

                                                    @endif
                                                @endif

                                                {!! Form::open(['url' => 'login', 'class' => 'search-form spbwy12', 'id' => 'loginform', 'role' => 'form', 'autocomplete' => 'on']) !!}
                                                @csrf
                                                <div class="form-group res-box text-center mt-10 mb-10">

                                                    <a href="{{ route('facebook.login') }}" type="submit"
                                                        class="btn btn-outline-primary w-100 facebook-button">
                                                        <span>
                                                            <i class="fab fa-facebook fa-2x fa-login-facebook"></i>
                                                        </span>
                                                        <span>
                                                            Sign in with Facebook
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="form-group res-box text-center mt-10 mb-10">

                                                    <a href="{{ route('google.login') }}" type="submit"
                                                        class="btn w-100 google-button">
                                                        <span>
                                                            <i class="fab fa-google fa-2x fa-login-google"></i>
                                                        </span>
                                                        <span>
                                                            Sign in with Google
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control"
                                                        placeholder="{{ trans('words.email') }}" name="email"
                                                        id="email" />
                                                    @if ($errors->has('email'))
                                                        <span class="d-block invalid-feedback">
                                                            {{ $errors->first('email') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input placeholder="{{ trans('words.password') }}"
                                                        class="form-control" type="password" name="password"
                                                        id="password" />
                                                    @if ($errors->has('password'))
                                                        <span class="d-block invalid-feedback">
                                                            {{ $errors->first('password') }}
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <div class="res-box">
                                                        <input id="check-l" type="checkbox" name="check">
                                                        <label for="check-l">Remember me</label>
                                                    </div>
                                                    <div class="res-box sm-left">
                                                        <a href="{{ route('password.email') }}" class="forgot-password">
                                                            {{ trans('words.forgot_password') }}
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="res-box text-center d-flex justify-content-center mt-30">
                                                    <button type="submit" class="btn btn-outline-primary w-100">
                                                        <span class="lnr lnr-exit" style="font-size: 14px; "></span>
                                                        {{ trans('words.login_text') }}
                                                    </button>
                                                </div>

                                                {!! Form::close() !!}

                                            </div>

                                            <div class="tab-pane fade" id="register" role="tabpanel">

                                                @if (Session::has('flash_message'))
                                                    <div class="alert alert-success">
                                                        <button type="button" class="close" data-bs-dismiss="alert"
                                                            aria-label="Close">
                                                        </button>
                                                        {{ Session::get('flash_message') }}
                                                    </div>
                                                @endif

                                                @if (Session::has('login_error_flash_msg'))
                                                    @if (count($errors) > 0)
                                                        <div class="alert alert-danger">
                                                            <button type="button" class="close"
                                                                data-bs-dismiss="alert" aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                @endif

                                                {!! Form::open(['url' => 'register', 'class' => 'search-form  spbwy12', 'id' => 'registerform', 'role' => 'form']) !!}
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ trans('words.name') }}" name="name" id="name" />
                                                    @if ($errors->has('name'))
                                                        <span class="d-block invalid-feedback">
                                                            {{ $errors->first('name') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control"
                                                        placeholder="{{ trans('words.email') }}" name="email"
                                                        id="register_email" />
                                                    @if ($errors->has('register_email'))
                                                        <span class="d-block invalid-feedback">
                                                            {{ $errors->first('register_email') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input placeholder="{{ trans('words.password') }}"
                                                        class="form-control" type="password" name="password"
                                                        id="password_register" />
                                                    @if ($errors->has('password'))
                                                        <span class="d-block invalid-feedback">
                                                            {{ $errors->first('password') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" type="password"
                                                        placeholder="{{ trans('words.confirm_password') }}"
                                                        name="password_confirmation" id="password_confirmation" />
                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="d-block invalid-feedback">
                                                            {{ $errors->first('password_confirmation') }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="res-box text-left">
                                                    <label>
                                                        <input type="checkbox" name="terms">
                                                        I've read and accept
                                                        <a href="{{ url('terms-of-use') }}">
                                                            terms &amp; conditions
                                                        </a>
                                                    </label><br>
                                                </div>
                                                <div class="res-box text-center mt-30">
                                                    <button type="submit" class="btn btn-outline-primary w-100">
                                                        <i class="lnr lnr-enter" style="font-size: 14px; "></i>
                                                        {{ 'Create an account' }}
                                                    </button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#registerform').validate({

            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password_register"
                },

                terms: "required",
            },
            messages: {
                name: {
                    required: "Please Enter Your name"
                },
                username: {
                    required: "Please Enter username",

                },
                email: {
                    required: "Please Enter email",
                    email: "Please enter a valid email address",

                },
                password: {
                    required: "Please Enter the Password",
                    minlength: "you have to enter at least 6 digits",
                },
                password_confirmation: " Enter Confirm Password Same as Password",
                terms: "Please check terms and conditions"
            },
            submitHandler: function(form) {
                form.submit();
            },

            errorPlacement: function(error, element) {
                if (element.attr("type") == "checkbox") {
                    error.insertAfter($(element).parents('label'));
                } else {
                    error.insertAfter($(element));
                }
            }

        });
    </script>
@endpush
