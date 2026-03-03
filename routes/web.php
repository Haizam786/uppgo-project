<?php

use App\Http\Controllers\Activities\ActivitiesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Organisation\OrganisationDetailsController;


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

//Redirect routes
Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::get('/scan-qr', function () {
    return redirect(route('dashboard'));
});

Route::get('/admin/create', function () {
    return redirect(route('dashboard'));
});

Route::get('/admin/view', function () {
    return redirect(route('dashboard'));
});

Route::get('/profile', function () {
    return redirect(route('dashboard'));
});

//Auth routes
Auth::routes(['register' => true]);



//Dashboard
Route::get('/dashboard', [AppController::class, 'index'])->name('dashboard');


//All the backend routes will be defined here...
Route::prefix('/admin')->name('admin.')->group(function () {

    //admin user related routes
    Route::get('/fetch/admin', [AdminController::class, 'index']);
    Route::post('/create/admin', [AdminController::class, 'store']);
    Route::put('/update/admin', [AdminController::class, 'update']);
    Route::post('/destroy/admin', [AdminController::class, 'destroy']);
    Route::post('/filter/search-admin', [AdminController::class, 'searchAdmins']);

    Route::get('/fetch/user-counts', [AdminController::class, 'getUserCounts']);


    //Routes related to organisations
    Route::get('/fetch/organisations', [OrganisationDetailsController::class, 'index']);
    Route::put('/update/profile', [OrganisationDetailsController::class, 'update']);

 
    //Route related to activity logs
    Route::get('/fetch/activities', [ActivitiesController::class, 'fetchActivities']);
    Route::get('/fetch/mail-logs', [ActivitiesController::class, 'fetchMailLogs']);
});
