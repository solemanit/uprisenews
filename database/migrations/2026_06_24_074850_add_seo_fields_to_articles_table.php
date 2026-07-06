<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // SEO Meta
            $table->string('seo_title', 70)->nullable()->after('body')
                ->comment('Browser tab / Google title — max 70 chars');
            $table->string('seo_description', 160)->nullable()->after('seo_title')
                ->comment('Meta description shown in SERPs — max 160 chars');
            $table->string('seo_keywords', 255)->nullable()->after('seo_description')
                ->comment('Comma-separated keywords');
            // Canonical
            $table->string('canonical_url')->nullable()
                ->comment('Override canonical URL; null = self-referencing');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn([
                'seo_title',
                'seo_description',
                'seo_keywords',
                'canonical_url',
            ]);
        });
    }
};
