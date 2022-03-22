{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')
@section('style')
    <style>
        .table thead th {
            color: black;
            font-size: 0.95rem;
        }

        .pagination {
            list-style-type: none;
            display: flex;
            justify-content: center;
        }

        .page-item {
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
                    <h4 class="card-title">Search Property</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('featuredproperties.index') }}" method="GET">
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search">
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
                                    <th>{{ trans('words.action') }}</th>
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
                                            <a
                                                href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}">
                                                {{ $property->property_name }}
                                            </a>
                                        </td>
                                        <td>{{ $property->property_type ? getPropertyTypeName($property->property_type)->types : '' }}
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
                                                            data-target="#PropertyPlanModal{{ $property->id }}">
                                                            <i class="fa fa-dollar"></i>
                                                            {{ trans('words.change_plan') }}
                                                        </a>
                                                    @endif

                                                    @if (Auth::User()->usertype == 'Admin')
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
                                                    @endif
                                                @endif
                                            </div>
                                        </td>

                                    </tr>

                                    <div class="modal fade" id="PropertyPlanModal{{ $property->id }}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">{{ $property->property_name }}
                                                        {{ trans('words.property_plan') }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="panel-body">
                                                        {!! Form::open(['url' => ['admin/properties/plan_update'], 'class' => '', 'name' => 'plan_form', 'id' => 'plan_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                                                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>{{ trans('words.subscription_plan') }}</label>
                                                                <select id="plan_id" name="plan_id" class="form-control" required>
                                                                    <option value="1">Basic Plan</option>
                                                                    <option value="2">Premium Plan</option>
                                                                    <option value="3">Platinum Plan</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <p class="mb-1">Expiry Date</p>
                                                                <input name="property_exp_date"
                                                                    value="{{ $property->property_exp_date ? date('m/d/Y', $property->property_exp_date) : null }}"
                                                                    class="datepicker-default form-control" id="datepicker"
                                                                    placeholder="mm/dd/yyyy">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-primary">{{ trans('words.save_changes') }}</button>
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">{{ trans('words.close') }}</button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        {{-- {{ $propertieslist->render() }} --}}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="removePropertyPopup" tabindex="-1" role="dialog" aria-labelledby="removePropertyPopup"
        aria-hidden="true">

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
