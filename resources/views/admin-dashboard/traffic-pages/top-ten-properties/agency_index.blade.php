{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top 10 Properties List</h4>
                    <a href="{{route('top_Ten_Properties')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Property Title</th>
                                    <th>Property Visits</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top10Proprties as $i => $click)
                            <tr>
                                <td>{{ $click->id }}</td>
                                <td>
                                    <a href="{{ url(strtolower($click->property_purpose) . '/' . $click->property_slug . '/' . $click->id) }}">
                                        {{ $click->property_name }}
                                    </a>
                                </td>
                                <td>{{ $click->counter }}</td>
                            </tr>
                        @endforeach
                               
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        {{ $top10Proprties->render() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
