<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ---- Pages (read) ----
Route::get('/', [PageController::class, 'dashboard']);
Route::get('/reservation', [PageController::class, 'reservation']);
Route::get('/rooms', [PageController::class, 'rooms']);
Route::get('/housekeeping', [PageController::class, 'housekeeping']);
Route::get('/inventory', [PageController::class, 'inventory']);
Route::get('/calendar', [PageController::class, 'calendar']);
Route::get('/invoice', [PageController::class, 'invoice']);
Route::get('/expenses', [PageController::class, 'expenses']);
Route::get('/reviews', [PageController::class, 'reviews']);
Route::get('/concierge', [PageController::class, 'concierge']);
Route::get('/guest-profile', [PageController::class, 'guestProfile']);

// ---- Bookings / Reservation ----
Route::post('/bookings', [PageController::class, 'bookingStore']);
Route::post('/bookings/{id}/confirm', [PageController::class, 'bookingConfirm']);
Route::post('/bookings/{id}/status/{status}', [PageController::class, 'bookingStatus']);
Route::delete('/bookings/{id}', [PageController::class, 'bookingDestroy']);

// ---- Rooms ----
Route::post('/rooms', [PageController::class, 'roomStore']);
Route::delete('/rooms/{id}', [PageController::class, 'roomDestroy']);

// ---- Expenses ----
Route::post('/expenses', [PageController::class, 'expenseStore']);
Route::delete('/expenses/{id}', [PageController::class, 'expenseDestroy']);

// ---- Concierge ----
Route::post('/concierge', [PageController::class, 'conciergeStore']);
Route::delete('/concierge/{id}', [PageController::class, 'conciergeDestroy']);

// ---- Housekeeping ----
Route::post('/housekeeping', [PageController::class, 'hkStore']);
Route::post('/housekeeping/{id}', [PageController::class, 'hkUpdate']);
Route::delete('/housekeeping/{id}', [PageController::class, 'hkDestroy']);

// ---- Inventory ----
Route::post('/inventory', [PageController::class, 'invStore']);
Route::post('/inventory/{id}/reorder', [PageController::class, 'invReorder']);
Route::delete('/inventory/{id}', [PageController::class, 'invDestroy']);

// ---- Calendar ----
Route::post('/schedules', [PageController::class, 'scheduleStore']);

// ---- Dashboard Tasks ----
Route::post('/tasks', [PageController::class, 'taskStore']);
Route::post('/tasks/{id}/toggle', [PageController::class, 'taskToggle']);
