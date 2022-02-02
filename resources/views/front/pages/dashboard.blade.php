@extends("front.layouts.main")

@section("content")

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

        .properties_min {
            padding: 20px 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
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

        .member-card-content { text-align:center; position:relative; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);}
        .member-card-content .hex { margin-top:-17px; position:absolute; margin-left:-45px; }
        .member-card-content ul { position:relative; z-index:10; }
        .member-card-content ul li.active a { border-right:2px solid #50AEE6; color:#50AEE6; font-weight:700; }
        .member-card-content ul li a { text-align:left; border-bottom:1px solid rgba(0, 0, 0, 0.1); padding:16px 20px 13px 20px; display:block; color:#3a464e; }
        .member-card-content ul li a:hover { background:#deebf2; }
        .member-card-content ul li .icon { margin-right:7px; }

    </style>

    <div class="breadcrumb-section page-title bg-h"
         style="background-image: url('{{asset('assets/images/backgrounds/bg-4.jpg')}}')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto text-center">
                    <div class="breadcrumb-menu">
                        <h2>{{trans('words.dashboard_text')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Breadcrumb Section-->

    <!--Breadcrumb Section-->
    <div class="container">
        <div class="min_profile">
            <div class="row">
                @include("_particles.sidebar_user")

                <div class="col-lg-9 col-md-9">

                    <h3 align="left">{{trans('words.welcome_back')}}, {{Auth::user()->name}}</h3>
                    <div class="clearfix"></div>
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('error') }}
                            {{Session::flash('error',Session::get('error'))}}
                        </div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('success') }}
                            {{Session::flash('success',Session::get('success'))}}
                        </div>
                    @endif
                    @if(Session::has('error_flash_message'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('error_flash_message') }}
                            {{Session::flash('error_flash_message',Session::get('error_flash_message'))}}
                        </div>
                    @endif
                    <div class="contact-info clearfix">

                        <div class="contact-info-box col-md-6 col-lg-4">
                            <a href="{{ URL::to('my_properties') }}">
                                <div class="inner-container">
                                    <i class="fa fa-home icon"></i>
                                    <div class="value" style="font-size: 48px;">{{$properties_count}}
                                        <div class="clearfix"></div>
                                        <div class="text" style="font-size: 20px; margin-top: 10px;">{{trans('words.properties')}}</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="contact-info-box col-md-6 col-lg-4">
                            <a href="{{ URL::to('my_properties') }}">
                                <div class="inner-container">
                                    <i class="fa fa-clock-o icon"></i>
                                    <div class="value" style="font-size: 48px;">{{$pending_properties_count}}
                                        <div class="clearfix"></div>
                                        <div class="text" style="font-size: 20px; margin-top: 10px;">{{trans('words.pending')}}</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="contact-info-box col-md-6 col-lg-4">
                            <a href="{{ URL::to('inquiries') }}">
                                <div class="inner-container">
                                    <i class="fa fa-envelope"></i>
                                    <div class="value" style="font-size: 48px;">{{$inquiries}}
                                        <div class="clearfix"></div>
                                        <div class="text" style="font-size: 20px; margin-top: 10px;">{{trans('words.inquiries')}}</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                    @if(Auth::User()->usertype!='Agents')
                        @if(getcong('bank_payment_details'))
                            <div class="contact-info clearfix" style="border: 1px solid rgba(0, 0, 0, 0.1);padding: 15px;background-color: #fafafa;">
                                {!! stripslashes(getcong('bank_payment_details'))!!}
                            </div>
                        @endif
                    @endif

                </div><!-- end col -->
            </div>
        </div>

    </div>


@endsection
