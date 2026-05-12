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
        Schema::create('property_for_rent', function (Blueprint $table) {
            $table->string('property_no', 10)->primary();
            $table->string('branch_no', 10);
            $table->string('owner_no', 5);
            $table->string('staff_no', 5);
            $table->string('street', 100);
            $table->string('area', 50);
            $table->string('city', 50);
            $table->string('postcode', 10);
            $table->string('type_of_property', 20)->default('Flat');
            $table->integer('number_of_rooms')->unsigned();
            $table->decimal('monthly_rent', 10, 2);
            $table->string('status', 20)->default('Available');

            $table->foreign('branch_no')->references('branch_no')->on('branches');
            $table->foreign('staff_no')->references('staff_no')->on('staff');
            $table->foreign('owner_no')->references('owner_no')->on('owners');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_for_rents');
    }
};
