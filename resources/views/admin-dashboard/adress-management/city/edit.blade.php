@extends('admin-dashboard.layouts.master')
@section('content')

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
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <a href="{{ route('propertyCities.index') }}">
                    <button type="button" class="btn btn-rounded btn-dark">Back</button>
                </a>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit City</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => ['propertyCities.update', $propertyCity->id] , 'method' => 'PATCH', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-row">
                                <div class="form-group col-md-11">
                                    <label>City Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="City Name" value="{{$propertyCity->name}}">
                                </div>
                                <div class="form-group col-md-1">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
