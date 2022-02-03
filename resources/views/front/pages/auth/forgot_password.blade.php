@extends("front.layouts.main")
@section('title', 'Forgot Password | saakin.qa' )
@section('description','Forgot Password')
@section('type','saakin-forgot-password')
@section('url', Request::url())
@section('head_title', trans('words.forgot_password').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
    <div class="breadcrumb-section page-title bg-h"
         style="background-image: url('{{asset('assets/images/backgrounds/bg-4.jpg')}}')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto text-center">
                    <div class="breadcrumb-menu">
                        <h1>Forget Password</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <section class="property-listing boxed-view clearfix">
     <div class="container">
         <div class="user-login-section">
       <div id="login-form" class="login-form">
        <h2 class="hsq-heading type-1">{{trans('words.forgot_password')}}</h2>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    </button>
                        {{ Session::get('flash_message') }}
                    </div>
            @endif
           <div class="row">
               <div class="col-md-6">
                   {!! Form::open(array('route' => 'password.email.post','class'=>'search-form','id'=>'loginform','role'=>'form')) !!}
                      <div class="form-group">
                          <input type="email" class="form-control" placeholder="{{trans('words.email')}}" name="email" id="email" /><!-- Email Field -->
                      </div>

                      <div class="search-button-container button-box">
                      <button class="btn">{{trans('words.send')}}</button>
                      <br/>&nbsp;

                      <div class="search-fields" style="font-size: 15px;">
                            {{trans('words.remember_password')}} <a href="{{ url('login') }}">{{trans('words.login_here')}}</a></p>
                      </div>

                    </div>

                  {!! Form::close() !!}
               </div>
               <div class="col-md-6">
                   <div class="signup-wrapper">
                       <img src="{{asset('assets/images/login-1.png')}}" alt="Logi-1 pic">
                       <p>{{trans('words.forgot_password')}}</p>
                   </div>
               </div>
           </div>
      </div>
         </div>

    </div>

  </section>


@endsection
