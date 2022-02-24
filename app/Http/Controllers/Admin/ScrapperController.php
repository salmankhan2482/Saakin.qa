<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Dusterio\LinkPreview\Client;
use App\Agency;
use App\Properties;
use Illuminate\Support\Facades\Mail;

use App\User;
use Auth;
use Session;

class ScrapperController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $url = 'https://www.propertyfinder.qa/en/rent/apartment-for-rent-doha-the-pearl-viva-bahriyah-viva-west-341197.html';
        $previewClient = new Client($url);
        $previews = $previewClient->getPreviews();
        echo '<pre>';
        print_r($previews);
       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $response = curl_exec($ch);
        curl_close($ch);   
        $doc = new \DOMDocument();
        @$doc->loadHTML($response);     
        $allheadins = $doc->getElementsByTagName('h1');

       
        $dump['title'] = 'Amazing 2 Bed Apt. For Rent in Viva Bahriya';
        $dump['Property type'] = 'Apartment';
        $dump['Property size'] = '1,604 sqft / 149 sqm';
        $dump['Bedrooms'] = '2';
        $dump['Bathrooms'] = '3';
        $dump['Location'] = 'Viva West, Doha, The Pearl, Viva Bahriyah';
        print_r($dump);

        
        // dd($response);

       
        return view('admin.pages.scrapper',['response'=>$response]);
    }

    
}
