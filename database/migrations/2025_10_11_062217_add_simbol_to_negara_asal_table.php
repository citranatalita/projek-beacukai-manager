<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('negara_asal', function (Blueprint $table) {
        $table->string('simbol', 5)->nullable();
        $table->string('kode_mata_uang', 10)->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('negara_asal', function (Blueprint $table) {
            //
        });
    }
};
