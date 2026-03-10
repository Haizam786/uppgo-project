<?php

use App\Http\Controllers\Activities\ActivitiesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Organisation\OrganisationDetailsController;
use App\Http\Controllers\UserController;

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
    return redirect(route('dashboard'));
});



Route::get('/user/create', function () {
    return redirect(route('dashboard'));
});

Route::get('/user/view', function () {
    return redirect(route('dashboard'));
});

Route::get('/profile', function () {
    return redirect(route('dashboard'));
});


Auth::routes(['register' => true]);




Route::get('/dashboard', [AppController::class, 'index'])->name('dashboard');



Route::prefix('/admin')->name('admin.')->group(function () {


    Route::get('/fetch/user', [UserController::class, 'index']);
    Route::post('/create/user', [UserController::class, 'store']);
    Route::put('/update/user', [UserController::class, 'update']);
    Route::post('/destroy/user', [UserController::class, 'destroy']);
    Route::post('/filter/search-user', [UserController::class, 'searchUsers']);

    Route::get('/fetch/user-counts', [UserController::class, 'getUserCounts']);



    Route::get('/fetch/activities', [ActivitiesController::class, 'fetchActivities']);
    Route::get('/fetch/mail-logs', [ActivitiesController::class, 'fetchMailLogs']);
});


Route::get('/app/{any?}', function () {
    return view('react');
})->where('any', '.*');
