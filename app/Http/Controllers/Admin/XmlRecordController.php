<?php

namespace App\Http\Controllers\Admin;

use App\XmlGallery;
use DOMDocument;
use App\XmlRecord;
use Illuminate\Http\Request;

class XmlRecordController extends MainAdminController
{
    public function index(Request $req)
    {
        

        if($req->isMethod("POST")){

           
            $url = $req->file;
            // $xml = simplexml_load_file($url);
            $xml = simplexml_load_file($url, 'SimpleXMLElement', LIBXML_NOCDATA);
            $json = json_encode($xml);
            $phpDataArray = json_decode($json, true); 

        // echo "<pre>";
        // print_r($phpDataArray);
        // dd();
        // print_r($xml);


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
                        "city" => isset($data['city']) ? $data['city'] : null,
                        "community" => isset($data['community']) ? $data['community'] : null,
                        "sub_community" => isset($data['sub_community']) ? $data['sub_community'] : null,
                        "property_name" => isset($data['property_name']) ? $data['property_name'] : null,
                        "title_en" => isset($data['title_en']) ? $data['title_en'] : null,
                        "description_en" => isset($data['description_en']) ? $data['description_en'] : null,
                        "amenities" => isset($data['amenities']) ? $data['amenities'] : null,
                        "size" => isset($data['size']) ? $data['size'] : null,
                        "bedroom" => isset($data['bedroom']) ? $data['bedroom'] : null,
                        "bathroom" => isset($data['bathroom']) ? $data['bathroom'] : null,
                        "agent_name" => isset($data['agent']['name']) ? $data['agent']['name'] : null,
                        "agent_email" => isset($data['agent']['email']) ? $data['agent']['email'] : null,
                        "agent_phone" => isset($data['agent']['phone']) ? $data['agent']['phone'] : null,
                        "agent_photo" => isset($data['agent']['photo']) ? $data['agent']['photo'] : null,
                        "furnished" => isset($data['furnished']) ? $data['furnished'] : null,
                        // "gallery_id" => $data['gallery_id'],
                        "geopoints" => isset($data['geopoints']) ? $data['geopoints']: null
                    ];

                    // dd($data['reference_number']);
                    // dd($data['photo']['url']);
                    // dd();
                    foreach($data['photo']['url'] as $key => $gallery_data)
                    {
                        $gallery_image = new XmlGallery();

                        $gallery_image->gallery_images = $gallery_data;
                        $gallery_image->reference_number = $data['reference_number'];
                        $gallery_image->save();

                    }

                }

                XmlRecord::insert($dataArray);

                return back()->with('success','Data saved successfully!');
            }
        }

        return view("admin-dashboard.xml-records.index");
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
