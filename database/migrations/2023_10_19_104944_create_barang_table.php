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
        Schema::create('barang', function (Blueprint $table) {
            $table->increments('id_barang');
            $table->integer('id_kategori');
            $table->integer('id_stok');
            $table->string('nama_barang')->unique();
            $table->string('merk')->nullable();
            $table->integer('kuantitas');
            $table->integer('harga_jual');
            $table->integer('stok');
            $table->timestamps();
            $table->foreign('id_kategori')
                  ->references('kategori')
                  ->on('id_kategori')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    // /**
    //  * Run the migrations.
    //  * 
    //  * @return void
    //  */
    // public function up()
    // {
    //     Schema::table('produk', function (Blueprint $table) {
    //         $table->unsignedInteger('id_kategori')->change();
    //         $table->foreign('id_kategori')
    //               ->references('id_kategori')
    //               ->on('kategori')
    //               ->onUpdate('restrict')
    //               ->onDelete('restrict');
    //     });
    // }
    

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down()
    {
        // Schema::table('barang', function (Blueprint $table) {
        //     $table->integer('id_kategori')->change();
        //     $table->dropForeign('barang_id_kategori_foreign');
        // });
        Schema::dropIfExists('barang');
    }
};
