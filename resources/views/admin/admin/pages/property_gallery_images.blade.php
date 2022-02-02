@extends("admin.admin_app")

@section("content")
<div id="main">

    <div class="page-header">
        @if(isset($gid))
            <div class="pull-right">
                <a href="{{URL::to('admin/properties/gallery/'.$property_id)}}" class="btn btn-primary">Add Gallery Image <i class="fa fa-plus"></i></a>
            </div>
        @endif

        <h2>@if(isset($gid)) Edit @else Add @endif Gallery Image</h2>
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

    @if(isset($gid))
        <div class="panel-body">
            <div class="col-md-6">
                {!! Form::open(array('url' => array('admin/properties/gallery/'.$property_id.'/edit/'.$gid), 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                    <div class="form-group">
                        <div class="col-sm-9 col-md-6">

                            <input type="file" name="gallery_image" id="gallery_image"  value="" class="form-control">
                        </div>
                        <div class="col-sm-3 col-md-3">


                            @if(isset($property_gallery_image->image_name))
                                <img src="{{ URL::asset('upload/gallery/'.$property_gallery_image->image_name) }}" width="100" alt="{{$property_gallery_image->image_name}}">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                            <button type="submit" class="btn btn-primary">{{ trans('words.submit') }}</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    @else
        <div class="panel-body">
            <div class="col-md-12">
                {!! Form::open(array('url' => array('admin/properties/gallery/'.$property_id.'/create'), 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                <div class="form-group">
                    <div class="col-lg-12">
                        <div class="input-images"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ trans('words.submit') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endif








    <h2>{{$property_name}} Gallery Images</h2>

    <div class="panel panel-default panel-shadow">
        <div class="panel-body">

            <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Gallery Image</th>
                        <th class="text-center width-100">{{trans('words.action')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($galleryImages as $i => $galleryImage)
                        <tr class="draggable">
                            <td>
                                <img src="{{URL::asset('upload/gallery/'.$galleryImage->image_name)}}" alt="{{ $galleryImage->image_name }}" width="180" />
                            </td>
                            <td class="text-center">
                                <a href="{{ url('admin/properties/gallery/'.$galleryImage->property_id.'/delete/'.$galleryImage->id) }}" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="return confirm('{{trans('words.dlt_warning_text')}}')" data-toggle="tooltip" title="{{trans('words.remove')}}"> <i class="fa fa-remove"></i> 
                                </a>
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
@section('scripts-custom')
    <script>
        $('.input-images').imageUploader();
        $(document).ready(function(){
            $( ".draggable" ).draggable();
        })
    </script>
    @endsection
