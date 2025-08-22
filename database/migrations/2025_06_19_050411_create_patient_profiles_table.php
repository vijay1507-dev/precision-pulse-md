<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientProfilesTable extends Migration
{
    public function up(): void
    {
        Schema::create('patient_profiles', function (Blueprint $table) {
            $table->id();

            // Foreign key to the users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // PHI fields
            $table->date('date_of_birth')->nullable()->comment('Patient Date of Birth');
            $table->enum('gender', ['male', 'female', 'other', 'prefer_not_to_say'])->nullable();
            $table->string('phone_number')->nullable()->comment('Patient contact number in E.164 format');

            $table->integer('height_cm')->nullable()->comment('Patient height in centimeters');
            $table->float('weight_lbs', 5, 2)->nullable()->comment('Patient weight in pounds');

            // Secure path to profile image
            $table->string('profile_image')->nullable()->comment('Path to stored profile image');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_profiles');
    }
}

