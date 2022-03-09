@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">

            <div class="pull-right">
                <a href="{{ URL::to('admin/properties/create') }}"
                    class="btn btn-primary">{{ trans('words.add_property') }}
                    <i class="fa fa-plus"></i></a>
            </div>
            <h2>{{ trans('words.properties') }}</h2>
        </div>
        @if (Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="panel panel-shadow">
            <div class="panel-body">
                <div class="col-sm-10">
                    {!! Form::open(['url' => 'admin/properties', 'class' => 'form-inline filter', 'id' => 'search', 'role' => 'form', 'method' => 'get']) !!}
                    <span class="bold text-muted">{{ trans('words.search') }}</span>
                    <div class="form-group">
                        <input type="text" class="form-control" id="" name="keyword"
                            placeholder="{{ trans('words.search_placeholder') }}">
                    </div>
                    <div class="form-group">
                        <select name="purpose" id="basic" class="selectpicker show-tick form-control"
                            data-live-search="false">
                            <option value="">{{ trans('words.property_purpose') }}</option>
                            <option value="{{ trans('words.purpose_sale') }}">{{ trans('words.for_sale') }}</option>
                            <option value="{{ trans('words.purpose_rent') }}">{{ trans('words.for_rent') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="status" id="basic" class="selectpicker show-tick form-control"
                            data-live-search="false">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="proeprty-type" name="type" class="selectpicker show-tick form-control"
                            data-live-search="false">
                            <option value="">{{ trans('words.property_type') }}</option>
                            @if (count($propertyTypes) > 0)
                                @foreach ($propertyTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->types }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit"
                            class="btn btn-default-dark  pull-right">{{ trans('words.search') }}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-sm-2">
                    <a href="{{ URL::to('admin/properties/export') }}"
                        class="btn btn-info btn-md waves-effect waves-light" data-toggle="tooltip"
                        title="{{ trans('words.export_property') }}"><i class="fa fa-file-excel-o"></i>
                        {{ trans('words.export_property') }}</a>
                </div>
            </div>
        </div>

        <div class="panel panel-default panel-shadow" id="testing_div">
            @include('admin.pages.include.data_tables')
        </div>
        

    </div>

@endsection
