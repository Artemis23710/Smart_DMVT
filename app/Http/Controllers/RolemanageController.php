<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RolemanageController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return Inertia::render('Administrator/Roles', [
            'roles' => $roles
        ]);
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'rolename' => 'required',
        ]);

        $gaurdname = "web";
        if ($request->hiddenid == 1) {
            Role::create(['name' => $request->rolename,
                           'guard_name' => $gaurdname ]);
            $message = 'Role successfully created.';
        } else {
            Role::findOrFail($request->recordID)->update(['name' => $request->rolename]);
            $message = 'Role successfully updated.';
        }

        return redirect()->back()->with('message', $message);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->back()->with('success', 'Role deleted successfully');
    }

}
