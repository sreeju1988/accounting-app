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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
                $table->string('subject');
        $table->text('description');
        $table->enum('type', ['general','service'])->default('general');
        $table->foreignId('service_booking_id')->nullable()->constrained('service_bookings')->onDelete('cascade');
        $table->foreignId('agent_id')->constrained('users')->onDelete('cascade');
        $table->enum('status', ['open','in_progress','resolved','closed'])->default('open');
        $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null'); // staff/admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
