<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ getcong('site_name') }} {{ trans('words.admin') }}</title>
    <link href="{{ URL::asset('upload/' . getcong('site_favicon')) }}" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="{{ URL::asset('admin_assets/css/style.css') }}">
    <script src="{{ URL::asset('admin_assets/js/jquery.js') }}"></script>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>
        .container-fluid {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
        }

        .login .logo {
            margin: 30px;
        }

    </style>
</head>

<body style="background-image: url('{{ asset('upload') . '/title_bg.jpg' }}');background-size:cover ">
    <div class="container-fluid">

        <div id="main">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login" style="width: 79%">

                        <div class="logo" href="#"  style="height: 90px;">
                            <a href="{{ URL::to('/') }}">
                                <img src="{{ URL::asset('upload/logo.png') }}" alt="logo" style="width: 95%;">
                            </a>
                        </div>
                        <div class="panel panel-default panel-shadow">
                           
                            {!! Form::open(['url' => 'admin/login', 'class' => '', 'id' => 'loginform', 'role' => 'form']) !!}
                            <div class="panel-body">

                                <div class="message">
                                    <!--{!! Html::ul($errors->all(), ['class' => 'alert alert-danger errors']) !!}-->
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label for="email">{{ trans('words.email') }}</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Enter email">
                                </div>
                                <div class="form-group margin-none">
                                    <div class="media">
                                        <div class="media-body media-middle">
                                            <label for="password">{{ trans('words.password') }}</label>
                                        </div>
                                        <div class="media-right media-middle">
                                            <a href="{{ route('password.email') }}" class="small pull-right">
                                                {{ trans('words.forgot') }}
                                            </a>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group checkbox">
                                    <input type="checkbox" name="remember" id="checkbox1" />
                                    <label for="checkbox1">{{ trans('words.remember_me') }}</label>

                                </div>

                                @if (getcong('recaptcha') == 1)
                                    <div class="form-group">

                                        {!! NoCaptcha::display() !!}

                                    </div>
                                @endif

                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">{{ trans('words.sign_in') }} <i
                                        class="md md-lock-open"></i></button>
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Plugins -->
    <script src="{{ URL::asset('admin_assets/js/plugins.js') }}"></script>

    <!-- App Scripts -->
    <script src="{{ URL::asset('admin_assets/js/scripts.js') }}"></script>

</body>

</html>
