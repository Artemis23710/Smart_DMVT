<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    
}
