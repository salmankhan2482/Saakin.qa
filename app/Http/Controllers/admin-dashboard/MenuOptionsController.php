<?php

namespace App\Http\Controllers\Admin;

use App\MenuOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $action = 'saakin_index';
        $menuOptions = MenuOptions::all();
        return view('admin-dashboard.user-management.menu-options.index', compact('menuOptions','action'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'saakin_create';
        $menuOptions = MenuOptions::where('parent_id', 0)->get();
        return view('admin-dashboard.user-management.menu-options.create', compact('menuOptions','action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = new MenuOptions();
        $menu->title = request('title');
        $menu->parent_id = request('parent_id');
        $menu->route = request('route');
        $menu->url = request('url');
        $menu->icon = request('icon');
        $menu->save();

        \Session::flash('flash_message', 'Menu Option Added');
        return redirect()->route('menuOptions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuOptions  $menuOptions
     * @return \Illuminate\Http\Response
     */
    public function show(MenuOptions $menuOptions)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuOptions  $menuOptions
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = 'saakin_edit';
        $menu = MenuOptions::find($id);
        $menuOptions = MenuOptions::where('parent_id', 0)->get();
        return view('admin-dashboard.user-management.menu-options.edit', compact('menu','menuOptions','action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuOptions  $menuOptions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = MenuOptions::find($id);
        $menu->title = request('title');
        $menu->parent_id = request('parent_id');
        $menu->route = request('route');
        $menu->url = request('url');
        $menu->icon = request('icon');
        $menu->update();

        \Session::flash('flash_message', 'Menu Option Updated');
        return redirect()->route('menuOptions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuOptions  $menuOptions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = MenuOptions::find($id);
        $menu->delete();

        \Session::flash('flash_message', 'Menu Option Deleted');
        return redirect()->route('menuOptions.index');
    }
}
