<?php

namespace App\Http\Controllers;

use App\Models\DrivingLicenses;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class DrivinglicenseprintController extends Controller
{
    public function index()
    {
        $licenses = DrivingLicenses::where('status', 1)
        ->whereMonth('date_of_issue', Carbon::now()->month)
        ->whereYear('date_of_issue', Carbon::now()->year)
        ->select('id', 'surname', 'othername', 'date_of_issue', 'nic','license_no','classes')
        ->get();
        return Inertia::render('DrivingLicense/LicensePrint/drivinglicenceprint',[ 'licenses' => $licenses ]);
    }

    public function printview($requestid)
    {
        $license = DrivingLicenses::where('status', 1)
            ->where('id', $requestid)
            ->select('id as recordID', 'surname', 'othername', 'date_of_birth as dob', 'date_of_issue as doi', 'date_of_expire as doe', 'nic', 'license_no as liceno','address',
             'sex', 'height', 'weight', 'eyes', 'classes as licensclasss', 'userphoto')
            ->first(); 
    
        return Inertia::render('DrivingLicense/LicensePrint/licenseprintpdf', [
            'license' => $license
        ]);
    }
    

}
