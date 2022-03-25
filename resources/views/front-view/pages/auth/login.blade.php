@extends("front.layouts.main")

@section('head_title', trans('words.sign_in') . ' | ' . getcong('site_name'))
@section('head_url', Request::url())
@section('title', 'Sign in | Saakin.com')
@section('description', 'Sign-in to your Saakin Account')
@section('type', 'saakin-sign-in')
@section('url', Request::url())

@section('content')
  <div class="breadcrumb-section page-title bg-h" style="background-image: url('{{ asset('assets/images/citys/9.jpg') }}'); background-position: bottom">
    <div class="overlay op-5"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-10 ml-auto mr-auto text-center">
          <div class="breadcrumb-menu">
            <h1 style="color: white">Login/Register</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="property-listing boxed-view clearfix">
    <div class="container">

      <!--User Login section starts-->
      <div class="user-login-section mt-30 mb-30">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-12">
                <ul class="ui-list nav nav-tabs d-flex justify-content-center" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#login" role="tab" aria-selected="true">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#register" role="tab" aria-selected="false">Register</a>
                  </li>
                </ul>

                <div class="login-wrapper">
                  <div class="ui-dash tab-content">
                    <div class="tab-pane fade show active" id="login" role="tabpanel">
                      <div class="row">
                        <div class="col-md-12">
                          @if (Session::has('flash_message'))
                            <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              </button>
                              {{ Session::get('flash_message') }}
                            </div>
                          @endif

                          @if (Session::has('login_error_flash_msg'))
                            @if (count($errors) > 0)
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <ul>
                                  @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                  @endforeach
                                </ul>
                              </div>
                            @endif
                          @endif
                        </div>
                      </div>

                      <div class="row">

                        <div class="col-md-12">

                          {!! Form::open(['url' => 'login', 'class' => 'search-form', 'id' => 'loginform', 'role' => 'form', 'autocomplete' => 'on']) !!}
                          @csrf
                          <div class="form-group res-box text-center mt-10 mb-10">

                            <a href="#" type="submit" class="btn v8 facebook-button">
                              <span>
                                <i class="fab fa-facebook fa-2x"></i>
                              </span>
                              <span>
                                Sign in with Facebook
                              </span>
                            </a>
                          </div>
                          <div class="form-group res-box text-center mt-10 mb-10">

                            <a href="#" type="submit" class="btn v8 google-button">
                              <span>
                                <i class="fab fa-google fa-2x"></i>
                              </span>
                              <span>
                                Sign in with Google
                              </span>
                            </a>
                          </div>
                          <div class="form-group">
                            <input type="email" class="form-control" tabindex="1" placeholder="{{ trans('words.email') }}" name="email" id="email" style="margin-bottom: 5px;" />
                            @if ($errors->has('email'))
                              <span style="color:#fb0303">
                                {{ $errors->first('email') }}
                              </span>
                            @endif
                          </div>
                          <div class="form-group">

                            <input placeholder="{{ trans('words.password') }}" class="form-control" type="password" name="password" id="password" style="margin-bottom: 5px;" />
                            @if ($errors->has('password'))
                              <span style="color:#fb0303">
                                {{ $errors->first('password') }}
                              </span>
                            @endif
                          </div>
                          <div class="row mt-20">
                            <div class="col-md-12 text-left">
                              <div class="res-box">
                                <input id="check-l" type="checkbox" name="check">
                                <label for="check-l">Remember me</label>
                              </div>
                            </div>
                            <div class="col-md-12 text-right">
                              <div class="res-box sm-left">
                                <a href="{{ route('password.email') }}" tabindex="5" class="forgot-password">{{ trans('words.forgot_password') }}</a>
                              </div>
                            </div>
                          </div>
                          <div class="res-box text-center mt-30">
                            <button type="submit" class="btn v8"><span class="lnr lnr-exit"></span>
                              {{ trans('words.login_text') }}</button>
                          </div>
                          {!! Form::close() !!}
                        </div>

                      </div>
                    </div>
                    <div class="tab-pane fade" id="register" role="tabpanel">
                      <div class="row">
                        <div class="col-md-12">
                          @if (Session::has('flash_message'))
                            <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              </button>
                              {{ Session::get('flash_message') }}
                            </div>
                          @endif

                          @if (Session::has('login_error_flash_msg'))
                            @if (count($errors) > 0)
                              <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <ul>
                                  @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                  @endforeach
                                </ul>
                              </div>
                            @endif
                          @endif
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">

                          {!! Form::open(['url' => 'register', 'class' => 'search-form', 'id' => 'registerform', 'role' => 'form']) !!}
                          <div class="form-group">
                            <input type="text" class="form-control" placeholder="{{ trans('words.name') }}" name="name" id="name" style="margin-bottom: 5px;" />
                            @if ($errors->has('name'))
                              <span style="color:#fb0303">
                                {{ $errors->first('name') }}
                              </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <input type="email" class="form-control" placeholder="{{ trans('words.email') }}" name="email" id="email" style="margin-bottom: 5px;" />
                            @if ($errors->has('email'))
                              <span style="color:#fb0303">
                                {{ $errors->first('email') }}
                              </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <input placeholder="{{ trans('words.password') }}" class="form-control" type="password" name="password" id="password_register" style="margin-bottom: 5px;" />
                            @if ($errors->has('password'))
                              <span style="color:#fb0303">
                                {{ $errors->first('password') }}
                              </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <input class="form-control" type="password" placeholder="{{ trans('words.confirm_password') }}" name="password_confirmation" id="password_confirmation"
                              style="margin-bottom: 5px;" />
                            @if ($errors->has('password_confirmation'))
                              <span style="color:#fb0303">
                                {{ $errors->first('password_confirmation') }}
                              </span>
                            @endif
                          </div>
                          <div class="res-box text-left">
                            <label>
                              <input type="checkbox" name="terms">
                              I've read and accept <a href="{{ url('terms-of-use') }}"> terms
                                &amp; conditions</a></label><br />
                          </div>
                          <div class="res-box text-center mt-30">
                            <button type="submit" class="btn v8"><i class="lnr lnr-enter"></i>{{ 'Create an account' }}</button>
                          </div>
                          </form>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">

              <div class="login-wrapper mt-100">
                <div class="ui-dash tab-content">
                  <div class="tab-pane fade show active" id="login" role="tabpanel">
                    <div class="signup-wrapper">
                      <img src="{{ asset('assets/images/login-1.png') }}" alt="Login-1 pic">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>


@endsection
@push('scripts')
  <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>

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
