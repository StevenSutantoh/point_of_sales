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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->increments('id_pembelian');
            $table->unsignedInteger('id_supplier');
            $table->string('tanggal',50);
            $table->integer('total_pembelian');
            $table->string('metode_pembayaran');
            $table->timestamps();

            $table->foreign('id_supplier')
                  ->references('id_supplier')
                  ->on('supplier')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
