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
        $action = 'saakin_index';

        return view('admin-dashboard.inquiries.inquiries',compact('inquirieslist','action'));
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
        $action = 'saakin_index';
        
        return view('admin-dashboard.inquiries.property_inquires.create',
        compact('agencies','properties','action'));
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

        if($inputs['type']=='Property-Inquiry')
        {
            $inquiry->property_id = $inputs['property_title'];
            $inquiry->agency_id = Properties::where('id',$request->property_title)->value('agency_id');
            $inquiry->name = $inputs['name'];
            $inquiry->email = $inputs['email'];
            $inquiry->phone = $inputs['phone'];
            $inquiry->type = str_replace('-', ' ', $inputs['type']);
            $inquiry->subject =$inputs['subject'];
            $inquiry->message = $inputs['message'];
            $inquiry->movein_date = $inputs['movein_date'];
            $inquiry->save();
            
        }else
        {
        
            $inquiry->agency_id = $inputs['agency_name'];
        $inquiry->property_id = $inputs['property_title'];
        $inquiry->name = $inputs['name'];
        $inquiry->email = $inputs['email'];
        $inquiry->phone = $inputs['phone'];
        $inquiry->type = str_replace('-', ' ', $inputs['type']);
        $inquiry->subject =$inputs['subject'];
        $inquiry->message = $inputs['message'];
        $inquiry->movein_date = $inputs['movein_date'];
        $inquiry->save();

        }

        

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

        $action = 'saakin_index';
    return view('admin-dashboard.inquiries.property_inquires.property_inquiries',
    compact('inquirieslist','action'));
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
        $action = 'saakin_index';
    return view('admin-dashboard.inquiries.agency_inquires.agency_inquiries',
    compact('inquirieslist','action'));
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
        $action = 'saakin_index';

    return view('admin-dashboard.inquiries.contact_inquires.contact_inquiries',compact('inquirieslist','action'));
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

            $action = 'saakin_create';
            return view('admin-dashboard.inquiries.property_inquires.view_property_inquiry',
            compact('inquire', 'property','action'));
        }
        $action = 'saakin_create';
        return view('admin-dashboard.inquiries.property_inquires.view_property_inquiry',
        compact('inquire','action'));

    }

    public function view_property_inquiry($id)
    {
        $inquire = Enquire::where('id', $id)->first();
        if($inquire->property_id != ''){
            
            $property = Properties::find($inquire->property_id);

            $action = 'saakin_create';

            return view('admin-dashboard.inquiries.property_inquires.view_property_inquiry',
            compact('inquire', 'property','action'));
        }
        return view('admin-dashboard.inquiries.property_inquires.view_property_inquiry',
        compact('inquire','action'));

    }
    public function view_agency_inquiry($id)
    {
        $inquire = Enquire::where('id', $id)->first();
        $action = 'saakin_create';
        return view('admin-dashboard.inquiries.agency_inquires.view_agency_inquiry',compact('inquire','action'));

    }
    public function view_contact_inquiry($id)
    {
        $inquire = Enquire::where('id', $id)->first();
        $action = 'saakin_create';
        return view('admin-dashboard.inquiries.contact_inquires.view_contact_inquiry',compact('inquire','action'));

    }

}
