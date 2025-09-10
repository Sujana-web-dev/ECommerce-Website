
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
    @endphp
    
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
                <p class="text-gray-400 font-normal text-xs">{{ $inStockProducts }} in stock • {{ $totalProducts - $inStockProducts }} out of stock</p>
                <div class="mt-4 h-1 bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-{{ $totalProducts > 0 ? ($inStockProducts / $totalProducts * 100 > 75 ? 'full' : ($inStockProducts / $totalProducts * 100 > 50 ? '3/4' : ($inStockProducts / $totalProducts * 100 > 25 ? '1/2' : '1/4'))) : '0' }} h-full bg-gradient-to-r from-orange-400 to-amber-500 rounded-full"></div>
                </div>
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
                    <p class="text-gray-500 font-normal" style="font-size: 14px;">Monthly performance tracking & insights</p>
                </div>
                <div class="flex bg-gray-100 rounded-xl p-1">
                    <button class="px-5 py-2 bg-[#1D293D] text-white rounded-lg font-medium transition-all hover:bg-[#243447]" style="font-size: 14px;">Year</button>
                    <button class="px-5 py-2 text-gray-600 rounded-lg font-normal hover:bg-white transition-all" style="font-size: 14px;">6M</button>
                    <button class="px-5 py-2 text-gray-600 rounded-lg font-normal hover:bg-white transition-all" style="font-size: 14px;">3M</button>
                </div>
            </div>
            <div class="h-80 bg-gray-50 rounded-2xl flex items-center justify-center border">
                <div class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-[#1D293D] to-[#243447] rounded-2xl flex items-center justify-center mb-6 mx-auto shadow-lg">
                        <span class="text-white text-3xl">📊</span>
                    </div>
                    <p class="font-semibold text-[#1D293D] text-lg mb-2">Chart Integration Ready</p>
                    <p class="text-gray-500 font-normal" style="font-size: 14px;">Connect your analytics platform here</p>
                    <button class="mt-6 px-6 py-3 bg-[#1D293D] text-white rounded-xl font-medium hover:bg-[#243447] transition-all shadow-md" style="font-size: 14px;">
                        Connect Now →
                    </button>
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

                <!-- Alert Activity -->
                <div class="group flex items-start space-x-3 p-3 rounded-xl hover:bg-amber-50/50 transition-all duration-200">
                    <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg flex items-center justify-center mt-0.5">
                        <span class="text-white text-sm">⚠️</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[#1D293D] font-medium text-sm">Low stock alert</p>
                        <p class="text-amber-600 text-xs font-normal mt-0.5">MacBook Air M3 - Silver</p>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs text-gray-500">Only 5 units left</span>
                            <span class="text-xs px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full font-medium">Critical</span>
                        </div>
                    </div>
                    <span class="text-xs text-gray-400 mt-0.5">3m</span>
                </div>

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
.space-y-0\.5 > :not([hidden]) ~ :not([hidden]) {
    margin-top: 0.125rem;
}
</style>
@endpush

@endsection