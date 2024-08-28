<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DrivinglicenserenewController extends Controller
{
    public function index()
    {
        return Inertia::render('DrivingLicense/LicenseRenew/drivinglicenserenew');
    }
}
