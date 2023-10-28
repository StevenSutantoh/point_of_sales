<?php

use App\Http\Controllers\{
    DashboardController,
    LoginController,
    KategoriController,
    UserController,
    BarangController,
    CustomerController,
    SupplierController,
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
    Route::resource('roles', RoleController::class);
    
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/barang',[BarangController::class,'index'])->name('barang');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/tambah_barang',[BarangController::class,'view_create'])->name('view_tambah_barang');

    Route::post('/tambah_barang_baru',[BarangController::class,'create'])->name('tambah_barang_baru');
    
    Route::get('settings',[UserController::class,'view_settings'])->name('settings');
});


Route::resource('/kategori', KategoriController::class);

