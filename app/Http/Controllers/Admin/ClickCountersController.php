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
        ->leftJoin('agencies', 'agencies.id', 'properties.agency_id')
        ->select('click_counters.*', 'properties.id', 'properties.property_name',
        'properties.property_purpose', 'properties.property_slug', 
        'agencies.id as agency_id', 'agencies.name as agency_name')
        ->groupBy('properties.property_name')
        ->orderBy('click_counters.id')
        ->get();
        
        return view('admin.pages.traffic-pages.index',compact('clickCounters'));
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

            $trafficPerMonth = PageVisits:: whereMonth('created_at', Carbon::now()->month)
            ->whereIn('property_id', $property_ids)->paginate();

        }else{
            $trafficPerMonth = '';
        }

        return view('admin.pages.traffic-pages.trafficPerMonth', compact('trafficPerMonth'));

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
