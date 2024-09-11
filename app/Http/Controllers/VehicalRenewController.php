<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_details;
use App\Models\Vehicle_owners_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class VehicalRenewController extends Controller
{
    public function index()
    {
        $vehicales = Vehicle_details::where('status', 1)
        ->select('*')
        ->get();
        return Inertia::render('Vehicleregistration/VehicalRenew/vehicalrenew',[ 'vehicales' => $vehicales ]);
    }

    public function renew($requestid)
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

          $oldvehicleowner = Vehicle_owners_details::where('vehicle_ID', $requestid)
          ->where(function($query) {
              $query->whereNotNull('date_of_transfer');
          })
          ->select('*')
          ->get();
      
          
        return Inertia::render('Vehicleregistration/VehicalRenew/editvehicalrenew', [
            'vehicledetails' => $vehicle,
            'vehicleowner' => $vehicleowner,
            'oldvehicleowners' => $oldvehicleowner
        ]);
    }

    public function store(Request $request){

            $validator = Validator::make($request->all(), [
                'ownername' => 'required|string',
                'ownernic' => 'required|string',
                'owneraddress' => 'required|string',
                'newownername' => 'required|string',
                'newownernic' => 'required|string',
                'newowneraddress' => 'required|string',
                 'transferdate' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{

               $vehicleDetails = Vehicle_details::findOrFail($request->input('recordID'));
                $vehicleDetails->update([
                    'register_date' => $request->input('transferdate'),
                    'ownername' => $request->input('newownername'),
                    'ownernic' => $request->input('newownernic'),
                    'owneraddress' => $request->input('newowneraddress'),
                    'updated_by' => Auth::id()
                ]);

                $vehicleowner = Vehicle_owners_details::findOrFail($request->input('ownerid'));
                $vehicleowner->update([
                    'date_of_transfer' => $request->input('transferdate'),
                ]);
                
                Vehicle_owners_details::create([
                    'vehicle_ID' => $request->input('recordID'),
                    'name' => $request->input('newownername'),
                    'nic' => $request->input('newownernic'),
                    'address' => $request->input('newowneraddress'),
                    'date_of_register' => $request->input('transferdate'),
                    'date_of_transfer' => null 
                ]);
                return redirect()->route('vehicalrenewlist');
            } 
    }


}
