{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Roles</h4>
                    @can('role-create')
                        <a href="{{ route('roles.create') }}">
                           <button type="button" class="btn btn-rounded btn-info">
                              <span class="btn-icon-left text-info">
                                 <i class="fa fa-plus color-info"></i>
                              </span>
                              Add
                           </button>
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($roles as $role)
                                   <tr>
                                       <td>{{ $role->id }}</td>
                                       <td>{{ $role->name }}</td>
                                       <td>
                                        <a class="btn rounded btn-xs action-btn btn-info" href="{{ route('roles.show',$role->id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('role-edit')
                                            <a class="btn rounded btn-xs action-btn btn-primary" href="{{ route('roles.edit',$role->id) }}"> <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('role-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                <button class="btn rounded btn-xs action-btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                   </tr>
                               @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        {{ $roles->render() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
