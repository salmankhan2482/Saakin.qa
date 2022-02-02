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

        $landing_pages_content = LandingPage::paginate(10);
        
        

        return view('admin.pages.landing_pages.index_property_content', compact('landing_pages_content'));
    }
    public function create()    {

        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $property_purposes = PropertyPurpose::all();
        $property_types = Types::all();
        $landing_pages_content = LandingPage::all();

        return view('admin.pages.landing_pages.add_property_content', compact('property_purposes','property_types','landing_pages_content'));
    }
    public function store(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'property_purpose' => 'required',
            
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $landing_pages_content = new LandingPage();
        $landing_pages_content->property_purposes_id = $inputs['property_purpose'];
        $landing_pages_content->property_types_id = $inputs['property_type'];
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

        $property_purposes = PropertyPurpose::all();
        $property_types = Types::all();
        $landing_page_content = LandingPage::findOrFail($id);
        return view('admin.pages.landing_pages.edit_property_content',compact('property_purposes', 'property_types','landing_page_content'));
    }
    public function update(Request $request, $id)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();
        $rule=array(
            'property_purpose' => 'required',
            
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $landing_page_content = LandingPage::findOrFail($id);

        $landing_page_content->property_purposes_id = $inputs['property_purpose'];
        $landing_page_content->property_types_id = $inputs['property_type'];
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
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {
            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');   
         }

        $page_info = LandingPage::find('53');
        $page_title=trans('words.properties_page_content');

        return view('admin.pages.properties_page_content', compact('page_info','page_title'));
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
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {
            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');   
         }

        $page_info = LandingPage::find('54');
        $page_title=trans('words.city_guide_page_content');
        
        return view('admin.pages.city_guide_page_content', compact('page_title','page_info'));
    }
    public function update_city_guide_page_content(Request $request)
    {
        $page_obj = LandingPage::find('54');
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
    public function agencies_page_content()
    {
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {
            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');   
         }

        $page_info = LandingPage::find('55');
        $page_title=trans('words.agencies_page_content');
        
        return view('admin.pages.agencies_page_content', compact('page_title','page_info'));
    }
    public function update_agencies_page_content(Request $request)
    {
        $page_obj = LandingPage::find('55');
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
}
