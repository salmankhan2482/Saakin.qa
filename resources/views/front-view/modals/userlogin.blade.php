<style>
  .fa-google {
    font-size: 20px;
    background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    -webkit-text-fill-color: transparent;
  }

  .google-button {
    background-color: white !important;
    border: 1px solid #009fff !important;
    color: black !important;
  }

  .fa-facebook {
    font-size: 20px;
  }

  #name-error, #email-error, #password_register-error, #password_confirmation-error, #terms-error{
    color: #ea4335;
  }

</style>

<div class="modal fade" style="padding: none !important" id="user-login-popup" tabindex="-1" aria-labelledby="user-login-popup" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0 pb-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-0">
        <section class="property-listing boxed-view clearfix fs-sm">
            <!--User Login section starts-->
            <div class="user-login-section mt-30 mb-30">
              <ul class="ui-list nav nav-tabs d-flex justify-content-center" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-bs-toggle="tab" href="#login" role="tab" aria-selected="true">
                    Login
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#register" role="tab" aria-selected="false">
                    Register
                  </a>
                </li>
              </ul>

              <div class="login-wrapper">
                <div class="ui-dash tab-content">
                  <div class="tab-pane fade show active" id="login" role="tabpanel">
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

                    {!! Form::open(['url' => 'login', 'class' => 'search-form spbwy12', 'id' => 'loginform', 'role' => 'form', 'autocomplete' => 'on']) !!}
										@csrf
										<div class="form-group res-box text-center mt-10 mb-10">

											<a href="{{ route('facebook.login') }}" type="submit" class="btn btn-outline-primary w-100 facebook-button">
												<span>
													<i class="fab fa-facebook fa-2x"></i>
												</span>
												<span>
													Sign in with Facebook
												</span>
											</a>
										</div>
										<div class="form-group res-box text-center mt-10 mb-10">

											<a href="{{ route('google.login') }}" type="submit" class="btn w-100 google-button">
												<span>
													<i class="fab fa-google fa-2x"></i>
												</span>
												<span>
													Sign in with Google
												</span>
											</a>
										</div>
										<div class="form-group">
											<input type="email" class="form-control" tabindex="1" placeholder="{{ trans('words.email') }}" name="email" id="email" />
											@if ($errors->has('email'))
												<span class="d-block invalid-feedback">
													{{ $errors->first('email') }}
												</span>
											@endif
										</div>
										<div class="form-group">
											<input placeholder="{{ trans('words.password') }}" class="form-control" type="password" name="password" id="password" />
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
												<a href="{{ route('password.email') }}" tabindex="5" class="forgot-password">
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
												<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
												</button>
												{{ Session::get('flash_message') }}
											</div>
										@endif

										@if (Session::has('login_error_flash_msg'))
											@if (count($errors) > 0)
												<div class="alert alert-danger">
													<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
												<input type="text" class="form-control" placeholder="{{ trans('words.name') }}" name="name" id="name" />
												@if ($errors->has('name'))
													<span class="d-block invalid-feedback">
														{{ $errors->first('name') }}
													</span>
												@endif
											</div>
											<div class="form-group">
												<input type="email" class="form-control" placeholder="{{ trans('words.email') }}" name="email" id="email" />
												@if ($errors->has('email'))
													<span class="d-block invalid-feedback">
														{{ $errors->first('email') }}
													</span>
												@endif
											</div>
											<div class="form-group">
												<input placeholder="{{ trans('words.password') }}" class="form-control" type="password" name="password" id="password_register" />
												@if ($errors->has('password'))
													<span class="d-block invalid-feedback">
														{{ $errors->first('password') }}
													</span>
												@endif
											</div>
											<div class="form-group">
												<input class="form-control" type="password" placeholder="{{ trans('words.confirm_password') }}" name="password_confirmation" id="password_confirmation" />
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

        </section>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
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
          email: "Please enter a vinvalid email address",

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
