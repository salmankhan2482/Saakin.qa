<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Pages;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str; 

class PagesController extends MainAdminController
{
	public function __construct()
   {
      $this->middleware('auth');	
      
   }

   public function properties_for_purpose_page()
   { 

      if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin"){
         \Session::flash('flash_message', trans('words.access_denied'));

         return redirect('dashboard');   
      }

      $page_info = Pages::findOrFail('6');
      $page_title=trans('words.properties_for_purpose');
         
      return view('admin.pages.properties_for_purpose_page',compact('page_title','page_info'));
   }
   
   public function update_properties_for_purpose_page(Request $request)
   {  
    	 
    	$page_obj = Pages::findOrFail('6');
      $data =  \Request::except(array('_token')) ;
      $rule=array('page_title' => 'required' );
      
      $validator = \Validator::make($data,$rule);
      if ($validator->fails()){
               return redirect()->back()->withErrors($validator->messages());
      }

      $inputs = $request->all(); 
      $page_slug = Str::slug($inputs['page_title'], '-');
		$page_obj->page_title = $inputs['page_title'];
      $page_obj->page_slug = $page_slug; 	 
      $page_obj->page_content = $inputs['page_content'];
      $page_obj->meta_title = $inputs['meta_title'];
      $page_obj->meta_description = $inputs['meta_description'];
      $page_obj->meta_keyword = $inputs['meta_keyword'];
      $page_obj->status = $inputs['status'];       
      $page_obj->save(); 
	    Session::flash('flash_message', trans('words.successfully_updated'));
        return redirect()->back();
   }
    
   public function property_type_for_purpose_page()
   { 
      if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');   
      }

      $page_info = Pages::findOrFail('7');
      $page_title=trans('words.property_type_for_purpose');
         
      return view('admin.pages.property_type_for_purpose_page',compact('page_title','page_info'));
   }
    
   public function update_property_type_for_purpose_page(Request $request)
   {  
    	  
    	$page_obj = Pages::findOrFail('7');
      $data =  \Request::except(array('_token')) ;
      $rule=array('page_title' => 'required' );
      
      $validator = \Validator::make($data,$rule);
      if ($validator->fails()){
         return redirect()->back()->withErrors($validator->messages());
      }

      $inputs = $request->all(); 
      $page_slug = Str::slug($inputs['page_title'], '-');
		$page_obj->page_title = $inputs['page_title'];
      $page_obj->page_slug = $page_slug; 	 
      $page_obj->page_content = $inputs['page_content'];
      $page_obj->meta_title = $inputs['meta_title'];
      $page_obj->meta_description = $inputs['meta_description'];
      $page_obj->meta_keyword = $inputs['meta_keyword'];
      $page_obj->status = $inputs['status'];       
      $page_obj->save(); 

      Session::flash('flash_message', trans('words.successfully_updated'));
      return redirect()->back();
   }
   
   public function city_property_type_purpose_page()
   { 
      if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin"){
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('dashboard');   
      }

      $page_info = Pages::findOrFail('8');
      $page_title=trans('words.city_property_type_purpose');
         
      return view('admin.pages.city_property_type_purpose_page',compact('page_title','page_info'));
   }
    
   public function update_city_property_type_purpose_page(Request $request)
   {      	  
    	$page_obj = Pages::findOrFail('8');
      $data =  \Request::except(array('_token')) ;
      $rule=array('page_title' => 'required' );
      
      $validator = \Validator::make($data,$rule);
      if ($validator->fails()){
         return redirect()->back()->withErrors($validator->messages());
      }

      $inputs = $request->all(); 
      $page_slug = Str::slug($inputs['page_title'], '-');
      $page_obj->page_title = $inputs['page_title'];
      $page_obj->page_slug = $page_slug; 	 
      $page_obj->page_content = $inputs['page_content'];
      $page_obj->meta_title = $inputs['meta_title'];
      $page_obj->meta_description = $inputs['meta_description'];
      $page_obj->meta_keyword = $inputs['meta_keyword'];
      $page_obj->status = $inputs['status'];       
      $page_obj->save(); 

      Session::flash('flash_message', trans('words.successfully_updated'));
      return redirect()->back();
   }

    public function featured_properties_page()
    { 
 
    	if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {
            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');   
         }

        $page_info = Pages::findOrFail('9');
        $page_title=trans('words.featured_properties');
          
        return view('admin.pages.featured_properties_page',compact('page_title','page_info'));
    }
    public function update_featured_properties_page(Request $request)
    {  
    	  
    	$page_obj = Pages::findOrFail('9');
	    $data =  \Request::except(array('_token')) ;
	    $rule=array('page_title' => 'required' );
	   	 $validator = \Validator::make($data,$rule);
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }

	    $inputs = $request->all(); 
        $page_slug = Str::slug($inputs['page_title'], '-');
		$page_obj->page_title = $inputs['page_title'];
        $page_obj->page_slug = $page_slug; 	 
        $page_obj->page_content = $inputs['page_content'];
        $page_obj->status = $inputs['status'];
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

        $data['page_info'] = Pages::find('6');
        $data['page_title'] = trans('words.agencies_page_content');
        $action = 'saakin_create';
        return view('admin-dashboard.landing-pages.agency_page_content.create', compact('data','action'));
    }

    public function update_agencies_page_content(Request $request)
    {
        $page_obj = Pages::find('6');
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

    public function city_guide_page_content()
    {
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');   
         }

        $data['page_info'] = Pages::find('7');
        $data['page_title'] = trans('words.city_guide_page_content');
        $action = 'saakin_index';

        return view('admin-dashboard.landing-pages.city_guide_page_content.create', compact('data','action'));
    }
    public function update_city_guide_page_content(Request $request)
    {
        $page_obj = Pages::find('7');
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

    public function about_page()
    { 
 
    	if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
         }

        $page_info = Pages::findOrFail('1');

        $page_title=trans('words.about_us');
        $action = 'saakin_edit';
          
        return view('admin-dashboard.landing-pages.about_page_content.about_page_content',
        compact('page_title','page_info','action'));
    }	 
    
    public function update_about_page(Request $request)
    {  
    	  
    	$page_obj = Pages::findOrFail('1');
 
	    
	    $data =  \Request::except(array('_token')) ;
	    
	    $rule=array(
		        'page_title' => 'required' 
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
	    

	    $inputs = $request->all(); 
        
        $page_slug = Str::slug($inputs['page_title'], '-');

		$page_obj->page_title = $inputs['page_title'];
        $page_obj->page_slug = $page_slug; 	 
        $page_obj->page_content = addslashes($inputs['page_content']);
        $page_obj->meta_title = $inputs['meta_title'];
        $page_obj->meta_description = $inputs['meta_description'];
        $page_obj->meta_keyword = $inputs['meta_keyword']; 
        $page_obj->status = $inputs['status'];       
	    $page_obj->save(); 

 
	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }
    

    public function terms_page()
    { 
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
         }

        $page_info = Pages::findOrFail('2');

        $page_title=trans('words.terms_of_us');
        $action = 'saakin_edit';
         
        return view('admin-dashboard.landing-pages.terms_of_use_page_content.terms_of_use_page_content',
        compact('page_title','page_info','action'));
    }    
    
    public function update_terms_page(Request $request)
    {  
          
        $page_obj = Pages::findOrFail('2');
 
        
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(
                'page_title' => 'required' 
                 );
        
         $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
        

        $inputs = $request->all(); 
        
        $page_slug = Str::slug($inputs['page_title'], '-');

        $page_obj->page_title = $inputs['page_title'];
        $page_obj->page_slug = $page_slug;   
        $page_obj->page_content = addslashes($inputs['page_content']);
        $page_obj->meta_title = $inputs['meta_title'];
        $page_obj->meta_description = $inputs['meta_description'];
        $page_obj->meta_keyword = $inputs['meta_keyword']; 
        $page_obj->status = $inputs['status'];       
        $page_obj->save(); 

 
        Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }
    

    public function privacy_policy_page()
    { 
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
         }

        $page_info = Pages::findOrFail('3');

        $page_title=trans('words.privacy_policy');
        $action = 'saakin_edit';
         
        return view('admin-dashboard.landing-pages.privacy_policy_page_content.privacy_policy_page_content',
        compact('page_title','page_info','action'));
    }    
    
    public function update_privacy_policy_page(Request $request)
    {  
          
        $page_obj = Pages::findOrFail('3');
 
        
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(
                'page_title' => 'required' 
                 );
        
         $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
        

        $inputs = $request->all(); 
        
        $page_slug = Str::slug($inputs['page_title'], '-');

        $page_obj->page_title = $inputs['page_title'];
        $page_obj->page_slug = $page_slug;   
        $page_obj->page_content = addslashes($inputs['page_content']);
        $page_obj->meta_title = $inputs['meta_title'];
        $page_obj->meta_description = $inputs['meta_description'];
        $page_obj->meta_keyword = $inputs['meta_keyword']; 
        $page_obj->status = $inputs['status'];       
        $page_obj->save(); 

 
        Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    } 


    public function faq_page()
    { 
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
         }

        $page_info = Pages::findOrFail('4');

        $page_title=trans('words.faq');
        $action = 'saakin_edit';
         
        return view('admin-dashboard.landing-pages.faqs_page_content.faqs_page_content',
        compact('page_title','page_info','action'));
    }    
    
    public function update_faq_page(Request $request)
    {  
          
        $page_obj = Pages::findOrFail('4');
 
        
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(
                'page_title' => 'required' 
                 );
        
         $validator = \Validator::make($data,$rule);
 
            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }
        

        $inputs = $request->all(); 
        
        $page_slug = Str::slug($inputs['page_title'], '-');

        $page_obj->page_title = $inputs['page_title'];
        $page_obj->page_slug = $page_slug;   
        $page_obj->page_content = addslashes($inputs['page_content']);
        $page_obj->meta_title = $inputs['meta_title'];
        $page_obj->meta_description = $inputs['meta_description'];
        $page_obj->meta_keyword = $inputs['meta_keyword'];
        $page_obj->status = $inputs['status'];       
        $page_obj->save(); 

 
        Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }
     
    	
}
