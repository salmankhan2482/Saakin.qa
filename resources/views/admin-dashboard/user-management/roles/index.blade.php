{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')



{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Roles</h4>
                    <a href="{{ route('roles.create') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                            <span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i> </span>
                            Add
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Permissions</th>
                                    <th>Menu Options</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $i => $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->title }}</td>
                                        <td>
                                            @foreach ($role->rolepermissions as $item)
                                                <span class="badge badge-rounded badge-success mb-1">
                                                    {{ $item->title }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($role->menuoptions as $item)
                                                <span class="badge badge-rounded badge-primary mb-1">
                                                    {{ $item->title }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('roles.edit', $role->id) }}"
                                                    class="btn btn-info rounded btn-xs action-btn">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                
                                                <a href="{{ route('roles.destroy', $role->id) }}"
                                                    class="btn btn-danger rounded btn-xs action-btn">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
