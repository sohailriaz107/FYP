<?php

use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HotalController;
use App\Http\Controllers\User\ReviewController;

// Authentication

Route::get('register', [AuthController::class, 'Register'])->name('user.register');
Route::post('user/store', [AuthController::class, 'store'])->name('user.store');
Route::get('login', [AuthController::class, 'LoginForm'])->name('user.login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');

// Hotal Room
Route::middleware('authcheck')->group(function () {
    Route::get('/', [HotalController::class, 'index'])->name('home');
    Route::get('/room', [HotalController::class, 'room'])->name('room');
    Route::get('/room/{id}', [HotalController::class, 'RoomSingle'])->name('room-single');
    Route::get('/resturent', [HotalController::class, 'Resturent'])->name('resturent');
    Route::get('/about', [HotalController::class, 'About'])->name('about');
    Route::get('/contact', [HotalController::class, 'Contact'])->name('contact');
    Route::get('/profile', [HotalController::class, 'Profile'])->name('profile');
    Route::post('/profile/update', [HotalController::class, 'UpdateProfile'])->name('profile.update');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::post('/booking/cancel/{id}', [HotalController::class, 'CancelBooking'])->name('booking.cancel');
    Route::post('/check-availability', [HotalController::class, 'checkAvailability'])->name('check.availability');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
});


use App\Http\Controllers\UserController;

// admin
Route::get('admin/dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');
// room type list
Route::get('admin/rooms', [DashboardController::class, 'Rooms'])->name('rooms');
Route::get('admin/testimonial', [DashboardController::class, 'Testimonials'])->name('testimonials.index');
Route::put('admin/testimonial/{id}', [DashboardController::class, 'testimonialUpdate'])->name('testimonials.update');
Route::delete('admin/testimonial/{id}', [DashboardController::class, 'testimonialDestroy'])->name('testimonials.destroy');

// Guest management
Route::get('admin/guests', [UserController::class, 'index'])->name('guests.index');
Route::put('admin/guests/{id}', [UserController::class, 'update'])->name('guests.update');
Route::delete('admin/guests/{id}', [UserController::class, 'destroy'])->name('guests.destroy');
Route::post('rooms/store', [RoomsController::class, 'store'])->name('rooms.store');
Route::put('/rooms/{id}', [RoomsController::class, 'update'])->name('rooms.update');
Route::delete('/rooms/{id}', [RoomsController::class, 'destroy'])->name('rooms.destroy');

//Available Rooms 
Route::get('/roomslist', [RoomsController::class, 'RoomsList'])->name('rooms.list');
Route::post('/roomslist/store', [RoomsController::class, 'RoomStore'])->name('rooms.liststore');
Route::put('/roomslist/{id}', [RoomsController::class, 'RoomUpdate'])->name('rooms.listupdate');
Route::delete('/roomslist/{id}', [RoomsController::class, 'RoomDestroy'])->name('rooms.listdestroy');

// Amenites
Route::get('/amenties', [AmenitiesController::class, 'index'])->name('amenties.index');
Route::post('/amenties', [AmenitiesController::class, 'store'])->name('amenties.store');
Route::put('/amenties/{id}', [AmenitiesController::class, 'update'])->name('amenties.update');
Route::delete('/amenties/{id}', [AmenitiesController::class, 'destroy'])->name('amenties.destroy');

Route::post('/amenities/toggle-status', [AmenitiesController::class, 'toggleStatus'])->name('amenities.toggle');


    // Booking

    Route::get('/booking', [BookingController::class, 'Index'])->name('Booking.index');
    Route::post('/booking/post', [BookingController::class, 'post'])->name('Booking.post');
    Route::put('/booking/status/{id}', [BookingController::class, 'UpdateStatus'])->name('Booking.status');
    Route::delete('/booking/delete/{id}', [BookingController::class, 'Destroy'])->name('Booking.destroy');
