<?php

namespace App\Http\Controllers\Admin;

use App\PropertyTowns;
use App\PropertyCities;
use App\PropertySubCities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PropertyTownsController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
      $this->middleware('permission:town-list', ['only' => ['index']]);
      $this->middleware('permission:town-create', ['only' => ['create','store']]);
      $this->middleware('permission:town-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:town-delete', ['only' => ['destroy']]);
   }

   public function index()
   {
      $towns = PropertyTowns::with(['city', 'subcity'])
      ->when(request('name'), function($query){
         $query->where('name', 'like', '%'.request('name').'%');
      })
      ->paginate(10);
      $action = 'saakin_index';
      return view('admin-dashboard.adress-management.town.index', compact('towns','action'));
   }

   public function create()
   {
      $cities = PropertyCities::all();
      $subCities = PropertySubCities::all();
      $action = 'saakin_create';
      return view('admin-dashboard.adress-management.town.create', compact('cities','subCities','action'));
   }

   public function store(Request $request)
   {
      $request->validate([
         'city' => 'required',
         'subCity' => 'required',
         'name' => 'required'
      ]);
      
      if(PropertyTowns::where('name', request('name'))
         ->where('property_cities_id', request('city'))
         ->where('property_sub_cities_id',request('subCity') )
         ->first())
      {
         return redirect()->back()->withErrors(['msg' => 'Duplicate Record Cannot be Inserted.']);
      }

      
      $town  = new PropertyTowns();
      $town->name = request('name');
      $town->slug = Str::slug(request('name'));
      if(request('latitude') && request('longitude')){
         $town->latitude = request('latitude');
         $town->longitude = request('longitude');
      }
      $town->property_cities_id = request('city');
      $town->property_sub_cities_id = request('subCity');
      $town->save();
      Session::flash('message', 'Town has been added.'); 
      return redirect()->back();
   }

   public function show(PropertyTowns $propertyTowns)
   {
      //
   }

   public function edit($id)
   {
      $subCities = PropertySubCities::all();
      $cities = PropertyCities::all();
      $town = PropertyTowns::find($id);
      $action = 'saakin_edit';
      return view('admin-dashboard.adress-management.town.edit', compact('subCities','cities','town','action'));
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'city' => 'required',
         'subCity' => 'required',
         'name' => 'required'
      ]);
      
      $town = PropertyTowns::where('id', $id)->first();
      $town->name = request('name');
      $town->slug = Str::slug(request('name'));
      
         $town->latitude = request('latitude');
         $town->longitude = request('longitude');
      
      $town->property_cities_id = request('city');
      $town->property_sub_cities_id = request('subCity');
      $town->update();
      

      Session::flash('message', 'Town has been Updated.'); 
      return redirect()->back();
   }

   public function destroy($id)
   {
      $town = PropertyTowns::find($id);
      foreach($town->areas as $area){
         $area->delete();
         // deleting the areas of the town of subcity
      }
      $town->delete();
      // deleting the towns of the subcity
   
      Session::flash('message', 'Town has been deleted.'); 
      return redirect()->back();
   }
}
