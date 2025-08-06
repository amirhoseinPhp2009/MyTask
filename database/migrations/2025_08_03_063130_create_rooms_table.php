<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hotel_id')->constrained('hotels');
            $table->foreignId('rate_plan_id')->constrained('rate_plans');

            //??
            $table->enum('room_type', ['Single', 'Double', 'Twin', 'Triple', 'Quad', 'Suite', 'Family Room', 'Deluxe', 'Accessible']);

            $table->string('room_number', 100)->unique();

            $table->text('description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
