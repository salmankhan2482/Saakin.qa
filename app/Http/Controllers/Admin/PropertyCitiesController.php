<?php

namespace App\Http\Controllers\Admin;

use App\PropertyCities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PropertyCitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = PropertyCities::all();
        return view('admin.pages.address.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.address.cities.create');
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
            'name' => 'required'
        ]);
        
        PropertyCities::create([
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
        ]);

        Session::flash('message', 'City has been added.'); 
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PropertyCities  $propertyCities
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyCities $propertyCities)
    {
        dd($propertyCities);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertyCities  $propertyCities
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $propertyCity = PropertyCities::find($id);
        return view('admin.pages.address.cities.edit', compact('propertyCity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertyCities  $propertyCities
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertyCities  $propertyCities
     * @return \Illuminate\Http\Response
     */
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
