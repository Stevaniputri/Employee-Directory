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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NIK', 20)->nullable();
            $table->string('firstName', 255)->nullable();
            $table->string('lastName', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->char('gender', 1)->nullable();
            $table->string('placeOfBirth', 255)->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone', 20)->nullable();
            $table->unsignedInteger('jobTitleID')->nullable();
            $table->foreign('jobTitleID')->references('id')->on('job_titles')->onDelete('cascade');
            $table->date('hireDate')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
