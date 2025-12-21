<?php

use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HotalController;

// Authentication

Route::get('register',[AuthController::class,'Register'])->name('user.register');
Route::post('user/store',[AuthController::class,'store'])->name('user.store');
Route::get('login',[AuthController::class,'LoginForm'])->name('user.login');
Route::post('login',[AuthController::class,'login'])->name('login.submit');

// Hotal Room
Route::middleware('authcheck')->group(function () {
Route::get('/',[HotalController::class,'index'])->name('home');
Route::get('/room',[HotalController::class,'room'])->name('room');
Route::get('/room/1',[HotalController::class,'RoomSingle'])->name('room-single');
Route::get('/resturent',[HotalController::class,'Resturent'])->name('resturent');
Route::get('/about',[HotalController::class,'About'])->name('about');
Route::get('/contact',[HotalController::class,'Contact'])->name('contact');
Route::get('/profile',[HotalController::class,'Profile'])->name('profile');
});


// admin
Route::get('admin/dashboard',[DashboardController::class,'Dashboard'])->name('dashboard');
// room type list
Route::get('admin/rooms',[DashboardController::class,'Rooms'])->name('rooms');
Route::post('rooms/store',[RoomsController::class,'store'])->name('rooms.store');
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

Route::post('/amenities/toggle-status', [AmenitiesController::class, 'toggleStatus'])
    ->name('amenities.toggle');
