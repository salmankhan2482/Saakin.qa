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
                <a href="{{ route('propertySubCities.index') }}">
                    <button type="button" class="btn btn-rounded btn-dark">Back</button>
                </a>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Sub-City</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => ['propertySubCities.update',$subCity->id], 'method' => 'PATCH', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Cities</label>
                                    <select id="city" name="city" class="form-control">
                                        <option selected>Select City</option>
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" {{ $subCity->property_cities_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Enter a Location" value="{{ $subCity->name }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Latitude</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control"
                                        placeholder="25.2773946" value="{{ $subCity->latitude }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Longitude</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control"
                                        placeholder="51.4985448" value="{{ $subCity->longitude }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
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
