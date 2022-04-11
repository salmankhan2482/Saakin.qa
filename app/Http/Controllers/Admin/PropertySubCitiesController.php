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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCities = PropertySubCities::with(['city', 'towns'])->paginate(10);
        $action = 'saakin_index';
        return view('admin-dashboard.adress-management.subcity.index', compact('subCities','action'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = PropertyCities::all();
        $action = 'saakin_create';
        return view('admin-dashboard.adress-management.subcity.create', compact('cities','action'));

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

    /**
     * Display the specified resource.
     *
     * @param  \App\PropertySubCities  $propertySubCities
     * @return \Illuminate\Http\Response
     */
    public function show(PropertySubCities $propertySubCities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertySubCities  $propertySubCities
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCity = PropertySubCities::find($id);
        $cities = PropertyCities::all();
        $action = 'saakin_edit';

        return view('admin-dashboard.adress-management.subcity.edit', compact('subCity','cities','action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertySubCities  $propertySubCities
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertySubCities  $propertySubCities
     * @return \Illuminate\Http\Response
     */
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
