{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top 5 Areas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Agency Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top5Properties as $i => $click)
                                <tr>
                                    <td>{{ $click->id }}</td>
                                    <td>{{ $click->aname ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('top_5_areas.list', $click->aid) }}"
                                            class="btn btn-primary rounded btn-xs action-btn">
                                            Show List
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
