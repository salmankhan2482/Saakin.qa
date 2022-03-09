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
        <button type="button" class="btn btn-dark mb-2  mr-2" data-dismiss="alert" id="toastr-success-top-full-width"><span
                aria-hidden="true">&times;</span></button>

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
                        <h4 class="card-title">Edit Role</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => ['roles.update', $role->id], 'method' => 'PATCH', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Title</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                        value="{{ $role->title }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Menu Options*</label>
                                    <select class="multi-select" name="menu_options[]" multiple="multiple">
                                        @foreach ($menuOptions as $menuOption)
                                            <option value="{{ $menuOption->id }}"
                                                {{ $role->menuoptions->contains($menuOption->id) ? 'selected' : '' }}>
                                                {{ $menuOption->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Permissions*</label>
                                    <select class="multi-select" name="permissions[]" multiple="multiple">
                                        @foreach($permissions as $permission)
                                <option value="{{$permission->id}}"
                                    {{ $role->rolepermissions->contains($permission->id) ? 'selected' : '' }}>
                                    {{$permission->title}}
                                </option>
                            @endforeach
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>&nbsp;</label><br>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
