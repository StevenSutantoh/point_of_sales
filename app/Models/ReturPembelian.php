<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturPembelian extends Model
{
    use HasFactory;

    protected $table = 'retur_pembelian';
    protected $primaryKey = 'id_retur_pembelian';
    protected $fillable = ['id_supplier','id_barang','tanggal','nama_barang' ,'kuantitas' ,'harga' ,'total'];
}
