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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('event_type'); // viewing, meeting, follow-up, site-visit, deadline, marketing, other
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('all_day')->default(false);
            $table->string('location')->nullable();
            
            // Relationships
            $table->foreignId('property_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Created by
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null'); // Assigned agent
            
            // Additional fields
            $table->string('status')->default('scheduled'); // scheduled, completed, cancelled, rescheduled
            $table->string('priority')->default('medium'); // low, medium, high
            $table->boolean('send_reminder')->default(true);
            $table->integer('reminder_minutes')->default(30); // Minutes before event
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
