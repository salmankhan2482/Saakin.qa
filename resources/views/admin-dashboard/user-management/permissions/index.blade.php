{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Search Permission</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('permissions.index') }}" method="GET">
                            <div class="row">
                                <div class="col-sm-4 offset-sm-2">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search">
                                </div>
                                <div class="col-sm-1 mt-2">
                                    <button type="submit" class="btn btn-dark btn-sm">
                                        {{ trans('words.search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($data['permissions'] as $permission)
                                   <tr>
                                       <td>{{ $permission->id }}</td>
                                       <td>{{ $permission->name }}</td>
                                       <td>
                                        <a class="btn btn-success rounded btn-xs action-btn" href="{{ route('permissions.show',$permission->id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('permission-edit')
                                            <a class="btn btn-primary rounded btn-xs action-btn" href="{{ route('permissions.edit',$permission->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('permission-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                                <button class="btn btn-danger rounded btn-xs action-btn">
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
                                        {{ $data['permissions']->render() }}
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
