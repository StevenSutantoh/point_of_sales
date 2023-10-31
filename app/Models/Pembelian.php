<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';
    protected $primaryKey = 'id_pembelian';
    protected $fillable = ['id_supplier', 'id_barang', 'tanggal', 'nama_barang', 'kuantitas', 'harga_beli','total_pembelian','metode_pembayaran'];
}
