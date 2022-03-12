@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{ route('property-amenity.create') }}"
                    class="btn btn-primary">{{ trans('words.add') . ' ' . trans('words.property_amenity') }} 
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <h2>Property Amenities</h2>
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
                            <th>{{ trans('words.property_amenity') }}</th>
                            <th>{{ trans('words.status') }}</th>
                            <th class="text-center width-100">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($propertyAmenities as $i => $propertyAmenity)
                            <tr>
                                <td>{{ $propertyAmenity->name }}</td>
                                <td>{{ $propertyAmenity->status }}</td>
                                <td class="text-center">
                                    <a href="{{ route('property-amenity.edit', $propertyAmenity->id) }}"
                                        class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5"
                                        data-toggle="tooltip" title="{{ trans('words.edit') }}"> 
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    <a href="{{ route('property-amenity.destroy', $propertyAmenity->id) }}"
                                        class="btn btn-icon waves-effect waves-light btn-danger m-b-5"
                                        onclick="return confirm('{{ trans('words.dlt_warning_text') }}')"
                                        data-toggle="tooltip" title="{{ trans('words.remove') }}"> 
                                        <i class="fa fa-remove"></i> 
                                    </a>
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
