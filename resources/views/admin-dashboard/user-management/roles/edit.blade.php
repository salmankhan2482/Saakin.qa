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
                <a href="{{ route('permissions.index') }}">
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
                            {!! Form::open(['route' => ['roles.update', $data['role']->id], 'method' => 'PUT', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Title</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ $data['role']->title }}">
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label>
                                        Menu Options*
                                        <span class="btn btn-outline-info btn-rounded btn-xs select-all">Select all</span>
                                        <span class="btn btn-outline-info btn-rounded btn-xs deselect-all">Deselect all</span>
                                    </label>
                                    <select name="menu_options[]" class="select2 js-example-programmatic-multi" multiple="multiple">
                                        @foreach ($data['menuOptions'] as $menuOption)
                                            <option value="{{ $menuOption->id }}"
                                                {{ $data['role']->menuoptions->contains($menuOption->id) ? 'selected' : ''  }}
                                                >
                                                {{ $menuOption->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div class="form-group col-md-12">
                                    <label class="col-md-12">
                                        Permissions*
                                        <span class="btn btn-outline-info btn-rounded btn-xs select-all">Select all</span>
                                        <span class="btn btn-outline-info btn-rounded btn-xs deselect-all">Deselect all</span>
                                    </label>
                                    <select name="permissions[]" class="select2 js-example-programmatic-multi col-12" multiple="multiple">
                                        @foreach ($data['permissions'] as $permission)
                                            <option value="{{ $permission->id }}" 
                                                {{ $data['role']->rolepermissions->contains($permission->id) ? 'selected' : '' }}
                                                >
                                                {{ $permission->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function(){
    
            $('.select-all').click(function () {
                let $select2 = $(this).parent().siblings().find('.select2')
                console.log($select2);
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change')
            })
    
            $('.deselect-all').click(function () {
                let $select2 = $(this).parent().siblings().find('.select2')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change')
            })
        })
    
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    @endsection
    
