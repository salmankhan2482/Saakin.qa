@extends("admin.admin_app")

@section('content')
   
    <div id="main">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{route('permissions.create')}}" class="btn btn-primary">
                    Add Permission
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <h2>Permission</h2>
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
                
                <table id="data-table" class="table table-striped table-hover dt-responsive" data-order="[]" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th class="text-center width-100">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($permissions as $i => $menuOption)
                            <tr>
                                <td>{{ $menuOption->id }}</td>
                                <td>{{ $menuOption->title }}</td>
                                <td>
                                    <a class="btn btn-default-dark" href="{{ route('permissions.edit', $menuOption->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('permissions.destroy', $menuOption->id) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-center">
                                {{-- @include('admin.pagination', ['paginator' => $permissions]) --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
  
@endsection
@section('scripts-custom')

@endsection
