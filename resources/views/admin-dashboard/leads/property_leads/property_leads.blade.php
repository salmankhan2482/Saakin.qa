{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')
@section('style')
<link rel="stylesheet" href="{{ asset('admin/css/js-example-basic-multiple.css') }}">
<style>
   .select2-selection--multiple{
      height: auto !important;
   }
</style>
@endsection
{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Property Inquiries</h4>
                    <a href="{{ route('create_lead') }}">
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
                                       <td>{{ $i+1 }}</td>
                                       <td>{{ $lead->name }}</td>
                                       <td>{{ Str::limit($lead->phone, 10) }}</td>
                                       <td>{{ $lead->propertyType->types ?? ''}}</td>
                                       <td>{{ $lead->property_purpose }}</td>
                                       <td>{{ $lead->bedrooms ??''}}</td>
                                       <td>
                                          {{ Str::limit( ($lead->PropertyArea->name ?? '').' '.($lead->PropertyTown->name ?? '').' '.($lead->PropertySubcity->name ?? '').' '.($lead->PropertyCity->name ?? ''), 10) }}
                                       </td>
                                       <td>{{ $lead->agency->name ?? '' }} </td>
                                       <td>{{ date('d-m-Y', strtotime($lead->created_at)) ?? '' }} </td>
                                       <td>{{ $lead->movein_date ?? ''}}</td>
                                       @if( auth()->user()->usertype == 'Admin')
                                       <td> 
                                          {{ $lead->is_forwarded == 1 ? 'True' : 'None' }}
                                       </td>
                                       @endif
                                       <td>
                                          <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                             Action
                                          </button>
                                          <div class="dropdown-menu">
                                             <a href="{{ url('admin/view_inquiry', $lead->id) }}" class="dropdown-item">
                                                <i class="fa fa-eye"></i>
                                                Lead's Detail
                                             </a>
                                             
                                             <a href="#" data-toggle="modal" data-target="#forwardAgentsModal" 
                                                class="dropdown-item forwardFunction" data-lead_id="{{ $lead->id }}">
                                                <i class="fa fa-plus"></i>
                                                Forward to Agents
                                             </a>
                                             
                                             <a href="{{ route('adminLead.edit', $lead->id) }}" class="dropdown-item" >
                                                <i class="fa fa-pencil"></i>
                                                Edit Lead
                                             </a>  
                                             
                                             <a href="{{ route('deleteLead', $lead->id) }}" class="dropdown-item"
                                                onclick="return confirm('{{ trans('words.dlt_warning_text') }}')">
                                                <i class="fa fa-trash"></i>
                                                Delete Lead
                                             </a>  
                                          </div>
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
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $forwardedLead->lead->name }}</td>
                                        <td>{{ Str::limit($forwardedLead->lead->phone, 10) }}</td>
                                        <td>{{ $forwardedLead->lead->propertyType->types }}</td>
                                        <td>{{ $forwardedLead->lead->property_purpose }}</td>
                                        <td>{{ $forwardedLead->lead->bedrooms }}</td>
                                        <td>{{ Str::limit( 
                                          ($forwardedLead->lead->PropertyArea->name ?? '').' '.($forwardedLead->lead->PropertyTown->name ?? '').' '.($forwardedLead->lead->PropertySubcity->name ?? '').' '.($forwardedLead->lead->PropertyCity->name ?? ''), 10) 
                                          }}  
                                        </td>
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
    <div class="modal fade" id="forwardAgentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Forward Lead to Agents</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('forwardLeadtoAgents') }}" method="POST">
               @csrf
               <div class="form-row">
                  <div class="form-group col-12">
                     <input type="hidden" name="lead_id" id="lead_id_input" value="">
                     <label>Forward Agents</label>
                     <select name="forward_agents[]" class="form-control js-example-basic-multiple" multiple data-live-search="true">
                        <option value="">Select Agency</option>
                        @foreach ($data['agenices'] as $agency)
                           <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-row row">
                  <div class="col-12">
                     <button type="submit" class="btn btn-primary btn-xs pull-right">Save changes</button>
                  </div>
               </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('scripts')
   <script src="{{ URL::asset('admin/js/jquery.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   <script>
      
      $(document).ready(function() {
         $('.js-example-basic-multiple').select2({
            placeholder: "Select Forward Agents"
         });

         $('.forwardFunction').on('click', function () {
            var lead_id = $(this).data('lead_id');
            $("#lead_id_input").val(lead_id);
         });

      });

   </script>
@endsection
