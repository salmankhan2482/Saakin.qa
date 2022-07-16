{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Forwarded Property Inquiry</h4>
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
                                    <td>{{ $forwardLead->id }}</td>
                                </tr>
                                <tr>
                                    <th>Inquiry Type</th>
                                    <td>{{ $forwardLead->lead->type }}</td>
                                </tr>
                                <tr>
                                    <th>Property ID</th>
                                    <td>{{ $forwardLead->lead->property->id ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Property Title</th>
                                    <td>
                                        <a href="{{ url(strtolower($forwardLead->lead->property->property_purpose) . '/' . $forwardLead->lead->property->property_slug . '/' . $forwardLead->lead->property->id) }}"
                                            target="_blank">
                                            {{ $forwardLead->lead->property->property_name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $forwardLead->lead->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $forwardLead->lead->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $forwardLead->lead->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Agency Name</th>
                                    <td>{{ $forwardLead->lead->agency->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Movin Date</th>
                                    <td>{{ $forwardLead->lead->movein_date ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Message</th>
                                    <td>{{ $forwardLead->lead->message }}</td>
                                </tr>
                                <tr>
                                    <th>Sending Date</th>
                                    <td>
                                        {{ date('d-m-Y', strtotime($forwardLead->lead->created_at)) ?? '' }} at
                                        {{ date('H:i:s', strtotime($forwardLead->lead->created_at)) ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
