{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cities</h4>
                     @can('properties-city-create')
                        <a href="{{ route('propertyCities.create') }}">
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
                                    <th>Aaction</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($cities as $i => $city)
                                <tr>
                                    <td>{{ $city->id }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->slug }}</td>
                                    <td>
                                       @can('properties-city-edit')
                                          <a href="{{ route('propertyCities.edit', $city->id) }}"
                                             class="btn btn-primary rounded btn-xs action-btn">
                                             <i class="fa fa-edit"></i>
                                          </a>
                                       @endcan
                                       @can('properties-city-delete')
                                          <a href="{{ route('propertyCities.destroy', $city->id) }}"
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
                                    <td colspan="4" class="text-center">
                                        {{ $cities->render() }}
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
