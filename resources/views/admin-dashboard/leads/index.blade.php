{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Areas</h4>
                    @can('lead-create')
                        <a href="{{ route('propertyAreas.create') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                           <span class="btn-icon-left text-info">
                              <i class="fa fa-plus color-info"></i>
                           </span> Add
                        </button>
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Agency</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($leads as $i => $inquiries)
                                    <tr>
                                       <td>{{ $inquiries->id }}</td>
                                       <td>{{ $inquiries->type }}</td>
                                       <td>{{ $inquiries->name }}</td>
                                       <td>{{ $inquiries->email }}</td>
                                       <td>{{ $inquiries->Agencies->name ??''}} </td>
                                       <td class="text-center">
                                          @can('lead-delete')
                                             <a href="{{ route('deleteLead', $inquiries->id) }}" class="btn btn-danger rounded btn-xs action-btn" onclick="return confirm('{{ trans('words.dlt_warning_text') }}')"> <i class="fa fa-trash"></i>
                                             </a>
                                          @endcan
                                       </td>
                                    </tr>
                                 @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        {{ $leads->render() }}
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
