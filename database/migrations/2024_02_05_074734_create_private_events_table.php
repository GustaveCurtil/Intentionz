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
        Schema::create('private_events', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->text('title');
            $table->text('description')->nullable();
            $table->text('location');
            $table->string('location_url')->url()->nullable();
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade');
            $table->string('slug')->unique();
            // $table->json('invited')->nullable();
            // $table->json('going')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_events');
    }
};
