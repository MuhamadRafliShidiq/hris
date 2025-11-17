<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->string('employment_type')->default('full-time'); 
            $table->string('location')->nullable();
            $table->text('requirements')->nullable();
            $table->string('status')->default('open'); // open, closed
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
