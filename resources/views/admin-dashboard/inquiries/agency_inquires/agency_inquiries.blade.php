{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Agency Inquiries</h4>
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
                                    <th class="text-center width-100">{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inquirieslist as $i => $inquiries)
                                <tr>
                                
                                <td>{{ $inquiries->name }}</td>
                                <td>{{ $inquiries->subject }}</td>
                                <td>{{ $inquiries->email }}</td>
                                <td>{{ $inquiries->phone }}</td>
                                <td>{{ $inquiries->Agencies->name ??''}} </td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/view_agency_inquiry', $inquiries->id ) }}" 
                                                class="btn btn-info rounded btn-xs action-btn">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ url('admin/inquiries/delete/'.Crypt::encryptString($inquiries->id)) }}"     
                                                class="btn btn-danger rounded btn-xs action-btn"
                                                onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                <i class="fa fa-trash"></i>
                                            </a>
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