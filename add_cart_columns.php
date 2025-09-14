<?php
require_once 'vendor/autoload.php';

// Load Laravel application
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    // Check if price column exists
    if (!Schema::hasColumn('cart_items', 'price')) {
        DB::statement('ALTER TABLE cart_items ADD COLUMN price DECIMAL(10,2) NULL AFTER quantity');
        echo "Added 'price' column to cart_items table.\n";
    } else {
        echo "'price' column already exists in cart_items table.\n";
    }
    
    // Check if options column exists
    if (!Schema::hasColumn('cart_items', 'options')) {
        DB::statement('ALTER TABLE cart_items ADD COLUMN options JSON NULL AFTER price');
        echo "Added 'options' column to cart_items table.\n";
    } else {
        echo "'options' column already exists in cart_items table.\n";
    }
    
    echo "Successfully added missing columns to cart_items table!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
