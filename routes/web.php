<?php

use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/user_list', [UserController::class, 'index'])->name('user_list');
Route::get('/create', [UserController::class, 'create'])->name('user_create');
Route::post('/store', [UserController::class, 'store'])->name('user_store');
Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user_edit');
Route::put('/update/{id}', [UserController::class, 'update'])->name('user_update');
Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user_delete');
Route::get('/show/{id}', [UserController::class, 'showProfile'])->name('profile_show');
Route::get('/home',[UserController::class,'home'])->name('home');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}',[ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/export-users', [UserController::class, 'export'])->name('export.users');


Route::get('/profile/update', [UserController::class, 'showUpdateProfileForm'])->name('profile_edit')->middleware('auth');
Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile_update')->middleware('auth');
