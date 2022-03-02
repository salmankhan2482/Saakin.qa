{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')



{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Roles</h4>
                <a href="{{route('roles.create')}}"
                    <button type="button" class="btn btn-rounded btn-info"><span
                        class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                    </span>Add</button>
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
                                    @foreach($role->rolepermissions as $item)
                                        <span class="badge badge-rounded badge-success">
                                            {{ $item->title }}
                                        </span>    
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($role->menuoptions as $item)
                                        <span class="badge badge-rounded badge-primary">
                                            {{ $item->title }}
                                        </span>
                                    @endforeach
                                </td>
                                        {{-- <tr>
                            <td><img class="rounded-circle" width="35"  src="{{ asset('images/profile/small/pic1.jpg') }}" alt=""></td>
                            <td>Tiger Nixon</td>
                            <td>Architect</td>
                            <td>Male</td>
                            <td>M.COM., P.H.D.</td>
                            <td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
                            <td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
                            <td>2011/04/25</td> --}}
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
                                                <a href="{{ route('roles.destroy', $role->id) }}" class="btn btn-danger shadow btn-xs sharp"><i
                                                        class="fa fa-trash"></i></a>
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
