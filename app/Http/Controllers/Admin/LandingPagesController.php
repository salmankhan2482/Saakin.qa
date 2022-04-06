<?php

namespace App\Http\Controllers\Admin;

use App\Types;
use App\Agency;
use App\LandingPage;
use App\LandingPages;
use App\PropertyPurpose;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PropertyCities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LandingPagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }
        $action = 'saakin_index';
        $data['landing_pages_content'] = LandingPage::all();
        return view('admin-dashboard.landing-pages.landing_page_content.index', compact('data', 'action'));
    }
    public function create()    {

        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $data['property_purposes'] = PropertyPurpose::all();
        $data['property_types'] = Types::all();
        $data['cities'] = PropertyCities::all();
        $data['landing_pages_content'] = LandingPage::all();
        $action = 'saakin_create';
        
        return view('admin-dashboard.landing-pages.landing_page_content.create', compact('data','action'));
    }

    public function show($id)
    {
        dd('show');
    }
    public function store(Request $request)
    {
        $data =  \Request::except(array('_token')) ;
        $inputs = $request->all();
        $rule=array(
            'property_purposes_id' => 'required',
        );

        $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $landing_pages_content = new LandingPage();
        $landing_pages_content->property_purposes_id = $inputs['property_purposes_id'];
        $landing_pages_content->property_types_id = $inputs['property_types_id'];
        $landing_pages_content->property_cities_id = $inputs['property_cities_id'];
        $landing_pages_content->page_content = $inputs['page_content'];
        $landing_pages_content->meta_title = $inputs['meta_title'];
        $landing_pages_content->meta_description = $inputs['meta_description'];
        $landing_pages_content->meta_keyword = $inputs['meta_keyword'];

        $landing_pages_content->save();

        \Session::flash('flash_message', trans('words.added'));
        return \Redirect::back();
       
    }
    public function edit($id)
    {
        if(Auth::User()->usertype!="Admin") {
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $data['property_purposes'] = PropertyPurpose::all();
        $data['property_types'] = Types::all();
        $data['cities'] = PropertyCities::all();
        $data['landing_page_content'] = LandingPage::findOrFail($id);
        $action = 'saakin_create';

        return view('admin-dashboard.landing-pages.landing_page_content.edit', compact('data', 'action'));
    }
    public function update(Request $request, $id)
    {

        
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();
        $rule=array( 'property_purposes_id' => 'required');
        
        $validator = \Validator::make($data,$rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        $landing_page_content = LandingPage::findOrFail($id);

        $landing_page_content->property_purposes_id = $inputs['property_purposes_id'];
        $landing_page_content->property_types_id = $inputs['property_types_id'];
        $landing_page_content->property_cities_id = $inputs['property_cities_id'];
        $landing_page_content->page_content = $inputs['page_content'];
        $landing_page_content->meta_title = $inputs['meta_title'];
        $landing_page_content->meta_description = $inputs['meta_description'];
        $landing_page_content->meta_keyword = $inputs['meta_keyword'];
        $landing_page_content->save();
       
        \Session::flash('flash_message', trans('words.updated'));
        return \Redirect::back();
    }
    public function destroy($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $landing_page_content = LandingPage::findOrFail($id);
        $landing_page_content->delete();
        \Session::flash('flash_message', trans('words.deleted'));
        return redirect()->back();
    }
    public function properties_page_content()
    {
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');   
        }

        $page_info = LandingPage::find('53');
        $page_title=trans('words.properties_page_content');
        $action = 'saakin_edit';

        return view('admin-dashboard.landing-pages.properties_page_content.properties_page_content',
         compact('page_info','page_title','action'));
    }
    public function update_properties_page_content(Request $request)
    {
        $page_obj = LandingPage::find('53');
	    $data =  \Request::except(array('_token')) ;
	    $rule=array('page_title' => 'required' );
	   	 $validator = \Validator::make($data,$rule);
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }

	    $inputs = $request->all(); 	 
        $page_obj->page_content = $inputs['page_content'];
        $page_obj->meta_title = $inputs['meta_title'];
        $page_obj->meta_description = $inputs['meta_description'];
        $page_obj->meta_keyword = $inputs['meta_keyword'];    
	    $page_obj->save(); 

 
	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }
    public function city_guide_page_content()
    {
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');   
         }

        $data['page_info'] = LandingPage::find('54');
        $data['page_title'] = trans('words.city_guide_page_content');
        $action = 'saakin_index';

        return view('admin-dashboard.landing-pages.city_guide_page_content.create', compact('data','action'));
    }
    public function update_city_guide_page_content(Request $request)
    {
        $page_obj = LandingPage::find('54');
	    $data =  \Request::except(array('_token')) ;
	    $rule = array('page_title' => 'required' );

	   	 $validator = \Validator::make($data,$rule);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->messages());
        }

	    $inputs = $request->all(); 	 
        $page_obj->page_content = $inputs['page_content'];
        $page_obj->meta_title = $inputs['meta_title'];
        $page_obj->meta_description = $inputs['meta_description'];
        $page_obj->meta_keyword = $inputs['meta_keyword'];    
	    $page_obj->save(); 

 
	    Session::flash('flash_message', trans('words.successfully_updated'));
        return redirect()->back();
    }
    public function agencies_page_content()
    {
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');   
         }

        $data['page_info'] = LandingPage::find('55');
        $data['page_title'] = trans('words.agencies_page_content');
        $action = 'saakin_create';
        return view('admin-dashboard.landing-pages.agency_page_content.create', compact('data','action'));
    }
    public function update_agencies_page_content(Request $request)
    {
        $page_obj = LandingPage::find('55');
	    $data =  \Request::except(array('_token')) ;
	    $rule=array('page_title' => 'required' );
        $validator = \Validator::make($data,$rule);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->messages());
        }

	    $inputs = $request->all(); 	 
        $page_obj->page_content = $inputs['page_content'];
        $page_obj->meta_title = $inputs['meta_title'];
        $page_obj->meta_description = $inputs['meta_description'];
        $page_obj->meta_keyword = $inputs['meta_keyword'];    
	    $page_obj->save(); 

 
	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
        
    }
}
