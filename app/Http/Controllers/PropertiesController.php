<?php

namespace App\Http\Controllers;

use App\City;
use App\Lead;
use App\User;
use App\Pages;
use App\Types;
use App\Agency;
use App\Vistor;
use App\Enquire;
use App\Visitor;
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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class PropertiesController extends Controller
{
    public function __construct()
    {
        //  check_property_exp();
    }

    public function getPropertyListing(Request $request)
    {
        if(request()->property_purpose != ''){
            $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select('property_types.id', 'property_types.types', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where("properties.property_purpose", request()->property_purpose)
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();
        }else{
            $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select('property_types.id', 'property_types.types', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();

        }
        

        $cities = Properties::select("city")
            ->where('status', 1)
            ->where('city', '!=', '')
            ->groupBy('city')->orderBy("city", "asc")->get();
            
        $propertyPurposes = PropertyPurpose::all();

        $agencies =  DB::table('agencies')
            ->join('properties', "agencies.id", "properties.agency_id")
            ->select('agencies.id', 'agencies.name', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->groupBy("agencies.id")
            ->orderBy("pcount", "desc")
            ->get();

        $amenities = PropertyAmenity::all();

        $keyword = request()->get('keyword');
        $city = request()->get('city');
        $subcity = request()->get('subcity');
        $town = request()->get('town');
        $area = request()->get('area');
        $min_price =  (int)$request->min_price;
        $max_price =  (int)$request->max_price;
        $min_area = (int)$request->min_area;
        $max_area = (int)$request->max_area;
        // dd(Properties::where('property_type', request('property_type'))->when($city, function ($query) {
        //     // city
        //     $query->where('city', request()->city);
        // })
        // ->when($subcity, function ($query) {
        //     // sub city
        //     $query->where('subcity', request()->subcity);

        // })
        // ->when($town, function ($query) {
        //     // town
        //     $query->where('town', request()->town);
        // })
        // ->when($area, function ($query) {
        //     // area
        //     $query->where('area', request()->area);
        // })->get());
        $properties = Properties::where('status', 1)
            ->when(request()->property_purpose, function ($query) {
                $query->where('property_purpose', request()->property_purpose);
            })
            ->when($city, function ($query) {
                // city
                $query->where('city', request()->city);
            })
            ->when($subcity, function ($query) {
                // sub city
                $query->where('subcity', request()->subcity);

            })
            ->when($town, function ($query) {
                // town
                $query->where('town', request()->town);
            })
            ->when($area, function ($query) {
                // area
                $query->where('area', request()->area);
            })
            ->when(request('property_type'), function ($query) {
                $query->where('property_type', request('property_type'));
            })
            ->when($min_price != 0 && $max_price != 0, function ($query) {
                $query->whereBetween('price', [(int)request()->get('min_price'), (int)request()->get('max_price')]);
            })
            ->when($min_price != 0 && $max_price == 0, function ($query) {
                $query->where('price', '>=', [(int)request()->get('min_price')]);
            })
            ->when($min_price == 0 && $max_price != 0, function ($query) {
                $query->where('price', '<=', [(int)request()->get('max_price')]);
            })
            ->when($min_price == 0 && $max_price == 0, function ($query) {
                //no condition to run
            })
            ->when(request()->get('furnishings'), function ($query) {
                $query->where('property_features', 'like', '%'.request()->get('furnishings').'%');
            })
            ->when(request()->get('keywordextra'), function($query){
                foreach(explode(', ',  request('keywordextra')) as $extra){
                    $featureIds = PropertyAmenity::where(ucfirst('name'), 'like', ucfirst('%'. $extra . '%'))->value('id');
                    if(isset($featureIds)){
                        $query = $query->where('property_features', 'like', '%'.$featureIds.'%');
                    }
                }
            })
            ->when($min_area != 0 && $max_area != 0, function ($query) {
                $query->whereBetween('land_area', [(int)request()->get('min_area'), (int)request()->get('max_area')]);
            })
            ->when($min_area != 0 && $max_area == 0, function ($query) {

                $query->where('land_area', '>=', [(int)request()->get('min_area')]);
            })
            ->when($min_area == 0 && $max_area != 0, function ($query) {
                $query->where('land_area', '<=', [(int)request()->get('max_area')]);
            })
            ->when($min_area == 0 && $max_area == 0, function ($query) {
            });
        if (isset($request->commercial)) {
            $ids = array();
            /*
            manually adding the ids of commercial property like ware-house,  shop, office, retail, whole-building, show-room, store
            */
            array_push($ids, '14', '17', '23', '27', '4', '13', '7', '34', '16', '35');
            $properties->whereIn('property_type', $ids);
        }
        if (isset($request->bedrooms) && !empty($request->bedrooms)) {

            if ($request->bedrooms == "6+") {
                $properties->where('bedrooms', '>=', 6);
            } else {
                $properties->where('bedrooms', $request->bedrooms);
            }
        }
        if (isset($request->bathrooms) && !empty($request->bathrooms)) {

            if ($request->bathrooms == "6+") {
                $properties->where('bathrooms', '>=', 6);
            } else {
                $properties->where('bathrooms', $request->bathrooms);
            }
        }

        if (isset($request->agent) && !empty($request->agent)) {
            $properties->where('agency_id', $request->agent);
        }
        if (isset($request->check) && !empty($request->check)) {
            $amenities = $request->check;
            foreach ($amenities as $amenity) {
                $properties->orWhere('property_features', 'LIKE', '%' . $amenity . '%');
            }
        }

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
            $properties->orderBy('featured_property', 'desc');
        }
        $featured = request()->get('featured');
        if ($featured == 1) {
            $properties = $properties->where("featured_property", "1")->paginate(getcong('pagination_limit'));
        } else {
            $properties = $properties->paginate(getcong('pagination_limit'));
        }

        $landing_page_content= LandingPage::find('53');
        $page_des = $landing_page_content->page_content;
        $page_des = Str::limit($page_des, 170, '...');

        if( request()->property_type ){
            $request['type'] = Types::findOrFail(request()->property_type);
        }else{
            $request['type'] = '';
        }
        $request['keyword'] = $this->findKeyWord($city, $subcity, $town, $area);
        $request['keywordMbl'] = $request['keyword'];
        return view('front.pages.properties', 
        compact('properties', 'propertyTypes', 'cities', 'propertyPurposes', 'amenities', 'agencies', 'request','landing_page_content','page_des'));
    }

    public function findKeyWord($city = null, $subcity = null, $town = null, $area = null)
    {   
        $keyword = '';
        // dd($subcity);
        if($city != null){
            $cityResult = PropertyCities::find($city);
            $keyword = $cityResult->name;
        }
        if($subcity != null){
            $subcityResult = PropertySubCities::find($subcity);
            $keyword = $subcityResult->name.' ('.$subcityResult->city->name.')';
        }
        if($town != null){
            $townResult = PropertyTowns::find($town);
            $keyword = $townResult->name.' ('.$townResult->city->name.' , '.$townResult->subcity->name.')';
        }
        if($area != null){
            $areaResult = PropertyAreas::find($area);
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
        if (Auth::check() && Auth::user()->usertype == 'Admin') {
            //we dont want to count the views for the admin
        } else {

            $visitor = request()->ip();
            $traffic = PageVisits::where('ip_address', $visitor)
            ->where('property_id', $id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->first();

            if (!$traffic) {
                $traffic = new PageVisits();
                $traffic->ip_address = $visitor;
                $traffic->property_id = $id;
                if($traffic->save()){
                    $exist = DB::table('property_counters')->where('property_id',  $id)->first();
                    // PropertyCounter::where('property_id',  $id)->first();
                    if($exist){
                        $exist->counter = $exist->counter + 1;
                        $exist->update(); 
                    }else{
                        $addNew = new PropertyCounter();
                        $addNew->property_id = $id;
                        $addNew->counter = 1;
                        $addNew->save();
                    };
                }
            }
        }

        $property = Properties::with('gallery')->where('property_slug', $slug)->findOrFail($id);
        if (!$property) {
            abort('404');
        }

        //$agent = User::where('usertype','Agents')->where('id',$property->agent_id)->first();
        $agency = Agency::where('id', $property->agency_id)->first();
        $neighborhoods = PropertyNeighborhood::where('property_id', $property->id)->get();
        $property_gallery_images = PropertyGallery::where('property_id', $property->id)->get();
        $floorPlans = PropertyFloorPlan::where('property_id', $property->id)->get();
        $documents = PropertyDocument::where('property_id', $property->id)->get();
        $views =  $property->views + 1;

        $property->views  = $views;
        $property->save();

        $properties = Properties::where('address', $property->address)
                    ->where("status", "1")
                    ->where("property_purpose", $property->property_purpose)
                    ->where("id", "!=", $id)
                    ->where('property_type', $property->property_type)
                    ->orderBy('land_area', 'asc')
                    ->get();

        
        $property_des = Str::limit($property->description, 170, '...');

        return view('front.pages.property_detail', compact('property', 'agency', 'neighborhoods', 'property_gallery_images', 'floorPlans', 'documents', 'properties', 'property_des'));

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
                'movein_date' => 'required'

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
        
        $enquire->name = $request->user_name;
        $enquire->email = $request->user_email;
        $enquire->phone = $request->telephone;
        $enquire->movein_date = $request->movein_date;
        
        $enquire->message = $request->user_message;
        $enquire->created_at = date("Y-m-d H:i:s");
        $enquire->updated_at = date("Y-m-d H:i:s");
        $enquire->save();
  
        $data_email = array(
                'user_name' => $inputs['user_name'],
                'user_email' => $inputs['user_email'],
                'telephone' => $inputs['telephone'],
                'user_message' => $inputs['user_message'],
                'movein_date' => $inputs['movein_date'],
                'property_id' => $property_data['id'],
                'property_name' => $property_data['property_name'],
                'property_type' => $property_data->propertiesTypes->types,
                'agency_name' => $property_data->Agency->name,
                'agency_email' => $property_data->Agency->email,
                'bathrooms' => $property_data['bathrooms'],
                'bedrooms' => $property_data['bedrooms'],
                'price' => $property_data['price'],
                'property_purpose' => $property_data['property_purpose'],
                'address' => $property_data['address'],
                'city' => $property_data['city'],
                'featured_image' => $property_data['featured_image'],
                'land_area' => $property_data['land_area'],
                'refference_code' => $property_data['refference_code'],
            );
                
            \Mail::send('emails.inquiry',$data_email, function ($message) use ($property_data,$inputs) {
                $message->from($inputs['user_email'])->subject
                ('Saakin Inc. | Inquiry Email');
                $message->to('hello@saakin.com');
                $message->cc($inputs['user_email']);
                $message->bcc($property_data->Agency->email, 'Saakin');
            });

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


        if (!$property) {
            abort('404');
        }

        $types = Types::orderBy('types')->get();

        $property_gallery_images = PropertyGallery::where('property_id', $property->id)->orderBy('image_name')->get();

        return view('pages.edit_property', compact('property', 'types', 'property_gallery_images'));
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

    public function inquiryEmail(Request $request)
    {
        $data =  \Request::except(array('_token'));

        $inputs = $request->all();

        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
        );

        $validator = \Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }
        $inquiry = new Enquire();
        $inquiry->property_id = $inputs['property_id'];
        $inquiry->agent_id = $inputs['agent_id'];
        $inquiry->name = $inputs['name'];
        $inquiry->email = $inputs['email'];
        $inquiry->phone = $inputs['phone'];
        $inquiry->message = $inputs['message'];
        $inquiry->save();


        $data_email = array(
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'message' => $inputs['message']
        );
        \Mail::send('emails.inquiry', $data_email, function ($message) use ($inputs) {
            $message->to($inputs['email'], $inputs['name'])
                ->from('admin@gmail.com', 'Admin')
                ->subject('Inquiry Email');
        });
        \Session::flash('flash_message_contact', trans('words.thanks_for_contacting_us'));
        return \Redirect::back();
    }


    public function propertiesForPurpose($buyOrRent, $property_purpose)
    {
        if(request()->filled('buyOrRent') && request()->filled('property_purpose')){
            $buyOrRent = request('buyOrRent');
            $property_purpose = request('property_purpose');
        }

        $properties = Properties::where('status', 1)->where('property_purpose', ucfirst($property_purpose));

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
            $properties->orderBy('id', 'asc');
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

        return view('front.pages.properties.properties-for-purpose',
        compact('properties', 'propertyTypes', 'cities', 'propertyPurposes', 'buyOrRent', 'property_purpose','landing_page_content'));
    }

    public function propertyTypeForPurpose($buyOrRent, $property)
    {
        if(request()->filled('buyOrRent') && request()->filled('property')){
            $buyOrRent = request('buyOrRent');
            $property_type = explode('-for-', request('property'))[0];
            $property_purpose = explode('-for-', request('property'))[1];
        }else{
            $buyOrRent = $buyOrRent;
            $property_type = explode('-for-', $property)[0];
            $property_purpose = explode('-for-', $property)[1];
        }

        $type = Types::where('plural', $property_type)->firstOrFail();
        $properties = Properties::where('status', 1)->where('property_purpose', ucfirst($property_purpose))->where('property_type', $type->id);
        

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
            $properties->orderBy('id', 'asc');
        }

        $properties = $properties->paginate(getcong('pagination_limit'));

        $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', ucfirst($property_purpose))
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

       if($buyOrRent == 'buy'){
        $landing_page_content = LandingPage::where('property_purposes_id', 2)->where('property_types_id',$type->id)->first();
        $page_info = $type->types.' for '.$property_purpose;
       }
       else{
        $landing_page_content = LandingPage::where('property_purposes_id', 1)->where('property_types_id',$type->id )->first();
        $page_info = $type->types.' for '.$property_purpose;
        }

        return view('front.pages.properties.property-type-for-purpose',
        compact('properties', 'propertyTypes', 'type', 'cities', 'property_purpose', 'buyOrRent', 'propertyPurposes','landing_page_content','page_info'));
    }

    public function cityPropertyTypeForPurpose($buyOrRent, $city, $property_type_purpose)
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

        $subcitie_props = Properties::where('sub_city_slug',$property_type_purpose)->get();
        $town_props = Properties::where('town_slug', $property_type_purpose)->get();
        $area_props = Properties::where('area_slug', $property_type_purpose)->get();
        //subcity if
        if(count($subcitie_props) > 0){
            $type = Types::where('plural', $property_type)->orWhere('slug', $property_type)->first();
            $city = PropertyCities::where('slug', $city)->firstOrFail();
            
            $properties = Properties::where('status', 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('property_type', $type->id)
            ->where('sub_city_slug', $property_type_purpose)
            ->where('city', $city->id);

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
                $properties->orderBy('id', 'asc');
            }

            $properties = $properties->paginate(getcong('pagination_limit'));
            $subcity = PropertySubCities::find($properties[0]->subcity);

            $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select( 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('city', $city->id)
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();

            $towns = DB::table('property_towns')
            ->leftJoin('properties', 'property_towns.id', 'properties.town')
            ->select('property_towns.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_towns.property_sub_cities_id', $subcity->id)
            ->where("properties.status", 1)
            ->where('sub_city_slug', $property_type_purpose)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('properties.property_type', $type->id)
            ->groupBy("property_towns.id")
            ->orderBy("pcount", "desc")
            ->get();

            $propertyPurposes = PropertyPurpose::all();
            $page_info = $type->types.' for '.$property_purpose.' in '.$city->slug;

            return view('front.pages.properties.subcity-property-type-for-purpose',
            compact('properties',  'propertyTypes', 'type', 'city', 'subcity', 'towns', 'property_purpose', 'propertyPurposes', 'buyOrRent','page_info'));
            
        }elseif(count($town_props) > 0){
            //town if
            $type = Types::where('plural', $property_type)->orWhere('slug', $property_type)->first();
            $city = PropertyCities::where('slug', $city)->firstOrFail();
            
            $properties = Properties::where('status', 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('property_type', $type->id)
            ->where('town_slug', $property_type_purpose)
            ->where('city', $city->id);
            
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
                $properties->orderBy('id', 'asc');
            }

            $properties = $properties->paginate(getcong('pagination_limit'));
            $subcity = PropertySubCities::find($properties[0]->subcity);
            $town = PropertyTowns::find($properties[0]->town);
            
            $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select( 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('city', $city->id)
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();

            $areas = DB::table('property_areas')
            ->leftJoin('properties', 'property_areas.id', 'properties.area')
            ->select('property_areas.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_areas.property_cities_id', $city->id)
            ->where("properties.status", 1)
            ->where('town_slug', $property_type_purpose)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('properties.property_type', $type->id)
            ->groupBy("property_areas.id")
            ->orderBy("pcount", "desc")
            ->get();

            $propertyPurposes = PropertyPurpose::all();
            $page_info = $type->types.' for '.$property_purpose.' in '.$city->slug;

            return view('front.pages.properties.town-property-type-for-purpose',
            compact('properties',  'propertyTypes', 'type', 'city', 'subcity', 'town', 'areas', 'property_purpose', 'propertyPurposes', 'buyOrRent','page_info'));
            
        
        }elseif(count($area_props) > 0){
        //areas if   
            $type = Types::where('plural', $property_type)->orWhere('slug', $property_type)->first();
            $city = PropertyCities::where('slug', $city)->firstOrFail();
            
            $properties = Properties::where('status', 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('property_type', $type->id)
            ->where('area_slug', $property_type_purpose)
            ->where('city', $city->id);
            
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
                $properties->orderBy('id', 'asc');
            }

            $properties = $properties->paginate(getcong('pagination_limit'));
            $subcity = PropertySubCities::find($properties[0]->subcity);
            $town = PropertyTowns::find($properties[0]->town);
            $area = PropertyAreas::find($properties[0]->area);
            
            $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select( 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where('property_purpose', ucfirst($property_purpose))
            ->where('city', $city->id)
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();

            $propertyPurposes = PropertyPurpose::all();
            $page_info = $type->types.' for '.$property_purpose.' in '.$city->slug;

            return view('front.pages.properties.area-property-type-for-purpose',
            compact('properties',  'propertyTypes', 'type', 'city', 'subcity', 'town', 'area', 'property_purpose', 'propertyPurposes', 'buyOrRent','page_info'));

        }

        $type = Types::where('plural', $property_type)->firstOrFail();
        $city = PropertyCities::where('slug', $city)->firstOrFail();
        
        $properties = Properties::where('status', 1)
        ->where('property_purpose', ucfirst($property_purpose))
        ->where('property_type', $type->id)
        ->where('city', $city->id);

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
            $properties->orderBy('id', 'asc');
        }
        $properties = $properties->paginate(getcong('pagination_limit'));

        $propertyTypes =  DB::table('property_types')
        ->join('properties', "property_types.id", "properties.property_type")
        ->select( 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
        ->where("properties.status", 1)
        ->where('property_purpose', ucfirst($property_purpose))
        ->where('city', $city->id)
        ->groupBy("property_types.id")
        ->orderBy("pcount", "desc")
        ->get();

        $subcities = DB::table('property_sub_cities')
        ->leftJoin('properties', 'property_sub_cities.id', 'properties.subcity')
        ->select('property_sub_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
        ->where('property_sub_cities.property_cities_id', $city->id)
        ->where("properties.status", 1)
        ->where('property_purpose', ucfirst($property_purpose))
        ->where('properties.property_type', $type->id)
        ->groupBy("property_sub_cities.id")
        ->orderBy("pcount", "desc")
        ->get();

        $propertyPurposes = PropertyPurpose::all();
        $page_info = $type->types.' for '.$property_purpose.' in '.$city->slug;

        return view('front.pages.properties.city-property-type-for-purpose',
        compact('properties',  'propertyTypes', 'type', 'city', 'subcities', 'property_purpose', 'propertyPurposes', 'buyOrRent','page_info'));
    }


    public function featureProperties()
    {
        $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select('property_types.id', 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
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
                $properties->orderBy('id', 'asc');
            }

        $properties = $properties->where("featured_property", "1")->paginate(getcong('pagination_limit'));
        $propertyPurposes = PropertyPurpose::all();
        $city = Properties::all();

        $page_info =Pages::findOrFail('9');

        return view('front.pages.properties.featured-properties',
        compact('properties',  'propertyTypes', 'city', 'propertyPurposes','page_info'));
    }

    public function buyRentDoha($buyOrRent_doha)
    {
        if(request()->filled('buyOrRent') && request()->filled('doha')){
            $buyOrRent = ucfirst(request('buyOrRent'));
            $doha = ucfirst(request('doha'));
        }else{
            $buyOrRent = ucfirst(explode('/', $buyOrRent_doha)[0]);
            $doha = ucfirst(explode('/', $buyOrRent_doha)[1]);
        }

        if($buyOrRent == 'Buy'){
            $buyOrRent = 'Sale';
            $property_purpose = 'buy';
        }else{
            $buyOrRent = $property_purpose = 'Rent';
        }

        $properties = Properties::where('status', 1)
        ->where('address', 'like', '%'.$doha.'%')
        ->where('property_purpose', $buyOrRent);

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
            $properties->orderBy('id', 'asc');
        }

        $properties = $properties->paginate(getcong('pagination_limit'));
        $city = $doha;

        $propertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select('property_types.id', 'property_types.types', 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where('address', 'like', '%'.$doha.'%')
            ->where('property_purpose', $buyOrRent)
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();

        $propertyPurposes = PropertyPurpose::all();

        return view('front.pages.properties.buy-rent-doha', compact('properties', 'propertyTypes', 'city', 'property_purpose', 'buyOrRent', 'propertyPurposes'));
    }


}
