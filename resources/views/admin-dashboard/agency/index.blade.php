{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Search Agency</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('agencies.index') }}" method="GET">
                            <div class="row">
                                <div class="col-sm-4 offset-sm-2">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search">
                                </div>
                                <div class="col-sm-1 mt-2">
                                    <button type="submit" class="btn btn-dark btn-sm">
                                        {{ trans('words.search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Agencies</h4>
                    <a href="{{ route('agencies.create') }}">
                        <button type="button" class="btn btn-rounded btn-info"><span
                            class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i>
                        </span>Add</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['agencies'] as $i => $agency)
                                    <tr>
                                        <td>{{ $agency->name }}</td>
                                        <td>{{ $agency->phone }}</td>
                                        <td>{{ $agency->email }}</td>
                                        <td>
                                            <img src="{{ asset('upload/agencies/' . $agency->image) }}"
                                                alt="{{ $agency->name.'- agency image' }}" width="60" />
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($agency->created_at)) ??''}} </td>
                                        <td class="text-center">
                                            @if ($agency->status == 1)
                                                <i class="fa fa-circle text-success mr-1"></i>
                                            @else
                                                <i class="fa fa-circle text-danger mr-1"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('agencies.edit', $agency->id) }}"
                                                class="btn btn-primary rounded btn-xs action-btn">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('agencies.destroy' , $agency->id) }}"
                                                class="btn btn-danger rounded btn-xs action-btn"
                                                onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        {{ $data['agencies']->render() }}
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
