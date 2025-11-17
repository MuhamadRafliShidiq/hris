<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approval_flows', function (Blueprint $table) {
            $table->id();
            $table->string('module'); // leave, overtime, payroll
            $table->unsignedInteger('level'); // approval level 1, 2
            $table->foreignId('approver_id')->constrained('users')->onDelete('cascade');
            $table->string('role')->nullable(); // Manager, HRD
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_flows');
    }
};
