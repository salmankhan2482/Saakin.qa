<?php

namespace App\Http\Controllers;

use App\Pages;
use App\Types;
use App\Agency;
use App\Enquire;
use App\PageVisits;
use App\Properties;
use App\SaveSearch;
use App\LandingPage;
use App\PropertyAreas;
use App\PropertyTowns;
use App\AmenityProduct;
use App\PropertyCities;
use App\PopularSearches;
use App\PropertyAmenity;
use App\PropertyCounter;
use App\PropertyGallery;
use App\PropertyPurpose;
use App\PropertyDocument;
use App\PropertyFloorPlan;
use App\PropertySubCities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\PropertyNeighborhood;
use App\Mail\Property_Inquiry;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Repositories\PropertyRepository;
use Illuminate\Support\Facades\Redirect;
use Stevebauman\Location\Facades\Location;


class PropertiesController extends Controller
{
   protected $propertyrepo;
   
   public function __construct(PropertyRepository $propertyrepo){
      $this->propertyrepo = $propertyrepo;
   }

   public function getPropertyListing(Request $request)
   {
      request('bathrooms') == 'Any' ? $request->merge(['bathrooms' => null]) : request('bathrooms');
      request('bedrooms') == 'Any' ? $request->merge(['bedrooms' => null]) : request('bedrooms');

      isset(request()->property_type) ? $request->merge(['type' => Types::findOrFail(request()->property_type)]) : '';
      request('max_price') == 'Other' ? request()->merge(['max_price' => request('input_max_price')]) : request('max_price');

      $propertyTypes =  $this->propertyrepo->getPropertyTypes();
      $data['result'] = $this->propertyrepo->breadcrumbs($request); // breadcrumbs

      $propertyPurposes = PropertyPurpose::all();
      $amenities = PropertyAmenity::all();

      $properties = $this->propertyrepo->getProperties($request); // getting all properties through search   
      $landing_page_content = $this->propertyrepo->landingPageContent(); // landing page content 

      if ($landing_page_content == null) {
         $page_des = getcong('site_description');
      } else {
         $page_des = Str::limit($landing_page_content->page_content, 170, '...');
      }

      $data['keyword'] = $this->findKeyWord(request('city'), request('subcity'), request('town'), request('area'));
      $name = $this->propertyrepo->headerName();

      $furnishing = $this->propertyrepo->furnishing(request('furnishings'));

      $link = "properties?featured=$request->featured&city=$request->city&subcity=$request->subcity&town=$request->town&area=$request->area&property_purpose=$request->property_purpose&property_type=$request->property_type&min_price=&max_price=&min_area=&max_area=&bedrooms=$request->bedrooms&bathrooms=&furnishings=$request->furnishings";

      $heading_info = $furnishing . ' ' .(ucfirst($request['type']->plural_name ?? ' Properties')) . ' for ' . (request('property_purpose') ? request('property_purpose') : 'Rent and Sale ') . ' in ' . ($data['keyword'] != '' ? $data['keyword'] : 'Qatar');

      $nearbyProperties = '';
      $this->propertyrepo->popularSearches($name, $link); //creating popular searches
      
      if (count($properties) == 0) {//getting near by properties
         $nearbyProperties =  $this->propertyrepo->getNearbyProperties($request);
         if(count($nearbyProperties) == 0){
            $nearbyProperties =  $this->propertyrepo->getNearbyPropertiesWithoutType($request);
         }
      }

      $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      $saveSearch = 0;
      if (auth()->user()) {
         $record = SaveSearch::where('user_id', auth()->user()->id)->where('link', $currentURL)->first();
         $saveSearch = isset($record) ? 1 : 0;
      }

      return view( 'front.pages.properties', compact('properties', 'propertyTypes', 'data', 'saveSearch', 'propertyPurposes', 'request', 'landing_page_content', 'page_des', 'heading_info', 'nearbyProperties')
      );
   }

   public function findKeyWord($city = null, $subcity = null, $town = null, $area = null)
   {
      $keyword = '';
      if ($city != null) {
         $cityResult = PropertyCities::findOrFail($city);
         $keyword = $cityResult->name;
      }
      if ($subcity != null) {
         $subcityResult = PropertySubCities::findOrFail($subcity);
         $keyword = $subcityResult->name . ' (' . $subcityResult->city->name . ')';
      }
      if ($town != null) {
         $townResult = PropertyTowns::findOrFail($town);
         $keyword = $townResult->name . ' (' . $townResult->city->name . ' , ' . $townResult->subcity->name . ')';
      }
      if ($area != null) {
         $areaResult = PropertyAreas::findOrFail($area);
         $keyword = $areaResult->name . ' (' . $areaResult->city->name . ' , ' . $areaResult->subcity->name . ', ' . $areaResult->town->name . ')';
      }

      return $keyword;
   }

   public function featuredproperties()
   {
      $properties = Properties::where(['status' => '1', 'featured_property' => '1'])->orderBy('id', 'desc')->paginate(getcong('pagination_limit'));

      if (getcong('featured_properties_layout') == 'grid_side') {
         return view('pages.featured_properties_grid_sidebar', compact('properties'));
      } else {
         return view('pages.featured_properties_grid', compact('properties'));
      }
   }

   public function saleproperties()
   {
      $properties = Properties::where(['status' => '1', 'property_purpose' => 'Sale'])->orderBy('id', 'desc')->paginate(getcong('pagination_limit'));

      if (getcong('sale_properties_layout') == 'grid_side') {
         return view('pages.sale_properties_grid_sidebar', compact('properties'));
      } else {
         return view('pages.sale_properties_grid', compact('properties'));
      }
   }

   public function rentproperties()
   {
      $properties = Properties::where(['status' => '1', 'property_purpose' => 'Rent'])->orderBy('id', 'desc')->paginate(getcong('pagination_limit'));

      if (getcong('rent_properties_layout') == 'grid_side') {
         return view('pages.rent_properties_grid_sidebar', compact('properties'));
      } else {
         return view('pages.rent_properties_grid', compact('properties'));
      }

      return view('pages.rentproperties', compact('properties'));
   }

   public function propertiesbytype($slug)
   {
      $type_data = Types::where('slug', $slug)->first();
      $properties = Properties::where(['status' => '1', 'property_type' => $type_data->id])->orderBy('id', 'desc')->paginate(getcong('pagination_limit'));

      if (!$properties) {
         abort('404');
      }

      $type = $type_data->types;
      return view('pages.propertiesbytype', compact('properties', 'type'));
   }

