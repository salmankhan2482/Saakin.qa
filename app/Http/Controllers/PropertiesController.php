<?php

namespace App\Http\Controllers;

use App\Pages;
use App\Types;
use App\Agency;
use App\AmenityProduct;
use App\Enquire;
use App\PageVisits;
use App\Properties;
use App\LandingPage;
use App\PropertyAreas;
use App\PropertyTowns;
use App\PropertyCities;
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
use App\PopularSearches;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;


class PropertiesController extends Controller
{
    public function __construct()
    {
        //  check_property_exp();
    }

    public function getPropertyListing(Request $request)
    {   
        if( request()->property_type ){
            $request['type'] = Types::findOrFail(request()->property_type);
        }
        
        $propertyTypes =  DB::table('property_types')
        ->join('properties', "property_types.id", "properties.property_type")
        ->select('property_types.id', 'property_types.types','property_types.plural',  
        DB::Raw('COUNT(properties.id) as pcount'))
        ->when(request()->property_purpose != '', function($query){
            $query->where("properties.property_purpose", request()->property_purpose);
        })
        ->where("properties.status", 1)
        ->groupBy("property_types.id")
        ->orderBy("pcount", "desc")->get();
        
        // breadcrumbs
        $data['result'] = DB::table('properties')->where('id', -1);

        if(request('property_purpose') && request('property_type') && request('city') && request('subcity') && request('town') && request('area')){
            $data['result'] = DB::table('properties')->where('id', -1);
            
        }elseif(request('property_purpose') && request('property_type') && request('city') && request('subcity') && request('town')){

            $data['subcity'] = PropertySubCities::find(request('subcity'));
            $data['town'] = PropertyTowns::find(request('town'));
            
            $property_type_purpose = 
            Str::slug($request['type']->plural.'-for-'.request('property_purpose').'-'.$data['subcity']->name.'-'.$data['town']->name);

            $data['result'] = DB::table('property_areas')
            ->leftJoin('properties', 'property_areas.id', 'properties.area')
            ->select('property_areas.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_areas.property_cities_id', request('city'))
            
            ->where('town_slug', $property_type_purpose)
            ->where('property_purpose', ucfirst(request('property_purpose')))
            ->where('properties.property_type', request('property_type'))
            ->groupBy("property_areas.id")
            ->orderBy("pcount", "desc")
            ->where("status", 1);
            
        }elseif(request('property_purpose') && request('property_type') && request('city') && request('subcity')){
            
            $data['subcity'] = PropertySubCities::find(request('subcity'));
            $property_type_purpose = Str::slug($request['type']->plural.'-for-'.request('property_purpose').'-'.$data['subcity']->name);
            
            $data['result'] = DB::table('property_towns')
            ->leftJoin('properties', 'property_towns.id', 'properties.town')
            ->select('property_towns.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_towns.property_sub_cities_id', request('subcity'))
            
            ->where('sub_city_slug', $property_type_purpose)
            ->where('property_purpose', ucfirst(request('property_purpose')))
            ->where('properties.property_type', request('property_type'))
            ->groupBy("property_towns.id")
            ->orderBy("pcount", "desc")
            ->where("status", 1);

        }elseif(request('property_purpose') && request('property_type') && request('city')){

            $data['result'] = DB::table('property_sub_cities')
            ->leftJoin('properties', 'property_sub_cities.id', 'properties.subcity')
            ->select('property_sub_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_sub_cities.property_cities_id', request('city'))
            
            ->where('property_purpose', ucfirst(request('property_purpose')))
            ->where('properties.property_type', request('property_type'))
            ->groupBy("property_sub_cities.id")
            ->orderBy("pcount", "desc")
            ->where("status", 1);


        }elseif(request('property_purpose') && request('property_type')){
            
            $data['result'] = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', ucfirst(request('property_purpose')))
            
            ->where('property_type', request('property_type'))
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->where("status", 1);

        }

        $data['result'] = $data['result']->when(request('min_price') != 0 && request('max_price') != 0, function ($query) {
            $query->whereBetween('properties.price', [(int)request()->get('min_price'), (int)request()->get('max_price')]);
        })
        ->when(request('min_price') != 0 && request('max_price') == 0, function ($query) {
            $query->where('properties.price', '>=', [(int)request()->get('min_price')]);
        })
        ->when(request('min_price') == 0 && request('max_price') != 0, function ($query) {
            $query->where('properties.price', '<=', [(int)request()->get('max_price')]);
        })
        ->when(request('min_price') == 0 && request('max_price') == 0, function ($query) {
            //no condition to run
        })
        ->when(request('min_area') != 0 && request('max_area') != 0, function ($query) {
            $query->whereBetween('properties.land_area', [(int)request()->get('min_area'), (int)request()->get('max_area')]);
        })
        ->when(request('min_area') != 0 && request('max_area') == 0, function ($query) {
            $query->where('properties.land_area', '>=', [(int)request()->get('min_area')]);
        })
        ->when(request('min_area') == 0 && request('max_area') != 0, function ($query) {
            $query->where('properties.land_area', '<=', [(int)request()->get('max_area')]);
        })
        ->when(request('min_area') == 0 && request('max_area') == 0, function ($query) {
        })
        ->when(isset($request->bedrooms) && !empty($request->bedrooms), function ($query) {
            if (request('bedrooms') == "6+") {
                $query->where('properties.bedrooms', '>=', 6);
            } else {
                $query->where('properties.bedrooms', request('bedrooms'));
            }
        })
        ->when(isset($request->bathrooms) && !empty($request->bathrooms), function ($query) {
            if (request('bathrooms') == "6+") {
                $query->where('properties.bathrooms', '>=', 6);
            } else {
                $query->where('properties.bathrooms', request('bathrooms'));
            }
        })
        ->when(request('furnishings'), function ($query) {
            $query->where('properties.property_features', 'like', '%'.request()->get('furnishings').'%');
        })->get();
        
        //==================================================================
        $propertyPurposes = PropertyPurpose::all();
        $amenities = PropertyAmenity::all();

        $properties = Properties::where('status', 1)
        ->when(request()->property_purpose, function ($query) {
            $query->where('property_purpose', request()->property_purpose);
        })
        ->when(request()->city, function ($query) {
            // city
            $query->where('city', request()->city);
        })
        ->when(request()->subcity, function ($query) {
            // sub city
            $query->where('subcity', request()->subcity);
        })
        ->when(request()->town, function ($query) {
            // town
            $query->where('town', request()->town);
        })
        ->when(request()->area, function ($query) {
            // area
            $query->where('area', request()->area);
        })
        ->when(request('property_type'), function ($query) {
            $query->where('property_type', request('property_type'));
        })
        ->when(request('min_price') != 0 && request('max_price') != 0, function ($query) {
            $query->whereBetween('price', [(int)request()->get('min_price'), (int)request()->get('max_price')]);
        })
        ->when(request('min_price') != 0 && request('max_price') == 0, function ($query) {
            $query->where('price', '>=', [(int)request()->get('min_price')]);
        })
        ->when(request('min_price') == 0 && request('max_price') != 0, function ($query) {
            $query->where('price', '<=', [(int)request()->get('max_price')]);
        })
        ->when(request('min_price') == 0 && request('max_price') == 0, function ($query) {
            //no condition to run
        })
        ->when(request()->get('furnishings'), function ($query) {
            $query->where('property_features', 'like', '%'.request()->get('furnishings').'%');
        })
        ->when(request()->get('amenities'), function ($query) {
            $ids = array();
            foreach (request()->get('amenities') as $value) { 
                $records =  AmenityProduct::where('amenity_id', $value)->select('property_id')->get();
                foreach ($records as $value) {
                    array_push($ids, $value->property_id);
                }
            }
            $result = array_unique($ids);
            $query->whereIn('id', $result);
            
        })
        ->when(request('min_area') != 0 && request('max_area') != 0, function ($query) {
            $query->whereBetween('land_area', [(int)request()->get('min_area'), (int)request()->get('max_area')]);
        })
        ->when(request('min_area') != 0 && request('max_area') == 0, function ($query) {
            $query->where('land_area', '>=', [(int)request()->get('min_area')]);
        })
        ->when(request('min_area') == 0 && request('max_area') != 0, function ($query) {
            $query->where('land_area', '<=', [(int)request()->get('max_area')]);
        })
        ->when(request('min_area') == 0 && request('max_area') == 0, function ($query) {
        })
        ->when(isset($request->bedrooms) && !empty($request->bedrooms), function ($query) {
            if (request('bedrooms') == "6+") {
                $query->where('properties.bedrooms', '>=', 6);
            } else {
                $query->where('properties.bedrooms', request('bedrooms'));
            }
        })
        ->when(isset($request->bathrooms) && !empty($request->bathrooms), function ($query) {
            if (request('bathrooms') == "6+") {
                $query->where('properties.bathrooms', '>=', 6);
            } else {
                $query->where('properties.bathrooms', request('bathrooms'));
            }
        })
        ->when(request()->agent, function ($query) {
            // agent
            $query->where('agency_id', request()->agent);
        });

        if (isset($request->sort_by) && !empty($request->sort_by)) {
            if ($request->sort_by == "newest") {
                $properties->orderBy('id', 'desc');
            } else if ($request->sort_by == "featured") {
                $properties->orderBy('featured_property', 'desc');
            } else if ($request->sort_by == "low_price") {
                $properties->orderBy('price', 'asc');
            } else if ($request->sort_by == "high_price") {
                $properties->orderBy('price', 'desc');
            } else if ($request->sort_by == "beds_least") {
                $properties->orderBy('bedrooms', 'asc');
            } else if ($request->sort_by == "beds_most") {
                $properties->orderBy('bedrooms', 'desc');
            }
        } else {
            $properties->orderBy('id', 'desc');
        }
        
        if (request('featured') == 1) {
            $properties = $properties->where("featured_property", "1")->paginate(getcong('pagination_limit'));
        } else {
            $properties = $properties->paginate(getcong('pagination_limit'));
        }

        $landing_page_content = LandingPage::find('53');
        $page_des = Str::limit($landing_page_content->page_content, 170, '...');

        $data['keyword'] = $this->findKeyWord(request('city'), request('subcity'), request('town'), request('area'));
        $furnishing = ''; $name = ''; $link = '';
        
        if(request('bedrooms')){
            $name = $name.(request('bedrooms') ? request('bedrooms').' bedroom ' : '');
        }
        if(request('furnishings')){
            $furnishing = PropertyAmenity::where('id', request('furnishings'))->value('name').' ';
            $name = $name.strtolower($furnishing);
        }
        
        if($request['type']){
            $name = $name.strtolower($request['type']->types).' for '. strtolower(request('property_purpose'));  
        }else{
            $name = $name. 'properties for '.strtolower(request('property_purpose'));  
        }
                
        if(request('city') && request('subcity') && request('town') && request('area')){
            $area = PropertyAreas::where('id', request('area'))->value('name');
            $name = $name.' in '.$area;
        }elseif(request('city') && request('subcity') && request('town')){
            $town = PropertyTowns::where('id', request('town'))->value('name');
            $name = $name.' in '.$town;
        }elseif(request('city') && request('subcity')){
            $subcity = PropertySubCities::where('id', request('subcity'))->value('name');
            $name = $name.' in '.$subcity;
        }elseif(request('city')){
            $city = PropertyCities::where('id', request('city'))->value('name');
            $name = $name.' in '.$city;
        }else{
            $name = $name.' in Qatar';
        }
        
        $link = "properties?featured=$request->featured&city=$request->city&subcity=$request->subcity&town=$request->town&area=$request->area&property_purpose=$request->property_purpose&property_type=$request->property_type&min_price=&max_price=&min_area=&max_area=&bedrooms=$request->bedrooms&bathrooms=&furnishings=$request->furnishings";

        $heading_info = $furnishing.' '.
        (ucfirst($request['type']->plural ?? ' properties'))
        .' for '.
        (request()->property_purpose ? request()->property_purpose : 'rent and sale ') 
        .' in '. 
        ($data['keyword'] != '' ? $data['keyword'] : 'Qatar');
        
        if(count($properties) > 0){
            if (request('property_purpose') != '') {
            $popularSearches = PopularSearches::updateOrCreate(
                [
                    'property_purpose' => request('property_purpose'),
                    'type_id' => request('property_type'),
                    'name' => $name,
                    'city_id' => request('city'),
                    'subcity_id' => request('subcity'),
                    'town_id' => request('town'),
                    'area_id' => request('area'),
                    'furnishings' => request('furnishings'),
                    'bedrooms' => request('bedrooms'),
                ],
                [
                    'count' => DB::raw('count + 1'),
                    'link' => $link,
                ]
            );
            }
        }
        
        return view('front.pages.properties', 
        compact('properties', 'propertyTypes', 'data', 'propertyPurposes', 'request','landing_page_content', 'page_des', 'heading_info'));
    }

