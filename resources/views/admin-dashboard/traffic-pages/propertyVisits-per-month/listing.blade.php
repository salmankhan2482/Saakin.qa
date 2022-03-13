{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Page Visits</h4>
                    <a href="#">
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
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>Property ID</th>
                                    <th>Property Title</th>
                                    <th>Total Traffic</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['PropertiesVisits'] as $i => $traffic)
                                <tr>
                                    <td>{{ $traffic->pid }}</td>
                                    <td>
                                        <a class="property-img"
                                            href="{{ url(strtolower($traffic->ppurpose) . '/' . $traffic->pslug . '/' . $traffic->pid) }}"
                                            target="_blank">
                                            {!! \Illuminate\Support\Str::limit($traffic->pname, 40, '...') !!}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $traffic->count }}
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
