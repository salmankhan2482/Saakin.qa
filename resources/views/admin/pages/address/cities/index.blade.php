@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{ route('propertyCities.create') }}" class="btn btn-primary">
                    Add City
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <h2>Cities</h2>
        </div>

        <div class="panel panel-default panel-shadow">
            <div class="panel-body">

                <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th class="text-center width-100">
                                {{ trans('words.action') }}
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cities as $i => $city)
                            <tr>
                                <td>{{ $city->id }}</td>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->slug }}</td>
                                <td class="text-center">
                                    <a href="{{ route('propertyCities.edit', $city->id) }}"
                                        class="cu_btn btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5">
                                        Edit
                                    </a>
                                    <a href="{{ route('propertyCities.destroy', $city->id) }}"
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
                                @include('admin.pagination', ['paginator' => $cities]) 
                            </td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>

@endsection
