{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Search Through Date</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('propertyVisits_per_month') }}" method="GET">
                            <div class="row justify-content-center">
                                <div class="col-sm-2">
                                    <label>From</label>
                                    <input type="date" id="start" name="from" value="{{ request('from') }}" >
                                </div>
                                
                                <div class="col-sm-2">
                                    <label>To</label>
                                    <input type="date" id="start" name="to" value="{{ request('to') }}" >
                                </div>
                                
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-dark btn-sm p-2">
                                        {{ trans('words.search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Property Visits</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>Agency ID</th>
                                    <th>Agency Name</th>
                                    <th>Property Visits</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                  
                                @foreach ($data['propertyVisitsPerMonth'] as $i => $traffic)
                                    <tr>
                                        <td>{{ $traffic->aid }}</td>
                                        <td>{{ $traffic->aname }}</td>
                                        <td>{{ $traffic->totalTraffic }}</td>
                                        <td>
                                            <a class="btn btn-success rounded btn-xs action-btn"
                                             href="{{ url('admin/traffic/visits_per_month/'.$traffic->aid.'?from='.request('from').'&to='.request('to')) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        {{ $data['propertyVisitsPerMonth']->render() }}
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