   public function map_property_urlset($id)
   {
      $property = Properties::findOrFail($id);
      return redirect($property->property_purpose . '/' . $property->property_slug . '/' . $property->id);
   }

   public function single_properties(Request $request, $property_purpose, $slug, $id)
   {
      $property = Properties::with('gallery')->where('property_slug', $slug)->findOrFail($id);
      if (!$property) {
         abort('404');
      }

      if ($property->status == 0 || $property->id==null)
      {
         if($property_purpose == 'sale'){
            $p_purpose = 'buy';
         }elseif($property_purpose == 'rent'){
            $p_purpose = 'rent';
         }
         $single_property = Properties::where('id',$id)->first();
         $property_type = $single_property->propertiesTypes->plural;
      

         //Area, Town, Subcity, City
         if(!empty($single_property->city) && !empty($single_property->subcity) && !empty($single_property->town) && !empty($single_property->area))
         {
            $city_slug = $single_property->propertyCity->slug;
            $subcity_slug = $single_property->propertySubCity->slug;
            $address_slug = $city_slug;
            $single_property_type_purpose = $property_type.'-for-'.$property_purpose;
            return redirect()->route('cpt-purpose',[ $p_purpose, $address_slug, $single_property_type_purpose ], 301);
         }

         //Town, Subcity, City
         elseif(!empty($single_property->town) && empty($single_property->area))
         {
            $city_slug = $single_property->propertyCity->slug;
            $subcity_slug = $single_property->propertySubCity->slug;
            $town_slug = $single_property->propertyTown->slug;
            $address_slug = $city_slug;
            $single_property_type_purpose = $property_type.'-for-'.$property_purpose;
            return redirect()->route('cpt-purpose',[ $p_purpose, $address_slug, $single_property_type_purpose ], 301);
         }

         //Subcity, City
         elseif(empty($single_property->town) && empty($single_property->area))
         {
            $city_slug = $single_property->propertyCity->slug;
            $subcity_slug = $single_property->propertySubCity->slug;
            $address_slug = $city_slug;
            $single_property_type_purpose = $property_type.'-for-'.$property_purpose;

            return redirect()->route('cpt-purpose',[ $p_purpose, $address_slug, $single_property_type_purpose ], 301);
         }

         //City
         elseif(empty($single_property->subcity) && empty($single_property->town) && empty($single_property->area))
         {
            $city_slug = $single_property->propertyCity->slug;
            $address_slug = $city_slug;
            $single_property_type_purpose = $property_type.'-for-'.$property_purpose;
            return redirect()->route('cpt-purpose',[ $p_purpose, $address_slug, $single_property_type_purpose ], 301);
         }
         
      }
     

      $visitor = request()->ip();
      $traffic = PageVisits::where('ip_address', $visitor)->where('property_id', $id)
         ->whereMonth('created_at', Carbon::now()->month)->first();
      if (auth()->check() && auth()->user()->usertype == 'Admin') {
      } else {
         if (!$traffic) {

            $traffic = new PageVisits();
            $traffic->ip_address = $visitor;
            $traffic->property_id = $id;
            $position = Location::get('https://' . $visitor);
            // $traffic->country = $position->countryName;
            $traffic->agency_id = $property->agency_id ?? '';
            $traffic->save();
         }

         $counter = PropertyCounter::where('property_id', $id)->first();
         if ($counter) {
            $counter->counter = $counter->counter + 1;
            $counter->update();
         } else {
            $add_counter = new PropertyCounter();
            $add_counter->property_id = $id;
            $add_counter->agency_id = $property->agency_id;
            $add_counter->save();
         }
      }

      $agency = Agency::where('id', $property->agency_id)->first();
      $neighborhoods = PropertyNeighborhood::where('property_id', $property->id)->get();
      $property_gallery_images = PropertyGallery::where('property_id', $property->id)->get();
      $floorPlans = PropertyFloorPlan::where('property_id', $property->id)->get();
      $documents = PropertyDocument::where('property_id', $property->id)->get();
      $address =  '';
      if ($property->area) {
         if ($property->city && $property->subcity) {
            $address = $property->propertyCity->name . ', ' . $property->propertySubCity->name . ', ' . $property->propertyTown->name;
         }
      } else {
         if ($property->city && $property->subcity) {
            $address = $property->propertyCity->name . ', ' . $property->propertySubCity->name;
         }
      }

      $properties = Properties::where('address', $property->address)
         ->where("status", "1")
         ->where("property_purpose", $property->property_purpose)
         ->where("id", "!=", $id)
         ->where('property_type', $property->property_type)
         ->orderBy('land_area', 'asc')
         ->get();
         
      $property_counter = PropertyCounter::where('property_id', $property->id)->value('counter');
      $property_des = Str::limit($property->property_name . '  ' . $property->description, 150, '...');

      return view('front.pages.property_detail', compact('property', 'agency', 'neighborhoods', 'property_gallery_images', 'floorPlans', 'documents', 'properties', 'property_des', 'address', 'property_counter'));
   }

