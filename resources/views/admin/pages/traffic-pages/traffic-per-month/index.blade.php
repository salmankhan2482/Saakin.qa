@extends("admin.admin_app")

@section('content')
<div class="page-header">
    <h4 style="font-size: 20px;">
       Traffic Per Month
    </h4>
</div>
    <div>
        <div class="panel panel-shadow">
            <div class="panel-body">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    {!! Form::open(['route' => 'traffic_per_month', 'class' => 'form-inline filter', 'id' => 'search', 'role' => 'form', 'method' => 'get']) !!}
                    
                    <div class="form-group">
                        <label for="">From</label>
                        <input type="date" id="start" name="from" value="{{ request('from') }}" >
                    </div>
                    <div class="form-group">
                        <label for="">To</label>
                        <input type="date" id="start" name="to" value="{{ request('to') }}" >
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default-dark ">{{ trans('words.search') }}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                
            </div>
        </div>
    </div>
    <div id="main">
        @if (Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ Session::get('flash_message') }}
            </div>
        @endif
            
        <div class="panel panel-default panel-shadow">
       
            <div class="panel-body">
                
                <table id="data-table" class="table table-striped table-hover dt-responsive" data-order="[]" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Agency ID</th>
                            <th>Agency Name</th>
                            <th>Total Traffic</th>
                            <th class="text-center width-100">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($trafficPerMonth as $i => $traffic)
                            <tr>
                                <td>{{ $traffic->aid }}</td>
                                <td>{{ $traffic->aname }}</td>
                                <td>{{ $traffic->totalTraffic }}</td>
                                <td>
                                    <a class="btn btn-default-dark" href="{{ route('agencyTrafficList', $traffic->aid) }}">
                                        Show Properties
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-center">
                                {{-- @include('admin.pagination', ['paginator' => $clickCounters]) --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
  
@endsection
@section('scripts-custom')
   
@endsection
