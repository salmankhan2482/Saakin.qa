{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Search User</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('users.index') }}" method="GET">
                            {{-- {!! Form::open(['url' => 'admin/users',  'id' => 'search', 'method' => 'get']) !!} --}}
                            <div class="row">
                                <div class="col-4 offset-2">
                                    <input type="text" class="form-control" name="keyword"
                                        placeholder="Search by name, mail">
                                </div>
                                <div class="col-3">
                                    <select name="type" id="basic" class="selectpicker show-tick form-control">
                                        <option value="">Select User Type</option>
                                        <option value="Agent">{{ trans('words.agent') }}</option>
                                        <option value="User">{{ trans('words.user') }}</option>
                                    </select>
                                </div>
                                <div class="col-2 mt-2">
                                    <button type="submit" class="btn btn-dark btn-sm pull-left">
                                        {{ trans('words.search') }}
                                    </button>
                                </div>
                            </div>
                            {{-- {!! Form::close() !!} --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
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
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>User Type</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles </th>
                                    <th>Action</th>
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
                                        <td class="text-center p-20" style="display: flex;">
                                            <a href="{{ route('users.show', Crypt::encryptString($users->id)) }}"
                                                class="btn btn-success rounded btn-xs action-btn">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="{{ route('users.edit', Crypt::encryptString($users->id)) }}"
                                                class="btn btn-primary rounded btn-xs action-btn">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('users.destroy', Crypt::encryptString($users->id)) }}"
                                                class="btn btn-danger rounded btn-xs action-btn"
                                                onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        {{ $allusers->render() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
