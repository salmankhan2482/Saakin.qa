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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Properties</h4>
                    <a href="{{ route('property.create') }}">
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
                                        <td>{{ $property->user->name ?? ''}}</td>
                                        <td>
                                            <a href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}">
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

                                       <td class="text-center">
                                            <div class="btn-group">
                                                
                                                <button type="button" class="btn btn-default-dark dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    {{ trans('words.action') }} 
                                                    <span class="caret"></span>
                                                </button>
                                                
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                    @if ($property->user)
                                                        @if (Auth::User()->usertype == 'Admin')
                                                            <li>
                                                                <a href="Javascript:void(0);" data-toggle="modal"
                                                                    data-target="#PropertyPlanModal{{ $property->id }}">
                                                                    <i class="fa fa-dollar"></i>
                                                                    {{ trans('words.change_plan') }}
                                                                </a>
                                                            </li>
                                                        @endif

                                                        <li>
                                                            <a href="{{ url('admin/properties/edit/' . $property->id) }}">
                                                                <i class="md md-edit"></i>
                                                                {{ trans('words.edit') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ url('admin/properties/gallery/' . $property->id) }}">
                                                                <i class="md md-edit"></i>
                                                                Gallery Images
                                                            </a>
                                                        </li>

                                                        @if (Auth::User()->usertype == 'Admin')
                                                            <li>
                                                                @if ($property->featured_property == 0)
                                                                    <a
                                                                        href="{{ url('admin/properties/featuredproperty/' . Crypt::encryptString($property->id)) }}">
                                                                        <i class="md md-star"></i>
                                                                        {{ trans('words.set_as_featured') }}
                                                                    </a>
                                                                @else
                                                                    <a
                                                                        href="{{ url('admin/properties/featuredproperty/' . Crypt::encryptString($property->id)) }}"><i
                                                                            class="md md-check"></i>
                                                                        {{ trans('words.unset_as_featured') }}</a>
                                                                @endif
                                                            </li>
                                                        @endif
                                                        
                                                        <li>
                                                            @if ($property->status == 1 && Auth::User()->usertype == 'Admin')
                                                                <a
                                                                    href="{{ url('admin/properties/status/' . Crypt::encryptString($property->id)) }}">
                                                                    <i class="md md-close"></i>
                                                                    {{ trans('words.unpublish') }}
                                                                </a>
                                                            @elseif($property->status == 0 && Auth::User()->usertype == 'Admin')
                                                                <a
                                                                    href="{{ url('admin/properties/status/' . Crypt::encryptString($property->id)) }}"><i
                                                                        class="md md-check"></i>
                                                                    {{ trans('words.publish') }}
                                                                </a>
                                                            @endif
                                                        </li>

                                                        <li>
                                                            @if ($property->status == 0 && Auth::User()->usertype != 'Admin')
                                                                <a href="{{ url('admin/properties/status/' . Crypt::encryptString($property->id)) }}">
                                                                    <i class="md md-check"></i>
                                                                    {{ trans('words.publish') }}
                                                                </a>
                                                            @endif
                                                        </li>

                                                    @else
                                                        <li>
                                                        <a href="{{ url('admin/properties/status/' . Crypt::encryptString($property->id)) }}">
                                                                <i class="md md-close"></i>
                                                                {{ trans('words.unpublish') }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if(Auth::User()->usertype == 'Admin')
                                                    <li>
                                                        <a href="{{ url('admin/properties/delete/' . Crypt::encryptString($property->id)) }}"
                                                                onclick="return confirm('{{ trans('words.dlt_warning_text') }}')"
                                                            >
                                                            <i class="md md-delete"></i> 
                                                            {{ trans('words.remove') }}
                                                        </a>
                                                    </li>
                                                    @elseif(Auth::User()->usertype != 'Admin' && $property->status == 1)
                                                    <li>
                                                        <a  href="#" 
                                                            class="callRemovePropertyPopup" 
                                                            data-id="{{Crypt::encryptString($property->id)}}"
                                                            data-toggle="modal" data-target="#removePropertyPopup"
                                                        >
                                                            <i class="md md-delete"></i> 
                                                            {{ trans('words.remove') }}
                                                        </a>
                                                    </li>
                                                    @endif
                                                </ul>
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
@endsection
