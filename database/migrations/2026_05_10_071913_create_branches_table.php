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
        Schema::create('branch', function (Blueprint $table) {
            $table->string('branch_no', 10)->primary();
            $table->string('street', 255);
            $table->string('area', 100)->nullable();
            $table->string('city', 100);
            $table->string('postcode', 20);
            $table->string('telephone_no', 20);
            $table->string('fax_no', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch');
    }
};
