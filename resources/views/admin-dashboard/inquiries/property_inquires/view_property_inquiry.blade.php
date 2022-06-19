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
                        <table id="example3" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Inquiry ID</th>
                                    <td>{{ $inquire->id }}</td>
                                </tr>
                                <tr>
                                    <th>Inquiry Type</th>
                                    <td>{{ $inquire->type }}</td>
                                </tr>
                                <tr>
                                    <th>Property ID</th>
                                    <td>{{ $inquire->property_id ??''}}</td>
                                </tr>
                                <tr>
                                    <th>Property Title</th>
                                    <td>
                                    @isset($property)
                                        <a href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}" target="_blank">
                                            {{ $property->property_name }}
                                        </a>
                                    @endisset    
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $inquire->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $inquire->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $inquire->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Agency Name</th>
                                    <td>{{ $inquire->Agencies->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Movin Date</th>
                                    <td>{{ $inquire->movein_date ?? '' }}</td>
                                </tr>
                                <tr> 
                                        <th>Message</th>
                                        <td>{{ $inquire->message }}</td>
                                    </tr>
                                    <tr> 
                                        <th>Sending Date</th>
                                        <td>
                                            {{ date('d-m-Y', strtotime($inquire->created_at)) ??'' }} at  {{ date('H:i:s', strtotime($inquire->created_at)) ??'' }}</td>
                                    </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($properties as $property)
              <div class="single-property-box border">
                <div class="property-item">
                  <a style="--img-container-height: 155px" class="property-img stretched-link" href="{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}">
                    @if ($property->featured_image)
                      <img src="{{ URL::asset('upload/properties/thumb_' . $property->featured_image) }}" alt="{{ $property->property_name }}">
                    @else
                      <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}" alt="{{ $property->property_name }}">
                    @endif
                  </a>
                  <ul class="feature_text">
                    @if ($property->featured_property == 1)
                      <li class="feature_cb"><span> Featured</span>
                      </li>
                    @endif
                    @if (!empty($property->property_purpose))
                      <li class="feature_or">
                        <span>{{ $property->property_purpose }}</span>
                      </li>
                    @endif

                  </ul>
                  <div class="property-author-wrap">
                    <div class="property-author">
                      <span>{{ $property->getPrice() }}
                        @if ($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent')
                          / Month
                        @endif
                      </span>
                    </div>
                  </div>
                </div>
                <div class="property-title-box" >
                  <a class="text-decoration-none stretched-link" href="{{ url(strtolower($property->property_purpose) . '/' . $propx->property_slug . '/' . $propx->id) }}">
                    <h5 class="property-card__property-title">
                      {{ \Illuminate\Support\Str::limit($property->property_name) }}
                    </h5>
                  </a> 
                  <div class="property-location">
                    <p>
                      {{ $property->propertiesTypes->types }}
                      <br>
                      <span class="hideAddress">
                        {{ $property->address }}
                      </span>
                    </p>
                  </div>

                  <ul class="property-feature">
                    @if ($property->getProperty_type())
                      <li class="me-1">
                        <i class="fas fa-bed fas-icon"></i>
                        <span>{{ $property->bedrooms }} </span>
                      </li>
                      <li class="me-1">
                        <i class="fas fa-bath fas-icon"></i>
                        <span>{{ $property->bathrooms }}
                        </span>
                      </li>
                    @endif
                    <li class="me-1">
                      <i class="fas fa-chart-area fas-icon"></i>
                      <span> {{ $property->getSqm() }} </span>
                    </li>
                  </ul>
                </div>
              </div>
            @endforeach
        
    </div>
@endsection
