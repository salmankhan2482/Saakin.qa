@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{ route('propertySubCities.create') }}" class="btn btn-primary">
                    Add Sub City
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <h2>Sub Cities</h2>
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
                            <th class="text-center width-100">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($subCities as $i => $subCity)
                            <tr>
                                <td>{{ $subCity->id }}</td>
                                <td>{{ $subCity->name }}</td>
                                <td>{{ $subCity->slug }}</td>
                                <td>{{ $subCity->city->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('propertySubCities.edit', $subCity->id) }}"
                                        class="cu_btn btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5">
                                        Edit
                                    </a>
                                    <a href="{{ route('propertySubCities.destroy', $subCity->id) }}"
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
                                @include('admin.pagination', ['paginator' => $subCities])
                            </td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
            <div class="clearfix"></div>
        </div>



@endsection
