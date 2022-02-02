@extends("admin.admin_app")

@section('content')

    <div id="main">
        <div class="page-header">
            <h2> {{ Auth::user()->name }}</h2>
            <a href="{{ URL::to('admin/dashboard') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i>
                {{ trans('words.back') }}</a>

        </div>
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
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#account" aria-controls="account" role="tab" data-toggle="tab">{{ trans('words.account') }}</a>
                </li>
                <li role="presentation">
                    <a href="#ac_password" aria-controls="ac_password" role="tab"
                        data-toggle="tab">{{ trans('words.password') }}</a>
                </li>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content tab-content-default">
                <div role="tabpanel" class="tab-pane active" id="account">
                    {!! Form::open([
                        'url' => 'admin/profile', 'class' => 'form-horizontal padding-15',  'name' => 'account_form','id' => 'account_form',  'role' => 'form', 'enctype' => 'multipart/form-data', ]) !!}

                    <div class="form-group">
                        <label for="avatar" class="col-sm-3 control-label">{{ trans('words.profile_picture') }}</label>
                        <div class="col-sm-9">
                            @if (Auth::User()->usertype == 'Agency')
                                <div class="media">
                                    <div class="media-left">
                                        @if ($agency->image)

                                            <img src="{{ URL::asset('upload/agencies/' . $agency->image) }}" width="200"
                                                alt="person">
                                        @endif

                                    </div>
                                    <div class="media-body media-middle">
                                        <input type="file" name="user_icon" class="filestyle">
                                    </div>
                                </div>
                            @else
                                <div class="media">
                                    <div class="media-left">
                                        @if (Auth::user()->image_icon)

                                            <img src="{{ URL::asset('upload/members/' . Auth::user()->image_icon . '-s.jpg') }}"
                                                width="80" alt="person">
                                        @endif

                                    </div>
                                    <div class="media-body media-middle">
                                        <input type="file" name="user_icon" class="filestyle">
                                        <small class="text-muted bold">Size 80x80px</small>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ trans('words.name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control"
                                value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ trans('words.email') }}</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="oldemail" value="{{ Auth::user()->email }}">
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control"
                                value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ trans('words.phone') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control"
                                value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Whatsapp</label>
                        <div class="col-sm-9">
                            <input type="text" name="whatsapp" value="{{ Auth::user()->whatsapp }}"
                                class="form-control" value="">
                        </div>
                    </div>

                    @if (Auth::User()->usertype == 'Agency')
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">{{ trans('words.about') }}</label>
                            <div class="col-sm-9">

                                <textarea name="about" cols="50" rows="5" class="form-control"
                                    required>{{ $agency->agency_detail }}</textarea>
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">{{ trans('words.about') }}</label>
                            <div class="col-sm-9">

                                <textarea name="about" cols="50" rows="5"
                                    class="form-control">{{ Auth::user()->about }}</textarea>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Facebook</label>
                        <div class="col-sm-9">
                            <input type="text" name="facebook" value="{{ Auth::user()->facebook }}"
                                class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Twitter</label>
                        <div class="col-sm-9">
                            <input type="text" name="twitter" value="{{ Auth::user()->twitter }}" class="form-control"
                                value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Instagram</label>
                        <div class="col-sm-9">
                            <input type="text" name="instagram" value="{{ Auth::user()->instagram }}"
                                class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Linkedin</label>
                        <div class="col-sm-9">
                            <input type="text" name="linkedin" value="{{ Auth::user()->linkedin }}"
                                class="form-control" value="">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                            <button type="submit" class="btn btn-primary">{{ trans('words.save_changes') }} <i
                                    class="md md-lock-open"></i></button>

                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
                <div role="tabpanel" class="tab-pane" id="ac_password">

                    {!! Form::open([
    'url' => 'admin/profile_pass',
    'class' => 'form-horizontal
                padding-15',
    'name' => 'pass_form',
    'id' => 'pass_form',
    'role' => 'form',
]) !!}

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ trans('words.new_password') }}</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" value="" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ trans('words.confirm_password') }}</label>
                        <div class="col-sm-9">
                            <input type="password" name="password_confirmation" value="" class="form-control" value="">
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                            <button type="submit" class="btn btn-primary">{{ trans('words.save_changes') }} <i
                                    class="md md-lock-open"></i></button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

@endsection
