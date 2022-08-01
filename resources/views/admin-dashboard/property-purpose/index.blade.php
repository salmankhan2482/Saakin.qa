{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Property Purpose</h4>
                    @can('properties-purpose-create')
                        <a href="{{ route('property-purpose.create') }}">
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
                                    <th>Property Purpose</th>
                                    <th>{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['propertyPurposes'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name ?? 'Not Available' }}</td>
                                        <td>
                                          @can('properties-purpose-edit')
                                             <a href="{{ route('property-purpose.edit',$item->id) }}"
                                                   class="btn btn-primary rounded btn-xs action-btn">
                                                   <i class="fa fa-edit"></i>
                                             </a>
                                          @endcan
                                          @can('properties-purpose-delete')
                                             <a href="{{ route('property-purpose.destroy',$item->id) }}" class="btn btn-danger rounded btn-xs action-btn"
                                                onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                <i class="fa fa-trash"></i>
                                             </a>
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
