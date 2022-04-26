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
                                <div class="col-sm-2"></div>
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label d-flex justify-content-center">From</label>
                                        <div class="col-sm-9">
                                        <input type="date" class="h-100 form-control" name="from" value="{{request('from')}}" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label d-flex justify-content-center">To</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="h-100 form-control"name="to" value="{{ request('to') }}" >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-dark btn-sm p-2">
                                        {{ trans('words.search') }}
                                    </button>
                                </div>
                                <div class="col-sm-2"></div>
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
                    <a href="{{ url()->previous() }}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>Property Name</th>
                                    <th>Property Visits</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['propertyVisitsPerMonth'] as $i => $click)
                                <tr>
                                    {{-- <td>{{ $click->id }}</td> --}}
                                    <td>
                                        @if(isset($click->property->property_purpose))
                                        <a href="{{ url(strtolower($click->property->property_purpose) . '/' . $click->property->property_slug . '/' . $click->property->id) }}">
                                            {{ $click->property->property_name }}
                                        </a>
                                        @else
                                        {{$click->id}}
                                        @endif
                                    </td>
                                    <td>{{ $click->counter }}</td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
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
