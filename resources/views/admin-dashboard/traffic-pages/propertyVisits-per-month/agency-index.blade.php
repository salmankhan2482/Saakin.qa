{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
      <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="basic-form">
                     <form action="{{ route('propertyVisits_per_month', request('id')) }}" method="GET">
                        <div class="row justify-content-center">
                               <div class="col-sm-3">
                                  <div class="form-group row">
                                       <label class="col-sm-12 col-form-label d-flex">
                                          Search Through Date
                                       </label>
                                    </div>
                               </div>

                                {{-- <div class="col-sm-2"></div> --}}
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label d-flex">From</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="h-100 form-control" name="from"
                                                value="{{ request('from') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label d-flex">To</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="h-100 form-control" name="to"
                                                value="{{ request('to') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-dark btn-sm p-2">
                                        {{ trans('words.search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      </div>

      <div class="col-xl-12 col-lg-12">
         <div class="card">
            <div class="card-header">
                  <h4 class="card-title">Property Visits Per Month</h4>
            </div>
            <div class="card-body">
                  <div id="horizontal-bar-chart" class="ct-chart ct-golden-section chartlist-chart"></div>
            </div>
         </div>
      </div>
       
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Property Visits</h4>
                    <a href="{{ route('dashboard.index') }}">
                        <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850 text-center">
                            <thead>
                                <tr>
                                    <th>Property Name</th>
                                    <th>Property Visits</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['propertyVisitsPerMonth'] as $i => $click)
                                <tr>
                                    <td>
                                        @if(isset($click->property->property_purpose))
                                        <a href="{{ url(strtolower($click->property->property_purpose) . '/' . $click->property->property_slug . '/' . $click->property->id) }}">
                                            {{ $click->property->property_name }}
                                        </a>
                                        @else
                                        {{$click->id}}
                                        @endif
                                    </td>
                                    <td>{{ $click->counter }}</td>
                                    <td>
                                        <a class="btn btn-success rounded btn-xs action-btn"
                                         href="{{ url('admin/traffic/visits_per_month_IPs/'.$click->property_id ??"") }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                   
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        {{ $data['propertyVisitsPerMonth']->render() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script src="{{ asset('admin/vendor/chartist/js/chartist.min.js') }}"></script>
<script src="{{ asset('admin/vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>

<script>
   (function($) {
    /* "use strict" */


 var dzChartlist = function(){
	var screenWidth = $(window).width();
	var horizontalBarChart = function(){
		//Horizontal bar chart
  
		new Chartist.Bar('#horizontal-bar-chart', {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
				series: [
				   [
                  {{ $data['propertiesVisitsPerJan'] }}, {{ $data['propertiesVisitsPerFeb'] }}, {{ $data['propertiesVisitsPerMar'] }}, {{ $data['propertiesVisitsPerApr'] }}, {{ $data['propertiesVisitsPerMay'] }}, {{ $data['propertiesVisitsPerJune'] }}, {{ $data['propertiesVisitsPerJuly'] }}, {{ $data['propertiesVisitsPerAug'] }},  {{ $data['propertiesVisitsPerSep'] }}, {{ $data['propertiesVisitsPerOct'] }}, {{ $data['propertiesVisitsPerNov'] }}, {{ $data['propertiesVisitsPerDec'] }} 
               ],
				]
			  }, {
				seriesBarDistance: 10,
				reverseData: true,
				horizontalBars: true,
				axisY: {
				  offset: 70,
				},
				plugins: [
				  Chartist.plugins.tooltip(),
				]
			  });
	}

	
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				horizontalBarChart();
			},
			
			resize:function(){
				horizontalBarChart();
			}
		}
	
	}();

	jQuery(document).ready(function(){
	});
		
	jQuery(window).on('load',function(){
		dzChartlist.load();
	});

	jQuery(window).on('resize',function(){
		dzChartlist.resize();
	});     

})(jQuery);
</script>
@endsection
