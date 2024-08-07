<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class,'register']);


Route::get('auth/register',[AuthController::class,'register']);
Route::post('/auth/register',[AuthController::class,'handleRegister'])->name('user.register');
Route::post('/auth/login',[AuthController::class,'handleLogin'])->name('user.login');


Route::middleware(['auth'])->group(function(){
    Route::post('logout',[DashboardController::class,'logout'])->name('admin.logout');
    Route::get('dasboard',[DashboardController::class,'dashboard'])->name('dashboard');
    Route::get('manage-data/{employe}',[DashboardController::class,'manageData'])->name('employe.manageData')->middleware('dataManager:ADD_DATA,EDIT_DATA');
});
