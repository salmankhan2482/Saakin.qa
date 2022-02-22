@extends("admin.admin_app")

@section("content")

<div id="main">
	<div class="page-header">
		<h2> {{ trans('words.add').' '.trans('words.inquiry') }}</h2>
		<a href="{{ URL::to('admin/inquiries') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i> {{trans('words.back')}}</a>
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
	 @if(Session::has('flash_message'))
        <div class="alert alert-success">
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span></button>
		    {{ Session::get('flash_message') }}
		</div>
	@endif

   	<div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(array('url' => array('admin/inquiry/create'), 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Select Inquiry Type</label>
                    <div class="col-sm-9">
                        <select name="type" id="type" class="form-control" required>
                            <option value="">Select Inquiry Type</option>
                            <option value="property_inquiry">Property Inquiry</option>
                            <option value="agency_inquiry">Agency Inquiry</option>
                            <option value="contact_inquiry">Contact Inquiry</option> 
                        </select>
                    </div>
                </div>
               

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.name')}}</label>
                      <div class="col-sm-9">
                        <input type="text" name="name" id="name" placeholder="Enter Your Name" value="" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.email')}}</label>
                      <div class="col-sm-9">
                        <input type="text" name="email" id="email" placeholder="Enter Your Email" value="" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="description" id="description" placeholder="Hi, I found your property on saakin.qa. Please contact me. Thank you." rows="7" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.phone_number')}}</label>
                      <div class="col-sm-9">
                        <input type="number" name="phone" id="phone" placeholder="+974 4023 0023" value="" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{trans('words.movein_date')}}</label>
                      <div class="col-sm-9">
                        <input type="date" name="movein_date" id="movein_date" placeholder="Move in Date"  value="" class="form-control">
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
<script type="text/javascript">
    $('#agency_inquiry').on('change',function(){
    $(".some").hide();
    var some = $(this).find('option:selected').val();
    $("#some_" + some).show();}); 
</script>
