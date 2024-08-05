<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolemanageController;
use App\Http\Controllers\UsermanageController;
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
require __DIR__.'/auth.php';
