{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')



{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Menu Options</h4>
                <a href="{{route('menuOptions.create')}}">
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
                                    <th>Parent</th>
                                    <th>Route</th>
                                    <th>Url</th>
                                    <th>Icon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menuOptions as $i => $menuOption)
                                    <tr>
                                        <td>{{ $menuOption->id }}</td>
                                        <td>{{ $menuOption->title }}</td>
                                        <td>{{ $menuOption->parent->title ?? '' }}</td>
                                        <td>{{ $menuOption->route }}</td>
                                        <td>{{ $menuOption->url }}</td>
                                        <td>{{ $menuOption->icon }}</td>
                                       
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('menuOptions.edit', $menuOption->id) }}" 
                                                    class="btn btn-info rounded btn-xs action-btn">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                
                                                <a href="{{ route('menuOptions.destroy', $menuOption->id) }}" 
                                                    class="btn btn-danger rounded btn-xs action-btn">
                                                    <i class="fa fa-trash"></i></a>
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
