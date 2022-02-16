<style>
    .fa-google {
    font-size: 20px;
    background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    -webkit-text-fill-color: transparent;
    }
    .google-button{
        background-color: white !important;
       border: 1px solid #009fff !important;
       color: black !important;
}
.fa-facebook {
    font-size: 20px;
}
</style>

<div class="modal fade" style="padding: none !important" id="user-login-popup">
    <div style="display: flex !important">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"><i class="lnr lnr-cross"></i></span></button>
                </div>
                <div class="modal-body">
                    <section class="property-listing boxed-view clearfix">
                        <div class="container">

                            <!--User Login section starts-->
                            <div class="user-login-section mt-30 mb-30">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="ui-list nav nav-tabs d-flex justify-content-center" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#login" role="tab" aria-selected="true">
                                                        Login
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#register" role="tab" aria-selected="false">
                                                        Register
                                                    </a>
                                                </li>
                                            </ul>
                                            
                                            <div class="login-wrapper">
                                                <div class="ui-dash tab-content">
                                                    <div class="tab-pane fade show active" id="login" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                @if (Session::has('flash_message'))
                                                                    <div class="alert alert-success">
                                                                        <button type="button" class="close"
                                                                            data-dismiss="alert" aria-label="Close">
                                                                        </button>
                                                                        {{ Session::get('flash_message') }}
                                                                    </div>
                                                                @endif

                                                                @if (Session::has('login_error_flash_msg'))
                                                                    @if (count($errors) > 0)
                                                                        <div class="alert alert-danger">
                                                                            <button type="button" class="close"
                                                                                data-dismiss="alert"
                                                                                aria-label="Close"><span
                                                                                    aria-hidden="true">&times;</span></button>
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
                                                
                                                                    <a href="{{ route('facebook.login') }}" 
                                                                    type="submit" class="btn v8 facebook-button">
                                                                        <span>
                                                                            <i class="fab fa-facebook fa-2x"></i>
                                                                        </span>
                                                                        <span >
                                                                            Sign in with Facebook
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                <div class="form-group res-box text-center mt-10 mb-10">
                                                
                                                                    <a href="{{ route('google.login') }}" 
                                                                        type="submit" class="btn v8 google-button">
                                                                        <span>
                                                                            <i class="fab fa-google fa-2x"></i>
                                                                        </span>
                                                                        <span >
                                                                            Sign in with Google
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control"
                                                                        
                                                                        placeholder="{{ trans('words.email') }}"
                                                                        name="email" id="email"
                                                                        style="margin-bottom: 5px;" />
                                                                    @if ($errors->has('email'))
                                                                        <span style="color:#fb0303">
                                                                            {{ $errors->first('email') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">

                                                                    <input placeholder="{{ trans('words.password') }}"
                                                                        class="form-control" type="password"
                                                                        name="password" id="password"
                                                                        style="margin-bottom: 5px;" />
                                                                    @if ($errors->has('password'))
                                                                        <span style="color:#fb0303">
                                                                            {{ $errors->first('password') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="row mt-20">
                                                                    <div class="col-md-12 text-left">
                                                                        <div class="res-box">
                                                                            <input id="check-l" type="checkbox"
                                                                                name="check">
                                                                            <label for="check-l">Remember me</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 text-right">
                                                                        <div class="res-box sm-left">
                                                                            <a href="{{ route('password.email') }}"
                                                                                 class="forgot-password">
                                                                                {{ trans('words.forgot_password') }}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="res-box text-center d-flex justify-content-center mt-30">
                                                                    <button type="submit" class="btn v8">
                                                                        <span class="lnr lnr-exit" style="font-size: 14px; "></span>
                                                                        {{ trans('words.login_text') }}
                                                                    </button>
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
                                                                        <button type="button" class="close"
                                                                            data-dismiss="alert" aria-label="Close">
                                                                        </button>
                                                                        {{ Session::get('flash_message') }}
                                                                    </div>
                                                                @endif

                                                                @if (Session::has('login_error_flash_msg'))
                                                                    @if (count($errors) > 0)
                                                                        <div class="alert alert-danger">
                                                                            <button type="button" class="close"
                                                                                data-dismiss="alert"
                                                                                aria-label="Close"><span
                                                                                    aria-hidden="true">&times;</span></button>
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
                                                                    <input type="text" class="form-control"
                                                                        placeholder="{{ trans('words.name') }}"
                                                                        name="name" id="name"
                                                                        style="margin-bottom: 5px;" />
                                                                    @if ($errors->has('name'))
                                                                        <span style="color:#fb0303">
                                                                            {{ $errors->first('name') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control"
                                                                        placeholder="{{ trans('words.email') }}"
                                                                        name="email" id="email"
                                                                        style="margin-bottom: 5px;" />
                                                                    @if ($errors->has('email'))
                                                                        <span style="color:#fb0303">
                                                                            {{ $errors->first('email') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <input
                                                                        placeholder="{{ trans('words.password') }}"
                                                                        class="form-control" type="password"
                                                                        name="password" id="password_register"
                                                                        style="margin-bottom: 5px;" />
                                                                    @if ($errors->has('password'))
                                                                        <span style="color:#fb0303">
                                                                            {{ $errors->first('password') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="password"
                                                                        placeholder="{{ trans('words.confirm_password') }}"
                                                                        name="password_confirmation"
                                                                        id="password_confirmation"
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
                                                                        I've read and accept <a
                                                                            href="{{ url('terms-of-use') }}"> terms
                                                                            &amp; conditions</a></label><br />
                                                                </div>
                                                                <div class="form-group">
                                                                    {!! NoCaptcha::renderJs() !!}
                                                                    {!! NoCaptcha::display() !!}
                                                                    @if ($errors->has('g_recaptcha_confirmed'))
                                                                    <span style="color:#fb0303">
                                                                        {{ $errors->first('g_recaptcha_confirmed') }}
                                                                    </span>
                                                                @endif
                                                                </div>

                                                                <div class="res-box text-center mt-30">
                                                                    <button type="submit" class="btn v8">
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
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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