<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('type', ['sale', 'rent', 'lease', 'pg'])->default('sale');
            $table->enum('category', ['residential', 'commercial', 'land'])->default('residential');
            $table->string('property_type')->nullable(); // apartment, villa, office, etc.
            
            // Pricing
            $table->decimal('price', 15, 2);
            $table->decimal('price_per_sqft', 10, 2)->nullable();
            $table->decimal('maintenance_charges', 10, 2)->nullable();
            $table->string('maintenance_period')->nullable(); // monthly, quarterly, yearly
            $table->decimal('security_deposit', 15, 2)->nullable();
            
            // Area details
            $table->decimal('carpet_area', 10, 2)->nullable();
            $table->decimal('built_up_area', 10, 2)->nullable();
            $table->decimal('super_built_up_area', 10, 2)->nullable();
            $table->string('area_unit')->default('sqft');
            
            // Property details
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('balconies')->nullable();
            $table->integer('floor_number')->nullable();
            $table->integer('total_floors')->nullable();
            $table->enum('furnishing_status', ['furnished', 'semi-furnished', 'unfurnished'])->nullable();
            $table->enum('facing', ['north', 'south', 'east', 'west', 'north-east', 'north-west', 'south-east', 'south-west'])->nullable();
            $table->integer('parking_covered')->default(0);
            $table->integer('parking_open')->default(0);
            $table->integer('age_of_property')->nullable(); // in years
            
            // Location
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->string('locality')->nullable();
            $table->text('address')->nullable();
            $table->string('pincode', 10)->nullable();
            $table->string('latitude', 25)->nullable();
            $table->string('longitude', 25)->nullable();
            
            // Legal & Compliance
            $table->string('rera_number')->nullable();
            $table->enum('possession_status', ['ready-to-move', 'under-construction', 'upcoming'])->default('ready-to-move');
            $table->date('possession_date')->nullable();
            $table->date('available_from')->nullable();
            
            // Media
            $table->json('images')->nullable();
            $table->string('video_url')->nullable();
            $table->string('virtual_tour_url')->nullable();
            
            // Relations
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // owner/agent
            
            // Status
            $table->enum('status', ['draft', 'published', 'sold', 'rented', 'inactive'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->integer('views')->default(0);
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['type', 'category', 'status']);
            $table->index(['city_id', 'status']);
            $table->index('price');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
