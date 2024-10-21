<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\StaffController;
use App\Http\Middleware\IsStaffExist;
use App\Livewire\Pages\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class);

Route::get('/admin/dashboard', function () {
    return view('Admin.dashboard');
});

Route::get('/admin/staffs', [StaffController::class, 'index'])->name('staffs.index');
Route::get('/admin/staffs/create', [StaffController::class, 'create'])->name('staffs.create');
Route::post('/admin/staffs/create', [StaffController::class, 'store'])->name('staffs.store');

Route::middleware([IsStaffExist::class])->group(function () {
    Route::get('/admin/staffs/edit/{staff}', [StaffController::class, 'edit'])->name('staffs.edit');
    Route::put('/admin/staffs/edit/{staff}', [StaffController::class, 'update'])->name('staffs.update');
    Route::get('/admin/staffs/{staff}', [StaffController::class, 'profile'])->name('staffs.profile');
    Route::delete('/admin/staffs/{staff}', [StaffController::class, 'delete'])->name('staffs.delete');
});
