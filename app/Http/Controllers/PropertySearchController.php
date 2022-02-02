<?php

namespace App\Http\Controllers;

use App\Types;
use App\Properties;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertySearchController extends Controller
{
    

    public function PropertiesForPurpose($buyOrRent, $purpose)
    {
        $propertyTypes = DB::table('property_types')
        ->leftJoin('properties', 'property_types.id', 'properties.property_type')
        ->select('property_types.*', DB::Raw('COUNT(properties.property_type) as pcount'))
        ->where('properties.status', 1)
        ->where('property_purpose', ucfirst($purpose))
        ->groupBy('property_types.types')
        ->orderBy('pcount', 'DESC')
        ->get();

        return view('front.pages.properties-search.propertiesForPurpose', compact('buyOrRent', 'propertyTypes','purpose'));
    }

    public function typeForPurpose($buyOrRent, $typePurpose)
    {
        if(request()->filled('buyOrRent') && request()->filled('property')){
            $buyOrRent = request('buyOrRent');
            $property_type = explode('-for-', request('property'))[0];
            $purpose = explode('-for-', request('property'))[1];
        }else{
            $buyOrRent = $buyOrRent;
            $property_type = explode('-for-', $typePurpose)[0];
            $purpose = explode('-for-', $typePurpose)[1];
        }

        $type = Types::where('slug', $property_type)->firstOrFail();
        $properties = Properties::where('status', 1)->where('property_purpose', ucfirst($purpose))->where('property_type', $type->id);
        
       

        $cities = Properties::select("address", "id")
            ->where('status', 1)
            ->where('property_purpose', ucfirst($purpose))
            ->where('property_type', $type->id)
            ->groupBy('address')->orderBy("address", "asc")->get();

        return view('front.pages.properties-search.propertiesForCity', 
        compact('properties', 'cities', 'buyOrRent', 'purpose', 'type'));

    }


    
}
