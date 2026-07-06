<?php
// database/migrations/2026_07_05_000002_create_menu_items_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()
                ->constrained('menu_items')->cascadeOnDelete();

            $table->string('label');
            $table->enum('type', ['custom', 'route', 'category', 'article'])->default('custom');

            // custom link
            $table->string('url')->nullable();

            // internal route link
            $table->string('route_name')->nullable();
            $table->json('route_params')->nullable();

            // polymorphic-ish reference for category/article
            $table->unsignedBigInteger('linkable_id')->nullable();

            $table->string('icon')->nullable();
            $table->enum('target', ['_self', '_blank'])->default('_self');
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['menu_id', 'parent_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
