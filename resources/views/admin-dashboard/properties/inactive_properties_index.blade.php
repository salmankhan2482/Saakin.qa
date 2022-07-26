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
                    <h4 class="card-title">Inactive Properties</h4>
                    <a href="{{ route('properties.create') }}">
                        <button type="button" class="btn btn-rounded btn-info">
                            <span class="btn-icon-left text-info">
                                <i class="fa fa-plus color-info"></i>
                            </span>Add</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('inactive_properties.index') }}" method="GET">
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
                                    <a href="{{ route('inactive_properties.index') }}" class="btn btn-info btn-md pull-left">
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
                                        <td>{{ $property->id }}</td>
                                        <td>
                                            {{-- {{ $property->Agency->name ?? $property->user->name }} --}}
                                            <img src="{{ asset('upload/agencies/' . $property->Agency->image) }}"
                                            alt="{{ $property->Agency->name . '- agency image' }}" width="50" />
                                        </td>
                                        <td>
                                            <a href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}"
                                                target="_blank">
                                                {{ Str::limit($property->property_name, 30, '') }}
                                            </a>
                                        </td>
                                        <td> {{ $property->property_purpose }} </td>
                                        <td> {{ $property->property_type ? getPropertyTypeName($property->property_type)->types : '' }}
                                        </td>
                                        <td> {{ $property->getPrice() }} </td>
                                        <td> {{ App\PropertyCounter::where('property_id', $property->id)->value('counter') ?? 0 }}
                                        </td>
                                        <td>
                                            @if ($property->updated_at !== null)
                                                <small>{{ date('d-m-Y', strtotime($property->updated_at)) }}</small>
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
                                        </td>
                                        <td>
                                            <div class="btn-link" data-toggle="dropdown">
                                                <svg width="24px" height="24px">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24">
                                                        </rect>
                                                        <circle fill="#7e7e7e" cx="5" cy="12" r="2">
                                                        </circle>
                                                        <circle fill="#7e7e7e" cx="12" cy="12" r="2">
                                                        </circle>
                                                        <circle fill="#7e7e7e" cx="19" cy="12" r="2">
                                                        </circle>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="dropdown-menu">
                                                @if ($property->user)
                                                    <a href="{{ route('properties.edit', $property->id) }}"
                                                        class="dropdown-item">
                                                        <i class="fa fa-edit"></i> {{ trans('words.edit') }}
                                                    </a>

                                                    <a href="{{ url('admin/properties/gallery/' . $property->id) }}"
                                                        class="dropdown-item">
                                                        <i class="fa fa-edit"></i> Gallery Images
                                                    </a>

                                                    @if ($property->status == 1 && Auth::User()->usertype == 'Admin')
                                                        <a href="{{ route('properties.status', Crypt::encryptString($property->id)) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-close"></i> {{ trans('words.unpublish') }}
                                                        </a>
                                                    @elseif($property->status == 0 && Auth::User()->usertype == 'Admin')
                                                        <a href="{{ route('properties.status', Crypt::encryptString($property->id)) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-check"></i> {{ trans('words.publish') }}
                                                        </a>
                                                    @endif

                                                    @if ($property->status == 0 && Auth::User()->usertype != 'Admin')
                                                        <a href="{{ route('properties.status', Crypt::encryptString($property->id)) }}"
                                                            class="dropdown-item">
                                                            <i class="fa fa-check"></i> {{ trans('words.publish') }}
                                                        </a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('properties.status', Crypt::encryptString($property->id)) }}"
                                                        class="dropdown-item">
                                                        <i class="fa fa-close"></i> {{ trans('words.unpublish') }}
                                                    </a>
                                                @endif

                                                @if (Auth::User()->usertype == 'Admin')
                                                    <a href="{{ route('properties.destroy', Crypt::encryptString($property->id)) }}"
                                                        onclick="return confirm('{{ trans('words.dlt_warning_text') }}')"
                                                        class="dropdown-item">
                                                        <i class="fa fa-trash"></i>
                                                        {{ trans('words.remove') }}
                                                    </a>
                                                @elseif(Auth::User()->usertype != 'Admin')
                                                    <a href="#" class="callRemovePropertyPopup dropdown-item"
                                                        data-id="{{ Crypt::encryptString($property->id) }}"
                                                        data-toggle="modal" data-target="#removePropertyPopup">
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
@endsection
@section('scripts')
    <script>
        $(".callRemovePropertyPopup").on('click', function(e) {
            var id = $(this).attr('data-id');
            let url = "{{ route('properties.destroy', ':id') }}";
            url = url.replace(':id', id);
            $("#removePropertyPopupForm").attr('action', url);
        });
    </script>
@endsection
