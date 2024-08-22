<?php

namespace App\Http\Controllers;

use App\Models\DrivingLicenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class DrivinglicenseController extends Controller
{
    public function index()
    {
        return Inertia::render('DrivingLicense/drivinglicense');
    }

    public function newlicense(){
        return Inertia::render('DrivingLicense/newlicense');
    }

    public function store(Request $request){

        if ($request->hiddenid == 1) {
            $validator = Validator::make($request->all(), [
                'userphoto' => 'required',
                'surnname' => 'required|string',
                'othername' => 'required|string',
                'dob' => 'required',
                'doi' => 'required',
                'doe' => 'required|string',
                'nic' => 'required|string',
                'liceno' => 'required',
                'address' => 'required',
                'sex' => 'required|string',
                'height' => 'required|string',
                'weight' => 'required',
                'eyes' => 'required|string',
                'licensclasss' => 'required|string'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{

                if ($request->hasFile('userphoto')) {
                    $file = $request->file('userphoto');
                    $fileName = now()->year . '-' . $request->nic . '.' . $file->getClientOriginalExtension();
                    $officerPhotoPath = $file->storeAs('Licensephoto', $fileName, 'Licensephoto');
                }

                DrivingLicenses::create([
                    'surname' => $request->input('surnname'),
                    'othername' => $request->input('othername'),
                    'date_of_birth' => $request->input('dob'),
                    'date_of_issue' => $request->input('doi'),
                    'date_of_expire' => $request->input('doe'),
                    'nic' => $request->input('nic'),
                    'license_no' => $request->input('liceno'),
                    'address' => $request->input('address'),
                    'sex' => $request->input('sex'),
                    'height' => $request->input('height'),
                    'weight' => $request->input('weight'),
                    'eyes' => $request->input('eyes'),
                    'classes' => $request->input('licensclasss'),
                    'photourl' => $fileName,
                    'status' => 1,
                    'created_by' => Auth::id(),
                    'updated_by' => 0
                ]);

                $message = 'License successfully created.';
            }
            return redirect()->back()->with('message', $message);
        }
        

    }

}
