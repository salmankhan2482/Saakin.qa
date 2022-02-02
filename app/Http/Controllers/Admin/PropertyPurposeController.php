<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Properties;
use App\PropertyGallery;
use App\PropertyPurpose;
use Carbon\Carbon;
use App\Http\Requests;
use Session;
use Illuminate\Support\Str;

class PropertyPurposeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }

        $propertyPurposes = PropertyPurpose::orderBy('id')->get();

        //dd($propertyPurposes);

        return view('admin.pages.property_purposes',compact('propertyPurposes'));
    }

    public function create()    {

        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        return view('admin.pages.add_property_purpose');
    }

    public function store(Request $request)
    {
        $data =  \Request::except(array('_token')) ;
        $inputs = $request->all();
        $rule=array(
            'name' => 'required',
            'status' => 'required'
        );
        $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }
        $propertyPurpose = new PropertyPurpose();
        $propertyPurpose->name = $inputs['name'];
        $propertyPurpose->status = $inputs['status'];
        $propertyPurpose->save();
        \Session::flash('flash_message', trans('words.added'));
        return \Redirect::back();
    }

    public function edit($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $propertyPurpose = PropertyPurpose::findOrFail($id);
        return view('admin.pages.edit_property_purpose',compact('propertyPurpose'));
    }

    public function update(Request $request, $id)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'name' => 'required',
            'status' => 'required'
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $propertyPurpose = PropertyPurpose::findOrFail($id);
        $propertyPurpose->name = $inputs['name'];
        $propertyPurpose->status = $inputs['status'];

        $propertyPurpose->save();
        \Session::flash('flash_message', trans('words.updated'));
        return \Redirect::back();
    }

    public function destroy($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $propertyPurpose = PropertyPurpose::findOrFail($id);

        $propertyPurpose->delete();

        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();
    }
}