   public function property_details_sendemail(Request $request)
   {
      $data =  \Request::except(array('_token'));
      $inputs = $request->all();
      $property_des = $request->property_data;
      $property_data = Properties::where('id', $property_des)->first();
      $rule = array(
         'property_data' => 'nullable|required',
         'user_name' => 'required',
         'user_email' => 'required|email',
         'user_message' => 'required',
         // 'g-recaptcha-response' => 'required|captcha',
      );

      $validator = \Validator::make($data, $rule);

      if ($validator->fails()) {
         return redirect()->back()->withErrors($validator->messages())->withInput();
      }

      $enquire = new Enquire();
      if (!empty($property_data->id)) {
         $enquire->property_id = $property_data->id;
      } else {
         $enquire->property_id = 0;
      }

      if (!empty($property_data->agency_id)) {
         $enquire->agency_id = $property_data->agency_id;
      } else {
         $enquire->agency_id = 0;
      }

      if (!empty($property_data->agent_id)) {
         $enquire->agent_id = $property_data->agent_id;
      } else {
         $enquire->agent_id = 0;
      }

      $enquire->type = 'Property Inquiry';
      $enquire->enquire_id = 2;
      $enquire->name = $request->user_name;
      $enquire->email = $request->user_email;
      $enquire->phone = $request->telephone;
      $enquire->movein_date = $request->movein_date;
      $enquire->message = $request->user_message;
      $enquire->created_at = date("Y-m-d H:i:s");
      $enquire->updated_at = date("Y-m-d H:i:s");
      $enquire->reference_id = $property_data['property_name'];
      $enquire->property_id = $property_data['property_id'];
      $enquire->property_title = $property_data['property_name'];
      $enquire->property_purpose = $property_data['property_purpose'];
      $enquire->property_type = $property_data['property_type'];
      $enquire->price = $property_data['price'];
      $enquire->land_area = $property_data['land_area'];
      $enquire->bedrooms = $property_data['bedrooms'];
      $enquire->city = $property_data['city'];
      $enquire->subcity = $property_data['subcity'];
      $enquire->town = $property_data['town'];
      $enquire->area = $property_data['area'];
      $enquire->save();
      
      // $data_email = array(
      $data_email['user_name'] = $inputs['user_name'];
      $data_email['user_email'] = $inputs['user_email'];
      $data_email['telephone'] = $inputs['telephone'];
      $data_email['user_message'] = $inputs['user_message'];
      $data_email['movein_date'] = $inputs['movein_date'];
      $data_email['property_id'] = $property_data['id'];
      $data_email['property_name'] = $property_data['property_name'];
      $data_email['property_type'] = $property_data->propertiesTypes->types;
      $data_email['agency_id'] = $property_data->Agency->id;
      $data_email['agency_name'] = $property_data->Agency->name;
      $data_email['agency_email'] = $property_data->Agency->email;
      $data_email['bathrooms'] = $property_data['bathrooms'];
      $data_email['bedrooms'] = $property_data['bedrooms'];
      $data_email['price'] = $property_data['price'];
      $data_email['property_purpose'] = $property_data['property_purpose'];
      $data_email['address'] = $property_data['address'];
      $data_email['city'] = $property_data['city'];
      $data_email['property_slug'] = $property_data['property_slug'];
      $data_email['featured_image'] = $property_data['featured_image'];
      $data_email['land_area'] = $property_data['land_area'];
      $data_email['refference_code'] = $property_data['refference_code'];
         
      Mail::to('hello@saakin.qa')->send(new Property_Inquiry($data_email));

      Session::flash('flash_message_email_modal', trans('words.thanks_for_contacting_us'));
      return redirect()->back();
   }

   public function agentscontact(Request $request)
   {
      $data =  \Request::except(array('_token'));

      $inputs = $request->all();

      $rule = array(
         'name' => 'required',
         'email' => 'required',
         'message' => 'required'
      );

      $validator = \Validator::make($data, $rule);

      if ($validator->fails()) {
         \Session::flash('flash_message_agent', 'name,email and message field are required');
         return redirect()->back()->withErrors($validator->messages());
      }

      $enquire = new Enquire;
      $enquire->property_id = $inputs['property_id'];
      $enquire->agent_id = $inputs['agent_id'];
      $enquire->name = $inputs['name'];
      $enquire->email = $inputs['email'];
      $enquire->phone = $inputs['phone'];
      $enquire->message = $inputs['message'];

      $enquire->save();
      \Session::flash('flash_message_agent', 'Message send successfully');
      return \Redirect::back();
   }

   public function searchProperties(Request $request)
   {
      $inputs = $request->all();

      $city = $inputs['city'];
      $keyword = $inputs['keyword'];
      $properties = Properties::where('status', 1)->where('city', $city)->where(function ($query) use ($keyword) {
         $query->where('property_name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%');
      })->get();

      return view('front.pages.search_property', compact('properties'));
   }

   public function my_properties()
   {
      if (!Auth::user()) {
         \Session::flash('flash_message', 'Login required!');
         return redirect('login');
      }

      if (Auth::user()->usertype == 'Admin') {
         return redirect('admin/properties');
      } else {
         $user_id = Auth::user()->id;
         $propertieslist = Properties::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(getcong('pagination_limit'));
      }

      return view('front.pages.my_properties', compact('propertieslist'));
   }

   public function add_property_form()
   {
      if (!Auth::user()) {
         \Session::flash('flash_message', 'Login required');
         return redirect('login');
      }
      $amenities = PropertyAmenity::get();
      $types = Types::orderBy('types')->get();
      $agencies = Agency::where('status', 1)->get();

      return view('front.pages.submit_property', compact('types', 'agencies', 'amenities'));
   }

