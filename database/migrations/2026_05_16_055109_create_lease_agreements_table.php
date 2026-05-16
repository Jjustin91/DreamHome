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
        Schema::create('lease_agreements', function (Blueprint $table) {
            $table->string('lease_no', 5)->primary();
            $table->string('property_no', 10);
            $table->string('renter_no', 5);
            $table->string('staff_no', 5);
            $table->decimal('monthly_rent', 10, 2);
            $table->string('payment_method', 20)->nullable();
            $table->decimal('deposit_amount', 10, 2)->nullable();
            $table->boolean('deposit_paid')->default(false);
            $table->date('rent_start');
            $table->date('rent_finish')->nullable();
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
        Schema::dropIfExists('lease_agreements');
    }
};
