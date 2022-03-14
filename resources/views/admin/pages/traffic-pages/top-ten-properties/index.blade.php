@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <h4 style="font-size: 20px;">
                Top 10 Properties
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

                <table id="" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            {{-- <th>Property Title</th> --}}
                            <th>Agency</th>
                            <th>Count</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($top10Proprties as $i => $click)
                            <tr>
                                <td>{{ $click->aid }}</td>
                                <td>
                                    <a href="{{ route('top_Ten_Properties.list', $click->aid) }}">
                                        {{ $click->aname }}
                                    </a>
                                </td>
                                <td>{{ $click->counter }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-center">
                                {{-- @include('admin.pagination', ['paginator' => $top10Proprties]) --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>

@endsection
