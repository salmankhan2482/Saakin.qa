<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Pages;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

use Session;

class PagesController extends Controller
{
	public function __construct()
    {
       //  check_property_exp();
    }

   //  public function get_page($slug)
   //  {

   //     $page_info = Pages::where('page_slug',$slug)->first();
      
       

   //     return view('front.pages.pages',compact('page_info'));

   //  }
    public function about_us()
    {

      $page_info =Pages::findOrFail('1'); 

       return view('front.pages.about_us',compact('page_info'));

    }
    public function terms_of_use()
    {

      $page_info =Pages::findOrFail('2'); 

       return view('front.pages.terms_of_use',compact('page_info'));

    }
    public function privacy_policy()
    {

      $page_info =Pages::findOrFail('3'); 

      return view('front.pages.privacy_policy',compact('page_info'));

    }
    public function faqs()
    {

      $page_info =Pages::findOrFail('4'); 

      return view('front.pages.faqs',compact('page_info'));

    }

}
