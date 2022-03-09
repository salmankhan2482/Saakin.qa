{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')



{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permissions</h4>
                <a href="{{route('permissions.create')}}">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $i => $menuOption)
                                <tr>
                                    <td>{{ $menuOption->id }}</td>
                                    <td>{{ $menuOption->title }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('permissions.edit', $menuOption->id) }}" 
                                                    class="btn btn-info rounded btn-xs action-btn">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                
                                                <a href="{{ route('permissions.destroy', $menuOption->id) }}" 
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
