@extends("admin.admin_app")

@section('content')

    <div id="main">
        <div class="page-header">
            <h2> 
                Add Sub City
            </h2>
            <a href="{{ route('propertySubCities.index') }}" class="btn btn-default-light btn-xs">
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
        @if (Session::has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ Session::get('message') }}
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['route' => ['propertySubCities.store'], 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">
                        City
                    </label>
                    <div class="col-sm-9">
                        <select name="city" id="city" class="form-control">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" value="" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Latitude</label>
                    <div class="col-sm-9">
                        <input type="text" name="latitude" id="latitude" placeholder="25.2773946" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Longitude</label>
                    <div class="col-sm-9">
                        <input type="text" name="longitude" id="longitude" placeholder="51.4985448" class="form-control">
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