   public function addnew(Request $request)
   {
      $request_data = request()->all();
      $property_slug = Str::slug($request_data['property_name'], "-");
      $featured_image = $request->file('featured_image');

      if ($featured_image) {
         $tmpFilePath = public_path('upload/properties/');
         $featured_image_name = $featured_image->getClientOriginalName();
         $featured_image_name = explode(".", $featured_image_name);
         $name = $featured_image_name[0] . '_' . time() . '.' . $featured_image->extension();
         $featured_image->move($tmpFilePath, $name);
         $request_data['featured_image'] = $name;
      }

      $request_data['user_id'] = Auth::user()->id;
      $request_data['rental_period'] = \request()->rental_period;
      $request_data['description'] = \request()->description;
      $request_data['property_slug'] = $property_slug;
      $request_data['refference_code'] = Str::random(6);

      if (Auth::user()->usertype == 'Admin') {
         $request_data['agency_id'] = $request_data['agency_id'];
      } else if (Auth::user()->usertype == 'Agency') {
         $request_data['agency_id'] = Auth::user()->agency_id;
      } else if (Auth::user()->usertype == 'Agents') {
         $request_data['agency_id'] = Auth::user()->agency_id;
         $request_data['agent_id'] = Auth::user()->id;
      } else {
         $request_data['agency_id'] = 0;
      }

      $request_data['property_features'] = implode(',', $request->input('property_features'));
      $property = Properties::create($request_data);
      $property_gallery_files = $request->file('images');
      if (request()->hasFile('images')) {
         foreach ($property_gallery_files as $file) {
            $property_gallery_obj = new PropertyGallery;
            $gallery_image_path = public_path('upload/gallery/');
            $gallery_image_name = $file->getClientOriginalName();
            $gallery_image_name = explode(".", $gallery_image_name);
            $name = $gallery_image_name[0] . '_' . time() . '.' . $file->extension();
            $file->move($gallery_image_path, $name);
            $property_gallery_obj->property_id = $property->id;
            $property_gallery_obj->image_name = $name;
            $property_gallery_obj->save();
         }
      }

      $nearby_category_name =   $request_data['nearby_category_name'];
      $nearby_title =   $request_data['nearby_title'];
      $nearby_distance =   $request_data['nearby_distance'];

      if ($nearby_category_name[0] != null && $nearby_category_name[0] != '') {
         foreach ($nearby_category_name as $i => $cname) {
            $property_neibor_obj = new PropertyNeighborhood;
            $property_neibor_obj->property_id = $property->id;
            $property_neibor_obj->category_name = $cname;
            $property_neibor_obj->title = $nearby_title[$i];
            $property_neibor_obj->distance = $nearby_distance[$i];
            $property_neibor_obj->save();
         }
      }

      $floor_name = $request_data['floor_name'];
      $floor_size = $request_data['floor_size'];
      $floor_room = $request_data['floor_room'];
      $floor_bathroom = $request_data['floor_bathroom'];
      $floor_image = $request->file('floor_plan_image');
      if ($floor_name[0] != null && $floor_name[0] != '') {
         foreach ($floor_name as $i => $fname) {
            $property_floor_plan_obj = new PropertyFloorPlan;
            $property_floor_plan_obj->property_id = $property->id;
            $property_floor_plan_obj->floor_name = $fname;
            $property_floor_plan_obj->floor_size = $floor_size[$i];
            $property_floor_plan_obj->floor_rooms = $floor_room[$i];
            $property_floor_plan_obj->floor_bathrooms = $floor_bathroom[$i];

            $image_name = "";
            if (!empty($floor_image)) {
               if ($floor_image[$i]) {
                  $floor_image_path = public_path('upload/floorplan/');
                  $floor_image_name = $floor_image[$i]->getClientOriginalName();
                  $floor_image_name = explode(".", $floor_image_name);
                  $name = $floor_image_name[0] . '_' . time() . '.' . $floor_image[$i]->extension();
                  $floor_image[$i]->move($floor_image_path, $name);
                  $image_name = $name;
               }
               $property_floor_plan_obj->floor_images = $image_name;
            }
            $property_floor_plan_obj->save();
         }
      }

      if ($request->hasfile('property_document')) {
         $property_document_path = public_path('upload/documents/');
         foreach ($request->file('property_document') as $file) {
            $property_document_obj = new PropertyDocument;
            $property_document_name = $file->getClientOriginalName();
            $property_document_name = explode(".", $property_document_name);
            $name = $property_document_name[0] . '_' . time() . '.' . $file->extension();
            $file->move($property_document_path, $name);

            $property_document_obj->property_id = $property->id;
            $property_document_obj->doc_images = $name;
            $property_document_obj->save();
         }
      }
      return response()->json(['property' => $property->id, 'message' => "Property Submitted Successfully! Publish soon"]);
   }

   public function editproperty($id)
   {
      if (!Auth::user()) {
         \Session::flash('flash_message', 'Login required');
         return redirect('login');
      }

      $user_id = Auth::user()->id;
      $decrypted_id = Crypt::decryptString($id);

      if (Auth::user()->usertype == 'Admin') {
         $property = Properties::where('id', $decrypted_id)->first();
      } else {
         $property = Properties::where('id', $decrypted_id)->where('user_id', $user_id)->first();
      }

      if (!$property) {
         abort('404');
      }
      $types = Types::orderBy('types')->get();
      $purposes = PropertyPurpose::get();
      $amenities = PropertyAmenity::orderBy("name", "asc")->get();
      $agencies = Agency::where('status', 1)->get();

      $property_gallery_images = PropertyGallery::where('property_id', $property->id)->orderBy('image_name')->get();
      $cities = PropertyCities::all();
      $subCities = PropertySubCities::all();
      $towns = PropertyTowns::all();
      $areas = PropertyAreas::all();

      return view('admin.pages.edit_property', compact('property', 'types', 'cities', 'subCities', 'towns', 'areas', 'purposes', 'amenities', 'agencies', 'property_gallery_images'));
   }

   public function gallery_image_delete($id)
   {
      if (!Auth::user()) {
         \Session::flash('flash_message', 'Login required');
         return redirect('login');
      }

      $decrypted_id = Crypt::decryptString($id);
      $property_gallery_obj = PropertyGallery::findOrFail($decrypted_id);
      \File::delete('upload/gallery/' . $property_gallery_obj->image_name);
      $property_gallery_obj->delete();
      \Session::flash('flash_message', 'Deleted');
      return redirect()->back();
   }

   public function delete($id)
   {
      if (!Auth::user()) {
         \Session::flash('flash_message', 'Login required');
         return redirect('login');
      }

      $user_id = Auth::user()->id;
      $decrypted_id = Crypt::decryptString($id);
      $property = Properties::where('id', $decrypted_id)->where('user_id', $user_id)->first();
      if (!$property) {
         abort('404');
      }

      \File::delete(public_path() . '/upload/properties/' . $property->featured_image . '-b.jpg');
      \File::delete(public_path() . '/upload/properties/' . $property->featured_image . '-s.jpg');
      \File::delete(public_path() . '/upload/floorplan/' . $property->floor_plan . '-b.jpg');
      \File::delete(public_path() . '/upload/floorplan/' . $property->floor_plan . '-s.jpg');

      $property->delete();
      $property_gallery_images = PropertyGallery::where('property_id', $decrypted_id)->get();

      foreach ($property_gallery_images as $gallery_images) {
         \File::delete(public_path() . '/upload/gallery/' . $gallery_images->image_name);
         $property_gallery_obj = PropertyGallery::findOrFail($gallery_images->id);
         $property_gallery_obj->delete();
      }

      \Session::flash('flash_message', 'Property Deleted');
      return redirect()->back();
   }

