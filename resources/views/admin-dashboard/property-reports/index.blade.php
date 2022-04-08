{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Property Reports</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Property Title</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Resolved</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['reports'] as $i => $report)
                                    <tr>
                                        <td>{{ $report->id }}</td>
                                        <td>{{ Str::limit($report->user->name ?? '' , 20, '...') }}</td>
                                        <td>{{ Str::limit($report->user->email ?? '', 20, '...') }}</td>
                                        <td>
                                            <a class="property-img" target="_blank"
                                                href="{{ url(strtolower($report->property->property_purpose) .'/' .$report->property->property_slug .'/' .$report->property->id) }}">
                                                {!! Str::limit($report->property->property_name, 15, '...') !!}
                                            </a>
                                        </td>
                                        <td>{!! Str::limit($report->message, 15, '...') !!}</td>
                                        <td>{{ $report->status }}</td>
                                        <td>
                                            <a href="{{ route('property-reports.show', $report->id) }}" 
                                                class="btn btn-info rounded btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @if (Auth::User()->usertype == 'Admin')
                                                <a href="{{ route('property-reports.destroy', $report->id) }}"
                                                    class="btn btn-danger rounded btn-xs action-btn">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($report->status != 'Resolved')
                                                <form action="{{ route('property-reports.update', $report->id) }}"
                                                    style="margin-right: 5px" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success rounded btn-xs action-btn">
                                                        &check;
                                                    </button>
                                                </form>
                                            @endif
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
