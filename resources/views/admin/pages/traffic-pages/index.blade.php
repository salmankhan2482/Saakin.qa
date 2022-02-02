@extends("admin.admin_app")

@section('content')
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

                <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Property Title</th>
                            <th>Agency</th>
                            <th>Call Now</th>
                            <th>Email</th>
                            <th>WhatsaApp</th>
                            <th class="text-center width-100">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($clickCounters as $i => $click)
                            <tr>
                                <td>{{ $click->id }}</td>
                                <td>
                                    <a class="property-img"
                                        href="{{ url(strtolower($click->property_purpose) . '/' . $click->property_slug . '/' . $click->id) }}"
                                        target="_blank">
                                        {!! \Illuminate\Support\Str::limit($click->property_name, 40, '...') !!}
                                    </a>
                                </td>
                                <td> {{ $click->agency_name }} </td>
                                <td>
                                    {{ \App\ClickCounters::where('property_id', $click->property_id)->where('button_name', 'Call')->count() }}
                                </td>
                                <td>
                                    {{ \App\ClickCounters::where('property_id', $click->property_id)->where('button_name', 'Email')->count() }}
                                </td>
                                <td>
                                    {{ \App\ClickCounters::where('property_id', $click->property_id)->where('button_name', 'WhatsApp')->count() }}
                                </td>
                                <td>
                                    <a  class="btn btn-primary"
                                        href="{{ route('click_counter.show', $click->property_id ) }}"
                                        target="_blank"
                                        >
                                        View in Detail
                                    </a>
                                </td>
                                {{-- <td class="text-center">
                                    <a href="{{ route('properties_reports.update', $click->id) }}"
                                        class="cu_btn btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5">
                                        Resolved
                                    </a>
                                    <a href="{{ route('properties_reports.destroy', $click->id) }}"
                                        class="cu_btn btn btn-icon waves-effect waves-light btn-danger m-b-5">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">
                                {{-- @include('admin.pagination', ['paginator' => $clickCounters]) --}}
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
