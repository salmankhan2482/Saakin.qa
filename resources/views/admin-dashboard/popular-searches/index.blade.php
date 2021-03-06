{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Search</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('popularSearches.index') }}" method="GET">
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
                    <h4 class="card-title">Popular Searches</h4>
                    <a href="{{ route('dashboard.index')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Purpose</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['popularSearches'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->property_purpose ?? '--' }}</td>
                                        <td>{{ $item->name ?? '--' }}</td>
                                        <td>{{ $item->propertyType->types ?? '--' }}</td>
                                        <td>{{ $item->count ?? '--' }}</td>
                                        <td>
                                            <a href="{{ route('popularSearches.destroy',$item->id) }}"
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
                                    <td colspan="6" class="text-center">
                                        {{ $data['popularSearches']->render() }}
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
