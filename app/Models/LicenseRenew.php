<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseRenew extends Model
{
    use HasFactory;
    protected $fillable = [
        'License_ID',
        'date_of_issue',
        'date_of_expire',
        'classes',
        'date_of_renew'
        
    ];
}
