<?php

namespace App\Http\Controllers\Admin;

use App\Types;
use App\Agency;
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

      $leads = Lead::when(Auth::User()->usertype == "Agency", function ($query) {
         $query->where('agency_id', Auth::User()->agency_id);
      })->orderBy('id', 'desc')->paginate(10);

      $action = 'saakin_index';

      return view('admin-dashboard.leads.index', compact('leads', 'action'));
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
      return view('admin-dashboard.leads.property_leads.create', compact('data', 'action'));
   }

   public function store_property_inquiry(Request $request)
   {
      $request->validate([
         'agency_id' => 'required',
         // 'reference_id' => 'required',
         'property_title' => 'required',
         // 'property_id' => 'required',
         'property_purpose' => 'required',
         'property_type' => 'required',
         'price' => 'required',
         'city' => 'required',
         'name' => 'required',
         'email' => 'required',
         'phone' => 'required',
         'source' => 'required',
         'subject' => 'required',
         // 'forward_agents' => 'required',
         'movein_date' => 'required',
         'message' => 'required',
      ]);
      $inputs = $request->all();
      $property_lead = new Lead();
      $property_lead->agency_id = $inputs['agency_id'];
      $property_lead->agent_id = $inputs['agent_id'];
      $property_lead->type = 'Property Inquiry';
      $property_lead->is_forwarded = 1;
      $property_lead->name = $inputs['name'];
      $property_lead->email = $inputs['email'];
      $property_lead->phone = $inputs['phone'];
      $property_lead->subject = $inputs['subject'];
      $property_lead->message = $inputs['message'];
      $property_lead->reference_id = $inputs['reference_id'];
      $property_lead->property_id = $inputs['property_id'];
      $property_lead->property_title = $inputs['property_title'];
      $property_lead->property_purpose = $inputs['property_purpose'];
      $property_lead->property_type = $inputs['property_type'];
      $property_lead->timeframe = $inputs['time_frame'];
      $property_lead->price = $inputs['price'];
      $property_lead->land_area = $inputs['land_area'];
      $property_lead->bedrooms = $inputs['bedrooms'];
      $property_lead->city = $inputs['city'];
      $property_lead->subcity = $inputs['subcity'];
      $property_lead->town = $inputs['town'];
      $property_lead->area = $inputs['area'];
      $property_lead->source = $inputs['source'];
      $property_lead->movein_date = $inputs['movein_date'];
      $property_lead->created_by = Auth::user()->id;
      $property_lead->save();

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
      return view('admin-dashboard.leads.property_leads.show', 'action');
   }

   public function getResults(Request $request)
   {
      $data = Agency::select('name')->where("name", "LIKE", "%{$request->value}%")->get();
      return response()->json($data);
   }


   public function show_agency()
   {
      $action = 'saakin_index';
      return view('admin-dashboard.leads.property_leads.show_agency', compact('action'));
   }

   public function searchagency(Request $request)
   {
      $data = Agency::select("name as value", "id")->where('name', 'LIKE', '%' . $request->get('search') . '%')->get();
      return response()->json($data);
   }

   public function property_search(Request $request)
   {
      $data = Properties::select("property_name as value", "id")
      ->where('property_name', 'LIKE', $request('property_search'))->get();
      return response()->json($data);
   }

   public function property_inquiries()
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         Session::flash('flash_message', trans('words.access_denied'));
         return redirect('dashboard');
      }
      
      $leads = Lead::when(Auth::User()->usertype == "Agency", function ($query) {
         $query->where('agency_id', Auth::User()->agency_id);
      })
      ->where(['type' => 'Property Inquiry'])->orderBy('id', 'desc')->paginate(10);
       
      $forwardedLeads = LeadForwardAgent::when(Auth::User()->usertype == "Agency", function ($query) {
         $query->where('agency_id', Auth::User()->agency_id);
      })->where('type', 'Property Inquiry')->orderBy('id', 'desc')->paginate(10);
      
      $action = 'saakin_index';
      $data['agenices'] = Agency::all();

      return view('admin-dashboard.leads.property_leads.property_leads', compact('leads', 'action','forwardedLeads', 'data'));
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
         'admin-dashboard.leads.agency_leads.agency_leads',
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

      return view('admin-dashboard.leads.contact_leads.contact_leads', compact('inquirieslist', 'action'));
   }

   public function delete($id)
   {
      $lead = Lead::findOrFail($id);
      LeadForwardAgent::where('lead_id', $id)->delete();
      $lead->delete();

      Session::flash('flash_message', trans('words.deleted'));
      return redirect()->back();
   }

   public function view_inquiry($id)
   {
      $lead = Lead::find($id);
      $similarProperties = Properties::where('status', 1)
         ->where('property_purpose', $lead->property_purpose)
         ->where('property_type', $lead->property_type)
         ->where('bedrooms', $lead->bedrooms)
         ->whereBetween('price', [$lead->price - 2000, $lead->price + 2000])
         ->where('city', $lead->city)
         ->where('subcity', $lead->subcity)
         ->where('town', $lead->town)
         ->where('area', $lead->area)
         ->get();

      $nearBy  = Properties::where('status', 1)
         ->where('property_purpose', $lead->property_purpose)
         ->whereBetween('price', [$lead->price - 2000, $lead->price + 2000]);

      if ($lead->area) {
         $nearBy = $nearBy->where('town', $lead->town);
      } elseif ($lead->town) {
         $nearBy = $nearBy->where('subcity', $lead->subcity);
      } elseif ($lead->subcity) {
         $nearBy = $nearBy->where('city', $lead->city);
      }

      $availableNearbyProperties = $nearBy->paginate();
      $action = 'saakin_index';

      return view('admin-dashboard.leads.property_leads.view_property_lead',
         compact('similarProperties', 'availableNearbyProperties', 'action', 'lead')
      );
   }
   
   public function viewForwardInquiry($id)
   {
      $forwardLead = LeadForwardAgent::find($id);
      $forwardLead->status = 1;
      $forwardLead->update();

      $action = 'saakin_index';
      
      $similarProperties = Properties::where('status', 1)
         ->where('property_purpose', $forwardLead->lead->property_purpose)
         ->where('property_type', $forwardLead->lead->property_type)
         ->where('bedrooms', $forwardLead->lead->bedrooms)
         ->whereBetween('price', [$forwardLead->lead->price - 2000, $forwardLead->lead->price + 2000])
         ->where('city', $forwardLead->lead->city)
         ->where('subcity', $forwardLead->lead->subcity)
         ->where('town', $forwardLead->lead->town)
         ->where('area', $forwardLead->lead->area)
         ->get();

      $nearBy  = Properties::where('status', 1)
         ->where('property_purpose', $forwardLead->lead->property_purpose)
         ->whereBetween('price', [$forwardLead->lead->price - 2000, $forwardLead->lead->price + 2000]);

      if ($forwardLead->lead->area) {
         $nearBy = $nearBy->where('town', $forwardLead->lead->town);
      } elseif ($forwardLead->lead->town) {
         $nearBy = $nearBy->where('subcity', $forwardLead->lead->subcity);
      } elseif ($forwardLead->lead->subcity) {
         $nearBy = $nearBy->where('city', $forwardLead->lead->city);
      }
      $availableNearbyProperties = $nearBy->paginate();
      return view('admin-dashboard.leads.forward-lead.view_property_foward_lead',
      compact('forwardLead', 'action','availableNearbyProperties', 'similarProperties'));
   }

   
   function forwardLeadtoAgents(Request $request)
   {
      foreach ($request->forward_agents as $key => $agent) {
         $forwardAgent = new LeadForwardAgent();
         $forwardAgent->agency_id = $agent;
         $forwardAgent->type = 'Property Inquiry';
         $forwardAgent->lead_id = $request->lead_id;
         $forwardAgent->save();
      }
      Session::flash('flash_message', trans('words.added'));
      return \Redirect::back();
   }

   public function commentForwardLead(Request $request, $id)
   {
      $request->validate([
         'comment' => 'required',
         'move_in_date' => 'required'
      ]);
      $forwardLead = LeadForwardAgent::find($id);
      $forwardLead->comment = request('comment');
      $forwardLead->move_in_date = request('move_in_date');
      $forwardLead->update();
      return redirect()->back()->with('flash_message','Comment has been added.');
   }

   public function view_property_inquiry(Lead $lead)
   {
      $lead = Lead::where('id', $lead)->first();
      $lead->status = 1;
      $lead->update();

      if ($lead->property_id != '') {
         $property = Properties::find($lead->property_id);
         $action = 'saakin_create';

      return view('admin-dashboard.leads.property_leads.view_property_lead',compact('lead', 'property', 'action'));
      }
      return view('admin-dashboard.leads.property_leads.view_property_lead',compact('lead', 'action'));
   }
   public function view_agency_inquiry($id)
   {
      $lead = Lead::where('id', $id)->first();
      $lead->status = 1;
      $lead->update();

      $action = 'saakin_create';
      return view('admin-dashboard.leads.agency_leads.view_agency_lead', compact('lead', 'action'));
   }
   public function view_contact_inquiry($id)
   {
      $lead = Lead::where('id', $id)->first();
      $lead->status = 1;
      $lead->update();

      $action = 'saakin_create';
      return view('admin-dashboard.leads.contact_leads.view_contact_lead', compact('lead', 'action'));
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
      $lead = Lead::where('id', $id)->first();
      $lead->status = 1;
      $lead->update();

      if ($lead->property_id != '') {
         $property = Properties::find($lead->property_id);
         $action = 'saakin_create';

         return view('admin-dashboard.notifications.view_notification',compact('lead', 'property', 'action'));
      }

      $action = 'saakin_create';
      return view('admin-dashboard.notifications.view_notification', compact('lead', 'action'));
   }

   public function markAllAsRead()
   {
      Lead::where('id', '>', 0)->update(['status' => 1]);
      return redirect()->back();
   }
   
   public function restoreLeads()
   {
      Lead::onlyTrashed()->restore();
      LeadForwardAgent::onlyTrashed()->restore();
      return redirect()->back();
   }
}
