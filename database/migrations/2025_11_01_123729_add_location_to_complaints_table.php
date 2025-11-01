<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom lokasi ke tabel complaints.
     */
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('location')->nullable()->after('content');
        });
    }

    /**
     * Hapus kolom lokasi saat rollback.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('location');
        });
    }
};
