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
        // Add image_path to owners table
        Schema::table('owners', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('telephone_no');
        });

        // Add image_path to property_for_rents table
        Schema::table('property_for_rents', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });

        Schema::table('property_for_rents', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};