{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <div class="basic-form">
                     <form action="{{ route('callToAction.index') }}" method="GET">
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

        {{-- graph chart stalked bar--}}
         <div class="col-xl-12 col-lg-12">
            <div class="card">
               <div class="card-header">
                     <h4 class="card-title">Stacked bar chart</h4>
               </div>
               <div class="card-body">
                     <div id="stacked-bar-chart" class="ct-chart ct-golden-section chartlist-chart"></div>
               </div>
            </div>
         </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Click To Action</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>Agency ID</th>
                                    <th>Agency Name</th>
                                    <th>Total Clicks</th>
                                    <th>{{ trans('words.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['clickCounters'] as $i => $click)
                                    <tr>
                                        <td>{{ $click->agency_id }}</td>
                                        <td>{{ $click->agency_name }}</td>
                                        <td>{{ $click->totalCall }}</td>
                                        <td>
                                            <a class="btn btn-success rounded btn-xs action-btn"
                                                href="{{ route('agencyCallToActionList', $click->agency_id) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        {{ $data['clickCounters']->render() }}
                                    </td>
                                </tr>
                            </tfoot> --}}
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
   <script src="{{ asset('admin/js/plugins-init/chartist-init.js') }}"></script>

   <script>
   
   (function($) {
    /* "use strict" */
   var dzChartlist = function(){
   var screenWidth = $(window).width();
   var stackedBarChart = function(){
		 //Stacked bar chart  
		new Chartist.Bar('#stacked-bar-chart', {
			labels: ['Q1', 'Q2', 'Q3', 'Q4','Q5', 'Q6', 'Q7', 'Q8','Q9', 'Q10', 'Q11', 'Q12'],
			series: [
			  [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120],
			  [21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32],
			  [31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42]
			]
		  }, {
			stackBars: true,
			axisY: {
			  labelInterpolationFnc: function(value) {
				return (value / 100);
            console.log(value);
			  }
			},
			plugins: [
			  Chartist.plugins.tooltip()
			]
		}).on('draw', function(data) {
			if(data.type === 'bar') {
			  data.element.attr({
				style: 'stroke-width: 30px'
			  });
			}
		});
	}
	
	/* Function ============ */
		return {
			init:function(){
			},
			
			load:function(){
				stackedBarChart();
			},
			
			resize:function(){
				stackedBarChart();
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
