<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('type', ['property', 'project', 'mixed'])->default('mixed');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('is_featured')->default(false);
            $table->integer('display_order')->default(0);
            
            // Filter criteria stored as JSON
            $table->json('filters')->nullable();
            
            // Manual items (if not using filters)
            $table->json('manual_items')->nullable();
            
            // Display settings
            $table->integer('items_limit')->default(12);
            $table->enum('sort_by', ['created_at', 'price', 'title', 'manual'])->default('created_at');
            $table->enum('sort_order', ['asc', 'desc'])->default('desc');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
