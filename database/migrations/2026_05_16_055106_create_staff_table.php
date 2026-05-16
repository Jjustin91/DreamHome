<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // 1. Build the table and all columns first
        Schema::create('staff', function (Blueprint $table) {
            $table->string('staff_no', 5)->primary();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('address', 250);
            $table->string('telephone_no', 20);
            $table->char('sex', 1);
            $table->date('date_of_birth');
            $table->string('nin', 20);
            $table->string('job_title', 50);
            $table->decimal('salary', 12, 2);
            $table->date('date_joined');
            $table->date('end_date')->nullable();
            
            $table->date('manager_start_date')->nullable();
            $table->decimal('car_allowance', 10, 2)->nullable();
            $table->decimal('bonus_payment', 10, 2)->nullable();
            $table->integer('typing_speed')->nullable();

            $table->string('branch_no', 10);
            $table->string('supervisor_no', 5)->nullable();
            $table->timestamps();

            // Foreign key to a DIFFERENT table can stay inside the create block
            $table->foreign('branch_no')->references('branch_no')->on('branches')->onDelete('restrict');
        });

        // 2. Add the self-referencing foreign key AFTER the table is fully created
        Schema::table('staff', function (Blueprint $table) {
            $table->foreign('supervisor_no')->references('staff_no')->on('staff')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
