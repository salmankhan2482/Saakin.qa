<?php

namespace App\Http\Controllers\Admin;

use App\PropertyCities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PropertyCitiesController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
      $this->middleware('permission:properties-city-list', ['only' => ['index']]);
      $this->middleware('permission:properties-city-create', ['only' => ['create','store']]);
      $this->middleware('permission:properties-city-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:properties-city-delete', ['only' => ['destroy']]);
   }
   
   public function index()
   {
      $cities = PropertyCities::paginate(10);
      $action = 'saakin_index';
      return view('admin-dashboard.adress-management.city.index', compact('cities','action'));
   }

   public function create()
   {
      $action = 'saakin_create';
      return view('admin-dashboard.adress-management.city.create',compact('action'));
   }

   public function store(Request $request)
   {
      $request->validate([
         'name' => 'required'
      ]);
      
      PropertyCities::create([
         'name' => request('name'),
         'slug' => Str::slug(request('name')),
      ]);


      Session::flash('message', 'City has been added.'); 
      return redirect()->back();
   }

   public function show(PropertyCities $propertyCities)
   {
      dd($propertyCities);
   }

   public function edit($id)
   {
      $propertyCity = PropertyCities::find($id);
      $action = 'saakin_edit';
      return view('admin-dashboard.adress-management.city.edit', compact('propertyCity','action'));
   }

   public function update(Request $request, $id)
   {   
      $request->validate([
         'name' => 'required'
      ]);

      PropertyCities::where('id', $id)->update([
         'name' => request('name'),
         'slug' => Str::slug(request('name')),
      ]);
      
      Session::flash('message', 'City has been updated.'); 
      return redirect()->back();
   }

   public function destroy($id)
   {
      $propertyCity = PropertyCities::find($id);

      foreach($propertyCity->subcities as $subcity){
         foreach($subcity->towns as $town){
               
               foreach($town->areas as $area){
                  $area->delete();
                  // deleting the areas of the town of subcity
               }

               $town->delete();
               // deleting the towns of the subcity

         }

         $subcity->delete();
         // at the end deleting that subcity

      }

      // finally deleting the city to which subcity->town->areas are connected
      $propertyCity->delete();
   
      Session::flash('message', 'City has been deleted.'); 
      return redirect()->back();
   }
}
