<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UsermanageController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $users = User::with('role')
        ->whereIn('status', [1, 2])
        ->select('id', 'role_id', 'name', 'email', 'status')
        ->get();

        return Inertia::render('Administrator/User/User', [
            'roles' => $roles,
            'users' => $users
        ]);
    }

    public function store(Request $request){

        if ($request->hiddenid == 1) {

            $validator = Validator::make($request->all(), [
                'accountname' => 'required|string|max:255',
                'username' => 'required|email',
                'password' => 'required|string',
                'roleid' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
    
                $user =User::create([
                    'role_id' => $request->input('roleid'),
                    'name' => $request->input('accountname'),
                    'email' => $request->input('username'),
                    'password' => Hash::make($request->input('password')),
                    'status' => 1,
                    'created_by' => Auth::id(),
                    'updated_by' => 0
                ]);

                $role = Role::findById($request->input('roleid'));
                $user->assignRole($role);
    
                $message = 'User successfully created.';
            }
        } 
        else{

            $validator = Validator::make($request->all(), [
                'accountname' => 'required|string|max:255',
                'username' => 'required|email',
                'roleid' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } 
            else {

                $user = User::findOrFail($request->recordID);
                $user->role_id = $request->input('roleid');
                $user->name = $request->input('accountname');
                $user->email = $request->input('username');
                
                if ($request->filled('password')) {
                    $user->password = Hash::make($request->input('password'));
                }

                $user->updated_by = Auth::id();
                $user->save();
                $role = Role::findById($request->input('roleid'));
                $user->syncRoles([$role]);

                $message = 'User successfully updated.';
            }
        }
        
        return redirect()->back()->with('message', $message);
    }

    public function status($requestid, $statusid)
    {
        $user = Auth::user();

        if($statusid == 1){

                $user = User::findOrFail($requestid);
                $user->status = 1;
                $user->updated_by = Auth::id();
                $user->save();

                $message = 'User Account Activated Succssfully.';
        }elseif($statusid == 2){

            $user = User::findOrFail($requestid);
            $user->status = 2;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'User Account Deactivated Succssfully.';

        }else{

            $user = User::findOrFail($requestid);
            $user->status = 3;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'User Account Deleted Succssfully.';

        }

        return redirect()->back()->with('message', $message);
    }



}
