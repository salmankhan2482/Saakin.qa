{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Towns</h4>
                    <a href="{{ route('propertyTowns.create') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                            <span class="btn-icon-left text-info">
                                <i class="fa fa-plus color-info"></i>
                            </span>Add</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>City</th>
                                    <th>Sub-City</th>
                                    <th class="text-center width-100">{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($towns as $i => $town)
                            <tr>
                                <td>{{ $town->id }}</td>
                                <td>{{ $town->name }}</td>
                                <td>{{ $town->slug }}</td>
                                <td>{{ $town->subcity->city->name }}</td>
                                <td>{{ $town->subcity->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('propertyTowns.edit', $town->id) }}"
                                                class="btn btn-info rounded btn-xs action-btn">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('propertyTowns.destroy', $town->id) }}"
                                                class="btn btn-danger rounded btn-xs action-btn"
                                                onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                <i class="fa fa-trash"></i>
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
