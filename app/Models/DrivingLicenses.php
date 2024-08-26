<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrivingLicenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'surname',
        'othername',
        'date_of_birth',
        'date_of_issue',
        'date_of_expire',
        'nic',
        'license_no',
        'address',
        'sex',
        'height',
        'weight',
        'eyes',
        'classes',
        'userphoto',
        'status',
        'created_by',
        'updated_by'
        
    ];
}
