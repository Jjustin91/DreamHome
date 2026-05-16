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
        Schema::create('property_viewings', function (Blueprint $table) {
            $table->string('viewing_no', 10)->primary();
            $table->string('property_no', 10);
            $table->string('renter_no', 10); 
            $table->string('staff_no', 10);
            $table->date('viewing_date');
            $table->string('feedback', 255)->nullable();
            $table->timestamps();

            $table->foreign('property_no')->references('property_no')->on('property_for_rents');
            $table->foreign('renter_no')->references('renter_no')->on('renter_details');
            $table->foreign('staff_no')->references('staff_no')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_viewings');
    }
};
