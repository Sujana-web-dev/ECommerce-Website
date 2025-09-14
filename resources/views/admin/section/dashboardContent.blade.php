@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 p-6 space-y-8" style="font-size: 14px;">

    <!-- Hero Dashboard Header -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#1D293D] via-[#243447] to-[#1D293D] rounded-3xl p-10 shadow-xl border border-white/20">
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-blue-400/10 to-purple-500/10 rounded-full -mr-48 -mt-48 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-gradient-to-tr from-emerald-400/10 to-cyan-500/10 rounded-full -ml-36 -mb-36 blur-3xl"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div>
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-xl">🚀</span>
                    </div>
                    <div>
                        <h1 class="text-4xl font-semibold text-white tracking-tight leading-none">Dashboard</h1>
                        <p class="text-blue-200 text-base font-normal">Welcome back, Admin!</p>
                    </div>
                </div>
                <p class="text-gray-300 text-lg mb-6 max-w-md font-light">Monitor your business performance and make data-driven decisions</p>
                <div class="flex items-center space-x-6">
                    <div class="flex items-center bg-white/10 rounded-full px-4 py-2 backdrop-blur-sm">
                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse shadow-sm"></div>
                        <span class="text-white font-normal" style="font-size: 14px;">All Systems Online</span>
                    </div>
                    <div class="flex items-center bg-white/10 rounded-full px-4 py-2 backdrop-blur-sm">
                        <span class="text-white/80 font-normal" style="font-size: 14px;">{{ date('F j, Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block text-right">
                <div class="text-6xl font-light text-white/10 mb-2">{{ date('d') }}</div>
                <div class="text-white/60 text-base font-normal">{{ date('M Y') }}</div>
                <div class="mt-4 w-20 h-1 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full"></div>
            </div>
        </div>
    </div>

    <!-- Enhanced Stats Grid -->
    @php
    // Real-time data calculations
    $totalRevenue = \App\Models\Order::where('status', 'completed')->sum('total');
    $totalOrders = \App\Models\Order::count();
    $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
    $completedOrders = \App\Models\Order::where('status', 'completed')->count();
    $totalProducts = \App\Models\Product::count();
    $inStockProducts = \App\Models\Product::where('stock', '>', 0)->count();
    
    // Enhanced stock calculations
    $outOfStockProducts = \App\Models\Product::where('stock', '<=', 0)->count();
    $lowStockProducts = \App\Models\Product::whereBetween('stock', [1, 10])->count();
    $criticalStockProducts = \App\Models\Product::whereBetween('stock', [1, 5])->count();
    
    // Get specific out-of-stock and low stock products for alerts
    $outOfStockProductsList = \App\Models\Product::where('stock', '<=', 0)->with('category')->limit(5)->get();
    $lowStockProductsList = \App\Models\Product::whereBetween('stock', [1, 5])->with('category')->limit(5)->get();
    
    $totalCustomers = \App\Models\User::count();
    $newCustomersToday = \App\Models\User::whereDate('created_at', today())->count();

    // Calculate this month's data for comparison
    $thisMonthRevenue = \App\Models\Order::where('status', 'completed')
    ->whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->sum('total');
    $lastMonthRevenue = \App\Models\Order::where('status', 'completed')
    ->whereMonth('created_at', now()->subMonth()->month)
    ->whereYear('created_at', now()->subMonth()->year)
    ->sum('total');
    $revenueGrowth = $lastMonthRevenue > 0 ? (($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 0;

    $thisMonthOrders = \App\Models\Order::whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->count();
    $lastMonthOrders = \App\Models\Order::whereMonth('created_at', now()->subMonth()->month)
    ->whereYear('created_at', now()->subMonth()->year)
    ->count();
    $ordersGrowth = $lastMonthOrders > 0 ? (($thisMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100 : 0;

    $thisMonthCustomers = \App\Models\User::whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->count();
    $lastMonthCustomers = \App\Models\User::whereMonth('created_at', now()->subMonth()->month)
    ->whereYear('created_at', now()->subMonth()->year)
    ->count();
    $customersGrowth = $lastMonthCustomers > 0 ? (($thisMonthCustomers - $lastMonthCustomers) / $lastMonthCustomers) * 100 : 0;

    // Calculate conversion rate (orders vs total customers)
    $conversionRate = $totalCustomers > 0 ? ($totalOrders / $totalCustomers) * 100 : 0;
    $lastMonthConversionRate = $lastMonthCustomers > 0 ? ($lastMonthOrders / $lastMonthCustomers) * 100 : 0;
    $conversionGrowth = $lastMonthConversionRate > 0 ? (($conversionRate - $lastMonthConversionRate) / $lastMonthConversionRate) * 100 : 0;

    // Prepare chart data - Last 12 months
    $monthlyData = [];
    $monthlyLabels = [];
    $monthlyRevenue = [];
    $monthlyOrders = [];
    $monthlyCustomers = [];

    for ($i = 11; $i >= 0; $i--) {
    $date = now()->subMonths($i);
    $monthlyLabels[] = $date->format('M Y');

    $revenue = \App\Models\Order::where('status', 'completed')
    ->whereMonth('created_at', $date->month)
    ->whereYear('created_at', $date->year)
    ->sum('total');
    $monthlyRevenue[] = $revenue;

    $orders = \App\Models\Order::whereMonth('created_at', $date->month)
    ->whereYear('created_at', $date->year)
    ->count();
    $monthlyOrders[] = $orders;

    $customers = \App\Models\User::whereMonth('created_at', $date->month)
    ->whereYear('created_at', $date->year)
    ->count();
    $monthlyCustomers[] = $customers;
    }

    // Weekly data for the last 4 weeks
    $weeklyData = [];
    $weeklyLabels = [];
    $weeklyRevenue = [];
    $weeklyOrders = [];

    for ($i = 3; $i >= 0; $i--) {
    $startOfWeek = now()->subWeeks($i)->startOfWeek();
    $endOfWeek = now()->subWeeks($i)->endOfWeek();

    $weeklyLabels[] = 'Week ' . ($i + 1);

    $revenue = \App\Models\Order::where('status', 'completed')
    ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->sum('total');
    $weeklyRevenue[] = $revenue;

    $orders = \App\Models\Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])
    ->count();
    $weeklyOrders[] = $orders;
    }

    // Daily data for the last 7 days
    $dailyData = [];
    $dailyLabels = [];
    $dailyRevenue = [];
    $dailyOrders = [];

    for ($i = 6; $i >= 0; $i--) {
    $date = now()->subDays($i);
    $dailyLabels[] = $date->format('M d');

    $revenue = \App\Models\Order::where('status', 'completed')
    ->whereDate('created_at', $date)
    ->sum('total');
    $dailyRevenue[] = $revenue;

    $orders = \App\Models\Order::whereDate('created_at', $date)
    ->count();
    $dailyOrders[] = $orders;
    }

    // Product categories data
    try {
    $categoryData = \App\Models\Product::join('product_categories', 'products.cat_id', '=', 'product_categories.id')
    ->select('product_categories.name', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
    ->groupBy('product_categories.name')
    ->get();
    } catch (\Exception $e) {
    // Fallback if no categories exist
    $categoryData = collect();
    }

    // Top selling products
    try {
    $topProducts = \App\Models\OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
    ->join('orders', 'order_items.order_id', '=', 'orders.id')
    ->where('orders.status', 'completed')
    ->select('products.name', \Illuminate\Support\Facades\DB::raw('SUM(order_items.quantity) as total_sold'), \Illuminate\Support\Facades\DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue'))
    ->groupBy('products.id', 'products.name')
    ->orderBy('total_sold', 'desc')
    ->take(5)
    ->get();
    } catch (\Exception $e) {
    // Fallback if no orders exist
    $topProducts = collect();
    }
    @endphp

    <!-- Stock Alert Notifications -->
    @if($outOfStockProducts > 0 || $criticalStockProducts > 0)
    <div class="space-y-4 mb-8">
        <!-- Out of Stock Alert -->
        @if($outOfStockProducts > 0)
        <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 p-6 rounded-xl shadow-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-lg font-semibold text-red-800 mb-2">
                        <i class="fas fa-ban mr-2"></i>{{ $outOfStockProducts }} Product{{ $outOfStockProducts > 1 ? 's' : '' }} Out of Stock
                    </h3>
                    <p class="text-red-700 mb-4">The following products are completely out of stock and need immediate restocking:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach($outOfStockProductsList as $product)
                        <div class="bg-white/70 rounded-lg p-3 border border-red-200">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('images/'. $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded-lg">
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-red-800 text-sm truncate">{{ $product->name }}</p>
                                    <p class="text-red-600 text-xs">{{ $product->category->name ?? 'No Category' }}</p>
                                    <p class="text-red-500 text-xs font-semibold">Stock: {{ $product->stock }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4 flex items-center space-x-4">
                        <a href="{{ route('product.list') }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors duration-200">
                            <i class="fas fa-boxes mr-2"></i>Manage Products
                        </a>
                        @if($outOfStockProducts > count($outOfStockProductsList))
                        <span class="text-red-600 text-sm">+{{ $outOfStockProducts - count($outOfStockProductsList) }} more products out of stock</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Low Stock Warning -->
        @if($criticalStockProducts > 0)
        <div class="bg-gradient-to-r from-amber-50 to-yellow-50 border-l-4 border-amber-500 p-6 rounded-xl shadow-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-amber-600"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-lg font-semibold text-amber-800 mb-2">
                        <i class="fas fa-warning mr-2"></i>{{ $criticalStockProducts }} Product{{ $criticalStockProducts > 1 ? 's' : '' }} Running Low
                    </h3>
                    <p class="text-amber-700 mb-4">These products have critically low stock levels (5 or fewer units remaining):</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach($lowStockProductsList as $product)
                        <div class="bg-white/70 rounded-lg p-3 border border-amber-200">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('images/'. $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded-lg">
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-amber-800 text-sm truncate">{{ $product->name }}</p>
                                    <p class="text-amber-600 text-xs">{{ $product->category->name ?? 'No Category' }}</p>
                                    <p class="text-amber-500 text-xs font-semibold flex items-center">
                                        <i class="fas fa-boxes mr-1"></i>Stock: {{ $product->stock }}
                                        <span class="ml-2 px-2 py-0.5 bg-amber-200 text-amber-800 rounded-full text-xs font-bold">CRITICAL</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('product.list') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white text-sm font-medium rounded-lg hover:bg-amber-700 transition-colors duration-200">
                            <i class="fas fa-boxes mr-2"></i>Restock Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Revenue Card -->
        <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-white/50 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 via-green-500/5 to-teal-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-start justify-between mb-6">
                    <div class="relative">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-100 to-green-100 rounded-xl flex items-center justify-center shadow-sm">
                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-green-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-medium text-lg">💰</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-{{ $revenueGrowth >= 0 ? 'emerald' : 'red' }}-50 text-{{ $revenueGrowth >= 0 ? 'emerald' : 'red' }}-700 px-3 py-1 rounded-lg font-medium text-xs">
                        <span class="text-{{ $revenueGrowth >= 0 ? 'emerald' : 'red' }}-500">{{ $revenueGrowth >= 0 ? '+' : '' }}</span>{{ number_format($revenueGrowth, 1) }}%
                    </div>
                </div>
                <h3 class="text-gray-500 font-medium uppercase tracking-wide mb-3 text-xs">Total Revenue</h3>
                <p class="text-3xl font-semibold text-[#1D293D] mb-2">TK {{ number_format($totalRevenue, 0) }}</p>
                <p class="text-gray-400 font-normal text-xs">{{ $completedOrders }} completed orders</p>
                <div class="mt-4 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-{{ $completedOrders > 0 ? ($completedOrders / max($totalOrders, 1) * 100 > 75 ? 'full' : ($completedOrders / max($totalOrders, 1) * 100 > 50 ? '3/4' : ($completedOrders / max($totalOrders, 1) * 100 > 25 ? '1/2' : '1/4'))) : '0' }} h-full bg-gradient-to-r from-emerald-400 to-green-500 rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-white/50 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-start justify-between mb-6">
                    <div class="relative">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center shadow-sm">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-medium text-lg">📦</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-{{ $ordersGrowth >= 0 ? 'blue' : 'red' }}-50 text-{{ $ordersGrowth >= 0 ? 'blue' : 'red' }}-700 px-3 py-1 rounded-lg font-medium text-xs">
                        <span class="text-{{ $ordersGrowth >= 0 ? 'blue' : 'red' }}-500">{{ $ordersGrowth >= 0 ? '+' : '' }}</span>{{ number_format($ordersGrowth, 1) }}%
                    </div>
                </div>
                <h3 class="text-gray-500 font-medium uppercase tracking-wide mb-3 text-xs">Total Orders</h3>
                <p class="text-3xl font-semibold text-[#1D293D] mb-2">{{ number_format($totalOrders) }}</p>
                <p class="text-gray-400 font-normal text-xs">{{ $pendingOrders }} pending • {{ $completedOrders }} completed</p>
                <div class="mt-4 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-{{ $totalOrders > 0 ? ($completedOrders / $totalOrders * 100 > 80 ? 'full' : ($completedOrders / $totalOrders * 100 > 60 ? '4/5' : ($completedOrders / $totalOrders * 100 > 40 ? '3/5' : ($completedOrders / $totalOrders * 100 > 20 ? '2/5' : '1/5')))) : '0' }} h-full bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Customers Card -->
        <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-white/50 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 via-pink-500/5 to-rose-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-start justify-between mb-6">
                    <div class="relative">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl flex items-center justify-center shadow-sm">
                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-medium text-lg">👥</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-{{ $customersGrowth >= 0 ? 'purple' : 'red' }}-50 text-{{ $customersGrowth >= 0 ? 'purple' : 'red' }}-700 px-3 py-1 rounded-lg font-medium text-xs">
                        <span class="text-{{ $customersGrowth >= 0 ? 'purple' : 'red' }}-500">{{ $customersGrowth >= 0 ? '+' : '' }}</span>{{ number_format($customersGrowth, 1) }}%
                    </div>
                </div>
                <h3 class="text-gray-500 font-medium uppercase tracking-wide mb-3 text-xs">Total Customers</h3>
                <p class="text-3xl font-semibold text-[#1D293D] mb-2">{{ number_format($totalCustomers) }}</p>
                <p class="text-gray-400 font-normal text-xs">{{ $newCustomersToday }} new customers today</p>
                <div class="mt-4 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-{{ $newCustomersToday > 0 && $totalCustomers > 0 ? ($newCustomersToday / $totalCustomers * 100 > 10 ? '2/3' : ($newCustomersToday / $totalCustomers * 100 > 5 ? '1/2' : '1/3')) : ($totalCustomers > 0 ? '2/3' : '0') }} h-full bg-gradient-to-r from-purple-400 to-pink-500 rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-white/50 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 via-amber-500/5 to-yellow-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="flex items-start justify-between mb-6">
                    <div class="relative">
                        <div class="w-14 h-14 bg-gradient-to-br from-orange-100 to-amber-100 rounded-xl flex items-center justify-center shadow-sm">
                            <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-amber-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-medium text-lg">�</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-{{ $inStockProducts > 0 ? 'green' : 'red' }}-50 text-{{ $inStockProducts > 0 ? 'green' : 'red' }}-700 px-3 py-1 rounded-lg font-medium text-xs">
                        @if($totalProducts > 0)
                        {{ number_format(($inStockProducts / $totalProducts) * 100, 1) }}%
                        @else
                        0%
                        @endif
                    </div>
                </div>
                <h3 class="text-gray-500 font-medium uppercase tracking-wide mb-3 text-xs">Total Products</h3>
                <p class="text-3xl font-semibold text-[#1D293D] mb-2">{{ number_format($totalProducts) }}</p>
                <div class="space-y-1">
                    <p class="text-gray-400 font-normal text-xs flex items-center justify-between">
                        <span class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-1"></i>In Stock
                        </span>
                        <span class="font-semibold">{{ $inStockProducts }}</span>
                    </p>
                    @if($criticalStockProducts > 0)
                    <p class="text-amber-600 font-normal text-xs flex items-center justify-between">
                        <span class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-amber-500 mr-1"></i>Low Stock (≤5)
                        </span>
                        <span class="font-semibold">{{ $criticalStockProducts }}</span>
                    </p>
                    @endif
                    @if($outOfStockProducts > 0)
                    <p class="text-red-600 font-normal text-xs flex items-center justify-between">
                        <span class="flex items-center">
                            <i class="fas fa-ban text-red-500 mr-1"></i>Out of Stock
                        </span>
                        <span class="font-semibold">{{ $outOfStockProducts }}</span>
                    </p>
                    @endif
                </div>
                <div class="mt-4 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-{{ $totalProducts > 0 ? ($inStockProducts / $totalProducts * 100 > 75 ? 'full' : ($inStockProducts / $totalProducts * 100 > 50 ? '3/4' : ($inStockProducts / $totalProducts * 100 > 25 ? '1/2' : '1/4'))) : '0' }} h-full bg-gradient-to-r from-orange-400 to-amber-500 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 space-y-6">
        <!-- Date Range Filter -->
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-xl p-6">
            <div class="flex flex-wrap items-center gap-4">
                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700">Date Range:</label>
                    <select id="dateRange" class="px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/80 backdrop-blur-sm transition-all duration-200">
                        <option value="today">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="last7days" selected>Last 7 Days</option>
                        <option value="last30days">Last 30 Days</option>
                        <option value="thismonth">This Month</option>
                        <option value="lastmonth">Last Month</option>
                        <option value="thisyear">This Year</option>
                        <option value="custom">Custom Range</option>
                    </select>
                </div>
                <div id="customDateRange" class="flex items-center space-x-2" style="display: none;">
                    <input type="date" id="startDate" class="px-3 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/80 backdrop-blur-sm transition-all duration-200">
                    <span class="text-gray-500">to</span>
                    <input type="date" id="endDate" class="px-3 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/80 backdrop-blur-sm transition-all duration-200">
                </div>
                <button id="applyFilter" class="px-6 py-3 bg-gradient-to-r from-[#1D293D] to-gray-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                    <i class="fas fa-filter mr-2"></i>Apply Filter
                </button>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Revenue Chart -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-6 border border-white/20">
                <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 -mx-6 -mt-6 mb-6 px-6 py-4 rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white">Revenue Trends</h3>
                        <div class="flex space-x-2">
                            <button onclick="updateRevenueChart('daily')" class="chart-toggle px-3 py-1 text-xs bg-white/20 text-white rounded-full backdrop-blur-sm border border-white/30 active">Daily</button>
                            <button onclick="updateRevenueChart('weekly')" class="chart-toggle px-3 py-1 text-xs bg-white/10 text-gray-300 rounded-full backdrop-blur-sm border border-white/20 hover:bg-white/20 hover:text-white transition-all">Weekly</button>
                            <button onclick="updateRevenueChart('monthly')" class="chart-toggle px-3 py-1 text-xs bg-white/10 text-gray-300 rounded-full backdrop-blur-sm border border-white/20 hover:bg-white/20 hover:text-white transition-all">Monthly</button>
                        </div>
                    </div>
                </div>
                <div class="h-64 flex items-center justify-center bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl border border-gray-100">
                    <canvas id="revenueChart" class="w-full h-full"></canvas>
                </div>
            </div>

            <!-- Orders Chart -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-6 border border-white/20">
                <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 -mx-6 -mt-6 mb-6 px-6 py-4 rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white">Order Volume</h3>
                        <div class="flex space-x-2">
                            <button onclick="updateOrdersChart('week')" class="order-toggle px-3 py-1 text-xs bg-white/20 text-white rounded-full backdrop-blur-sm border border-white/30 active">This Week</button>
                            <button onclick="updateOrdersChart('month')" class="order-toggle px-3 py-1 text-xs bg-white/10 text-gray-300 rounded-full backdrop-blur-sm border border-white/20 hover:bg-white/20 hover:text-white transition-all">This Month</button>
                        </div>
                    </div>
                </div>
                <div class="h-64 flex items-center justify-center bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl border border-gray-100">
                    <canvas id="ordersChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>

        <!-- Enhanced Chart & Activity Row -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

            <!-- Analytics Chart -->
            <div class="xl:col-span-2 bg-white/90 backdrop-blur-sm rounded-2xl p-8 shadow-lg border border-white/50">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#1D293D] to-[#243447] rounded-xl flex items-center justify-center">
                                <span class="text-white text-lg">📈</span>
                            </div>
                            <h3 class="text-2xl font-semibold text-[#1D293D]">Sales Analytics</h3>
                        </div>
                        <p class="text-gray-500 font-normal" style="font-size: 14px;">Real-time performance tracking & insights</p>
                    </div>
                    <div class="flex bg-gray-100 rounded-xl p-1" id="chartPeriodSelector">
                        <button class="px-5 py-2 bg-[#1D293D] text-white rounded-lg font-medium transition-all hover:bg-[#243447] chart-period-btn active" style="font-size: 14px;" data-period="year">Year</button>
                        <button class="px-5 py-2 text-gray-600 rounded-lg font-normal hover:bg-white transition-all chart-period-btn" style="font-size: 14px;" data-period="month">Month</button>
                        <button class="px-5 py-2 text-gray-600 rounded-lg font-normal hover:bg-white transition-all chart-period-btn" style="font-size: 14px;" data-period="week">Week</button>
                    </div>
                </div>

                <!-- Main Charts Container -->
                <div class="space-y-6">
                    <!-- Revenue and Orders Chart -->
                    <div class="chart-container">
                        <canvas id="revenueOrdersChart"></canvas>
                    </div>

                    <!-- Chart Toggle Buttons -->
                    <div class="flex justify-center space-x-4">
                        <button id="showRevenueBtn" class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-lg font-medium text-sm transition-all hover:bg-emerald-200">
                            <span class="w-3 h-3 bg-emerald-500 rounded-full inline-block mr-2"></span>
                            Revenue: TK {{ number_format($totalRevenue, 0) }}
                        </button>
                        <button id="showOrdersBtn" class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg font-medium text-sm transition-all hover:bg-blue-200">
                            <span class="w-3 h-3 bg-blue-500 rounded-full inline-block mr-2"></span>
                            Orders: {{ number_format($totalOrders) }}
                        </button>
                        <button id="showCustomersBtn" class="px-4 py-2 bg-purple-100 text-purple-700 rounded-lg font-medium text-sm transition-all hover:bg-purple-200">
                            <span class="w-3 h-3 bg-purple-500 rounded-full inline-block mr-2"></span>
                            Customers: {{ number_format($totalCustomers) }}
                        </button>
                    </div>
                </div>

                <!-- Chart Summary Stats -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <div>
                            <div class="text-2xl font-bold text-emerald-600">{{ number_format($revenueGrowth, 1) }}%</div>
                            <div class="text-xs text-gray-500">Revenue Growth</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-blue-600">{{ number_format($ordersGrowth, 1) }}%</div>
                            <div class="text-xs text-gray-500">Orders Growth</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-purple-600">{{ number_format($customersGrowth, 1) }}%</div>
                            <div class="text-xs text-gray-500">Customer Growth</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-orange-600">{{ number_format($conversionRate, 1) }}%</div>
                            <div class="text-xs text-gray-500">Conversion Rate</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Real-Time Activity -->
            <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-lg border border-white/50 overflow-hidden">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-[#1D293D] to-[#243447] p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <span class="text-white text-lg">⚡</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white">Live Activity</h3>
                                <p class="text-white/70 text-xs font-normal">Real-time updates</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-white/90 text-xs font-medium">Live</span>
                        </div>
                    </div>
                </div>

                <!-- Stats Bar -->
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                    <div class="flex items-center justify-between text-xs">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                <span class="text-emerald-700 font-medium">324 online</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span class="text-blue-700 font-medium">28 orders</span>
                            </div>
                        </div>
                        <span class="text-gray-500 font-normal">Last updated: now</span>
                    </div>
                </div>

                <!-- Activity Feed -->
                <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                    <!-- Order Activity -->
                    <div class="group flex items-start space-x-3 p-3 rounded-xl hover:bg-blue-50/50 transition-all duration-200">
                        <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mt-0.5">
                            <span class="text-white text-sm">🛍️</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[#1D293D] font-medium text-sm">New order received</p>
                            <p class="text-blue-600 text-xs font-normal mt-0.5">iPhone 15 Pro Max - Space Black</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs text-gray-500">Order #1247</span>
                                <span class="text-xs font-semibold text-blue-600">$1,299.00</span>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 mt-0.5">2s</span>
                    </div>

                    <!-- Payment Activity -->
                    <div class="group flex items-start space-x-3 p-3 rounded-xl hover:bg-emerald-50/50 transition-all duration-200">
                        <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center mt-0.5">
                            <span class="text-white text-sm">💳</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[#1D293D] font-medium text-sm">Payment confirmed</p>
                            <p class="text-emerald-600 text-xs font-normal mt-0.5">Stripe • Visa ending 4242</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs text-gray-500">Order #1245</span>
                                <span class="text-xs font-semibold text-emerald-600">$489.99</span>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 mt-0.5">45s</span>
                    </div>

                    <!-- User Activity -->
                    <div class="group flex items-start space-x-3 p-3 rounded-xl hover:bg-purple-50/50 transition-all duration-200">
                        <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mt-0.5">
                            <span class="text-white text-sm">👤</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[#1D293D] font-medium text-sm">New customer signup</p>
                            <p class="text-purple-600 text-xs font-normal mt-0.5">Alex Thompson</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs text-gray-500">Premium account</span>
                                <span class="text-xs px-2 py-0.5 bg-purple-100 text-purple-700 rounded-full font-medium">New</span>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 mt-0.5">1m</span>
                    </div>

                    <!-- Dynamic Stock Alerts -->
                    @forelse($lowStockProductsList->take(2) as $product)
                    <div class="group flex items-start space-x-3 p-3 rounded-xl hover:bg-amber-50/50 transition-all duration-200">
                        <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg flex items-center justify-center mt-0.5">
                            <span class="text-white text-sm">⚠️</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[#1D293D] font-medium text-sm">Low stock alert</p>
                            <p class="text-amber-600 text-xs font-normal mt-0.5">{{ $product->name }}</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs text-gray-500">Only {{ $product->stock }} units left</span>
                                <span class="text-xs px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full font-medium">
                                    {{ $product->stock <= 2 ? 'Critical' : 'Low' }}
                                </span>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 mt-0.5">Now</span>
                    </div>
                    @empty
                    @foreach($outOfStockProductsList->take(2) as $product)
                    <div class="group flex items-start space-x-3 p-3 rounded-xl hover:bg-red-50/50 transition-all duration-200">
                        <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center mt-0.5">
                            <span class="text-white text-sm">❌</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[#1D293D] font-medium text-sm">Out of stock alert</p>
                            <p class="text-red-600 text-xs font-normal mt-0.5">{{ $product->name }}</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs text-gray-500">Stock depleted</span>
                                <span class="text-xs px-2 py-0.5 bg-red-100 text-red-700 rounded-full font-medium">Urgent</span>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 mt-0.5">Now</span>
                    </div>
                    @endforeach
                    @endforelse

                    <!-- Review Activity -->
                    <div class="group flex items-start space-x-3 p-3 rounded-xl hover:bg-cyan-50/50 transition-all duration-200">
                        <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center mt-0.5">
                            <span class="text-white text-sm">⭐</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[#1D293D] font-medium text-sm">New review received</p>
                            <p class="text-cyan-600 text-xs font-normal mt-0.5">"Amazing quality and fast shipping!"</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs text-gray-500">Wireless Earbuds</span>
                                <div class="flex items-center">
                                    <span class="text-xs text-yellow-500">★★★★★</span>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 mt-0.5">5m</span>
                    </div>

                    <!-- Shipping Activity -->
                    <div class="group flex items-start space-x-3 p-3 rounded-xl hover:bg-indigo-50/50 transition-all duration-200">
                        <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center mt-0.5">
                            <span class="text-white text-sm">🚚</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[#1D293D] font-medium text-sm">Package shipped</p>
                            <p class="text-indigo-600 text-xs font-normal mt-0.5">DHL Express • Track: DH123456789</p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs text-gray-500">Order #1240</span>
                                <span class="text-xs px-2 py-0.5 bg-indigo-100 text-indigo-700 rounded-full font-medium">Shipped</span>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 mt-0.5">8m</span>
                    </div>
                </div>

                <!-- Quick Actions Footer -->
                <div class="p-6 bg-gray-50 border-t border-gray-100">
                    <div class="space-y-2">
                        <button class="w-full flex items-center justify-center p-3 bg-gradient-to-r from-[#1D293D] to-[#243447] text-white rounded-xl hover:from-[#243447] hover:to-[#2a3f57] transition-all group" style="font-size: 14px;">
                            <span class="mr-2">➕</span>
                            <span class="font-medium">Add New Product</span>
                            <span class="ml-auto group-hover:translate-x-1 transition-transform">→</span>
                        </button>
                        <button class="w-full flex items-center justify-center p-3 bg-gradient-to-r from-[#ec4642] to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all group" style="font-size: 14px;">
                            <span class="mr-2">📊</span>
                            <span class="font-medium">View All Activities</span>
                            <span class="ml-auto group-hover:translate-x-1 transition-transform">→</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products & Customer Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Top Selling Products -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20">
                {{-- Table Header --}}
                <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white">Top Selling Products</h3>
                        <div class="text-sm text-gray-300">
                            <span>Top 5 products</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    @php
                    // Get top selling products from your actual order items
                    $topProducts = collect();
                    try {
                    $orders = \App\Models\Order::with('items.product')->get();
                    if($orders->isNotEmpty()) {
                    $productStats = [];
                    foreach($orders as $order) {
                    foreach($order->items as $item) {
                    $productId = $item->product_id;
                    if (!isset($productStats[$productId])) {
                    $productStats[$productId] = [
                    'name' => $item->product->name ?? 'Unknown Product',
                    'sold' => 0,
                    'revenue' => 0
                    ];
                    }
                    $productStats[$productId]['sold'] += $item->quantity;
                    $productStats[$productId]['revenue'] += $item->price * $item->quantity;
                    }
                    }
                    $topProducts = collect($productStats)->sortByDesc('sold')->take(5)->values();
                    }
                    } catch (\Exception $e) {
                    // In case of any error, return empty collection
                    $topProducts = collect();
                    }
                    @endphp

                    @if($topProducts->isNotEmpty())
                    @foreach($topProducts as $index => $product)
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 border border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-lg font-bold text-sm">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm">{{ $product['name'] }}</h4>
                                <p class="text-xs text-gray-500">{{ $product['sold'] }} units sold</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-green-600 text-sm">TK {{ number_format($product['revenue'], 0) }}</p>
                            <p class="text-xs text-gray-500">Total Revenue</p>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-chart-bar text-4xl mb-2"></i>
                        <p>No product data available yet</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Customer Insights -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20">
                {{-- Table Header --}}
                <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white">Customer Insights</h3>
                        <div class="text-sm text-gray-300">
                            <span>Analytics</span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- New vs Returning Customers -->
                    @php
                    try {
                    $allOrders = \App\Models\Order::all();
                    $totalCustomers = $allOrders->pluck('user_id')->filter()->unique()->count() + $allOrders->whereNull('user_id')->count();
                    $registeredCustomers = $allOrders->pluck('user_id')->filter()->unique()->count();
                    $guestCustomers = $allOrders->whereNull('user_id')->count();
                    $registeredPercentage = $totalCustomers > 0 ? ($registeredCustomers / $totalCustomers) * 100 : 0;
                    $guestPercentage = $totalCustomers > 0 ? ($guestCustomers / $totalCustomers) * 100 : 0;
                    } catch (\Exception $e) {
                    // Fallback values
                    $totalCustomers = 0;
                    $registeredCustomers = 0;
                    $guestCustomers = 0;
                    $registeredPercentage = 0;
                    $guestPercentage = 0;
                    }
                    @endphp

                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Registered Customers</span>
                            <span class="text-sm font-semibold text-gray-900">{{ number_format($registeredPercentage, 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full shadow-sm" style="width: {{ $registeredPercentage }}%"></div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Guest Customers</span>
                            <span class="text-sm font-semibold text-gray-900">{{ number_format($guestPercentage, 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full shadow-sm" style="width: {{ $guestPercentage }}%"></div>
                        </div>
                    </div>

                    <!-- Order Status Distribution -->
                    <h4 class="font-medium text-gray-800 mb-4">Order Status Distribution</h4>
                    <div class="space-y-3">
                        @php
                        try {
                        // Get current order counts for proper calculation
                        $currentPendingOrders = \App\Models\Order::where('status', 'pending')->count();
                        $currentShippingOrders = \App\Models\Order::whereIn('status', ['processing', 'out_for_delivery'])->count();
                        $currentCompletedOrders = \App\Models\Order::where('status', 'completed')->count();
                        $currentCancelledOrders = \App\Models\Order::where('status', 'cancelled')->count();
                        $currentTotalOrders = \App\Models\Order::count();
                        } catch (\Exception $e) {
                        // Fallback values
                        $currentPendingOrders = $pendingOrders ?? 0;
                        $currentShippingOrders = $shippingOrders ?? 0;
                        $currentCompletedOrders = $completedOrders ?? 0;
                        $currentCancelledOrders = $cancelledOrders ?? 0;
                        $currentTotalOrders = $totalOrders ?? 0;
                        }

                        $statusData = [
                        ['status' => 'Pending', 'count' => $currentPendingOrders, 'color' => 'from-orange-500 to-orange-600'],
                        ['status' => 'Processing/Shipping', 'count' => $currentShippingOrders, 'color' => 'from-blue-500 to-blue-600'],
                        ['status' => 'Completed', 'count' => $currentCompletedOrders, 'color' => 'from-green-500 to-green-600'],
                        ['status' => 'Cancelled', 'count' => $currentCancelledOrders, 'color' => 'from-red-500 to-red-600']
                        ];
                        @endphp

                        @foreach($statusData as $status)
                        @php
                        $percentage = $currentTotalOrders > 0 ? ($status['count'] / $currentTotalOrders) * 100 : 0;
                        @endphp
                        <div class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-gradient-to-r {{ $status['color'] }} rounded-full"></div>
                                <span class="text-sm text-gray-700">{{ $status['status'] }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-semibold text-gray-900">{{ $status['count'] }}</span>
                                <span class="text-xs text-gray-500">({{ number_format($percentage, 1) }}%)</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20">
            {{-- Table Header --}}
            <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <span class="text-white text-lg">📝</span>
                            </div>
                            <h3 class="text-lg font-semibold text-white">Recent Orders</h3>
                        </div>
                        <p class="text-white/70 font-normal text-sm">Latest customer transactions and order status</p>
                    </div>
                    <a href="{{ route('orders') }}" class="px-6 py-3 bg-white/10 backdrop-blur-sm text-white rounded-xl font-medium hover:bg-white/20 transition-all shadow-md text-sm">
                        View All Orders →
                    </a>
                </div>
            </div>

            @php
            $recentOrders = \App\Models\Order::with(['items.product', 'user'])
            ->latest()
            ->take(5)
            ->get();
            @endphp

            @if($recentOrders->count() > 0)
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 table-fixed text-xs">
                    <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                        <tr>
                            <th class="px-2 py-2 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-12">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-hashtag text-[#1D293D] text-xs"></i>
                                    <span>ID</span>
                                </div>
                            </th>
                            <th class="px-2 py-2 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-32">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-user text-[#1D293D] text-xs"></i>
                                    <span>Customer</span>
                                </div>
                            </th>
                            <th class="px-2 py-2 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-28">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-phone text-[#1D293D] text-xs"></i>
                                    <span>Contact</span>
                                </div>
                            </th>
                            <th class="px-2 py-2 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-36">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-shopping-bag text-[#1D293D] text-xs"></i>
                                    <span>Products</span>
                                </div>
                            </th>
                            <th class="px-2 py-2 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-20">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-money-bill text-[#1D293D] text-xs"></i>
                                    <span>Total</span>
                                </div>
                            </th>
                            <th class="px-2 py-2 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-20">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-info-circle text-[#1D293D] text-xs"></i>
                                    <span>Status</span>
                                </div>
                            </th>
                            <th class="px-2 py-2 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-16">
                                <div class="flex items-center justify-center gap-1">
                                    <i class="fas fa-cogs text-[#1D293D] text-xs"></i>
                                    <span>Actions</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentOrders as $order)
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                            <!-- Order ID -->
                            <td class="px-2 py-2 whitespace-nowrap w-12">
                                <div class="w-10 h-6 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform duration-200">
                                    <span class="text-white font-bold text-xs">#{{ $order->id }}</span>
                                </div>
                            </td>

                            <!-- Customer -->
                            <td class="px-2 py-2 whitespace-nowrap w-32">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center shadow-sm flex-shrink-0">
                                        <i class="fas fa-user text-white text-xs"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-semibold text-gray-900 truncate" title="{{ $order->name }}">{{ Str::limit($order->name, 12) }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ Str::limit($order->user->name ?? 'Guest', 12) }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td class="px-2 py-2 w-28">
                                <div class="space-y-0.5">
                                    <div class="text-xs flex items-center gap-1">
                                        <i class="fas fa-envelope text-blue-500 text-xs flex-shrink-0"></i>
                                        <span class="text-gray-600 truncate text-xs" title="{{ $order->email }}">{{ Str::limit($order->email, 12) }}</span>
                                    </div>
                                    <div class="text-xs flex items-center gap-1">
                                        <i class="fas fa-phone text-green-500 text-xs flex-shrink-0"></i>
                                        <span class="text-gray-600 truncate text-xs">{{ Str::limit($order->phone, 12) }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Products -->
                            <td class="px-2 py-2 w-36">
                                <div class="space-y-0.5">
                                    @foreach($order->items->take(2) as $item)
                                    <div class="text-xs text-gray-600 flex items-center gap-1">
                                        <span class="inline-flex items-center px-1 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800 flex-shrink-0">
                                            {{ $item->quantity }}x
                                        </span>
                                        <span class="truncate text-xs" title="{{ $item->product->name }}">{{ Str::limit($item->product->name, 15) }}</span>
                                    </div>
                                    @endforeach
                                    @if($order->items->count() > 2)
                                    <div class="text-xs text-blue-600 font-medium">
                                        +{{ $order->items->count() - 2 }} more
                                    </div>
                                    @endif
                                </div>
                            </td>

                            <!-- Total -->
                            <td class="px-2 py-2 whitespace-nowrap w-20">
                                <div class="text-center">
                                    <div class="text-sm font-bold text-green-600">
                                        {{ number_format($order->total, 0) }}
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $order->items->count() }} items</div>
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="px-2 py-2 whitespace-nowrap text-center w-20">
                                @if($order->status == 'pending')
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-semibold bg-orange-100 text-orange-800 border border-orange-200">
                                    <div class="w-1 h-1 bg-orange-500 rounded-full mr-1 animate-pulse"></div>
                                    Pending
                                </span>
                                @elseif($order->status == 'shipping')
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                    <div class="w-1 h-1 bg-blue-500 rounded-full mr-1 animate-pulse"></div>
                                    Shipping
                                </span>
                                @elseif($order->status == 'completed')
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                    <div class="w-1 h-1 bg-green-500 rounded-full mr-1"></div>
                                    Completed
                                </span>
                                @else
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                                    <div class="w-1 h-1 bg-red-500 rounded-full mr-1"></div>
                                    {{ ucfirst($order->status) }}
                                </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-2 py-2 whitespace-nowrap text-center w-16">
                                <div class="flex items-center justify-center space-x-1">
                                    <a href="{{ route('orders.show', $order->id) }}"
                                        class="w-6 h-6 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded flex items-center justify-center transition-all duration-200 transform hover:scale-110 shadow-sm hover:shadow-md"
                                        title="View Details">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>

                                    @if($order->status == 'completed')
                                    <a href="{{ route('cart.invoice', $order->id) }}"
                                        class="w-6 h-6 bg-green-100 hover:bg-green-200 text-green-600 rounded flex items-center justify-center transition-all duration-200 transform hover:scale-110 shadow-sm hover:shadow-md"
                                        target="_blank"
                                        title="Download Invoice">
                                        <i class="fas fa-file-invoice text-xs"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            {{-- Enhanced Empty State --}}
            <div class="p-16 text-center">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-blue-100 rounded-full flex items-center justify-center mb-8 relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full opacity-20 animate-ping"></div>
                        <i class="fas fa-clipboard-list text-6xl text-transparent bg-gradient-to-r from-gray-400 to-blue-500 bg-clip-text relative z-10"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-transparent bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text mb-4">No Orders Yet</h3>
                    <p class="text-gray-500 mb-8 text-lg max-w-md">
                        No orders have been placed yet. Orders will appear here once customers start purchasing.
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('styles')
    <style>
        /* Table responsive improvements */
        .table-fixed {
            table-layout: fixed;
        }

        /* Ensure table cells don't break layout */
        .table-fixed td,
        .table-fixed th {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Compact table styling */
        .text-xs {
            font-size: 0.75rem;
            line-height: 1rem;
        }

        /* Better spacing for compact layout */
        .space-y-0\.5> :not([hidden])~ :not([hidden]) {
            margin-top: 0.125rem;
        }

        /* Chart container styling */
        .chart-container {
            position: relative;
            height: 320px;
            width: 100%;
        }

        /* Chart legend styling */
        .chart-legend {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }
    </style>

    <!-- Chart.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>
    @endpush

    @push('scripts')
    <script>
        // Wait for both DOM and Chart.js to be ready
        window.addEventListener('load', function() {
            console.log('Page fully loaded');
            
            // Check if Chart.js is available
            if (typeof Chart === 'undefined') {
                console.error('Chart.js is not loaded!');
                return;
            }
            
            console.log('Chart.js version:', Chart.version);
            
            // Simple sample data that always works
            const sampleData = {
                daily: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    revenue: [100, 150, 80, 200, 180, 220, 300],
                    orders: [1, 2, 1, 3, 2, 4, 5]
                },
                weekly: {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    revenue: [500, 750, 400, 900],
                    orders: [5, 8, 4, 12]
                },
                monthly: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    revenue: [1000, 1500, 800, 2000, 1800, 2200],
                    orders: [10, 15, 8, 20, 18, 22]
                }
            };
            
            // Try to get real data, fallback to sample data
            let chartData;
            try {
                chartData = {
                    yearly: {
                        labels: @json($monthlyLabels ?? []),
                        revenue: @json($monthlyRevenue ?? []),
                        orders: @json($monthlyOrders ?? []),
                        customers: @json($monthlyCustomers ?? [])
                    },
                    monthly: {
                        labels: @json($weeklyLabels ?? []),
                        revenue: @json($weeklyRevenue ?? []),
                        orders: @json($weeklyOrders ?? []),
                        customers: []
                    },
                    weekly: {
                        labels: @json($dailyLabels ?? []),
                        revenue: @json($dailyRevenue ?? []),
                        orders: @json($dailyOrders ?? []),
                        customers: []
                    }
                };
                
                // Use sample data if arrays are empty
                if (!chartData.yearly.labels || chartData.yearly.labels.length === 0) {
                    chartData.yearly = sampleData.monthly;
                }
                if (!chartData.monthly.labels || chartData.monthly.labels.length === 0) {
                    chartData.monthly = sampleData.weekly;
                }
                if (!chartData.weekly.labels || chartData.weekly.labels.length === 0) {
                    chartData.weekly = sampleData.daily;
                }
            } catch (error) {
                console.error('Error preparing chart data, using sample data:', error);
                chartData = {
                    yearly: sampleData.monthly,
                    monthly: sampleData.weekly,
                    weekly: sampleData.daily
                };
            }
            
            console.log('Final chart data:', chartData);

            // Initialize Revenue Chart
            const revenueCanvas = document.getElementById('revenueChart');
            if (revenueCanvas) {
                console.log('Initializing Revenue Chart...');
                try {
                    const revenueChart = new Chart(revenueCanvas, {
                        type: 'line',
                        data: {
                            labels: chartData.weekly.labels,
                            datasets: [{
                                label: 'Revenue (TK)',
                                data: chartData.weekly.revenue,
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                borderWidth: 3,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#10b981',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointRadius: 5,
                                pointHoverRadius: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 15,
                                        font: { size: 12 }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    display: true,
                                    grid: { display: false },
                                    ticks: { font: { size: 10 } }
                                },
                                y: {
                                    display: true,
                                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                                    ticks: {
                                        font: { size: 10 }
                                    }
                                }
                            }
                        }
                    });
                    
                    // Store chart reference for updates
                    window.revenueChart = revenueChart;
                    console.log('Revenue Chart created successfully');
                } catch (error) {
                    console.error('Error creating Revenue Chart:', error);
                }
            } else {
                console.error('Revenue chart canvas not found');
            }

            // Initialize Orders Chart
            const ordersCanvas = document.getElementById('ordersChart');
            if (ordersCanvas) {
                console.log('Initializing Orders Chart...');
                try {
                    const ordersChart = new Chart(ordersCanvas, {
                        type: 'bar',
                        data: {
                            labels: chartData.weekly.labels,
                            datasets: [{
                                label: 'Orders',
                                data: chartData.weekly.orders,
                                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                borderColor: '#3b82f6',
                                borderWidth: 2,
                                borderRadius: 6,
                                borderSkipped: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 15,
                                        font: { size: 12 }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    display: true,
                                    grid: { display: false },
                                    ticks: { font: { size: 10 } }
                                },
                                y: {
                                    display: true,
                                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                                    ticks: {
                                        font: { size: 10 },
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                    
                    // Store chart reference for updates
                    window.ordersChart = ordersChart;
                    console.log('Orders Chart created successfully');
                } catch (error) {
                    console.error('Error creating Orders Chart:', error);
                }
            } else {
                console.error('Orders chart canvas not found');
            }

            // Global chart update functions
            window.updateRevenueChart = function(period) {
                if (!window.revenueChart) return;
                
                console.log('Updating revenue chart for period:', period);
                let data = chartData.weekly;
                if (period === 'weekly') data = chartData.monthly;
                if (period === 'monthly') data = chartData.yearly;
                
                window.revenueChart.data.labels = data.labels;
                window.revenueChart.data.datasets[0].data = data.revenue;
                window.revenueChart.update('active');
                
                // Update button states
                document.querySelectorAll('.chart-toggle').forEach(btn => {
                    btn.classList.remove('bg-white/20', 'text-white');
                    btn.classList.add('bg-white/10', 'text-gray-300');
                });
                event.target.classList.add('bg-white/20', 'text-white');
                event.target.classList.remove('bg-white/10', 'text-gray-300');
            };

            window.updateOrdersChart = function(period) {
                if (!window.ordersChart) return;
                
                console.log('Updating orders chart for period:', period);
                let data = chartData.weekly;
                if (period === 'month') data = chartData.yearly;
                
                window.ordersChart.data.labels = data.labels;
                window.ordersChart.data.datasets[0].data = data.orders;
                window.ordersChart.update('active');
                
                // Update button states
                document.querySelectorAll('.order-toggle').forEach(btn => {
                    btn.classList.remove('bg-white/20', 'text-white');
                    btn.classList.add('bg-white/10', 'text-gray-300');
                });
                event.target.classList.add('bg-white/20', 'text-white');
                event.target.classList.remove('bg-white/10', 'text-gray-300');
            };
        });

            // Global chart update functions
            window.updateRevenueChart = function(period) {
                if (!revenueChart) return;
                
                let data = chartData.weekly; // default
                if (period === 'daily') {
                    data = chartData.weekly;
                } else if (period === 'weekly') {
                    data = chartData.monthly;
                } else if (period === 'monthly') {
                    data = chartData.yearly;
                }
                
                revenueChart.data.labels = data.labels;
                revenueChart.data.datasets[0].data = data.revenue;
                revenueChart.update('active');
                
                // Update active button state
                document.querySelectorAll('.chart-toggle').forEach(btn => {
                    btn.classList.remove('bg-white/20', 'text-white');
                    btn.classList.add('bg-white/10', 'text-gray-300');
                });
                event.target.classList.add('bg-white/20', 'text-white');
                event.target.classList.remove('bg-white/10', 'text-gray-300');
            };

            window.updateOrdersChart = function(period) {
                if (!ordersChart) return;
                
                let data = chartData.weekly; // default
                if (period === 'week') {
                    data = chartData.weekly;
                } else if (period === 'month') {
                    data = chartData.yearly;
                }
                
                ordersChart.data.labels = data.labels;
                ordersChart.data.datasets[0].data = data.orders;
                ordersChart.update('active');
                
                // Update active button state
                document.querySelectorAll('.order-toggle').forEach(btn => {
                    btn.classList.remove('bg-white/20', 'text-white');
                    btn.classList.add('bg-white/10', 'text-gray-300');
                });
                event.target.classList.add('bg-white/20', 'text-white');
                event.target.classList.remove('bg-white/10', 'text-gray-300');
            };

            // Chart configurations for main analytics chart
            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#1D293D',
                        borderWidth: 1
                    }
                },
                scales: {
                    x: {
                        display: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    },
                    y: {
                        display: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            };

            // Initialize main analytics chart
            const ctx = document.getElementById('revenueOrdersChart');
            let mainChart = null;
            if (ctx) {
                mainChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: chartData.yearly.labels,
                        datasets: [{
                                label: 'Revenue (TK)',
                                data: chartData.yearly.revenue,
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                borderWidth: 3,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#10b981',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointRadius: 6,
                                pointHoverRadius: 8
                            },
                            {
                                label: 'Orders',
                                data: chartData.yearly.orders,
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                borderWidth: 3,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#3b82f6',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointRadius: 6,
                                pointHoverRadius: 8,
                                yAxisID: 'y1'
                            },
                            {
                                label: 'New Customers',
                                data: chartData.yearly.customers,
                                borderColor: '#8b5cf6',
                                backgroundColor: 'rgba(139, 92, 246, 0.1)',
                                borderWidth: 3,
                                fill: false,
                                tension: 0.4,
                                pointBackgroundColor: '#8b5cf6',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointRadius: 6,
                                pointHoverRadius: 8,
                                yAxisID: 'y1'
                            }
                        ]
                    },
                    options: {
                        ...chartOptions,
                        scales: {
                            x: {
                                display: true,
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            y: {
                                type: 'linear',
                                display: true,
                                position: 'left',
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.1)'
                                },
                                ticks: {
                                    font: {
                                        size: 11
                                    },
                                    callback: function(value) {
                                        return 'TK ' + value.toLocaleString();
                                    }
                                }
                            },
                            y1: {
                                type: 'linear',
                                display: true,
                                position: 'right',
                                grid: {
                                    drawOnChartArea: false,
                                },
                                ticks: {
                                    font: {
                                        size: 11
                                    }
                                }
                            }
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });

            // Period selector functionality
            document.querySelectorAll('.chart-period-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (!mainChart) return;

                    document.querySelectorAll('.chart-period-btn').forEach(b => {
                        b.classList.remove('bg-[#1D293D]', 'text-white', 'active');
                        b.classList.add('text-gray-600');
                    });

                    this.classList.add('bg-[#1D293D]', 'text-white', 'active');
                    this.classList.remove('text-gray-600');

                    const period = this.dataset.period;
                    let data = chartData.yearly;

                    if (period === 'month') {
                        data = chartData.monthly;
                    } else if (period === 'week') {
                        data = chartData.weekly;
                    }

                    mainChart.data.labels = data.labels;
                    mainChart.data.datasets[0].data = data.revenue;
                    mainChart.data.datasets[1].data = data.orders;
                    mainChart.data.datasets[2].data = data.customers;
                    mainChart.update('active');
                });
            });

            // Dataset visibility toggles with safety checks
            const showRevenueBtn = document.getElementById('showRevenueBtn');
            if (showRevenueBtn && mainChart) {
                showRevenueBtn.addEventListener('click', function() {
                    const dataset = mainChart.data.datasets[0];
                    dataset.hidden = !dataset.hidden;
                    this.style.opacity = dataset.hidden ? '0.5' : '1';
                    mainChart.update();
                });
            }

            const showOrdersBtn = document.getElementById('showOrdersBtn');
            if (showOrdersBtn && mainChart) {
                showOrdersBtn.addEventListener('click', function() {
                    const dataset = mainChart.data.datasets[1];
                    dataset.hidden = !dataset.hidden;
                    this.style.opacity = dataset.hidden ? '0.5' : '1';
                    mainChart.update();
                });
            }

            const showCustomersBtn = document.getElementById('showCustomersBtn');
            if (showCustomersBtn && mainChart) {
                showCustomersBtn.addEventListener('click', function() {
                    const dataset = mainChart.data.datasets[2];
                    dataset.hidden = !dataset.hidden;
                    this.style.opacity = dataset.hidden ? '0.5' : '1';
                    mainChart.update();
                });
            }
                const dataset = mainChart.data.datasets[1];
                dataset.hidden = !dataset.hidden;
                this.style.opacity = dataset.hidden ? '0.5' : '1';
                mainChart.update();
            });

            document.getElementById('showCustomersBtn').addEventListener('click', function() {
                const dataset = mainChart.data.datasets[2];
                dataset.hidden = !dataset.hidden;
                this.style.opacity = dataset.hidden ? '0.5' : '1';
                mainChart.update();
            });

            // Category Chart (Doughnut)
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: categoryLabels,
                    datasets: [{
                        data: categoryData,
                        backgroundColor: [
                            '#10b981', // emerald
                            '#3b82f6', // blue
                            '#8b5cf6', // purple
                            '#f59e0b', // amber
                            '#ef4444', // red
                            '#06b6d4', // cyan
                            '#84cc16', // lime
                            '#f97316' // orange
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 15,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.raw / total) * 100).toFixed(1);
                                    return context.label + ': ' + context.raw + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });

            // Top Products Chart (Bar)
            const topProductsCtx = document.getElementById('topProductsChart').getContext('2d');
            new Chart(topProductsCtx, {
                type: 'bar',
                data: {
                    labels: topProductsLabels,
                    datasets: [{
                        label: 'Units Sold',
                        data: topProductsData,
                        backgroundColor: [
                            '#f97316', // orange
                            '#f59e0b', // amber
                            '#eab308', // yellow
                            '#84cc16', // lime
                            '#22c55e' // green
                        ],
                        borderColor: [
                            '#ea580c',
                            '#d97706',
                            '#ca8a04',
                            '#65a30d',
                            '#16a34a'
                        ],
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                title: function(context) {
                                    return context[0].label;
                                },
                                label: function(context) {
                                    return 'Sold: ' + context.raw + ' units';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            display: true,
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 10
                                },
                                maxRotation: 45
                            }
                        },
                        y: {
                            display: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                font: {
                                    size: 11
                                },
                                beginAtZero: true
                            }
                        }
                    }
                }
            });
        });

        // Date range selector
        const dateRangeSelect = document.getElementById('dateRange');
        const customDateRange = document.getElementById('customDateRange');
        const applyFilterBtn = document.getElementById('applyFilter');

        if (dateRangeSelect) {
            dateRangeSelect.addEventListener('change', function() {
                if (this.value === 'custom') {
                    customDateRange.style.display = 'flex';
                } else {
                    customDateRange.style.display = 'none';
                }
            });
        }

        // Apply filter functionality
        if (applyFilterBtn) {
            applyFilterBtn.addEventListener('click', function() {
                const selectedRange = dateRangeSelect.value;
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;

                // Show loading state
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Loading...';
                this.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-filter mr-1"></i>Apply Filter';
                    this.disabled = false;

                    // Show success message
                    showNotification('Dashboard updated successfully!', 'success');
                }, 1500);
            });
        }

        // Chart view toggles
        document.querySelectorAll('.chart-toggle').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from siblings
            this.parentNode.querySelectorAll('button').forEach(b => {
                b.classList.remove('active', 'bg-white/20', 'text-white');
                b.classList.add('bg-white/10', 'text-gray-300');
            });
            // Add active class to clicked button
            this.classList.add('active', 'bg-white/20', 'text-white');
            this.classList.remove('bg-white/10', 'text-gray-300');

            showNotification('Chart view updated', 'info');
        });
        });
        });

        // Global functions for chart interactions
        function updateRevenueChart(period) {
            // Update toggle buttons for revenue chart
            document.querySelectorAll('.chart-toggle').forEach(btn => {
                btn.classList.remove('active', 'bg-white/20', 'text-white');
                btn.classList.add('bg-white/10', 'text-gray-300');
            });
            event.target.classList.add('active', 'bg-white/20', 'text-white');
            event.target.classList.remove('bg-white/10', 'text-gray-300');

            // Here you could implement period-specific data fetching via AJAX
            showNotification(`Revenue chart updated to show ${period} data`, 'info');
            console.log('Updating revenue chart for period:', period);
        }

        function updateOrdersChart(period) {
            // Update toggle buttons for orders chart
            document.querySelectorAll('.order-toggle').forEach(btn => {
                btn.classList.remove('active', 'bg-white/20', 'text-white');
                btn.classList.add('bg-white/10', 'text-gray-300');
            });
            event.target.classList.add('active', 'bg-white/20', 'text-white');
            event.target.classList.remove('bg-white/10', 'text-gray-300');

            // Here you could implement period-specific data fetching via AJAX
            showNotification(`Order chart updated to show ${period} data`, 'info');
            console.log('Updating orders chart for period:', period);
        }

        // Show notification function
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';

            notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50`;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
    @endpush

    @endsection