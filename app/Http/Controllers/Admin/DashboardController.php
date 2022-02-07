<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Enquire;
use App\Partners;
use App\Properties;
use App\Subscriber;
use App\Testimonials;
use App\Transactions;
use App\ClickCounters;

use App\Http\Requests;
use App\PageVisits;
use App\SubscriptionPlan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

    }
    public function index()
    {
    	 	if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
	            \Session::flash('flash_message', trans('words.access_denied'));
	            return redirect('dashboard');
	        }
            if(Auth::User()->usertype=="Agency")
            {
                $agency_id = Auth::User()->id;
                $properties_count = Properties::where("agency_id",$agency_id)->get()->count();
                $pending_properties_count = Properties::where('status', '0')->where("agency_id",$agency_id)->get()->count();
                $featured_properties = Properties::where('featured_property', '1')->where("agency_id",$agency_id)->get()->count();

                //Inquiries
                $inquiries = Enquire::where('agency_id',Auth::User()->agency_id)->orderBy('id','desc')->get()->count();
                
                $property_ids = Properties::where('agency_id', auth()->user()->agency_id)->get(['id'])->toArray();
                
                //traffic per month
                $trafficPerMonth = PageVisits:: whereMonth('created_at', Carbon::now()->month)
                ->whereIn('property_id', $property_ids)->get();

                // clicks per month
                $clicksPerMonths = ClickCounters:: whereMonth('created_at', Carbon::now()->month)
                ->whereIn('property_id', $property_ids)->get();
                

                //top 10 properties
                $top10Proprties = '';

                $top5Properties = '';

            }
            else
            {
                $properties_count = Properties::count();
                $pending_properties_count = Properties::where('status', '0')->count();
                $featured_properties = Properties::where('featured_property', '1')->count();
                $inquiries = Enquire::count();               
                $trafficPerMonth = '';
                $clicksPerMonths = '';
                $top10Proprties = '';
                $top5Properties = '';
            }
            return view('admin.pages.dashboard',
            compact('properties_count','pending_properties_count', 'trafficPerMonth', 'clicksPerMonths', 'featured_properties','inquiries', 'top10Proprties', 'top5Properties'));
    }



}
