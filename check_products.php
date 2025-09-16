<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

echo "=== PRODUCTS CHECK ===\n";
echo "Total products: " . Product::count() . "\n";

$products = Product::take(5)->get(['id', 'name', 'amount', 'stock']);
foreach($products as $product) {
    echo "ID: {$product->id}, Name: {$product->name}, Price: {$product->amount}, Stock: {$product->stock}\n";
}
echo "======================\n";
?>