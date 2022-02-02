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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = PropertyAreas::with(['town'])->get();
        return view('admin.pages.address.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = PropertyCities::all();
        $subCities = PropertySubCities::all();
        $towns = PropertyTowns::all();
        return view('admin.pages.address.areas.create', compact('cities','subCities','towns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\PropertyAreas  $propertyAreas
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyAreas $propertyAreas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertyAreas  $propertyAreas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCities = PropertySubCities::all();
        $cities = PropertyCities::all();
        $towns = PropertyTowns::all();
        $area = PropertyAreas::find($id);

        return view('admin.pages.address.areas.edit', compact('subCities','cities','towns', 'area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertyAreas  $propertyAreas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'town' => 'required',
        ]);

        // if(PropertyAreas::where('name', request('name'))
        //     ->where('property_towns_id', request('town') )
        //     ->first())
        // {
        //     return redirect()->back()->withErrors(['msg' => 'Duplicate Record Cannot be Inserted.']);
        // }
        
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertyAreas  $propertyAreas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = PropertyAreas::find($id);
        $area->delete();
        
        Session::flash('message', 'Town has been deleted.'); 
        return redirect()->back();
    }
}
