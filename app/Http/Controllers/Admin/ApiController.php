<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Properties;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.pages.api_page');
    }

    public function getCategory(Request $request)
    {
        $api_link = $request->api_link;
        $access_code = $request->access_code;
        $group_code = $request->group_code;
        //dd($api_link);
        ///////////////////////////////////////////////////

        /*$curlUrl = $api_link.'/'.$access_code.'/'.$group_code;
        $link = str_replace(' ', '%20', $curlUrl);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        //$output = json_decode($output);

        print_r($output); die;*/
        ///////////////////////////////////////////////////

        $url = $api_link;
        $params = array(
            'AccessCode' => $access_code,
            'GroupCode' => $group_code
        );

        $postData = '';
        foreach($params as $k => $v) {
            $postData .= $k . '='.$v.'&';
        }
        $postData = rtrim($postData, '&');

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $output = curl_exec($ch);
        curl_close($ch);
        //$output = json_decode($output);

        print_r($output); die;
    }
}
