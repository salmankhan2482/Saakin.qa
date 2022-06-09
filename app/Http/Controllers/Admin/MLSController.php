<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MLSController extends Controller
{
    public function index()
    {

        if(Auth::User()->usertype!="Agency"){
            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }
        $action = 'saakin_index';
        return view('admin-dashboard.mls.index',compact('action'));
    }
}
