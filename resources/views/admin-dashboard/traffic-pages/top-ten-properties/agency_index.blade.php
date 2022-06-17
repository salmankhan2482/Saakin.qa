{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
   <div class="container-fluid">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               <div class="basic-form">
                  <form action="{{ route('top_Ten_Properties.list', $agencyId) }}" method="GET">
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
                  <h4 class="card-title">Top 10 Properties List</h4>
                  <a href="{{route('top_Ten_Properties')}}">
                     <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i> Back</button>
                  </a>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="example3" class="display min-w850 text-center">
                           <thead>
                              <tr>
                                 <th>ID</th>
                                 <th>Property Title</th>
                                 <th>Property Visits</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($top10Proprties as $i => $click)
                              <tr>
                                 <td>{{ $click->id }}</td>
                                 <td>
                                    <a href="{{ url(strtolower($click->property_purpose) . '/' . $click->property_slug . '/' . $click->id) }}">
                                          {{ $click->property_name }}
                                    </a>
                                 </td>
                                 <td>{{ $click->counter }}</td>
                              </tr>
                           @endforeach
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td colspan="2" class="text-center">
                                       {{ $top10Proprties->render() }}
                                 </td>
                              </tr>
                           </tfoot>
                     </table>
                  </div>
                  <div class="clearfix"></div>
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
            new Chartist.Bar('#multi-line-chart', {
               labels: <?php echo $chartData['Label']; ?>,
               series: [
                  <?php echo $chartData['Data']; ?>
               ]
            }, {
               seriesBarDistance: 10,
               axisX: {
               offset: 60
               },
               axisY: {
               offset: 80,
               labelInterpolationFnc: function(value) {
                  return value 
               },
               scaleMinSpace: 10
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
