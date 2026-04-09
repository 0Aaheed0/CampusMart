<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout (Needs to be accessible to logged-in users)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (Require Login & Prevent Back History)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'prevent-back'])->group(function () {

    // Home Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Products & Issues
    Route::get('/available-products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.available');
    Route::get('/post-product', [\App\Http\Controllers\ProductController::class, 'create'])->name('products.post');
    Route::post('/post-product', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::get('/payment/{id}', [\App\Http\Controllers\ProductController::class, 'payment'])->name('products.payment');
    Route::get('/reviews', [\App\Http\Controllers\ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/report-issues', function() { return view('home'); })->name('issues.report');
    Route::get('/help-board', [\App\Http\Controllers\HelpBoardController::class, 'index'])->name('help.board');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| Admin Routes (Require Admin Role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'prevent-back', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::delete('/users/{id}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.delete');
    Route::delete('/products/{id}', [\App\Http\Controllers\AdminController::class, 'deleteProduct'])->name('products.delete');
    
    // Additional admin routes requested for the dashboard navigation
    Route::get('/users', function() { return "Manage Users Page"; })->name('users');
    Route::get('/products', function() { return "Manage Products Page"; })->name('products');
    Route::get('/analytics', function() { return "Analytics Page"; })->name('analytics');
    Route::get('/categories', function() { return "Categories Page"; })->name('categories');
    Route::get('/reports', function() { return "Reports Page"; })->name('reports');
    Route::get('/settings', function() { return "Settings Page"; })->name('settings');
});
