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
        Schema::table('orders', function (Blueprint $table) {
            // Drop the existing enum column
            $table->dropColumn('payment_status');
        });
        
        Schema::table('orders', function (Blueprint $table) {
            // Add the new enum column with 'rejected' included
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded', 'rejected'])->default('pending')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the new enum column
            $table->dropColumn('payment_status');
        });
        
        Schema::table('orders', function (Blueprint $table) {
            // Restore the original enum column
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending')->after('status');
        });
    }
};
