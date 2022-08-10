{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Company Registration Inquiries</h4>
                </div>
                <div class="card-body">
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th>City</th>
                                    <th>Job Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registrations as $i => $registration)
                                <tr>
                                    <td>{{ $registration->first_name ?? ''}} {{ $registration->last_name ?? ''}}</td>
                                    <td>{{ $registration->email }}</td>
                                    <td>{{ $registration->phone }}</td>
                                    <td>{{ $registration->company_name ??''}} </td>
                                    <td>{{ $registration->relatedCity->name ??''}} </td>
                                    <td>{{ $registration->job_title ??''}} </td>
                                    <td class="d-flex">
                                       <a href="{{ route('companyRegistration.show', $registration->id ) }}"  
                                          class="btn btn-success rounded btn-xs action-btn">
                                          <i class="fa fa-eye"></i>
                                       </a>
                                       @can('lead-delete')
                                          <form action="{{ route('companyRegistration.destroy', $registration->id) }}" method="POST"> @csrf @method('DELETE') 
                                             <button type="submit"  class="btn btn-danger rounded btn-xs action-btn" onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                <i class="fa fa-trash"></i>
                                             </button>
                                          </form>
                                       @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        {{ $registrations->render() }}
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
