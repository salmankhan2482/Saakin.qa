<?php

namespace App\Http\Controllers\Admin;

use App\Enquire;
use App\PageVisits;
use App\Properties;
use App\ClickCounters;

use App\PropertyCities;
use App\PropertyReport;
use App\PropertyCounter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends MainAdminController
{
   public function __construct()
   {
      $this->middleware('auth');
   }

   public function index()
   {

      if (auth()->user()->usertype == 'Agency') {
         $property_ids = Properties::where('agency_id', auth()->user()->agency_id)->get(['id'])->toArray();
      };

      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         Session::flash('flash_message', trans('words.access_denied'));
         return redirect('dashboard');
      }

      $agency_id = Auth::User()->agency_id;
      $data['active_properties'] = Properties::where('status', 1)
         ->when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
         ->count();

      $data['inactive_properties'] = Properties::when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
         ->where('status', 0)
         ->count();

      $data['sale_properties'] = Properties::where('status', 1)
         ->when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
         ->where('property_purpose', 'Sale')
         ->count();

      $data['rent_properties'] = Properties::where('status', 1)
         ->when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
         ->where('property_purpose', 'Rent')
         ->count();


      $data['total_properties'] = Properties::when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
         ->count();


      $data['featured_properties'] = Properties::where('featured_property', '1')
         ->when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
         ->count();

      //Property Reports
      $data['reports'] = PropertyReport::when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
         ->count();

      //Inquiries
      $data['inquiries'] = Enquire::when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
         ->orderBy('id', 'desc')
         ->count();

      // last month
      $data['last_month_properties'] = Properties::when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
         ->whereMonth('created_at', Carbon::now()->subMonth()->format('m'))
         ->count();


      //traffic per month
      $data['trafficPerMonth'] = PropertyCounter::when(auth()->user()->usertype == 'Agency', function ($query) {
         $query->where('agency_id', auth()->user()->agency_id);
      })->sum('counter');

      // clicks per month
      $data['clicksPerMonths'] = ClickCounters::when(auth()->user()->usertype == 'Agency', function ($query) {
         $property_ids = Properties::where('agency_id', auth()->user()->agency_id)->get(['id'])->toArray();
         $query->whereIn('property_id', $property_ids);
      })->count();


      // number of users
      $data['numberOfUsers'] = PageVisits::when(auth()->user()->usertype == 'Agency', function ($query) {
         $query->where('agency_id', auth()->user()->agency_id);
      })
         ->distinct('ip_address')->count();

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

      // properties per month
      foreach ($months as $key => $value) {
         $data['propertiesPer' . $value] = Properties::when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $key)
            ->count();
      }

      //properties this year
      $data['propertiesThisYear'] = Properties::when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
         ->whereYear('created_at', Carbon::now()->year)
         ->count();

      // donught chart agency enquiries
      $data['Agency Inquiry'] = Enquire::where('type', 'Agency Inquiry')
         ->when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })->count();

      // donught chart contact enquiries
      $data['Contact Inquiry'] = Enquire::where('type', 'Contact Inquiry')
         ->when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })->count();

      // donught chart property enquiries
      $data['Property Inquiry'] = Enquire::where('type', 'Property Inquiry')
         ->when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })->count();

      // clicks per month
      foreach ($months as $key => $value) {
         $data['clicksPer' . $value] = ClickCounters::whereYear('created_at', Carbon::now()->year)
            ->when(auth()->user()->usertype == 'Agency', function ($query) {
               $query->where("agency_id", Auth::User()->agency_id);
            })
            ->whereMonth('created_at', $key)->count();
      }

      // traffic per month
      foreach ($months as $key => $value) {
         $data['trafficPer' . $value] = PropertyCounter::when(auth()->user()->usertype == 'Agency', function ($query) {
               $query->where("agency_id", Auth::User()->agency_id);
            })
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $key)
            ->sum('counter');
      }
     
      // click actions of whatsapp email and call button of the whole table 
      $result = DB::table('click_counters')
      ->select('button_name', DB::raw('count(*) as total'))
      ->when(auth()->user()->usertype == 'Agency', function ($query) {
         $query->where("agency_id", Auth::User()->agency_id);
      })
      ->groupBy('button_name')
      ->where('button_name', '!=', null)
      ->get('total', 'button_name');
  
      // pie chart data for the whole table 
      $pieChart['Data'] = "[";
      $pieChart['Label'] = "[";
      foreach ($result as $key => $list) {
         $pieChart['Data'] .= $list->total ;
         $pieChart['Label'] .= "'".$list->button_name . " : ". $list->total. "'";
         if($key < (count($result) - 1)){
            $pieChart['Data'] .= "," ;
            $pieChart['Label'] .= "," ;
         }
      }
      $pieChart['Data'] .= "]";
      $pieChart['Label'] .= "]";

      // no of users per month
      foreach ($months as $key => $value) {
         $data['usersPer' . $value] = DB::table('page_visits')
            ->distinct('ip_address')
            ->when(auth()->user()->usertype == 'Agency', function ($query) {
               $query->where("agency_id", Auth::User()->agency_id);
            })
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $key)
            ->count('ip_address');
      }

      $data['propertyCities'] = PropertyCities::join("properties", "properties.city", "=", "property_cities.id")
         ->select("property_cities.id", "property_cities.name", DB::Raw("count(properties.id) as pcount"))
         ->when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("properties.agency_id", Auth::User()->agency_id);
         })
         ->where('properties.status', 1)
         ->orderBy("pcount", "desc")
         ->groupBy("property_cities.id")
         ->get();

      // Email Call and Whatsapp per month of  whole year 
      foreach ($months as $key => $value) {
         $data['EmailPer'.$value] = ClickCounters::
         when(auth()->user()->usertype == 'Agency', function($query){
               $query->where("agency_id", Auth::User()->agency_id);
         })
         ->where('button_name','Email')
         ->whereYear('created_at', Carbon::now()->year)
         ->whereMonth('created_at', $key)
         ->count();

         $data['CallPer' . $value] = ClickCounters::when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
         ->where('button_name', 'Call')
         ->whereYear('created_at', Carbon::now()->year)
         ->whereMonth('created_at', $key)
         ->count();

         $data['WhatsAppPer' . $value] = ClickCounters::when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where("agency_id", Auth::User()->agency_id);
         })
         ->where('button_name', 'WhatsApp')
         ->whereYear('created_at', Carbon::now()->year)
         ->whereMonth('created_at', $key)
         ->count();
      }

      
      $action = 'saakin_dashboard';
      return view('admin-dashboard.index', compact('data', 'action', 'pieChart'));
   }
}
