@extends('admin-dashboard.layouts.master')
@section('style')
    <link href="{{ asset('admin/css/image-uploader.css') }}" type="text/css" rel="stylesheet" />
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
        <div class="page-titles">
            <ol class="breadcrumb">
                <a href="{{ route('agencies.index') }}">
                    <button type="button" class="btn btn-rounded btn-dark" style="padding: 0.5rem !important;">Back</button>
                </a>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ isset($gid) ? 'Edit ' : 'Add ' }} Gallery Image</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            @if (isset($gid))
                                <form action="{{ url('admin/properties/gallery/' . $property_id . '/edit/' . $gid) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            @if (isset($property_gallery_image->image_name))
                                                <img src="{{ URL::asset('upload/gallery/' . $property_gallery_image->image_name) }}"
                                                    width="100" alt="{{ $property_gallery_image->image_name }}">
                                            @endif
                                        </div>
                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                            <input type="file" name="gallery_image" id="gallery_image" value="" class="form-control">
                                        </div>
                                        
                                        <div class="col-sm-2 mt-2 mt-sm-0">
                                            <button type="submit" class="btn btn-dark  pull-right">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <form action="{{ url('admin/properties/gallery/' . $property_id . '/create') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-10 mt-2 mt-sm-0">
                                            <div class="input-images"></div>
                                        </div>
                                        
                                        <div class="col-sm-2 mt-2 mt-sm-0">
                                            <button type="submit" class="btn btn-dark  pull-right">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif
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
                                        <th>Gallery Images </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($galleryImages as $i => $galleryImage)
                                        <tr>
                                            <td>
                                                <img src="{{ URL::asset('upload/gallery/' . $galleryImage->image_name) }}"
                                                    alt="{{ $galleryImage->image_name }}" width="180" />
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('admin/properties/gallery/' . $galleryImage->property_id . '/delete/' . $galleryImage->id) }}" class="btn btn-danger"
                                                    onclick="return confirm('{{ trans('words.dlt_warning_text') }}')" >
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('assets/js/image-uploader.js')}}"></script>
<script>

    $('.input-images').imageUploader();
    $(document).ready(function() {
        $(".draggable").draggable();
    })
</script>
@endsection
