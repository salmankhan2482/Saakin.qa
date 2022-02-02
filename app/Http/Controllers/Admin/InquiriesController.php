<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Enquire;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class InquiriesController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		 parent::__construct();
    }

    public function inquirieslist()
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
                \Session::flash('flash_message', trans('words.access_denied'));
                return redirect('dashboard');
            }

        if(Auth::User()->usertype=="Agency"){
            $inquirieslist = Enquire::where('agency_id',Auth::User()->agency_id)->orderBy('id','desc')->paginate(10);
            
        } else {
            $inquirieslist = Enquire::orderBy('id', 'desc')->paginate(10);
            dd($inquirieslist);
        }
        

        return view('admin.pages.inquiries',compact('inquirieslist'));
    }


    public function delete($id)
    {
    	$decrypted_id = Crypt::decryptString($id);

        $inquire = Enquire::findOrFail($decrypted_id);


		$inquire->delete();

        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();

    }


}
