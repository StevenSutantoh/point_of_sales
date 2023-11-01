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
        Schema::create('detail_pembelians', function (Blueprint $table) {
            $table->increments('id_detail_pembelian');
            $table->unsignedInteger('id_pembelian');
            $table->unsignedInteger('id_barang');
            $table->integer('kuantitas');
            $table->integer('harga_beli');
            $table->timestamps();
            $table->foreign('id_pembelian')
                  ->references('id_pembelian')
                  ->on('pembelian')
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
        Schema::dropIfExists('detail_pembelians');
    }
};
