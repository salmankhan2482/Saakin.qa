<?php

namespace App\Http\Controllers\Admin;

use App\Types;
use App\Agency;

use App\Enquire;
use App\Lead;
use App\Properties;
use App\PropertyAreas;
use App\PropertyTowns;
use App\PropertyCities;

use App\PropertyAmenity;
use App\PropertyPurpose;
use App\PropertySubCities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class InquiriesController extends MainAdminController
{
   public function __construct()
   {
      $this->middleware('auth');
      parent::__construct();
   }

   public function inquirieslist()
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         Session::flash('flash_message', trans('words.access_denied'));
         return redirect('dashboard');
      }

      $inquirieslist = Enquire::when(Auth::User()->usertype == "Agency", function ($query) {
         $query->where('agency_id', Auth::User()->agency_id);
      })->orderBy('id', 'desc')->paginate(10);

      $action = 'saakin_index';

      return view('admin-dashboard.inquiries.index', compact('inquirieslist', 'action'));
   }

   public function create_inquiry(Request $request)
   {
      if (Auth::User()->usertype != "Admin") {
         Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }
      $keyword = request()->get('keyword');
      // $data['agenices'] = Agency::all();
      $data['keyword'] = Agency::select("name as agency_name", "id as id")->where("name", "LIKE", "%{$request->input('keyword')}%")->get();

      $properties = Properties::select('property_name', 'agency_id', 'id')->get();

      $data['types'] = Types::orderBy('types')->get();
      $data['purposes'] = PropertyPurpose::get();
      $data['amenities'] = PropertyAmenity::orderBy("name", "asc")->get();

      $data['cities'] = PropertyCities::all();
      $data['subCities'] = PropertySubCities::all();
      $data['towns'] = PropertyTowns::all();
      $data['areas'] = PropertyAreas::all();

      $action = 'saakin_index';

      return view(
         'admin-dashboard.inquiries.property_inquires.create',
         compact('data', 'properties', 'action')
      );
   }



   public function store_property_inquiry(Request $request)
   {
      dd($request);
      $data =  \Request::except(array('_token'));
      $inputs = $request->all();
      $rule = array(

         'name' => 'required',
         'email' => 'required',
         'phone' => 'required',
         'message' => 'required',
      );

      $validator = \Validator::make($data, $rule);

      if ($validator->fails()) {
         return redirect()->back()->withErrors($validator->messages());
      }

      $property_lead = new Lead();

      $property_lead->name = $inputs['name'];
      $property_lead->email = $inputs['email'];
      $property_lead->phone = $inputs['phone'];
      $property_lead->property_id = $inputs['property_title'];
      $property_lead->property_title = $inputs['property_title'];
      $property_lead->property_purpose = $inputs['property_purpose'];
      $property_lead->property_type = $inputs['property_type'];
      $property_lead->bedrooms = $inputs['bedrooms'];
      $property_lead->bathrooms = $inputs['bathrooms'];
      $property_lead->budget = $inputs['budget'];
      $property_lead->land_area = $inputs['land_area'];
      $property_lead->timeframe = $inputs['timeframe'];
      $property_lead->source = $inputs['source'];
      $property_lead->city = $inputs['city'];
      $property_lead->subcity = $inputs['subcity'];
      $property_lead->town = $inputs['town'];
      $property_lead->area = $inputs['area'];
      $property_lead->latitude = $inputs['latitude'];
      $property_lead->longitude = $inputs['longitude'];
      $property_lead->subject = $inputs['subject'];
      $property_lead->message = $inputs['message'];
      $property_lead->status = $inputs['status'];

      $inquiry = new Enquire();
      $inquiry->property_id = $inputs['property_title'];
      $inquiry->agency_id = Properties::where('id', $request->property_title)->value('agency_id');
      $inquiry->enquire_id = 2;
      $inquiry->name = $inputs['name'];
      $inquiry->email = $inputs['email'];
      $inquiry->phone = $inputs['phone'];
      $inquiry->type = str_replace('-', ' ', $inputs['type']);
      $inquiry->subject = $inputs['subject'];
      $inquiry->message = $inputs['message'];
      $inquiry->movein_date = $inputs['movein_date'];
      $inquiry->save();

      Session::flash('flash_message', trans('words.added'));
      return \Redirect::back();
   }

   public function search_agency_name(Request $request)
   {
      $data = Agency::select('name')->where("name", "LIKE", "%{$request->value}%")->get();
      return response()->json($data);
   }

   public function showsearch(Request $request)
   {
      $action = 'saakin_index';

      return view('admin-dashboard.inquiries.property_inquires.show', 'action');
   }

   public function getResults(Request $request)
   {
      $data = Agency::select('name')->where("name", "LIKE", "%{$request->value}%")->get();
      return response()->json($data);
   }


   public function show_agency()
   {
      $action = 'saakin_index';
      return view('admin-dashboard.inquiries.property_inquires.show_agency', compact('action'));
   }

   public function searchagency(Request $request)
   {
      $data = Agency::select("name as value", "id")
         ->where('name', 'LIKE', '%' . $request->get('search') . '%')
         ->get();

      return response()->json($data);
   }

   public function property_search(Request $request)
   {
      $data = Properties::select("property_name as value", "id")
         ->where('property_name', 'LIKE', $request->get('property_search'))
         ->get();

      return response()->json($data);
   }

   public function property_inquiries()
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         Session::flash('flash_message', trans('words.access_denied'));
         return redirect('dashboard');
      }

      $inquirieslist = Enquire::when(Auth::User()->usertype == "Agency", function ($query) {
         $query->where('agency_id', Auth::User()->agency_id);
      })
         ->where('type', 'Property Inquiry')->orderBy('id', 'desc')
         ->whereNotNull('property_id')->paginate(10);
      $action = 'saakin_index';
      return view('admin-dashboard.inquiries.property_inquires.property_inquiries', compact('inquirieslist', 'action'));
   }

   public function agency_inquiries()
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         Session::flash('flash_message', trans('words.access_denied'));
         return redirect('dashboard');
      }

      $inquirieslist = Enquire::when(Auth::User()->usertype == "Agency", function ($query) {
         $query->where('agency_id', Auth::User()->agency_id);
      })->where('type', 'Agency Inquiry')->orderBy('id', 'desc')->paginate(10);

      $action = 'saakin_index';
      return view(
         'admin-dashboard.inquiries.agency_inquires.agency_inquiries',
         compact('inquirieslist', 'action')
      );
   }

   public function contact_inquiries()
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         Session::flash('flash_message', trans('words.access_denied'));
         return redirect('dashboard');
      }

      $inquirieslist = Enquire::when(Auth::User()->usertype == "Agency", function ($query) {
         $query->where('agency_id', Auth::User()->agency_id);
      })->where('type', 'Contact Inquiry')->orderBy('id', 'desc')->paginate(10);

      $action = 'saakin_index';

      return view('admin-dashboard.inquiries.contact_inquires.contact_inquiries', compact('inquirieslist', 'action'));
   }

   public function delete($id)
   {
      $decrypted_id = Crypt::decryptString($id);
      $inquire = Enquire::findOrFail($decrypted_id);
      $inquire->delete();

      Session::flash('flash_message', trans('words.deleted'));
      return redirect()->back();
   }

   public function view_inquiry(Enquire $enquire)
   {
      $similarProperties = Properties::where('status', 1)
         ->where('property_purpose', $enquire->property->property_purpose)
         ->where('property_type', $enquire->property->property_type)
         ->where('bedrooms', $enquire->property->bedrooms)
         ->whereBetween('price', [$enquire->property->price - 2000, $enquire->property->price + 2000])
         ->where('city', $enquire->property->city)
         ->where('subcity', $enquire->property->subcity)
         ->where('town', $enquire->property->town)
         ->where('area', $enquire->property->area)
         ->get();

      $nearBy  = Properties::where('status', 1)
         ->where('property_purpose', $enquire->property->property_purpose)
         ->whereBetween('price', [$enquire->property->price - 2000, $enquire->property->price + 2000]);

      if ($enquire->property->area) {
         $nearBy = $nearBy->where('town', $enquire->property->town);
      } elseif ($enquire->property->town) {
         $nearBy = $nearBy->where('subcity', $enquire->property->subcity);
      } elseif ($enquire->property->subcity) {
         $nearBy = $nearBy->where('city', $enquire->property->city);
      }

      $availableNearbyProperties = $nearBy->paginate();

      if (request()->ajax()) {
         $view = view('admin-dashboard.inquiries.property_inquires.nearby-properties',
         compact('availableNearbyProperties'))->render();
         return response()->json(['html'=>$view]);
      }

      $action = 'saakin_index';

      return view(
         'admin-dashboard.inquiries.property_inquires.view_property_inquiry',
         compact('similarProperties', 'availableNearbyProperties', 'action', 'enquire')
      );
   }

   public function view_property_inquiry(Enquire $enquire)
   {
      $inquire = Enquire::where('id', $enquire)->first();
      $inquire->enquire_id = 1;
      $inquire->update();

      if ($inquire->property_id != '') {
         $property = Properties::find($inquire->property_id);
         $action = 'saakin_create';

         return view(
            'admin-dashboard.inquiries.property_inquires.view_property_inquiry',
            compact('inquire', 'property', 'action')
         );
      }
      return view(
         'admin-dashboard.inquiries.property_inquires.view_property_inquiry',
         compact('inquire', 'action')
      );
   }
   public function view_agency_inquiry($id)
   {
      $inquire = Enquire::where('id', $id)->first();
      $inquire->enquire_id = 1;
      $inquire->update();

      $action = 'saakin_create';
      return view('admin-dashboard.inquiries.agency_inquires.view_agency_inquiry', compact('inquire', 'action'));
   }
   public function view_contact_inquiry($id)
   {
      $inquire = Enquire::where('id', $id)->first();
      $inquire->enquire_id = 1;
      $inquire->update();

      $action = 'saakin_create';
      return view('admin-dashboard.inquiries.contact_inquires.view_contact_inquiry', compact('inquire', 'action'));
   }

   public function notifications()
   {
      if (Auth::User()->usertype == "Agency") {
         $inquirieslist = Enquire::where('agency_id', Auth::User()->agency_id)->orderBy('id', 'desc')->paginate(10);
      } else {
         $inquirieslist = Enquire::orderBy('id', 'desc')->paginate(10);
      }

      $action = 'saakin_index';
      return view('admin-dashboard.notifications.notifications', compact('inquirieslist', 'action'));
   }
   public function view_notification($id)
   {
      $inquire = Enquire::where('id', $id)->first();
      $inquire->enquire_id = 1;
      $inquire->update();

      if ($inquire->property_id != '') {
         $property = Properties::find($inquire->property_id);
         $action = 'saakin_create';

         return view(
            'admin-dashboard.notifications.view_notification',
            compact('inquire', 'property', 'action')
         );
      }

      $action = 'saakin_create';
      return view('admin-dashboard.notifications.view_notification', compact('inquire', 'action'));
   }

   public function markAllAsRead()
   {
      Enquire::where('id', '>', 0)->update(['enquire_id' => 1]);
      return redirect()->back();
   }
}
