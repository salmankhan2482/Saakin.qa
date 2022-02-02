@extends("admin.admin_app")

@section('content')

    <div id="main">
        <div class="page-header">
            <h2> {{ trans('words.add') . ' ' . trans('words.page_content') }}</h2>
            <a href="{{ URL::to('admin/landing-pages') }}" class="btn btn-default-light btn-xs"><i
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
                {!! Form::open(['url' => ['admin/landing-pages/update/' . $landing_page_content->id], 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'add_property_content', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.property_purpose') }}</label>
                    <div class="col-sm-9">
                        <select name="property_purpose" id="property_purpose" class="form-control" disabled>
                            <option value="">Select property Purpose</option>
                            @foreach ($property_purposes as $property_purpose)
                                <option value="{{ $property_purpose->id }}" @if ($landing_page_content->property_purposes_id == $property_purpose->id) selected @endif>
                                    {{ $property_purpose->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <input name="property_purpose" id="property_purpose" class="form-control"
                    value="{{ $landing_page_content->PropertyPurposes->id ?? '' }}" type="hidden"></input>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.property_purpose') }}</label>
                    <div class="col-sm-9">
                        <select name="property_type" id="property_type" class="form-control" disabled>
                            <option value="">Select property Type</option>
                            @foreach ($property_types as $property_type)
                                <option value="{{ $property_type->id }}" @if ($landing_page_content->property_types_id == $property_type->id) selected @endif>
                                    {{ $property_type->types }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <input name="property_type" id="property_type" class="form-control"
                    value="{{ $landing_page_content->PropertyTypes->id ?? '' }}" type="hidden"></input>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Page Content</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="page_content" id="page_content" rows="7"
                            class="form-control">{{ $landing_page_content->page_content }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.meta_title') }}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="Meta Title" name="meta_title" id="meta_title" class="form-control"
                            value="{{ $landing_page_content->meta_title }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.meta_description') }}</label>
                    <div class="col-sm-9">
                        <textarea type="text" placeholder="Meta Description" name="meta_description" id="meta_description"
                            rows="4" class="form-control">{{ $landing_page_content->meta_description }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ trans('words.meta_keyword') }}</label>
                    <div class="col-sm-9">
                        <textarea type="text" placeholder="Meta Description" name="meta_keyword" id="meta_keyword" rows="4"
                            class="form-control">{{ $landing_page_content->meta_keyword }}</textarea>
                    </div>
                </div>



                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 text-right">
                        <button type="submit" class="btn btn-primary">{{ trans('words.submit') }}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
@section('scripts-custom')
    <script>
        CKEDITOR.replace('page_content');
    </script>
@endsection
