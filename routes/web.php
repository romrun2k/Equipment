<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\MasterEquipmentController;

Route::get('/home', function () {
    return view('welcome');
});

// auth
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('check_login', [AuthController::class, 'check_login'])->name('check_login');
Route::get('register_form', [AuthController::class, 'registerForm'])->name('register_form');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::middleware(['isLogin'])->group(function () {
    Route::get('orderList/view_detail', [OrderListController::class, 'view_detail'])->name('orderList.view_detail');
    Route::resource('orderList', OrderListController::class);

    // admin
    Route::middleware(['isAdmin'])->group(function() {
        //employee
        Route::get('employee/view_detail', [EmployeeController::class, 'view_detail'])->name('employee.view_detail');
        Route::resource('employee', EmployeeController::class);

        //quipment
        Route::put('master_quipment/f_delete', [MasterEquipmentController::class , 'f_delete'])->name('master_quipment.f_delete');
        Route::get('master_quipment/editData', [MasterEquipmentController::class , 'editData'])->name('master_quipment.editData');
        Route::resource('master_quipment', MasterEquipmentController::class);
    });
});

