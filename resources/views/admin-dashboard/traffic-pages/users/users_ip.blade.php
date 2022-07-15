{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
   <div class="container-fluid">
      @if (auth()->user()->usertype == 'Admin')
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
      @endif

      <div class="col-12">
         <div class="card">
               <div class="card-header">
                  <h4 class="card-title">{{ $data['agencyName'] }} IPs</h4>
                  <h6>{{$data['total_users']->first()->totalUsers}} New Users ( {{ date('j F Y', strtotime(request('from')))??''}} -  {{date('j F Y', strtotime(request('to')))??''}} )</h6>
                  <a href="{{route('trafficUsers')}}">
                     <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                  </a>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="example3" class="display min-w850 text-center">
                           <thead>
                              <tr>
                                 <th>Property Name</th>
                                 <th>IP Addresses</th>
                                 <th>Last Viewed</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($data['ips'] as $key => $IPs)
                              <tr>
                                 <td>
                                    @if ($IPs->property->status == 1)
                                    <a href="{{ url(strtolower($IPs->property->property_purpose) . '/' . $IPs->property->property_slug . '/' . $IPs->property->id) }}" target="_blank">

                                       {{ Str::limit($IPs->property->property_name, 30) }}
                                   </a>
                                   @else
                                   <p style="color: red">Property not Available</p>
                                    @endif
                                    
                                    {{-- {{ $IPs->property->property_name }} --}}
                                 </td>
                                 <td>{{ $IPs->ip_address }}</td>
                                 <td>{{ date('d-m-Y', strtotime($IPs->created_at)) ??'' }}</td>
                              </tr>
                           @endforeach
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td colspan="3" class="text-center">
                                       {{ $data['ips']->render() }}
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
@if (auth()->user()->usertype == "Admin")
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

@endif