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
        $data['menuOptions'] = MenuOptions::where('parent_id', 0)->get();
        $data['permissions'] = Permissions::select('id', 'title')->get();
        return view('admin-dashboard.user-management.roles.create', compact(['data','action']));
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

        $action='saakin_create';    
        $data['role'] = Roles::find($id);
        $data['permissions'] = Permissions::select('id', 'title')->get();
        $data['menuOptions'] = MenuOptions::where('parent_id', 0)->select('id', 'title')->get();

        return view('admin-dashboard.user-management.roles.edit', compact('data','action'));

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
