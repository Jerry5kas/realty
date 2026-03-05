<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Make builder_id required
            $table->foreignId('builder_id')->nullable(false)->change();
            
            // Add foreign key constraint
            $table->foreign('builder_id')->references('id')->on('builders')->onDelete('restrict');
            
            // Drop old developer columns
            $table->dropColumn(['developer_name', 'developer_description', 'developer_logo']);
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Drop foreign key
            $table->dropForeign(['builder_id']);
            
            // Make builder_id nullable again
            $table->foreignId('builder_id')->nullable()->change();
            
            // Restore old developer columns
            $table->string('developer_name')->nullable()->after('highlights');
            $table->text('developer_description')->nullable()->after('developer_name');
            $table->string('developer_logo')->nullable()->after('developer_description');
        });
    }
};
