<?php

namespace App\Http\Controllers;

use App\PropertyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PropertyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['reports'] = PropertyReport::all();
        $action = 'saakin_index';
        return view('admin-dashboard.property-reports.index', compact('data','action'));
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
        PropertyReport::create([
            'message' => request('message'),
            'users_id' => auth()->user()->id,
            'properties_id' => request('property_id'),
        ]);
        
        Session::flash('message', 'Report has been submitted.'); 
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PropertyReport  $propertyReport
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyReport $propertyReport)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PropertyReport  $propertyReport
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyReport $propertyReport)
    {
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PropertyReport  $propertyReport
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $report = PropertyReport::find($id);
        $report->status = 'Resolved';
        $report->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PropertyReport  $propertyReport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = PropertyReport::find($id);
        $report->delete();
        return redirect()->back();
    }
}
