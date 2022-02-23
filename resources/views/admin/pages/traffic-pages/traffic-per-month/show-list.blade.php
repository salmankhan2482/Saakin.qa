@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <a href="{{ URL::to('admin/traffic_per_month') }}" class="btn btn-default-light btn-xs"><i
                    class="md md-backspace"></i> {{ trans('words.back') }}</a>
        </div>
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

                <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Property ID</th>
                            <th>Property Title</th>
                            <th>Total Traffic</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($totalTraffic as $i => $traffic)
                            <tr>
                                <td>{{ $traffic->pid }}</td>
                                <td>
                                    <a class="property-img"
                                        href="{{ url(strtolower($traffic->ppurpose) . '/' . $traffic->pslug . '/' . $traffic->pid) }}"
                                        target="_blank">
                                        {!! \Illuminate\Support\Str::limit($traffic->pname, 40, '...') !!}
                                    </a>
                                </td>
                                <td>
                                    {{ $traffic->count }}
                                </td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                   
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>


@endsection
@section('scripts-custom')
    <script>
        
    </script>
@endsection
