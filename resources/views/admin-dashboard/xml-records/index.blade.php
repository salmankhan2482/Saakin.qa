{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <title>How To Upload And Save XML Data in Laravel 8 - Online Web Tutor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        #frm-create-post label.error{
            color:red;
        }
    </style>
</head>

<body>

    <div class="container" style="margin-top: 50px;">
        <h4 style="text-align: center;">How To Upload And Save XML Data in Laravel 8 - Online Web Tutor</h4>

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
        @endif

        <form action="{{ route('xml-upload') }}" id="frm-create-course" method="post">
           @csrf
            <div class="form-group">
                <label for="file">Select XML File:</label>
                <input type="text" class="form-control" required id="file" name="file" placeholder="Drop Link here">
            </div>

            <button type="submit" class="btn btn-primary" id="submit-post">Submit</button>
        </form>
    </div>
</body>

</html> --}}


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
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
    </div>
    @endif
<div class="container-fluid">
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Upload XML Feed</h4>
                    <a href="{{route('dashboard.index')}}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('xml-upload') }}" id="frm-create-course" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Agency</label>
                                    <select id="agency" name="agency" class="form-control">
                                        <option selected>Select Agency</option>
                                        @foreach($agencies as $agencies)
                                        <option value="{{$agencies->id}}">{{$agencies->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Agent</label>
                                    <select id="agent" name="agent" class="form-control">
                                        <option selected>Select Agent</option>
                                        {{-- @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endforeach --}}
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                 <label for="file">Select XML File:</label>
                                 <input type="text" class="form-control" required id="file" name="file" placeholder="Drop Link here">
                             </div>
                 
                             <button type="submit" class="btn btn-primary" id="submit-post">Submit</button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
