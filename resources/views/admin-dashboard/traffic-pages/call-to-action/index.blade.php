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
                                {{-- <div class="col-sm-2"></div> --}}
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label d-flex">From</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="h-100 form-control" name="from"
                                                value="{{ request('from') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label d-flex">To</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="h-100 form-control" name="to"
                                                value="{{ request('to') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-dark btn-sm p-2">
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
                                            <a class="btn btn-success rounded btn-xs action-btn"
                                                href="{{ route('agencyCallToActionList', $click->agency_id) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        {{ $data['clickCounters']->render() }}
                                    </td>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        (function($) {
            
        })(jQuery);
    </script>
@endsection
