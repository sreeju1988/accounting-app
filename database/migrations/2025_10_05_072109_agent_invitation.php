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
         Schema::create('agent_invitations', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('role')->default('agent'); // can be reused for agents later
            $table->string('token')->unique();
            $table->timestamp('expires_at');
            $table->boolean('accepted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_invitations');
    }
};
