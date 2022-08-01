{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Search Sub City</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('propertySubCities.index') }}" method="GET">
                            <div class="row">
                                <div class="col-sm-4 offset-sm-2">
                                    <input type="text" class="form-control" name="name" placeholder="Search" value="{{ request('name') }}">
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
                    <h4 class="card-title">Sub-Cities</h4>
                    @can('properties-subcity-create')
                        <a href="{{ route('propertySubCities.create') }}">
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
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>City</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($subCities as $i => $subCity)
                            <tr>
                                <td>{{ $subCity->id }}</td>
                                <td>{{ $subCity->name }}</td>
                                <td>{{ $subCity->slug }}</td>
                                <td>{{ $subCity->city->name ?? '' }}</td>
                                <td>
                                    @can('properties-subcity-edit')                                       
                                    <a href="{{ route('propertySubCities.edit', $subCity->id) }}"
                                        class="btn btn-primary rounded btn-xs action-btn">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('properties-subcity-delete')                                       
                                    <a href="{{ route('propertySubCities.destroy', $subCity->id) }}"
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
                                    <td colspan="5" class="text-center">
                                        {{ $subCities->render() }}
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
