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
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE table_booking MODIFY COLUMN status ENUM('pending', 'booked', 'cancelled', 'complete') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE table_booking MODIFY COLUMN status ENUM('pending', 'booked', 'cancelled') DEFAULT 'pending'");
    }
};
