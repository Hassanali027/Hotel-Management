<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Application (requires login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ---- Read pages: all roles ----
    Route::get('/', [PageController::class, 'dashboard']);
    Route::get('/reservation', [PageController::class, 'reservation']);
    Route::get('/housekeeping', [PageController::class, 'housekeeping']);
    Route::get('/inventory', [PageController::class, 'inventory']);
    Route::get('/calendar', [PageController::class, 'calendar']);
    Route::get('/guest-profile', [PageController::class, 'guestProfile']);

    // ---- Operational actions: all roles ----
    Route::post('/bookings/{id}/confirm', [PageController::class, 'bookingConfirm']);
    Route::post('/bookings/{id}/status/{status}', [PageController::class, 'bookingStatus']);
    Route::post('/housekeeping/{id}', [PageController::class, 'hkUpdate']);
    Route::post('/inventory/{id}/add-stock', [PageController::class, 'invAddStock']);
    Route::post('/tasks/{id}/toggle', [PageController::class, 'taskToggle']);

    // ---- Admin + Manager: restricted pages + create/edit ----
    Route::middleware('role:admin,manager')->group(function () {
        Route::get('/rooms', [PageController::class, 'rooms']);
        Route::get('/invoice', [PageController::class, 'invoice']);
        Route::get('/expenses', [PageController::class, 'expenses']);
        Route::get('/reviews', [PageController::class, 'reviews']);
        Route::get('/concierge', [PageController::class, 'concierge']);

        Route::post('/bookings', [PageController::class, 'bookingStore']);
        Route::post('/rooms', [PageController::class, 'roomStore']);
        Route::put('/rooms/{id}', [PageController::class, 'roomUpdate']);
        Route::post('/expenses', [PageController::class, 'expenseStore']);
        Route::get('/expenses/{id}/download', [PageController::class, 'expenseDownload']);
        Route::post('/concierge', [PageController::class, 'conciergeStore']);
        Route::post('/housekeeping', [PageController::class, 'hkStore']);
        Route::post('/inventory', [PageController::class, 'invStore']);
        Route::post('/schedules', [PageController::class, 'scheduleStore']);
        Route::post('/tasks', [PageController::class, 'taskStore']);
        Route::post('/invoices/{id}/toggle', [PageController::class, 'invoiceToggle']);
        Route::get('/invoices/{id}/download', [PageController::class, 'invoiceDownload']);
    });

    // ---- Admin only: deletes ----
    Route::middleware('role:admin')->group(function () {
        Route::delete('/bookings/{id}', [PageController::class, 'bookingDestroy']);
        Route::delete('/rooms/{id}', [PageController::class, 'roomDestroy']);
        Route::delete('/expenses/{id}', [PageController::class, 'expenseDestroy']);
        Route::delete('/concierge/{id}', [PageController::class, 'conciergeDestroy']);
        Route::delete('/housekeeping/{id}', [PageController::class, 'hkDestroy']);
        Route::delete('/inventory/{id}', [PageController::class, 'invDestroy']);
    });
});
