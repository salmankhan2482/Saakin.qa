{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cities</h4>
                    <a href="{{ route('city_detail_create') }}">
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
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Attributes</th>
                                    <th class="text-center width-100">{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($cityDetails as $i => $cityDetail)
                                <tr>
                                    <td>{{ $cityDetail->Cities->name }}</td>
                                    <td>
                                        <img src="{{asset('upload/cities/'.$cityDetail->Cities->city_image)}}" width="100" alt="{{ $cityDetail->Cities->name.'- city image' }}"/>
                                    </td>
                                    <td>{{ strip_tags(Str::limit($cityDetail->attributes, 60, '...') )  }}</td>
                                        <td class="text-center width-100">
                                            <a href="{{ route('city_detail_edit', $cityDetail->id) }}"

                                                class="btn btn-info rounded btn-xs action-btn">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('cities.destroy', $city->id) }}"
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
