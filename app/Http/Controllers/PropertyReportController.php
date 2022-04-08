<?php

namespace App\Http\Controllers;
use App\Properties;
use App\PropertyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }
        
        $data['reports'] = PropertyReport::
        when(Auth::User()->usertype=="Agency", function($query){
            $query->where('agency_id',Auth::User()->agency_id);
        })
        ->orderBy('id','desc')->paginate(10);
        
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
            'agency_id' => Properties::where('id',request('property_id'))->value('agency_id'),
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
    public function show($id)
    {
        $report = PropertyReport::find($id);
        $action = 'saakin_create';
        return view('admin-dashboard.property-reports.show', compact('action', 'report'));
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
