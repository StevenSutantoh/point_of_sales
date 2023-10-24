<?php

use App\Http\Controllers\{
    DashboardController,
    LoginController,
    KategoriController,
    UserController,
    BarangController,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login-proses',[LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::get('/register',[LoginController::class, 'register'])->name('register');
Route::post('/register-proses',[LoginController::class, 'register_proses'])->name('register-proses');

Route::group(['prefix' => 'admin','middleware' => ['auth'], 'as' => 'admin.'], function(){

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');

    Route::get('/user', [UserController::class, 'index'])->name('user');
});



Route::resource('/kategori', KategoriController::class);

