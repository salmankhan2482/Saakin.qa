<?php

namespace App\Http\Controllers;

use App\SaveSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class SaveSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $searches = SaveSearch::where('user_id',Auth::User()->id)->get();
        $count = $searches->count();
       
        return view('front.pages.save-search-properties', compact('searches','count'));
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
        $currentURL = url()->previous();
        $record = SaveSearch::where('user_id', auth()->user()->id)->where('link', $currentURL)->first();
        
        if(!isset($record)){
            $save = new SaveSearch();
            $save->user_id = auth()->user()->id;
            $save->link = $currentURL;
            $save->name = request('name');
            $save->save();
            $store['message'] = 'Saved';

        }else{
            $record->delete();
            $store['message'] = 'Removed';
        }
        return $store;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SaveSearch  $saveSearch
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $search = SaveSearch::where('id',$id)->first();
        $search->delete();
        
        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SaveSearch  $saveSearch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd("edit");
        $search = SaveSearch::where('id',$id)->first();
        // dd($search);
        return response()->json([
            'data' => $search
          ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SaveSearch  $saveSearch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaveSearch $saveSearch)
    {
        dd("update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SaveSearch  $saveSearch
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaveSearch $saveSearch)
    {
        //
    }
}
