<?php
/**
 * Test dashboard analytics data
 */

require_once 'vendor/autoload.php';

try {
    $app = require_once 'bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "=== Dashboard Analytics Test ===\n\n";
    
    // Test basic counts
    $totalOrders = \App\Models\Order::count();
    $totalRevenue = \App\Models\Order::where('status', 'completed')->sum('total');
    $totalProducts = \App\Models\Product::count();
    $totalUsers = \App\Models\User::count();
    
    echo "📊 Basic Stats:\n";
    echo "  Total Orders: $totalOrders\n";
    echo "  Total Revenue: TK " . number_format($totalRevenue, 2) . "\n";
    echo "  Total Products: $totalProducts\n";
    echo "  Total Users: $totalUsers\n\n";
    
    // Test monthly data for charts
    echo "📈 Monthly Data (Last 3 months):\n";
    for ($i = 2; $i >= 0; $i--) {
        $date = now()->subMonths($i);
        $monthlyOrders = \App\Models\Order::whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)
            ->count();
        $monthlyRevenue = \App\Models\Order::where('status', 'completed')
            ->whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year)
            ->sum('total');
            
        echo "  " . $date->format('M Y') . ": $monthlyOrders orders, TK " . number_format($monthlyRevenue, 2) . "\n";
    }
    
    // Test category data with correct column names
    echo "\n📦 Product Categories:\n";
    try {
        $categories = \App\Models\Product::join('product_categories', 'products.cat_id', '=', 'product_categories.id')
            ->select('product_categories.name', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->groupBy('product_categories.name')
            ->get();
            
        foreach ($categories as $category) {
            echo "  {$category->name}: {$category->total} products\n";
        }
        
        if ($categories->isEmpty()) {
            echo "  No categories found. Make sure you have products with categories.\n";
        }
    } catch (\Exception $e) {
        echo "  Error: " . $e->getMessage() . "\n";
    }
    
    // Test top products with correct column names
    echo "\n🏆 Top Selling Products:\n";
    try {
        $topProducts = \App\Models\OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->select('products.name', \Illuminate\Support\Facades\DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_sold', 'desc')
            ->take(3)
            ->get();
            
        foreach ($topProducts as $product) {
            echo "  {$product->name}: {$product->total_sold} sold\n";
        }
        
        if ($topProducts->isEmpty()) {
            echo "  No completed orders found. Charts will show when you have completed orders.\n";
        }
    } catch (\Exception $e) {
        echo "  Error: " . $e->getMessage() . "\n";
    }
    
    echo "\n✅ Dashboard analytics data is ready for charts!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "  File: " . $e->getFile() . "\n";
    echo "  Line: " . $e->getLine() . "\n";
}
