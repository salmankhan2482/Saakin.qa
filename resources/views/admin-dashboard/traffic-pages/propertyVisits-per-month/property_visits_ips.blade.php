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
                    <h4 class="card-title">Property Visits</h4>
                    <a href="{{route('propertyVisits_per_month')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    
                                    <th>IP Addresses</th>
                                    <th>Last Contacted</th>
                                    <th>Last Viewed</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                               
                                 @foreach ($data['property_visit_IPs'] as $key => $IPs)
                                
                                <tr>
                                  
                                    <td>{{ $IPs->ip_address }}</td>
                                    <td>
                                        {{ $IPs->country ??''}}
                                    </td> 
                                    <td>{{ date('d-m-Y', strtotime($IPs->created_at)) ??'' }} &nbsp;&nbsp;  At  &nbsp;&nbsp;  {{ date('H:i:s', strtotime($IPs->created_at)) ??'' }}</td>
                                </tr>
                                
                                 @endforeach 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        {{ $data['property_visit_IPs']->render() }}
                                        
                                        
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
