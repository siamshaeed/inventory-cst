<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $permissions = Permission::select('name', 'id')->get();
        return view('roles.create',compact('roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($request->except('permissions'));

        $permissions = $request['permissions'];

        // Sync Permissions
        if (isset($permissions)) {
            $role->syncPermissions($permissions);
        } else {
            $permissions = [];
            $role->syncPermissions($permissions);
        }

        notify()->success('Role Created!', 'Success');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissionNames = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::select('name', 'id')->get();
        return view('roles.edit',compact('role','permissions','permissionNames'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //dd($request->all());
        $request->validate([
            'name'        => 'required|max:30|unique:roles,name,'.$role->id,
            'permissions' => 'required',
        ]);

        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];
        $role->fill($input)->save();

        $all_permissions = Permission::all(); //Get all permissions

        foreach ($all_permissions as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('name', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
            $role->givePermissionTo($p);  //Assign permission to role
        }

        notify()->success('Role Updated deleted!', 'Success');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $role)
    {
        $user_roles = auth()->user()->roles()->pluck('id');
        $role_users = $role->users;

        if ($role->id == 1) {
            // You can not delete Administrator
            // Throw a notice in here

            return redirect()->route("roles.index");
        } elseif (in_array($role->id, $user_roles->toArray())) {
            // You can not delete your Role!
            // Throw a notice in here

            return redirect()->route("roles.index");
        } elseif ($role_users->count()) {
            // Can not be deleted!
            // Throw a notice in here

            return redirect()->route("roles.index");
        }

        try {
            if ($role->delete()) {
                // Role successfully deleted!
                notify()->success('Role Deleted!', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Log::error($e);

            Log::error('Can not delete role with id '.$role->id);
        }

    }
}
