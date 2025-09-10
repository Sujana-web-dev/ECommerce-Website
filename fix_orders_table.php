<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "Adding missing columns to orders table...\n";

try {
    // Check what columns exist
    $columns = Schema::getColumnListing('orders');
    echo "Current columns: " . implode(', ', $columns) . "\n";
    
    // Add missing columns one by one
    $columnsToAdd = [
        'name' => "ALTER TABLE orders ADD COLUMN name VARCHAR(255) AFTER user_id",
        'email' => "ALTER TABLE orders ADD COLUMN email VARCHAR(255) AFTER name", 
        'phone' => "ALTER TABLE orders ADD COLUMN phone VARCHAR(255) AFTER email",
        'address' => "ALTER TABLE orders ADD COLUMN address TEXT AFTER phone",
        'delivery_option' => "ALTER TABLE orders ADD COLUMN delivery_option VARCHAR(255) AFTER address",
        'total' => "ALTER TABLE orders ADD COLUMN total DECIMAL(10,2) AFTER delivery_option",
        'status' => "ALTER TABLE orders ADD COLUMN status VARCHAR(255) DEFAULT 'Pending' AFTER total"
    ];
    
    foreach ($columnsToAdd as $columnName => $sql) {
        if (!in_array($columnName, $columns)) {
            echo "Adding column: $columnName\n";
            try {
                DB::statement($sql);
                echo "✓ Added $columnName\n";
            } catch (Exception $e) {
                echo "✗ Failed to add $columnName: " . $e->getMessage() . "\n";
            }
        } else {
            echo "✓ Column $columnName already exists\n";
        }
    }
    
    echo "Done!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
