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
                                    {{-- <div class="col-sm-2"></div> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Label placement</h4>
                    </div>
                    <div class="card-body">
                        <div id="label-placement-chart" class="ct-chart ct-golden-section chartlist-chart"></div>
                    </div>
                </div>
            </div> --}}
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $i => $user)
                                        <tr>
                                            {{-- <td>@dd($user)</td> --}}
                                            <td>{{ $user->country ?? 'Null Country' }}</td>
                                            <td>{{ $user->totalUsers }}</td>
																						<td>
																							<a class="btn btn-success rounded btn-xs action-btn"
																							href="{{ url('admin/traffic/trafficUsersIPs/'.$user->id	.'?from='.request('from').'&to='.request('to')) }}">
																							 {{-- href="{{ url('admin/traffic/visits_per_month_IPs/'.$user->id ??"") }}"> --}}
																									<i class="fa fa-eye"></i>
																							</a>
																					</td>
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
    @section('scripts')
        <script>
            (function($) {

                    var labelPlacementChart = function() {
                        //Label placement

                        new Chartist.Bar('#label-placement-chart', {
                            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                            series: [
                                [5, 4, 3, 7, 5, 10, 3],
                                [3, 2, 9, 5, 4, 6, 4]
                            ]
                        }, {
                            axisX: {
                                // On the x-axis start means top and end means bottom
                                position: 'start'
                            },
                            axisY: {
                                // On the y-axis start means left and end means right
                                position: 'end'
                            },
                            plugins: [
                                Chartist.plugins.tooltip()
                            ]

                        })(jQuery);
                    }   
        </script>
    @endsection
