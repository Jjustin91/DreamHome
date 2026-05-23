<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_adverts', function (Blueprint $table) {
            $table->string('property_no', 10);
            $table->string('newspaper_name', 100);
            $table->date('date_advertised');
            $table->decimal('cost', 10, 2);
            $table->timestamps();

            // Composite Primary Key
            $table->primary(['property_no', 'newspaper_name', 'date_advertised']);
            $table->foreign('property_no')->references('property_no')->on('property_for_rents')->onDelete('cascade');
            $table->foreign('newspaper_name')->references('newspaper_name')->on('newspapers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_adverts');
    }
};