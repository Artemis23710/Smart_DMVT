<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class VehicalRegistrationController extends Controller
{
    public function index()
    {
        return Inertia::render('Vehicleregistration/VehicalRegistration/vehicalregistration');
    }

    public function newvehicalregistration(){
        return Inertia::render('Vehicleregistration/VehicalRegistration/newvehicalregistration');
    }

}
