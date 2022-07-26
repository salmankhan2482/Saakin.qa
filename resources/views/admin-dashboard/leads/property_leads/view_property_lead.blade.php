{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
         <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Property Inquiry</h4>
                    <a href="{{ url()->previous() }}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                     <table class="table table-clear dt-responsive">
                        <tbody>
                           <tr>
                              <th>Inquiry ID</th>
                              <td>{{ $lead->id }}</td>
                              
                              <th>Inquiry Type</th>
                              <td>{{ $lead->type }}</td>
                           </tr>
                           <tr>
                              <th>Agency Name</th>
                              <td>{{ $lead->agency->name ?? '' }}</td>
                              
                              <th>Property ID</th>
                              <td>{{ $lead->property->id ?? '' }}</td>
                           
                           </tr>
                           <tr>
                              <th>Ref ID</th>
                              <td>{{ $lead->reference_id }}</td>
                           
                              <th>Property Purpose</th>
                              <td>{{ $lead->property_purpose == 1 ? 'Rent' : 'Sale'}}</td>
                           </tr>
                           <tr>
                              <th>Property Title</th>
                              <td>
                                 @if (isset($lead->property))
                                 <a href="{{ url(strtolower($lead->property->property_purpose).'/'.$lead->property->property_slug.'/'.$lead->property->id) }}" target="_blank" class="text-info">
                                    {{ $lead->property_title }}
                                 </a>
                                 @else
                                 {{ $lead->property_title }}
                                 @endif
                              </td>

                              <th>Price</th>
                              <td>{{ $lead->price }} QR</td>
                           
                           </tr>
                           <tr>
                              <th>Source</th>
                              <td>{{ $lead->source ?? 'Added From List'}}</td>
                              
                              <th>Movin Date</th>
                              <td>{{ $lead->movein_date ?? '' }}</td>
                           
                           </tr>
                           <tr>
                              <th>Address</th>
                              <td>
                                 {{ ($lead->PropertyArea->name ?? '').' '.($lead->PropertyTown->name ?? '').' '.($lead->PropertySubcity->name ?? '').' '.($lead->PropertyCity->name ?? '') }}
                              </td>
                              
                              <th>Land Area</th>
                              <td>{{ $lead->land_area ?? '' }}</td>
                           
                           </tr>
                           <tr>
                              <th>Name</th>
                              <td>{{ $lead->name }}</td>

                              <th>Email</th>
                              <td>{{ $lead->email }}</td>

                           </tr>
                           <tr>
                              <th>Phone</th>
                              <td>{{ $lead->phone }}</td>

                              <th>Sending Date</th>
                              <td>
                                 {{ date('d-m-Y', strtotime($lead->created_at)) ?? '' }} at
                                 {{ date('H:i:s', strtotime($lead->created_at)) ?? '' }}
                              </td>
                           </tr>
                           <tr>
                              <th>Created By</th>
                              <td>
                                 {{ $lead->createdBy->name }}
                              </td>

                              <th>Subject</th>
                              <td>
                                 {{ $lead->subject }}
                              </td>
                           </tr>
                           <tr>
                              <th>Message</th>
                              <td colspan="3">{{ $lead->message }}</td>
                           </tr>
                        </tbody>
                     </table>
                    </div>
                </div>
            </div>
         </div>

         @if ($lead->is_forwarded == 1)
         <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Comments and view by
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                     <table class="table table-clear dt-responsive">
                        <thead>
                           <th>Agency Name</th>
                           <th>Status</th>
                           <th>Move In Date</th>
                           <th>Comment</th>
                        </thead>
                        <tbody>
                           @foreach ($lead->forwardAgents as $key => $agent)
                           <tr>
                              <td>{{ $agent->agency->name }}</td>
                              <td>{{ $agent->status == 1 ? 'Read' : 'Un Read' }}</td>
                              <td>{{ $agent->move_in_date }}</td>
                              <td class="col-md-8">{{ $agent->comment }}</td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                    </div>
                </div>
            </div>
         </div> 
         @endif

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
