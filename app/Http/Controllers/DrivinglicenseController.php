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
        $licenses = DrivingLicenses::where('status', 1)
        ->select('id', 'surname', 'othername', 'date_of_issue', 'nic','license_no','classes')
        ->get();
        return Inertia::render('DrivingLicense/DrivingLicensenew/drivinglicense',[ 'licenses' => $licenses ]);
    }

    public function newlicense(){
        return Inertia::render('DrivingLicense/DrivingLicensenew/newlicense');
    }

    public function store(Request $request){

        if ($request->hiddenid == 1) {
            $validator = Validator::make($request->all(), [
                'userphoto' => 'required',
                'surname' => 'required|string',
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

                $data = $request->except('userphoto'); 

                if ($request->hasFile('userphoto')) {
                    $file = $request->file('userphoto');
                    $fileName = now()->year . '-' . $request->nic . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('Licensephoto', $fileName, 'Licensephoto');
                    $data['userphoto'] = $filePath;
                }

                DrivingLicenses::create([
                    'surname' => $request->input('surname'),
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
                    'userphoto' => $fileName,
                    'status' => 1,
                    'created_by' => Auth::id(),
                    'updated_by' => 0
                ]);

                $message = 'License successfully created.';
            }
           

        }else{

            $validator = Validator::make($request->all(), [
                'userphoto' => 'required',
                'surname' => 'required|string',
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

                $data = $request->except('userphoto'); 

                $license = DrivingLicenses::findOrFail($request->input('recordID'));
                $license->surname = $request->input('surname');
                $license->othername = $request->input('othername');
                $license->date_of_birth = $request->input('dob');
                $license->date_of_issue = $request->input('doi');
                $license->date_of_expire = $request->input('doe');
                $license->nic = $request->input('nic');
                $license->license_no = $request->input('liceno');
                $license->address = $request->input('address');
                $license->sex = $request->input('sex');
                $license->height = $request->input('height');
                $license->weight = $request->input('weight');
                $license->eyes = $request->input('eyes');
                $license->classes = $request->input('licensclasss');
    
                if ($request->hasFile('userphoto')) {
                    $file = $request->file('userphoto');
                    $fileName = now()->year . '-' . $request->nic . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('Licensephoto', $fileName, 'Licensephoto');
                    $data['userphoto'] = $fileName; 
                } else {
                    $data['userphoto'] = $license->userphoto;
                }

                $license->fill($data);
                $license->updated_by = Auth::id(); 
                $license->save();
                $message = 'License successfully Updated.';
            }
        }

        return redirect()->route('drivinglisencelist')->with('message', $message);

    }

    public function status($requestid, $statusid)
    {
        $user = Auth::user();

            $user = DrivingLicenses::findOrFail($requestid);
            $user->status = $statusid;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'Driving License Deleted Succssfully.';

        return redirect()->back()->with('message', $message);
    }

    public function edit($requestid)
    {
        $license = DrivingLicenses::where('status', 1)
            ->where('id', $requestid)
            ->select('id as recordID', 'surname', 'othername', 'date_of_birth as dob', 'date_of_issue as doi', 'date_of_expire as doe', 'nic', 'license_no as liceno','address', 'sex', 'height', 'weight', 'eyes', 'classes as licensclasss', 'userphoto')
            ->first(); 
    
        return Inertia::render('DrivingLicense/DrivingLicensenew/editlicense', [
            'license' => $license
        ]);
    }
    
}
