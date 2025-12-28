<?php

use App\Http\Controllers\SAdmin\BrandController;
use App\Http\Controllers\SAdmin\HomeController;
use App\Http\Controllers\SAdmin\ProductController;
use App\Http\Controllers\SAdmin\SAdminLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//super admin routes
Route::get('/super-admin', [ SAdminLoginController::class, 'showLoginForm'])->name('super-admin');
Route::get('/super-admin/login', [SAdminLoginController::class, 'showLoginForm'])->name('super-admin.login');
Route::post('/super-admin/login', [SAdminLoginController::class, 'login'])->name('super-admin.login');

Route::middleware(['role:'.\App\Models\User::ROLE_SUPER_ADMIN])->group(function () {
    Route::post('/super-admin/logout', [SAdminLoginController::class, 'logout'])->name('super-admin.logout');
    Route::get('/super-admin/home', [HomeController::class, 'index'])->name('super-admin.home');

    //s.admin product routes
    Route::get('/super-admin/product', [ProductController::class, 'index'])->name('super-admin.product.list');
    Route::match(['get', 'post'], '/super-admin/product/add', [ProductController::class, 'add'])->name('super-admin.product.add');
    Route::get('/super-admin/product/edit/{id}', [ProductController::class, 'edit'])->name('super-admin.product.edit');
    Route::post('/super-admin/product/update/{id}', [ProductController::class, 'update'])->name('super-admin.product.update');
    Route::get('/super-admin/product/delete/{id}', [ProductController::class, 'delete'])->name('super-admin.product.delete');

//s.admin brand routes
    Route::get('/super-admin/brand', [BrandController::class, 'index'])->name('super-admin.brand.list');
    Route::match(['get', 'post'], '/super-admin/brand/add', [BrandController::class, 'add'])->name('super-admin.brand.add');
    Route::get('/super-admin/brand/edit/{id}', [BrandController::class, 'edit'])->name('super-admin.brand.edit');
    Route::post('/super-admin/brand/update/{id}', [BrandController::class, 'update'])->name('super-admin.brand.update');
    Route::get('/super-admin/brand/delete/{id}', [BrandController::class, 'delete'])->name('super-admin.brand.delete');

});
