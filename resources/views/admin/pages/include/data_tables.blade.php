<div class="panel-body table-responsive" style="min-height: 700px;">
    <table class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%" id="example">
        <thead>
            <tr>
                <th>{{ trans('words.property_id') }}</th>
                <th>{{ trans('words.user_name') }}</th>
                <th style=" width: 190px; ">{{ trans('words.property_name') }}</th>
                <th style=" width: 160px; ">{{ trans('words.type') }}</th>
                <th>{{ trans('words.purpose') }}</th>
                <th>{{ trans('words.view') }}</th>
                <th>{{ trans('words.create_date') }}</th>
                <th class="text-center">{{ trans('words.status') }}</th>
                <th class="text-center width-100">{{ trans('words.action') }}</th>
            </tr>
        </thead>

        <tbody>

            @if (count($propertieslist) > 0)
                @foreach ($propertieslist as $i => $property)
                    @php
                        $pUser = \App\User::where('id', $property->user_id)->first();
                    @endphp
                    <tr>
                        <td>{{ $property->id }}</td>
                        @if ($pUser)
                            <td>{{ $pUser->name }}</td>
                        @else
                            <td style="color:#F00 !important; font-weight:bold !important;">User Removed</td>
                        @endif
                        <td>
                            <a
                                href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}">
                                {{ $property->property_name }}
                            </a>
                        </td>
                        <td>
                            {{ $property->property_type ? getPropertyTypeName($property->property_type)->types : '' }}
                        </td>
                        <td>
                            {{ $property->property_purpose }}
                        </td>
                        <td>
                            {{ App\PageVisits::where('property_id', $property->id)->count() ?? 0 }}
                        </td>
                        <td>
                            @if ($property->created_at !== null)
                                {{ date('d-m-Y', strtotime($property->created_at)) }}
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($property->status == 1)
                                <span class="icon-circle bg-green">
                                    <i class="md md-check"></i>
                                </span>
                            @else
                                <span class="icon-circle bg-orange">
                                    <i class="md md-close"></i>
                                </span>
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
                                    @if ($pUser)
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
            @else
                <tr>
                    <td colspan="9">No Record Found</td>
                </tr>

            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9" class="text-center">
                    @include('admin.pagination', ['paginator' => $propertieslist])
                </td>
            </tr>
        </tfoot>
    </table>

      <!-- removePropertyPopup Modal -->
    
      <div class="modal fade" id="removePropertyPopup" tabindex="-1" role="dialog" aria-labelledby="removePropertyPopup" aria-hidden="true">
        
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        
            <div class="modal-header" style="padding: 10px">
            <h5 class="modal-title" id="exampleModalLongTitle">
                Reason to Inactive Property
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -23px">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            
            <form  method="POST" id="removePropertyPopupForm">
                @csrf
                {{-- admin/properties/delete/' . Crypt::encryptString($property->id)) --}}
                <div class="modal-body" style="padding: 10px">
                    <label for="reason" >
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


    <script>
        $(".callRemovePropertyPopup").on('click', function(e){
            var id = $(this).attr('data-id');
            $("#removePropertyPopupForm").attr('action', `properties/delete/${id}`);
        });
    </script>