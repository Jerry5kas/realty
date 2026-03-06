<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('profile_image')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('profile_image');
            $table->integer('properties_sold')->default(0)->after('bio');
            $table->integer('properties_rented')->default(0)->after('properties_sold');
            $table->year('operating_since')->nullable()->after('properties_rented');
            $table->integer('buyers_served')->default(0)->after('operating_since');
            $table->boolean('is_featured')->default(false)->after('buyers_served');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'profile_image',
                'bio',
                'properties_sold',
                'properties_rented',
                'operating_since',
                'buyers_served',
                'is_featured'
            ]);
        });
    }
};
