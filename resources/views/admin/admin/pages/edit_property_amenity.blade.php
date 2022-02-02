@extends("admin.admin_app")

@section('content')

    <div id="main">
        <div class="page-header">
            <h2> {{ trans('words.edit') . ' ' . trans('words.property_amenity') }}</h2>
            <a href="{{ URL::to('admin/property-amenity') }}" class="btn btn-default-light btn-xs"><i
                    class="md md-backspace"></i> {{ trans('words.back') }}</a>
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

        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['url' => ['admin/property-amenity/update/' . $propertyAmenity->id], 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" value="{{ $propertyAmenity->name }}"
                            class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.status') }}</label>
                    <div class="col-sm-9">
                        <select name="status" id="status" class="form-control">
                            <option value="" selected>Select Status</option>
                            <option value="Pending" @if ($propertyAmenity->status == 'Pending') {{ 'selected' }} @endif>Pending</option>
                            <option value="Confirmed" @if ($propertyAmenity->status == 'Confirmed') {{ 'selected' }} @endif>Confirmed</option>
                            <option value="Cancelled" @if ($propertyAmenity->status == 'Cancelled') {{ 'selected' }} @endif>Cancelled</option>
                        </select>
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
