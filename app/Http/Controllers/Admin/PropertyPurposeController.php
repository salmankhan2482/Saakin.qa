<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\PropertyPurpose;

class PropertyPurposeController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
      $this->middleware('permission:properties-purpose-list', ['only' => ['index']]);
      $this->middleware('permission:properties-purpose-create', ['only' => ['create','store']]);
      $this->middleware('permission:properties-purpose-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:properties-purpose-delete', ['only' => ['destroy']]);
   }

   public function index()
   {
      if(Auth::User()->usertype!="Admin"){
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('dashboard');
      }

      $data['propertyPurposes'] = PropertyPurpose::orderBy('id')->get();
      $action = 'saakin_index';
      return view('admin-dashboard.property-purpose.index',compact('data','action'));
   }

   public function create()    {

      if(Auth::User()->usertype!="Admin"){
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      $action = 'saakin_create';
      return view('admin-dashboard.property-purpose.create',compact('action'));
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
      if ($validator->fails()){
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

      $data['propertyPurpose'] = PropertyPurpose::findOrFail($id);
      $action = 'saakin_create';
      return view('admin-dashboard.property-purpose.edit',compact('data', 'action'));
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
