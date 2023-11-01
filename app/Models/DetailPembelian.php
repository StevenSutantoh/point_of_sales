<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $table = 'detail_pembelians';
    protected $primaryKey = 'id_detail_pembelian';
    protected $fillable = ['id_pembelian', 'id_supplier', 'id_barang', 'kuantitas', 'harga_beli'];
}
