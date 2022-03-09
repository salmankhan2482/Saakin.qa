{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')



{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users</h4>
                <a href="{{route('users.create')}}"
                    <button type="button" class="btn btn-rounded btn-info">
                        <span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i></span>Add
                    </button>
                </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>{{ trans('words.user_type') }}</th>
                            <th>{{ trans('words.image') }}</th>
                            <th>{{ trans('words.name') }}</th>
                            <th>{{ trans('words.email') }}</th>
                            <th>{{ trans('words.phone') }}</th>
                            <th>{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allusers as $i => $users)
                                <tr>
                                    <td>{{ $users->usertype }}</td>
                                    <td>
                                        @if ($users->image_icon)
    
                                            <img lass="rounded-circle" width="35" src="{{ URL::asset('upload/members/' . $users->image_icon . '-b.jpg') }}"
                                                width="80" alt="person">
                                        @endif
                                    </td>
                                    <td>{{ $users->name }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td>{{ $users->phone }}</td>
                                        {{-- <tr>
                            <td><img class="rounded-circle" width="35"  src="{{ asset('images/profile/small/pic1.jpg') }}" alt=""></td>
                            <td>Tiger Nixon</td>
                            <td>Architect</td>
                            <td>Male</td>
                            <td>M.COM., P.H.D.</td>
                            <td><a href="javascript:void(0);"><strong>123 456 7890</strong></a></td>
                            <td><a href="javascript:void(0);"><strong>info@example.com</strong></a></td>
                            <td>2011/04/25</td> --}}
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ url('admin/users/edituser/' . Crypt::encryptString($users->id)) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
                                                <a href="{{ url('admin/users/delete/' . Crypt::encryptString($users->id)) }}" class="btn btn-danger shadow btn-xs sharp"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
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
