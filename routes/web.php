<?php

use App\Http\Controllers\SAdmin\HomeController;
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
Route::post('/super-admin/logout', [SAdminLoginController::class, 'logout'])->name('super-admin.logout');
Route::get('/super-admin/home', [HomeController::class, 'index'])->name('super-admin.home');


