<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = ['id_kategori', 'id_stok', 'nama_barang', 'merk', 'kuantitas', 'harga_jual', 'stok', 'size'];
}
