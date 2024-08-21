<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DrivinglicenseprintController extends Controller
{
    public function index()
    {
        return Inertia::render('DrivingLicense/drivinglicenceprint');
    }
}
