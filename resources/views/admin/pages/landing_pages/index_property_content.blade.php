@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{ URL::to('admin/landing-pages/create') }}"
                    class="btn btn-primary">{{ trans('words.add') . ' ' . trans('words.page_content') }} <i
                        class="fa fa-plus"></i></a>

            </div>
            <h2>Landing Pages Content</h2>
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
                            <th>Property Purpose</th>
                            <th>Property Type</th>
                            <th>Property City</th>
                            <th>Content</th>
                            <th class="text-center width-100">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($landing_pages_content as $i => $landing_page_content)
                            <tr>
                                <td>{{ $landing_page_content->id }}</td>
                                <td>{{ $landing_page_content->PropertyPurposes->name ?? 'Not Available' }}</td>
                                <td>{{ $landing_page_content->PropertyTypes->types ?? 'Not Available' }}</td>
                                <td>{{ $landing_page_content->PropertyCities->name ?? 'Not Available' }}</td>
                                <td>{!! \Illuminate\Support\Str::limit($landing_page_content->page_content, 250, '...')  !!}</td>
                                <td class="text-center">
                                    <a href="{{ url('admin/landing-pages/edit/' . $landing_page_content->id) }}"
                                        class="cu_btn btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5"
                                        data-toggle="tooltip" title="{{ trans('words.edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="{{ url('admin/landing-pages/delete/' . $landing_page_content->id) }}"
                                        class="cu_btn btn btn-icon waves-effect waves-light btn-danger m-b-5"
                                        onclick="return confirm('{{ trans('words.dlt_warning_text') }}')"
                                        data-toggle="tooltip" title="{{ trans('words.remove') }}">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-center">
                                @include('admin.pagination', ['paginator' => $landing_pages_content])
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
