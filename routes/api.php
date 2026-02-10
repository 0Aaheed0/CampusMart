<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| All routes here are loaded by RouteServiceProvider
| and assigned to the "api" middleware group.
|--------------------------------------------------------------------------
*/

// =======================
// Authentication Routes
// =======================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// =======================
// Protected Routes (JWT)
// =======================
Route::middleware('auth:api')->group(function () {

    // RESTful CRUD API for Items
    Route::apiResource('items', ItemController::class);

});
