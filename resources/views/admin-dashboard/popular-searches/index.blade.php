{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">PopularSearches</h4>
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
                                    {{-- <th>City</th> --}}
                                    {{-- <th>Sub City</th> --}}
                                    {{-- <th>Town</th> --}}
                                    {{-- <th>Area</th> --}}
                                    {{-- <th>Bed</th> --}}
                                    <th>Count</th>
                                    <th>{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['popularSearches'] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->property_purpose ?? '--' }}</td>
                                        <td>{{ $item->name ?? '--' }}</td>
                                        <td>{{ $item->propertyType->types ?? '--' }}</td>
                                        {{-- <td>{{ $item->city->name ?? '--' }}</td> --}}
                                        {{-- <td>{{ $item->subcity->name ?? '--' }}</td> --}}
                                        {{-- <td>{{ $item->town->name ?? '--' }}</td> --}}
                                        {{-- <td>{{ $item->area->name ?? '--' }}</td> --}}
                                        {{-- <td>{{ $item->bedrooms ?? '--' }}</td> --}}
                                        <td>{{ $item->count ?? '--' }}</td>
                                        <td>
                                            <a href="{{ route('popularSearches.edit',$item->id) }}"
                                                class="btn btn-info rounded btn-xs action-btn">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            
                                            <a href="{{ route('popularSearches.destroy',$item->id) }}"
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
