<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('builders', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 255);
            $table->string('slug', 255)->unique();
            $table->string('logo_url', 500)->nullable();
            $table->text('description')->nullable();
            $table->string('contact_person_name', 255)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('website', 500)->nullable();
            $table->string('rera_registration_number', 100)->nullable();
            $table->year('established_year')->nullable();
            $table->integer('total_projects_completed')->unsigned()->default(0)->nullable();
            $table->string('facebook_url', 500)->nullable();
            $table->string('instagram_url', 500)->nullable();
            $table->string('linkedin_url', 500)->nullable();
            $table->string('twitter_url', 500)->nullable();
            $table->text('office_address')->nullable();
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('status');
            $table->index('is_featured');
            $table->index('city_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('builders');
    }
};
