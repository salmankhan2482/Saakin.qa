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
                        <form action="{{ route('trafficUsers') }}" method="GET">
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
                                    <button type="submit" class="btn btn-dark btn-sm">
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
                    <h4 class="card-title">Unique Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>Agency Name</th>
                                    <th>Total Users</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $i => $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->totalUsers }}</td>
                            </tr>
                        @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        {{ $users->render() }}
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
