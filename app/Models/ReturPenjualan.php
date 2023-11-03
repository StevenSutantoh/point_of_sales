<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturPenjualan extends Model
{
    use HasFactory;
    
    protected $table = 'retur_penjualan';
    protected $primaryKey = 'id_retur_penjualan';
    protected $fillable = ['id_customer','id_barang','tanggal','nama_barang' ,'kuantitas' ,'harga' ,'total'];
}
