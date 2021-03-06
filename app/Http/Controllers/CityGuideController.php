<?php

namespace App\Http\Controllers;

use App\City;

use App\Pages;
use App\CityDetail;
use App\Properties;
use App\LandingPage;
use App\PropertyAreas;
use App\PropertyTowns;
use App\PropertyCities;
use App\PropertySubCities;
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
        $cityGuides = City::where('status',1)->orderBy('sequence_id', 'asc')->get();
        
        $landing_page_content= Pages::find('7');
        $page_des = $landing_page_content->page_content;
        $page_des = Str::limit($page_des, 170, '...');

        return view('front.pages.city_guide',compact('cityGuides','landing_page_content','page_des'));
    }

    public function getCityDetail($slug)
    {
        
        $cityGuide = City::where('city_slug',$slug)->where('status',1)->first();
        
        $city_guide_description = Str::of($cityGuide->long_description)->limit(154) ;
        $city_guide_description = strip_tags($city_guide_description);
        
        
        $cityGuideContent = CityDetail::where('city_id', $cityGuide->id)->where('status',1)->first();
        
        $propertiesForRent = Properties::where('address_slug', 'like', '%'.$cityGuide->city_slug.'%')
        ->where('property_purpose', 'Rent')->where('status', 1)->limit(6)->get();
        
        $propertiesForSale = Properties::where('address_slug', 'like', '%'.$cityGuide->city_slug.'%')
        ->where('property_purpose', 'Sale')->where('status', 1)->limit(6)->get();
        
        $url = '';
        if($city = PropertyCities::where('name', $cityGuide->name)->value('id')){
            $url = '?city='.$city;
        }elseif($subcity = PropertySubCities::where('name', $cityGuide->name)->value('id')){
            $url = '?subcity='.$subcity;
        }elseif($town = PropertyTowns::where('name', $cityGuide->name)->value('id')){
            $url = '?town='.$town;
        }elseif($area = PropertyAreas::where('name', $cityGuide->name)->value('id')){
            $url = '?area='.$area;
        }else{
            $url = '?property_purpose=Rent';
        }

        return view('front.pages.city_guide_detail',compact('cityGuide','propertiesForRent','city_guide_description', 'propertiesForSale','cityGuideContent','url'));
    }

}
