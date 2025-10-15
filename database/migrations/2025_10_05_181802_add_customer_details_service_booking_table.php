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
        Schema::table('service_bookings', function (Blueprint $table) {
           $table->string('client_first_name');
           $table->string('client_last_name');
           $table->string('client_phone')->nullable();
           $table->enum('status', ['Pending', 'Documents Pending', 'Under Review','Waiting for Payment', 'In Progress', 'Completed', 'Cancelled'])->default('Pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->dropColumn(['client_first_name', 'client_last_name', 'client_phone', 'status']);
        });
    }
};
