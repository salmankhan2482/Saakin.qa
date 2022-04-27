<?php

namespace App\Http\Controllers\Admin;

use App\Agency;
use App\Properties;
use App\ClickCounters;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\PropertyCounter;

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
        if(auth()->user()->usertype == 'Agency'){
            return $this->agencyCallToActionList(auth()->user()->agency_id);
        }

        $data['clickCounters'] = DB::table('click_counters')
        ->join('agencies', 'click_counters.agency_id', 'agencies.id')
        ->select('agencies.name as agency_name','agencies.*','click_counters.created_at as created_at',
        'agencies.id as agency_id', DB::raw('COUNT(click_counters.button_name) as totalCall'))
        ->orderBy('totalCall', 'DESC')
        ->when(request('from') , function ($query) {
            $query->where('click_counters.created_at', '>=', request('from').' 00:00:01');
        })
        ->when(request('to') , function ($query) {
            $query->where('click_counters.created_at', '<=', request('to').' 23:59:59');
        })
        ->when(request('from') && request('to'), function ($query) {
            $query->whereBetween('click_counters.created_at', [request('from').' 00:00:01' , request('to').' 23:59:59']);
        })
        ->groupBy('agency_name')->paginate(10);

        $action = 'saakin_index';
        return view('admin-dashboard.traffic-pages.call-to-action.index',compact('data','action'));
    }

    public function agencyCallToActionList($id)
    {
        $data['clickCounters'] = DB::table('click_counters')
        ->leftJoin('properties', 'click_counters.property_id', 'properties.id')
        ->select('click_counters.button_name as cbutton_name',
        DB::raw('count(IF(button_name = "Call",1,NULL)) totalCall'),
        DB::raw('count(IF(button_name = "Email",1,NULL)) totalEmail'),
        DB::raw('count(IF(button_name = "WhatsApp",1,NULL)) totalWhatsApp'),
        'properties.id as pid', 'properties.property_name as pname', 
        'properties.property_purpose as ppurpose', 'properties.property_slug as pslug')
        ->where('properties.agency_id', $id)
        ->groupBy('pname')->paginate(10);

        $action = 'saakin_index';
        return view('admin-dashboard.traffic-pages.call-to-action.list',compact('data','action'));

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
            ->when(request('from') , function ($query) {
                $query->where('property_counters.created_at', '>=', request('from').' 00:00:01');
            })
            ->when(request('to') , function ($query) {
                $query->where('property_counters.created_at', '<=', request('to').' 23:59:59');
            })
            ->when(request('from') && request('to'), function ($query) {
                $query->whereBetween('property_counters.created_at', [request('from').' 00:00:01' , request('to').' 23:59:59']);
            })->paginate(10);
            
            return view('admin-dashboard.traffic-pages.propertyVisits-per-month.agency-index', compact('data', 'action'));

        }else{
            $data['propertyVisitsPerMonth'] = DB::table('property_counters')
            ->join('agencies', 'property_counters.agency_id', 'agencies.id')
            ->select('agencies.id as aid', 'agencies.name as aname', DB::raw(' SUM(property_counters.counter) as totalTraffic '))
            ->orderBy('totalTraffic', 'desc')
            ->when(request('from') , function ($query) {
                $query->where('property_counters.created_at', '>=', request('from').' 00:00:01');
            })
            ->when(request('to') , function ($query) {
                $query->where('property_counters.created_at', '<=', request('to').' 23:59:59');
            })
            ->when(request('from') && request('to'), function ($query) {
                $query->whereBetween('property_counters.created_at', [request('from').' 00:00:01' , request('to').' 23:59:59']);
            })->groupBy('agencies.name')->paginate(10);
            return view('admin-dashboard.traffic-pages.propertyVisits-per-month.index', compact('data', 'action'));
        }
    }


    public function trafficUsers()
    {
        $action = 'saakin_index';

        if(auth()->user()->usertype == 'Admin'){
            
            $users =  DB::table('page_visits')
            ->join('agencies', 'page_visits.agency_id', 'agencies.id')
            ->select('agencies.*', DB::raw(' COUNT(DISTINCT page_visits.ip_address) as totalUsers '))
            ->when(request('from') , function ($query) {
                $query->where('page_visits.created_at', '>=', request('from').' 00:00:01');
            })
            ->when(request('to') , function ($query) {
                $query->where('page_visits.created_at', '<=', request('to').' 23:59:59');
            })
            ->when(request('from') && request('to'), function ($query) {
                $query->whereBetween('page_visits.created_at', [request('from').' 00:00:01' , request('to').' 23:59:59']);
            })
            ->orderBy('totalUsers', 'DESC')
            ->groupBy('name')
            ->paginate(10);
            
            return view('admin-dashboard.traffic-pages.users.index', compact('users','action'));
        }elseif(auth()->user()->usertype == 'Agency'){
            
            $users = DB::table('page_visits')->where('agency_id', auth()->user()->agency_id)
                ->select('page_visits.*', DB::raw(' COUNT(DISTINCT page_visits.ip_address) as totalUsers '))
                ->when(request('from') , function ($query) {
                    $query->where('page_visits.created_at', '>=', request('from').' 00:00:01');
                })
                ->when(request('to') , function ($query) {
                    $query->where('page_visits.created_at', '<=', request('to').' 23:59:59');
                })
                ->when(request('from') && request('to'), function ($query) {
                    $query->whereBetween('page_visits.created_at', [request('from').' 00:00:01' , request('to').' 23:59:59']);
                })->orderBy('totalUsers', 'DESC')
                ->groupBy('country')
                ->paginate(10);
                
            return view('admin-dashboard.traffic-pages.users.agency_index', compact('users','action'));
        }
    }

    public function totalClicks()
    {   
        if (auth()->user()->usertype == 'Agency') {
            $property_ids = Properties::where('agency_id', auth()->user()->agency_id)->get(['id'])->toArray();

            $clicksPerMonths = ClickCounters:: whereMonth('created_at', Carbon::now()->month)
            ->whereIn('property_id', $property_ids)->paginate();

        }else{
            $clicksPerMonths = '';
        }
        return view('admin.pages.traffic-pages.totalClicks', compact('clicksPerMonths'));
    }
    
    public function topTenProperties()
    {
        $action = 'saakin_index';

        if (auth()->user()->usertype == 'Agency') {
           
            $top10Proprties = DB::table('properties')
            ->join('property_counters', 'properties.id', 'property_counters.property_id')
            ->select('properties.id', 'properties.property_name', 'properties.property_purpose', 
            'properties.property_slug', 'property_counters.counter')
            ->where('properties.agency_id', auth()->user()->agency_id)
            ->orderByDesc('property_counters.counter')

            ->limit('10')
            ->paginate(10);


            return view('admin-dashboard.traffic-pages.top-ten-properties.agency_index', compact('top10Proprties','action'));

        }else{
            $top10Proprties = DB::table('property_counters')
            ->join('agencies', 'property_counters.agency_id', 'agencies.id')
            ->select(DB::raw(' SUM(property_counters.counter) as counter '), 
            'agencies.name as aname', 'agencies.id as aid')
            ->orderBy('counter', 'DESC')
            ->groupBy('aname')
            ->paginate(10);

            return view('admin-dashboard.traffic-pages.top-ten-properties.index', compact('top10Proprties','action'));
        }

    }

    public function topTenPropertiesList($id)
    {
        $top10Proprties = DB::table('properties')
        ->join('property_counters', 'properties.id', 'property_counters.property_id')
        ->select('properties.id', 'properties.property_name', 'properties.property_purpose', 
        'properties.property_slug', DB::raw(' SUM(property_counters.counter) as counter '))
        ->where('properties.agency_id', $id)
        ->groupBy('properties.id')
        ->orderByDesc('counter')
        ->limit('10')
        ->paginate(10);

        $action = 'saakin_index';

        return view('admin-dashboard.traffic-pages.top-ten-properties.agency_index', compact('top10Proprties','action'));
    }

    public function top10Areas()
    {
        $action = 'saakin_index';

        if (auth()->user()->usertype == 'Agency') {

            $property_ids = Properties::where('agency_id', auth()->user()->agency_id)->get(['id'])->toArray();
            $top10Properties = DB::table('properties')
            ->join('property_counters', 'properties.id', 'property_counters.property_id')
            ->select('properties.id', 'properties.address as paddress', 'property_counters.counter as ')
            ->whereIn('properties.id', $property_ids)
            ->groupBy('properties.id')

            ->orderByDesc('counter')
            ->limit('5')
            ->paginate(10);

            
            return view('admin-dashboard.traffic-pages.top-five-areas.agency_index', compact('top10Properties','action'));

        }else{

            $top10Properties = DB::table('properties')
            ->join('property_counters', 'properties.id', 'property_counters.property_id')
            ->join('agencies', 'properties.agency_id', 'agencies.id')
            ->select('properties.id', 'agencies.name as aname', 'agencies.id as aid', 'property_counters.counter')
            ->orderByDesc('property_counters.counter')
            ->groupBy('agencies.name')
            ->limit('5')
            ->paginate(10);

            return view('admin-dashboard.traffic-pages.top-five-areas.index', compact('top10Properties','action'));

        }
    }

    public function top10AreasList($id)
    {
        $top10Properties = DB::table('property_counters')
        ->join('properties', 'property_counters.property_id', 'properties.id')
        ->select('properties.id as pid', 'property_counters.counter', 'properties.address as paddress')
        ->where('properties.agency_id', $id)
        ->groupBy('paddress')
        ->orderByDesc('property_counters.counter')
        ->limit('10')
        ->paginate(10);
        $action = 'saakin_index';
        
        $agency = Agency::where('id', $id)->value('name');
        
        return view('admin-dashboard.traffic-pages.top-five-areas.agency_index', compact('top10Properties','action', 'agency'));

    }

    public function totalLeads()
    {
        $action = 'saakin_index';
        return view('admin-dashboard.traffic-pages.leads.index', compact('action'));
    }

    
   
}
