@extends("admin.admin_app")

@section('content')
    <style type="text/css">
        .card-box {
            padding: 20px;
            box-shadow: 0 0px 8px 0 rgba(0, 0, 0, 0.06), 0 1px 0px 0 rgba(0, 0, 0, 0.02);
            border-radius: 5px;
            margin-bottom: 20px;
            background-color: #ffffff;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

    </style>

    <div id="main">
        <div class="page-header">
            <h2>{{ trans('words.overview') }}</h2>
        </div>




        @if (Auth::user()->usertype == 'Admin')
            <div class="row">
                <a href="{{ URL::to('admin/properties') }}" style="text-decoration: none;">
                    <div class="col-sm-6 col-md-4">
                        <div class="panel panel-orange panel-shadow" style="background-color: #188ae2 !important">
                            <div class="media">
                                <div class="media-left">
                                    <div class="panel-body">
                                        <div class="width-100">
                                            <h5 class="margin-none" id="graphWeek-y">{{ trans('words.properties') }}</h5>

                                            <h2 class="margin-none" id="graphWeek-a">
                                                {{ $properties_count }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="pull-right width-150">
                                        <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('featuredproperties.pending') }}" style="text-decoration: none;">
                    <div class="col-sm-6 col-md-4">
                        <div class="panel panel-grey panel-shadow" style="background-color: #71b6f9 !important">
                            <div class="media">
                                <div class="media-left">
                                    <div class="panel-body">
                                        <div class="width-100">
                                            <h5 class="margin-none" id="graphWeek-y">{{ trans('words.pending') }}</h5>

                                            <h2 class="margin-none" id="graphWeek-a">
                                                {{ $pending_properties_count }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="pull-right width-150">
                                        <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('featuredproperties.index') }}" style="text-decoration: none;">
                    <div class="col-sm-6 col-md-4">
                        <div class="panel panel-green panel-shadow" style="background-color: #ff5b5b !important">
                            <div class="media">
                                <div class="media-left">
                                    <div class="panel-body">
                                        <div class="width-100">
                                            <h5 class="margin-none" id="graphWeek-y">{{ trans('words.featured') }}</h5>

                                            <h2 class="margin-none" id="graphWeek-a">
                                                {{ $featured_properties }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="pull-right width-150">
                                        <i class="fa fa-star fa-4x" style="margin: 8px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ URL::to('admin/inquiries') }}" style="text-decoration: none;">
                    <div class="col-sm-6 col-md-4">
                        <div class="panel panel-primary panel-shadow"
                            style="background-color: #343a40 !important;border-color:#343a40;">
                            <div class="media">
                                <div class="media-left">
                                    <div class="panel-body">
                                        <div class="width-100">
                                            <h5 class="margin-none" id="graphWeek-y">{{ trans('words.inquiries') }}</h5>

                                            <h2 class="margin-none" id="graphWeek-a">
                                                {{ $inquiries }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="pull-right width-150">
                                        <i class="fa fa-send fa-4x" style="margin: 8px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif
        @if (Auth::user()->usertype == 'Agency')
            @php
                $properties = \App\Properties::where('agency_id', auth()->user()->agency_id)->get();
                $properties_views = \App\Properties::where('agency_id', auth()->user()->agency_id)->get('views');
                $active = \App\Properties::where('agency_id', auth()->user()->agency_id)
                    ->where('status', '1')
                    ->get();
                $inactive = \App\Properties::where('agency_id', auth()->user()->agency_id)
                    ->where('status', '0')
                    ->get();
                $featured_properties = \App\Properties::where('agency_id', auth()->user()->agency_id)
                    ->where('status', '1')
                    ->where('featured_property', 1)
                    ->get();
                
            @endphp

            <div class="row">
                <a href="{{ URL::to('admin/properties') }}" style="text-decoration: none;">
                    <div class="col-sm-6 col-md-4">
                        <div class="panel panel-orange panel-shadow" style="background-color: #188ae2 !important">
                            <div class="media">
                                <div class="media-left">
                                    <div class="panel-body">
                                        <div class="width-100">
                                            <h5 class="margin-none" id="graphWeek-y">{{ trans('words.properties') }}
                                            </h5>

                                            <h2 class="margin-none" id="graphWeek-a">
                                                {{ count($properties) }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="pull-right width-150">
                                        <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('featuredproperties.pending') }}" style="text-decoration: none;">
                    <div class="col-sm-6 col-md-4">
                        <div class="panel panel-grey panel-shadow" style="background-color: #71b6f9 !important">
                            <div class="media">
                                <div class="media-left">
                                    <div class="panel-body">
                                        <div class="width-100">
                                            <h5 class="margin-none" id="graphWeek-y">{{ trans('words.pending') }}</h5>

                                            <h2 class="margin-none" id="graphWeek-a">
                                                {{ count($inactive) }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="pull-right width-150">
                                        <i class="fa fa-map-marker fa-4x" style="margin: 8px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('featuredproperties.index') }}" style="text-decoration: none;">
                    <div class="col-sm-6 col-md-4">
                        <div class="panel panel-green panel-shadow" style="background-color: #ff5b5b !important">
                            <div class="media">
                                <div class="media-left">
                                    <div class="panel-body">
                                        <div class="width-100">
                                            <h5 class="margin-none" id="graphWeek-y">{{ trans('words.featured') }}</h5>

                                            <h2 class="margin-none" id="graphWeek-a">
                                                {{ count($featured_properties) }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="pull-right width-150">
                                        <i class="fa fa-star fa-4x" style="margin: 8px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>



                <a href="{{ URL::to('admin/inquiries') }}" style="text-decoration: none;">
                    <div class="col-sm-6 col-md-4">
                        <div class="panel panel-primary panel-shadow"
                            style="background-color: #343a40 !important;border-color:#343a40;">
                            <div class="media">
                                <div class="media-left">
                                    <div class="panel-body">
                                        <div class="width-100">
                                            <h5 class="margin-none" id="graphWeek-y">{{ trans('words.inquiries') }}</h5>

                                            <h2 class="margin-none" id="graphWeek-a">
                                                {{ $inquiries }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="pull-right width-150">
                                        <i class="fa fa-send fa-4x" style="margin: 8px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        @endif

    </div>

@endsection
