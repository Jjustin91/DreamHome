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
        Schema::create('next_of_kins', function (Blueprint $table) {
            $table->string('staff_no', 5)->primary(); // Serves as both PK and FK
            $table->string('full_name', 100);
            $table->string('relationship', 50);
            $table->string('address', 255);
            $table->string('telephone_no', 20);
            $table->timestamps();

            $table->foreign('staff_no')->references('staff_no')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('next_of_kins');
    }
};
