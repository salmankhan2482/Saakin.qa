@extends("admin.admin_app")

@section('content')

    <div id="main">
        <div class="page-header">
            <h2> 
                Add City
            </h2>
            <a href="{{ route('propertyCities.index') }}" class="btn btn-default-light btn-xs">
                <i class="md md-backspace"></i> 
                {{ trans('words.back') }}
            </a>
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
        @if ($message = Session::get('message'))
        <div class="alert alert-info alert-block d-flex" >
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['route' => ['propertyCities.store'], 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" value="" class="form-control">
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{ trans('words.submit') }}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>


    </div>

@endsection
