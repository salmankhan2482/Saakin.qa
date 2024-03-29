{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Agency Inquiries</h4>
                    <a href="{{ route('create_lead') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                            <span class="btn-icon-left text-info">
                                <i class="fa fa-plus color-info"></i>
                            </span>Add</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Agency</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inquirieslist as $i => $inquiries)
                                    <tr>

                                        <td>{{ $inquiries->name }}</td>
                                        <td>{{ $inquiries->subject }}</td>
                                        <td>{{ $inquiries->email }}</td>
                                        <td>{{ $inquiries->phone }}</td>
                                        <td>{{ $inquiries->Agencies->name ?? '' }} </td>
                                        <td>{{ date('d-m-Y', strtotime($inquiries->created_at)) ?? '' }} </td>
                                        <td>
                                            <a href="{{ url('admin/view_agency_inquiry', $inquiries->id) }}"
                                                class="btn btn-success rounded btn-xs action-btn">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                             @can('lead-delete')
                                                <a href="{{ route('deleteLead', $inquiries->id) }}"
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
                                    <td colspan="7" class="text-center">
                                        {{ $inquirieslist->render() }}
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
