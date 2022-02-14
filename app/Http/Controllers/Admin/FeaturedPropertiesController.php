<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Properties;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                \Session::flash('flash_message', trans('words.access_denied'));
                return redirect('dashboard');
            }
        if(Auth::User()->usertype=="Agency"){
            $propertieslist = Properties::where('featured_property','1')->where("user_id",Auth::User()->id)->orderBy('id')->get();
        }
        else{
    	    $propertieslist = Properties::where('featured_property','1')->orderBy('id')->get();
        }

        return view('admin.pages.featuredproperty',compact('propertieslist'));
    }

    public function pendingproperties()
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){

                \Session::flash('flash_message', trans('words.access_denied'));

                return redirect('dashboard');

            }
        if(Auth::User()->usertype=="Agency")
        {
            $propertieslist = Properties::where('status','0')->where("user_id",Auth::User()->id)->orderBy('id')->get();
        }
        else
        {
    	    $propertieslist = Properties::where('status','0')->orderBy('id')->get();
        }

        return view('admin.pages.pendingproperties',compact('propertieslist'));
    }

}
