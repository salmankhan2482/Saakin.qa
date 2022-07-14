<?php

namespace App\Http\Controllers\Admin;

use App\Types;
use App\Agency;

use App\Enquire;
use App\Lead;
use App\LeadForwardAgent;
use App\Properties;
use App\PropertyCities;

use App\PropertyAmenity;
use App\PropertyPurpose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class LeadsController extends MainAdminController
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

      $inquirieslist = Lead::when(Auth::User()->usertype == "Agency", function ($query) {
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
      $data['agenices'] = Agency::all();
      $data['types'] = Types::orderBy('types')->get();
      $data['purposes'] = PropertyPurpose::get();
      $data['amenities'] = PropertyAmenity::orderBy("name", "asc")->get();
      $data['cities'] = PropertyCities::all();
      $action = 'saakin_index';
      return view('admin-dashboard.inquiries.property_inquires.create', compact('data', 'action'));
   }

   public function store_property_inquiry(Request $request)
   {
      // dd($request->all());
      $request->validate([
         'agency_id' => 'required',
         'reference_id' => 'required',
         'property_title' => 'required',
         'property_id' => 'required',
         'property_purpose' => 'required',
         'property_type' => 'required',
         'price' => 'required',
         'city' => 'required',
         'name' => 'required',
         'email' => 'required',
         'phone' => 'required',
         'source' => 'required',
         'subject' => 'required',
         'forward_agents' => 'required',
         'movein_date' => 'required',
         'message' => 'required',
      ]);
      $inputs = $request->all();
      $property_lead = new Lead();
      $property_lead->agency_id = $inputs['agency_id'];
      $property_lead->agent_id = $inputs['agent_id'];
      $property_lead->type = 'Property Inquiry';
      $property_lead->name = $inputs['name'];
      $property_lead->email = $inputs['email'];
      $property_lead->phone = $inputs['phone'];
      $property_lead->subject = $inputs['subject'];
      $property_lead->message = $inputs['message'];
      $property_lead->reference_id = $inputs['reference_id'];
      $property_lead->property_title = $inputs['property_title'];
      $property_lead->property_id = $inputs['property_id'];
      $property_lead->property_purpose = $inputs['property_purpose'];
      $property_lead->property_type = $inputs['property_type'];
      $property_lead->timeframe = $inputs['time_frame'];
      $property_lead->price = $inputs['price'];
      $property_lead->land_area = $inputs['land_area'];
      $property_lead->bedrooms = $inputs['bedrooms'];
      $property_lead->bathrooms = $inputs['bathrooms'];
      $property_lead->city = $inputs['city'];
      $property_lead->subcity = $inputs['subcity'];
      $property_lead->town = $inputs['town'];
      $property_lead->area = $inputs['area'];
      $property_lead->latitude = $inputs['map_longitude'];
      $property_lead->longitude = $inputs['map_latitude'];
      $property_lead->source = $inputs['source'];
      $property_lead->movein_date = $inputs['movein_date'];
      $property_lead->save();

      foreach ($request->forward_agents as $key => $agent) {
         $forwardAgent = new LeadForwardAgent();
         $forwardAgent->agency_id = $agent;
         $forwardAgent->lead_id = $inputs['agency_id'];
         $forwardAgent->save();
      }

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

      $inquirieslist = Lead::when(Auth::User()->usertype == "Agency", function ($query) {
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

      $inquirieslist = Lead::when(Auth::User()->usertype == "Agency", function ($query) {
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

      $inquirieslist = Lead::when(Auth::User()->usertype == "Agency", function ($query) {
         $query->where('agency_id', Auth::User()->agency_id);
      })->where('type', 'Contact Inquiry')->orderBy('id', 'desc')->paginate(10);

      $action = 'saakin_index';

      return view('admin-dashboard.inquiries.contact_inquires.contact_inquiries', compact('inquirieslist', 'action'));
   }

   public function delete($id)
   {
      $decrypted_id = Crypt::decryptString($id);
      $inquire = Lead::findOrFail($decrypted_id);
      $inquire->delete();

      Session::flash('flash_message', trans('words.deleted'));
      return redirect()->back();
   }

   public function view_inquiry(Lead $lead)
   {
      $similarProperties = Properties::where('status', 1)
         ->where('property_purpose', $lead->property->property_purpose)
         ->where('property_type', $lead->property->property_type)
         ->where('bedrooms', $lead->property->bedrooms)
         ->whereBetween('price', [$lead->property->price - 2000, $lead->property->price + 2000])
         ->where('city', $lead->property->city)
         ->where('subcity', $lead->property->subcity)
         ->where('town', $lead->property->town)
         ->where('area', $lead->property->area)
         ->get();

      $nearBy  = Properties::where('status', 1)
         ->where('property_purpose', $lead->property->property_purpose)
         ->whereBetween('price', [$lead->property->price - 2000, $lead->property->price + 2000]);

      if ($lead->property->area) {
         $nearBy = $nearBy->where('town', $lead->property->town);
      } elseif ($lead->property->town) {
         $nearBy = $nearBy->where('subcity', $lead->property->subcity);
      } elseif ($lead->property->subcity) {
         $nearBy = $nearBy->where('city', $lead->property->city);
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

   public function view_property_inquiry(Lead $lead)
   {
      $inquire = Lead::where('id', $lead)->first();
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
      $inquire = Lead::where('id', $id)->first();
      $inquire->enquire_id = 1;
      $inquire->update();

      $action = 'saakin_create';
      return view('admin-dashboard.inquiries.agency_inquires.view_agency_inquiry', compact('inquire', 'action'));
   }
   public function view_contact_inquiry($id)
   {
      $inquire = Lead::where('id', $id)->first();
      $inquire->enquire_id = 1;
      $inquire->update();

      $action = 'saakin_create';
      return view('admin-dashboard.inquiries.contact_inquires.view_contact_inquiry', compact('inquire', 'action'));
   }

   public function notifications()
   {
      if (Auth::User()->usertype == "Agency") {
         $inquirieslist = Lead::where('agency_id', Auth::User()->agency_id)->orderBy('id', 'desc')->paginate(10);
      } else {
         $inquirieslist = Lead::orderBy('id', 'desc')->paginate(10);
      }

      $action = 'saakin_index';
      return view('admin-dashboard.notifications.notifications', compact('inquirieslist', 'action'));
   }
   public function view_notification($id)
   {
      $inquire = Lead::where('id', $id)->first();
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
      Lead::where('id', '>', 0)->update(['enquire_id' => 1]);
      return redirect()->back();
   }
}
