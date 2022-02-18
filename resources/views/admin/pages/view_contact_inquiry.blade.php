@extends("admin.admin_app")

@section('content')

    <div id="main">
        <div class="page-header">
            <a href="{{ URL::to('admin/property_inquiries') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> {{trans('words.back')}}</a>
        </div>
        <div class="panel panel-default panel-shadow">
            <div class="panel-body">

                <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                        <tr>
                            <th>Inquiry ID</th>
                            <td>{{ $inquire->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $inquire->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $inquire->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $inquire->phone }}</td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>{{ $inquire->subject }}</td>
                        </tr>
                        <tr> 
                                <th>Message</th>
                                <td>{{ $inquire->message }}</td>
                            </tr>
                            <tr> 
                                <th>Sending Date</th>
                                <td>{{ date('d-m-Y', strtotime($inquire->created_at)) ??'' }}</td>
                            </tr>
                    
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
    

    <!-- Modal -->
    <div class="modal fade" id="importAgencies" tabindex="-1" role="dialog" aria-labelledby="importAgenciesLabel"
        aria-hidden="true">

    </div>


@endsection

