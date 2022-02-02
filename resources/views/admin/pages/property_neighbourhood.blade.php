@extends("admin.admin_app")

@section('content')
    <div id="main">

        <div class="page-header">
            <h2>@if (isset($neighbourhood_id)) Edit @else Add @endif Neighbourhood</h2>
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
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        @if (isset($neighbourhood_id))
            <div class="panel-body">
                <div class="col-md-6">
                    {!! Form::open(['url' => ['admin/properties/neighbourhood/' . $property_id . '/edit/' . $neighbourhood_id], 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Category</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" name="category_name" id="category_name"
                                value="{{ $property_neighbourhood->category_name }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Title</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" name="title" id="title" value="{{ $property_neighbourhood->title }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Distance</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" name="distance" id="distance" value="{{ $property_neighbourhood->distance }}"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                            <button type="submit" class="btn btn-primary">{{ trans('words.submit') }}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        @else
            <div class="panel-body">
                <div class="col-md-6">
                    {!! Form::open(['url' => ['admin/properties/neighbourhood/' . $property_id . '/create'], 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Category</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" name="category_name" id="category_name" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Title</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" name="title" id="title" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label>Distance</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" name="distance" id="distance" value="" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            <label></label>
                        </div>
                        <div class="col-sm-9 ">
                            <button type="submit" class="btn btn-primary">{{ trans('words.submit') }}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        @endif








        <h2>{{ $property_name }} Neighbourhoods</h2>

        <div class="panel panel-default panel-shadow">
            <div class="panel-body">

                <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Distance</th>
                            <th class="text-center width-100">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($neighbourhoods as $i => $neighbourhood)
                            <tr>
                                <td>{{ $neighbourhood->category_name }}</td>
                                <td>{{ $neighbourhood->title }}</td>
                                <td>{{ $neighbourhood->distance }}</td>
                                <td class="text-center">
                                    <a href="{{ url('admin/properties/neighbourhood/' . $neighbourhood->property_id . '/edit/' . $neighbourhood->id) }}"
                                        class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5"
                                        data-toggle="tooltip" title="{{ trans('words.edit') }}"> <i
                                            class="fa fa-edit"></i> </a>
                                    <a href="{{ url('admin/properties/neighbourhood/' . $neighbourhood->property_id . '/delete/' . $neighbourhood->id) }}"
                                        class="btn btn-icon waves-effect waves-light btn-danger m-b-5"
                                        onclick="return confirm('{{ trans('words.dlt_warning_text') }}')"
                                        data-toggle="tooltip" title="{{ trans('words.remove') }}"> <i
                                            class="fa fa-remove"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>

@endsection
