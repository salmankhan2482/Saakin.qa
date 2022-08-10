{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')

    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Agency Inquiry</h4>
                    <a href="{{ url()->previous() }}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Inquiry ID</th>
                                    <td>{{ $inquire->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $inquire->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $inquire->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $inquire->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Agency Name</th>
                                    <td>{{ $inquire->Agencies->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Subject</th>
                                    <td>{{ $inquire->subject ??'' }}</td>
                                </tr>
                                <tr> 
                                       <th>Message</th>
                                       <td>{{ $inquire->message }}</td>
                                 </tr>
                                 <tr>
                                       <th>Sending Date</th>
                                       <td>{{ date('d-m-Y', strtotime($inquire->created_at)) ??'' }}</td>
                                 </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
