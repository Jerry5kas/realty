<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('highlights')->nullable();
            
            // Developer/Builder
            $table->string('developer_name');
            $table->text('developer_description')->nullable();
            $table->string('developer_logo')->nullable();
            
            // Project details
            $table->enum('project_type', ['residential', 'commercial', 'mixed'])->default('residential');
            $table->enum('status', ['upcoming', 'under-construction', 'ready-to-move', 'completed'])->default('under-construction');
            $table->date('launch_date')->nullable();
            $table->date('possession_date')->nullable();
            $table->integer('completion_percentage')->default(0);
            
            // Units
            $table->integer('total_units')->nullable();
            $table->integer('available_units')->nullable();
            $table->integer('total_towers')->nullable();
            $table->integer('total_floors')->nullable();
            
            // Area
            $table->decimal('total_area', 15, 2)->nullable();
            $table->decimal('min_price', 15, 2)->nullable();
            $table->decimal('max_price', 15, 2)->nullable();
            $table->string('price_range')->nullable();
            
            // Location
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->string('locality')->nullable();
            $table->text('address')->nullable();
            $table->string('pincode', 10)->nullable();
            $table->string('latitude', 25)->nullable();
            $table->string('longitude', 25)->nullable();
            
            // Legal
            $table->string('rera_number')->nullable();
            $table->date('rera_valid_till')->nullable();
            $table->json('approved_banks')->nullable();
            
            // Media
            $table->json('images')->nullable();
            $table->string('brochure_url')->nullable();
            $table->string('video_url')->nullable();
            $table->string('master_plan_image')->nullable();
            
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            
            // Status
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->integer('views')->default(0);
            $table->enum('publish_status', ['draft', 'published', 'inactive'])->default('draft');
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['city_id', 'publish_status']);
            $table->index(['status', 'project_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
