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
        Schema::create('public_events', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->text('title');
            $table->text('description')->nullable();
            $table->text('location');
            $table->string('location_url')->url()->nullable();
            // $table->foreignId('organisation_id')->constrained('organisations')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_events');
    }
};
