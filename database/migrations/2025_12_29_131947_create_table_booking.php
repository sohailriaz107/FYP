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
        Schema::create('table_booking', function (Blueprint $table) {
            $table->id();
            $table->string("Guest");
            $table->string("RoomType");
            $table->integer("RoomNo");
            $table->Date("Check_in");
            $table->Date("Check_out");
            $table->integer("night");
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending','booked', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_booking');
    }
};
