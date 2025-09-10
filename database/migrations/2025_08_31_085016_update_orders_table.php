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
            // Add new columns if they don't exist
            if (!Schema::hasColumn('orders', 'name')) {
                $table->string('name')->after('user_id');
            }
            if (!Schema::hasColumn('orders', 'email')) {
                $table->string('email')->after('name');
            }
            if (!Schema::hasColumn('orders', 'phone')) {
                $table->string('phone')->after('email');
            }
            if (!Schema::hasColumn('orders', 'address')) {
                $table->text('address')->after('phone');
            }
            if (!Schema::hasColumn('orders', 'delivery_option')) {
                $table->string('delivery_option')->after('address');
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 10, 2)->after('delivery_option');
            }
            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('Pending')->after('total');
            }
            
            // Add foreign key if it doesn't exist
            if (!Schema::hasColumn('orders', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['name', 'email', 'phone', 'address', 'delivery_option', 'status', 'total']);
        });
    }
};
