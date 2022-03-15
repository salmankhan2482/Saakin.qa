@extends('admin-dashboard.layouts.master')
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
        <div class="page-titles">
            <ol class="breadcrumb">
                <a href="{{ route('property_inquiries') }}">
                    <button type="button" class="btn btn-rounded btn-dark">Back</button>
                </a>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Inquiry</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => 'store_proprty_inquiry', 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Inquiry Type</label>
                                    <select id="type" name="type" class="form-control" data-live-search="true"
                                        onchange="toggleAgency(this.value);" required>
                                        <option value="">Select Inquiry Type</option>
                                        <option value="Property-Inquiry">Property Inquiry</option>
                                        <option value="Agency-Inquiry">Agency Inquiry</option>
                                        <option value="Contact-Inquiry">Contact Inquiry</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Enter Your Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Email</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                        placeholder="Enter Your Email Address">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Phone Number</label>
                                    <input type="text" id="phone" name="phone" class="form-control"
                                        placeholder="+974 4023 0023">
                                </div>
                            </div>
                            <div id="Agency-Inquiry">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Subject</label>
                                        <input type="text" id="subject" name="subject" class="form-control"
                                            placeholder="Subject">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Agencies</label>
                                        <select id="agency_name" name="agency_name" class="form-control">
                                            <option value="">Select Agency</option>
                                            @foreach ($agencies as $agency)
                                                <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="Contact-Inquiry">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Subject</label>
                                        <input type="text" id="subject" name="subject" class="form-control"
                                            placeholder="Subject">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <textarea type="text" rows="5" id="message" name="message" class="form-control" placeholder="Your Message"></textarea>
                                </div>
                            </div>
                        </div>
                        <div id="Property-Inquiry">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Move in Date </label>
                                    <input type="date" id="movein_date" name="movein_date" class="form-control"
                                        placeholder="Move in Date">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Properties</label>
                                    <select id="property_title" name="property_title" class="form-control">
                                        <option value="">Select Property</option>
                                        @foreach ($properties as $property)
                                            <option value="{{ $property->id }}">{{ $property->property_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-primary">Save</button>
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
<script>
    function toggleAgency(type) {

        if (type == "Property-Inquiry") {
            document.getElementById("Property-Inquiry").style.display = "block";
        } else {
            document.getElementById("Property-Inquiry").style.display = "none";
        }


        if (type == "Agency-Inquiry") {
            document.getElementById("Agency-Inquiry").style.display = "block";
        } else {
            document.getElementById("Agency-Inquiry").style.display = "none";
        }

        if (type == "Contact-Inquiry") {
            document.getElementById("Contact-Inquiry").style.display = "block";
        } else {
            document.getElementById("Contact-Inquiry").style.display = "none";
        }

    }
</script>