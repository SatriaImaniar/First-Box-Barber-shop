<?php

use App\Http\Controllers\Admin\BarberController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QueueController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ─── Customer Routes ────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/booking', [HomeController::class, 'booking'])->name('booking');
Route::get('/booking/slots', [HomeController::class, 'getSlots'])->name('booking.slots');
Route::post('/booking', [HomeController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{booking}', [HomeController::class, 'success'])->name('booking.success');

// ─── Admin Routes ───────────────────────────────────────
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/toggle-booking', [DashboardController::class, 'toggleBooking'])->name('toggle-booking');

    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('barbers', BarberController::class)->except(['show']);

    Route::get('/queue', [QueueController::class, 'index'])->name('queue.index');
    Route::get('/queue/api-today', [QueueController::class, 'apiToday'])->name('queue.api-today');
    Route::patch('/queue/{booking}/status', [QueueController::class, 'updateStatus'])->name('queue.update-status');
    Route::get('/queue/walkin', [QueueController::class, 'walkin'])->name('queue.walkin');
    Route::post('/queue/walkin', [QueueController::class, 'storeWalkin'])->name('queue.store-walkin');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
