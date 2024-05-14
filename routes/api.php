<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => "Nuzul Backend Exercise API"
    ]);
});

Route::resource("/properties", PropertyController::class);
