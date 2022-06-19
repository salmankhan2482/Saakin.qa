{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="page-titles">
                <ol class="breadcrumb">
                </ol>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Visitor IPs</h4>
                    <a href="{{route('trafficUsers')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>IP Addresses</th>
                                    <th>Last Viewed</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['trafficUsersIPs'] as $key => $IPs)
                                <tr>
                                    <td>{{ $IPs->id }}</td>
                                    <td>{{ $IPs->ip_address }}</td>
                                    <td>{{ date('d-m-Y', strtotime($IPs->created_at)) ??'' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        {{ $data['trafficUsersIPs']->render() }}
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
