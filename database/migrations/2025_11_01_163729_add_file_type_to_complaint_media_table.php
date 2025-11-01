<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi: tambahkan kolom file_type
     */
    public function up(): void
    {
        Schema::table('complaint_media', function (Blueprint $table) {
            if (!Schema::hasColumn('complaint_media', 'file_type')) {
                $table->string('file_type')->default('image')->after('media_path');
            }
        });
    }

    /**
     * Kembalikan perubahan jika di-rollback
     */
    public function down(): void
    {
        Schema::table('complaint_media', function (Blueprint $table) {
            if (Schema::hasColumn('complaint_media', 'file_type')) {
                $table->dropColumn('file_type');
            }
        });
    }
};
