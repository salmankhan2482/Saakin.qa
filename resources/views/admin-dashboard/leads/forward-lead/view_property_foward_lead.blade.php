{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
      <div class="col-md-12">
         @if (count($errors) > 0)
            <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                     @endforeach
                  </ul>
            </div>
         @endif
         @if (Session::has('flash_message'))
            <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  {{ Session::get('flash_message') }}
            </div>
         @endif
      </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Forwarded Property Inquiry</h4>
                    <a href="{{ url()->previous() }}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                  <table class="table table-clear dt-responsive">
                        <tbody>
                           <tr>
                              <th>Inquiry ID</th>
                              <td>{{ $forwardLead->lead->id }}</td>
                              
                              <th>Inquiry Type</th>
                              <td>{{ $forwardLead->lead->type }}</td>
                           </tr>
                           <tr>
                              <th>Agency Name</th>
                              <td>{{ $forwardLead->lead->agency->name ?? '' }}</td>
                              
                              <th>Property ID</th>
                              <td>{{ $forwardLead->lead->id ?? '' }}</td>
                           
                           </tr>
                           <tr>
                              <th>Ref ID</th>
                              <td>{{ $forwardLead->lead->reference_id }}</td>
                           
                              <th>Property Purpose</th>
                              <td>{{ $forwardLead->lead->property_purpose }}</td>
                           </tr>
                           <tr>
                              <th>Property Title</th>
                              <td>
                                 <a href="{{ url(strtolower($forwardLead->lead->property_purpose) . '/' . $forwardLead->lead->property_slug . '/' . $forwardLead->lead->id) }}"
                                    target="_blank" class="text-info">
                                    {{ $forwardLead->lead->property_name }}
                                 </a>
                              </td>

                              <th>Price</th>
                              <td>{{ $forwardLead->lead->price }} QR</td>
                           
                           </tr>
                           <tr>
                              <th>Source</th>
                              <td>{{ $forwardLead->lead->source }}</td>
                              
                              <th>Movin Date</th>
                              <td>{{ $forwardLead->lead->movein_date ?? '' }}</td>
                           
                           </tr>
                           <tr>
                              <th>Address</th>
                              <td>
                                 {{ ($lead->PropertyArea->name ?? '').' '.($lead->PropertyTown->name ?? '').' '.($lead->PropertySubcity->name ?? '').' '.($lead->PropertyCity->name ?? '') }}
                              </td>
                              
                              <th>Land Area</th>
                              <td>{{ $forwardLead->lead->land_area ?? '' }}</td>
                           
                           </tr>
                           <tr>
                              <th>Name</th>
                              <td>{{ $forwardLead->lead->name }}</td>

                              <th>Email</th>
                              <td>{{ $forwardLead->lead->email }}</td>

                           </tr>
                           <tr>
                              <th>Phone</th>
                              <td>{{ $forwardLead->lead->phone }}</td>

                              <th>Sending Date</th>
                              <td>
                                 {{ date('d-m-Y', strtotime($forwardLead->lead->created_at)) ?? '' }} at
                                 {{ date('H:i:s', strtotime($forwardLead->lead->created_at)) ?? '' }}
                              </td>
                           </tr>
                           <tr>
                              <th>Created By</th>
                              <td>
                                 {{ $forwardLead->lead->createdBy->name }}
                              </td>

                              <th>Subject</th>
                              <td>
                                 {{ $forwardLead->lead->subject }}
                              </td>
                           </tr>
                           <tr>
                              <th>Message</th>
                              <td colspan="3">{{ $forwardLead->lead->message }}</td>
                           </tr>
                        </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col-12">
         <div class="card">
            <div class="card-body">
               <form action="{{ route('commentForwardLead', $forwardLead->id) }}" method="POST">
                  @csrf {{ method_field('PUT') }}
                  <div class="form-row">
                     <div class="form-group col-md-6">
                         <label>Write a Comment</label>
                         <textarea name="comment" id="comment" rows="5" class="form-control">{{ $forwardLead->comment }}</textarea>
                     </div>
   
                     <div class="form-group col-md-6">
                         <label>Move In Date</label>
                         <input type="date" name="move_in_date" id="move_in_date" class="form-control" 
                         value="{{ $forwardLead->move_in_date }}">
                         <div class="pull-right mt-2">
                           <button type="submit" class="btn btn-primary">Update</button>
                         </div>
                     </div>
                 </div>
               </form>
            </div>
           </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Similar Properties</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Agency</th>
                                    <th>Property Title</th>
                                    <th>Type</th>
                                    <th>Purpose</th>
                                    <th>Views</th>
                                    <th>Created</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($similarProperties as $i => $property)
                                    <tr>
                                        <td>{{ $property->id }}</td>
                                        <td>{{ Str::limit($property->Agency->name, 15) ?? $property->user->name }}</td>
                                        <td>
                                            <a href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}" target="_blank">
                                                {{ Str::limit($property->property_name, 30) }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $property->property_type ? getPropertyTypeName($property->property_type)->types ?? '' : '' }}
                                        </td>
                                        <td> {{ $property->property_purpose }} </td>
                                        <td> {{ App\PropertyCounter::where('property_id', $property->id)->value('counter') ?? 0 }}
                                        </td>
                                        <td>
                                            @if ($property->created_at !== null)
                                                {{ date('d-m-Y', strtotime($property->created_at)) }}
                                            @endif
                                        </td>
                                        <td>{{ $property->price }}</td>
                                        <td class="text-center">
                                            @if ($property->status == 1)
                                                <i class="fa fa-circle text-success mr-1"></i>
                                            @else
                                                <i class="fa fa-circle text-danger mr-1"></i>
                                            @endif
                                            @if ($property->featured_property == 1)
                                                <i class="fa fa-star"></i>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
         <div class="card">
             <div class="card-header">
                 <h4 class="card-title">Available Near By Properties</h4>
             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table id="example3" class="display min-w850">
                         <thead>
                             <tr>
                                 <th>ID</th>
                                 <th>Agency</th>
                                 <th>Property Title</th>
                                 <th>Type</th>
                                 <th>Purpose</th>
                                 <th>Views</th>
                                 <th>Created</th>
                                 <th>Price</th>
                                 <th>Status</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($availableNearbyProperties as $i => $property)
                                 <tr>
                                     <td>{{ $property->id }}</td>
                                     <td>{{ Str::limit($property->Agency->name, 15) ?? $property->user->name }}</td>
                                     <td>
                                         <a href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}"
                                             target="_blank">
                                             {{ Str::limit($property->property_name, 30) }}
                                         </a>
                                     </td>
                                     <td>
                                         {{ $property->property_type ? getPropertyTypeName($property->property_type)->types ?? '' : '' }}
                                     </td>
                                     <td> {{ $property->property_purpose }} </td>
                                     <td> {{ App\PropertyCounter::where('property_id', $property->id)->value('counter') ?? 0 }}
                                     </td>
                                     <td>
                                         @if ($property->created_at !== null)
                                             {{ date('d-m-Y', strtotime($property->created_at)) }}
                                         @endif
                                     </td>
                                     <td>{{ $property->price }}</td>
                                     <td class="text-center">
                                         @if ($property->status == 1)
                                             <i class="fa fa-circle text-success mr-1"></i>
                                         @else
                                             <i class="fa fa-circle text-danger mr-1"></i>
                                         @endif
                                         @if ($property->featured_property == 1)
                                             <i class="fa fa-star"></i>
                                         @endif
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                         <tfoot>
                           <tr>
                               <td colspan="12" class="text-center">
                                   {{ $availableNearbyProperties->render() }}
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
