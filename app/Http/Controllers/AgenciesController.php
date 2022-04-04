<?php

namespace App\Http\Controllers;

use App\Http;
use App\User;
use App\Types;
use App\Agency;
use App\Enquire;
use http\Client;
use App\XmlRecord;
use App\Properties;
use App\LandingPage;

use SimpleXMLElement;
use App\Http\Requests;
use Geocoder\Geocoder;
use App\PropertyAmenity;
use App\PropertyGallery;
use App\Mail\Agent_Inquiry;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\PropertyNeighborhood;
use App\Http\Controllers\Auth;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Contracts\Encryption\DecryptException;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Validator;

class AgenciesController extends Controller
{
    public function __construct()
    {
    }

    public function UR_exists($filename){

        dd("file_headers");
        $file_headers = @get_headers($filename);
        if($file_headers[0] == 'HTTP/1.0 404 Not Found'){
            echo "The file $filename does not exist";
        } else if ($file_headers[0] == 'HTTP/1.0 302 Found' && $file_headers[7] == 'HTTP/1.0 404 Not Found'){
            echo "The file $filename does not exist, and I got redirected to a custom 404 page..";
        } else {
            echo "The file $filename exists";
        }
    }

    public function index(Request $request)
    {
        if($request->get('sortSelect') == 'sortByName'){
            $agencies = Agency::where('status', 1)->orderBy('name', 'asc')->paginate(12);
        }else{
        $agencies =  DB::table('agencies')
            ->leftJoin('properties', 'agencies.id', 'properties.agency_id')
            ->select('agencies.*', DB::Raw( 'COUNT(properties.agency_id) as pcount' ))
            ->groupBy('agencies.name')
            ->orderBy('pcount', 'DESC')
            ->paginate(12);
        }

        $landing_page_content= LandingPage::find('55');
        $page_des = strip_tags($landing_page_content->page_content);
        $page_des = Str::limit($page_des, 170, '...');

        return view('front.pages.agencies', compact('agencies','landing_page_content','page_des'));
    }

    public function agencyDetail($name, $id)
    {
        $agency = Agency::find($id);
        $user = User::where("agency_id",$agency->id)->where("usertype","Agency")->first();
            
            $properties = Properties::where('status', '1')
            ->where('agency_id', $id)
            ->when(request('sortSelect') == 'Sale' || request('sortSelect') == 'Rent', function($query){
                $query->where('property_purpose', request('sortSelect'));
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        $propertyTypes = DB::select("SELECT property_types.id, COUNT(properties.id) AS property_count, property_types.types as property_type FROM properties JOIN property_types ON (properties.property_type=property_types.id) WHERE properties.status='1' AND agency_id='".$agency->id."' GROUP BY property_types.id ORDER BY property_count DESC");

        $agency_des = Str::limit(strip_tags($agency->agency_detail), 170, '...');
        return view('front.pages.agency', compact('agency', 'properties', 'propertyTypes','user','agency_des'));
    }

    public function searchAgencies(Request $request)
    {

        $inputs = $request->all();
        $keyword = $inputs['keyword'];

        $agencies = Agency::where('status', 1)->
        where(function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('agency_detail', 'like', '%' . $keyword . '%');
        })->paginate(15);

        $landing_page_content= LandingPage::find('55');
        $page_des = strip_tags($landing_page_content->page_content);
        $page_des = Str::limit($page_des, 170, '...');
        
        return view('front.pages.agencies', compact('agencies','landing_page_content','page_des'));
    }

    public function agency_email(Request $request)
    {

      
        $data =  \Request::except(array('_token')) ;  
              
        $inputs = $request->all();
	    $rule=array(
            'name' => 'required',
            'email' => 'required|email',
            'your_message' => 'required'
        );

	   	$validator = Validator::make($data,$rule);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }
    
        $enquire = new Enquire();
        $enquire->agency_id = $inputs['agency_id'];
        $enquire->enquire_id = 2;
        $enquire->type = $inputs['type'];
        $enquire->name = $inputs['name'];
        $enquire->email = $inputs['email'];
        $enquire->phone = $inputs['phone'];
        $enquire->subject = $inputs['subject'];
        $enquire->message = $inputs['your_message'];
        $enquire->save();

        $data_email ['name'] = $inputs['name'];
        $data_email['email'] = $inputs['email'];
        $data_email['phone'] = $inputs['phone'];
        $data_email['subject'] = $inputs['subject'];
        $data_email['your_message'] = $inputs['your_message'];
        $data_email['agency_id'] = $inputs['agency_id'];
        $data_email['agency_name'] = $inputs['agency_name'];

        Mail::to('hello@saakin.qa')->send(new Agent_Inquiry($data_email));
        
        \Session::flash('flash_message_contact_agency', trans('words.thanks_for_contacting_us'));

        return \Redirect::back();
    }
    public function partition( $list, $p ) {
        $listlen = count( $list );
        $partlen = floor( $listlen / $p );
        $partrem = $listlen % $p;
        $partition = array();
        $mark = 0;
        for ($px = 0; $px < $p; $px++) {
            $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
            $partition[$px] = array_slice( $list, $mark, $incr );
            $mark += $incr;
        }
        return $partition;
    }

