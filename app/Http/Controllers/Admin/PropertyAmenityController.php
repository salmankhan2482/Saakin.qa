<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Properties;
use App\PropertyGallery;
use App\PropertyAmenity;
use Carbon\Carbon;
use App\Http\Requests;
use Session;
use Illuminate\Support\Str;

class PropertyAmenityController extends Controller
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

        $propertyAmenities = PropertyAmenity::orderBy('id')->get();
        return view('admin.pages.property_amenities',compact('propertyAmenities'));
    }

    public function create()    {

        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        return view('admin.pages.add_property_amenity');
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

        $propertyAmenity = new PropertyAmenity();

        //$slug  = Str::slug($inputs['property_type'], "-");

        $propertyAmenity->name = $inputs['name'];
        $propertyAmenity->status = $inputs['status'];

        //$propertyAmenity->slug = $slug;

        $propertyAmenity->save();

        \Session::flash('flash_message', trans('words.added'));
        return \Redirect::back();
    }

    public function edit($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $propertyAmenity = PropertyAmenity::findOrFail($id);
        return view('admin.pages.edit_property_amenity',compact('propertyAmenity'));
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

        $propertyAmenity = PropertyAmenity::findOrFail($id);
        $propertyAmenity->name = $inputs['name'];
        $propertyAmenity->status = $inputs['status'];

        $propertyAmenity->save();
        \Session::flash('flash_message', trans('words.updated'));
        return \Redirect::back();
    }

    public function destroy($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $propertyAmenity = PropertyAmenity::findOrFail($id);

        $propertyAmenity->delete();

        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();
    }
}
