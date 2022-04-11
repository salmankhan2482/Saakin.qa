{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Call To Action</h4>
                    <a href="{{ url()->previous() }}">
                        <button type="button" class="btn btn-rounded btn-dark">
                            <span class="btn-icon-left text-info">
                                <i class="fa fa-arrow-left color-dark"></i>
                            </span>
                            Back
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Property Title</th>
                                    <th>Call Now</th>
                                    <th>Email</th>
                                    <th>WhatsaApp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['clickCounters'] as $i => $click)
                                    <tr>
                                        <td>{{ $click->pid }}</td>
                                        <td>
                                            <a class="property-img" target="_blank"
                                            href="{{ url(strtolower($click->ppurpose) . '/' . $click->pslug . '/' . $click->pid) }}">
                                                {!! Str::limit($click->pname, 40, '...') !!}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $click->totalCall }}
                                        </td>
                                        <td>
                                            {{ $click->totalEmail }}
                                        </td>
                                        <td>
                                            {{ $click->totalWhatsApp }}
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
