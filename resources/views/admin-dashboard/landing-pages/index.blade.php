{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Landing Pages</h4>
                    <a href="{{ route('agencies.create') }}">
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
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Purpose</th>
                                    <th>Type</th>
                                    <th>City</th>
                                    <th>Cotnent</th>
                                    <th>{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['landing_pages_content'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->PropertyPurposes->name ?? 'Not Available' }}</td>
                                        <td>{{ $item->PropertyTypes->types ?? 'Not Available' }}</td>
                                        <td>{{ $item->PropertyCities->name ?? 'Not Available' }}</td>
                                        <td>{{ $item->meta_title ?? 'Not Available' }}</td>
                                        <td>
                                            <a href="{{ url('admin/landing-pages/edit/'.$item->id) }}"
                                                class="btn btn-info rounded btn-xs action-btn">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ url('admin/landing-pages/delete/'.$item->id) }}"
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
