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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
             $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->foreignId('id_negara_asal')->constrained('negara_asal')->onDelete('cascade');
            $table->boolean('is_completed')->default(false);
            $table->integer('jumlah_barang');
            $table->string('harga_barang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
