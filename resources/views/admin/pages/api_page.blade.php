@extends("admin.admin_app")

@section("content")

    <div id="main">
        <div class="page-header">
            <h2> API Page</h2>
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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(array('url' => array('admin/api-category'),'name'=>'category_form','id'=>'category_form','role'=>'form')) !!}

                <input type="hidden" name="api_link" id="api_link" value="http://api.gomasterkey.com/v1.2/website.asmx" />
                <input type="hidden" name="access_code" id="access_code" value="3A28C51415" />
                <input type="hidden" name="group_code" id="group_code" value="1575" />

                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                      <button type="submit" class="btn btn-primary">{{trans('words.get_categories')}}</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <form action="http://api.gomasterkey.com/v1.2/website.asmx?op=GetUnitCategory" method="post">

                    <input type="hidden" name="AccessCode" id="AccessCode" value="3A28C51415" />
                    <input type="hidden" name="GroupCode" id="GroupCode" value="1575" />

                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

@endsection
