<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupplierController;
use App\Http\Middleware\IsStaffExist;
use App\Livewire\Pages\Welcome;
use App\Models\Product;
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


Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/admin/products/create', [ProductController::class, 'store'])->name('products.store');

Route::get('/admin/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
Route::post('/admin/suppliers/create', [SupplierController::class, 'store'])->name('suppliers.store');

Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::put('/admin/categories/create', [CategoryController::class, 'store'])->name('categories.store');
