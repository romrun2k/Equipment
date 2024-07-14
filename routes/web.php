<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EquipmentController;

Route::get('/home', function () {
    return view('welcome');
});

// auth
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginStore']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'store']);

Route::middleware(['isLogin'])->group(function () {
    //orders
    Route::resource('orders', OrderController::class);

    // admin
    Route::middleware(['isAdmin'])->group(function() {
        //employees
        Route::resource('employees', EmployeeController::class);

        //quipment
        Route::get('quipments/{quipment}/edit', [EquipmentController::class , 'edit'])->name('quipments.edit');
        Route::resource('quipments', EquipmentController::class);
    });
});

