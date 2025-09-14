@extends('admin.layouts.app')

@section('title', 'Sales Reports & Analytics')

@section('content')
@php
    // Get real data from your database
    $totalRevenue = $orders->sum('total') ?? 0;
    $totalOrders = $orders->count() ?? 0;
    $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
    $completedOrders = $orders->where('status', 'completed')->count();
    $conversionRate = $totalOrders > 0 ? ($completedOrders / $totalOrders) * 100 : 0;
    
    // Get order status counts
    $pendingOrders = $orders->where('status', 'pending')->count();
    $shippingOrders = $orders->whereIn('status', ['processing', 'out_for_delivery'])->count();
    $completedOrdersCount = $orders->where('status', 'completed')->count();
    $cancelledOrders = $orders->where('status', 'cancelled')->count();
@endphp

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-slate-50 to-blue-50">
    <!-- Header Section with Custom Color -->
    <div class="bg-gradient-to-r from-[#1D293D] to-gray-900 shadow-2xl">
        <div class="px-6 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center text-sm text-gray-300 mb-3">
                <span class="hover:text-white transition-colors cursor-pointer">Dashboard</span>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-white font-medium">Sales Reports & Analytics</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-white mb-1">📈 Sales Reports & Analytics</h1>
                    <p class="text-gray-200">Monitor your business performance with detailed sales insights</p>
                </div>
                <div class="flex items-center gap-3">
                    <button class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-download"></i>
                        Export Report
                    </button>
                    <button class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-print"></i>
                        Print Report
                    </button>
                </div>
            </div>

            <!-- Key Metrics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-green-300">TK {{ number_format($totalRevenue, 0) }}</div>
                    <div class="text-sm text-gray-300">Total Revenue</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-blue-300">{{ number_format($totalOrders) }}</div>
                    <div class="text-sm text-gray-300">Total Orders</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-purple-300">TK {{ number_format($averageOrderValue, 0) }}</div>
                    <div class="text-sm text-gray-300">Average Order Value</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-orange-300">{{ number_format($conversionRate, 1) }}%</div>
                    <div class="text-sm text-gray-300">Completion Rate</div>
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
                    if($orders->isNotEmpty()) {
                        $productStats = [];
                        foreach($orders as $order) {
                            foreach($order->items as $item) {
                                if($item->product) {
                                    $productId = $item->product->id;
                                    if(!isset($productStats[$productId])) {
                                        $productStats[$productId] = [
                                            'name' => $item->product->name,
                                            'sold' => 0,
                                            'revenue' => 0
                                        ];
                                    }
                                    $productStats[$productId]['sold'] += $item->quantity;
                                    $productStats[$productId]['revenue'] += $item->price * $item->quantity;
                                }
                            }
                        }
                        $topProducts = collect($productStats)->sortByDesc('sold')->take(5)->values();
                    }
                    @endphp

                    @if($topProducts->isNotEmpty())
                        @foreach($topProducts as $index => $product)
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 border border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-r from-[#1D293D] to-gray-700 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-sm">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 text-sm">{{ Str::limit($product['name'], 25) }}</p>
                                    <p class="text-xs text-gray-500">{{ $product['sold'] }} units sold</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-900 text-sm">TK {{ number_format($product['revenue'], 0) }}</p>
                                <p class="text-xs text-green-600">Top Seller</p>
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
                        $totalCustomers = $orders->pluck('user_id')->filter()->unique()->count() + $orders->whereNull('user_id')->count();
                        $registeredCustomers = $orders->pluck('user_id')->filter()->unique()->count();
                        $guestCustomers = $orders->whereNull('user_id')->count();
                        $registeredPercentage = $totalCustomers > 0 ? ($registeredCustomers / $totalCustomers) * 100 : 0;
                        $guestPercentage = $totalCustomers > 0 ? ($guestCustomers / $totalCustomers) * 100 : 0;
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
                        $statusData = [
                            ['status' => 'Pending', 'count' => $pendingOrders, 'color' => 'from-orange-500 to-orange-600'],
                            ['status' => 'Processing/Shipping', 'count' => $shippingOrders, 'color' => 'from-blue-500 to-blue-600'],
                            ['status' => 'Completed', 'count' => $completedOrdersCount, 'color' => 'from-green-500 to-green-600'],
                            ['status' => 'Cancelled', 'count' => $cancelledOrders, 'color' => 'from-red-500 to-red-600']
                        ];
                        @endphp

                        @foreach($statusData as $status)
                        @php
                            $percentage = $totalOrders > 0 ? ($status['count'] / $totalOrders) * 100 : 0;
                        @endphp
                        <div class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 bg-gradient-to-r {{ $status['color'] }} rounded-full shadow-sm"></div>
                                <span class="text-sm text-gray-700">{{ $status['status'] }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-medium text-gray-900">{{ $status['count'] }}</span>
                                <span class="text-xs text-gray-500">({{ number_format($percentage, 1) }}%)</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20 mb-6">
            <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white">Recent High-Value Orders</h3>
                    <a href="{{ route('orders') }}" class="text-blue-300 hover:text-white text-sm font-medium transition-colors">
                        View All Orders →
                    </a>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-hashtag text-[#1D293D] text-xs"></i>
                                    <span>Order ID</span>
                                </div>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-user text-[#1D293D] text-xs"></i>
                                    <span>Customer</span>
                                </div>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-shopping-bag text-[#1D293D] text-xs"></i>
                                    <span>Products</span>
                                </div>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-money-bill text-[#1D293D] text-xs"></i>
                                    <span>Amount</span>
                                </div>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-info-circle text-[#1D293D] text-xs"></i>
                                    <span>Status</span>
                                </div>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-calendar text-[#1D293D] text-xs"></i>
                                    <span>Date</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                        // Get recent high-value orders from your actual data
                        $recentHighValueOrders = $orders->sortByDesc('total')->take(5);
                        @endphp

                        @if($recentHighValueOrders->isNotEmpty())
                            @foreach($recentHighValueOrders as $order)
                            <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                                <!-- Order ID -->
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="w-20 h-6 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform duration-200">
                                        <span class="text-white font-bold text-xs">#{{ $order->id }}</span>
                                    </div>
                                </td>

                                <!-- Customer -->
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-6 h-6 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center shadow-sm flex-shrink-0">
                                            <i class="fas fa-user text-white text-xs"></i>
                                        </div>
                                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($order->name, 15) }}</div>
                                    </div>
                                </td>

                                <!-- Products -->
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $order->items->count() }} items</div>
                                </td>

                                <!-- Amount -->
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-green-600">TK {{ number_format($order->total, 0) }}</div>
                                </td>

                                <!-- Status -->
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @php
                                        $statusClasses = [
                                            'completed' => 'bg-green-100 text-green-800 border-green-200',
                                            'processing' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                            'out_for_delivery' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'pending' => 'bg-orange-100 text-orange-800 border-orange-200',
                                            'cancelled' => 'bg-red-100 text-red-800 border-red-200'
                                        ];
                                        $statusClass = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $statusClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </td>

                                <!-- Date -->
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-2"></i>
                                    <p>No orders available yet</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- JavaScript for Interactive Features -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Prepare chart data from PHP
        @php
            // Prepare revenue data by month for the last 6 months
            $revenueData = [];
            $orderData = [];
            $labels = [];
            
            for($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $monthName = $date->format('M Y');
                $labels[] = $monthName;
                
                $monthlyRevenue = $orders->filter(function($order) use ($date) {
                    return $order->created_at->format('Y-m') === $date->format('Y-m');
                })->sum('total');
                
                $monthlyOrders = $orders->filter(function($order) use ($date) {
                    return $order->created_at->format('Y-m') === $date->format('Y-m');
                })->count();
                
                $revenueData[] = $monthlyRevenue;
                $orderData[] = $monthlyOrders;
            }
        @endphp

        const chartData = {
            labels: {!! json_encode($labels) !!},
            revenueData: {!! json_encode($revenueData) !!},
            orderData: {!! json_encode($orderData) !!}
        };

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Revenue (TK)',
                    data: chartData.revenueData,
                    borderColor: '#1D293D',
                    backgroundColor: 'rgba(29, 41, 61, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#1D293D',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'TK ' + value.toLocaleString();
                            },
                            color: '#6B7280',
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#6B7280',
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                elements: {
                    point: {
                        hoverBackgroundColor: '#ec4642'
                    }
                }
            }
        });

        // Orders Chart
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Orders Count',
                    data: chartData.orderData,
                    backgroundColor: [
                        'rgba(29, 41, 61, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(236, 70, 66, 0.8)',
                        'rgba(139, 92, 246, 0.8)'
                    ],
                    borderColor: [
                        '#1D293D',
                        '#3B82F6',
                        '#10B981',
                        '#F59E0B',
                        '#EC4642',
                        '#8B5CF6'
                    ],
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#6B7280',
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#6B7280',
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Date range selector
        const dateRangeSelect = document.getElementById('dateRange');
        const customDateRange = document.getElementById('customDateRange');
        const applyFilterBtn = document.getElementById('applyFilter');

        dateRangeSelect.addEventListener('change', function() {
            if (this.value === 'custom') {
                customDateRange.style.display = 'flex';
            } else {
                customDateRange.style.display = 'none';
            }
        });

        // Apply filter functionality
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
                showNotification('Reports updated successfully!', 'success');
            }, 1500);
        });

        // Chart view toggles
        document.querySelectorAll('[class*="bg-blue-100"]').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from siblings
                this.parentNode.querySelectorAll('button').forEach(b => {
                    b.className = 'px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-full';
                });
                // Add active class to clicked button
                this.className = 'px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full';
                
                showNotification('Chart view updated', 'info');
            });
        });
    });

    // Toggle functions for chart periods
    function updateChart(period) {
        // Update toggle buttons for revenue chart
        document.querySelectorAll('.toggle').forEach(btn => {
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
@endsection
