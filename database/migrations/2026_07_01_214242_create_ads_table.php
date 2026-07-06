<?php
// database/migrations/xxxx_xx_xx_create_ads_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();

            // Where the ad appears
            $table->enum('slot', [
                'header_banner',
                'sidebar_top',
                'sidebar_bottom',
                'in_article',
                'footer_banner',
                'popup',
            ])->index();

            // How the ad is rendered
            $table->enum('type', ['image', 'script', 'html'])->default('image');

            $table->string('image_path')->nullable();
            $table->string('target_url')->nullable();
            $table->text('script_code')->nullable();   // for AdSense / ad-network scripts
            $table->text('html_code')->nullable();      // for raw HTML ad units

            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('open_new_tab')->default(true);
            $table->enum('status', ['active', 'inactive'])->default('active')->index();

            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();

            $table->unsignedBigInteger('impressions_count')->default(0);
            $table->unsignedBigInteger('clicks_count')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
