<?php

namespace App\Http\Controllers;

use App\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxDataTableController extends Controller
{
    public function getCustomers()
    {
        $query = Properties::all('id', 'address_slug', 'property_name', 'address');
        return datatables($query)->make(true);
    }
    function index()
    {
     $data = DB::table('properties')->paginate(15);
     return view('pagination', compact('data'));
    }

    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      $data = DB::table('properties')->paginate(15);
      return view('pagination_data', compact('data'))->render();
     }
    }
}
