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
        Schema::create('doctor_availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');

            $table->boolean('is_available')->default(true);
            $table->json('available_days')->nullable();     
            $table->date('available_from')->nullable();     
            $table->date('available_to')->nullable();      
            $table->time('start_time')->nullable();         
            $table->time('end_time')->nullable();           
            $table->unsignedSmallInteger('slot_duration')->default(30); 
            $table->enum('recurrence', ['none', 'daily', 'weekly'])->default('none');
            $table->json('blocked_dates')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_availabilities');
    }
};
