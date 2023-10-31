<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'pembelian';
    protected $primaryKey = 'id_penjualan';
    protected $fillable = ['id_customer', 'id_barang', 'tanggal', 'nama_barang', 'kuantitas', 'harga_jual','total_penjualan','status_pembayaran'];
}
