<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SpecController;
use App\Http\Controllers\ModifyController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PropertyController::class, 'index']);

Route::get('/get-neighborhoods/{id}', [PropertyController::class, 'getNeighborhoods']);

Route::get('/modify/{id}', [ModifyController::class, 'index']);
Route::get('/deleteImage/{$id}', [ImageController::class, 'destroy']);

Route::get('/create', [PropertyController::class, 'create']);
Route::post('/create', [PropertyController::class, 'store']);

Route::get('/zone', [ZoneController::class, 'index']);

Route::post('/saveCity/{name}', [CityController::class, 'store']);
Route::post('/saveZone/{cityId}/{name}', [ZoneController::class, 'store']);

Route::post('/location/{lat}/{long}/{id}', [LocationController::class, 'store']);
Route::post('/specs/{specs}/{id}', [SpecController::class, 'store']);
