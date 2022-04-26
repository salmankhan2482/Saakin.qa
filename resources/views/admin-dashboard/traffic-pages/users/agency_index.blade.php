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
                    <h4 class="card-title">Unique Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>Users</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $i => $user)
                            <tr>
                                <td>{{ $user->country ?? 'Null Country' }}</td>
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
