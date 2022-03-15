{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Search User</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['url' => 'admin/users', 'class' => 'form-inline filter', 'id' => 'search', 'role' => 'form', 'method' => 'get']) !!}
                            <div class="col-2">
                                <input type="text" class="form-control" name="keyword" 
                                    placeholder="{{ trans('words.search_by_name_email') }}">
                            </div>
                            <div class="col-2">
                                <select name="type" id="basic" class="selectpicker show-tick form-control">
                                    <option value="">Select User Type</option>
                                    <option value="Agent">{{ trans('words.agent') }}</option>
                                    <option value="User">{{ trans('words.user') }}</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-dark  pull-right">
                                    {{ trans('words.search') }}
                                </button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users</h4>
                    <a href="{{ route('users.create') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                            <span class="btn-icon-left text-info">
                                <i class="fa fa-plus color-info"></i>
                            </span>
                            Add
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    @if (Session::has('flash_message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ trans('words.user_type') }}</th>
                                    <th>{{ trans('words.image') }}</th>
                                    <th>{{ trans('words.name') }}</th>
                                    <th>{{ trans('words.email') }}</th>
                                    <th>Roles </th>
                                    <th>{{ trans('words.phone') }}</th>
                                    <th class="text-center width-100">{{ trans('words.action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($allusers as $i => $users)
                                    <tr>
                                        <td>{{ $users->usertype }}</td>
                                        <td>
                                            @if ($users->image_icon)
                                                <img src="{{ URL::asset('upload/members/' . $users->image_icon . '-b.jpg') }}"
                                                    width="80" alt="person">
                                            @endif
                                        </td>
                                        <td>{{ $users->name }}</td>
                                        <td>{{ $users->email }}</td>
                                        <td>
                                            @if (!empty($users->getRoleNames()))
                                                @forelse($users->getRoleNames() as $v)
                                                    <label class="">{{ $v }}</label>
                                                @empty
                                                    No Roles Assigned
                                                @endforelse
                                            @else
                                                No Roles
                                            @endif
                                        </td>
                                        <td>{{ $users->phone }}</td>
                                        <td class="text-center p-20" style="display: flex;">
                                            <a href="{{ route('users.show', Crypt::encryptString($users->id)) }}"
                                                class="btn btn-icon waves-effect waves-light btn-success"
                                                data-toggle="tooltip" title="{{ trans('words.view') }}"
                                                style="margin-right:5px">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="{{ route('users.edit', Crypt::encryptString($users->id)) }}"
                                                class="btn btn-icon waves-effect waves-light btn-primary"
                                                data-toggle="tooltip" title="{{ trans('words.edit') }}"
                                                style="margin-right:5px">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('users.destroy', Crypt::encryptString($users->id)) }}"
                                                class="btn btn-icon waves-effect waves-light btn-danger m-b-5"
                                                onclick="return confirm('{{ trans('words.dlt_warning_text') }}')"
                                                data-toggle="tooltip" title="{{ trans('words.remove') }}"
                                                style="margin-right:5px">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
