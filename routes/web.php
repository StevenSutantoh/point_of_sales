<?php

use App\Http\Controllers\{
    DashboardController,
    LoginController,
    KategoriController,
    UserController,
    BarangController,
    CustomerController,
    PengeluaranController,
    SupplierController,
};
use App\Models\Pengeluaran;
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

Route::resource('roles', RoleController::class);
Route::group(['prefix' => 'admin','middleware' => ['auth'], 'as' => 'admin.'], function(){
    
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/barang',[BarangController::class,'index'])->name('barang');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/tambah_barang',[BarangController::class,'view_create'])->name('view_tambah_barang');

    Route::post('/tambah_barang_baru',[BarangController::class,'create'])->name('tambah_barang_baru');
    
    Route::get('settings',[UserController::class,'index'])->name('settings');
    Route::get('create_user',[UserController::class,'create'])->name('create_user');
    Route::get('show_user',[UserController::class,'show'])->name('show_user');
    Route::get('edit_user/{id}',[UserController::class,'edit'])->name('edit_user');
    Route::get('destroy_user',[UserController::class,'destroy'])->name('destroy_user');

    Route::patch('update_user/{id}',[UserController::class,'update'])->name('update_user');
    // Route::get();

    Route::post('store_user',[UserController::class,'store'])->name('store_user');
});


Route::resource('/kategori', KategoriController::class);

