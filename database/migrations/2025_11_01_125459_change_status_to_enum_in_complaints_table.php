<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 🧹 Step 1: Ubah semua status lama ke salah satu nilai yang valid
        DB::table('complaints')
            ->whereNotIn('status', ['terkirim', 'diproses', 'selesai'])
            ->update(['status' => 'terkirim']);

        // 🧱 Step 2: Baru ubah struktur kolom jadi ENUM
        Schema::table('complaints', function (Blueprint $table) {
            $table->enum('status', ['terkirim', 'diproses', 'selesai'])
                ->default('terkirim')
                ->change();
        });
    }

    public function down(): void
    {
        // Kembalikan ke string biasa
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
        });
    }
};
