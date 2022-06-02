{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Property Inquiries</h4>
                    <a href="{{ route('create_inquiry') }}">
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Types</th>
                                    <th>Purpose</th>
                                    <th>Bed's</th>
                                    <th>Location</th>
                                    <th>Agency</th>
                                    <th>Date</th>
                                    <th>Move In</th>
                                    <th>Status</th>
                                    <th>{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inquirieslist as $i => $inquiries)
                                    <tr>

                                        <td>{{ $inquiries->property_id }}</td>
                                        <td>{{ $inquiries->name }}</td>
                                        <td>{{ $inquiries->phone }}</td>
                                        <td>{{ $inquiries->GetProperty->propertiesTypes->types ??''}}</td>
                                        <td>{{ $inquiries->GetProperty->property_purpose ??''}}</td>
                                        <td>{{ $inquiries->GetProperty->bedrooms ??''}}</td>
                                        <td>{{ $inquiries->GetProperty->address ??''}}</td>
                                        <td>{{ $inquiries->Agencies->name ?? '' }} </td>
                                        <td>{{ date('d-m-Y', strtotime($inquiries->created_at)) ?? '' }} </td>
                                        <td>{{ $inquiries->movein_date ??''}}</td>
                                        <td> @if ($inquiries->GetProperty->status == 1)
                                            <i class="fa fa-circle text-success mr-1"></i>
                                        @else
                                            <i class="fa fa-circle text-danger mr-1"></i>
                                        @endif</td>
                                        <td>
                                            <a href="{{ url('admin/view_inquiry', $inquiries->id) }}"
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
