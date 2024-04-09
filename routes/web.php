<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PropertyController::class, 'index']);

Route::get('/get-neighborhoods/{id}', [PropertyController::class, 'getNeighborhoods']);

Route::get('/modify/{id}', [PropertyController::class, 'modify']);

Route::get('/create', [PropertyController::class, 'create']);
Route::post('/create', [PropertyController::class, 'store']);

Route::get('/zone', [ZoneController::class, 'index']);

Route::post('/saveCity/{name}', [CityController::class, 'store']);
Route::post('/saveZone/{cityId}/{name}', [ZoneController::class, 'store']);
