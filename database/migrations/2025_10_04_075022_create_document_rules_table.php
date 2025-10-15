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
        Schema::create('document_rules', function (Blueprint $table) {
              $table->id();
        $table->string('name'); // Aadhaar Front, PAN, etc.
        $table->string('formats'); // e.g. jpg,png,pdf (hardcoded dropdown)
        $table->integer('max_size'); // in MB
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_rules');
    }
};
