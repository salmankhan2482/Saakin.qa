@extends("front.layouts.main")

@section('title', 'Register | saakin.qa')
@section('description', 'Register your Account on Sakkin with few clicks')
@section('type', 'saakin-register')
@section('url', Request::url())

@section('head_title', trans('words.sign_in') . ' | ' . getcong('site_name'))
@section('head_url', Request::url())

@section('content')

    <div class="site-banner" style="background-image: url('{{ asset('assets/images/backgrounds/bg-4.jpg') }}')">
        <div class="container">
            <h1 class="text-center">Company Registration</h1>
        </div>
    </div>
    <section class="property-listing boxed-view clearfix">
        <div class="container">

            <!--User Login section starts-->
            <div class="user-login-section mt-30 mb-30">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-body">
                                <h6>Submit your details and we’ll get in touch</h6>
                                <p>
                                    To advertise with Saakin Inc. you need to be a broker or real estate company with a
                                    registered
                                    office in Doha, Qatar
                                </p>
                                <div class="card contact-form mt-3 mt-lg-0">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                    @endif

                                    @if (Session::has('flash_message_company_registration'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ Session::get('flash_message_company_registration') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <form action="{{ url('company-registration') }}" method="POST">
                                            @csrf
                                            <div class="form-control-wrap row gx-2 gy-3">
                                                <div class="form-group col-md-6">
                                                    <input type="text" name="first_name" placeholder="First Name *"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" name="last_name" placeholder="Last Name *"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="email" name="email" placeholder="Email *"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" name="phone" placeholder="Phone Number *"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="company_name" placeholder="Company Name *"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select name="city" id="city" class="form-control" required>
                                                        <option value="">Select City</option>
                                                        <option value="1">Doha</option>
                                                        <option value="2">Umm Salal Mohammad</option>
                                                        <option value="3">Al Daayen</option>
                                                        <option value="4">Al Khor</option>
                                                        <option value="5">Al Shamal</option>
                                                        <option value="6">Al Wakrah</option>
                                                        <option value="7">Lusail</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select name="job_title" id="job_title" class="form-control" required>
                                                        <option value="">Select Job Title</option>
                                                        <option value="CEO">CEO</option>
                                                        <option value="CFO">CFO</option>
                                                        <option value="CMO">CMO</option>
                                                        <option value="CTO">CTO</option>
                                                        <option value="Managing Director">Managing Director</option>
                                                        <option value="Finance Director">Finance Director</option>
                                                        <option value="Marketing Director">Marketing Director</option>
                                                        <option value="Director">Director</option>
                                                        <option value="Manager">Manager</option>
                                                        <option value="Sales Manager">Sales Manager</option>
                                                        <option value="Finance Manager">Finance Manager</option>
                                                        <option value="Marketing Manager">Marketing Manager</option>
                                                        <option value="Finance Executive">Finance Executive</option>
                                                        <option value="Marketing Exec">Marketing Exec</option>
                                                        <option value="Agent/Broker">Agent/Broker</option>
                                                        <option value="Admin">Admin</option>
                                                    </select>
                                                </div>
                                                <div class="form-row">
                                                    <div
                                                        class="form-group col-md-6 {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                                        <div class="mb-2">
                                                            {!! NoCaptcha::renderJs() !!}
                                                            {!! NoCaptcha::display() !!}
                                                            @if ($errors->has('g-recaptcha-response'))
                                                                <span class="help-block">
                                                                    {{ $errors->first('g-recaptcha-response') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--User login section ends-->
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
