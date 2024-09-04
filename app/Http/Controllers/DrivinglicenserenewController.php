<?php

namespace App\Http\Controllers;

use App\Models\DrivingLicenses;
use App\Models\LicenseRenew;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DrivinglicenserenewController extends Controller
{
    public function index()
    {
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfMonthAfterNext = Carbon::now()->addMonths(2)->endOfMonth();
        
        $licenses = DrivingLicenses::where('status', 1)
            ->whereBetween('date_of_expire', [$startOfLastMonth, $endOfMonthAfterNext])
            ->select('id', 'surname', 'othername', 'date_of_issue', 'date_of_expire', 'nic', 'license_no', 'classes')
            ->get();
        return Inertia::render('DrivingLicense/LicenseRenew/drivinglicenserenew',[ 'licenses' => $licenses ]);
    }

    public function renew($requestid)
    {
        $license = DrivingLicenses::where('status', 1)
            ->where('id', $requestid)
            ->select('id as recordID', 'surname', 'othername', 'date_of_birth as dob', 'date_of_issue as doi', 'date_of_expire as doe', 'nic', 'license_no as liceno','address', 'sex', 'height', 'weight', 'eyes', 'classes as licensclasss', 'userphoto')
            ->first(); 
    
        $licensesrenew = LicenseRenew::where('License_ID', $requestid)
        ->select('id', 'date_of_issue', 'date_of_expire', 'classes', 'date_of_renew')
        ->get();
        return Inertia::render('DrivingLicense/LicenseRenew/renewlicense', [
            'license' => $license,
            'licensesrenews' => $licensesrenew
        ]);
    }

    public function updatelicense(Request $request){

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

             // Find the existing license record
            $license = DrivingLicenses::findOrFail($request->input('recordID'));

            $originalDateOfIssue = $license->date_of_issue;
            $originalDateOfExpire = $license->date_of_expire;
            $originalClasses = $license->classes;

             // Save the original values into the LicenseRenews model
            LicenseRenew::create([
                'License_ID' => $request->input('recordID'),
                'date_of_issue' => $originalDateOfIssue,
                'date_of_expire' => $originalDateOfExpire,
                'classes' => $originalClasses,
                'date_of_renew' => $request->input('daterenew'),
            ]);

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
            $message = 'License Renew successfully Updated.';
        }
        return redirect()->route('drivinglisencerenew')->with('message', $message);
    }


}
