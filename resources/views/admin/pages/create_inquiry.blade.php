@extends("admin.admin_app")

@section('content')

    <div id="main">
        <div class="page-header">
            <h2> {{ trans('words.add') . ' ' . trans('words.inquiry') }}</h2>
            <a href="{{ URL::to('admin/property_inquiries') }}" class="btn btn-default-light btn-xs"><i
                    class="md md-backspace"></i> {{ trans('words.back') }}</a>
        </div>
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
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['url' => ['admin/inquiry/create'], 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Select Inquiry Type</label>
                    <div class="col-sm-9">
                        <select name="type" id="type" class="form-control" data-live-search="true"
                            onchange="toggleAgency(this.value);" required>
                            <option value="">Select Inquiry Type</option>
                            <option value="property_inquiry">Property Inquiry</option>
                            <option value="agency_inquiry">Agency Inquiry</option>
                            <option value="contact_inquiry">Contact Inquiry</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" placeholder="Enter Your Name" value=""
                            class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.email') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="email" id="email" placeholder="Enter Your Email" value=""
                            class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.phone_number') }}</label>
                    <div class="col-sm-9">
                        <input type="number" name="phone" id="phone" placeholder="+974 4023 0023" value=""
                            class="form-control">
                    </div>
                </div>
            <div id="agency_inquiry">
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.subject') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="subject" id="subject" placeholder="Subject" value=""
                                class="form-control" data-live-search="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Select {{ trans('words.agency') }}</label>
                        <div class="col-sm-9">
                                <select name="agency_name" id="agency_name" class="form-control">
                                    <option value="">Select Agencies</option>
                                    @foreach ($agencies as $agency)
                                        <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                </div>
            </div>

            <div id="contact_inquiry">
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.subject') }}</label>
                        <div class="col-sm-9">
                            <input type="text" name="subject" id="subject" placeholder="Subject" value=""
                                class="form-control" data-live-search="true">
                    </div>
                </div>
            </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="message" id="message" placeholder="Your Message" rows="7"
                            class="form-control"></textarea>
                    </div>
                </div>
            <div id="property_inquiry">
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.movein_date') }}</label>
                    <div class="col-sm-9">
                        <input type="date" name="movein_date" id="movein_date" placeholder="Move in Date" value=""
                            class="form-control" data-live-search="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Select {{ trans('words.agency') }}</label>
                        <div class="col-sm-9">
                                <select name="property_title" id="property_title" class="form-control">
                                    <option value="">Select Property</option>
                                    @foreach ($properties as $property)
                                        <option value="{{ $property->id }}">{{ $property->property_name }}</option>
                                    @endforeach
                                </select>
                        </div>
                </div>
            </div>
                

                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary">{{ trans('words.submit') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>


    </div>

@endsection
<script>
    function toggleAgency(type) {

        if (type == "property_inquiry") {
            document.getElementById("property_inquiry").style.display = "block";
        } else {
            document.getElementById("property_inquiry").style.display = "none";
        }


        if (type == "agency_inquiry") {
            document.getElementById("agency_inquiry").style.display = "block";
        } else {
            document.getElementById("agency_inquiry").style.display = "none";
        }

        if (type == "contact_inquiry") {
            document.getElementById("contact_inquiry").style.display = "block";
        } else {
            document.getElementById("contact_inquiry").style.display = "none";
        }

    }
</script>
