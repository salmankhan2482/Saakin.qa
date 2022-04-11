{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')

    <div class="container-fluid">
        <div class="col-12">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <a href="{{route('property-reports.index')}}">
                        <button type="button" class="btn btn-rounded btn-dark">Back</button>
                    </a>
                </ol>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Property Report</h4>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="table table-hover dt-responsive text-black">
                            <tbody>
                                <tr>
                                    <th>Report ID</th>
                                    <td>{{ $report->id }}</td>
                                </tr>
                                
                                <tr>
                                    <th>Message</th>
                                    <td>{{ $report->message ?? '' }}</td>
                                </tr>

                                <tr>
                                    <th>User Name</th>
                                    <td>{{ $report->user->name ?? '' }}</td>
                                </tr>
                                
                                <tr>
                                    <th>User Mail</th>
                                    <td>{{ $report->user->email ?? '' }}</td>
                                </tr>
                               
                                <tr>
                                    <th>Property Title</th>
                                    <td>
                                        <a class="property-img" target="_blank"
                                            href="{{ url(strtolower($report->property->property_purpose) .'/' .$report->property->property_slug .'/' .$report->property->id) }}">
                                            {{ $report->property->property_name }}
                                        </a>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>status</th>
                                    <td>{{ $report->status ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
