<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create the table if it doesn't exist, or modify if it does
        if (!Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('order_id');
                $table->unsignedBigInteger('product_id');
                $table->integer('quantity');
                $table->decimal('price', 10, 2);
                $table->timestamps();

                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            });
        } else {
            // If table exists, add missing columns
            Schema::table('order_items', function (Blueprint $table) {
                if (!Schema::hasColumn('order_items', 'order_id')) {
                    $table->unsignedBigInteger('order_id')->after('id');
                }
                if (!Schema::hasColumn('order_items', 'product_id')) {
                    $table->unsignedBigInteger('product_id')->after('order_id');
                }
                if (!Schema::hasColumn('order_items', 'quantity')) {
                    $table->integer('quantity')->after('product_id');
                }
                if (!Schema::hasColumn('order_items', 'price')) {
                    $table->decimal('price', 10, 2)->after('quantity');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
