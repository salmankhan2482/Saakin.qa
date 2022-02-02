<?php

namespace App\Http\Controllers;

use App\City;

use App\CityDetail;
use App\Properties;
use App\LandingPage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CityGuideController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function getCityList()
    {
        $cityGuides = City::where('status',1)->get();
        
        $landing_page_content= LandingPage::find('54');
        $page_des = $landing_page_content->page_content;
        $page_des = Str::limit($page_des, 170, '...');

        return view('front.pages.city_guide',compact('cityGuides','landing_page_content','page_des'));
    }

    public function getCityDetail($slug)
    {
        $cityGuide = City::where('city_slug',$slug)->where('status',1)->first();
        $cityGuideDetails = CityDetail::where('city_id', $cityGuide->id)->where('status',1)->get();
        $cityGuideContent = CityDetail::where('city_id', $cityGuide->id)->where('status',1)->first();
        
        
        $propertiesForRent = Properties::where('address_slug', 'like', '%'.$cityGuide->city_slug.'%')
        ->where('property_purpose', 'Rent')->get();
        
        $propertiesForSale = Properties::where('address_slug', 'like', '%'.$cityGuide->city_slug.'%')
        ->where('property_purpose', 'Sale')->get();
        
        return view('front.pages.city_guide_detail',compact('cityGuide','cityGuideDetails','propertiesForRent', 'propertiesForSale','cityGuideContent'));
    }

}
