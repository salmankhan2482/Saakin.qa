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
                    <h4 class="card-title">Page Visits</h4>
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
                                    <th>Agency ID</th>
                                    <th>Agency Name</th>
                                    <th>Total Traffic</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['pageVisitsPerMonth'] as $i => $click)
                                <tr>
                                    <td>{{ $click->id }}</td>
                                    <td>
                                        <a href="{{ url(strtolower($click->property->property_purpose) . '/' . $click->property->property_slug . '/' . $click->property->id) }}">
                                            {{ $click->property->property_name }}
                                        </a>
                                    </td>
                                    <td>{{ $click->counter }}</td>
                                   
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
