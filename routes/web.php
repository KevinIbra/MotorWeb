<?php

use App\Http\Controllers\LoginController; 
use App\Http\Controllers\SignupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuyerController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::get('/register', [SignupController::class, 'create'])->name('register');
    Route::post('/register', [SignupController::class, 'store'])->name('register.store');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Public Motor Routes
Route::get('/motor/search', [MotorController::class, 'search'])->name('motor.search');
Route::get('/motor', [MotorController::class, 'index'])->name('motor.index');

// API route to get models by maker (🟢 accessible by public)
Route::get('/motors/maker/{maker}/models', [MotorController::class, 'getModelsByMaker'])->name('motors.models');

// API route to get cities by state (🟢 accessible by public)
Route::get('/location/state/{state}/cities', [LocationController::class, 'getCitiesByState']);

// Protected Motor Routes (only for logged-in users)
Route::middleware(['auth'])->group(function () {
    Route::get('/motor/create', [MotorController::class, 'create'])->name('motor.create');
    Route::post('/motor/store', [MotorController::class, 'store'])->name('motor.store');
    Route::resource('motor', MotorController::class);

    Route::get('/motorku', [MotorController::class, 'myList'])->name('motor.mylist');
    Route::get('/favorites', [MotorController::class, 'favorites'])->name('motor.favorites');
    Route::get('/watchlist', [MotorController::class, 'watchlist'])->name('motor.watchlist');

    Route::get('/motor/{motor}/edit', [MotorController::class, 'edit'])->name('motor.edit');
    Route::put('/motor/{motor}', [MotorController::class, 'update'])->name('motor.update');
    Route::delete('/motor/{motor}', [MotorController::class, 'destroy'])->name('motor.destroy');
    
    // Motor routes
    Route::get('/motors/maker/{maker}/models', [MotorController::class, 'getModelsByMaker']);
    Route::get('/location/state/{state}/cities', [LocationController::class, 'getCitiesByState']);

    // Admin routes
    Route::middleware(['checkRole:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/motors', [AdminController::class, 'motors'])->name('admin.motors');
        Route::get('/admin/approvals', [AdminController::class, 'approvals'])->name('admin.approvals');
    });

    // Buyer routes
    Route::middleware(['checkRole:buyer'])->group(function () {
        Route::get('/dashboard', [BuyerController::class, 'dashboard'])->name('buyer.dashboard');
        Route::get('/motors/saved', [MotorController::class, 'saved'])->name('motor.saved');
    });
});

// Route detail motor (must be last to avoid conflict)
Route::get('/motor/{motor}', [MotorController::class, 'show'])->name('motor.show');
Route::get('/motors/search', [MotorController::class, 'search'])->name('motor.search');

Route::get('/motors/maker/{maker}/models', [MotorController::class, 'getModels'])
    ->name('motor.models');

    Route::middleware('auth')->group(function () {
    Route::post('/motors/{motor}/favorite', [MotorController::class, 'toggleFavorite'])->name('motor.toggleFavorite');
    Route::get('/favorites', [MotorController::class, 'favorites'])->name('motor.favorites');
});