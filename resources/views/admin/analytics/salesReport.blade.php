@extends('admin.layouts.app')

@section('title', 'Sales Reports & Analytics')

@section('content')
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
                    <div class="text-2xl font-bold text-green-300">$124,567</div>
                    <div class="text-sm text-gray-300">Total Revenue</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-blue-300">2,847</div>
                    <div class="text-sm text-gray-300">Total Orders</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-purple-300">$43.75</div>
                    <div class="text-sm text-gray-300">Average Order Value</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-orange-300">3.24%</div>
                    <div class="text-sm text-gray-300">Conversion Rate</div>
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
                            <button class="px-3 py-1 text-xs bg-white/20 text-white rounded-full backdrop-blur-sm border border-white/30">Daily</button>
                            <button class="px-3 py-1 text-xs bg-white/10 text-gray-300 rounded-full backdrop-blur-sm border border-white/20 hover:bg-white/20 hover:text-white transition-all">Weekly</button>
                            <button class="px-3 py-1 text-xs bg-white/10 text-gray-300 rounded-full backdrop-blur-sm border border-white/20 hover:bg-white/20 hover:text-white transition-all">Monthly</button>
                        </div>
                    </div>
                </div>
                <div class="h-64 flex items-center justify-center bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl border border-gray-100">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-chart-area text-4xl mb-2 text-[#1D293D]"></i>
                        <p class="font-medium text-gray-700">Revenue Chart</p>
                        <p class="text-xs text-gray-500">Chart.js integration would go here</p>
                    </div>
                </div>
            </div>

            <!-- Orders Chart -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-6 border border-white/20">
                <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 -mx-6 -mt-6 mb-6 px-6 py-4 rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white">Order Volume</h3>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 text-xs bg-white/20 text-white rounded-full backdrop-blur-sm border border-white/30">This Week</button>
                            <button class="px-3 py-1 text-xs bg-white/10 text-gray-300 rounded-full backdrop-blur-sm border border-white/20 hover:bg-white/20 hover:text-white transition-all">This Month</button>
                        </div>
                    </div>
                </div>
                <div class="h-64 flex items-center justify-center bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl border border-gray-100">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-chart-bar text-4xl mb-2 text-[#1D293D]"></i>
                        <p class="font-medium text-gray-700">Orders Chart</p>
                        <p class="text-xs text-gray-500">Chart.js integration would go here</p>
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
                    $topProducts = [
                        ['name' => 'Wireless Bluetooth Headphones', 'sold' => 342, 'revenue' => '$15,390', 'trend' => '+12%'],
                        ['name' => 'Smart Watch Pro', 'sold' => 287, 'revenue' => '$28,700', 'trend' => '+8%'],
                        ['name' => 'Gaming Mouse RGB', 'sold' => 234, 'revenue' => '$7,020', 'trend' => '+15%'],
                        ['name' => 'Laptop Stand Adjustable', 'sold' => 198, 'revenue' => '$5,940', 'trend' => '+5%'],
                        ['name' => 'Portable Charger 10000mAh', 'sold' => 167, 'revenue' => '$4,175', 'trend' => '+3%']
                    ];
                    @endphp

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
                            <p class="font-semibold text-gray-900 text-sm">{{ $product['revenue'] }}</p>
                            <p class="text-xs text-green-600">{{ $product['trend'] }}</p>
                        </div>
                    </div>
                    @endforeach
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
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">New Customers</span>
                            <span class="text-sm font-semibold text-gray-900">68%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full shadow-sm" style="width: 68%"></div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Returning Customers</span>
                            <span class="text-sm font-semibold text-gray-900">32%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full shadow-sm" style="width: 32%"></div>
                        </div>
                    </div>

                    <!-- Top Customer Locations -->
                    <h4 class="font-medium text-gray-800 mb-4">Top Customer Locations</h4>
                    <div class="space-y-3">
                        @php
                        $locations = [
                            ['country' => 'United States', 'orders' => 1247, 'percentage' => 45],
                            ['country' => 'Canada', 'orders' => 689, 'percentage' => 25],
                            ['country' => 'United Kingdom', 'orders' => 423, 'percentage' => 15],
                            ['country' => 'Australia', 'orders' => 278, 'percentage' => 10],
                            ['country' => 'Germany', 'orders' => 134, 'percentage' => 5]
                        ];
                        @endphp

                        @foreach($locations as $location)
                        <div class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded-full shadow-sm"></div>
                                <span class="text-sm text-gray-700">{{ $location['country'] }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-medium text-gray-900">{{ $location['orders'] }}</span>
                                <span class="text-xs text-gray-500">({{ $location['percentage'] }}%)</span>
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
                        $recentOrders = [
                            ['id' => '#ORD-2024-001', 'customer' => 'Sarah Johnson', 'products' => 3, 'amount' => 249.99, 'status' => 'Completed', 'date' => '2024-12-15'],
                            ['id' => '#ORD-2024-002', 'customer' => 'Mike Chen', 'products' => 1, 'amount' => 399.99, 'status' => 'Processing', 'date' => '2024-12-15'],
                            ['id' => '#ORD-2024-003', 'customer' => 'Emily Rodriguez', 'products' => 2, 'amount' => 179.50, 'status' => 'Shipped', 'date' => '2024-12-14'],
                            ['id' => '#ORD-2024-004', 'customer' => 'David Wilson', 'products' => 4, 'amount' => 567.25, 'status' => 'Completed', 'date' => '2024-12-14'],
                            ['id' => '#ORD-2024-005', 'customer' => 'Lisa Parker', 'products' => 1, 'amount' => 89.99, 'status' => 'Pending', 'date' => '2024-12-13']
                        ];
                        @endphp

                        @foreach($recentOrders as $order)
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                            <!-- Order ID -->
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="w-20 h-6 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform duration-200">
                                    <span class="text-white font-bold text-xs">{{ Str::limit($order['id'], 12) }}</span>
                                </div>
                            </td>

                            <!-- Customer -->
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center shadow-sm flex-shrink-0">
                                        <i class="fas fa-user text-white text-xs"></i>
                                    </div>
                                    <div class="text-sm font-medium text-gray-900">{{ $order['customer'] }}</div>
                                </div>
                            </td>

                            <!-- Products -->
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $order['products'] }} items</div>
                            </td>

                            <!-- Amount -->
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm font-semibold text-green-600">${{ number_format($order['amount'], 2) }}</div>
                            </td>

                            <!-- Status -->
                            <td class="px-4 py-3 whitespace-nowrap">
                                @php
                                    $statusClasses = [
                                        'Completed' => 'bg-green-100 text-green-800 border-green-200',
                                        'Processing' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'Shipped' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'Pending' => 'bg-orange-100 text-orange-800 border-orange-200'
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $statusClasses[$order['status']] }}">
                                    {{ $order['status'] }}
                                </span>
                            </td>

                            <!-- Date -->
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($order['date'])->format('M d, Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Performance Summary -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
            <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4 rounded-t-2xl">
                <h3 class="text-lg font-semibold text-white">Performance Summary</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- This Week vs Last Week -->
                    <div class="text-center p-4 bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl border border-gray-100">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">This Week vs Last Week</h4>
                        <p class="text-2xl font-bold text-green-600">+15.3%</p>
                        <p class="text-xs text-gray-500 mt-1">Revenue increased</p>
                    </div>

                    <!-- This Month vs Last Month -->
                    <div class="text-center p-4 bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl border border-gray-100">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">This Month vs Last Month</h4>
                        <p class="text-2xl font-bold text-blue-600">+8.7%</p>
                        <p class="text-xs text-gray-500 mt-1">Orders increased</p>
                    </div>

                    <!-- Best Performing Day -->
                    <div class="text-center p-4 bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl border border-gray-100">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Best Performing Day</h4>
                        <p class="text-lg font-bold text-purple-600">Saturday</p>
                        <p class="text-xs text-gray-500 mt-1">$18,432 revenue</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Interactive Features -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
