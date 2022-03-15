{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permissions</h4>
                    <a href="{{ route('permissions.create') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                            <span class="btn-icon-left text-info">
                                <i class="fa fa-plus color-info"></i>
                            </span>
                            Add
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($permissions as $permission)
                                   <tr>
                                       <td>{{ $permission->id }}</td>
                                       <td>{{ $permission->name }}</td>
                                       <td>
                                        <a class="btn btn-info" href="{{ route('permissions.show',$permission->id) }}">Show</a>
                                        @can('permission-edit')
                                            <a class="btn btn-primary" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
                                        @endcan
                                        @can('permission-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
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
