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
        Schema::create('renter_details', function (Blueprint $table) {
            $table->string('renter_no', 5)->primary();
            $table->string('branch_no', 10)->nullable();
            $table->string('staff_no', 5)->nullable();
            
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            
            // Updated to be Nullable
            $table->string('address', 250)->nullable();
            $table->string('telephone_no', 20)->nullable();
            
            $table->string('pref_property', 50)->nullable();
            $table->decimal('max_rent', 10, 2)->nullable();
            $table->date('date')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->foreign('branch_no')->references('branch_no')->on('branches');
            $table->foreign('staff_no')->references('staff_no')->on('staff');
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
