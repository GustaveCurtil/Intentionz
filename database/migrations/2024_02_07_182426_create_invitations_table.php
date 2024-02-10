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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_event_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('invited_user_id')->constrained('users')->onDelete('cascade')->nullable();
            $table->text('invited_guest_name')->nullable();
            $table->boolean('is_going')->default(false);
            $table->boolean('is_not_going')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