    public function getProperties(Request $request)
    {
        $user_id = $request->user;

        $property_type = $request->property_type;
        $agency_id = $request->agency_id;
        $accesscode = '3A28C51415';
        $groupcode = 1575;

        $response = "";
        if ($property_type == "RentListings") {

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.gomasterkey.com/v1.2/website.asmx",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">\r\n  <soap:Body>\r\n    <RentListings xmlns=\"http://api.gomasterkey.com/\">\r\n      <AccessCode>$accesscode</AccessCode>\r\n      <GroupCode>$groupcode</GroupCode>\r\n      <PropertyType></PropertyType>\r\n      <Bedrooms></Bedrooms>\r\n      <StartPriceRange></StartPriceRange>\r\n      <EndPriceRange></EndPriceRange>\r\n      <categoryID></categoryID>\r\n      <CountryID></CountryID>\r\n      <StateID></StateID>\r\n      <CommunityID></CommunityID>\r\n      <FloorAreaMin></FloorAreaMin>\r\n      <FloorAreaMax></FloorAreaMax>\r\n      <UnitCategory></UnitCategory>\r\n      <UnitID></UnitID>\r\n      <BedroomsMax></BedroomsMax>\r\n      <PropertyID></PropertyID>\r\n      <ReadyNow></ReadyNow>\r\n      <PageIndex>1</PageIndex>\r\n    </RentListings>\r\n  </soap:Body>\r\n</soap:Envelope>",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: text/xml"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

        } elseif ($property_type == "SalesListings") {


            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.gomasterkey.com/v1.2/website.asmx",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">\r\n  <soap:Body>\r\n    <SalesListings xmlns=\"http://api.gomasterkey.com/\">\r\n      <AccessCode>$accesscode</AccessCode>\r\n      <GroupCode>$groupcode</GroupCode>\r\n      <PropertyType></PropertyType>\r\n      <Bedrooms></Bedrooms>\r\n      <StartPriceRange></StartPriceRange>\r\n      <EndPriceRange></EndPriceRange>\r\n      <categoryID></categoryID>\r\n      <CountryID></CountryID>\r\n      <StateID></StateID>\r\n      <CommunityID></CommunityID>\r\n      <FloorAreaMin></FloorAreaMin>\r\n      <FloorAreaMax></FloorAreaMax>\r\n      <UnitCategory></UnitCategory>\r\n      <UnitID></UnitID>\r\n      <BedroomsMax></BedroomsMax>\r\n      <PropertyID></PropertyID>\r\n      <ReadyNow></ReadyNow>\r\n      <PageIndex></PageIndex>\r\n    </SalesListings>\r\n  </soap:Body>\r\n</soap:Envelope>",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: text/xml"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);


        }
        $string = str_replace('<?xml version="1.0" encoding="utf-8"?>', "", $response);
        $string = str_replace('<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">', "", $string);
        $string = str_replace('<soap:Body>', "", $string);
        $string = str_replace('</soap:Body>', "", $string);
        $string = str_replace('</soap:Envelope>', "", $string);


        if ( strstr( $string, 'soap:Server' ) ) {
            return response()->json(['status' =>'error', 'message'=> 'Sorry! Please Verify Your Credtionals is valid']);
        }else {
            $file = time() . rand() . '_file.xml';
            $destinationPath = public_path() . "/upload/xml/";
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            File::put($destinationPath . $file, $string);
            $xml = new XmlRecord();
            $xml->type = $property_type;
            $xml->file = $file;
            $xml->user_id = $user_id;
            $xml->agency_id = $agency_id;
            $xml->access_code = $accesscode;
            $xml->group_code = $groupcode;
            $xml->save();
            $total_chunks=$this->uploadPropertiesInChunks($xml->id,0);
        }

        return response()->json(['total_chunks'=>$total_chunks,'xml_file_id'=>$xml->id]);

    }
    public function goMasterimport(){
        $agency =  Agency::find(\request()->id);
        if($agency){
            $html = view('admin.pages.goimport',compact('agency'))->render();
            return response()->json(['status' =>'success', 'html'=> $html]);
        }
    }
    public function uploadPropertiesInChunks($xml_record_id,$chunk_id){

        $file = XmlRecord::find($xml_record_id);
        $property_type = $file->type;
        $user_id = $file->user_id;
        $agency_id = $file->agency_id;
        $url = public_path() . "/upload/xml/" . $file->file;
        if (file_exists($url)) {
            $xmlString = file_get_contents($url);
            $string = str_replace('<?xml version="1.0" encoding="utf-8"?>', "", $xmlString);
            $document = simplexml_load_string($string);
            $document = json_decode(json_encode($document), true);
            if($property_type == 'RentListings') {
                $data = $document['RentListingsResult']['ArrayOfUnitDTO']['UnitDTO'];
            }elseif($property_type == 'SalesListings') {
                $data = $document['SalesListingsResult']['ArrayOfUnitDTO']['UnitDTO'];
            }
            if(count($data)>0){
                if(isset($data[$chunk_id])) {
                    $property = $data[$chunk_id];
                    $old_property = Properties::where('go_property_id', $property['PropertyID'])->first();
                    if ($old_property == null) {
                        $new_property = new Properties();
                        $new_property->go_property_id = isset($property['PropertyID']) ? ($property['PropertyID']) : '';
                        $new_property->property_name = isset($property['PropertyName']) ? ($property['PropertyName']) : '';
                        $property_slug = Str::slug(isset($property['PropertyName']) ? ($property['PropertyName']) : '', "-");
                        $new_property->property_slug = $property_slug;
                        $category = isset($property['Category']) ? ($property['Category']) : '';
                        $category_type = Types::where('types', 'like', '%' . $category . '%')->first();
                        if ($category_type) {
                            $new_property->property_type = $category_type->id;
                        } else {
                            $new_property->property_type = 1;
                        }
                        $new_property->user_id = $user_id;
                        $new_property->agency_id = $agency_id;
                        $new_property->refference_code = isset($property['RefNo']) ? ($property['RefNo']) : '';
                        $new_property->build_area = isset($property['BuiltupArea']) ? ($property['BuiltupArea']) : '';
                        $new_property->land_area = isset($property['BuiltupArea']) ? ($property['BuiltupArea']) : '';
                        $new_property->bedrooms = isset($property['Bedrooms']) ? ($property['Bedrooms']) : '';
                        $new_property->rooms = isset($property['Bedrooms']) ? ($property['Bedrooms']) : '';
                        $new_property->bathrooms = isset($property['NoOfBathrooms']) ? ($property['NoOfBathrooms']) : '';
                        $new_property->description = isset($property['Remarks']) ? ($property['Remarks']) : '';
                        $subcommunity = isset($property['SubCommunity']) ? ($property['SubCommunity']) : '';
                        $community = isset($property['Community']) ? ($property['Community']) : '';
                        $cityname = isset($property['CityName']) ? ($property['CityName']) : '';
                        $state = isset($property['StateName']) ? ($property['StateName']) : '';
                        $country = isset($property['CountryName']) ? ($property['CountryName']) : '';

                        $new_property->address = $subcommunity .  ',' . $cityname . ','  . $country;

                        if ($property_type == 'RentListings') {
                            $new_property->price = isset($property['Rent']) ? ($property['Rent']) : '';
                            $new_property->property_purpose = "For Rent";

                        } else {
                            $new_property->price = isset($property['SellPrice']) ? ($property['SellPrice']) : '';
                            $new_property->property_purpose = "For Sale";
                        }

                        $row = isset($property['ProGooglecoordinates']) ? ($property['ProGooglecoordinates']) : '';
                        if ($row) {
                            $idsArr = explode(',', $row);
                            $new_property->map_latitude = $idsArr[0];
                            $new_property->map_longitude = $idsArr[1];
                        }
                        $new_property->status = 1;
                        $property_features = "";
                        $features = isset($property['FittingFixtures']['FittingFixture']) ? ($property['FittingFixtures']['FittingFixture']) : '';
                        if (is_array($features)) {
                            if (count($features) > 0) {
                                foreach ($features as $key => $feature) {
                                    try {
                                        $property_features .= $feature['ID'] . ',';
                                    } catch (\Throwable $e) {

                                    }
                                }
                            }
                        }

                        $new_property->property_features = $property_features;

                        $featured = isset($property['Images']['Image']) ? ($property['Images']['Image']) : '';
                        if (is_array($featured)) {
                            if (count($featured) > 0) {
                                try {
                                    $f_image_url = $featured[0]['ImageURL'];
                                    if (@fopen($f_image_url, 'r')) {

                                        $images_splits = explode('&', $f_image_url);
                                        $ffilename = basename($images_splits[0]);
                                        $ffilename = '_' . time() . '.' . $ffilename;
                                        Image::make($f_image_url)->save(public_path('upload/properties/' . $ffilename));
                                        $new_property->featured_image = $ffilename;




                                    }
                                } catch (\Throwable $e) {

                                }
                                if($new_property->featured_image){
                                    $new_property->Save();



                                foreach ($featured as $key => $pro_image) {
                                    try {
                                        if (@fopen($f_image_url, 'r')) {
                                            $image_url = $pro_image['ImageURL'];
                                            $images_splits = explode('&', $image_url);
                                            $filename = basename($images_splits[0]);
                                            $filename = '_' . time() . '.' . $filename;
                                            Image::make($image_url)->save(public_path('upload/gallery/' . $filename));
                                            $property_gallery = new PropertyGallery();
                                            $property_gallery->image_name = $filename;
                                            $property_gallery->property_id = $new_property->id;
                                            $property_gallery->save();
                                        }
                                    } catch (\Throwable $e) {

                                    }
                                }

                                }
                            }
                        }
                    }
                }
            }
            return count($data);
        }
    }
    public function getAgenciesChunks(Request $request){
        $xml_record_id=$request->xml_record_id;
        $chunk_id=$request->chunk_id;
        $total_chunks=$request->total_chunks;
        $chunk_id=$chunk_id+1;
        if($chunk_id>=$total_chunks){
            return response()->json(['status'=>'finished','message'=>'Your data has been successfully upload. Your Data Posted soon!']);
        }
        else{
            $this->uploadPropertiesInChunks($xml_record_id,$chunk_id);
            return response()->json(['next_chunk_id'=>$chunk_id]);
        }
    }
    public function autocomplteAgencies(Request $request)
    {
          $search = $request->get('term');

          $result = Agency::where('name', 'LIKE', '%'. $search. '%')->orWhere('agency_detail', 'like', '%' . $search . '%')->get();

          return response()->json($result);

    }
    public function livesearch(Request $request){

        $data = Agency::where("name","LIKE","%{$request->input('keyword')}%")
                ->orWhere("agency_detail","LIKE","%{$request->input('keyword')}%")
                ->get();

        $output = '<ul class="list-group desktop-search-li col-12"  >';;
        if ( count($data) > 0 ) {
            
            foreach ($data as $i => $row){
                if($i <= 10){
                $output .= '<li class="list-group-item select-agency"><input type="hidden" id="agency_id" name="agency_id" value="'.$row->id.'" ><img alt="'.$row->image.'" src="upload/agencies/'.$row->image .'" width="50px;"> '.$row->name.'</li>';
                }
            }
             
            }else {
                $output .= '<li class="list-group-item">'.'No results'.'</li></ul>';
            }
            return $output;
        // return response()->json($data);
    }
    
    public function mbllivesearch(Request $request){

        $data = Agency::where("name","LIKE","%{$request->input('keyword')}%")
                ->where("agency_detail","LIKE","%{$request->input('keyword')}%")
                ->get();
       
        $output =  '<ul class="list-group desktop-search-li" style="position: absolute; width: 85%;">';
        if ( count($data) > 0 ) {
            
            foreach ($data as $i => $row){
                if($i <= 10){
                $output .= '<li class="list-group-item select-agency"><input type="hidden" id="agency_id" name="agency_id" value="'.$row->id.'" ><img alt="'.$row->image.'" src="upload/agencies/'.$row->image .'" width="50px;"> '.$row->name.'</li>';
                }
            } 
        }else {
                $output .= '<li class="list-group-item">'.'No results'.'</li></ul>';
            }
            return $output;
    }

}
