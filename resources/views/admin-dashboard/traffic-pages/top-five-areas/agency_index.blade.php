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
                    @if (Auth()->User()->usertype == 'Agency')
                    <h4 class="card-title">Top 10 Areas</h4>
                    @else
                    <h4 class="card-title">Top 10 Areas for "{{ $agency ??'' }}"</h4>
                    @endif  
                    <a href="{{route('dashboard.index')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
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
