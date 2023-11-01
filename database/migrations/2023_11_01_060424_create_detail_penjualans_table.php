<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->increments('id_detail_penjualan');
            $table->unsignedInteger('id_penjualan');
            $table->unsignedInteger('id_barang');
            $table->integer('kuantitas');
            $table->integer('harga_jual');
            $table->timestamps();
            $table->foreign('id_penjualan')
                  ->references('id_penjualan')
                  ->on('penjualan')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreign('id_barang')
                  ->references('id_barang')
                  ->on('barang')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualans');
    }
};
