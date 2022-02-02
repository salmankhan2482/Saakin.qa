@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{ URL::to('admin/city-detail/create') }}"
                    class="btn btn-primary">{{ trans('words.add') . ' ' . trans('words.city_detail') }} <i
                        class="fa fa-plus"></i></a>
            </div>
            <h2>City Details</h2>
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
                            <th>Title</th>
                            <th>Short Description</th>
                            <th>Image1</th>
                            <th>Image2</th>
                            <th>Image3</th>
                            <th>Image4</th>
                            <th>Image5</th>
                            <th>Image6</th>
                            <th class="text-center width-100">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cityDetails as $i => $cityDetail)
                            <tr>
                                <td>{{ $cityDetail->title }}</td>
                                <td>{{ $cityDetail->short_description }}</td>
                                <td>
                                    <img src="{{ asset('upload/cities/' . $cityDetail->image1) }}"
                                        alt="{{ $cityDetail->title . '-' . $cityDetail->image1 }}" width="60" />
                                </td>
                                <td>
                                    <img src="{{ asset('upload/cities/' . $cityDetail->image2) }}"
                                        alt="{{ $cityDetail->title . '-' . $cityDetail->image2 }}" width="60" />
                                </td>
                                <td>
                                    <img src="{{ asset('upload/cities/' . $cityDetail->image3) }}"
                                        alt="{{ $cityDetail->title . '-' . $cityDetail->image3 }}" width="60" />
                                </td>
                                <td>
                                    <img src="{{ asset('upload/cities/' . $cityDetail->image4) }}"
                                        alt="{{ $cityDetail->title . '-' . $cityDetail->image4 }}" width="60" />
                                </td>
                                <td>
                                    <img src="{{ asset('upload/cities/' . $cityDetail->image5) }}"
                                        alt="{{ $cityDetail->title . '-' . $cityDetail->image5 }}" width="60" />
                                </td>
                                <td>
                                    <img src="{{ asset('upload/cities/' . $cityDetail->image6) }}"
                                        alt="{{ $cityDetail->title . '-' . $cityDetail->image6 }}" width="60" />
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('admin/city-detail/edit/' . $cityDetail->id) }}"
                                        class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5"
                                        data-toggle="tooltip" title="{{ trans('words.edit') }}"> <i
                                            class="fa fa-edit"></i> </a>
                                    <a href="{{ url('admin/city-detail/delete/' . $cityDetail->id) }}"
                                        class="btn btn-icon waves-effect waves-light btn-danger m-b-5"
                                        onclick="return confirm('{{ trans('words.dlt_warning_text') }}')"
                                        data-toggle="tooltip" title="{{ trans('words.remove') }}"> <i
                                            class="fa fa-remove"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9" class="text-center">
                                @include('admin.pagination', ['paginator' => $cityDetails])
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>



@endsection
