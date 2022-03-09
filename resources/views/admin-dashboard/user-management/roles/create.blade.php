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
                <a href="{{ route('roles.index') }}">
                    <button type="button" class="btn btn-rounded btn-dark">Back</button>
                </a>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Role</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => 'roles.store', 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Title</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                        placeholder="Enter Role Title" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Menu Options*</label>
                                    <select name="menu_options[]" class="js-example-programmatic-multi" multiple="multiple">
                                        @foreach ($menuOptions as $id => $menuOption)
                                            <option value="{{ $menuOption->id }}">
                                                {{ $menuOption->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Permissions*</label>
                                    <select name="permissions[]" class="js-example-programmatic-multi" multiple="multiple"
                                        required>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}">
                                                {{ $permission->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
