@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{ route('propertyAreas.create') }}" class="btn btn-primary">
                    Add Area
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <h2>Areas</h2>
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
                            <th>Name</th>
                            <th>Slug</th>
                            <th>City</th>
                            <th>Sub City</th>
                            <th>Town</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th class="text-center width-100">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($areas as $area)
                            <tr>
                                <td>{{ $area->id }}</td>
                                <td>{{ $area->name }}</td>
                                <td>{{ $area->slug }}</td>
                                <td>{{ $area->town->subcity->city->name }}</td>
                                <td>{{ $area->town->subcity->name }}</td>
                                <td>{{ $area->town->name }}</td>
                                <td>{{ $area->latitude }}</td>
                                <td>{{ $area->longitude }}</td>
                                <td class="text-center">
                                    <a href="{{ route('propertyAreas.edit', $area->id) }}"
                                        class="cu_btn btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5">
                                        Edit
                                    </a>
                                    <a href="{{ route('propertyAreas.destroy', $area->id) }}"
                                        class="cu_btn btn btn-icon waves-effect waves-light btn-danger m-b-5">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">
                                @include('admin.pagination', ['paginator' => $areas])
                            </td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
    </div>


@endsection

