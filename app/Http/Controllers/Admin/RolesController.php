<?php

namespace App\Http\Controllers\Admin;

use App\Roles;
use App\MenuOptions;
use App\Permissions;
use App\PermissionRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MenuOptionsRole;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $action = 'saakin_index';
        $roles = Roles::all();
        return view('admin-dashboard.user-management.roles.index', compact('roles','action'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'saakin_create';
        $menuOptions = MenuOptions::where('parent_id', null)->select('id', 'title')->get();
        $permissions = Permissions::select('id', 'title')->get();
        return view('admin-dashboard.user-management.roles.create', compact(['menuOptions','permissions','action']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Roles();
        $role->title = $request->title;
        if($role->save())
        {
            
            $role->rolepermissions()->attach($request->permissions); 
            $role->menuoptions()->attach($request->menu_options); 
            
            return redirect()->route('roles.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Roles::find($id);
        $permissions = Permissions::select('id', 'title')->get();
        $menuOptions = MenuOptions::where('parent_id', null)->select('id', 'title')->get();
        $rights = MenuOptionsRole::where('role_id',$role->id)->get();

        return view('admin.pages.user-management.roles.edit', compact('permissions', 'role','menuOptions','rights'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Roles::find($id);
        $role->title = $request->title;
        if($role->update())
        {
            $role->rolepermissions()->sync($request->permissions); 
            $role->menuoptions()->sync($request->menu_options); 
            return redirect()->route('roles.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Roles::find($id);
        if($role->delete())
        {
            $role->rolepermissions()->detach(); 
            $role->menuoptions()->detach(); 
            return redirect()->route('roles.index');
        }
    }
}
