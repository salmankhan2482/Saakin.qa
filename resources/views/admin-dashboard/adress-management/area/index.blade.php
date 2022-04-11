{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Areas</h4>
                    <a href="{{ route('propertyAreas.create') }}">
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
                                    <th>Sub City</th>
                                    <th>Town</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th class="text-center width-100">{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($areas as $area)
                            <tr>
                                <td>{{ $area->id }}</td>
                                <td>{{ $area->name }}</td>
                                <td>{{ $area->slug }}</td>
                                <td>{{ $area->town->subcity->city->name }}</td>
                                <td>{{ $area->town->subcity->name }}</td>
                                <td>{{ $area->town->name }}</td>
                                <td>{{ $area->latitude }}</td>
                                <td>{{ $area->longitude }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('propertyAreas.edit', $area->id) }}"
                                                class="btn btn-info rounded btn-xs action-btn">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('propertyAreas.destroy', $area->id) }}"
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
                                    <td colspan="9" class="text-center">
                                        {{ $areas->render() }}
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
