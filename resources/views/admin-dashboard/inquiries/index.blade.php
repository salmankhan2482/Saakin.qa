{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Inquiries</h4>
                    <a href="{{ route('create_inquiry') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                            <span class="btn-icon-left text-info">
                                <i class="fa fa-plus color-info"></i>
                            </span>
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
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Agency</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inquirieslist as $i => $inquiries)
                                    <tr>
                                        <td>{{ $inquiries->id }}</td>
                                        <td>{{ $inquiries->type }}</td>
                                        <td>{{ $inquiries->name }}</td>
                                        <td>{{ $inquiries->email }}</td>
                                        <td>{{ $inquiries->Agencies->name ?? '' }} </td>
                                        <td>
                                            <a href="{{ url('admin/inquiries/delete/' . Crypt::encryptString($inquiries->id)) }}" class="btn btn-danger rounded btn-xs action-btn" onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
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