<?php
// database/migrations/xxxx_xx_xx_create_media_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('disk')->default('public');
            $table->string('directory')->default('/');          // e.g. "articles/2026/07"
            $table->string('file_name');                          // stored file name (uuid.ext)
            $table->string('original_name');                      // original upload name
            $table->string('mime_type');
            $table->string('extension', 10);
            $table->unsignedBigInteger('size');                   // bytes, post-compression
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->string('alt_text')->nullable();
            $table->foreignId('uploaded_by')->nullable()
                ->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['directory']);
            $table->index(['mime_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