    public function findKeyWord($city = null, $subcity = null, $town = null, $area = null)
    {   
        $keyword = '';
        if($city != null){
            $cityResult = PropertyCities::findOrFail($city);
            $keyword = $cityResult->name;
        }
        if($subcity != null){
            $subcityResult = PropertySubCities::findOrFail($subcity);
            $keyword = $subcityResult->name.' ('.$subcityResult->city->name.')';
        }
        if($town != null){
            $townResult = PropertyTowns::findOrFail($town);
            $keyword = $townResult->name.' ('.$townResult->city->name.' , '.$townResult->subcity->name.')';
        }
        if($area != null){
            $areaResult = PropertyAreas::findOrFail($area);
            $keyword = $areaResult->name.' ('.$areaResult->city->name.' , '.$areaResult->subcity->name.', '.$areaResult->town->name.')';
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

        $visitor = request()->ip();
        $traffic = PageVisits::where('ip_address', $visitor)->where('property_id', $id)
        ->whereMonth('created_at', Carbon::now()->month)->first();
        if(auth()->check() && auth()->user()->usertype == 'Admin'){
        
        }else{
            if (!$traffic) {

                $traffic = new PageVisits();
                $traffic->ip_address = $visitor;
                $traffic->property_id = $id;
                $position = Location::get('https://'.$visitor);
                $traffic->country = $position->countryName;
                $traffic->agency_id = $property->agency_id ?? '';
                $traffic->save();
            }

            $counter = PropertyCounter::where('property_id', $id)->first();
            if($counter){
                $counter->counter = $counter->counter + 1;
                $counter->update();
            }else{
                $add_counter = new PropertyCounter();
                $add_counter->property_id = $id;
                $add_counter->agency_id = $property->agency_id;
                $add_counter->save();
            }
        }
        
        
        //$agent = User::where('usertype','Agents')->where('id',$property->agent_id)->first();
        $agency = Agency::where('id', $property->agency_id)->first();
        $neighborhoods = PropertyNeighborhood::where('property_id', $property->id)->get();
        $property_gallery_images = PropertyGallery::where('property_id', $property->id)->get();
        $floorPlans = PropertyFloorPlan::where('property_id', $property->id)->get();
        $documents = PropertyDocument::where('property_id', $property->id)->get();
        $address =  '';
        if($property->area){
            if($property->city && $property->subcity){
                $address = $property->propertyCity->name.', '.$property->propertySubCity->name.', '.$property->propertyTown->name;
            }
        }else{
            if($property->city && $property->subcity){
                $address = $property->propertyCity->name.', '.$property->propertySubCity->name;
            }
        }
        
        $properties = Properties::where('address', $property->address)
                    ->where("status", "1")
                    ->where("property_purpose", $property->property_purpose)
                    ->where("id", "!=", $id)
                    ->where('property_type', $property->property_type)
                    ->orderBy('land_area', 'asc')
                    ->get();

        
        $property_des = Str::limit($property->property_name.'  '.$property->description, 150, '...');

        return view('front-view.pages.property_detail', compact('property', 'agency', 'neighborhoods', 'property_gallery_images', 'floorPlans', 'documents', 'properties', 'property_des', 'address'));

    }

    public function property_details_sendemail(Request $request)
    {
        
    	$data =  \Request::except(array('_token')) ;
        $agency_id = $request->agency_id;
        $agency_name = $request->agency_name;
        $email_action = $request->email_action;
	    $inputs = $request->all();
        $property_des = $request->property_data;
        $property_data = Properties::where('id',$property_des)->first();
	    $rule=array(
		        'user_name' => 'required',
				'user_email' => 'required|email',
		        'user_message' => 'required',
		   		 );

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }

        $enquire = new Enquire();
        if(!empty($property_data->id)){
            $enquire->property_id = $property_data->id;
        }else{
            $enquire->property_id = 0;
        }

        if(!empty($property_data->agency_id)){
            $enquire->agency_id = $property_data->agency_id;
        }else{
            $enquire->agency_id = 0;
        }

        if(!empty($property_data->agent_id)){
            $enquire->agent_id = $property_data->agent_id;
        }else{
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
            
            Session::flash('message', trans('words.thanks_for_contacting_us')); 
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
        //$agents = User::where('usertype', 'Agents')->get();
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
                //$property_floor_plan_obj->floor_images = $floor_image[$i];

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
        ////
        if (!$property) {
            abort('404');
        }
        $types = Types::orderBy('types')->get();
        $purposes = PropertyPurpose::get();
        $amenities = PropertyAmenity::orderBy("name", "asc")->get();
        //$agents = User::where('usertype','Agents')->get();
        $agencies = Agency::where('status', 1)->get();

        $property_gallery_images = PropertyGallery::where('property_id', $property->id)->orderBy('image_name')->get();
        $cities = PropertyCities::all();
        $subCities = PropertySubCities::all();
        $towns = PropertyTowns::all();
        $areas = PropertyAreas::all();

        return view('admin.pages.edit_property', 
        compact('property', 'types', 'cities', 'subCities', 'towns' ,'areas', 'purposes', 'amenities', 'agencies', 'property_gallery_images'));

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
        if(request()->filled('buyOrRent') && request()->filled('property_purpose')){
            $buyOrRent = request('buyOrRent');
            $property_purpose = request('property_purpose');
        }

        $properties = Properties::where('status', 1)
        ->where('property_purpose', ucfirst($property_purpose));
        if (isset(request()->sort_by) && !empty(request()->sort_by)) {
            if (request()->sort_by == "newest") {
                        $properties->orderBy('id', 'desc');
            } else if (request()->sort_by == "featured") {
                        $properties->orderBy('featured_property', 'desc');
            } else if (request()->sort_by == "low_price") {
                        $properties->orderBy('price', 'asc');
            } else if (request()->sort_by == "high_price") {
                        $properties->orderBy('price', 'desc');
            } else if (request()->sort_by == "beds_least") {
                        $properties->orderBy('bedrooms', 'asc');
            } else if (request()->sort_by == "beds_most") {
                        $properties->orderBy('bedrooms', 'desc');
            }
        } else {
            $properties->orderBy('id', 'desc');
        }

        $properties = $properties->paginate(getcong('pagination_limit'));

        $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select('property_types.id', 'property_types.types', 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();


        $cities = Properties::select("city")
            ->where('status', 1)
            ->where('city', '!=', '')
            ->groupBy('city')->orderBy("city", "asc")->get();
            
        $propertyPurposes = PropertyPurpose::all();


        if($buyOrRent == 'buy'){
            $landing_page_content = LandingPage::where('property_purposes_id', 2)->where('property_types_id',null )->first();
        }else{
            $landing_page_content = LandingPage::where('property_purposes_id', 1)->where('property_types_id',null )->first();
        }

        $heading_info = '';
        $furnishing = '';
        if(request()->get('furnishings')){
            $furnishing = PropertyAmenity::where('id', request()->get('furnishings'))->value('name');
        }   
        if(request('property_type')){
            $type = Types::where('id', request('property_type'))->value('types'); 
            $heading_info = $furnishing.' '.$type.' for '.request()->property_purpose.' in Qatar';
        }else{
            $heading_info = $furnishing.' Properties for '.request()->property_purpose.' in Qatar';
        }
        
        $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst(request('property_purpose')))
        ->where('city_id', null)->where('subcity_id', null)
        ->where('town_id', null)->where('area_id', null)
        ->orderBy('count', 'DESC')->limit(6)->get();
        
        $data['nearbyAreasLinks'] = DB::table('properties')->join('property_cities','properties.city','property_cities.id')
        ->select('property_cities.id','property_cities.name')->where("properties.status", 1)
        ->groupBy('property_cities.name')->where('property_purpose', ucfirst(request('property_purpose')))->limit(6)->get();
        
        $request = request();
        return view('front.pages.properties.properties-for-purpose',
        compact('properties', 'propertyTypes', 'cities', 'propertyPurposes', 'data', 'heading_info', 'buyOrRent', 'property_purpose','landing_page_content', 'request'));
    }

    public function propertyTypeForPurpose($buyOrRent, $property)
    {
        $property_type = '';
        $property_purpose = '';
        
        if(request()->filled('buyOrRent') && request()->filled('property')){
            $buyOrRent = request('buyOrRent');
            $property_type = explode('-for-', request('property'))[0];
            $property_purpose = explode('-for-', request('property'))[1];
        }else{
            $buyOrRent = $buyOrRent;
            $property_type = explode('-for-', $property)[0];
            $property_purpose = explode('-for-', $property)[1];
        }
        $type = Types::where('plural', $property_type)->first();
        if(!$type){
            $ptype = Types::where('slug', $property_type)->value('plural');
            return redirect()->route('property-type-purpose', [$buyOrRent, $ptype.'-for-'.$property_purpose], 301);
        }
        $properties = Properties::where('status', 1)
        ->where('property_purpose', ucfirst($property_purpose))
        ->where('property_type', $type->id);
        

        if (isset(request()->sort_by) && !empty(request()->sort_by)) {
            if (request()->sort_by == "newest") {
                        $properties->orderBy('id', 'desc');
            } else if (request()->sort_by == "featured") {
                        $properties->orderBy('featured_property', 'desc');
            } else if (request()->sort_by == "low_price") {
                        $properties->orderBy('price', 'asc');
            } else if (request()->sort_by == "high_price") {
                        $properties->orderBy('price', 'desc');
            } else if (request()->sort_by == "beds_least") {
                        $properties->orderBy('bedrooms', 'asc');
            } else if (request()->sort_by == "beds_most") {
                        $properties->orderBy('bedrooms', 'desc');
            }
        } else {
            $properties->orderBy('id', 'desc');
        }

        $properties = $properties->paginate(getcong('pagination_limit'));

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
        ->select( 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
        ->where("properties.status", 1)
        ->where('property_purpose', ucfirst($property_purpose))
        ->groupBy("property_types.id")
        ->orderBy("pcount", "desc")
        ->get();

        $propertyPurposes = PropertyPurpose::all();

        $purp = ($buyOrRent == 'buy' ? 2 : 1);
        $landing_page_content = LandingPage::where('property_purposes_id', $purp)->where('property_types_id',$type->id)->first();
        $page_info = $type->plural.' for '.$property_purpose;
        $heading_info = ($type->plural_name ? $type->plural_name : ' Properties for ').' for '.$property_purpose.' in Qatar';

        $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst($property_purpose))
        ->where('type_id', $type->id)
        ->where('city_id', null)
        ->where('subcity_id', null)
        ->where('town_id', null)
        ->where('area_id', null)->limit(6)->get();
        
        $data['nearbyAreasLinks'] = DB::table('properties')->join('property_cities','properties.city','property_cities.id')
        ->select('property_cities.id','property_cities.name')
        ->where("properties.status", 1)
        ->where("properties.property_type", $type->id)
        ->groupBy('property_cities.name')
        ->where('property_purpose', ucfirst($property_purpose))->limit(6)->get();

        $request = request();
        return view('front.pages.properties.property-type-for-purpose',
        compact('properties', 'propertyTypes', 'type', 'cities', 'property_purpose', 'buyOrRent', 'propertyPurposes','landing_page_content','page_info', 'request', 'heading_info', 'data'));
    }

    public function cityPropertyTypeForPurpose($buyOrRent, $city_slug, $property_type_purpose)
    {
        if(request()->filled('buyOrRent') && request()->filled('property_type_purpose')){
            $buyOrRent = request('buyOrRent');
            $property_type = explode('-for-', request('property_type_purpose'))[0];
            
            if($buyOrRent == 'Rent' OR $buyOrRent == 'rent'){ $property_purpose = 'Rent'; } else{ $property_purpose = 'Sale'; }

        }else{
            $buyOrRent = $buyOrRent;
            $property_type = explode('-for-', $property_type_purpose)[0];
            
            if($buyOrRent == 'Rent' OR $buyOrRent == 'rent'){ $property_purpose = 'Rent'; } else{ $property_purpose = 'Sale'; }
        
        }
        $subcitie_props = Properties::where('sub_city_slug',$property_type_purpose)->where('status', 1)->get();
        $town_props = Properties::where('town_slug', $property_type_purpose)->where('status', 1)->get();
        $area_props = Properties::where('area_slug', $property_type_purpose)->where('status', 1)->get();

        //subcity if
        if(count($subcitie_props) > 0){
            $type = Types::where('plural', $property_type)->orWhere('slug', $property_type)->first();
            $city_keyword = PropertyCities::where('slug', $city_slug)->firstOrFail();
            
            $properties = Properties::where('status', 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('property_type', $type->id)
            ->where('sub_city_slug', $property_type_purpose)
            ->where('city', $city_keyword->id);

            if (isset(request()->sort_by) && !empty(request()->sort_by)) {
                if (request()->sort_by == "newest") {
                            $properties->orderBy('id', 'desc');
                } else if (request()->sort_by == "featured") {
                            $properties->orderBy('featured_property', 'desc');
                } else if (request()->sort_by == "low_price") {
                            $properties->orderBy('price', 'asc');
                } else if (request()->sort_by == "high_price") {
                            $properties->orderBy('price', 'desc');
                } else if (request()->sort_by == "beds_least") {
                            $properties->orderBy('bedrooms', 'asc');
                } else if (request()->sort_by == "beds_most") {
                            $properties->orderBy('bedrooms', 'desc');
                }
            } else {
                $properties->orderBy('id', 'desc');
            }

            $properties = $properties->paginate(getcong('pagination_limit'));
            $subcity_keyword = PropertySubCities::find($properties[0]->subcity);

            $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select( 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
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
            $page_info = $type->plural_name.' for '.$property_purpose.' in '.$city_keyword->name.', '.$subcity_keyword->name;
            
            $data['popularSearchesLinks'] = PopularSearches::
            where('property_purpose', ucfirst($property_purpose))
            ->where('type_id', $type->id)
            ->where('subcity_id', $subcity_keyword->id)
            ->where('town_id', null)
            ->where('area_id', null)->limit(6)->get();

            $data['nearbyAreasLinks'] = DB::table('properties')
            ->join('property_sub_cities','properties.subcity','property_sub_cities.id')
            ->select('property_sub_cities.id','property_sub_cities.name','property_sub_cities.property_cities_id')
            ->where("properties.status", 1)
            ->where("properties.property_type", $type->id)
            ->where("properties.subcity", $subcity_keyword->id)
            ->groupBy('property_sub_cities.name')
            ->where('property_purpose', ucfirst($property_purpose))->limit(6)->get();


            if($properties->total() > 0){
                $meta_description = $properties->random()->property_name. ' Short Term Flats &amp; Long Term Rentals✓ Long Term Sale✓ '.$page_info;
            }else{
                $meta_description = 'Search '.$page_info.' Short Term Flats &amp; Long Term Rentals✓ Long Term Sale✓ ';
            }
                 
            return view('front.pages.properties.subcity-property-type-for-purpose', 
            compact('properties',  'propertyTypes', 'type', 'city_keyword', 'subcity_keyword', 'towns', 'meta_description', 'property_purpose', 'propertyPurposes', 'buyOrRent','page_info', 'data'));
            
        }elseif(count($town_props) > 0){
            //town if
            $type = Types::where('plural', $property_type)->orWhere('slug', $property_type)->first();
            $city_keyword = PropertyCities::where('slug', $city_slug)->firstOrFail();
            
            $properties = Properties::where('status', 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('property_type', $type->id)
            ->where('town_slug', $property_type_purpose)
            ->where('city', $city_keyword->id);
            
            if (isset(request()->sort_by) && !empty(request()->sort_by)) {
                if (request()->sort_by == "newest") {
                            $properties->orderBy('id', 'desc');
                } else if (request()->sort_by == "featured") {
                            $properties->orderBy('featured_property', 'desc');
                } else if (request()->sort_by == "low_price") {
                            $properties->orderBy('price', 'asc');
                } else if (request()->sort_by == "high_price") {
                            $properties->orderBy('price', 'desc');
                } else if (request()->sort_by == "beds_least") {
                            $properties->orderBy('bedrooms', 'asc');
                } else if (request()->sort_by == "beds_most") {
                            $properties->orderBy('bedrooms', 'desc');
                }
            } else {
                $properties->orderBy('id', 'desc');
            }
            $properties = $properties->paginate(getcong('pagination_limit'));
            
            $subcity_keyword = PropertySubCities::find($properties[0]->subcity);
            $town_keyword = PropertyTowns::find($properties[0]->town);
            
            $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select( 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
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
            $page_info = $type->plural_name.' for '.$property_purpose.' in '.$city_keyword->name.', '.$subcity_keyword->name.', '.$town_keyword->name;

            if($properties->total() > 0){
                $meta_description = 
                $properties->random()->property_name. ' Largest Real-estate Developments in the Middle East Long Term Rentals✓ Long Term Sale✓ '.$page_info;
            }else{
                $meta_description = 
                'Search '.$page_info.' Largest Real-estate Developments in the Middle East Long Term Rentals✓ Long Term Sale✓ ';
            }

            $data['popularSearchesLinks'] = PopularSearches::
            where('property_purpose', ucfirst($property_purpose))
            ->where('type_id', $type->id)
            ->where('town_id', $town_keyword->id)
            ->where('area_id', null)->limit(6)->get();

            $data['nearbyAreasLinks'] = DB::table('properties')
            ->join('property_towns','properties.town','property_towns.id')
            ->select('property_towns.id','property_towns.name','property_towns.property_cities_id','property_towns.property_sub_cities_id')
            ->where("properties.status", 1)
            ->where("properties.property_type", $type->id)
            ->where("properties.town", $town_keyword->id)
            ->groupBy('property_towns.name')
            ->where('property_purpose', ucfirst($property_purpose))->limit(6)->get();
            
            return view('front.pages.properties.town-property-type-for-purpose',
            compact('properties',  'propertyTypes', 'type', 'city_keyword', 'subcity_keyword', 'town_keyword', 'areas', 'meta_description', 'property_purpose', 'propertyPurposes', 'buyOrRent','page_info','data'));
            
        
        }elseif(count($area_props) > 0){
        //areas if   
            $type = Types::where('plural', $property_type)->orWhere('slug', $property_type)->first();
            $city_keyword = PropertyCities::where('slug', $city_slug)->firstOrFail();
            
            $properties = Properties::where('status', 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('property_type', $type->id)
            ->where('area_slug', $property_type_purpose)
            ->where('city', $city_keyword->id);
            
            if (isset(request()->sort_by) && !empty(request()->sort_by)) {
                if (request()->sort_by == "newest") {
                            $properties->orderBy('id', 'desc');
                } else if (request()->sort_by == "featured") {
                            $properties->orderBy('featured_property', 'desc');
                } else if (request()->sort_by == "low_price") {
                            $properties->orderBy('price', 'asc');
                } else if (request()->sort_by == "high_price") {
                            $properties->orderBy('price', 'desc');
                } else if (request()->sort_by == "beds_least") {
                            $properties->orderBy('bedrooms', 'asc');
                } else if (request()->sort_by == "beds_most") {
                            $properties->orderBy('bedrooms', 'desc');
                }
            } else {
                $properties->orderBy('id', 'desc');
            }
            
            $properties = $properties->paginate(getcong('pagination_limit'));
            $subcity_keyword = PropertySubCities::find($properties[0]->subcity);
            $town_keyword = PropertyTowns::find($properties[0]->town);
            $area_keyword = PropertyAreas::find($properties[0]->area);
            
            $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select( 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('city', $city_keyword->id)
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();

            $propertyPurposes = PropertyPurpose::all();
            $page_info = $type->plural_name.' for '.$property_purpose.' in '.$city_keyword->name.', '.$subcity_keyword->name.', '.$town_keyword->name.', '.$area_keyword->name;

            if($properties->total() > 0){
                $meta_description = 
                $properties->random()->property_name. ' The Real Property Directory Where You Can Meet Properties of your choice  '.$page_info;
            }else{
                $meta_description = 
                'Search '.$page_info.' The Real Property Directory Where You Can Meet Properties of your choice  ';
            }

            $data['popularSearchesLinks'] = PopularSearches::
            where('property_purpose', ucfirst($property_purpose))
            ->where('type_id', $type->id)
            ->where('area_id', $area_keyword->id)
            ->limit(6)->get();

            $data['nearbyAreasLinks'] = DB::table('properties')
            ->join('property_areas','properties.area','property_areas.id')
            ->select('property_areas.id','property_areas.name','property_areas.property_cities_id',
            'property_areas.property_sub_cities_id','property_areas.property_towns_id')
            ->where("properties.status", 1)
            ->where("properties.property_type", $type->id)
            ->where("properties.area", $area_keyword->id)
            ->groupBy('property_areas.name')
            ->where('property_purpose', ucfirst($property_purpose))->limit(6)->get();

            return view('front.pages.properties.area-property-type-for-purpose',
            compact('properties',  'propertyTypes', 'type', 'city_keyword', 'subcity_keyword', 'town_keyword', 'area_keyword', 'property_purpose', 'meta_description', 'propertyPurposes', 'buyOrRent','page_info', 'data'));

        }        
        
        $type = Types::where('plural', $property_type)->firstOrFail();
        $city_keyword = PropertyCities::where('slug', $city_slug)->firstOrFail();
        
        $properties = Properties::where('status', 1)
        ->where('property_purpose', ucfirst($property_purpose))
        ->where('property_type', $type->id)
        ->where('city', $city_keyword->id);
        
        if (isset(request()->sort_by) && !empty(request()->sort_by)) {
            if (request()->sort_by == "newest") {
                        $properties->orderBy('id', 'desc');
            } else if (request()->sort_by == "featured") {
                        $properties->orderBy('featured_property', 'desc');
            } else if (request()->sort_by == "low_price") {
                        $properties->orderBy('price', 'asc');
            } else if (request()->sort_by == "high_price") {
                        $properties->orderBy('price', 'desc');
            } else if (request()->sort_by == "beds_least") {
                        $properties->orderBy('bedrooms', 'asc');
            } else if (request()->sort_by == "beds_most") {
                        $properties->orderBy('bedrooms', 'desc');
            }
        } else {
            $properties->orderBy('id', 'desc');
        }
        $properties = $properties->paginate(getcong('pagination_limit'));

        $propertyTypes =  DB::table('property_types')
        ->join('properties', "property_types.id", "properties.property_type")
        ->select( 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
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
        $landing_page_content = LandingPage::where('property_purposes_id', $purp)->where('property_types_id',$type->id)->first();
        $page_info = $type->plural.' for '.$property_purpose;

        $data['popularSearchesLinks'] = PopularSearches::where('property_purpose', ucfirst($property_purpose))
        ->where('type_id', $type->id)
        ->where('city_id', $city_keyword->id)
        ->where('subcity_id', null)
        ->where('town_id', null)
        ->where('area_id', null)->limit(6)->get();

        $data['nearbyAreasLinks'] = DB::table('properties')->join('property_cities','properties.city','property_cities.id')
        ->select('property_cities.id','property_cities.name')
        ->where("properties.status", 1)
        ->where("properties.property_type", $type->id)
        ->where("properties.city", $city_keyword->id)
        ->groupBy('property_cities.name')
        ->where('property_purpose', ucfirst($property_purpose))->limit(6)->get();

        $request = request();
        return view('front.pages.properties.city-property-type-for-purpose',
        compact('properties',  'propertyTypes', 'type', 'city_keyword', 'subcities', 'property_purpose', 'propertyPurposes', 'buyOrRent','page_info','landing_page_content', 'request', 'data'));
    }


    public function featureProperties()
    {
        $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select('property_types.id', 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where("properties.featured_property", 1)
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();

            $properties = Properties::where('status', 1);

            if (isset(request()->sort_by) && !empty(request()->sort_by)) {
                if (request()->sort_by == "newest") {
                            $properties->orderBy('id', 'desc');
                } else if (request()->sort_by == "featured") {
                            $properties->orderBy('featured_property', 'desc');
                } else if (request()->sort_by == "low_price") {
                            $properties->orderBy('price', 'asc');
                } else if (request()->sort_by == "high_price") {
                            $properties->orderBy('price', 'desc');
                } else if (request()->sort_by == "beds_least") {
                            $properties->orderBy('bedrooms', 'asc');
                } else if (request()->sort_by == "beds_most") {
                            $properties->orderBy('bedrooms', 'desc');
                }
            } else {
                $properties->orderBy('id', 'desc');
            }

        $properties = $properties->where("featured_property", "1")->paginate(getcong('pagination_limit'));
        $propertyPurposes = PropertyPurpose::all();
        $city = Properties::all();

        $page_info =Pages::findOrFail('9');
        $request = request();
        $heading_info = 'Featured Properties in Qatar';

        return view('front.pages.properties.featured-properties',
        compact('properties', 'request', 'propertyTypes', 'city', 'heading_info', 'propertyPurposes','page_info'));
    }

}
