<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\StaffController;
use App\Livewire\Pages\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class);

Route::get('/admin/dashboard', function () {
    return view('Admin.dashboard');
});

Route::get('/admin/staffs', [StaffController::class, 'index'])->name('staffs.index');
Route::get('/admin/staffs/create', [StaffController::class, 'create'])->name('staffs.create');
Route::post('/admin/staffs/create', [StaffController::class, 'store'])->name('staffs.store');
