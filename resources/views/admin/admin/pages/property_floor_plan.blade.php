@extends("admin.admin_app")

@section("content")
<div id="main">

    <div class="page-header">
        <h2>@if(isset($floor_plan_id)) Edit @else Add @endif Floor Plan</h2>
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
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('flash_message') }}
        </div>
    @endif

    @if(isset($floor_plan_id))
        <div class="panel-body">
            <div class="col-md-8">
                {!! Form::open(array('url' => array('admin/properties/floor-plan/'.$property_id.'/edit/'.$floor_plan_id), 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Floor Name</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="floor_name" id="floor_name"  value="{{$propertyFloorPlan->floor_name}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Floor Size</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="floor_size" id="floor_size"  value="{{$propertyFloorPlan->floor_size}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Floor Rooms</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="floor_rooms" id="floor_rooms"  value="{{$propertyFloorPlan->floor_rooms}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Floor Bath Rooms</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="floor_bathrooms" id="floor_bathrooms"  value="{{$propertyFloorPlan->floor_bathrooms}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Floor Image</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="file" name="floor_image" id="floor_image" class="form-control" required>
                        </div>
                        <div class="col-sm-3">
                            @if(isset($propertyFloorPlan->floor_images))
                                <img src="{{ URL::asset('upload/floorplan/'.$propertyFloorPlan->floor_images) }}" width="100" alt="{{$propertyFloorPlan->floor_images}}">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4">
                            <label></label>
                        </div>
                        <div class="col-sm-8 ">
                            <button type="submit" class="btn btn-primary">{{ trans('words.submit') }}</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    @else
        <div class="panel-body">
            <div class="col-md-8">
                {!! Form::open(array('url' => array('admin/properties/floor-plan/'.$property_id.'/create'), 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                <div class="form-group">
                    <div class="col-sm-4">
                        <label>Floor Name</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="floor_name" id="floor_name"  value="" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label>Floor Size</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="floor_size" id="floor_size"  value="" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label>Floor Rooms</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="floor_rooms" id="floor_rooms"  value="" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label>Floor Bath Rooms</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" name="floor_bathrooms" id="floor_bathrooms"  value="" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label>Floor Image</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" name="floor_image" id="floor_image"  value="" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4">
                        <label></label>
                    </div>
                    <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary">{{ trans('words.submit') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endif








    <h2>{{$property_name}} Floor Plans</h2>

    <div class="panel panel-default panel-shadow">
        <div class="panel-body">

            <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Floor Name</th>
                        <th>Floor Size</th>
                        <th>Floor Rooms</th>
                        <th>Floor Bath Rooms</th>
                        <th>Floor Image</th>
                        <th class="text-center width-100">{{trans('words.action')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($floorPlans as $i => $floorPlan)
                        <tr>
                            <td>{{$floorPlan->floor_name}}</td>
                            <td>{{$floorPlan->floor_size}}</td>
                            <td>{{$floorPlan->floor_rooms}}</td>
                            <td>{{$floorPlan->floor_bathrooms}}</td>
                            <td><img src="{{URL::asset('upload/floorplan/'.$floorPlan->floor_images)}}" 
                                alt="{{ $floorPlan->floor_name }}" width="180" /></td>
                            <td class="text-center">
                                <a href="{{ url('admin/properties/floor-plan/'.$floorPlan->property_id.'/edit/'.$floorPlan->id) }}" class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5" data-toggle="tooltip" title="{{trans('words.edit')}}"> <i class="fa fa-edit"></i> </a>
                                <a href="{{ url('admin/properties/floor-plan/'.$floorPlan->property_id.'/delete/'.$floorPlan->id) }}" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="return confirm('{{trans('words.dlt_warning_text')}}')" data-toggle="tooltip" title="{{trans('words.remove')}}"> <i class="fa fa-remove"></i> </a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        <div class="clearfix"></div>
    </div>

</div>

@endsection
