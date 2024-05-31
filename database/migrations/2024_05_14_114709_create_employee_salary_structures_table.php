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
        Schema::create('employee_salary_structures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->decimal('basic_salary', total: 10, places: 2);
            $table->decimal('ta', total: 10, places: 2)->nullable();
            $table->decimal('da', total: 10, places: 2)->nullable();
            $table->decimal('med', total: 10, places: 2)->nullable();
            $table->decimal('pf', total: 10, places: 2)->nullable();
            $table->decimal('others', total: 10, places: 2)->nullable();
            $table->decimal('gross_salary', total: 10, places: 2);
            $table->decimal('net_salary', total: 10, places: 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salary_structures');
    }
};
