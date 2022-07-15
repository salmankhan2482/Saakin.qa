<?php

namespace App\Http\Controllers\Admin;

use DOMDocument;
use App\XmlRecord;
use Illuminate\Http\Request;

class XmlRecordController extends MainAdminController
{
    public function index(Request $req)
    {
        // dd($req->file);

        
    
        // echo "<pre>";
        // print_r($phpDataArray);
        // print_r($xml);

        if($req->isMethod("POST")){

            // $xmlDataString = file_get_contents(public_path('upload/xml/sample-course.xml'));
            // $xmlObject = simplexml_load_string($xmlDataString);
                    
            // $json = json_encode($xmlObject);
            // $phpDataArray = json_decode($json, true); 


//             $url = $req->file;
//             $doc = new DOMDocument();
//             $doc->load($url);
//             $cities = $doc->getElementsByTagName("City");
//             foreach ($cities as $city) {
//                 foreach($city->childNodes as $child) {
//                     if ($child->nodeType == XML_CDATA_SECTION_NODE) {
//                          print_r($child->textContent);
//                     }
//                 }
//             }

// dd();




            $url = $req->file;
            $xml = simplexml_load_file($url);
            $json = json_encode($xml);
            $phpDataArray = json_decode($json, true); 
            // $xml_file_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA),true), true);

            // echo "<pre>";
            // print_r($phpDataArray['property']);

            if(count($phpDataArray['property']) > 0){

                $dataArray = array();
                
                foreach($phpDataArray['property'] as $index => $data){

                    $dataArray[] = [
                        "reference_number" => $data['reference_number'],
                        "offering_type" => $data['offering_type'],
                        "property_type" => $data['property_type'],
                        "price_on_application" => $data['price_on_application'],
                        "price" => $data['price'],
                        "rental_period" => isset($data['rental_period']) ? $data['rental_period'] : null,
                        "cheques" => isset($data['cheques']) ? $data['cheques'] : null,
                        // "city" => json_decode(json_encode(simplexml_load_string($data['city'], 'SimpleXMLElement', LIBXML_NOCDATA),true), true),
                       
                        // "city" => isset($data['city']) ? $data['city'] : null,
                        // "community" => isset($data['community']) ? $data['community'] : null,
                        // "sub_community" => $data['sub_community'],
                        // "property_name" => $data['property_name'],
                        // "title_en" => $data['title_en'],
                        // "description_en" => $data['description_en'],
                        "amenities" => isset($data['amenities']) ? $data['amenities'] : null,
                        "size" => isset($data['size']) ? $data['size'] : null,
                        "bedroom" => isset($data['bedroom']) ? $data['bedroom'] : null,
                        "bathroom" => isset($data['bathroom']) ? $data['bathroom'] : null,
                        // "name" => isset($data['name']) ? $data['name'] : null,
                        // "email" => isset($data['email']) ? $data['email'] : null,
                        // "phone" => isset($data['phone']) ? $data['phone'] : null,
                        // "photo" => isset($data['photo']) ? $data['photo'] : null,
                        "furnished" => isset($data['furnished']) ? $data['furnished'] : null,
                        // "gallery_id" => $data['gallery_id'],
                        "geopoints" => isset($data['geopoints']) ? $data['geopoints']: null
                    ];
                        
                }

                XmlRecord::insert($dataArray);

                return back()->with('success','Data saved successfully!');
            }
        }

        return view("admin-dashboard.xml-records.index");
    }
    public function show($id)
    {
        $xml_record = XmlRecord::where('id', $id)->first();

        return ('upload/xml/sa');
    }
   
}
