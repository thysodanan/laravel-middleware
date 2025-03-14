<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
Route::prefix('user')->group(function(){
    Route::middleware('guest.user')->group(function(){
        Route::get('/',[AuthController::class,'login'])->name('login');
        Route::get('/register',[AuthController::class,'register'])->name('register');
        Route::post('/register/process',[AuthController::class,'processRegister'])->name('register.process');
        Route::post('/login/process',[AuthController::class,'processLogin'])->name('login.process');
    
    });
    Route::middleware('auth.user')->group(function(){
        Route::get('/student',[DashboardController::class,'student'])->name('student');
        Route::get('/teacher',[DashboardController::class,'teacher'])->name('teacher');
        Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
    });
   
});
Route::prefix('admin')->group(function(){
    Route::middleware('guest.admin')->group(function(){
        Route::get('/',[AdminController::class,'loginAdmin'])->name('login.admin');
        Route::post('/login/process',[AdminController::class,'processLoginAdmin'])->name('login.admin.process');
    });
    Route::middleware('auth.admin')->group(function(){
        Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
        Route::get('/logout',[AdminController::class,'logoutAdmin'])->name('logout.admin');
    });
    
    
});
