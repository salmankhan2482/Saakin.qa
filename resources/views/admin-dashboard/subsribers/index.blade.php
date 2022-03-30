{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <a href="{{ route('property_inquiries') }}">
                    <button type="button" class="btn btn-rounded btn-dark">Back</button>
                </a>
            </ol>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Subscribers</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>IP Address</th>
                                    <th class="text-center width-100">{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriberlist as $i => $subscriber)
                            <tr>
                                <td>{{$i+1 }}</td>
                                <td>{{ $subscriber->email }}</td>
                                <td>{{ $subscriber->ip }}</td>
                                        
                                        <td>
                                            <a href="{{ route('subscriber.destroy' , $subscriber->id) }}"
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
