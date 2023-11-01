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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->increments('id_penjualan');
            $table->string('tanggal',50);
            $table->unsignedInteger('id_customer');
            $table->integer('total_penjualan');
            $table->string('metode_pembayaran');
            $table->string('status_pembayaran');
            $table->timestamps();
            $table->foreign('id_customer')
                  ->references('id_customer')
                  ->on('customer')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
