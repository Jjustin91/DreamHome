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
        Schema::create('property_inspections', function (Blueprint $table) {
            $table->string('property_no', 10);
            $table->string('staff_no', 5);
            $table->date('inspection_date');
            $table->text('comments')->nullable();
            $table->timestamps();

            // Composite Primary Key
            $table->primary(['property_no', 'inspection_date']);
            $table->foreign('property_no')->references('property_no')->on('property_for_rents');
            $table->foreign('staff_no')->references('staff_no')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_inspections');
    }
};
