{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Notifications</h4>
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
                                    <th>Status</th>
                                    <th class="text-center width-100">{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inquirieslist as $i => $inquiries)
                                <tr>
                                
                                <td>{{ $inquiries->id }}</td>
                                <td>{{ $inquiries->type }}</td>
                                <td>{{ $inquiries->name }}</td>
                                <td>{{ $inquiries->email }}</td>
                                <td>{{ $inquiries->Agencies->name ??''}} </td>

                                @if ($inquiries->status == 1)
                                <td> <i class="badge badge-rounded badge-success">{{ $inquiries->EnquireStatus->status ??''}}</i> </td>
                                @else
                                <td> <i class="badge badge-rounded badge-danger">{{ $inquiries->EnquireStatus->status ??''}}</i> </td>
                                @endif    
                                <td class="text-center">
                                            <a href="{{ route('view_notification', $inquiries->id ) }}" 
                                                class="btn btn-primary rounded btn-xs action-btn">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('deleteLead', $inquiries->id) }}"
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
