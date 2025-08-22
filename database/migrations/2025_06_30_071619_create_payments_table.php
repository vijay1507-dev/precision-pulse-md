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
        Schema::create('payments', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('appointment_id')->constrained()->onDelete('cascade');

        $table->string('gateway')->default('stripe');        // stripe, razorpay, paypal
        $table->string('status')->default('pending');        // pending, paid, refunded
        $table->string('transaction_id')->nullable();        // PaymentIntent, razorpay_payment_id
        $table->string('gateway_reference')->nullable();     // Charge ID, refund ID
        $table->string('payment_method_type')->nullable();   // card, upi, cash
        $table->string('receipt_url')->nullable();
        $table->string('currency', 10)->default('USD');
        $table->integer('amount');                           // in paisa/cents
        $table->json('meta')->nullable();                    // Gateway-specific extras

        $table->timestamps();

        $table->index(['user_id', 'appointment_id']);
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
