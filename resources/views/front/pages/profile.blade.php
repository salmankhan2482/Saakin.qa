@extends("front.layouts.main")

@section('content')
    <!--Breadcrumb Section-->
    <style>
        .contact-info .contact-info-box .inner-container i {
            width: 120px;
            height: 120px;
            position: absolute;
            left: -60px;
            top: 50%;
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            color: #50AEE6;
            text-align: center;
            line-height: 115px;
            font-size: 2.5em;
            background-color: #ededed;
            border: 2px solid #FFFFFF;
            -webkit-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
            -webkit-box-shadow: 0 0 0 1px #ededed;
            box-shadow: 0 0 0 1px #ededed;
        }

        .contact-info .contact-info-box .inner-container {
            position: relative;
            padding: 20px 40px 20px 90px;
            text-align: center;
            background-color: #fafafa;
            min-height: 80px;
            display: table;
            width: 100%;
        }

        .contact-info .contact-info-box .inner-container .value {
            display: table-cell;
            vertical-align: middle;
            font-family: "Scada", Arial, Helvetica, sans-serif;
        }

        .contact-info .contact-info-box {
            padding-left: 60px;
            padding-right: 30px;
            margin-bottom: 30px;
            float: left;
        }

        .contact-info {
            margin: 30px 0 70px;
        }

        .min_profile {
            padding: 30px 0px;
        }

        .sidebar-left {
            padding-left: 0px;
            padding-right: 40px;
        }

        .sidebar-left .widget.member-card {
            padding-bottom: 45px;
        }

        .sidebar-left .widget.member-card {
            padding-bottom: 45px;
        }

        .member-card {
            background: white;
        }

        .member-card-header {
            color: white;
            background: #50AEE6;
            padding: 0px 20px 20px 20px;
            text-align: center;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        }

        .member-card-header h3 {
            margin-top: 0px;
        }

        .member-card-header h3 {
            font-size: 20px;
            color: white;
        }

        .member-card-avatar {
            display: inline-block;
            border-radius: 0px;
            overflow: hidden;
            border: 5px solid rgba(255, 255, 255, 0.4);
            width: 90px;
            height: 90px;
            margin-top: -30px;
            margin-bottom: 10px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.16);
            transition: all 0.4s;
        }

        .member-card-content {
            text-align: center;
            position: relative;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        }

        .member-card-content .hex {
            margin-top: -17px;
            position: absolute;
            margin-left: -45px;
        }

        .member-card-content ul {
            position: relative;
            z-index: 10;
        }

        .member-card-content ul li.active a {
            border-right: 2px solid #50AEE6;
            color: #50AEE6;
            font-weight: 700;
        }

        .member-card-content ul li a {
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 16px 20px 13px 20px;
            display: block;
            color: #3a464e;
        }

        .member-card-content ul li a:hover {
            background: #deebf2;
        }

        .member-card-content ul li .icon {
            margin-right: 7px;
        }

    </style>

    <style>
        .properties_min {
            padding: 20px 10px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        .table-responsive {
            overflow-x: auto;
            min-height: 0.01%;
        }

        .my-properties-list th {
            font-size: 13px;
            text-align: left;
            padding-left: 15px;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        th {
            text-align: left;
        }

        td,
        th {
            padding: 0;
        }

        th {
            display: table-cell;
            vertical-align: inherit;
            font-weight: bold;
            text-align: -internal-center;
        }


        table.my-properties-list {
            width: 100%;
        }

        .my-properties-list tr:first-child {
            height: 50px;
        }

        .my-properties-list tr {
            height: 140px;
            border: none;
            border-bottom: 1px solid #cbdfea;
        }

        .form_min {
            padding: 20px 10px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 9px;
            margin-bottom: 20px;
            border-radius: 0px;
            border: none;
            font-weight: 300;
            font-family: "Scada", Arial, Helvetica, sans-serif;
            background: white;
        }

        input,
        button,
        select,
        textarea {
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        input {
            line-height: normal;
        }

        .row {
            margin-left: -15px;
            margin-right: -15px;
        }

        .form-block label {
            display: block;
            font-family: "Scada", Arial, Helvetica, sans-serif;
        }

        .form-block label {
            display: block;
        }

        label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .edit-avatar {
            text-align: center;
        }

        .profile-avatar {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        }

        img {
            vertical-align: middle;
        }

        img {
            border: 0;
        }

        .form-block button {
            padding: 0 15px 0 50px;
            line-height: 2.8em;
            position: relative;
            background: #50AEE6;
            color: #FFFFFF;
            border: 0;
            border-radius: 3px 3px 0px 0px;
        }

        .button-icon {
            position: relative;
            padding-left: 56px;
            padding-right: 25px;
        }

        .button,
        input[type="submit"] {
            font-size: 15px;
            font-weight: 600;
            padding: 10px 35px 10px 35px;
            color: white;
            border-radius: 0px;
            border: none;
            /* background-color: #48a0dc; */
            display: inline-block;
            width: auto;
            cursor: pointer;
            transition: all 0.2s linear;
        }

        .button-icon .fa {
            background: rgba(0, 0, 0, 0.1);
            position: absolute;
            left: 0;
            top: 0;
            border-radius: 2px;
            height: 100%;
            width: 38px;
            text-align: center;
            padding-top: 13px;
            font-size: 13px;
        }

    </style>

    <div class="breadcrumb-section page-title bg-h"
        style="background-image: url('{{ asset('assets/images/backgrounds/bg-4.jpg') }}')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto text-center">
                    <div class="breadcrumb-menu">
                        <h2>{{ trans('words.profile') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="container">
        <div class="min_profile">
            <div class="row">
                @include("_particles.sidebar_user")

                <div class="col-lg-9 col-md-9 min_form">
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
                    <div class="form_min">
                        {!! Form::open(['url' => 'profile', 'class' => '', 'name' => 'profile_form', 'id' => 'profile_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="edit-avatar">

                                    @if (Auth::user()->image_icon)

                                        <img src="{{ URL::asset('upload/members/' . Auth::user()->image_icon . '-b.jpg') }}"
                                            alt="Profile Image" class="profile-avatar">

                                    @else
                                        <img src="{{ URL::asset('site_assets/img/agent-img3.jpg') }}"
                                            alt="Default Agent Pic" class="profile-avatar">
                                    @endif
                                    <input type="file" name="user_icon" class="">

                                </div>
                            </div>
                            <div class="col-lg-9">

                                <div class="form-block">
                                    <label>{{ trans('words.name') }}</label>
                                    <input class="border" type="text" name="name" value="{{ Auth::user()->name }}"
                                        required>
                                </div>
                                <div class="form-block">
                                    <label>{{ trans('words.email') }}</label>
                                    <input class="border" type="text" name="email"
                                        value="{{ Auth::user()->email }}" required>
                                </div>
                                <div class="form-block">
                                    <label>{{ trans('words.phone') }}</label>
                                    <input class="border" type="text" name="phone"
                                        value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                        </div><!-- end row -->

                        <div class="form-block">
                            <label>{{ trans('words.about') }}</label>
                            <textarea class="border" name="about">{{ Auth::user()->about }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 soi_t">
                                <h4>{{ trans('words.social_profiles') }}</h4>
                                <div class="divider"></div>
                                <div class="form-block">
                                    <label>Facebook</label>
                                    <input class="border" type="text" name="facebook"
                                        value="{{ Auth::user()->facebook }}">
                                </div>

                                <div class="form-block">
                                    <label>Twitter</label>
                                    <input class="border" type="text" name="twitter"
                                        value="{{ Auth::user()->twitter }}">
                                </div>


                            </div>
                            <div class="col-lg-6 soi_t">
                                <h4>&nbsp;</h4>
                                <div class="divider"></div>
                                <div class="form-block">
                                    <label>Instagram</label>
                                    <input class="border" type="text" name="instagram"
                                        value="{{ Auth::user()->instagram }}">
                                </div>
                                <div class="form-block">
                                    <label>Linkedin</label>
                                    <input class="border" type="text" name="linkedin"
                                        value="{{ Auth::user()->linkedin }}">
                                </div>
                            </div>
                        </div><!-- end row -->

                        <div class="form-block">
                            <button type="submit" class="button button-icon"><i
                                    class="fa fa-check"></i>{{ trans('words.save_changes') }}</button>
                        </div>

                        {!! Form::close() !!}

                    </div>

                </div><!-- end col -->
            </div>
        </div>

    </div>
    <!-- end:content -->

@endsection
