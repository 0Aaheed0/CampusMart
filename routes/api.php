<?php
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Log::info('Testing the log at ' . now());
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Dummy CRUD operations for items using UsersController
Route::get('/items', [UsersController::class, 'index']);
Route::get('/items/{id}', [UsersController::class, 'show']);
Route::post('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);
//Protected routes
Route::middleware('auth:api')->group(function () {
    Route::post('/items', [UsersController::class, 'store']);
    Route::put('/items/{id}', [UsersController::class, 'update']);
    Route::patch('/items/{id}', [UsersController::class, 'patch']);
});