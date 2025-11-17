<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('benefit_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // BPJS full, Asuransi Gold
            $table->text('description')->nullable();
            $table->decimal('company_cost', 10, 2)->default(0);
            $table->decimal('employee_cost', 10, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('benefit_packages');
    }
};
