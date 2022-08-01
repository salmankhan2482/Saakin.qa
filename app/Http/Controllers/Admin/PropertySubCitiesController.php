<?php

namespace App\Http\Controllers\Admin;

use App\PropertyCities;
use App\PropertySubCities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PropertySubCitiesController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
      $this->middleware('permission:properties-subcity-list', ['only' => ['index']]);
      $this->middleware('permission:properties-subcity-create', ['only' => ['create','store']]);
      $this->middleware('permission:properties-subcity-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:properties-subcity-delete', ['only' => ['destroy']]);
   }
   
   public function index()
   {
      $subCities = PropertySubCities::with(['city', 'towns'])
      ->when(request('name'), function($query){
         $query->where('name', 'like', '%'.request('name').'%');
      })->paginate(10);
      
      $action = 'saakin_index';
      return view('admin-dashboard.adress-management.subcity.index', compact('subCities','action'));
   }

   public function create()
   {
      $cities = PropertyCities::all();
      $action = 'saakin_create';
      return view('admin-dashboard.adress-management.subcity.create', compact('cities','action'));

   }

   public function store(Request $request)
   {
      $request->validate([
         'city' => 'required',
         'name' => 'required'
      ]);
      
      if(PropertySubCities::where('name', request('name'))->where('property_cities_id', request('city'))->first()){
         return redirect()->back()->withErrors(['msg' => 'Duplicate Record Cannot be Inserted.']);
      }

      $subcity = new PropertySubCities();
      $subcity->name =  request('name');
      $subcity->property_cities_id =  request('city');
      $subcity->slug =  Str::slug(request('name'));
      if(request('latitude') && request('longitude')){
         $subcity->latitude = request('latitude');
         $subcity->longitude = request('longitude');
      }
      $subcity->save();

      Session::flash('message', 'Sub City has been added.'); 
      return redirect()->back();
   }

   public function show(PropertySubCities $propertySubCities)
   {
      //
   }

   public function edit($id)
   {
      $subCity = PropertySubCities::find($id);
      $cities = PropertyCities::all();
      $action = 'saakin_edit';

      return view('admin-dashboard.adress-management.subcity.edit', compact('subCity','cities','action'));
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'city' => 'required',
         'name' => 'required'
      ]);
      

      $subcity = PropertySubCities::where('id', $id)->first();
      $subcity->name =  request('name');
      $subcity->property_cities_id =  request('city');
      $subcity->slug =  Str::slug(request('name'));
         $subcity->latitude = request('latitude');
         $subcity->longitude = request('longitude');
      $subcity->update();

      Session::flash('message', 'Sub City has been updated.'); 
      return redirect()->back();
   }

   public function destroy($id)
   {
      $subCity = PropertySubCities::find($id);
      foreach($subCity->towns as $town){
               
         foreach($town->areas as $area){
               $area->delete();
               // deleting the areas of the town of subcity
         }

         $town->delete();
         // deleting the towns of the subcity

      }

      $subCity->delete();
   
      Session::flash('message', 'Sub City has been deleted.'); 
      return redirect()->back();
   }
}
