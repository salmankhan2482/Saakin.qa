@extends("admin.admin_app")

@section('content')

    <div id="main">
        <div class="page-header">
            <h2> {{ trans('words.edit') . ' ' . trans('words.agency') }}</h2>
            <a href="{{ URL::to('admin/agencies') }}" class="btn btn-default-light btn-xs"><i class="md md-backspace"></i>
                {{ trans('words.back') }}</a>
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
                {!! Form::open(['url' => ['admin/agency/update/' . $agency->id], 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'update_agency', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.name') }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" value="{{ $agency->name }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Phone*</label>
                    <div class="col-sm-9">
                        <input type="text" name="phone" id="phone" value="{{ $agency->phone }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Whatsapp: * <small
                            style="font-size: 11px; color:#F00">(whatsapp number will be number only, no space, no plus
                            sign)</small></label>
                    <div class="col-sm-9">
                        <input type="number" name="whatsapp" id="whatsapp" value="{{ $agency->whatsapp }}"
                            class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Email *<small style="font-size: 11px; color:#F00">(email
                            will be agency login)</small></label>
                    <div class="col-sm-9">
                        <input type="hidden" name="oldemail" value="{{ $agency->email }}">
                        <input type="email" name="email" id="email" value="{{ $agency->email }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Password *</label>
                    <div class="col-sm-6">
                        <input type="text" name="password" id="passwordgenerator" value="{{ old('password') }}"
                            class="form-control">
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-success" onclick="makeid(10);">Generate Password</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Go Master Access Code</label>
                    <div class="col-sm-9">
                        <input type="text" name="access_code" id="access_code" value="{{ $agency->access_code }}"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Group Code</label>
                    <div class="col-sm-9">
                        <input type="text" name="group_code" id="group_code" value="{{ $agency->group_code }}"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Head Office*</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="head_office" id="head_office" rows="4"
                            class="form-control">{{ $agency->head_office }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Detail</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="detail" id="detail" rows="7"
                            class="form-control">{{ $agency->agency_detail }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Agency Image</label>
                    <div class="col-sm-5">
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <img src="{{ asset('upload/agencies/' . $agency->image) }}" alt="{{ $agency->image }}"
                            width="100%" />
                    </div>

                </div>


                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="button" id="add_update_Agency"
                            class="btn btn-primary">{{ trans('words.submit') }}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>

    </div>

@endsection
@section('scripts-custom')
    @php
    $image[] = ['id' => $agency->id, 'src' => url('/') . '/upload/agencies/' . $agency->image];
    $json_arry = json_encode($image);
    @endphp
    <script>
        $(function() {
            let preloaded = {!! $json_arry !!}
            $('.agency_image').imageUploader({
                maxFiles: 1,
                preloaded: preloaded,
                imagesInputName: 'agency_image',
                preloadedInputName: 'old',
                extensions: ['.jpg', '.jpeg', '.png', '.gif', '.svg'],
                mimes: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'],

            });
        });
        $('#update_agency').validate({
            rules: {
                "name": {
                    required: true
                },
                "phone": {
                    required: true
                },
                "head_office": {
                    required: true
                },
                "agency_image": {
                    required: true
                },
                "email": {
                    required: true,
                    email: true
                }
            },
            messages: {
                "name": {
                    required: 'Enter Agency Name'
                },
                "phone": {
                    required: 'Enter Phone Number'
                },
                "email": {
                    required: 'Enter Email'
                },
                "head_office": {
                    required: 'Enter Address'
                },
                "agency_image": {
                    required: 'upload Image'
                }
            }


        });
        $('#add_update_Agency').click(function() {
            if ($('#update_agency').valid()) {
                $('#update_agency').submit();
            }
        })
    </script>
@endsection
