{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
   <div class="container-fluid">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <h4 class="card-title">Click To Action</h4>
            </div>
         </div>
      </div>
      
      <div class="col-xl-12 col-lg-12">
         <div class="card">
            <div class="card-header">
                  <h4 class="card-title">
                     <span style="color: #3b4cb8">Email,</span>
                     <span style="color: #37d159">Call</span> &
                     <span style="color: #ff9f0f">Whatsapp</span>
                     Per Month
                  </h4>
            </div>
            <div class="card-body">
                  <div id="multi-line-chart" class="ct-chart ct-golden-section chartlist-chart"></div>
            </div>
         </div>
      </div>

      <div class="col-12">
         <div class="card">
            <div class="card-header">
                  <h4 class="card-title">Click to Action</h4>
                  <a href="{{ route('dashboard.index') }}">
                     <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i>
                        Back</button>
                  </a>
            </div>
            <div class="card-body">
                  <div class="table-responsive">
                     <table id="example3" class="display min-w850">
                        <thead>
                              <tr>
                                 <th>Property ID</th>
                                 <th>Property Title</th>
                                 <th>Call Now</th>
                                 <th>Email</th>
                                 <th>WhatsaApp</th>
                              </tr>
                        </thead>
                        <tbody>
                              @foreach ($data['clickCounters'] as $i => $click)
                                 <tr>
                                    <td>{{ $click->pid }}</td>
                                    <td>
                                          <a class="property-img" target="_blank"
                                             href="{{ url(strtolower($click->ppurpose) . '/' . $click->pslug . '/' . $click->pid) }}">
                                             {!! Str::limit($click->pname, 40, '...') !!}
                                          </a>
                                    </td>
                                    
                                    <td>
                                          {{ $click->totalCall }}
                                    </td>
                                    <td>
                                          {{ $click->totalEmail }}
                                    </td>
                                    <td>
                                          {{ $click->totalWhatsApp }}
                                    </td>

                                 </tr>
                              @endforeach
                        </tbody>
                        <tfoot>
                              <tr>
                                 <td colspan="5" class="text-center">
                                    {{ $data['clickCounters']->render() }}
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
         
         var multiLineChart = function(){
            //Multi-line labels
            new Chartist.Bar('#multi-line-chart', {
               labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],

                series: [
                     [
                        {{ $data['EmailPerJan'] }}, {{ $data['EmailPerFeb'] }}, {{ $data['EmailPerMar'] }}, {{ $data['EmailPerApr'] }}, 
                        {{ $data['EmailPerMay'] }}, {{ $data['EmailPerJune'] }}, {{ $data['EmailPerJuly'] }}, {{ $data['EmailPerAug'] }}, 
                        {{ $data['EmailPerSep'] }}, {{ $data['EmailPerOct'] }}, {{ $data['EmailPerNov'] }}, {{ $data['EmailPerDec'] }} 
                     ],
                     [
                        {{ $data['CallPerJan'] }}, {{ $data['CallPerFeb'] }}, {{ $data['CallPerMar'] }}, {{ $data['CallPerApr'] }}, 
                        {{ $data['CallPerMay'] }}, {{ $data['CallPerJune'] }}, {{ $data['CallPerJuly'] }}, {{ $data['CallPerAug'] }}, 
                        {{ $data['CallPerSep'] }}, {{ $data['CallPerOct'] }}, {{ $data['CallPerNov'] }}, {{ $data['CallPerDec'] }}
                     ],
                     [
                        {{ $data['WhatsAppPerJan'] }}, {{ $data['WhatsAppPerFeb'] }}, {{ $data['WhatsAppPerMar'] }}, {{ $data['WhatsAppPerApr'] }}, 
                        {{ $data['WhatsAppPerMay'] }}, {{ $data['WhatsAppPerJune'] }}, {{ $data['WhatsAppPerJuly'] }}, {{ $data['WhatsAppPerAug'] }}, 
                        {{ $data['WhatsAppPerSep'] }}, {{ $data['WhatsAppPerOct'] }}, {{ $data['WhatsAppPerNov'] }}, {{ $data['WhatsAppPerDec'] }}
                     ]
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
               scaleMinSpace: 15
               },
               plugins: [
               Chartist.plugins.tooltip()
               ]
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
