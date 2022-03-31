<?php

namespace App\Http\Controllers\Admin;

use App\PopularSearches;
use App\PropertyAreas;
use App\PropertyCities;
use App\PropertySubCities;
use App\PropertyTowns;
use App\Types;
use Illuminate\Http\Request;

class PopularSearchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['popularSearches'] = PopularSearches::all();
        $action = 'saakin_index';
        return view('admin-dashboard.popular-searches.index', compact('data','action'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PopularSearches  $popularSearches
     * @return \Illuminate\Http\Response
     */
    public function show(PopularSearches $popularSearches)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PopularSearches  $popularSearches
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['search'] = PopularSearches::find($id);
        $data['types'] = Types::all();
        $data['cities'] = PropertyCities::all();
        $data['subcities'] = PropertySubCities::all();
        $data['towns'] = PropertyTowns::all();
        $data['areas'] = PropertyAreas::all();
        $action = 'saakin_edit';
        return view('admin-dashboard.popular-searches.edit', compact('data', 'action'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PopularSearches  $popularSearches
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = request('bedrooms') ? request('bedrooms').' bedroom ' : '';
        if(request('type')){
            $type = Types::find(request('type'));
            $name = $name . $type->plural . ' for ' . strtolower(request('property_purpose'));
        }else{
            $name = $name . ' properties ' . 'for ' . strtolower(request('property_purpose'));
        }

        $search = PopularSearches::find($id);
        $search->property_purpose =  request('purpose');
        $search->name =  $name;
        $search->type_id =  request('type');
        $search->city_id =  request('city');
        $search->subcity_id =  request('subcity');
        $search->town_id =  request('town');
        $search->area_id =  request('area');
        $search->bedrooms =  request('bedrooms');
        $search->count =  request('count');
        $search->link =  request('link');
        $search->update();
        return redirect()->route('popularSearches.index')->with('success', 'Record Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PopularSearches  $popularSearches
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $search = PopularSearches::find($id);
        $search->delete();
        return redirect()->back();
    }
}
