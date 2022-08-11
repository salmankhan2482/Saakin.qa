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
      $this->middleware('permission:property-amenity-list', ['only' => ['index']]);
      $this->middleware('permission:property-amenity-create', ['only' => ['create','store']]);
      $this->middleware('permission:property-amenity-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:property-amenity-delete', ['only' => ['destroy']]);
   }
   
   public function index()
   {
      if(Auth::User()->usertype!="Admin"){
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('dashboard');
      }

      $data['propertyAmenities'] = PropertyAmenity::orderBy('id')->paginate(10);
      $action  = 'saakin_index';
      return view('admin-dashboard.property-amenities.index',compact('data','action'));
   }

   public function create(){
      if(Auth::User()->usertype!="Admin"){
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      $action = 'saakin_create';
      return view('admin-dashboard.property-amenities.create', compact('action'));
   }

   public function store(Request $request){
      
      $data =  \Request::except(array('_token')) ;
      $inputs = $request->all();
      $rule=array(
         'name' => 'required',
         'status' => 'required'
      );
      $validator = \Validator::make($data,$rule);

      if ($validator->fails()){
         return redirect()->back()->withErrors($validator->messages());
      }

      $propertyAmenity = new PropertyAmenity();
      $propertyAmenity->name = $inputs['name'];
      $propertyAmenity->status = $inputs['status'];
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

      $data['propertyAmenity'] = PropertyAmenity::findOrFail($id);
      $action = 'saakin_create';
      return view('admin-dashboard.property-amenities.edit',compact('data', 'action'));
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
      if ($validator->fails()){
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
