<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('kode_barang')->nullable();
            $table->string('kode_kategori')->nullable();
            $table->string('nama_barang')->nullable();
            $table->string('merk')->nullable();
            $table->string('kuantitas')->nullable();
            $table->float('harga_beli')->nullable();
            $table->float('harga_jual')->nullable();
            $table->string('stok')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('barangs');
    }
}
