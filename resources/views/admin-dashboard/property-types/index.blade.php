{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Property Types</h4>
                    @can('properties-type-create')
                    <a href="{{ route('property-types.create') }}">
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
                                @foreach ($data['alltypes'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->types ?? 'Not Available' }}</td>
                                        <td>
                                          @can('properties-type-edit')
                                             <a href="{{ route('property-types.edit',$item->id) }}"
                                                class="btn btn-primary rounded btn-xs action-btn">
                                                <i class="fa fa-edit"></i>
                                             </a>
                                          @endcan
                                          @can('properties-type-delete')
                                             <a href="{{ route('property-types.destroy',$item->id) }}" class="btn btn-danger rounded btn-xs action-btn"
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
                                    <td colspan="3" class="text-center">
                                        {{ $data['alltypes']->render() }}
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
