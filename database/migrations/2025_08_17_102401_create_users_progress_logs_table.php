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
        Schema::create('users_progress_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_progress_id')->constrained('users_progress');
            $table->foreignId('user_id')->constrained('users');

            $table->date('last_review_date');

            $table->enum('last_review_status', ['learn', 'forget']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_progress_logs');
    }
};
