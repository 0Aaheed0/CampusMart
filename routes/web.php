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
    Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
    Route::view('/report-issues', 'report-issues')->name('issues.report');
    Route::get('/help-board', [\App\Http\Controllers\HelpBoardController::class, 'index'])->name('help.board');

    // Wishlist Routes
    Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [\App\Http\Controllers\WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product_id}', [\App\Http\Controllers\WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/checkout', [\App\Http\Controllers\WishlistController::class, 'checkout'])->name('wishlist.checkout');
    Route::get('/wishlist/check/{product_id}', [\App\Http\Controllers\WishlistController::class, 'isInWishlist'])->name('wishlist.check');

    // User Profile Popup
    Route::get('/user/{id}/popup', [\App\Http\Controllers\UsersController::class, 'popup'])->name('user.popup');

    // Payment Routes
    Route::post('/payment/checkout', [\App\Http\Controllers\PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('/payment/process', [\App\Http\Controllers\PaymentController::class, 'process'])->name('payment.process');
    Route::post('/payment/buy/{product_id}', [\App\Http\Controllers\PaymentController::class, 'buy'])->name('payment.buy');
    Route::get('/payment-history', [\App\Http\Controllers\PaymentController::class, 'history'])->name('payment.history');
    Route::get('/sold-items', [\App\Http\Controllers\PaymentController::class, 'sold'])->name('payment.sold');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Report Routes
    Route::get('/reports/create', [\App\Http\Controllers\ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [\App\Http\Controllers\ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'myReports'])->name('reports.my-reports');

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
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/users/{id}/profile', [\App\Http\Controllers\AdminController::class, 'getUserProfile'])->name('users.profile');
    Route::get('/products', [\App\Http\Controllers\AdminController::class, 'products'])->name('products');
    Route::get('/posts', function() { return "Manage Posts Page"; })->name('posts');
    Route::get('/reports', [\App\Http\Controllers\AdminController::class, 'reports'])->name('reports');
    Route::patch('/reports/{id}', [\App\Http\Controllers\AdminController::class, 'updateReportStatus'])->name('reports.update');
    Route::post('/reports/{id}/toggle-status', [\App\Http\Controllers\AdminController::class, 'toggleReportStatus'])->name('reports.toggle-status');
    Route::get('/reports/{id}/details', [\App\Http\Controllers\AdminController::class, 'getReportDetails'])->name('reports.details');
    Route::get('/faq', [\App\Http\Controllers\HelpBoardController::class, 'adminIndex'])->name('faq');
    Route::get('/faq/create', [\App\Http\Controllers\HelpBoardController::class, 'adminCreate'])->name('faq.create');
    Route::post('/faq', [\App\Http\Controllers\HelpBoardController::class, 'adminStore'])->name('faq.store');
    Route::get('/faq/{faq}/edit', [\App\Http\Controllers\HelpBoardController::class, 'adminEdit'])->name('faq.edit');
    Route::patch('/faq/{faq}', [\App\Http\Controllers\HelpBoardController::class, 'adminUpdate'])->name('faq.update');
    Route::delete('/faq/{faq}', [\App\Http\Controllers\HelpBoardController::class, 'adminDestroy'])->name('faq.destroy');
    Route::get('/reviews', [\App\Http\Controllers\AdminController::class, 'reviews'])->name('reviews');
    Route::get('/history', [\App\Http\Controllers\AdminController::class, 'history'])->name('history');
});
