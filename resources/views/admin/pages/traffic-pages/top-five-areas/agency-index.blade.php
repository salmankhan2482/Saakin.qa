@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <h4 style="font-size: 20px;">
                Top 10 Areas
            </h4>
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
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-center">
                                {{-- @include('admin.pagination', ['paginator' => $top10Properties]) --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
@endsection
