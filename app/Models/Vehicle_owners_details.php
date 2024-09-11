<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_owners_details extends Model
{
    use HasFactory;


    protected $fillable = [
        'vehicle_ID', 
        'name', 
        'nic', 
        'address', 
        'date_of_register', 
        'date_of_transfer'
    ];
    
}
