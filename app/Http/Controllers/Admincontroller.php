<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class Admincontroller extends Controller
{
    public function index()
    {
        $roles =Role::all();
        return Inertia::render('Administrator/Permision/privileges', [
            'roles' => $roles
        ]);
    }

    
    public function addprivilegesview($requestid){

        $role = Role::findOrFail($requestid);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->all();
        $permsWithModules = Permission::select('module_name')
            ->distinct()
            ->get()
            ->toArray();

            return Inertia::render('Administrator/Permision/newpriviliges', [
                'role' => $role,
                'permissions' => $permissions,
                'requestid' => $requestid,
                'rolePermissions' => $rolePermissions,
                'permsWithModules' => $permsWithModules
            ]);
    }

    public function updateprivilegies(Request $request)
    {
        $request->validate([
            'requestid' => 'required|integer',
            'role_name' => 'required|string',
            'permissions' => 'array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role = Role::findByName($request->input('role_name'));

        $permissions = Permission::whereIn('id', $request->input('permissions', []))->get();
    
        $role->syncPermissions($permissions);

        $message = 'Permissions updated successfully.';

            return redirect()->route('permisionlist')->with('message', $message);
    }



}
