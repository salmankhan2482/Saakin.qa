{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
<div class="container-fluid">
<div class="col-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title">Search Through Date</h4>
         </div>
         <div class="card-body">
            <div class="basic-form">
               <form action="{{ route('trafficUsers') }}" method="GET">
                  <div class="row justify-content-center">
                     <div class="col-sm-3">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label d-flex">From</label>
                           <div class="col-sm-9">
                              <input type="date" class="h-100 form-control" name="from" value="{{ request('from') }}">
                           </div>
                        </div>
                     </div>

                     <div class="col-sm-3">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label d-flex">To</label>
                           <div class="col-sm-9">
                              <input type="date" class="h-100 form-control" name="to" value="{{ request('to') }}">
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
            <h4 class="card-title">Top Trending Properties</h4>
      </div>
      <div class="card-body">
            <div id="multi-line-chart" class="ct-chart ct-golden-section chartlist-chart"></div>
      </div>
   </div>
</div>

<div class="col-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title">Unique Visitors</h4>
         </div>
         <div class="card-body">
            <div class="table-responsive">
                  <table id="example3" class="display min-w850">
                     <thead>
                        <tr>
                              <th>ID</th>
                              <th>Total Visitors</th>
                              <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($users as $i => $user)
                              <tr>
                                 <td>{{ $i+1 }}</td>
                                 <td>{{ $user->totalUsers }}</td>
                                 <td>
                                    <a class="btn btn-success rounded btn-xs action-btn"
                                       href="{{ url('admin/traffic/trafficUsersIPs/'.$user->id	.'?from='.request('from').'&to='.request('to')) }}">
                                          <i class="fa fa-eye"></i>
                                       </a>
                                 </td>
                              </tr>
                        @endforeach
                     </tbody>
                     <tfoot>
                        <tr>
                              <td colspan="2" class="text-center">
                                 

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
   <script src="{{ asset('admin/vendor/chartist/js/chartist.min.js') }}" type="text/javascript"></script>
   <script src="{{ asset('admin/vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}" type="text/javascript"></script>
   <script>
   (function($) {
    /* "use strict" */
      var dzChartlist = function(){
         var screenWidth = $(window).width();

         var multiLineChart = function(){
		//Multi-line labels
		new Chartist.Bar('#multi-line-chart', {
         labels: ["Jan ({{ $data['UniqueUsersPerJan'] }})", "Feb ({{ $data['UniqueUsersPerFeb'] }})", 
                  "Mar ({{ $data['UniqueUsersPerMar'] }})", "Apr ({{ $data['UniqueUsersPerApr'] }})", 
                  "May ({{ $data['UniqueUsersPerMay'] }})", "June ({{ $data['UniqueUsersPerJune'] }})", 
                  "July ({{ $data['UniqueUsersPerJuly'] }})", "Aug ({{ $data['UniqueUsersPerAug'] }})", 
                  "Sep ({{ $data['UniqueUsersPerSep'] }})", "Oct ({{ $data['UniqueUsersPerOct'] }})", 
                  "Nov ({{ $data['UniqueUsersPerNov'] }})", "Dec ({{ $data['UniqueUsersPerDec'] }})"],
			series: [
         [  {{ $data['UniqueUsersPerJan'] }}, {{ $data['UniqueUsersPerFeb'] }}, {{ $data['UniqueUsersPerMar'] }}, 
            {{ $data['UniqueUsersPerApr'] }},{{ $data['UniqueUsersPerMay'] }}, {{ $data['UniqueUsersPerJune'] }}, 
            {{ $data['UniqueUsersPerJuly'] }}, {{ $data['UniqueUsersPerAug'] }},{{ $data['UniqueUsersPerSep'] }}, 
            {{ $data['UniqueUsersPerOct'] }}, {{ $data['UniqueUsersPerNov'] }}, {{ $data['UniqueUsersPerDec'] }}] ]
         },{
			seriesBarDistance: 10,
			axisX: {
			  offset: 60
			},
			axisY: {
			  offset: 80,
			  labelInterpolationFnc: function(value) {
				return value
			  },
			  scaleMinSpace: 15
			},
			plugins: [
			  Chartist.plugins.tooltip()
			]
		   }).on('draw', function(data) {
         if(data.type === 'bar') {
         data.element.attr({
            style: 'stroke-width: 20px'
         });
         }
      });
	}

         /* Function ============ */
            return {
               init:function(){
               },


               load:function(){
                  multiLineChart();
               },

               resize:function(){
                  multiLineChart();
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
