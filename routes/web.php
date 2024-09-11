<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\DrivinglicenseController;
use App\Http\Controllers\DrivinglicenseprintController;
use App\Http\Controllers\DrivinglicenserenewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolemanageController;
use App\Http\Controllers\VehicalRegistrationController;
use App\Http\Controllers\VehicalRenewController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/rolelists', [RolemanageController::class, 'index'])->name('rolelists');
Route::post('/insertrole', [RolemanageController::class, 'storeRole'])->name('insertrole');
Route::delete('/roledelete/{role}', [RolemanageController::class, 'destroy'])->name('roledelete');

Route::get('/userlists', [UsermanageController::class, 'index'])->name('userlists');
Route::post('/storeuser', [UsermanageController::class, 'store'])->name('storeuser');
Route::get('/userstatus/{id}/{status}', [UsermanageController::class, 'status'])->name('userstatus');

Route::get('/permisionlist', [Admincontroller::class, 'index'])->name('permisionlist');
Route::get('/addpermision/{id}', [Admincontroller::class, 'addprivilegesview'])->name('addpermision');
Route::post('/saveprivilegies', [Admincontroller::class, 'updateprivilegies'])->name('saveprivilegies');

Route::get('/drivinglisencelist', [DrivinglicenseController::class, 'index'])->name('drivinglisencelist');
Route::get('/drivinglisencenew', [DrivinglicenseController::class, 'newlicense'])->name('drivinglisencenew');
Route::post('/savedrivinglisence', [DrivinglicenseController::class, 'store'])->name('savedrivinglisence');
Route::get('/drivinglisence/{id}/{status}', [DrivinglicenseController::class, 'status'])->name('drivinglisence');
Route::get('/drivinglisenceedit/{id}', [DrivinglicenseController::class, 'edit'])->name('drivinglisenceedit');


Route::get('/drivinglisenceprint', [DrivinglicenseprintController::class, 'index'])->name('drivinglisenceprint');
Route::get('/drivinglisenceprintprintview/{id}', [DrivinglicenseprintController::class, 'printview'])->name('drivinglisenceprintprintview');

Route::get('/drivinglisencerenew', [DrivinglicenserenewController::class, 'index'])->name('drivinglisencerenew');
Route::get('/lisencerenew/{id}', [DrivinglicenserenewController::class, 'renew'])->name('lisencerenew');
Route::post('/savelisencerenew', [DrivinglicenserenewController::class, 'updatelicense'])->name('savelisencerenew');


Route::get('/vehicalregistrationlist', [VehicalRegistrationController::class, 'index'])->name('vehicalregistrationlist');
Route::get('/vehicalregistrationnew', [VehicalRegistrationController::class, 'newvehicalregistration'])->name('vehicalregistrationnew');
Route::post('/savevehicalregistration', [VehicalRegistrationController::class, 'store'])->name('savevehicalregistration');
Route::get('/vehicledelete/{id}/{status}', [VehicalRegistrationController::class, 'status'])->name('vehicledelete');
Route::get('/vehicleedit/{id}', [VehicalRegistrationController::class, 'edit'])->name('vehicleedit');


Route::get('/vehicalrenewlist', [VehicalRenewController::class, 'index'])->name('vehicalrenewlist');
Route::get('/vehiclerenew/{id}', [VehicalRenewController::class, 'renew'])->name('vehiclerenew');
Route::post('/savevehicalrenew', [VehicalRenewController::class, 'store'])->name('savevehicalrenew');

Route::post('/vehiclesearch', [VehicalRenewController::class, 'searchVehicle'])->name('vehiclesearch');

require __DIR__.'/auth.php';
