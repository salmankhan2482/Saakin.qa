{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Areas</h4>
                    @can ('properties-area-create')
                     <a href="{{ route('propertyAreas.create') }}">
                           <button type="button" class="btn btn-rounded btn-info">
                              <span class="btn-icon-left  text-info">
                                 <i class="fa fa-plus color-info"></i>
                              </span>
                              Add
                           </button>
                     </a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('propertyAreas.index') }}" method="GET">
                            <div class="row" style="ali">
                                <div class="col-sm-6 offset-sm-2">
                                    <input type="text" class="form-control" name="name" placeholder="Search" value="{{ request('name') }}">
                                </div>
                                <div class="col-sm-1 mt-2">
                                    <button type="submit" class="btn btn-dark btn-sm">
                                        {{ trans('words.search') }}
                                    </button>
                                </div>
                                <div class="col-sm-1 mt-1">
                                    <a href="{{ route('propertyAreas.index') }}" class="btn btn-info btn-md pull-left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>    
        </div>

        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">Areas</h4>
                </div> --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>City</th>
                                    <th>Sub City</th>
                                    <th>Town</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($areas as $area)
                            <tr>
                                <td>{{ $area->id }}</td>
                                <td>{{ $area->name }}</td>
                                <td>{{ $area->slug }}</td>
                                <td>{{ $area->town->subcity->city->name }}</td>
                                <td>{{ $area->town->subcity->name }}</td>
                                <td>{{ $area->town->name }}</td>
                                <td>{{ $area->latitude }}</td>
                                <td>{{ $area->longitude }}</td>
                                <td>
                                    @can('properties-area-edit')
                                       <a href="{{ route('propertyAreas.edit', $area->id) }}"
                                          class="btn btn-primary rounded btn-xs action-btn">
                                          <i class="fa fa-edit"></i>
                                       </a>
                                    @endcan
                                    @can('properties-area-delete')
                                       <a href="{{ route('propertyAreas.destroy', $area->id) }}"
                                          class="btn btn-danger rounded btn-xs action-btn"
                                          onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                          <i class="fa fa-trash"></i>
                                       </a>
                                    @endcan
                                 </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        {{ $areas->render() }}
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
