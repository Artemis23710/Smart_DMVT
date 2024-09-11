<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'classofvehicle', 
        'registration_No', 
        'Chassisno', 
        'register_date', 
        'condition', 
        'engineno', 
        'capacity',
        'fueltype',
        'make',
        'origincountry', 
        'manufactureyear', 
        'color', 
        'ownername', 
        'ownernic',
        'owneraddress', 
        'status', 
        'created_by', 
        'updated_by'
    ];
    
}
