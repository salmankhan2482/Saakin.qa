@extends('admin-dashboard.layouts.master')
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('flash_message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('flash_message') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <a href="{{ route('new_dashboard') }}">
                    <button type="button" class="btn btn-rounded btn-dark">Back</button>
                </a>
            </ol>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#general_settings" data-toggle="tab"
                                        class="nav-link active show">General Settings</a>
                                </li>
                                <li class="nav-item"><a href="#smtp_email" data-toggle="tab"
                                        class="nav-link">SMTP Email</a>
                                </li>
                                <li class="nav-item"><a href="#payment_info" data-toggle="tab"
                                        class="nav-link">Payment Info</a>
                                </li>
                                <li class="nav-item"><a href="#layout" data-toggle="tab"
                                        class="nav-link">Layout</a>
                                </li>
                                <li class="nav-item"><a href="#social" data-toggle="tab"
                                        class="nav-link">Social</a>
                                </li>
                                <li class="nav-item"><a href="#add_code" data-toggle="tab"
                                    class="nav-link">Add Code</a>
                            </li>
                                <li class="nav-item"><a href="#contact_us" data-toggle="tab"
                                        class="nav-link">Contact Us</a>
                                </li>
                                <li class="nav-item"><a href="#other_settings" data-toggle="tab"
                                        class="nav-link">Other Settings</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="general_settings" class="tab-pane fade active show">
                                    <div class="my-post-content pt-2">
                                        {!! Form::open(['url' => 'admin/settings', 'class' => 'form-horizontal padding-15', 'name' => 'account_form', 'id' => 'account_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label>Logo</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="site_logo" id="site_logo"
                                                            class="custom-file-input">
                                                        <label class="custom-file-label" for="site_logo">Upload</label>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <div class="media mr-2">
                                                    <img src="{{ URL::asset('upload/' . $settings->site_logo) }}"
                                                        width="100" alt="Saakin Logo">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label>Favicon</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="site_favicon" id="site_favicon"
                                                            class="custom-file-input">
                                                        <label class="custom-file-label" for="site_favicon">Upload</label>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <div class="media mr-2">
                                                    <img src="{{ URL::asset('upload/' . $settings->site_favicon) }}"
                                                        width="50" alt="Saakin Favicon">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Website URL</label>
                                                <input type="text" id="site_url" name="site_url" class="form-control"
                                                    placeholder="URL" value="{{ $settings->site_url }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Website Name</label>
                                                <input type="text" id="site_name" name="site_name" class="form-control"
                                                    placeholder="Name" value="{{ $settings->site_name }}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Website Email</label>
                                                <input type="text" id="site_email" name="site_email" class="form-control"
                                                    placeholder="Email" value="{{ $settings->site_email }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Currency Sign</label>
                                                <input type="text" id="currency_sign" name="currency_sign"
                                                    class="form-control" placeholder="Currency Sign"
                                                    value="{{ $settings->currency_sign }}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Google Map Key</label>
                                                <input type="text" id="google_map_key" name="google_map_key"
                                                    class="form-control" placeholder="Google Map Key"
                                                    value="{{ $settings->google_map_key }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Default Timezone</label>
                                                <select class="selectpicker show-tick form-control" name="time_zone"
                                                    data-live-search="true">
                                                    @foreach (generate_timezone_list() as $key => $tz_data)
                                                        <option value="{{ $key }}"
                                                            @if ($settings->time_zone == $key) selected @endif>
                                                            {{ $tz_data }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <h4>reCaptcha </h4>
                                        <hr />
                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label>reCaptcha</label>
                                                <select class="selectpicker show-tick form-control" name="recaptcha"
                                                    data-live-search="true">
                                                    <option value="1" @if ($settings->recaptcha == 1) selected @endif> On
                                                    </option>
                                                    <option value="0" @if ($settings->recaptcha == 0) selected @endif> Off
                                                    </option>

                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>reCaptcha Secret Key</label>
                                                <input type="text" id="recaptcha_secret_key" name="recaptcha_secret_key"
                                                    class="form-control" placeholder="reCatcha Secret Key"
                                                    value="{{ $settings->recaptcha_secret_key }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>reCaptcha Site Key</label>
                                                <input type="text" id="recaptcha_site_key" name="recaptcha_site_key"
                                                    class="form-control" placeholder="reCaptcha Site Key"
                                                    value="{{ $settings->recaptcha_site_key }}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Site Description</label>
                                                <textarea type="text" id="site_description" rows="5" name="site_description" class="form-control"
                                                    placeholder="Site Description">{{ $settings->site_description }}</textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Site Keywords</label>
                                                <textarea type="text" id="site_keywords" rows="5" name="site_keywords" class="form-control"
                                                    placeholder="Site Keywords">{{ $settings->site_keywords }}</textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <h4>Footer </h4>
                                        <hr />
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Footer Widget 1 Title</label>
                                                <textarea type="text" id="footer_widget1_title" rows="5" name="footer_widget1_title" class="form-control"
                                                    placeholder="Footer Widget 1 Title">{{ stripslashes($settings->footer_widget1_title) }}</textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Footer Widget 1</label>
                                                <textarea type="text" id="footer_widget1" rows="5" name="footer_widget1" class="form-control"
                                                    placeholder="Footer Widget 1">{{ stripslashes($settings->footer_widget1) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Footer Widget 2 Title</label>
                                                <textarea type="text" id="footer_widget2_title" rows="5" name="footer_widget2_title" class="form-control"
                                                    placeholder="Footer Widget 2 Title">{{ stripslashes($settings->footer_widget2_title) }}</textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Footer Widget 2</label>
                                                <textarea type="text" id="footer_widget2" rows="5" name="footer_widget2" class="form-control"
                                                    placeholder="Footer Widget 2">{{ stripslashes($settings->footer_widget2) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Footer Widget 3 Title</label>
                                                <textarea type="text" id="footer_widget3_title" rows="5" name="footer_widget3_title" class="form-control"
                                                    placeholder="Footer Widget 3 Title">{{ stripslashes($settings->footer_widget3_title) }}</textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Footer Widget 3</label>
                                                <textarea type="text" id="footer_widget3" rows="5" name="footer_widget3" class="form-control"
                                                    placeholder="Footer Widget 3">{{ stripslashes($settings->footer_widget3) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Footer Widget 4 Title</label>
                                                <textarea type="text" id="footer_widget4_title" rows="5" name="footer_widget4_title" class="form-control"
                                                    placeholder="Footer Widget 4 Title">{{ stripslashes($settings->footer_widget4_title) }}</textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Footer Widget 4</label>
                                                <textarea type="text" id="footer_widget4" rows="5" name="footer_widget4" class="form-control" placeholder="Footer Widget 4">{{ stripslashes($settings->footer_widget4) }}
                                                </textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Get In Touch</label>
                                                <textarea type="text" id="get_in_touch_title" rows="5" name="get_in_touch_title"  class="form-control"placeholder="Get In Touch">{{ stripslashes($settings->get_in_touch_title) }}</textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Get in Touch Details</label>
                                                <textarea type="text" id="get_in_touch" rows="5" name="get_in_touch" class="form-control" placeholder="About Us | Contact Us | Faqs">{{ stripslashes($settings->get_in_touch) }}</textarea>
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Copyright Text</label>
                                                <textarea type="text" id="site_copyright" name="site_copyright" class="ckeditor"
                                                    placeholder="Copyright Text">{{ $settings->site_copyright }}</textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <h4>GDPR Cookie Consent</h4>
                                        <hr />
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>GDPR Consent Title</label>
                                                <textarea type="text" id="gdpr_cookie_title" rows="5" name="gdpr_cookie_title" class="form-control"
                                                    placeholder="GDPR Consent Title">{{ isset($settings->gdpr_cookie_title) ? stripslashes($settings->gdpr_cookie_title) : null }}</textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>GDPR Consent Text</label>
                                                <textarea type="text" id="gdpr_cookie_text" rows="5" name="gdpr_cookie_text" class="form-control"
                                                    placeholder="GDPR Consent Text">{{ isset($settings->gdpr_cookie_text) ? stripslashes($settings->gdpr_cookie_text) : null }}</textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>GDPR Consent URL</label>
                                                <textarea type="text" id="gdpr_cookie_url" rows="5" name="gdpr_cookie_url" class="form-control"
                                                    placeholder="GDPR Consent URL">{{ isset($settings->gdpr_cookie_url) ? stripslashes($settings->gdpr_cookie_url) : null }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>&nbsp;</label><br>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <div id="smtp_email" class="tab-pane fade">
                                    {!! Form::open(['url' => 'admin/smtp_email', 'class' => 'form-horizontal padding-15', 'name' => 'social_links_form', 'id' => 'social_links_form', 'role' => 'form']) !!}
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Host*</label>
                                            <input type="text" name="smtp_host" placeholder="Host" class="form-control"
                                                value="{{ isset($settings->smtp_host) ? $settings->smtp_host : null }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Port*</label>
                                            <input type="text" name="smtp_port" placeholder="Port" class="form-control"
                                                value="{{ isset($settings->smtp_port) ? $settings->smtp_port : null }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label>Email</label>
                                            <input type="text" name="smtp_email" placeholder="Email" class="form-control"
                                                value="{{ isset($settings->smtp_email) ? $settings->smtp_email : null }}">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Password</label>
                                            <input type="text" name="smtp_password" placeholder="Password"
                                                class="form-control"
                                                value="{{ isset($settings->smtp_password) ? $settings->smtp_password : null }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Encryption</label>
                                            <select class="form-control" name="smtp_encryption">

                                                <option value="TLS" @if ($settings->smtp_encryption == 'TLS') selected @endif>TLS
                                                </option>
                                                <option value="SSL" @if ($settings->smtp_encryption == 'SSL') selected @endif>SSL
                                                </option>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>&nbsp;</label><br>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>

                                    {!! Form::close() !!}

                                </div>
                                <div id="payment_info" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            {{-- <h4 class="text-primary">Account Setting</h4> --}}
                                            {!! Form::open(['url' => 'admin/payment_info', 'class' => 'form-horizontal padding-15', 'name' => 'social_links_form', 'id' => 'social_links_form', 'role' => 'form']) !!}
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Currency Code*</label>
                                                    <input type="email" name="currency_code"
                                                        value="{{ $settings->currency_code }}" placeholder="USD"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Tax Percentage</label>
                                                    <input type="number" step="0.01" min="0" max="100" placeholder="12.00%"
                                                        class="form-control" value="{{ $settings->tax_percentage }}">
                                                </div>
                                            </div>
                                            <br>
                                            <h4> Paypal Settings</h4>
                                            <hr />
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>Paypal Payment</label>
                                                    <select name="paypal_payment_on_off" id="basic" class="form-control"
                                                        data-live-search="true">

                                                        <option value="1" @if ($settings->paypal_payment_on_off == 1) selected @endif>
                                                            ON
                                                        </option>
                                                        <option value="0" @if ($settings->paypal_payment_on_off == 0) selected @endif>
                                                            OFF
                                                        </option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Payment Mode</label>
                                                    <select class="form-control" name="paypal_mode">
                                                        <option value="sandbox"
                                                            @if ($settings->paypal_mode == 'sandbox') selected @endif>Sandbox
                                                        </option>
                                                        <option value="live"
                                                            @if ($settings->paypal_mode == 'live') selected @endif>Live
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>Paypal Client ID</label>
                                                    <input type="text" name="paypal_client_id" placeholder="XXXXXXX"
                                                        class="form-control"
                                                        value="{{ isset($settings->paypal_client_id) ? $settings->paypal_client_id : null }}">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Paypal Secret Key</label>
                                                    <input type="text" name="paypal_secret" placeholder="XXXXXXX"
                                                        class="form-control"
                                                        value="{{ isset($settings->paypal_secret) ? $settings->paypal_secret : null }}">
                                                </div>
                                            </div>
                                            <br>
                                            <h4> Stripe Settings</h4>
                                            <hr />
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>Stripe Payment</label>
                                                    <select class="form-control" name="stripe_payment_on_off">

                                                        <option value="1"
                                                            @if ($settings->stripe_payment_on_off == '1') selected @endif>ON
                                                        </option>
                                                        <option value="0"
                                                            @if ($settings->stripe_payment_on_off == '0') selected @endif>OFF
                                                        </option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Stripe Secret Key</label>
                                                    <input type="text" name="stripe_secret_key" class="form-control"
                                                        placeholder="XXXXXXX"
                                                        value="{{ isset($settings->stripe_secret_key) ? $settings->stripe_secret_key : null }}">
                                                </div>
                                            </div>
                                            <br>
                                            <h4> Razorpay Settings</h4>
                                            <hr />
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>Razorpay Payment</label>
                                                    <select class="form-control" name="razorpay_payment_on_off">

                                                        <option value="1"
                                                            @if ($settings->razorpay_payment_on_off == '1') selected @endif>ON
                                                        </option>
                                                        <option value="0"
                                                            @if ($settings->razorpay_payment_on_off == '0') selected @endif>OFF
                                                        </option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Razorpay Key Id</label>
                                                    <input type="text" name="razorpay_key"
                                                        value="{{ isset($settings->razorpay_key) ? $settings->razorpay_key : null }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label>Razorpay Key Secret</label>
                                                    <input type="text" name="razorpay_secret"
                                                        value="{{ isset($settings->razorpay_secret) ? $settings->razorpay_secret : null }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <br>
                                            <h4> Paystack Settings</h4>
                                            <hr />
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>Paystack Payment</label>
                                                    <select class="form-control" name="paystack_payment_on_off">

                                                        <option value="1"
                                                            @if ($settings->paystack_payment_on_off == '1') selected @endif>ON</option>
                                                        <option value="0"
                                                            @if ($settings->paystack_payment_on_off == '0') selected @endif>OFF</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Paystack Secret Key</label>
                                                    <input type="text" name="paystack_secret_key"
                                                        value="{{ isset($settings->paystack_secret_key) ? $settings->paystack_secret_key : null }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <br>
                                            <hr />
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <label>Bank Payment Details</label>
                                                    <textarea type="text" name="bank_payment_details" class="ckeditor"
                                                        rows="5">{{ stripslashes($settings->bank_payment_details) }}</textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <hr>
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>Invoice Company</label>
                                                    <input type="text" name="invoice_company"
                                                        value="{{ isset($settings->invoice_company) ? $settings->invoice_company : null }}"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Invoice Address</label>
                                                    <input type="text" name="invoice_address" placeholder="Invoice Address"
                                                        class="form-control"
                                                        value="{{ isset($settings->invoice_address) ? $settings->invoice_address : null }}">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>

                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <div id="layout" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            {!! Form::open(['url' => 'admin/layout_settings', 'class' => 'form-horizontal padding-15', 'name' => 'social_links_form', 'id' => 'social_links_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                                            <div class="form-row">
                                                <div class="form-group col-md-10">
                                                    <label>Logo</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="title_bg" id="title_bg"
                                                                class="custom-file-input">
                                                            <label class="custom-file-label" for="title_bg">Upload</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <div class="media mr-2">
                                                        @if ($settings->title_bg)
                                                            <img src="{{ URL::asset('upload/' . $settings->title_bg) }}"
                                                                width="150" alt="person">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>Default Map Latitude</label>
                                                    <input type="text" name="map_latitude"
                                                        value="{{ $settings->map_latitude }}" class="form-control">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Default Map Longitude</label>
                                                    <input type="text" name="map_longitude"
                                                        value="{{ $settings->map_longitude }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Home Page</label>
                                                    <select name="home_properties_layout" id="basic"
                                                        class="selectpicker show-tick form-control"
                                                        data-live-search="true">
                                                        <option value="slider"
                                                            @if ($settings->home_properties_layout == 'slider') selected @endif>Slider
                                                        </option>
                                                        <option value="map"
                                                            @if ($settings->home_properties_layout == 'map') selected @endif>Map</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Properties Page</label>
                                                    <select name="all_properties_layout" id="basic"
                                                        class="selectpicker show-tick form-control"
                                                        data-live-search="true">
                                                        <option value="grid"
                                                            @if ($settings->all_properties_layout == 'grid') selected @endif>Property
                                                            Listing - Grid</option>
                                                        <option value="grid_side"
                                                            @if ($settings->all_properties_layout == 'grid_side') selected @endif>Property
                                                            Listing - Grid with Sidebar
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Featured Properties Page</label>
                                                    <select name="featured_properties_layout" id="basic"
                                                        class="selectpicker show-tick form-control"
                                                        data-live-search="true">
                                                        <option value="grid"
                                                            @if ($settings->featured_properties_layout == 'grid') selected @endif>Property
                                                            Listing - Grid</option>
                                                        <option value="grid_side"
                                                            @if ($settings->featured_properties_layout == 'grid_side') selected @endif>Property
                                                            Listing - Grid with Sidebar
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Sale Properties Page</label>
                                                    <select name="sale_properties_layout" id="basic"
                                                        class="selectpicker show-tick form-control"
                                                        data-live-search="true">
                                                        <option value="grid"
                                                            @if ($settings->sale_properties_layout == 'grid') selected @endif>Property
                                                            Listing - Grid</option>
                                                        <option value="grid_side"
                                                            @if ($settings->sale_properties_layout == 'grid_side') selected @endif>Property
                                                            Listing - Grid with Sidebar
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Rent Properties Page</label>
                                                    <select name="rent_properties_layout" id="basic"
                                                        class="selectpicker show-tick form-control"
                                                        data-live-search="true">
                                                        <option value="grid"
                                                            @if ($settings->rent_properties_layout == 'grid') selected @endif>Property
                                                            Listing - Grid</option>
                                                        <option value="grid_side"
                                                            @if ($settings->rent_properties_layout == 'grid_side') selected @endif>Property
                                                            Listing - Grid with Sidebar
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Pagination Limit</label>
                                                    <input type="number" name="pagination_limit"
                                                        value="{{ $settings->pagination_limit }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>&nbsp;</label><br>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <div id="social" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            {!! Form::open(['url' => 'admin/social_links', 'class' => 'form-horizontal padding-15', 'name' => 'social_links_form', 'id' => 'social_links_form', 'role' => 'form']) !!}
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Facebook URL</label>
                                                    <input type="text" name="social_facebook"
                                                        value="{{ $settings->social_facebook }}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Twitter URL</label>
                                                    <input type="text" name="social_twitter"
                                                        value="{{ $settings->social_twitter }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>LinkedIn URL</label>
                                                    <input type="text" name="social_linkedin"
                                                        value="{{ $settings->social_linkedin }}" class="form-control">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Pinterest URL</label>
                                                    <input type="text" name="social_pinterest"
                                                        value="{{ $settings->social_pinterest }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Instagram URL</label>
                                                    <input type="text" name="social_instagram"
                                                        value="{{ $settings->social_instagram }}" class="form-control"
                                                        value="">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>&nbsp;</label><br>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <div id="add_code" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            {!! Form::open(['url' => 'admin/addthisdisqus', 'class' => 'form-horizontal padding-15', 
                                            'name' => 'pass_form', 'id' => 'pass_form', 'role' => 'form']) !!}
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="" class="control-label">AddThis Code
                                                        <br><small class="text-muted bold">Get code <a href="https://www.addthis.com"
                                                                target="_blank">here!</a></small>
                                                    </label>
                                                    <textarea type="text" name="addthis_share_code" class="form-control"
                                                        rows="7">{{ $settings->addthis_share_code }}</textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="" class="control-label">Disqus Code
                                                        <br><small class="text-muted bold">Get code <a href="https://disqus.com"
                                                                target="_blank">here!</a></small>
                                                    </label>
                                                    <textarea type="text" name="disqus_comment_code" class="form-control"
                                                       rows="7">{{ $settings->disqus_comment_code }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>&nbsp;</label><br>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <div id="contact_us" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            {!! Form::open(['url' => 'admin/contact_us', 'class' => 'form-horizontal padding-15', 
                                            'name' => 'pass_form', 'id' => 'pass_form', 'role' => 'form']) !!}
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Contact Title</label>
                                                    <input type="text" name="contact_us_title" value="{{ $settings->contact_us_title }}"
                                                     class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Contact Email</label>
                                                    <input type="text" name="contact_us_email" value="{{ $settings->contact_us_email }}"
                                                     class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>Contact Phone</label>
                                                    <input type="text" name="contact_us_phone" value="{{ $settings->contact_us_phone }}"
                                                     class="form-control">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Contact Mobile</label>
                                                    <input type="text" name="contact_us_mobile" value="{{ $settings->contact_us_mobile }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <label>Contact Fax</label>
                                                    <input type="text" name="contact_us_fax" value="{{ $settings->contact_us_fax }}"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Address</label>
                                                    <input type="text" name="contact_us_address" value="{{ $settings->contact_us_address }}"
                                                     class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Map Latitude</label>
                                                    <input type="text" name="contact_lat" value="{{ $settings->contact_lat }}"
                                                     class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Map Longitude</label>
                                                    <input type="text" name="contact_long" value="{{ $settings->contact_long }}"
                                                     class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                <div id="other_settings" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            {!! Form::open(['url' => 'admin/headfootupdate', 'class' => 'form-horizontal padding-15', 
                                            'name' => 'pass_form', 'id' => 'pass_form', 'role' => 'form']) !!}
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Header Code</label>
                                                    <textarea type="text" name="site_header_code" class="form-control" rows="5"
                                                        placeholder="You may want to add some css/js code to header. ">{{ $settings->site_header_code }}</textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Footer Code</label>
                                                    <textarea type="text" name="site_footer_code" class="form-control" rows="5"
                                                       placeholder="You may want to add some css/js code to footer. ">{{ $settings->site_footer_code }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>&nbsp;</label><br>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
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
    </div>
@endsection
@section('scripts')
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
