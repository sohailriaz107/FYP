<?php

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
Route::get('admin/rooms',[DashboardController::class,'Rooms'])->name('rooms');
Route::post('rooms/store',[RoomsController::class,'store'])->name('rooms.store');
Route::put('/rooms/{id}', [RoomsController::class, 'update'])->name('rooms.update');
Route::delete('/rooms/{id}', [RoomsController::class, 'destroy'])->name('rooms.destroy');
