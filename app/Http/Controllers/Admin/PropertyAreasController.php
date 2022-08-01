<?php

namespace App\Http\Controllers\Admin;

use App\PropertyAreas;
use App\PropertyTowns;
use App\PropertyCities;
use App\PropertySubCities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class PropertyAreasController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
      $this->middleware('permission:properties-area-list', ['only' => ['index']]);
      $this->middleware('permission:properties-area-create', ['only' => ['create','store']]);
      $this->middleware('permission:properties-area-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:properties-area-delete', ['only' => ['destroy']]);
   }
   
   public function index()
   {
      $areas = PropertyAreas::with(['town'])
      ->when(request('name'), function($query){
         $query->where('name', 'like', '%'.request('name').'%');
      })
      ->paginate(10);
      $action = 'saakin_index';
      return view('admin-dashboard.adress-management.area.index', compact('areas','action'));
   }

   
   public function create()
   {
      $cities = PropertyCities::all();
      $subCities = PropertySubCities::all();
      $towns = PropertyTowns::all();
      $action = 'saakin_create';
      return view('admin-dashboard.adress-management.area.create', compact('cities','subCities','towns','action'));
   }

   public function store(Request $request)
   {
      $request->validate([
         'town' => 'required',
      ]);

      $area  = new PropertyAreas();
      $area->name = request('name');
      $area->slug = Str::slug(request('name'));
      $area->property_cities_id = request('city');
      $area->property_sub_cities_id = request('subCity');
      $area->property_towns_id = request('town');
      $area->latitude = request('latitude');
      $area->longitude = request('longitude');
      $area->save();    

      Session::flash('message', 'Area has been added.'); 
      return redirect()->back();
   }

   public function show(PropertyAreas $propertyAreas)
   {
      //
   }

   public function edit($id)
   {
      $subCities = PropertySubCities::all();
      $cities = PropertyCities::all();
      $towns = PropertyTowns::all();
      $area = PropertyAreas::find($id);
      $action = 'saakin_edit';
      return view('admin-dashboard.adress-management.area.edit', compact('subCities','cities','towns', 'area','action'));
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'name' => 'required',
         'town' => 'required',
      ]);
      
      $area  = PropertyAreas::find($id);
      $area->name = request('name');
      $area->slug = Str::slug(request('name'));
      $area->property_cities_id = request('city');
      $area->property_sub_cities_id = request('subCity');
      $area->property_towns_id = request('town');
      $area->latitude = request('latitude');
      $area->longitude = request('longitude');
      $area->update(); 
      Session::flash('message', 'Area has been Updated.'); 
      return redirect()->back();
   }

   public function destroy($id)
   {
      $area = PropertyAreas::find($id);
      $area->delete();
      
      Session::flash('message', 'Town has been deleted.'); 
      return redirect()->back();
   }
}
