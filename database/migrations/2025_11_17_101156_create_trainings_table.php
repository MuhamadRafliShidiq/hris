<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('trainer')->nullable();
            $table->date('date')->nullable();
            $table->string('location')->nullable();
            $table->string('type')->default('internal'); // internal / external
            $table->string('status')->default('scheduled'); // scheduled, completed, canceled
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
