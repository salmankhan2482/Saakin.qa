<?php

namespace App\Http\Controllers\Admin;
use App\Properties;
use App\Types;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FeaturedPropertiesController extends MainAdminController
{
	public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();

    }
    public function propertieslist()
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }

        $propertieslist = Properties::where('featured_property','1')
        ->when(Auth::User()->usertype=="Agency", function($query){
            $query->where("user_id",Auth::User()->id);
        })
        ->when(request('keyword'), function($query){
            return $query->where('property_name', 'like', '%'.request('keyword').'%');
        })
        ->when(request('purpose'), function($query){
            $query->where("property_purpose", request('purpose'));
        })
        ->when(request('status') != '', function($query){
            $query->where("status", request('status'));
        })
        ->when(request('type'), function($query){
            $query->where("property_type", request('type'));
        })
        ->orderBy('id')->paginate(15);
        $data['propertyTypes'] = Types::all();
        $action = 'saakin_index';

        return view('admin-dashboard.featured-properties.index',compact('propertieslist', 'data', 'action'));
    }

    public function pendingproperties()
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }
        
        $propertieslist = Properties::where('status','0')
        ->when(Auth::User()->usertype=="Agency", function($query){
            $query->where("user_id",Auth::User()->id);
        })->orderBy('id')->get();

        return view('admin.pages.pendingproperties',compact('propertieslist'));
    }

}
