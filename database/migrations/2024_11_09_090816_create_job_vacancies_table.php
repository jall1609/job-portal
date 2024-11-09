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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description');
            $table->text('requirement');
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->enum('contract_type', ['full-time', 'contract', 'intern']);
            $table->float('salary_min',3)->nullable();
            $table->float('salary_max',3)->nullable();
            $table->enum('job_type', ['WFH', 'WFO', 'hybrid'])->nullable();
            $table->string('location')->nullable();
            $table->dateTime('application_deadline')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
