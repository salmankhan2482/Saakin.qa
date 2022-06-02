<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class MLSController extends Controller
{
    public function index()
    {
        $action = 'saakin_index';
        return view('admin-dashboard.mls.index',compact('action'));
    }
}
