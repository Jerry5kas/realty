<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->foreignId('builder_id')->nullable()->after('project_id')->constrained()->onDelete('set null');
            $table->index('builder_id');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['builder_id']);
            $table->dropIndex(['builder_id']);
            $table->dropColumn('builder_id');
        });
    }
};
