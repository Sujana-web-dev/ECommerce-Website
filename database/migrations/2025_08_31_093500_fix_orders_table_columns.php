<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add columns using raw SQL to avoid issues
        try {
            DB::statement("ALTER TABLE orders ADD COLUMN name VARCHAR(255) AFTER user_id");
        } catch (\Exception $e) {
            // Column might already exist
        }
        
        try {
            DB::statement("ALTER TABLE orders ADD COLUMN email VARCHAR(255) AFTER name");
        } catch (\Exception $e) {
            // Column might already exist
        }
        
        try {
            DB::statement("ALTER TABLE orders ADD COLUMN phone VARCHAR(255) AFTER email");
        } catch (\Exception $e) {
            // Column might already exist
        }
        
        try {
            DB::statement("ALTER TABLE orders ADD COLUMN address TEXT AFTER phone");
        } catch (\Exception $e) {
            // Column might already exist
        }
        
        try {
            DB::statement("ALTER TABLE orders ADD COLUMN delivery_option VARCHAR(255) AFTER address");
        } catch (\Exception $e) {
            // Column might already exist
        }
        
        try {
            DB::statement("ALTER TABLE orders ADD COLUMN total DECIMAL(10,2) AFTER delivery_option");
        } catch (\Exception $e) {
            // Column might already exist
        }
        
        try {
            DB::statement("ALTER TABLE orders ADD COLUMN status VARCHAR(255) DEFAULT 'Pending' AFTER total");
        } catch (\Exception $e) {
            // Column might already exist
        }
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'phone', 'address', 'delivery_option', 'total', 'status']);
        });
    }
};
