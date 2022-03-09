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
                <a href="{{ route('users.index') }}">
                    <button type="button" class="btn btn-rounded btn-dark">Back</button>
                </a>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add User</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            {!! Form::open(['route' => 'users.store', 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Phone No.</label>
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>WhatsApp Number</label>
                                    <input type="text" id="whatsapp" name="whatsapp" class="form-control"
                                        placeholder="WhatsApp Number">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Email</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Password">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Profile Picture</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>About</label>
                                    <textarea type="text" rows="4" id="url" name="url" class="form-control"
                                        placeholder="Write Details"></textarea>
                                </div>
                            </div>
                            <hr />
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Facebook</label>
                                    <input type="text" id="icon" name="icon" class="form-control" placeholder="Link">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Twitter</label>
                                    <input type="text" id="icon" name="icon" class="form-control" placeholder="Link">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Instagram</label>
                                    <input type="text" id="icon" name="icon" class="form-control" placeholder="Link">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>LinkedIn</label>
                                    <input type="text" id="icon" name="icon" class="form-control" placeholder="Link">
                                </div>
                            </div>
                            <hr />
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Select User Type</label>
                                    <select name="usertype" id="basic" class="selectpicker show-tick form-control"
                                     data-live-search="true" onchange="toggleAgency(this.value);">
            
                                        <option value="Agents">{{ trans('words.agent') }}</option>
                                        <option value="User">{{ trans('words.user') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Assign Role*</label>
                                    <select name="roles[]" class="js-example-programmatic-multi" multiple="multiple">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Select Agency</label>
                                    @if(Auth::user()->usertype=='Agency')
                            <input type="hidden" name="agency_id" id="agency_id" class="form-control" value="{{Auth::user()->agency_id}}">
                            <input type="text" name="agency_" id="agency_" class="form-control" value="{{Auth::user()->agency->name}}" disabled>
                        @else
                        <select name="agency_id" id="agency_id" class="selectpicker show-tick form-control" data-live-search="true" >
                            <option value="" selected>Select Agency</option>
                            @foreach($agencies as $agency)
                                <option value="{{$agency->id}}">{{$agency->name}}</option>
                            @endforeach
                        </select>
                            @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>User Status</label>
                                    <select name="status" id="basic" class="selectpicker show-tick form-control"
                                        data-live-search="true">
                                        <option value="1">{{ trans('words.active') }}</option>
                                        <option value="0">{{ trans('words.inactive') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
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
    function toggleAgency(utype) {
        if (utype == "Agents") {
            document.getElementById("user_agency").style.display = "block";
        } else {
            document.getElementById("user_agency").style.display = "none";
        }
    }
</script>
