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
        Schema::table('service_certificates', function (Blueprint $table) {
            $table->string('file_title')->nullable()->after('service_booking_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_certificates', function (Blueprint $table) {
            $table->dropColumn('file_title');
        });
    }
};
