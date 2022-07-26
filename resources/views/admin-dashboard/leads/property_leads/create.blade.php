@extends('admin-dashboard.layouts.master')
@section('style')
<link rel="stylesheet" href="{{ asset('admin/css/js-example-basic-multiple.css') }}">
<style>
   .select2-selection--multiple{
      height: auto !important;
   }
</style>
@endsection
@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('flash_message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('flash_message') }}
        </div>
    @endif
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Inquiry</h4>
                        <a href="{{ url()->previous() }}">
                            <button type="button" class="btn btn-rounded btn-info">
                              <i class="fa fa-arrow-left"></i>Back
                           </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => 'store_proprty_inquiry', 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                              <div class="form-row">
                                 <div class="form-group col-md-6">
                                       <label>Agency Name</label>
                                       <select name="agency_id" id="agency_select" class="form-control">
                                          <option value="">Select Agency</option>
                                          @foreach ($data['agenices'] as $agency)
                                             <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                          @endforeach
                                       </select>
                                 </div>
                                 <div class="form-group col-md-6">
                                       <label>Agent Name</label>
                                       <select name="agent_id" id="agents_select" class="form-control">
                                          <option value="">Select Agent</option>
                                       </select>
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label>Reference ID</label>
                                    <input type="text" id="reference_id" name="reference_id" class="form-control" placeholder="Enter Your Reference ID">
                                 </div>
                                 <div class="form-group col-md-6">
                                       <label>Property Name</label>
                                       <input class="typeahead form-control" id="property_name" type="text" name="property_title">
                                       <input type="hidden" name="property_id" id="property_id">
                                 </div>
                                 <div class="form-group col-md-6">
                                       <label>Property Purpose</label>
                                       <select class="form-control" name="property_purpose" id="property_purpose" required>
                                          <option value="">{{ trans('words.property_purpose') }}</option>
                                          @foreach ($data['purposes'] as $purpose)
                                             <option value="{{ $purpose->name }}">{{ $purpose->name }}</option>
                                          @endforeach
                                       </select>
                                 </div>
                                 <div class="form-group col-md-6">
                                       <label>Property Type</label>
                                       <select class="form-control" id="property_type" name="property_type" required>
                                          <option value="">{{ trans('words.property_type') }}</option>
                                          @foreach ($data['types'] as $type)
                                                <option value="{{ $type->id }}"
                                                   @if (old('property_type') == $type->id) selected @endif>
                                                   {{ $type->types }}
                                                </option>
                                          @endforeach
                                       </select>
                                 </div>
                                 <div class="form-group col-md-3">
                                       <label>Bedrooms</label>
                                       <input type="number" name="bedrooms" class="form-control" id="bedrooms" min="0"
                                          placeholder="{{ trans('words.bedroom') }}">
                                 </div>
                                 <div class="form-group col-md-3">
                                       <label>Budget</label>
                                       <input type="number" name="price" class="form-control" id="price" min="0"
                                          placeholder="{{ trans('words.price') }}" value="{{ old('price') }}" required>
                                 </div>
                                 <div class="form-group col-md-3">
                                       <label>Property Size</label>
                                       <input type="number" name="land_area" class="form-control" id="land_area" min="0"
                                          placeholder="{{ trans('words.land_area') }}">
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label>Move in Date </label>
                                    <input type="date" id="movein_date" name="movein_date" class="form-control"
                                       placeholder="Move in Date">
                                 </div>
                                 <div class="form-group col-md-6">
                                       <label>City</label>
                                       <select name="city" id="city" class="form-control" onchange="callSubCityTown(this);">
                                          <option value="">Select City</option>
                                          @foreach ($data['cities'] as $city)
                                             <option value="{{ $city->id }}"
                                                   {{ old('city') == $city->id ? 'selected' : '' }}>
                                                   {{ $city->name }}
                                             </option>
                                          @endforeach
                                       </select>
                                 </div>
                                 <div class="form-group col-md-6">
                                       <label>Sub City</label>
                                       <select name="subcity" id="subcity" class="form-control" onchange="callTown(this);">
                                          <option value="">Select Sub City</option>
                                       </select>
                                 </div>
                                 <div class="form-group col-md-6">
                                       <label>Town</label>
                                       <select name="town" id="town" class="form-control" onchange="callArea(this);">
                                          <option value="">Select Town</option>
                                       </select>
                                 </div>
                                 <div class="form-group col-md-6">
                                       <label>Area</label>
                                       <select name="area" id="area" class="form-control">
                                          <option value="">Select Area</option>
                                       </select>
                                 </div>
                              </div>
                              <div class="form-row">
                                 <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name of User">
                                 </div>
                                 <div class="form-group col-md-6">
                                       <label>Email</label>
                                       <input type="text" id="email" name="email" class="form-control" placeholder="Enter Your Email Address">
                                 </div>
                                 <div class="form-group col-md-6">
                                       <label>Phone Number</label>
                                       <input type="tel" id="phone" name="phone" class="form-control"
                                          placeholder="974-00-1234"  required>
                                 </div>  
                                 <div class="form-group col-md-6">
                                       <label>Time Frame</label>
                                       <input type="text" name="time_frame" class="form-control" id="p-time_frame"
                                          placeholder="2 Weeks">
                                 </div>
                                 <div class="form-group col-md-6">
                                       <label>Source</label>
                                       <select name="source" id="source" class="form-control">
                                          <option value="Social Media">Social Media</option>
                                          <option value="Friends">Friends</option>
                                          <option value="Website">Website</option>
                                       </select>
                                 </div>
                                 <div class="form-group col-md-6">
                                       <label>Subject</label>
                                       <input type="text" name="subject" class="form-control" id="subject" placeholder="PROPERTY INVESTMENT">
                                 </div>
                              </div>
                              <div class="form-row">
                                 <div class="form-group col-md-12">
                                       <label>Message</label>
                                       <textarea type="text" rows="5" id="message" name="message" class="form-control" placeholder="Your Message"></textarea>
                                 </div>
                              </div>
                              
                             <div class="form-row">
                                 <div class="form-group col-md-12">
                                     <label>&nbsp;</label><br>
                                     <button type="submit" class="btn btn-rounded btn-success">Save</button>
                                 </div>
                             </div>
                        </div>
                        
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
 
@endsection

@section('scripts')
   <script src="{{ URL::asset('admin/js/jquery.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   <script>
      
      $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
               placeholder: "Select Forward Agents"
            });
      });

      $(document).on('change','#agency_select', function () {
         var id = $(this).val();
         $.ajax({
            type: "GET",
            url: "{{ route('callAgents') }}",
            async: true,
            data: {
               id: id // as you are getting in request('id') 
            },
            success: function(response) {
               var agents = response;

               clearEveryThing('', '', 'agents_select');
               if (agents == '<option value="">No Result Found</option>') {
                  $("#agents_select").append('<option value="">No Result Found</option>');
               } else {
                  $.each(agents, function(key, value) {
                     $("#agents_select").append('<option value="' + value.id + '">' + value.name + '</option>');
                  });
                  $("#agents_select").append('<option value="">Select Agent</option>');
               }

            }
         });
      });

      function callSubCityTown(data) {
         var id = data.value;
         $.ajax({
               type: "GET",
               url: "{{ route('callSubCityTown') }}",
               async: true,
               data: {
                  id: id // as you are getting in request('id') 
               },
               success: function(response) {
                  var subcities = response['subcities'];
                  var towns = response['towns'];
                  var areas = response['areas'];

                  clearEveryThing('subcity', 'town', 'area');
                  if (subcities == '<option value="">No Result Found</option>') {
                     $("#subcity").append('<option value="">No Result Found</option>');
                  } else {
                     $.each(subcities, function(key, value) {
                        $("#subcity").append('<option value="' + value.id + '">' + value.name + '</option>');
                     });
                     $("#subcity").append('<option value="">Select Sub City</option>');
                  }

                  if (towns === '<option value="">No Result Found</option>') {
                     $("#town").append('<option value="">No Result Found</option>');
                  } else {
                     $.each(towns, function(key, value) {
                           $("#town").append('<option value="' + value.id + '">' + value.name + '</option>');
                     });
                     $("#town").append('<option value="">Select Town</option>');
                  }

                  if (areas === '<option value="">No Result Found</option>') {
                     $("#area").append('<option value="">No Result Found</option>');
                  } else {
                     $("#area").empty();
                     $.each(areas, function(key, value) {
                        $("#area").append('<option value="' + value.id + '">' + value.name +'</option>');
                     });
                     $("#area").append('<option value="">Select Area</option>');
                  }
               }
         });

      }

      function callTown(data) {
         var id = data.value;

         $.ajax({
               type: "GET",
               url: "{{ route('callTown') }}",
               async: true,
               data: {
                  id: id // as you are getting in request('id') 
               },
               success: function(response) {
                  var subcities = response['subcities'];
                  var towns = response['towns'];
                  var areas = response['areas'];

                  clearEveryThing('', 'town', 'area');

                  if (towns == '<option value="">No Result Found</option>') {
                     $("#town").append('<option value="">No Result Found</option>');
                  } else {
                     $.each(towns, function(key, value) {
                        $("#town").append('<option value="' + value.id + '">' + value.name +'</option>');
                     });
                     $("#town").append('<option value="">Select Town</option>');
                  }

                  if (areas == '<option value="">No Result Found</option>') {
                     $("#area").append('<option value="">No Result Found</option>');
                  } else {
                     $.each(areas, function(key, value) {
                        $("#area").append('<option value="' + value.id + '">' + value.name +'</option>');
                     });
                     $("#area").append('<option value="">Select Area</option>');
                  }

               }
         });

      }

      function callArea(data) {
         var id = data.value;
         var pre = $("#subcity").val();

         $.ajax({
               type: "GET",
               url: "{{ route('callArea') }}",
               async: true,
               data: {
                  id: id, // as you are getting in request('id') 
                  pre: pre
               },
               success: function(response) {
                  var areas = response['areas'];
                  var subcities = response['subcities'];
                  var towns = response['towns'];
                  console.log(subcities);
                  clearEveryThing('', '', 'area');

                  if (areas === '<option value="">No Result Found</option>') {
                     $("#area").append('<option value="">No Result Found</option>');
                  } else if (areas === '<option value="">No Result Found</option>') {
                     $("#town").append('<option value="">No Result Found</option>');
                  } else {
                     $("#area").empty();
                     $.each(areas, function(key, value) {
                        $("#area").append('<option value="' + value.id + '">' + value.name + '</option>');
                     });
                     $("#area").append('<option value="">Select Area</option>');
                  }

               }
         });

      }

      function clearEveryThing(subcity, town, area) {
         $(`#${subcity}`).empty();
         $(`#${town}`).empty();
         $(`#${area}`).empty();
      }

      $(document).on('blur', '#reference_id', function () {
         var referenceID = $(this).val();
         $.ajax({
            type: "GET",
            url: "{{ route('fetchPropertyByReference') }}",
            async: true,
            data: {
               referenceID: referenceID, // as you are getting in request('id') 
            },
            success: function (data) {
               if(data == false){
                  $("#reference_id").addClass('border border-danger');
               }else{
                  $("#reference_id").removeClass('border border-danger');
                  $("#property_name").val(data.property.property_name);
                  $("#property_name,  #bedrooms, #price, #land_area").prop('readonly', true);
                  $("#property_id").val(data.property.id);
                  $("#property_purpose").html(`${data.property_purpose}`);
                  $("#property_type").html(`${data.property_type}`);
                  $("#bedrooms").val(data.property.bedrooms);
                  $("#price").val(data.property.price);
                  $("#land_area").val(data.property.land_area);
                  $("#city").html(`${data.city}`);
                  $("#subcity").html(`${data.subcity}`);
                  $("#town").html(`${data.town}`);
                  $("#area").html(`${data.area}`);
               }
            }
         });
      });
   </script>
@endsection
