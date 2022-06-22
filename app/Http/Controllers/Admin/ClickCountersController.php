<?php

namespace App\Http\Controllers\Admin;

use App\Agency;
use App\Properties;
use App\ClickCounters;
use App\PropertyCounter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\PageVisits;
use Illuminate\Support\Facades\Auth;

class ClickCountersController extends Controller
{

   // $firstDay = Carbon::now()->startOfMonth()->modify('0 month')->toDateString(); 
   // first day of a month

   // $lastDay = Carbon::now()->endOfMonth()->modify('0 month')->toDateString(); 
   // last day of a month


   // '12/08/2020'
   // $date = Carbon::createFromFormat('m/d/Y', $myDate)->endOfMonth()->format('Y-m-d');

   // it fetch the record between start and end of the month 
   //->when(request('from') == '' && request('to') == '', function ($query) {
   //     $query->whereMonth('click_counters.created_at', Carbon::now()->month);
   //     request()->merge(['from' => Carbon::now()->startOfMonth()->modify('0 month')->toDateString()]) ;
   //     request()->merge(['to' => Carbon::now()->endOfMonth()->modify('0 month')->toDateString()]) ;
   // })

   public function index()
   {
      $action = 'saakin_index';

      if (auth()->user()->usertype == 'Agency') {
         return $this->agencyCallToActionList(auth()->user()->agency_id);
      }

      $data['clickCounters'] = DB::table('click_counters')
         ->join('agencies', 'click_counters.agency_id', 'agencies.id')
         ->select(
            'agencies.name as agency_name',
            'agencies.*',
            'click_counters.created_at as created_at',
            'agencies.id as agency_id',
            DB::raw('COUNT(click_counters.button_name) as totalCall')
         )
         ->orderBy('totalCall', 'DESC')
         ->when(request('from'), function ($query) {
            $query->where('click_counters.created_at', '>=', request('from') . ' 00:00:01');
         })
         ->when(request('to'), function ($query) {
            $query->where('click_counters.created_at', '<=', request('to') . ' 23:59:59');
         })
         ->when(request('from') && request('to'), function ($query) {
            $query->whereBetween('click_counters.created_at', [request('from') . ' 00:00:01', request('to') . ' 23:59:59']);
         })
         ->groupBy('agency_name')->get(15);

      return view('admin-dashboard.traffic-pages.call-to-action.index', compact('data', 'action'));
   }

   public function agencyCallToActionList($id = null)
   {
      if (auth()->user()->usertype == 'Agency') {
         $id = auth()->user()->agency_id;
      }
      if ($id) {

         $data['clickCounters'] = DB::table('click_counters')
            ->leftJoin('properties', 'click_counters.property_id', 'properties.id')
            ->select(
               'click_counters.button_name as cbutton_name',
               DB::raw('count(IF(button_name = "Call",1,NULL)) totalCall'),
               DB::raw('count(IF(button_name = "Email",1,NULL)) totalEmail'),
               DB::raw('count(IF(button_name = "WhatsApp",1,NULL)) totalWhatsApp'),
               'properties.id as pid',
               'properties.property_name as pname',
               'properties.property_purpose as ppurpose',
               'properties.property_slug as pslug'
            )
            ->where('properties.agency_id', $id)

            ->when(request('from'), function ($query) {
               $query->where('click_counters.created_at', '>=', request('from') . ' 00:00:01');
            })
            ->when(request('to'), function ($query) {
               $query->where('click_counters.created_at', '<=', request('to') . ' 23:59:59');
            })
            ->when(request('from') && request('to'), function ($query) {
               $query->whereBetween('click_counters.created_at', [request('from') . ' 00:00:01', request('to') . ' 23:59:59']);
            })
            ->groupBy('pname')->paginate(10);
      }

      $data['get_properties'] = DB::table('click_counters')
         ->select('id', 'property_id', 'agency_id', 'ip_address', 'city')
         ->groupBy('property_id')
         ->get();

      $months = ['1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'];

      // Email Call and Whatsapp per month of  whole year 
      foreach ($months as $key => $value) {
         $data['EmailPer' . $value] = ClickCounters::where("agency_id", $id)
            ->where('button_name', 'Email')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $key)
            ->count();

         $data['CallPer' . $value] = ClickCounters::where("agency_id", $id)
            ->where('button_name', 'Call')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $key)
            ->count();

