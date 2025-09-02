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
        Schema::create('users_progress', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('question_card_id')->constrained('question_cards')->onDelete('cascade')->onUpdate('cascade');

            $table->date('last_review_date');
            $table->enum('last_review_status', ['learn', 'forget']);

            $table->date('next_review_date');

            $table->integer('review_count')->default(0);
            $table->integer('interval');

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_progress');
    }
};
