{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Role</h4>
                    <a href="{{ route('roles.index') }}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="col-10 ">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-2 mt-5">
                           <div class="card-actions">
                              <input type="checkbox" id="check-all"/>
                              <strong for="check-all">Check All</strong>
                          </div>
                        </div>
                        <div class="col-12">
                            <strong>Permission:</strong>
                            <br />
                            <div class="row">
                                @if (count($permission) > 0)
                                    @foreach ($permission as $value)
                                        <div class="col-md-4">
                                            <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                                {{ $value->name }}</label>
                                            <br/>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                            <button type="submit" class="btn btn-rounded btn-success">Save</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
   $('#check-all').change(function () {
       console.log('hit');
       var checkboxes = $(this).closest('form').find(':checkbox');
       checkboxes.prop('checked', $(this).is(':checked'));
   });
</script>
@endsection
