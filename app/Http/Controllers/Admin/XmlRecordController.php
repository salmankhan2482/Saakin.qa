<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Types;
use App\Agency;
use DOMDocument;
use App\XmlRecord;
use App\Properties;
use App\XmlGallery;
use App\PropertyAreas;
use App\PropertyTowns;
use App\PropertyCities;
use App\PropertyGallery;
use App\PropertyPurpose;
use App\PropertySubCities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class XmlRecordController extends MainAdminController
{
    public function index(Request $req)
    {
        if($req->isMethod("POST")){   
            $url = $req->file;
            $xml = simplexml_load_file($url, 'SimpleXMLElement', LIBXML_NOCDATA);
            $json = json_encode($xml);
            $phpDataArray = json_decode($json, true); 

        // echo "<pre>";
        // print_r($phpDataArray);
        // dd();
        // print_r($xml);


        if (Auth::user()->usertype == 'Agency')
                        {
                            $agency_id = Auth::user()->agency_id;
                            $user_id = Auth::user()->id;
                        }
                        elseif(Auth::user()->usertype == 'Agent')
                        {
                            $agent_id = Auth::user()->agent_id;
                            $user_id = Auth::user()->id;
                        }
                        elseif(Auth::user()->usertype == 'Admin')
                        {
                            $agency_id = $req->agency;
                            $agent_id = $req->agent;
                            $user_id = Auth::user()->id;
                        }
                        else
                        {
                            Session::flash('flash_message', trans('words.access_denied'));
                            return redirect('/');
                        }





            if(count($phpDataArray['property']) > 0)
            {

                $dataArray = array(); 
                
                //-----------------Loop to store properties one by one -------------------------
                foreach($phpDataArray['property'] as $index => $data)
                {
                    
                    $property_id = Properties::where('refference_code', $data['reference_number'])->value('id');
                    $is_new_property = 0;
                    $property_type="";
                    $propert_purpose="";
                    $city="";
                    $sub_city="";
                    $town="";
                    $area="";
                    $sub_city_slug=null;
                    $town_slug=null;
                    $area_slug=null;
                    $map_latitude = null;
                    $map_longitude =null ;
                    $property_slug=null;
                    if(empty($property_id))
                    {
                        $is_new_property = 1;
                    }
                    
                    // Get Propety Purpose
                    if($data['offering_type'] == 'RR' || $data['offering_type'] == 'CR')
                    {
                        $propert_purpose = 'Rent'; 
                    }
                    elseif($data['offering_type'] == 'RS' || $data['offering_type'] == 'CS')
                    {
                        $propert_purpose = 'Sale'; 
                    }
                    
                    
                    // Get Property Type
                    if(isset($data['property_type']))
                    {
                         $property_type = Types::where('abbrivation', $data['property_type'])->value('id');
                            // if(empty($data['prop_type']))
                            // {
                            //     $data['property_type'] = 'NA'; 
                            // }
                            // else
                            // {
                            //     $data['property_type'] = $data['prop_type']; 
                            // }
                    }
                    // else
                    // {
                    //         $data['property_type'] = null; 
                    // }

                         // Get City
                        if(!empty($data['city']))
                        {
                            $city = PropertyCities::where('name', $data['city'])->value('id');
                            if(empty( $city))
                            {
                                $data['cities'] = new PropertyCities();
                                $data['cities']->name = $data['city'];
                                $data['cities']->slug = Str::slug($data['city']);
                                $data['cities']->save();
                                $city= $data['cities']->id;
                            }
                            // elseif(!empty($data['cities']))
                            // {
                            //     $data['city'] = $data['cities']; 
                            // }
                        }
                        else
                        {
                            $data['city'] = Null; 
                        }


                            // Get Sub-City
                        if(!empty($data['community']))
                        {
                            
                            $sub_city = PropertySubCities::where('name',$data['community'])->value('id'); 
                           
                            if(empty($sub_city))
                            {
                                $data['sub_city'] =new PropertySubCities();
                                $data['sub_city']->name = $data['community'];
                                $data['sub_city']->slug = Str::slug($data['community']);
                                $data['sub_city']->property_cities_id = PropertyCities::where('name', $data['city'])->value('id');
                                $data['sub_city']->save();
                                $sub_city = $data['sub_city']->id;
                            }
                            // else
                            // {
                            //     $data['community'] = $data['sub_city']; 
                            // }
                        }
                        // else
                        // { 
                        //     $data['community'] = Null; 
                        // }

                             // Get Town
                        if(!empty($data['sub_community']))
                        {
                            $town= PropertyTowns::where('name', $data['sub_community'])->value('id'); 
                            if(empty($town))
                            {
                                $data['town'] = new PropertyTowns();
                                $data['town']->name = $data['sub_community'];
                                $data['town']->slug = Str::slug($data['sub_community']);
                                $data['town']->property_cities_id = PropertyCities::where('name', $data['city'])->value('id');
                                $data['town']->property_sub_cities_id = PropertySubCities::where('name', $data['community'])->value('id');
                                $data['town']->save();
                                $town = $data['town']->id;
                            }
                            // else
                            // {
                            //     $town = $data['town']; 
                            // }
                        } 
                        else
                        { 
                            $town = Null; 
                        }

                        // Get Area
                        if(!empty($data['property_name']))
                        {
                           $area = PropertyAreas::where('name', $data['property_name'])->value('id');
                            if(empty($data['area']))
                            {
                                $data['area'] = new PropertyAreas();
                                $data['area']->name = $data['property_name'];
                                $data['area']->slug = Str::slug($data['property_name']);
                                $data['area']->property_cities_id = PropertyCities::where('name', $data['city'])->value('id');
                                $data['area']->property_sub_cities_id = PropertySubCities::where('name', $data['community'])->value('id');
                                $data['area']->property_towns_id = PropertyTowns::where('name',$data['sub_community'])->value('id');
                                $data['area']->save();
                                $area = $data['area']->id;
                            }
                            elseif(!empty($data['area']))
                            {
                                $area = $data['area']; 
                            }
                        }
                        else  
                        { 
                            $area = Null; 
                        }


                        // Get Addrss
                    //  if (!empty($data['community'])) {
                    //     $subcity_name = PropertySubCities::where('name', $data['community'])->value('name');
                    //  } else {
                    //     $subcity_name = '';
                    //  }
               
                    //  if (!empty($data['sub_community'])) {
                    //     $town_name = PropertyTowns::where('name', $data['sub_community'])->value('name');
                    //  } else {
                    //     $town_name = '';
                    //  }

                    //  if (!empty($data['property_name'])) {
                    //     $area_name = PropertyAreas::where('name', $data['property_name'])->value('name');
                    //  } else {
                    //     $area_name = '';
                    //  }
                       
                    //------------------ Get Property slug, address slug , subcity slug & town slug --------------------------------
                    
                    

                    $address_without_slug = (isset($data['community']) ? $data['community'] : null ). ' ' . (isset($data['sub_community']) ? $data['sub_community']:null). ' ' . (isset($data['property_name']) ? $data['property_name']:null) ;
                     $address_slug = Str::slug($address_without_slug);

                     
                     $prop_purpose = PropertyPurpose::where('name', $data['offering_type'])->first();
                     $prop_type = Types::where('abbrivation', $data['property_type'])->first();
                     //--------------- if property type is not available in syatem then system should skip that property ------------
                     if(empty( $prop_type))
                     {
                        continue;

                     }
                     if ((isset($data['community'])?$data['community']:null)== (isset($data['sub_community'])?$data['sub_community']:null)) {
                        $property_slug = strtolower($prop_type->slug . '-for-' . $propert_purpose . '-' . Str::slug($data['city'] . '-' . (isset($data['community'])?$data['community']:null) . '-' . (isset($data['property_name'])?$data['property_name']:null)));
                     } else {
                        $property_slug = strtolower($prop_type->slug . '-for-' . $propert_purpose . '-' . Str::slug($data['city'] . '-' . (isset($data['community'])?$data['community']:null) . '-' . (isset($data['sub_community'])?$data['sub_community']:null ). '-' . (isset($data['property_name'])?$data['property_name']:null)));
                     }


                    if (!empty($data['community'])) {
                        $sub_city_slug = strtolower($prop_type->plural . '-for-' . $data['offering_type'] . '-' . Str::slug($data['community']));
                     }
                    
                     if (!empty($data['sub_community'])) {
                        $town_slug = strtolower($prop_type->plural . '-for-' . $data['offering_type']. '-' . Str::slug($data['community'] . '-' . $data['sub_community']));
                     }
                   
                     if (!empty($data['property_name'])) {
                        $area_slug = strtolower($prop_type->plural . '-for-' . $data['offering_type'] . '-' . Str::slug($data['community'] . '-' . $data['sub_community'] . '-' . $data['property_name']));
                     }

                    //------------ Get latitude & Longitude ---------------------------------
                    if(!empty($data['geopoints']))
                    {
                        $geopoints = explode(",",$data['geopoints']);
                        $map_latitude = $geopoints['0'];
                        $map_longitude = $geopoints['1'];
                    }
                    
                    
                

                        $dataArray = array(
                            "user_id" => isset($user_id) ? $user_id : null,
                            // Reference Code Perfectly Set
                            "refference_code" => isset($data['reference_number']) ? $data['reference_number'] : null,
                            "agent_id" => isset($agent_id) ? $agent_id : null,
                            "agency_id" => isset($agency_id) ? $agency_id : null,
                            "featured_property" => 0,
                            "property_name" => isset($data['title_en']) ? $data['title_en'] : null,
                            "whatsapp" => isset($data['agent']['phone']) ? $data['agent']['phone'] : null,
                            "agent_name" => isset($data['agent']['name']) ? $data['agent']['name'] : null,
                            "agent_picture" => isset($data['agent']['photo']) ? $data['agent']['photo'] : null,
                            "property_purpose" => isset($propert_purpose) ? $propert_purpose : null,
                            "price" => isset($data['price']) ? $data['price'] : null,
                            // Property Type Set (Remaining to Compare Property Type Abbrivations)
                            "property_type" =>  isset( $property_type) ?  $property_type : null,
                            "property_slug" => isset($property_slug) ? $property_slug : null,
                            "city" => isset($city) ? $city : null,
                            "subcity" => isset($sub_city) ? $sub_city : null,
                            "town" => isset($town) ? $town : null,
                            "area" => isset($area) ? $area : null,
                            "address" => isset($address_without_slug) ? $address_without_slug : null,
                            "address_slug" => isset($address_slug) ? $address_slug : null,
                            "sub_city_slug" => isset($sub_city_slug) ? $sub_city_slug : null,
                            "town_slug" => isset($town_slug) ? $town_slug : null,
                            "area_slug" => isset($area_slug) ? $area_slug : null,
                            "map_latitude" => isset($map_latitude) ? $map_latitude : null,
                            "map_longitude" => isset($map_longitude) ? $map_longitude : null,
                            "rental_period" => isset($data['rental_period']) ? $data['rental_period'] : null,
                            "description" => isset($data['description_en']) ? $data['description_en'] : null,
                            // Property Features Set (Remaining to Compare Abbrivations)
                            "property_features" => isset($data['amenities']) ? $data['amenities'] : null,
                            "land_area" => isset($data['size']) ? $data['size'] : null,
                            "bedrooms" => isset($data['bedroom']) ? $data['bedroom'] : null,
                            "bathrooms" => isset($data['bathroom']) ? $data['bathroom'] : null,
                            "featured_image" => isset($data['photo']['url']['0']) ? $data['photo']['url']['0'] : null,   
                            
                        );
                        // dd($dataArray);
                        Properties::updateOrcreate(['id' => $property_id], $dataArray);
                        unset($dataArray);
                        $id =Properties::where('refference_code', $data['reference_number'])->value('id');
                        // // $property = Properties::create($dataArray);
 
                        if($is_new_property == 0)
                        {
                            PropertyGallery::where('property_id', $id)->delete();
                        }
                        foreach($data['photo']['url'] as $key => $gallery_data)
                        {
                            $gallery_image = new PropertyGallery();

                            $gallery_image->property_id = $id;
                            $gallery_image->image_name = $gallery_data;
                        
                            $gallery_image->save();
                        }
                        // dd("Done");
                }
                return back()->with('success','Data saved successfully!');
            }
        }
        $action = 'saakin_create';
        $agencies = Agency::all();


        return view('admin-dashboard.xml-records.index',compact('action','agencies'));
    }
    public function show()
    {
        // $xml_record = XmlRecord::where('id', $id)->first();
        $content = simplexml_load_string(
            '<content><![CDATA[Hello, world!]]></content>'
        );
        echo (string) $content;

        return view('admin-dashboard.xml-records.show');
    }
   
}