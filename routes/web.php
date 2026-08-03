<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [BookingController::class, 'index'])->name('home');
Route::view('/privacy', 'privacy')->name('privacy');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::post('/meta/contact', [BookingController::class, 'trackContact'])->name('meta.contact');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Protected Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::patch('/bookings/{booking}/status', [AdminDashboardController::class, 'updateStatus'])->name('bookings.status');
    Route::delete('/bookings/{booking}', [AdminDashboardController::class, 'destroy'])->name('bookings.destroy');
});
