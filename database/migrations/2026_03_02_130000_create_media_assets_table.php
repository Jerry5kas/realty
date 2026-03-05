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
        Schema::create('media_assets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_url');
            $table->string('file_type')->default('image'); // image, icon, document, video
            $table->string('category')->nullable(); // property, project, banner, general
            $table->text('description')->nullable();
            $table->string('file_size')->nullable(); // in KB
            $table->string('dimensions')->nullable(); // e.g., 1920x1080
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_assets');
    }
};
