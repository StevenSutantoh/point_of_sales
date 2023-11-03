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
    RoleController,
    PembelianController,
    PenjualanController,
    ReportController,
    ReturController,
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
    Route::get('/barang',[BarangController::class,'index'])->name('barang');
    Route::get('/add_size/{nama}',[BarangController::class,'view_add_size'])->name('add_size');
    Route::post('/add_size',[BarangController::class,'add_size'])->name('confirm_add_size');
    Route::get('/del_size/{id}/{size}',[BarangController::class,'del_size'])->name('hapus_size');


    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    

    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/tambah_barang',[BarangController::class,'view_create'])->name('view_tambah_barang');

    Route::post('/tambah_barang_baru',[BarangController::class,'create'])->name('tambah_barang_baru');
    
    Route::get('settings',[UserController::class,'index'])->name('settings');
    Route::get('create_user',[UserController::class,'create'])->name('create_user');
    Route::get('show_user/{id}',[UserController::class,'show'])->name('show_user');
    Route::get('edit_user/{id}',[UserController::class,'edit'])->name('edit_user');
    Route::delete('destroy_user/{id}',[UserController::class,'destroy'])->name('destroy_user');

    Route::patch('update_user/{id}',[UserController::class,'update'])->name('update_user');
    // Route::get();

    Route::post('store_user',[UserController::class,'store'])->name('store_user');
    
    // Pembelian Additional
    Route::get('add/{id}',[PembelianController::class,'add'])->name('pembelian.add');
    Route::post('add_item',[PembelianController::class,'add_item'])->name('pembelian.add_item');
    Route::get('hapus_detail/{id_detail}',[PembelianController::class,'del_item'])->name('pembelian.hapus_detail');

    //Penjualan Additional
    Route::post('next_page',[PenjualanController::class,'secondPageCreate'])->name('penjualan.next');
    Route::get('edit_item_penjualan/{id}',[PenjualanController::class,'editItem'])->name('penjualan.edit_item');
    Route::get('hapus_item_penjualan/{id}',[PenjualanController::class,'delItem'])->name('penjualan.destroy_item');
    Route::post('commit_edit_penjualan',[PenjualanController::class,'commitEdit'])->name('penjualan.commit_edit_change');

    //Laporan
    Route::get('report',[ReportController::class,'index'])->name('report');
    Route::get('report/type={type}',[ReportController::class,'detail'])->name('report_type');

    // Retur
    Route::get('retur_sales_index',[ReturController::class,'sales_index'])->name('retur_sales_index');
    Route::get('retur_sales_index/create',[ReturController::class,'sales_create'])->name('retur_sales.create');
    Route::post('retur_sales/secondPage',[ReturController::class,'sales_2ndPage'])->name('retur_sales.2nd_page');
    Route::post('retur_sales/thirdPage',[ReturController::class,'sales_3rdPage'])->name('retur_sales.3rd_page');
    Route::get('retur_sales/confirmRetur/{id}',[ReturController::class,'confirmRetur'])->name('retur_sales.confirm_retur');

    Route::get('retur_purchase_index',[ReturController::class,'purchase_index'])->name('retur_purchase_index');
    Route::get('retur_purchase_index/create',[ReturController::class,'purchase_create'])->name('retur_purchase.create');
    Route::post('retur_purchase/secondPage',[ReturController::class,'purchase_2ndPage'])->name('retur_purchase.2nd_page');
    Route::post('retur_purchase/thirdPage',[ReturController::class,'purchase_3rdPage'])->name('retur_purchase.3rd_page');
    Route::get('retur_purchase/confirmRetur2/{id}',[ReturController::class,'confirmRetur2'])->name('retur_purchase.confirm_retur');

});


Route::resource('/kategori', KategoriController::class);
Route::resource('/supplier', SupplierController::class);
Route::resource('/customer', CustomerController::class);
Route::resource('/pengeluaran', PengeluaranController::class);
Route::resource('roles', RoleController::class);
Route::resource('pembelian', PembelianController::class);
Route::resource('penjualan', PenjualanController::class);