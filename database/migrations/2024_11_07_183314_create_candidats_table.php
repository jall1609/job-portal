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
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('username')->unique();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->dateTime('date_of_birth');
            $table->string('city_name');
            $table->string('phone');
            $table->string('linkedin_link')->nullable();
            $table->string('profile_headline')->nullable();
            $table->float('current_salary',3)->nullable();
            $table->float('expected_salary',3)->nullable();
            $table->text('skill')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidats');
    }
};