   public function propertiesForPurpose($buyOrRent, $property_purpose)
   {
      if (request()->filled('buyOrRent') && request()->filled('property_purpose')) {
         $buyOrRent = request('buyOrRent');
         $property_purpose = request('property_purpose');
      }

      $properties = Properties::where('status', 1)->where('property_purpose', ucfirst($property_purpose));
      $properties = $this->propertyrepo->sortyBy($properties, request());
      $properties = $properties->paginate(getcong('pagination_limit'));

      //Redirect Extra Pagination Pages Property Purpose Page
      if (request()->get('page') > 1 && $properties->isEmpty()) {
         return redirect()->route('property-purpose',[ $buyOrRent, $property_purpose ], 301);
           }

      $propertyTypes = DB::table('property_types')
         ->join('properties', "property_types.id", "properties.property_type")
         ->select('property_types.id','property_types.types','property_types.*',DB::Raw('COUNT(properties.id) as pcount'))
         ->where("properties.status", 1)
         ->where('property_purpose', ucfirst($property_purpose))
         ->groupBy("property_types.id")->orderBy("pcount", "desc")->get();


      $cities = Properties::select("city")
         ->where('status', 1)->where('city', '!=', '')
         ->groupBy('city')->orderBy("city", "asc")->get();

      $propertyPurposes = PropertyPurpose::all();

      if ($buyOrRent == 'buy') {
         $landing_page_content = LandingPage::where('property_purposes_id', 2)
         ->where('property_types_id', null)
         ->where('property_cities_id', null)
         ->where('property_sub_cities_id', null)
         ->where('property_towns_id', null)
         ->where('property_areas_id', null)
         ->first();
      } else {
         $landing_page_content = LandingPage::where('property_purposes_id', 1)
         ->where('property_types_id', null)
         ->where('property_cities_id', null)
         ->where('property_sub_cities_id', null)
         ->where('property_towns_id', null)
         ->where('property_areas_id', null)
         ->first();
      }

      $heading_info = '';
      $furnishing = '';
      if (request()->get('furnishings')) {
         $furnishing = PropertyAmenity::where('id', request()->get('furnishings'))->value('name');
      }
      if (request('property_type')) {
         $type = Types::where('id', request('property_type'))->value('types');
         $heading_info = $furnishing . ' ' . $type . ' for ' . ucfirst(request()->property_purpose) . ' in Qatar';
      } else {
         $heading_info = $furnishing . ' Properties for ' . ucfirst(request()->property_purpose) . ' in Qatar';
      }

      $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst(request('property_purpose')))
         ->where('city_id', null)->where('subcity_id', null)
         ->where('town_id', null)->where('area_id', null)
         ->orderBy('count', 'DESC')->limit(6)->get();

      if (count($data['popularSearchesLinks']) == 0) {
         $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', request()->property_purpose)->inRandomOrder()->limit(6)->get();
      }

      $data['nearbyAreasLinks'] = DB::table('properties')
         ->join('property_cities', 'properties.city', 'property_cities.id')
         ->select('property_cities.id', 'property_cities.name')
         ->where("properties.status", 1)
         ->where('property_purpose', ucfirst(request('property_purpose')))
         ->groupBy('property_cities.name')->limit(6)->get();

      $request = request();