         $data['WhatsAppPer' . $value] = ClickCounters::where("agency_id", $id)
            ->where('button_name', 'WhatsApp')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $key)
            ->count();
      }

      $action = 'saakin_index';
      return view('admin-dashboard.traffic-pages.call-to-action.list', compact('data', 'action'));
   }

   public function show($property_id)
   {
      $clickCounters = ClickCounters::where('property_id', $property_id)->get();
      return view('admin.pages.traffic-pages.show', compact('clickCounters'));
   }

   public function propertyVisitsPerMonth($id = null)
   {
      $action = 'saakin_index';
      if (auth()->user()->usertype == 'Agency') {
         $id = auth()->user()->agency_id;
      }
      if ($id) {
         $data['propertyVisitsPerMonth'] = PropertyCounter::where('agency_id', $id)
            ->when(request('from'), function ($query) {
               $query->where('property_counters.created_at', '>=', request('from') . ' 00:00:01');
            })
            ->when(request('to'), function ($query) {
               $query->where('property_counters.created_at', '<=', request('to') . ' 23:59:59');
            })
            ->when(request('from') && request('to'), function ($query) {
               $query->whereBetween('property_counters.created_at', [request('from') . ' 00:00:01', request('to') . ' 23:59:59']);
            })->paginate(10);
           
           
         $months = ['1' => 'Jan', '2' => 'Feb', '3' => 'Mar',  '4' => 'Apr', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'];
       
         // properties per month
         foreach ($months as $key => $value) {
            $data['propertiesVisitsPer' . $value] = PropertyCounter::where('agency_id', $id)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $key)
            ->sum('counter');
            
         }
         
         return view('admin-dashboard.traffic-pages.propertyVisits-per-month.agency-index', compact('data', 'action'));
      } elseif(auth()->user()->usertype == 'Admin') {

         $data['propertyVisitsPerMonth'] = DB::table('property_counters')
            ->join('agencies', 'property_counters.agency_id', 'agencies.id')
            ->select('agencies.id as aid', 'agencies.name as aname', DB::raw(' SUM(property_counters.counter) as totalTraffic '))
            ->orderBy('totalTraffic', 'desc')
            ->when(request('from'), function ($query) {
               $query->where('property_counters.created_at', '>=', request('from') . ' 00:00:01');
            })
            ->when(request('to'), function ($query) {
               $query->where('property_counters.created_at', '<=', request('to') . ' 23:59:59');
            })
            ->when(request('from') && request('to'), function ($query) {
               $query->whereBetween('property_counters.created_at', [request('from') . ' 00:00:01', request('to') . ' 23:59:59']);
            })->groupBy('agencies.name')->paginate(10);
          

         return view('admin-dashboard.traffic-pages.propertyVisits-per-month.index', compact('data', 'action'));
      }
   }

   public function propertyVisitsPerMonthIPs($id)
   {
      $action = 'saakin_index';
      $data['property_visit_IPs'] = PageVisits::where('property_id', $id)->orderBy('id', 'DESC')->paginate(10);
      return view('admin-dashboard.traffic-pages.propertyVisits-per-month.property_visits_ips', compact('data', 'action'));
   }


   public function trafficUsers()
   {
      $action = 'saakin_index';
      if (auth()->user()->usertype == 'Admin') {

         $users =  DB::table('page_visits')
            ->join('agencies', 'page_visits.agency_id', 'agencies.id')
            ->select('agencies.*', DB::raw(' COUNT(DISTINCT page_visits.ip_address) as totalUsers '))
            ->when(request('from'), function ($query) {
               $query->where('page_visits.created_at', '>=', request('from') . ' 00:00:01');
            })
            ->when(request('to'), function ($query) {
               $query->where('page_visits.created_at', '<=', request('to') . ' 23:59:59');
            })
            ->when(request('from') && request('to'), function ($query) {
               $query->whereBetween('page_visits.created_at', [request('from') . ' 00:00:01', request('to') . ' 23:59:59']);
            })
            ->orderBy('totalUsers', 'DESC')
            ->groupBy('name')
            ->paginate(10);

         return view('admin-dashboard.traffic-pages.users.index', compact('users', 'action'));

      } elseif (auth()->user()->usertype == 'Agency') {

         $users = DB::table('page_visits')->where('agency_id', auth()->user()->agency_id)
            ->select('page_visits.*', DB::raw(' COUNT(DISTINCT page_visits.ip_address) as totalUsers '))

            ->when(request('from'), function ($query) {
               $query->where('page_visits.created_at', '>=', request('from') . ' 00:00:01');
            })
            ->when(request('to'), function ($query) {
               $query->where('page_visits.created_at', '<=', request('to') . ' 23:59:59');
            })
            ->when(request('from') && request('to'), function ($query) {
               $query->whereBetween('page_visits.created_at', [request('from') . ' 00:00:01', request('to') . ' 23:59:59']);
            })
            //  ->groupBy('totalUsers')
            // ->orderBy('totalUsers', 'DESC')
            ->paginate(20);
         //  dd($users);

         //BAR CHART NEW USERS PER MONTH
         $months = [
            '1' => 'Jan',
            '2' => 'Feb',
            '3' => 'Mar',
            '4' => 'Apr',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'Aug',
            '9' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec'
         ];

         foreach ($months as $key => $value) {
            $data['UniqueUsersPer' . $value] = DB::table('page_visits')
               ->select('ip_address')
               ->distinct('ip_address')
               ->where("agency_id", Auth::User()->agency_id)
               ->whereYear('created_at', Carbon::now()->year)
               ->whereMonth('created_at', $key)
               ->count('ip_address');
         }

         return view('admin-dashboard.traffic-pages.users.agency_index', compact('users', 'action', 'data'));
      }
   }

   public function trafficUsersIPs($id)
   {
      $action = 'saakin_index';

      if (auth()->user()->usertype == 'Agency') {
         $id = auth()->user()->agency_id;
      }
      if ($id) {
         $data['trafficUsersIPs'] = PageVisits::where('agency_id', $id)
            ->groupBy('ip_address')
            ->paginate(20);
      } else {
         $data['trafficUsersIPs'] = PageVisits::where('agency_id', $id)
            ->groupBy('ip_address')
            ->paginate(20);
      }
      return view('admin-dashboard.traffic-pages.users.users_ip', compact('data', 'action'));
   }

   public function totalClicks()
   {
      if (auth()->user()->usertype == 'Agency') {
         $property_ids = Properties::where('agency_id', auth()->user()->agency_id)->get(['id'])->toArray();

         $clicksPerMonths = ClickCounters::whereMonth('created_at', Carbon::now()->month)
            ->whereIn('property_id', $property_ids)->paginate();
      } else {
         $clicksPerMonths = '';
      }
      return view('admin.pages.traffic-pages.totalClicks', compact('clicksPerMonths'));
   }

   public function topTenProperties()
   {
      $action = 'saakin_index';

      if (auth()->user()->usertype == 'Agency') {

         $result = DB::table('properties')
            ->join('property_counters', 'properties.id', 'property_counters.property_id')
            ->select(
               'properties.id',
               'properties.property_name',
               'properties.property_purpose',
               'properties.property_slug',
               'property_counters.counter'
            )
            ->where('properties.agency_id', auth()->user()->agency_id)
            ->when(request('from'), function ($query) {
               $query->where('property_counters.created_at', '>=', request('from') . ' 00:00:01');
            })
            ->when(request('to'), function ($query) {
               $query->where('property_counters.created_at', '<=', request('to') . ' 23:59:59');
            })
            ->when(request('from') && request('to'), function ($query) {
               $query->whereBetween('property_counters.created_at', [request('from') . ' 00:00:01', request('to') . ' 23:59:59']);
            })
            ->orderByDesc('property_counters.counter');

         $top10Proprties = $result->paginate(10);
         $chartResult = $result->limit(10)->get();

         $chartData['Data'] = "[";
         $chartData['Label'] = "[";
         foreach ($chartResult as $key => $list) {
            $chartData['Data'] .= $list->counter;
            $chartData['Label'] .= "'" . $list->property_name . "'";
            if ($key < (count($chartResult) - 1)) {
               $chartData['Data'] .= ",";
               $chartData['Label'] .= ",";
            }
         }
         $chartData['Data'] .= "]";
         $chartData['Label'] .= "]";

         $agencyId = auth()->user()->agency_id;
         return view(
            'admin-dashboard.traffic-pages.top-ten-properties.agency_index',
            compact('top10Proprties', 'action', 'agencyId', 'chartData')
         );
      } else {
         $top10Proprties = DB::table('property_counters')
            ->join('agencies', 'property_counters.agency_id', 'agencies.id')
            ->select(
               DB::raw(' SUM(property_counters.counter) as counter '),
               'agencies.name as aname',
               'agencies.id as aid'
            )
            ->orderBy('counter', 'DESC')
            ->groupBy('aname')
            ->paginate(10);

         return view('admin-dashboard.traffic-pages.top-ten-properties.index', compact('top10Proprties', 'action'));
      }
   }

   public function topTenPropertiesList($id)
   {
      $result = DB::table('properties')
         ->join('property_counters', 'properties.id', 'property_counters.property_id')
         ->select(
            'properties.id',
            'properties.property_name',
            'properties.property_purpose',
            'properties.property_slug',
            DB::raw(' SUM(property_counters.counter) as counter ')
         )
         ->where('properties.agency_id', $id)
         ->when(request('from'), function ($query) {
            $query->where('property_counters.created_at', '>=', request('from') . ' 00:00:01');
         })
         ->when(request('to'), function ($query) {
            $query->where('property_counters.created_at', '<=', request('to') . ' 23:59:59');
         })
         ->when(request('from') && request('to'), function ($query) {
            $query->whereBetween('property_counters.created_at', [request('from') . ' 00:00:01', request('to') . ' 23:59:59']);
         })
         ->groupBy('properties.id')
         ->orderByDesc('counter');

      $top10Proprties = $result->paginate(10);
      $chartResult = $result->limit(10)->get();

      $chartData['Data'] = "[";
      $chartData['Label'] = "[";
      foreach ($chartResult as $key => $list) {
         $chartData['Data'] .= $list->counter;
         $chartData['Label'] .= "'" . $list->property_name . "'";
         if ($key < (count($chartResult) - 1)) {
            $chartData['Data'] .= ",";
            $chartData['Label'] .= ",";
         }
      }
      $chartData['Data'] .= "]";
      $chartData['Label'] .= "]";

      $action = 'saakin_index';
      $agencyId = $id;

      return view(
         'admin-dashboard.traffic-pages.top-ten-properties.agency_index',
         compact('top10Proprties', 'action', 'agencyId', 'chartData')
      );
   }

   public function top10Areas()
   {
      $action = 'saakin_index';
      if (auth()->user()->usertype == 'Agency') {
         $result = DB::table('properties')
            ->join('property_counters', 'properties.id', 'property_counters.property_id')
            ->select(
               'properties.id',
               'properties.address as paddress',
               'property_counters.counter'
            )
            ->where('properties.agency_id', auth()->user()->agency_id)
            ->when(request('from'), function ($query) {
               $query->where('property_counters.created_at', '>=', request('from') . ' 00:00:01');
            })
            ->when(request('to'), function ($query) {
               $query->where('property_counters.created_at', '<=', request('to') . ' 23:59:59');
            })
            ->when(request('from') && request('to'), function ($query) {
               $query->whereBetween('property_counters.created_at', [request('from') . ' 00:00:01', request('to') . ' 23:59:59']);
            })
            ->groupBy('paddress')
            ->orderByDesc('counter');

         $top10Properties = $result->paginate(10);
         $chartResult = $result->limit(10)->get();

         $chartData['Data'] = "[";
         $chartData['Label'] = "[";
         foreach ($chartResult as $key => $list) {
            $chartData['Data'] .= $list->counter;
            $chartData['Label'] .= "'" . $list->paddress . "'";
            if ($key < (count($chartResult) - 1)) {
               $chartData['Data'] .= ",";
               $chartData['Label'] .= ",";
            }
         }
         $chartData['Data'] .= "]";
         $chartData['Label'] .= "]";
         $agency = Agency::where('id', auth()->user()->agency_id)->select(['name', 'id'])->first();

         return view('admin-dashboard.traffic-pages.top-five-areas.agency_index', 
         compact('top10Properties', 'action', 'chartData','agency'));
      } else {

         $top10Properties = DB::table('properties')
            ->join('property_counters', 'properties.id', 'property_counters.property_id')
            ->join('agencies', 'properties.agency_id', 'agencies.id')
            ->select('properties.id', 'agencies.name as aname', 'agencies.id as aid', 'property_counters.counter')
            ->orderByDesc('property_counters.counter')
            ->groupBy('agencies.name')
            ->limit('5')
            ->paginate(10);

         return view('admin-dashboard.traffic-pages.top-five-areas.index', compact('top10Properties', 'action'));
      }
   }

   public function top10AreasList($id)
   {
      $result = DB::table('property_counters')
         ->join('properties', 'property_counters.property_id', 'properties.id')
         ->select('properties.id as pid', 'property_counters.counter', 'properties.address as paddress')
         ->where('properties.agency_id', $id)
         ->when(request('from'), function ($query) {
            $query->where('property_counters.created_at', '>=', request('from') . ' 00:00:01');
         })
         ->when(request('to'), function ($query) {
            $query->where('property_counters.created_at', '<=', request('to') . ' 23:59:59');
         })
         ->when(request('from') && request('to'), function ($query) {
            $query->whereBetween('property_counters.created_at', [request('from') . ' 00:00:01', request('to') . ' 23:59:59']);
         })
         ->groupBy('paddress')
         ->orderByDesc('property_counters.counter');

      $top10Properties = $result->paginate(10);
      $chartResult = $result->limit(10)->get();

      $chartData['Data'] = "[";
      $chartData['Label'] = "[";
      foreach ($chartResult as $key => $list) {
         $chartData['Data'] .= $list->counter;
         $chartData['Label'] .= "'" . $list->paddress . "'";
         if ($key < (count($chartResult) - 1)) {
            $chartData['Data'] .= ",";
            $chartData['Label'] .= ",";
         }
      }
      $chartData['Data'] .= "]";
      $chartData['Label'] .= "]";

      $action = 'saakin_index';
      $agency = Agency::where('id', $id)->select(['name','id'])->first();
      return view('admin-dashboard.traffic-pages.top-five-areas.agency_index', compact('top10Properties', 'action', 'agency', 'chartData'));
   }

   public function totalLeads()
   {
      $action = 'saakin_index';
      return view('admin-dashboard.traffic-pages.leads.index', compact('action'));
   }
}
