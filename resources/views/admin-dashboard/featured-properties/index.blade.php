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
                    <h4 class="card-title">Search Property</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('featuredproperties.index') }}" method="GET">
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search" value="{{ request('keyword') }}">
                                </div>
                                <div class="col-sm-2 mt-2 mt-sm-0">
                                    <select name="purpose" class="form-control">
                                        <option value="">{{ trans('words.property_purpose') }}</option>
                                        <option value="Sale" {{ request('purpose') == 'Sale' ? 'selected' : '' }}>
                                            Sale
                                        </option>
                                        <option value="Rent" {{ request('purpose') == 'Rent' ? 'selected' : '' }}>
                                            Rent
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-2 mt-2 mt-sm-0">
                                    <select name="status" id="basic" class="selectpicker show-tick form-control"
                                        data-live-search="false">
                                        <option value="">Select Status</option>
                                        <option value="1" {{ request('staus') == 1 ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="0" {{ request('staus') == 0 ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-2 mt-2 mt-sm-0">
                                    <select name="type" class="selectpicker show-tick form-control">
                                        <option value="">{{ trans('words.property_type') }}</option>
                                        @if (count($data['propertyTypes']) > 0)
                                            @foreach ($data['propertyTypes'] as $type)
                                                <option value="{{ $type->id }}" 
                                                    {{ request('type') == $type->id ? 'selected' : '' }}>
                                                    {{ $type->types }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-2 mt-2">
                                    <button type="submit" class="btn btn-dark btn-sm pull-left">
                                        {{ trans('words.search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Featured Properties</h4>
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
                                    <th>Health</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($propertieslist as $i => $property)
                                    @php
                                        $pUser = \App\User::where('id', $property->user_id)->first();
                                    @endphp
                                    <tr>
                                        @if ($loop->index == 4)
                                        @endif
                                        <td>{{ $property->id }}</td>
                                        <td>{{ $property->Agency->name ?? $property->user->name }}</td>

                                        <td>
                                            <a href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}">
                                                {{ $property->property_name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $property->property_type ? getPropertyTypeName($property->property_type)->types : '' }}
                                        </td>
                                        <td>{{ $property->property_purpose }}</td>
                                        <td class="text-center">
                                            {{ App\PageVisits::where('property_id', $property->id)->count() ?? 0 }}</td>
                                        <td>
                                            @if ($property->created_at !== null)
                                                <small>{{ date('d-m-Y', strtotime($property->created_at)) }}</small>
                                            @endif
                                        </td>
                                        <td class="text-center">90%</td>

                                        <td class="text-center">
                                            @if ($property->status == 1)
                                                <i class="fa fa-circle text-success mr-1"></i>
                                            @elseif ($property->status == 1 and $property->featured_property ==1)
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa fa-circle text-danger mr-1"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                @if ($property->user)
                                                    @if (Auth::User()->usertype == 'Admin')
                                                        <a href="Javascript:void(0);" class="dropdown-item"
                                                            data-toggle="modal"
                                                            data-target="#PropertyPlanModal"
                                                            data-propertyid="{{ $property->id }}"
                                                            id="changePlan_button"
                                                            >
                                                            <i class="fa fa-dollar"></i>
                                                            {{ trans('words.change_plan') }}
                                                        </a>
                                                    @endif

                                                    {{-- @if (Auth::User()->usertype == 'Admin') --}}
                                                        @if ($property->featured_property == 0)
                                                            <a href="{{ url('admin/properties/featuredproperty/' . Crypt::encryptString($property->id)) }}"
                                                                class="dropdown-item">
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
                                                    {{-- @endif --}}
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="10" class="text-center">
                                        {{ $propertieslist->render() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="PropertyPlanModal" tabindex="-1" role="dialog" aria-labelledby="PropertyPlanModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
    
                <div class="modal-header" style="padding: 10px">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Change Plan
                    </h5>
                </div>
    
                {!! Form::open(['url' => ['admin/properties/plan_update'], 'class' => '', 'name' => 'plan_form', 'id' => 'plan_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
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
    </script>
@endsection
