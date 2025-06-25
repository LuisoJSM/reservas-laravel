<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Booking\CancelSlotBookingController;
use App\Http\Controllers\Booking\CreateSlotBookingController;
use App\Http\Controllers\Booking\ListAvailableBusinessesController;
use App\Http\Controllers\Booking\UserBookingsController;
use App\Http\Controllers\Booking\ShowBusinessSlotsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get(
        uri: '/businesses',
        action: ListAvailableBusinessesController::class
    )->name('businesses.list');

    Route::get(
        uri: '/slots/{business}/{year}/{month}/{day}',
        action: ShowBusinessSlotsController::class
    )->name('slots.show');

    Route::post(
        uri: '/slots/{business}/{slot}/book',
        action: CreateSlotBookingController::class
    )->name('slots.book');

    Route::post(
        uri: '/slots/{business}/{booking}/cancel',
        action: CancelSlotBookingController::class
    )->name('bookings.cancel');

    Route::get(
        uri: '/my-bookings',
        action: UserBookingsController::class
    )->name('user.bookings');
});



Route::get('/businesses', ListAvailableBusinessesController::class)
    ->name('businesses.list');

require __DIR__.'/auth.php';
