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
        Schema::create('progress_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('progress_id')->constrained('complaint_progress')->onDelete('cascade');
            $table->text('file_url');
            $table->string('file_type', 20); // image / video
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_media');
    }
};
