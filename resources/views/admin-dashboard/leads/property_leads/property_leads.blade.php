{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Property Inquiries</h4>
                    <a href="{{ route('create_inquiry') }}">
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
                                    <th>Phone</th>
                                    <th>Types</th>
                                    <th>Purpose</th>
                                    <th>Bed's</th>
                                    <th>Location</th>
                                    <th>Agency</th>
                                    <th>Date</th>
                                    <th>Move In</th>
                                    @if( auth()->user()->usertype == 'Admin')
                                    <th>
                                       Forwarded
                                    </th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center">
                                @foreach ($leads as $i => $lead)
                                    <tr>
                                       <td>{{ $lead->property_id }}</td>
                                       <td>{{ $lead->name }}</td>
                                       <td>{{ $lead->phone }}</td>
                                       <td>{{ $lead->property->propertiesTypes->types ??''}}</td>
                                       <td>{{ $lead->property->property_purpose ??''}}</td>
                                       <td>{{ $lead->property->bedrooms ??''}}</td>
                                       <td>{{ $lead->property->address ??''}}</td>
                                       <td>{{ $lead->agency->name ?? '' }} </td>
                                       <td>{{ date('d-m-Y', strtotime($lead->created_at)) ?? '' }} </td>
                                       <td>{{ $lead->movein_date ??''}}</td>
                                       @if( auth()->user()->usertype == 'Admin')
                                       <td> 
                                          {{ $lead->is_forwarded == 1 ? 'True' : 'None' }}
                                       </td>
                                       @endif
                                       <td>
                                          <a href="{{ url('admin/view_inquiry', $lead->id) }}"
                                             class="btn btn-success rounded btn-xs">
                                             <i class="fa fa-eye"></i>
                                          </a>
                                          <a href="{{ route('deleteLead', $lead->id) }}"
                                             class="btn btn-danger rounded btn-xs"
                                             onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                             <i class="fa fa-trash"></i>
                                          </a>
                                       </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="11" class="text-center">
                                        {{ $leads->render() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
       @if (Auth::user()->usertype == 'Agency')
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Forwarded Inquiries</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3">
                            <thead>
                                <tr>
                                    <th>Prop ID</th>
                                    <th>User Name</th>
                                    <th>User Phone</th>
                                    <th>Prop Type</th>
                                    <th>Purpose</th>
                                    <th>Beds</th>
                                    <th>Location</th>
                                    <th>Agency</th>
                                    <th>Date</th>
                                    <th>Move In</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($forwardedLeads as $i => $forwardedLead)
                                    <tr>
                                        <td>{{ $forwardedLead->lead->property_id }}</td>
                                        <td>{{ $forwardedLead->lead->name }}</td>
                                        <td>{{ $forwardedLead->lead->phone }}</td>
                                        <td>{{ $forwardedLead->lead->property->propertiesTypes->types }}</td>
                                        <td>{{ $forwardedLead->lead->property->property_purpose }}</td>
                                        <td>{{ $forwardedLead->lead->property->bedrooms }}</td>
                                        <td>{{ $forwardedLead->lead->property->address ?? '' }}</td>
                                        <td>{{ $forwardedLead->lead->agency->name ?? '' }}</td>
                                        <td>{{ date('d-m-Y', strtotime($forwardedLead->lead->created_at)) ?? '' }} </td>
                                        <td>{{ date('d-m-Y', strtotime($forwardedLead->lead->movein_date)) ??''}}</td>
                                        <td>{{ $forwardedLead->status == 1 ?'Read' : 'UnRead'}}</td>
                                        <td>
                                           <a href="{{ route('viewForwardInquiry', $forwardedLead->id) }}"
                                             class="btn btn-success btn-xs rounded">
                                             <i class="fa fa-eye"></i>
                                          </a>
                                          @if(auth()->user()->id == $forwardedLead->lead->user_id)
                                             <a href="{{ route('deleteLead', $forwardedLead->id) }}" 
                                                class="btn btn-danger btn-xs rounded" 
                                                onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                <i class="fa fa-trash"></i>
                                             </a>
                                          @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="12" class="text-center">
                                        {{ $forwardedLeads->render() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       @endif
    </div>
@endsection
