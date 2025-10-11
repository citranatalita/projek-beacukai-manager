<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('negara_asal', function (Blueprint $table) {
            $table->string('simbol', 10)->nullable()->after('nama_negara');
            $table->string('kode_mata_uang', 10)->nullable()->after('simbol');
        });
    }

    public function down(): void
    {
        Schema::table('negara_asal', function (Blueprint $table) {
            $table->dropColumn(['simbol', 'kode_mata_uang']);
        });
    }
};
