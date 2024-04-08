<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PropertyController::class, 'index']);

Route::get('/modify/{id}', [PropertyController::class, 'modify']);
