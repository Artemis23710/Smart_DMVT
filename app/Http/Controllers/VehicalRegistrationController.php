<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_details;
use App\Models\Vehicle_owners_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class VehicalRegistrationController extends Controller
{
    public function index()
    {
        $vehicales = Vehicle_details::where('status', 1)
        ->select('*')
        ->get();
        return Inertia::render('Vehicleregistration/VehicalRegistration/vehicalregistration',[ 'vehicales' => $vehicales ]);
    }

    public function newvehicalregistration(){
        return Inertia::render('Vehicleregistration/VehicalRegistration/newvehicalregistration');
    }

    public function store(Request $request){
        if ($request->hiddenid == 1) {
            $validator = Validator::make($request->all(), [
                'classofvehicle' => 'required',
                'registrationno' => 'required|string',
                'Chassisno' => 'required|string',
                'registerdate' => 'required',
                'condition' => 'required',
                'engineno' => 'required|string',
                'capacity' => 'required|string',
                'fueltype' => 'required',
                'make' => 'required',
                'origincountry' => 'required|string',
                'manufactureyear' => 'required',
                'color' => 'required',
                'ownername' => 'required|string',
                'ownernic' => 'required|string',
                'owneraddress' => 'required|string'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{

                $vehicleDetails = Vehicle_details::create([
                    'classofvehicle' => $request->input('classofvehicle'),
                    'registration_No' => $request->input('registrationno'),
                    'Chassisno' => $request->input('Chassisno'),
                    'register_date' => $request->input('registerdate'),
                    'condition' => $request->input('condition'),
                    'engineno' => $request->input('engineno'),
                    'capacity' => $request->input('capacity'),
                    'fueltype' => $request->input('fueltype'),
                    'make' => $request->input('make'),
                    'origincountry' => $request->input('origincountry'),
                    'manufactureyear' => $request->input('manufactureyear'),
                    'color' => $request->input('color'),
                    'ownername' => $request->input('ownername'),
                    'ownernic' => $request->input('ownernic'),
                    'owneraddress' => $request->input('owneraddress'),
                    'status' => 1, 
                    'created_by' => Auth::id(),
                    'updated_by' => 0
                ]);

                $vehicleId = $vehicleDetails->id;

                Vehicle_owners_details::create([
                    'vehicle_ID' => $vehicleId,
                    'name' => $request->input('ownername'),
                    'nic' => $request->input('ownernic'),
                    'address' => $request->input('owneraddress'),
                    'date_of_register' => $request->input('registerdate'),
                    'date_of_transfer' => null 
                ]);
                return redirect()->route('vehicalregistrationlist');
            } 

        }else{

            $validator = Validator::make($request->all(), [
                'classofvehicle' => 'required',
                'registrationno' => 'required|string',
                'Chassisno' => 'required|string',
                'registerdate' => 'required',
                'condition' => 'required',
                'engineno' => 'required|string',
                'capacity' => 'required|string',
                'fueltype' => 'required',
                'make' => 'required',
                'origincountry' => 'required|string',
                'manufactureyear' => 'required',
                'color' => 'required',
                'ownername' => 'required|string',
                'ownernic' => 'required|string',
                'owneraddress' => 'required|string'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{

                $vehicleDetails = Vehicle_details::findOrFail($request->input('recordID'));
                $vehicleDetails->update([
                    'classofvehicle' => $request->input('classofvehicle'),
                    'registration_No' => $request->input('registrationno'),
                    'Chassisno' => $request->input('Chassisno'),
                    'register_date' => $request->input('registerdate'),
                    'condition' => $request->input('condition'),
                    'engineno' => $request->input('engineno'),
                    'capacity' => $request->input('capacity'),
                    'fueltype' => $request->input('fueltype'),
                    'make' => $request->input('make'),
                    'origincountry' => $request->input('origincountry'),
                    'manufactureyear' => $request->input('manufactureyear'),
                    'color' => $request->input('color'),
                    'ownername' => $request->input('ownername'),
                    'ownernic' => $request->input('ownernic'),
                    'owneraddress' => $request->input('owneraddress'),
                    'updated_by' => Auth::id()
                ]);

                $vehicleowner = Vehicle_owners_details::findOrFail($request->input('ownerid'));
                $vehicleowner->update([
                    'name' => $request->input('ownername'),
                    'nic' => $request->input('ownernic'),
                    'address' => $request->input('owneraddress'),
                    'date_of_register' => $request->input('registerdate'),
                ]);
                return redirect()->route('vehicalregistrationlist');
            } 
        }
    }


    public function edit($requestid)
    {
        $vehicle = Vehicle_details::where('status', 1)
            ->where('id', $requestid)
            ->select('id as recordID', 'classofvehicle', 'registration_No as registrationno',
             'Chassisno', 'register_date as registerdate', 'condition', 'engineno', 
             'capacity','fueltype', 'make', 'origincountry', 'manufactureyear', 'color',
              'ownername', 'ownernic','owneraddress')
            ->first(); 

        $vehicleowner = Vehicle_owners_details::where('vehicle_ID', $requestid)
        ->where(function($query) {
            $query->whereNull('date_of_transfer')
                  ->orWhere('date_of_transfer', '');
            })
           ->select('id as ownerID')
          ->first(); 
        return Inertia::render('Vehicleregistration/VehicalRegistration/editvehicalregistration', [
            'vehicledetails' => $vehicle,
            'vehicleowner' => $vehicleowner
        ]);
    }

    public function status($requestid, $statusid)
    {
        $user = Auth::user();

            $user = Vehicle_details::findOrFail($requestid);
            $user->status = $statusid;
            $user->updated_by = Auth::id();
            $user->save();

            $message = 'Vehicle Register Deleted Succssfully.';

        return redirect()->back()->with('message', $message);
    }



}
