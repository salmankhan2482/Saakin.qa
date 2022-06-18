{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        
        
        @if (Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Search Landing Page</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('landing-pages.index') }}" method="GET">
                            <div class="row">
                                <div class="col-sm-4 offset-2">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search" value="{{ request('keyword') }}">
                                </div>
                                <div class="col-sm-2 mt-2">
                                    <button type="submit" class="btn btn-dark btn-sm pull-left">
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
                    <h4 class="card-title">Landing Pages</h4>
                    <a href="{{ route('landing-pages.create') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                            <span class="btn-icon-left text-info">
                                <i class="fa fa-plus color-info"></i>
                            </span>
                            Add
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Purpose</th>
                                    <th>Type</th>
                                    <th>City</th>
                                    <th>Sub-City</th>
                                    <th>Cotnent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['landing_pages_content'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->PropertyPurposes->name ?? 'Not Available' }}</td>
                                        <td>{{ $item->PropertyTypes->types ?? 'Not Available' }}</td>
                                        <td>{{ $item->PropertyCities->name ?? 'Not Available' }}</td>
                                        <td>{{ $item->PropertySubCities->name ?? 'Not Available' }}</td>
                                        <td>{{ $item->meta_title ?? 'Not Available' }}</td>
                                        <td>
                                            <a href="{{ route('landing-pages.edit',$item->id) }}"
                                                class="btn btn-primary rounded btn-xs action-btn">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('landing-pages.destroy',$item->id) }}"
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
                                        {{ $data['landing_pages_content']->render() }}
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
