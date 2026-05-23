<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newspapers', function (Blueprint $table) {
            $table->string('newspaper_name', 100)->primary();
            $table->string('address', 250);
            $table->string('telephone_no', 20);
            $table->string('contact_name', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newspapers');
    }
};