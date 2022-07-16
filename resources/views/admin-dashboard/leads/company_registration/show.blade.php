{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')

    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Company Registration Inquiry</h4>
                    <a href="{{ route('companyRegistration.index') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dt-responsive" >
                            <thead>
                                <tr>
                                    <td><strong>Registration ID</strong></td>
                                    <td>{{ $registration->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Subject</strong></td>
                                    <td>Mail for Company Registration</td>
                                </tr>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td>{{ $registration->first_name ?? '' }} {{ $registration->last_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{ $registration->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone</strong></td>
                                    <td>{{ $registration->phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Company Name</strong></td>
                                    <td>{{ $registration->company_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>City Name</strong></td>
                                    <td>{{ $registration->relatedCity->name ??'' }}</td>
                                </tr>
                                {{-- <tr>
                                    <td><strong>Attachment</strong></td>
                                    <td>
                                    @if (!empty($registration->images))
                                                <img src="{{ URL::asset('upload/company_registration/' . $registration->images) }}"
                                                class="mt-1">
                                            @endif
                                </td>
                                </tr> --}}
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
