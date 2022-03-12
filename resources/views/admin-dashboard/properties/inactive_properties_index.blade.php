{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')
@section('style')
    <style>
        .table thead th{
            color: black;
            font-size: 0.95rem;
        }

        .pagination{
            list-style-type:none;
            display:flex;
            justify-content: center;
        }

        .page-item{
            display: list-item;
            padding: 5px 4px;
        }
    </style>
@endsection
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
                    <h4 class="card-title">Search Inactive Property</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('inactive_properties.index') }}" method="GET">
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search">
                                </div>
                                <div class="col-sm-2 mt-2 mt-sm-0">
                                    <select name="purpose" class="form-control">
                                        <option value="">{{ trans('words.property_purpose') }}</option>
                                        <option value="{{ trans('words.purpose_sale') }}">{{ trans('words.for_sale') }}</option>
                                        <option value="{{ trans('words.purpose_rent') }}">{{ trans('words.for_rent') }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 mt-2 mt-sm-0">
                                    <select name="status" id="basic" class="selectpicker show-tick form-control"
                                        data-live-search="false">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 mt-2 mt-sm-0">
                                    <select id="proeprty-type" name="type" class="selectpicker show-tick form-control" data-live-search="false">
                                        <option value="">{{ trans('words.property_type') }}</option>
                                        @if (count($data['propertyTypes']) > 0)
                                            @foreach ($data['propertyTypes'] as $type)
                                                <option value="{{ $type->id }}">{{ $type->types }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-2 mt-2 mt-sm-0">
                                    <button type="submit" class="btn btn-dark  pull-right">
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
                    <h4 class="card-title">Inactive Properties</h4>
                    <a href="{{ route('properties.create') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                        <span class="btn-icon-left text-info">
                            <i class="fa fa-plus color-info"></i>
                        </span>Add</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Agency Name</th>
                                    <th>Property Name</th>
                                    <th>Type</th>
                                    <th>Purpose</th>
                                    <th>Views</th>
                                    <th>Create Date</th>
                                    <th>Status</th>
                                    <th>{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['propertieslist'] as $i => $property)
                                    <tr>
                                        <td>{{ $property->id }}</td>
                                        <td>{{ $property->Agency->name ?? $property->user->name}}</td>
                                        <td>
                                            <a href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}" target="_blank"> 
                                                {{ $property->property_name }}
                                            </a>
                                        </td>
                                        <td> {{ $property->property_type ? getPropertyTypeName($property->property_type)->types : '' }} </td>
                                        <td> {{ $property->property_purpose }} </td>
                                        <td> {{ App\PageVisits::where('property_id', $property->id)->count() ?? 0 }} </td>
                                        <td>
                                             @if ($property->created_at !== null)
                                                {{ date('d-m-Y', strtotime($property->created_at)) }}
                                             @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($property->status == 1)
                                                <i class="fa fa-circle text-success mr-1"></i>
                                            @else
                                                <i class="fa fa-circle text-danger mr-1"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                @if ($property->user)
                                                    @if (Auth::User()->usertype == 'Admin')
                                                        <a href="Javascript:void(0);" class="dropdown-item" data-toggle="modal"
                                                            data-target="#PropertyPlanModal{{ $property->id }}">
                                                            <i class="fa fa-dollar"></i>
                                                            {{ trans('words.change_plan') }}
                                                        </a>
                                                    @endif

                                                    <a href="{{ route('properties.edit', $property->id) }}" class="dropdown-item">
                                                        <i class="fa fa-edit"></i> {{ trans('words.edit') }}
                                                    </a>

                                                    <a href="{{ url('admin/properties/gallery/' . $property->id) }}" class="dropdown-item">
                                                        <i class="fa fa-edit"></i> Gallery Images
                                                    </a>

                                                    @if (Auth::User()->usertype == 'Admin')
                                                        @if ($property->featured_property == 0)
                                                        <a href="{{ url('admin/properties/featuredproperty/' . Crypt::encryptString($property->id)) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-star"></i> {{ trans('words.set_as_featured') }}
                                                        </a>
                                                        @else
                                                        <a href="{{ url('admin/properties/featuredproperty/' . Crypt::encryptString($property->id)) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-check"></i> {{ trans('words.unset_as_featured') }}
                                                        </a>
                                                        @endif
                                                    @endif
                                                    
                                                    @if ($property->status == 1 && Auth::User()->usertype == 'Admin')
                                                    <a href="{{ route('properties.destroy', Crypt::encryptString($property->id)) }}" class="dropdown-item">
                                                        <i class="fa fa-close"></i> {{ trans('words.unpublish') }}
                                                    </a>
                                                    @elseif($property->status == 0 && Auth::User()->usertype == 'Admin')
                                                        <a href="{{ route('properties.destroy', Crypt::encryptString($property->id)) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-check"></i> {{ trans('words.publish') }}
                                                        </a>
                                                    @endif

                                                    @if ($property->status == 0 && Auth::User()->usertype != 'Admin')
                                                        <a href="{{ route('properties.destroy', Crypt::encryptString($property->id)) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-check"></i> {{ trans('words.publish') }}
                                                        </a>
                                                    @endif
                                                    
                                                @else
                                                    <a href="{{ route('properties.status', Crypt::encryptString($property->id)) }}" class="dropdown-item">
                                                        <i class="fa fa-close"></i> {{ trans('words.unpublish') }}
                                                    </a>
                                                @endif

                                                @if(Auth::User()->usertype == 'Admin')
                                                <a href="{{ route('properties.destroy', Crypt::encryptString($property->id)) }}"
                                                        onclick="return confirm('{{ trans('words.dlt_warning_text') }}')" class="dropdown-item">
                                                        <i class="fa fa-trash"></i> 
                                                        {{ trans('words.remove') }}
                                                    </a>
                                                @elseif(Auth::User()->usertype != 'Admin' && $property->status == 1)
                                                    <a  href="#" class="callRemovePropertyPopup" class="dropdown-item"
                                                        data-id="{{Crypt::encryptString($property->id)}}"
                                                        data-toggle="modal" data-target="#removePropertyPopup"
                                                    >
                                                        <i class="fa fa-trash"></i> 
                                                        {{ trans('words.remove') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
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
@endsection
@section('scripts')
<script>
    $(".callRemovePropertyPopup").on('click', function(e) {
        var id = $(this).attr('data-id');
        $("#removePropertyPopupForm").attr('action', `properties/delete/${id}`);
    });
</script>
@endsection
