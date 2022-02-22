<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use App\User;

use App\Agency;
use App\Enquire;
use Carbon\Carbon;
use App\Http\Requests;
use App\Properties;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;

use function Ramsey\Uuid\v1;

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
            
        }
        // $agency_name = Agency::where('id',$inquirieslist->agency_id)->paginate(10);
        // dd($agency_name);

        return view('admin.pages.inquiries',compact('inquirieslist'));
    }

    public function create_inquiry(Request $request)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }
        $keyword = request()->get('keyword');
        $agencies = Agency::all();
        $properties = Properties::select('property_name','agency_id','id')->get();
        // ->where('property_name', 'like', '%'.request()->get('keyword').'%');
   
        
        return view('admin.pages.create_inquiry',compact('agencies','properties'));
    }

    public function store_property_inquiry(Request $request)
    {
        

        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'type' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
            
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $inquiry = new Enquire();

        $inquiry->agency_id = $inputs['agency_name'];
        $inquiry->property_id = $inputs['property_title'];
        $inquiry->name = $inputs['name'];
        $inquiry->email = $inputs['email'];
        $inquiry->phone = $inputs['phone'];
        $inquiry->type = $inputs['type'];
        $inquiry->subject =$inputs['subject'];
        $inquiry->message = $inputs['message'];
        $inquiry->movein_date = $inputs['movein_date'];
        $inquiry->save();

        \Session::flash('flash_message', trans('words.added'));
        return \Redirect::back();
    }

    public function property_inquiries()
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }

        if(Auth::User()->usertype=="Agency"){
        $inquirieslist = Enquire::where('agency_id',Auth::User()->agency_id)
                                        ->whereIn('type','Property Inquiry')
                                        ->orderBy('id','desc')->paginate(10);
        
        } else {
        $inquirieslist = Enquire::where('type','Property Inquiry')->orderBy('id', 'desc')->paginate(10);
        
        }

    return view('admin.pages.property_inquiries',compact('inquirieslist'));
    }

    public function agency_inquiries()
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }

        if(Auth::User()->usertype=="Agency"){
        $inquirieslist = Enquire::where('agency_id',Auth::User()->agency_id)
                                        ->whereIn('type','Agency Inquiry')
                                        ->orderBy('id','desc')->paginate(10);
        
        } else {
        $inquirieslist = Enquire::where('type','Agency Inquiry')->orderBy('id', 'desc')->paginate(10);
        
        }

    return view('admin.pages.agency_inquiries',compact('inquirieslist'));
    }

    public function contact_inquiries()
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }

        if(Auth::User()->usertype=="Agency"){
        $inquirieslist = Enquire::where('agency_id',Auth::User()->agency_id)
                                        ->whereIn('type','Contact Inquiry')
                                        ->orderBy('id','desc')->paginate(10);
        
        } else {
        $inquirieslist = Enquire::where('type','Contact Inquiry')->orderBy('id', 'desc')->paginate(10);
        
        }

    return view('admin.pages.contact_inquiries',compact('inquirieslist'));
    }

    public function delete($id)
    {
    	$decrypted_id = Crypt::decryptString($id);

        $inquire = Enquire::findOrFail($decrypted_id);


		$inquire->delete();

        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();

    }

    public function view_inquiry($id)
    {
        $inquire = Enquire::where('id', $id)->first();
        if($inquire->property_id != ''){
            
            $property = Properties::find($inquire->property_id);
            return view('admin.pages.view_inquiry',compact('inquire', 'property'));
        }
        return view('admin.pages.view_inquiry',compact('inquire'));

    }

    public function view_property_inquiry($id)
    {
        $inquire = Enquire::where('id', $id)->first();
        if($inquire->property_id != ''){
            
            $property = Properties::find($inquire->property_id);
            return view('admin.pages.view_property_inquiry',compact('inquire', 'property'));
        }
        return view('admin.pages.view_property_inquiry',compact('inquire'));

    }
    public function view_agency_inquiry($id)
    {
        $inquire = Enquire::where('id', $id)->first();
        
        return view('admin.pages.view_agency_inquiry',compact('inquire'));

    }
    public function view_contact_inquiry($id)
    {
        $inquire = Enquire::where('id', $id)->first();
       
        return view('admin.pages.view_contact_inquiry',compact('inquire'));

    }

}
