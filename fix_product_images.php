<?php

require_once 'vendor/autoload.php';

// Load Laravel environment
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

try {
    // Find products with image paths that start with 'storage/'
    $products = Product::where('image', 'like', 'storage/%')->get();
    
    echo "Found " . $products->count() . " products with incorrect image paths.\n";
    
    foreach ($products as $product) {
        $oldPath = $product->image;
        // Remove 'storage/' prefix
        $newPath = str_replace('storage/', '', $oldPath);
        
        $product->image = $newPath;
        $product->save();
        
        echo "Updated product ID {$product->id}: '{$oldPath}' -> '{$newPath}'\n";
    }
    
    echo "\nAll product image paths have been fixed!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
