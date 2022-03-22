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
                        <form action="{{ route('callToAction.index') }}" method="GET">
                            <div class="row justify-content-center">
                                <div class="col-sm-2">
                                    <label for="">From</label>
                                    <input type="date" id="start" name="from" value="{{ request('from') }}" >
                                </div>
                                
                                <div class="col-sm-2">
                                    <label for="">To</label>
                                    <input type="date" id="start" name="to" value="{{ request('to') }}" >
                                </div>
                                
                                <div class="col-sm-1">
                                    <br>
                                    <button type="submit" class="btn btn-dark">
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
                    <h4 class="card-title">Click To Action</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>Agency ID</th>
                                    <th>Agency Name</th>
                                    <th>Total Clicks</th>
                                    <th>{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['clickCounters'] as $i => $click)
                                    <tr>
                                        <td>{{ $click->agency_id }}</td>
                                        <td>{{ $click->agency_name }}</td>
                                        <td>{{ $click->totalCall }}</td>
                                        <td>
                                        <a class="btn btn-outline-dark" 
                                            href="{{ route('agencyCallToActionList', $click->agency_id) }}">
                                                Show Properties
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
