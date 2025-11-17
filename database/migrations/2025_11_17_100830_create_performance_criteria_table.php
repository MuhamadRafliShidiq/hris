<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performance_criteria', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // KPI: Attendance, Productivity, Teamwork
            $table->string('description')->nullable();
            $table->integer('weight')->default(0); // % weight
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance_criteria');
    }
};
