{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="page-titles">
                <ol class="breadcrumb">
                    <a href="{{route('top_10_areas')}}">
                        <button type="button" class="btn btn-rounded btn-dark fa fa-arrow-left"> 
                            Back
                        </button>
                    </a>
                </ol>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top 10 Areas of "{{ $agency }}"</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Area Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top10Properties as $i => $click)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $click->paddress }}</td>
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
