@extends("admin.admin_app")

@section('content')
   
    <div id="main">
        <div class="page-header">
            <div class="pull-right">
                <a href="{{route('roles.create')}}" class="btn btn-primary">
                    Add Roles
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <h2>Roles</h2>
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
                            <th>Permissions</th>
                            <th>Menu Options</th>
                            <th class="text-center width-100">{{ trans('words.action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $i => $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->title }}</td>
                                <td>
                                    @foreach($role->rolepermissions as $item)
                                        <span class="badge btn-danger">
                                            {{ $item->title }}
                                        </span>    
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($role->menuoptions as $item)
                                        <span class="badge btn-info">
                                            {{ $item->title }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    <a class="btn btn-default-dark" href="{{ route('roles.edit', $role->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('roles.destroy', $role->id) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-center">
                                {{-- @include('admin.pagination', ['paginator' => $roles]) --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
  
@endsection
