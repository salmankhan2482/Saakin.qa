@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <div class="pull-right">
                <a href="#" class="btn btn-primary">
                    Add Report
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <h2>Property Reports</h2>
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
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Property Title</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>{{ trans('words.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($reports as $i => $report)
                            <tr>
                                <td>{{ $report->id }}</td>
                                <td>{{ $report->user->name }}</td>
                                <td>{{ $report->user->email }}</td>
                                <td>
                                    <a class="property-img"
                                        href="{{ url(strtolower($report->property->property_purpose) .'/' .$report->property->property_slug .'/' .$report->property->id) }}"
                                        target="_blank">
                                        {!! Str::limit($report->property->property_name, 30, '...') !!}
                                    </a>
                                </td>
                                <td>{!! Str::limit($report->message, 30, '...') !!}</td>
                                <td>{{ $report->status }}</td>
                                <td style="display: flex; margin: 2px">
                                    @if ($report->status != 'Resolved')
                                    <form action="{{ route('property-reports.update', $report->id) }}" style="margin-right: 5px" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-icon waves-effect btn-success m-b-5 m-r-5">
                                            Resolved
                                        </button>
                                    </form>
                                    @endif

                                    <a href="{{ route('property-reports.destroy', $report->id) }}"
                                        class="btn btn-icon waves-effect waves-light btn-danger m-b-5">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-center">
                                {{-- @include('admin.pagination', ['paginator' => $reports]) --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
   
@endsection
