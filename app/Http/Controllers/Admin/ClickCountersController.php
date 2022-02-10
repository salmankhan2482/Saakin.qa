<?php

namespace App\Http\Controllers\Admin;

use App\PageVisits;
use App\Properties;
use App\ClickCounters;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\PropertyCounter;

class ClickCountersController extends Controller
{
    public function index()
    {
        $clickCounters = DB::table('click_counters')
        ->leftJoin('properties', 'click_counters.property_id', 'properties.id')
        ->rightJoin('agencies', 'properties.agency_id', 'agencies.id')
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
        ->groupBy('agency_name')
        ->get();
        return view('admin.pages.traffic-pages.total-clicks.index',compact('clickCounters'));
    }

    public function agencyTotalClicksList($id)
    {
        $clickCounters = DB::table('click_counters')
        ->leftJoin('properties', 'click_counters.property_id', 'properties.id')
        ->select('click_counters.button_name as cbutton_name',
        DB::raw('count(IF(button_name = "Call",1,NULL)) totalCall'),
        DB::raw('count(IF(button_name = "Email",1,NULL)) totalEmail'),
        DB::raw('count(IF(button_name = "WhatsApp",1,NULL)) totalWhatsApp'),
        'properties.id as pid', 'properties.property_name as pname', 
        'properties.property_purpose as ppurpose', 'properties.property_slug as pslug')
        ->where('properties.agency_id', $id)
        ->groupBy('pname')
        ->get();

        return view('admin.pages.traffic-pages.total-clicks.show-list', compact('clickCounters'));
    }

    public function show($property_id)
    {
        $clickCounters = ClickCounters::where('property_id', $property_id)->get();
        return view('admin.pages.traffic-pages.show', compact('clickCounters'));
    }

    public function trafficPerMonth()
    {

        if (auth()->user()->usertype == 'Agency') {
            $property_ids = Properties::where('agency_id', auth()->user()->agency_id)->get(['id'])->toArray();

            $trafficPerMonth = PropertyCounter:: whereMonth('created_at', Carbon::now()->month)
            ->whereIn('property_id', $property_ids)
            ->when(request('from') && request('to'), function ($query) {
                $query->whereBetween('property_counters.created_at', [request('from') , request('to')]);
            })
            ->get();

            return view('admin.pages.traffic-pages.traffic-per-month.agency-index', compact('trafficPerMonth'));

        }else{
            $trafficPerMonth = DB::table('property_counters')
            ->leftJoin('properties', 'property_counters.property_id', 'properties.id')
            ->leftJoin('agencies', 'properties.agency_id', 'agencies.id')
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
            })
            ->groupBy('agencies.name')
            ->get();
            return view('admin.pages.traffic-pages.traffic-per-month.index', compact('trafficPerMonth'));
        }
    }

    public function agencyTrafficList($id)
    {
            $totalTraffic = DB::table('property_counters')
            ->join('properties', 'property_counters.property_id', 'properties.id')
            ->select('properties.id as pid', 'properties.property_name as pname', 
            'properties.property_purpose as ppurpose', 'properties.property_slug as pslug',
            'property_counters.counter as count')
            ->where('properties.agency_id', $id)
            ->orderBy('count', 'desc')
            ->get();

            return view('admin.pages.traffic-pages.traffic-per-month.show-list', compact('totalTraffic'));
    }

    public function totalClicks()
    {   
        if (auth()->user()->usertype == 'Agency') {
            $property_ids = Properties::where('agency_id', auth()->user()->agency_id)->get(['id'])->toArray();

            // clicks per month
            $clicksPerMonths = ClickCounters:: whereMonth('created_at', Carbon::now()->month)
            ->whereIn('property_id', $property_ids)->paginate();

        }else{
            $clicksPerMonths = '';
        }
        return view('admin.pages.traffic-pages.totalClicks', compact('clicksPerMonths'));
    }
    
    public function topTenProperties()
    {
        if (auth()->user()->usertype == 'Agency') {
           
            $property_ids = Properties::where('agency_id', auth()->user()->agency_id)->get(['id'])->toArray();
            
            $top10Proprties = DB::table('properties')
            ->join('property_counters', 'properties.id', 'property_counters.property_id')
            ->select('properties.id', 'properties.property_name', 'properties.property_purpose', 'properties.property_slug', 'property_counters.counter')
            ->where('properties.agency_id', auth()->user()->agency_id)
            ->groupBy('properties.id')
            ->orderByDesc('property_counters.counter')
            ->limit('10')
            ->get();

        }else{
            $top10Proprties = '';
        }

        return view('admin.pages.traffic-pages.topTenProperties', compact('top10Proprties'));
    }

    public function top5Areas()
    {
        $property_ids = Properties::where('agency_id', auth()->user()->agency_id)->get(['id'])->toArray();
        $top5Properties = DB::table('properties')
        ->join('property_counters', 'properties.id', 'property_counters.property_id')
        ->leftJoin('property_areas', 'properties.area', 'property_areas.id')
        ->select('properties.id', 'property_areas.name as area_name', 'property_counters.counter')
        ->whereIn('properties.id', $property_ids)
        ->groupBy('properties.id')
        ->orderByDesc('property_counters.counter')
        ->limit('5')
        ->get();

        return view('admin.pages.traffic-pages.top5Areas', compact('top5Properties'));
    }

    public function totalLeads()
    {
        return view('admin.pages.traffic-pages.totalLeads');
    }

    
   
}
