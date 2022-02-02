@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <h4 style="font-size: 20px;">
               Traffic Per Month
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
                            <th>Property Link</th>
                            <th>IP Address</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($trafficPerMonth as $i => $click)
                            <tr>
                                <td>{{ $click->id }}</td>
                                <td>
                                    <a href="{{ url(strtolower($click->property->property_purpose) . '/' . $click->property->property_slug . '/' . $click->property->id) }}">
                                        {{ $click->property->property_name }}
                                    </a>
                                </td>
                                <td>{{ $click->ip_address }}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">
                                @include('admin.pagination', ['paginator' => $trafficPerMonth])
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Agency</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('agencies.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">Import Agnecies Data</button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="importAgencies" tabindex="-1" role="dialog" aria-labelledby="importAgenciesLabel"
        aria-hidden="true">

    </div>


@endsection
@section('scripts-custom')
    <script>
        function importAgencies(id) {
            $('#importAgencies').modal({
                backdrop: 'static',
                keyboard: true,
                show: true
            });
            $.ajax({
                url: '{{ route('get.agences.keys') }}',
                type: "post",
                dataType: 'json',
                data: {
                    '_token': '{{ @csrf_token() }}',
                    id: id,
                },
                success: function(data) {
                    if (data.status == 'success') {
                        $('#importAgencies').html(data.html);
                    }
                },

            });
        }
    </script>
@endsection
