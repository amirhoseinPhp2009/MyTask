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
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('origin_city_id')->constrained('locations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('destination_city_id')->constrained('locations')->onDelete('cascade')->onUpdate('cascade');


            $table->bigInteger('purchase_price');
            $table->bigInteger('sell_price');

            $table->string('tracking_code', 20)->unique();

            $table->date('check_in');
            $table->date('check_out');

            $table->tinyInteger('total_adult_count');
            $table->tinyInteger('total_children_count');

            $table->enum('status', ['cancelled_by_user', 'cancelled_by_admin', 'payment_faild', 'requested', 'rejected', 'expired', 'finalized', 'paid']);

            $table->timestamp('booked_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserves');
    }
};
