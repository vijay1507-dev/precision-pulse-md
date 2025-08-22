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
       Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');

            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->dateTime('appointment_date');
             $table->dateTime('appointment_time');
            $table->string('reason')->nullable();

            // JSON Columns
            $table->json('medical_history')->nullable();
            $table->json('family_history')->nullable();     
            $table->json('lifestyle')->nullable();   

            $table->enum('status', ['pending', 'approved', 'cancelled', 'completed'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
