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
        Schema::create('service_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_booking_id')->constrained('service_bookings')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_mode', ['cash', 'bank_transfer', 'upi', 'other'])->default('cash');
            $table->string('remarks')->nullable();
            $table->date('payment_date');
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');
            $table->text('note')->nullable(); // for edits/deletions
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_payments');
    }
};
