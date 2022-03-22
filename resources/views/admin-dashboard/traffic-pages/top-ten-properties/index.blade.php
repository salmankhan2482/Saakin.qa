{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top 10 Properties</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Agency Name</th>
                                    <th>Property Visits</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top10Proprties as $i => $click)
                            <tr>
                                <td>{{ $click->aid }}</td>
                                <td>
                                    <a href="{{ route('top_Ten_Properties.list', $click->aid) }}">
                                        {{ $click->aname }}
                                    </a>
                                </td>
                                <td>{{ $click->counter }}</td>
                                
                            </tr>
                        @endforeach
                               
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        {{-- @include('admin.pagination', ['paginator' => $top10Proprties]) --}}
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
