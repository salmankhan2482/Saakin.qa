{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Property Reports</h4>
                    <a href="#">
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
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Property Title</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['reports'] as $i => $report)
                                <tr>
                                    <td>{{ $report->id }}</td>
                                    <td>{{ $report->user->name }}</td>
                                    <td>{{ $report->user->email }}</td>
                                    <td>
                                        <a class="property-img"
                                            href="{{ url(strtolower($report->property->property_purpose) .'/' .$report->property->property_slug .'/' .$report->property->id) }}"
                                            target="_blank">
                                            {!! Str::limit($report->property->property_name, 30, '...') !!}
                                        </a>
                                    </td>
                                    <td>{!! Str::limit($report->message, 30, '...') !!}</td>
                                    <td>{{ $report->status }}</td>
                                    <td style="display: flex; margin: 2px">
                                        @if ($report->status != 'Resolved')
                                        <form action="{{ route('property-reports.update', $report->id) }}" style="margin-right: 5px" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-icon waves-effect btn-success m-b-5 m-r-5">
                                                Resolved
                                            </button>
                                        </form>
                                        @endif

                                        <a href="{{ route('property-reports.destroy', $report->id) }}"
                                            class="btn btn-icon waves-effect waves-light btn-danger m-b-5">
                                            <i class="fa fa-remove"></i>
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
