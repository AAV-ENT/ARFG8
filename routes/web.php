<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\ModifyController;
use App\Http\Controllers\ImageController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [PropertyController::class, 'index']);

Route::get('/get-neighborhoods/{id}', [PropertyController::class, 'getNeighborhoods']);

Route::get('/modify/{id}', [ModifyController::class, 'index']);
Route::put('/modify/{id}', [ModifyController::class, 'update']);
Route::post('/update-specs/{specs}/{id}', [ModifyController::class, 'updateSpec']);
Route::put('/update-location/{lat}/{long}/{id}', [ModifyController::class, 'updateLocation']);
Route::put('/inactive/{id}', [ModifyController::class, 'updateProperty']);

Route::delete('/delete-image/{id}', [ImageController::class, 'destroy']);

Route::get('/create', [PropertyController::class, 'create']);
Route::post('/create', [PropertyController::class, 'store']);

Route::get('/zone', [ZoneController::class, 'index']);

Route::post('/saveCity/{name}', [CityController::class, 'store']);
Route::post('/saveZone/{cityId}/{name}', [ZoneController::class, 'store']);

Route::post('/location/{lat}/{long}/{id}', [LocationController::class, 'store']);
Route::post('/specs/{specs}/{id}', [SpecController::class, 'store']);

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
