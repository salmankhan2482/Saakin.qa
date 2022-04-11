<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
         $this->middleware('permission:permission-create', ['only' => ['create','store']]);
         $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $permissions = Permission::orderBy('id','DESC')->paginate(10);
        
        $action = 'saakin_index';
        return view('admin-dashboard.user-management.permissions.index',compact('permissions','action'));
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
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);
    
        $permission = new Permission();
        $permission->name = request('name');
        $permission->guard_name = 'web';
        $permission->save();
    
        return redirect()->route('permissions.index')->with('success','Permission created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        $action = 'saakin_index';
    
        return view('admin-dashboard.user-management.permissions.show',compact('permission', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = 'saakin_create';
        $permission = Permission::find($id);
    
        return view('admin-dashboard.user-management.permissions.edit',compact('permission', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
    
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();
    
        $permission->syncPermissions($request->input('permission'));
    
        return redirect()->route('permissions.index')->with('success','Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        DB::table("permissions")->where('id',$id)->delete();
        return redirect()->route('permissions.index')->with('success','Permission deleted successfully');
    }
}
