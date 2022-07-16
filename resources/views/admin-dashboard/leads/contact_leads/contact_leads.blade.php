{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Contact Inquiries</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inquirieslist as $i => $inquiries)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>

                                        <td>{{ $inquiries->name }}</td>
                                        <td>{{ $inquiries->email }}</td>
                                        <td>{{ $inquiries->subject }}</td>
                                        <td>{{ date('d-m-Y', strtotime($inquiries->created_at)) ?? '' }} </td>
                                        <td>
                                            <a href="{{ url('admin/view_contact_inquiry', $inquiries->id) }}"
                                                class="btn btn-success rounded btn-xs action-btn">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ url('admin/inquiries/delete/' . Crypt::encryptString($inquiries->id)) }}"
                                                class="btn btn-danger rounded btn-xs action-btn"
                                                onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-center">
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
