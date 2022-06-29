<?php

namespace App\Http\Controllers;

use App\ClickCounters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\PropertySubCities;
use App\Types;
use Stevebauman\Location\Facades\Location;

class AjaxController extends Controller
{
    public function index() {
        $msg = "This is a simple message.";
        return response()->json(array('msg'=> $msg), 200);
    }

    public function callSubCity()
    {
        $store['latLong'] = '';
        $store['subcities'] = DB::table('property_sub_cities')->select('id','name', 'latitude', 'longitude')
            ->where('property_cities_id',request()->id)->get();

        if($store['subcities']->isEmpty()){
            $store['subcities'] = '<option value="">No Result Found</option>';
            $store['towns'] = '<option value="">No Result Found</option>';
            $store['areas'] = '<option value="">No Result Found</option>';

        }else{
            
            $store['towns'] = DB::table('property_towns')
            ->select('id','name', 'latitude', 'longitude')
            ->where('property_sub_cities_id', $store['subcities'][0]->id)->get();
            
            if ($store['towns']->isEmpty()) {
                $store['towns'] = '<option value="">No Result Found</option>';
                $store['areas'] = '<option value="">No Result Found</option>';

            } else {
                $store['areas'] = DB::table('property_areas')
                ->select('id','name', 'latitude', 'longitude')
                ->where('property_towns_id', $store['towns'][0]->id)->get();
                
                if ($store['areas']->isEmpty()) {
                    $store['areas'] = '<option value="">No Result Found</option>';
                }

            }
        
        }
        return $store;
    }

    public function callTown()
    {
        $store['towns'] = DB::table('property_towns')
            ->select('id','name', 'latitude', 'longitude')
            ->where('property_sub_cities_id',request()->id)->get();
        
            if ($store['towns']->isEmpty()) {
                $store['towns'] = '<option value="">No Result Found</option>';
                $store['areas'] = '<option value="">No Result Found</option>';

            } else {
                $store['areas'] = DB::table('property_areas')
                ->select('id','name', 'latitude', 'longitude')
                ->where('property_towns_id',$store['towns'][0]->id)->get();

                if ($store['areas']->isEmpty()) {
                    $store['areas'] = '<option value="">No Result Found</option>';
                }
            }

            $store['subcities'] = DB::table('property_sub_cities')
            ->select('id','name', 'latitude', 'longitude')
            ->where('id', request()->id)
            ->get();

            return $store;
    }

    public function callArea()
    {
        if(request('id') == null){
            
            $store['subcities'] = DB::table('property_sub_cities')
            ->select('property_cities_id', 'latitude', 'longitude')
            ->where('id', request()->pre)
            ->first();

            $store['areas'] ='<option value="">No Result Found</option>';
            $store['towns'] ='<option value="">No Result Found</option>';
            return $store;

        }else{
            $store['areas'] = DB::table('property_areas')
                ->select('id','name', 'latitude', 'longitude')
                ->where('property_towns_id', request()->id)->get();
        
            if ($store['areas']->isEmpty()) {
                $store['areas'] = '<option value="">No Result Found</option>';
            }

            $store['towns'] = DB::table('property_towns')
                ->select('id','name', 'property_sub_cities_id', 'latitude', 'longitude')
                ->where('id', request()->id)->get();


            $store['subcities'] = DB::table('property_sub_cities')
                ->select('id','name', 'latitude', 'longitude')
                ->where('id',$store['towns'][0]->property_sub_cities_id)
                ->get();

            return $store;
        }
        
    }

    public function callLatLong()
    {
        if(request()->id == null){
            $store['latLong'] = DB::table('property_towns')
            ->select('property_sub_cities_id', 'latitude', 'longitude')
            ->where('id', request()->pre)
            ->first();

            $store['towns'] = '<option value="">No Result Found</option>';
            $store['subcities'] = '<option value="">No Result Found</option>';
            
            return $store;

        }else{
            $store['latLong'] = DB::table('property_areas')
                ->select('property_towns_id','latitude','longitude')
                ->where('id',request()->id)->first();

            $store['towns'] = DB::table('property_towns')
            ->select('property_sub_cities_id', 'latitude', 'longitude')
            ->where('id', $store['latLong']->property_towns_id)
            ->first();


            $store['subcities'] = DB::table('property_sub_cities')
            ->select('latitude', 'longitude')
            ->where('id', $store['towns']->property_sub_cities_id)
            ->first();
            return $store;
        
        }
        
    }

    public function callSubCities()
    {
        $store['subcities'] = DB::table('property_sub_cities')
            ->select('id','name')
            ->where('property_cities_id',request()->id)
            ->get();

        return $store;
    }

    function clickCount(){
        $ip = request()->ip();
        $property_id = request()->id;
        $button_name = request()->button_name;
        $position = Location::get('https://'.$ip);
        $data = ClickCounters::where('ip_address', $ip)
        ->where('property_id', $property_id)
        ->where('button_name', $button_name)->first();

        if($data){
            return '';
        }else{
            $obj = new ClickCounters();
            $obj->ip_address = $ip;
            $obj->property_id = $property_id;
            $obj->agency_id = request()->agency_id;
            $obj->button_name = $button_name;
            $obj->country = $position->countryName;
            $obj->city = $position->cityName;
            $obj->region = $position->regionName;
            $obj->latitude = $position->latitude;
            $obj->longitude = $position->longitude;
            $obj->save();
            return 'Counted';
        }
        
    }

    public function commercialPropertyTypes()
    {
        $result = '';
        if(request('myData')){
            $result = '<option value="">Property Type</option>';
            $types = Types::whereIn('id', ['14', '17', '23', '27', '4', '13', '7', '34', '16', '35'])->select('id', 'types')->get();
            
            foreach($types as $type){
                $result .= '<option value='.$type->id.'>'.$type->types.'</option>';
            }
        }else{
            $result = '<option value="">Property Type</option>';
            $types = Types::select('id', 'types')->get();
            
            foreach($types as $type){
                $result .= '<option value='.$type->id.'>'.$type->types.'</option>';
            }

        }
        return $result;
    }

    public function getSubcity(Request $request)
    {
        $cid = $request->post('cid');
        $subcity = DB::table("property_sub_cities")
        ->where("property_cities_id",$cid)
        ->get();
        $html= '<option value="">Select Sub-City</option>';
        foreach($subcity as $list){
            $html.='<option value="'.$list->id.'">'.$list->name.'</option>';
        }
        echo $html;
    }
    public function getTown(Request $request)
    {
        $sid = $request->post('sid');
        $town = DB::table("property_towns")
        ->where("property_sub_cities_id",$sid)
        ->get();
        $html= '<option value="">Select Town</option>';
        foreach($town as $list){
            $html.='<option value="'.$list->id.'">'.$list->name.'</option>';
        }
        echo $html;
    }

    public function getArea(Request $request)
    {
        $tid = $request->post('tid');
        $area = DB::table("property_areas")
        ->where("property_towns_id",$tid)
        ->get();
        $html= '<option value="">Select Area</option>';
        foreach($area as $list){
            $html.='<option value="'.$list->id.'">'.$list->name.'</option>';
        }
        echo $html;
    }
}
