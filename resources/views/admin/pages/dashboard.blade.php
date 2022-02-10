@extends("admin.admin_app")

@section("content")
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
		<h2>{{trans('words.overview')}}</h2>
	</div>




  	@if(Auth::user()->usertype=='Admin')
    <div class="row">
    	<a href="{{ URL::to('admin/properties') }}" style="text-decoration: none;">
    	<div class="col-sm-6 col-md-4">
        <div class="panel panel-orange panel-shadow" style="background-color: #188ae2 !important">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.properties')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$properties_count}}
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
    <a href="{{ URL::to('admin/pendingproperties') }}" style="text-decoration: none;">
        <div class="col-sm-6 col-md-4">
        <div class="panel panel-grey panel-shadow" style="background-color: #71b6f9 !important">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.pending')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$pending_properties_count}}
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
    <a href="{{ URL::to('admin/featuredproperties') }}" style="text-decoration: none;">
    	<div class="col-sm-6 col-md-4">
        <div class="panel panel-green panel-shadow" style="background-color: #ff5b5b !important">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.featured')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$featured_properties}}
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
        <div class="panel panel-primary panel-shadow" style="background-color: #343a40 !important;border-color:#343a40;">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.inquiries')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{$inquiries}}
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
    </a> </div>
    @endif


    @if(Auth::user()->usertype=='Agency')
        
        @php
        $properties =  \App\Properties::where('agency_id',auth()->user()->agency_id)->get();
        $properties_views =  \App\Properties::where('agency_id',auth()->user()->agency_id)->get('views');
        $active =  \App\Properties::where('agency_id',auth()->user()->agency_id)->where('status','1')->get();
        $inactive =  \App\Properties::where('agency_id',auth()->user()->agency_id)->where('status','0')->get();
        $featured_properties =  \App\Properties::where('agency_id',auth()->user()->agency_id)->where('status','1')->where('featured_property',1)->get();
        @endphp

    <div class="row">
    <a href="{{ URL::to('admin/properties') }}" style="text-decoration: none;">
    	<div class="col-sm-6 col-md-4">
        <div class="panel panel-orange panel-shadow" style="background-color: #188ae2 !important">
            <div class="media">
                <div class="media-left">
                    <div class="panel-body">
                        <div class="width-100">
                            <h5 class="margin-none" id="graphWeek-y">{{trans('words.properties')}}</h5>

                            <h2 class="margin-none" id="graphWeek-a">
                                {{count($properties)}}
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
        <a href="{{ URL::to('admin/pendingproperties') }}" style="text-decoration: none;">
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-grey panel-shadow" style="background-color: #71b6f9 !important">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">{{trans('words.pending')}}</h5>

                                    <h2 class="margin-none" id="graphWeek-a">
                                        {{count($inactive)}}
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
        
        <a href="{{ URL::to('admin/featuredproperties') }}" style="text-decoration: none;">
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-green panel-shadow" style="background-color: #ff5b5b !important">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">{{trans('words.featured')}}</h5>

                                    <h2 class="margin-none" id="graphWeek-a">
                                        {{count($featured_properties)}}
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
                <div class="panel panel-primary panel-shadow" style="background-color: #ff5b5b !important;border-color:##ff5b5b;">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div class="width-100">
                                    <h5 class="margin-none" id="graphWeek-y">{{trans('words.inquiries')}}</h5>

                                    <h2 class="margin-none" id="graphWeek-a">
                                        {{$inquiries}}
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

        {{-- Traffic Per Month --}}
        <a href="{{ route('traffic_per_month') }}" style="text-decoration: none;">
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-primary panel-shadow" style="background-color: #0ba19a !important;border-color:#0ba19a;">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div style="width: 20rem ;">
                                    <h5 class="margin-none" id="graphWeek-y">
                                        Traffic / Month    
                                    </h5>

                                    <h2 class="margin-none" id="graphWeek-a">
                                        {{$trafficPerMonth->sum('counter')}}
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


        {{-- Total Clicks Per Month --}}
        <a href="{{ route('total_clicks') }}" style="text-decoration: none;">
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-primary panel-shadow" style="background-color: #700c74 !important;border-color:#700c74;">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div style="width: 20rem ;">
                                    <h5 class="margin-none" id="graphWeek-y">
                                        Total Clicks    
                                    </h5>

                                    <h2 class="margin-none" id="graphWeek-a">
                                        {{$clicksPerMonths->count()}}
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


        {{-- Top 10 Properties --}}
        <a href="{{ route('top_Ten_Properties') }}" style="text-decoration: none;">
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-primary panel-shadow" style="background-color: #f3c600 !important;border-color:#f3c600;">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div style="width: 20rem ;">
                                    <h5 class="margin-none" id="graphWeek-y">
                                        Top 10 Properties    
                                    </h5>

                                    <h2 class="margin-none" id="graphWeek-a">
                                        {{-- {{$top10Proprties->count()}} --}}
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


        {{-- Top 5 Areas --}}
        <a href="{{ route('top_5_areas') }}" style="text-decoration: none;">
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-primary panel-shadow" style="background-color: #49c700 !important;border-color:#49c700;">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div style="width: 20rem ;">
                                    <h5 class="margin-none" id="graphWeek-y">
                                        Top 5 Areas    
                                    </h5>

                                    <h2 class="margin-none" id="graphWeek-a">
                                        {{-- {{$top5Properties->count()}} --}}
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

        {{-- Total Leads --}}
        <a href="{{ route('total_leads') }}" style="text-decoration: none;">
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-primary panel-shadow" style="background-color: #343a40 !important;border-color:#343a40;">
                    <div class="media">
                        <div class="media-left">
                            <div class="panel-body">
                                <div style="width: 20rem ;">
                                    <h5 class="margin-none" id="graphWeek-y">
                                        Total Leads    
                                    </h5>

                                    <h2 class="margin-none" id="graphWeek-a">
                                        {{$inquiries}}
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
