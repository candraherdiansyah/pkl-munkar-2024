<?php

use App\Http\Controllers\FrontController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route Admin(Backend)
Route::group(['prefix' => 'admin', 'middleware' => ['auth', IsAdmin::class]], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    // untuk Route Backend Lainnya
    Route::resource('user', App\Http\Controllers\UsersController::class);
});

// Route Frontend
Route::get('/', [FrontController::class, 'index']);
Route::get('contact', [FrontController::class, 'contact']);