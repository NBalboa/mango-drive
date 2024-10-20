<?php

use App\Http\Controllers\CashierController;
use App\Livewire\Pages\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class);

Route::get('/admin/dashboard', function () {
    return view('Admin.dashboard');
});

Route::get('/admin/cashiers', [CashierController::class, 'index'])->name('cashiers.index');
Route::get('/admin/cashiers/create', [CashierController::class, 'create'])->name('cashiers.create');
Route::post('/admin/cashiers/create', [CashierController::class, 'store'])->name('cashiers.store');
