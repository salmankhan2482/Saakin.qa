{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        @if (Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Properties</h4>
                    @can('properties-create')
                        <a href="{{ route('properties.create') }}">
                           <button type="button" class="btn btn-rounded btn-info">
                              <span class="btn-icon-left text-info">
                                 <i class="fa fa-plus color-info"></i>
                              </span>Add
                           </button>
                        </a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ url('admin/properties') }}" method="GET">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search"
                                        value="{{ request('keyword') }}">
                                </div>
                                <div class="col-sm-2 mt-2 mt-sm-0">
                                    <select name="purpose" class="form-control">
                                        <option value="">Property Purpose</option>
                                        <option value="Sale" {{ request('purpose') == 'Sale' ? 'selected' : '' }}>Sale
                                        </option>
                                        <option value="Rent" {{ request('purpose') == 'Rent' ? 'selected' : '' }}>Rent
                                        </option>
                                    </select>
                                </div>

                                <div class="col-sm-2 mt-2 mt-sm-0">
                                    <select id="proeprty-type" name="type" class="selectpicker show-tick form-control"
                                        data-live-search="false">
                                        <option value="">{{ trans('words.property_type') }}</option>
                                        @foreach ($data['propertyTypes'] as $type)
                                            <option value="{{ $type->id }}"
                                                {{ request('type') == $type->id ? 'selected' : '' }}>
                                                {{ $type->types }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2 mt-1">
                                    <button type="submit" class="btn btn-dark btn-md pull-left">
                                        {{ trans('words.search') }}
                                    </button>
                                    <a href="{{ url('admin/properties') }}" class="btn btn-info btn-md pull-left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Agency</th>
                                    <th>Property Title</th>
                                    <th>Purpose</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Views</th>
                                    <th>Updated</th>
                                    <th>Health</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['propertieslist'] as $i => $property)
                                    <tr>
                                        <td>
                                          {{ $property->id }}
                                       </td>
                                        <td>
                                            <img src="{{ asset('upload/agencies/' . $property->Agency->image) }}"
                                                alt="{{ $property->Agency->name . '- agency image' }}" width="50" />
                                        </td>
                                        <td>
                                            <a href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}" target="_blank">
                                                {{ Str::limit($property->property_name, 30, '') }}
                                            </a>
                                        </td>
                                        <td> {{ $property->property_purpose }} </td>
                                        <td>
                                            {{ $property->propertiesTypes->types ?? '' }}
                                        </td>
                                        <td> 
                                          {{ $property->getPrice() }} 
                                       </td>
                                       <td> 
                                       {{ App\PropertyCounter::where('property_id', $property->id)->value('counter') ?? 0 }}
                                       </td>
                                       <td>
                                          @if ($property->updated_at !== null)
                                             {{ date('d-m-Y', strtotime($property->updated_at)) }}
                                          @endif
                                       </td>
                                       <td class="text-center">
                                          <span class="badge badge-rounded badge-success">90%</span>
                                       </td>
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
                                        <td class="text-center">
                                            <div class="dropdown ml-auto">
                                                <div class="btn-link" data-toggle="dropdown">
                                                    <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <circle fill="#7e7e7e" cx="5" cy="12" r="2"></circle>
                                                            <circle fill="#7e7e7e" cx="12" cy="12" r="2"></circle>
                                                            <circle fill="#7e7e7e" cx="19" cy="12" r="2"></circle>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="dropdown-menu">
                                                   @can('change-properties-plan')
                                                         <a href="Javascript:void(0);" class="dropdown-item"
                                                            data-toggle="modal" data-target="#PropertyPlanModal"
                                                            data-propertyid="{{ $property->id }}" id="changePlan_button">
                                                            <i class="fa fa-dollar"></i>
                                                            {{ trans('words.change_plan') }}
                                                         </a>
                                                   @endcan

                                                   @can('properties-edit')
                                                      <a href="{{ route('properties.edit', $property->id) }}"
                                                      class="dropdown-item">
                                                         <i class="fa fa-edit"></i> {{ trans('words.edit') }}
                                                      </a>
                                                   @endcan

                                                   @can('gallery-images-edit')
                                                      <a href="{{ url('admin/properties/gallery/' . $property->id) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-edit"></i>
                                                            Gallery Images
                                                      </a>
                                                   @endcan
                                                                                                            
                                                   @can('add-remove-featured-properties')
                                                      @if ($property->featured_property == 0)
                                                            <a href="{{ url('admin/properties/featuredproperty/' . Crypt::encryptString($property->id)) }}" class="dropdown-item">
                                                               <i class="fa fa-star"></i>
                                                               {{ trans('words.set_as_featured') }}
                                                            </a>
                                                      @else
                                                            <a href="{{ url('admin/properties/featuredproperty/' . Crypt::encryptString($property->id)) }}"
                                                               class="dropdown-item">
                                                               <i class="fa fa-check"></i>
                                                               {{ trans('words.unset_as_featured') }}
                                                            </a>
                                                      @endif
                                                   @endcan

                                                   @can('properties-publish-unpublish')
                                                      @if ($property->status == 1)
                                                         <a href="{{ route('properties.status', Crypt::encryptString($property->id)) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-close"></i> {{ trans('words.unpublish') }}
                                                         </a>
                                                      @elseif($property->status == 0)
                                                            <a href="{{ route('properties.status', Crypt::encryptString($property->id)) }}"
                                                               class="dropdown-item">
                                                               <i class="fa fa-check"></i>
                                                               {{ trans('words.publish') }}
                                                            </a>
                                                      @endif

                                                      {{-- @if (Auth::User()->usertype == 'Admin')
                                                        <a href="{{ route('properties.destroy', Crypt::encryptString($property->id)) }}"
                                                            onclick="return confirm('{{ trans('words.dlt_warning_text') }}')"
                                                            class="dropdown-item">
                                                            <i class="fa fa-trash"></i>
                                                            {{ trans('words.remove') }}
                                                        </a>
                                                      @elseif(Auth::User()->usertype != 'Admin' && $property->status == 1)
                                                         <a href="javascript::void()"
                                                               class="callRemovePropertyPopup dropdown-item"
                                                               data-id="{{ Crypt::encryptString($property->id) }}"
                                                               data-toggle="modal" data-target="#removePropertyPopup">
                                                               <i class="fa fa-trash"></i>
                                                               {{ trans('words.remove') }}
                                                         </a>
                                                      @endif --}}
                                                   @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="10" class="text-center">
                                        {{ $data['propertieslist']->render() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="removePropertyPopup" tabindex="-1" role="dialog"
        aria-labelledby="removePropertyPopup" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header" style="padding: 10px">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Reason to Inactive Property
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="margin-top: -23px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" id="removePropertyPopupForm">
                    @csrf
                    <div class="modal-body" style="padding: 10px">
                        <label for="reason">
                            Select Reason
                        </label>

                        <select name="reason" id="reason" class="form-control">
                            <option value="Rented/Sold">Rented/Sold</option>
                            <option value="Unavailable">Unavailable</option>
                            <option value="Inactive">Inactive</option>
                        </select>

                    </div>
                    <div class="modal-footer" style="padding: 10px">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="PropertyPlanModal" tabindex="-1" role="dialog" aria-labelledby="PropertyPlanModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header" style="padding: 10px">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Change Plan
                    </h5>
                </div>

                {!! Form::open([
                    'url' => ['admin/properties/plan_update'],
                    'class' => '',
                    'name' => 'plan_form',
                    'id' => 'plan_form',
                    'role' => 'form',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <input type="hidden" id="hidden_property_id" name="property_id" value="">
                <div class="modal-body" style="padding: 10px">
                    <div class="row">
                        <div class="col-6">
                            <label>{{ trans('words.subscription_plan') }}</label>
                            <select id="plan_id" name="plan_id" class="form-control" required>
                                <option value="1">Basic Plan</option>
                                <option value="2">Premium Plan</option>
                                <option value="3">Platinum Plan</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Expiry Date</label>
                            <input type="date" name="property_exp_date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="padding: 10px">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).on("click", "#changePlan_button", function() {
            var id = $(this).attr('data-propertyId');
            $('#hidden_property_id').val(id);
        });

        $(".callRemovePropertyPopup").on('click', function(e) {
            var id = $(this).attr('data-id');
            $("#removePropertyPopupForm").attr('action', `properties/delete/${id}`);
        });
    </script>
@endsection
