<?php

namespace App\Http\Controllers\Admin;

use App\Permissions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $action = 'saakin_index';
        $permissions = Permissions::all();
        return view('admin-dashboard.user-management.permissions.index', compact('permissions','action'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'saakin_create';
        return view('admin-dashboard.user-management.permissions.create',compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = new Permissions();
        $permission->title = request('title');
        $permission->save();

        \Session::flash('flash_message', 'Permission Added');
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function show(Permissions $permissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
        $action='saakin_edit';    $permission = Permissions::find($id);
        return view('admin-dashboard.user-management.permissions.edit', compact('permission','action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = Permissions::find($id);
        $permission->title = request('title');
        $permission->update();

        \Session::flash('flash_message', 'Permission Updated');
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permissions::find($id);
        $permission->delete();

        \Session::flash('flash_message', 'Permission Deleted');
        return redirect()->route('permissions.index');
    }
}
