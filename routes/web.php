<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class,'index']);
Route::post('/',[AuthController::class,'handleLogin'])->name('user.login');

Route::get('login',[AuthController::class,'index'])->name('login');

Route::middleware(['auth'])->group(function(){

Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::post('logout',[DashboardController::class,'handleLogout'])->name('admin.logout');

Route::get('edit-user-data/{employe}',[DashboardController::class,'manageData'])->name('admin.manageData')->middleware('dataManagerMiddle:ADD_DATA,EDIT_DATA');
});