      $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      $saveSearch = 0;
      if (auth()->user()) {
         $record = SaveSearch::where('user_id', auth()->user()->id)->where('link', $currentURL)->first();
         $saveSearch = isset($record) ? 1 : 0;
      }
      return view('front.pages.properties.properties-for-purpose',compact('properties','propertyTypes','cities','propertyPurposes','data','heading_info','buyOrRent','property_purpose','landing_page_content','request','saveSearch'));
   }

   public function propertyTypeForPurpose($buyOrRent, $property)
   {
      $property_type = '';
      $property_purpose = '';

      if (request()->filled('buyOrRent') && request()->filled('property')) {
         $buyOrRent = request('buyOrRent');
         $property_type = explode('-for-', request('property'))[0];
         $property_purpose = explode('-for-', request('property'))[1];
      } else {
         $buyOrRent = $buyOrRent;
         $property_type = explode('-for-', $property)[0];
         $property_purpose = explode('-for-', $property)[1];
      }
      $type = Types::where('plural', $property_type)->first();
      if (!$type) {
         $ptype = Types::where('slug', $property_type)->value('plural');
         return redirect()->route('property-type-purpose', [$buyOrRent, $ptype . '-for-' . $property_purpose], 301);
      }
      $properties = Properties::where('status', 1)
         ->where('property_purpose', ucfirst($property_purpose))
         ->where('property_type', $type->id);

      $properties = $this->propertyrepo->sortyBy($properties, request());
      $properties = $properties->paginate(getcong('pagination_limit'));

      //Redirect Extra Pagination Pages Property Purpose Page
      if (request()->get('page') > 1 && $properties->isEmpty()) {
         return redirect()->route('property-type-purpose',[ $buyOrRent, $property ], 301);
           }

      $cities = DB::table('property_cities')
         ->leftJoin('properties', 'property_cities.id', 'properties.city')
         ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
         ->where('property_purpose', ucfirst($property_purpose))
         ->where("properties.status", 1)
         ->where('property_type', $type->id)
         ->groupBy('property_cities.name')
         ->orderBy("pcount", "DESC")
         ->get();

      $propertyTypes =  DB::table('property_types')
         ->join('properties', "property_types.id", "properties.property_type")
         ->select('property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
         ->where("properties.status", 1)
         ->where('property_purpose', ucfirst($property_purpose))
         ->groupBy("property_types.id")
         ->orderBy("pcount", "desc")
         ->get();

      $propertyPurposes = PropertyPurpose::all();

      $purp = ($buyOrRent == 'buy' ? 2 : 1);
      $landing_page_content = LandingPage::where('property_purposes_id', $purp)
      ->where('property_types_id', $type->id)
      ->where('property_cities_id', null)
      ->where('property_sub_cities_id', null)
      ->where('property_towns_id', null)
      ->where('property_areas_id', null)
      ->first();
      $page_info = $type->plural . ' for ' . $property_purpose;
      $heading_info = ($type->plural_name ? $type->plural_name : ' Properties for ') . ' for ' . ucfirst($property_purpose) . ' in Qatar';

      $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst($property_purpose))
         ->where('type_id', $type->id)
         ->where('city_id', null)
         ->where('subcity_id', null)
         ->where('town_id', null)
         ->where('area_id', null)->limit(6)->get();

      if (count($data['popularSearchesLinks']) == 0) {
         $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst($property_purpose))->inRandomOrder()->limit(6)->get();
      }

      $data['nearbyAreasLinks'] = DB::table('properties')
         ->join('property_cities', 'properties.city', 'property_cities.id')
         ->select('property_cities.id', 'property_cities.name')
         ->where("properties.status", 1)
         ->where('property_purpose', ucfirst($property_purpose))
         ->groupBy('property_cities.name')->limit(6)->get();

      $request = request();

      $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      $saveSearch = 0;
      if (auth()->user()) {
         $record = SaveSearch::where('user_id', auth()->user()->id)->where('link', $currentURL)->first();
         $saveSearch = isset($record) ? 1 : 0;
      }

      return view('front.pages.properties.property-type-for-purpose', compact('properties','propertyTypes','type','cities','property_purpose','buyOrRent','propertyPurposes','landing_page_content','page_info','request','heading_info','data','saveSearch'));
   }

   public function cityPropertyTypeForPurpose($buyOrRent, $city_slug, $property_type_purpose)
   {
      $nearbyProperties = '';

      if (request()->filled('buyOrRent') && request()->filled('property_type_purpose')) {
         $buyOrRent = request('buyOrRent');
         $property_type = explode('-for-', request('property_type_purpose'))[0];

         if ($buyOrRent == 'Rent' or $buyOrRent == 'rent') {
            $property_purpose = 'Rent';
         } else {
            $property_purpose = 'Sale';
         }
      } else {
         
         $buyOrRent = $buyOrRent;
         $property_type = explode('-for-', $property_type_purpose)[0];
         
         if ($buyOrRent == 'Rent' or $buyOrRent == 'rent') {
            $property_purpose = 'Rent';
         } else {
            $property_purpose = 'Sale';
         }
      }
     
      
      $city_keyword = PropertyCities::where('slug', $city_slug)->firstOrFail();
      $subcity_props = Properties::where('sub_city_slug',$property_type_purpose)->where('city',$city_keyword->id)->get();
      $town_props = Properties::where('town_slug', $property_type_purpose)->where('city', $city_keyword->id)->get();
      $area_props = Properties::where('area_slug', $property_type_purpose)->where('city', $city_keyword->id)->get();
      
      //subcity if
      if (count($subcity_props) > 0) {
         $type = Types::where('plural', $property_type)->orWhere('slug', $property_type)->first();
         $properties = Properties::where('status', 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('property_type', $type->id)
            ->where('sub_city_slug', $property_type_purpose)
            ->where('city', $city_keyword->id);
         $properties = $this->propertyrepo->sortyBy($properties, request());
         $properties = $properties->paginate(getcong('pagination_limit'));

         $nearbyProperties = $this->propertyrepo->getNearbyProperties(request());
         if(count($nearbyProperties) == 0){
            $nearbyProperties = $this->propertyrepo->getNearbyPropertiesWithoutType(request());
         }

         $subcity_keyword = PropertySubCities::find($properties[0]->subcity ?? $subcity_props[0]->subcity);

         $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select('property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('city', $city_keyword->id)
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();

         $towns = DB::table('property_towns')
            ->leftJoin('properties', 'property_towns.id', 'properties.town')
            ->select('property_towns.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_towns.property_sub_cities_id', $subcity_keyword->id)
            ->where("properties.status", 1)
            ->where('sub_city_slug', $property_type_purpose)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('properties.property_type', $type->id)
            ->groupBy("property_towns.id")
            ->orderBy("pcount", "desc")
            ->get();

         $propertyPurposes = PropertyPurpose::all();
         $page_info = $type->plural_name . ' for ' . $property_purpose . ' in ' . $subcity_keyword->name . ', ' . $city_keyword->name;

         $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst($property_purpose))
            ->where('type_id', $type->id)
            ->where('subcity_id', $subcity_keyword->id)
            ->where('town_id', null)
            ->where('area_id', null)->limit(6)->get();

         if (count($data['popularSearchesLinks']) == 0) {
            $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst($property_purpose))->inRandomOrder()->limit(6)->get();
         }

         $data['nearbyAreasLinks'] = DB::table('properties')
            ->join('property_sub_cities', 'properties.subcity', 'property_sub_cities.id')
            ->select('property_sub_cities.id', 'property_sub_cities.name', 'property_sub_cities.property_cities_id')
            ->where("properties.status", 1)
            ->where('property_sub_cities.id', '!=', $subcity_keyword->id)
            ->where("properties.property_type", $type->id)
            ->groupBy('property_sub_cities.name')
            ->where('property_purpose', ucfirst($property_purpose))->limit(6)->get();

         $purp = ($buyOrRent == 'buy' ? 2 : 1);
         $landing_page_content = LandingPage::where('property_purposes_id', $purp)
            ->where('property_types_id', $type->id)
            ->where('property_cities_id', $city_keyword->id)
            ->where('property_sub_cities_id', $subcity_keyword->id)
            ->where('property_towns_id', null)
            ->where('property_areas_id', null)
            ->first();
         if ($properties->total() > 0) {
            $meta_description = $properties->random()->property_name . ' Short Term Flats &amp; ' . Str::limit(strip_tags($properties->random()->description), 150) . ' Long Term Rentals✓ Long Term Sale✓ ' . $page_info;
         } else {
            $meta_description = 'Search ' . $page_info . ' Short Term Flats &amp; Long Term Rentals✓ Long Term Sale✓ ';
         }

         $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
         $saveSearch = 0;
         if (auth()->user()) {
            $record = SaveSearch::where('user_id', auth()->user()->id)->where('link', $currentURL)->first();
            $saveSearch = isset($record) ? 1 : 0;
         }

         return view('front.pages.properties.subcity-property-type-for-purpose',compact('properties','propertyTypes','type','city_keyword','subcity_keyword','towns','meta_description','property_purpose','propertyPurposes','buyOrRent','page_info','data','landing_page_content','saveSearch','nearbyProperties'));
      } elseif (count($town_props) > 0) {
         //town if
       
         $type = Types::where('plural', $property_type)->orWhere('slug', $property_type)->first();
         $city_keyword = PropertyCities::where('slug', $city_slug)->firstOrFail();

         $properties = Properties::where('status', 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('property_type', $type->id)
            ->where('town_slug', $property_type_purpose)
            ->where('city', $city_keyword->id);

         $properties = $this->propertyrepo->sortyBy($properties, request());
         $properties = $properties->paginate(getcong('pagination_limit'));

         if($properties->total() == 0){
            $nearbyProperties = $this->propertyrepo->getNearbyProperties(request());
            if(count($nearbyProperties) == 0){
               $nearbyProperties = $this->propertyrepo->getNearbyPropertiesWithoutType(request());
            }
         }

         $subcity_keyword = PropertySubCities::find($properties[0]->subcity ?? $town_props[0]->subcity );
         $town_keyword = PropertyTowns::find($properties[0]->town ?? $town_props[0]->town);

         $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select('property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('city', $city_keyword->id)
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();

         $areas = DB::table('property_areas')
            ->leftJoin('properties', 'property_areas.id', 'properties.area')
            ->select('property_areas.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_areas.property_cities_id', $city_keyword->id)
            ->where("properties.status", 1)
            ->where('town_slug', $property_type_purpose)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('properties.property_type', $type->id)
            ->groupBy("property_areas.id")
            ->orderBy("pcount", "desc")
            ->get();

         $propertyPurposes = PropertyPurpose::all();
         $page_info = $type->plural_name . ' for ' . $property_purpose . ' in ' . $town_keyword->name . ', ' . $subcity_keyword->name . ', ' . $city_keyword->name;

         if ($properties->total() > 0) {
            $meta_description =
               $properties->random()->property_name . ' Largest Real-estate Developments in the Middle East Long Term Rentals✓ Long Term Sale✓ ' . $page_info;
         } else {
            $meta_description =
               'Search ' . $page_info . ' Largest Real-estate Developments in the Middle East Long Term Rentals✓ Long Term Sale✓ ';
         }

         $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst($property_purpose))
            ->where('type_id', $type->id)
            ->where('town_id', $town_keyword->id)
            ->where('area_id', null)->limit(6)->get();

         if (count($data['popularSearchesLinks']) == 0) {
            $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst($property_purpose))->inRandomOrder()->limit(6)->get();
         }


         $data['nearbyAreasLinks'] = DB::table('property_towns')
            ->leftJoin('properties', 'property_towns.id', 'properties.town')
            ->select('property_towns.name', 'property_towns.id', 'property_towns.property_cities_id', 'property_towns.property_sub_cities_id',)
            ->where('property_towns.property_sub_cities_id', $subcity_keyword->id)
            ->where('property_towns.id', '!=', $town_keyword->id)
            ->where("properties.status", 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('properties.property_type', $type->id)
            ->groupBy("property_towns.name")->limit(6)->get();

         $purp = ($buyOrRent == 'buy' ? 2 : 1);
         $landing_page_content = LandingPage::where('property_purposes_id', $purp)
            ->where('property_types_id', $type->id)
            ->where('property_cities_id', $city_keyword->id)
            ->where('property_sub_cities_id', $subcity_keyword->id)
            ->where('property_towns_id', $town_keyword->id)
            ->where('property_areas_id', null)
            ->first();

         $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
         $saveSearch = 0;
         if (auth()->user()) {
            $record = SaveSearch::where('user_id', auth()->user()->id)->where('link', $currentURL)->first();
            $saveSearch = isset($record) ? 1 : 0;
         }

         return view('front.pages.properties.town-property-type-for-purpose',compact('properties','propertyTypes','type','city_keyword','subcity_keyword','town_keyword','areas','meta_description','property_purpose','propertyPurposes','buyOrRent','page_info','landing_page_content','data','saveSearch','nearbyProperties'));

      } elseif (count($area_props) > 0) {
         //areas if 
        
        
         $type = Types::where('plural', $property_type)->orWhere('slug', $property_type)->first();
         $city_keyword = PropertyCities::where('slug', $city_slug)->firstOrFail();

         $properties = Properties::where('status', 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('property_type', $type->id)
            ->where('area_slug', $property_type_purpose)
            ->where('city', $city_keyword->id);

         $properties = $this->propertyrepo->sortyBy($properties, request());
         $properties = $properties->paginate(getcong('pagination_limit'));
         
         if($properties->total() == 0){
            $nearbyProperties = $this->propertyrepo->getNearbyProperties(request());
            if(count($nearbyProperties) == 0){
               $nearbyProperties = $this->propertyrepo->getNearbyPropertiesWithoutType(request());
            }
         }
         
         $subcity_keyword = PropertySubCities::find($properties[0]->subcity ?? $area_props[0]->subcity);
         $town_keyword = PropertyTowns::find($properties[0]->town ?? $area_props[0]->town);
         $area_keyword = PropertyAreas::find($properties[0]->area ?? $area_props[0]->area);
         
         $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select('property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('city', $city_keyword->id)
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();

         $propertyPurposes = PropertyPurpose::all();
         $page_info = $type->plural_name . ' for ' . $property_purpose . ' in ' . $area_keyword->name . ', ' . $town_keyword->name . ', ' . $subcity_keyword->name . ', ' . $city_keyword->name;

         if ($properties->total() > 0) {
            $meta_description = $properties->random()->property_name.' The Real Property Directory Where You Can Meet Properties of your choice '.$page_info;
         } else {
            $meta_description = 'Search '.$page_info.' The Real Property Directory Where You Can Meet Properties of your choice';
         }
         $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst($property_purpose))
            ->where('type_id', $type->id)
            ->where('area_id', $area_keyword->id)
            ->limit(6)->get();

         if (count($data['popularSearchesLinks']) == 0) {
            $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst($property_purpose))
               ->inRandomOrder()->limit(6)->get();
         }


         $data['nearbyAreasLinks'] = DB::table('property_areas')
            ->leftJoin('properties', 'property_areas.id', 'properties.area')
            ->select('property_areas.name', 'property_areas.id', 'property_areas.property_cities_id', 'property_areas.property_sub_cities_id', 'property_areas.property_towns_id')
            ->where('property_areas.property_sub_cities_id', $subcity_keyword->id)
            ->where('property_areas.property_towns_id', $town_keyword->id)
            ->where('property_areas.id', '!=', $area_keyword->id)
            ->where("properties.status", 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('properties.property_type', $type->id)
            ->groupBy("property_areas.name")->limit(6)->get();

         $purp = ($buyOrRent == 'buy' ? 2 : 1);
         $landing_page_content = LandingPage::where('property_purposes_id', $purp)
            ->where('property_types_id', $type->id)
            ->where('property_cities_id', $city_keyword->id)
            ->where('property_sub_cities_id', $subcity_keyword->id)
            ->where('property_towns_id', $town_keyword->id)
            ->where('property_areas_id', $area_keyword->id)
            ->first();

         $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
         $saveSearch = 0;
         if (auth()->user()) {
            $record = SaveSearch::where('user_id', auth()->user()->id)->where('link', $currentURL)->first();
            $saveSearch = isset($record) ? 1 : 0;
         }

         return view('front.pages.properties.area-property-type-for-purpose', compact('properties','propertyTypes','type','city_keyword','subcity_keyword','town_keyword','area_keyword','property_purpose','meta_description','propertyPurposes','buyOrRent','page_info','landing_page_content','data','saveSearch','nearbyProperties')
         );
      }
 
      $urlResult = 0;
      if($buyOrRent == 'buy'){
         $prefix = "-for-sale";
         $index = strpos($property_type_purpose, $prefix) + strlen($prefix);
         $urlResult = substr($property_type_purpose, $index);
      }else{
         $prefix = "-for-rent";
         $index = strpos($property_type_purpose, $prefix) + strlen($prefix);
         $urlResult = substr($property_type_purpose, $index);
         
      }
      
      $type = Types::where('plural', $property_type)->firstOrFail();
      $city_keyword = PropertyCities::where('slug', $city_slug)->firstOrFail();
   
      
      $properties = new Properties(); 

      if(strlen($urlResult) > 0){
         return Redirect::to('/', 301); 
      }else{
         $properties = Properties::where('status', 1)
         ->where('property_purpose', ucfirst($property_purpose))
         ->where('property_type', $type->id)
         ->where('city', $city_keyword->id);

         $propertiesFlag = 'set flag';
         $properties = $this->propertyrepo->sortyBy($properties, request());
         $properties = $properties->paginate(getcong('pagination_limit'));

         
         //Redirect Extra Pagination Pages of Cities
        if (request()->get('page') > 1 && $properties->isEmpty()) {
         return redirect()->route('cpt-purpose',[ $buyOrRent, $city_slug, $property_type_purpose ], 301);
       }
         
         if (empty($properties->count())) {
            return Redirect::to('/home', 301); 
         }
         
      }
     
        //Redirect Extra Pagination Pages of Cities
        if (request()->get('page') > 1 && empty($properties->count())) {
      
         return redirect()->route('cpt-purpose',[ $buyOrRent, $city_slug, $property_type_purpose ], 301);
       }
    
      $propertyTypes =  DB::table('property_types')
         ->join('properties', "property_types.id", "properties.property_type")
         ->select('property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
         ->where("properties.status", 1)
         ->where('property_purpose', ucfirst($property_purpose))
         ->where('city', $city_keyword->id)
         ->groupBy("property_types.id")
         ->orderBy("pcount", "desc")
         ->get();

      $subcities = DB::table('property_sub_cities')
         ->leftJoin('properties', 'property_sub_cities.id', 'properties.subcity')
         ->select('property_sub_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
         ->where('property_sub_cities.property_cities_id', $city_keyword->id)
         ->where("properties.status", 1)
         ->where('property_purpose', ucfirst($property_purpose))
         ->where('properties.property_type', $type->id)
         ->groupBy("property_sub_cities.id")
         ->orderBy("pcount", "desc")
         ->get();

      $propertyPurposes = PropertyPurpose::all();
      $purp = ($buyOrRent == 'buy' ? 2 : 1);
      $landing_page_content = LandingPage::where('property_purposes_id', $purp)
         ->where('property_types_id', $type->id)
         ->where('property_cities_id', $city_keyword->id)
         ->where('property_sub_cities_id', null)
         ->where('property_towns_id', null)
         ->where('property_areas_id', null)
         ->first();

      $page_info =  $type->plural_name . ' for ' . ucfirst($property_purpose) . ' in ' . $city_keyword->name;
      if (!isset($landing_page_content) && isset($propertiesFlag)) {
         $data['page_des'] = "Find " . $properties->random()->property_name . " of bed " . $properties->random()
         ->bedrooms . " and bath" . $properties->random()->bathrooms . 
         Str::limit(strip_tags($properties->random()->description), 150) . $page_info;
      }

      $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst($property_purpose))
         ->where('type_id', $type->id)
         ->where('city_id', $city_keyword->id)
         ->where('subcity_id', null)
         ->where('town_id', null)
         ->where('area_id', null)->limit(6)->get();

      if (count($data['popularSearchesLinks']) == 0) {
         $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst($property_purpose))->inRandomOrder()->limit(6)->get();
      }

      $data['nearbyAreasLinks'] = DB::table('properties')
         ->join('property_cities', 'properties.city', 'property_cities.id')
         ->select('property_cities.id', 'property_cities.name')
         ->where('property_cities.id', '!=', $city_keyword->id)
         ->where("properties.status", 1)
         ->where("properties.property_type", $type->id)
         ->groupBy('property_cities.name')
         ->where('property_purpose', ucfirst($property_purpose))->limit(6)->get();

      $request = request();

      $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      $saveSearch = 0;
      if (auth()->user()) {
         $record = SaveSearch::where('user_id', auth()->user()->id)->where('link', $currentURL)->first();
         $saveSearch = isset($record) ? 1 : 0;
      }
      return view('front.pages.properties.city-property-type-for-purpose',
      compact('properties','propertyTypes','type','city_keyword','subcities',
      'property_purpose','propertyPurposes','buyOrRent','page_info','landing_page_content',
      'request','data','saveSearch','nearbyProperties','urlResult'));
   }

   public function featureProperties()
   {
      $propertyTypes =  DB::table('property_types')
         ->join('properties', "property_types.id", "properties.property_type")
         ->select('property_types.id', 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
         ->where("properties.status", 1)
         ->where("properties.featured_property", 1)
         ->groupBy("property_types.id")
         ->orderBy("pcount", "desc")->get();

      $properties = Properties::where('status', 1);
      $properties = $this->propertyrepo->sortyBy($properties, request());

      $properties = $properties->where("featured_property", "1")->paginate(getcong('pagination_limit'));
      $propertyPurposes = PropertyPurpose::all();
      $city = Properties::all();

      $page_info = Pages::findOrFail('9');
      $request = request();
      $heading_info = 'Featured Properties in Qatar';

      $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      $saveSearch = 0;
      if (auth()->user()) {
         $record = SaveSearch::where('user_id', auth()->user()->id)->where('link', $currentURL)->first();
         $saveSearch = isset($record) ? 1 : 0;
      }

      return view('front.pages.properties.featured-properties', compact('properties', 'request', 'propertyTypes', 'city', 'heading_info', 'propertyPurposes', 'page_info', 'saveSearch'));
   }
}

