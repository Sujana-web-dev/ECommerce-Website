@extends('admin.layouts.app')

@section('title', 'Payment Methods Settings')

@section('content')
<div class="flex-1 p-8 bg-gradient-to-br from-gray-50 to-white min-h-screen">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">💳 Payment Methods</h1>
                <p class="text-gray-600">Configure payment gateways and processing settings</p>
            </div>
            <div class="flex space-x-3">
                <button class="px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>Add Payment Method
                </button>
                <button class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <i class="fas fa-history mr-2"></i>Transaction History
                </button>
            </div>
        </div>
    </div>

    <!-- Payment Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Active Payment Methods -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Active Methods</p>
                    <p class="text-3xl font-bold">6</p>
                    <p class="text-green-100 text-xs mt-1">✅ Currently enabled</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-credit-card text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Today's Transactions -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Today's Transactions</p>
                    <p class="text-3xl font-bold">247</p>
                    <p class="text-blue-100 text-xs mt-1">💰 $18,567 processed</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-exchange-alt text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Success Rate -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Success Rate</p>
                    <p class="text-3xl font-bold">97.8%</p>
                    <p class="text-purple-100 text-xs mt-1">📈 +2.1% from yesterday</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Failed Transactions -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm font-medium">Failed Today</p>
                    <p class="text-3xl font-bold">5</p>
                    <p class="text-red-100 text-xs mt-1">⚠️ Needs attention</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-exclamation-triangle text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Methods Configuration -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Credit Card Processors -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-credit-card mr-2 text-blue-600"></i>
                Credit Card Processors
            </h3>
            
            <div class="space-y-4">
                <!-- Stripe -->
                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fab fa-stripe text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Stripe</h4>
                                <p class="text-sm text-gray-500">Credit Cards, Apple Pay, Google Pay</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Processing Fee:</span>
                            <span class="font-medium text-gray-900 ml-1">2.9% + $0.30</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Settlement:</span>
                            <span class="font-medium text-gray-900 ml-1">2 days</span>
                        </div>
                    </div>
                    <div class="mt-3 flex space-x-2">
                        <button class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg text-sm hover:bg-blue-200 transition-colors">
                            <i class="fas fa-cog mr-1"></i>Configure
                        </button>
                        <button class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 transition-colors">
                            <i class="fas fa-chart-bar mr-1"></i>Analytics
                        </button>
                    </div>
                </div>

                <!-- PayPal -->
                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fab fa-paypal text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">PayPal</h4>
                                <p class="text-sm text-gray-500">PayPal, PayPal Credit</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Processing Fee:</span>
                            <span class="font-medium text-gray-900 ml-1">2.9% + $0.30</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Settlement:</span>
                            <span class="font-medium text-gray-900 ml-1">1 day</span>
                        </div>
                    </div>
                    <div class="mt-3 flex space-x-2">
                        <button class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg text-sm hover:bg-blue-200 transition-colors">
                            <i class="fas fa-cog mr-1"></i>Configure
                        </button>
                        <button class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 transition-colors">
                            <i class="fas fa-chart-bar mr-1"></i>Analytics
                        </button>
                    </div>
                </div>

                <!-- Square -->
                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all opacity-60">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-square text-gray-400 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-500">Square</h4>
                                <p class="text-sm text-gray-400">Credit Cards, Contactless</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                Inactive
                            </span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                    <div class="mt-3 flex space-x-2">
                        <button class="px-3 py-1.5 bg-gray-100 text-gray-500 rounded-lg text-sm">
                            <i class="fas fa-plus mr-1"></i>Setup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alternative Payment Methods -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-wallet mr-2 text-purple-600"></i>
                Alternative Payment Methods
            </h3>
            
            <div class="space-y-4">
                <!-- Bank Transfer -->
                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-university text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Bank Transfer</h4>
                                <p class="text-sm text-gray-500">Wire transfer, ACH</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Processing Fee:</span>
                            <span class="font-medium text-gray-900 ml-1">$5.00 flat</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Settlement:</span>
                            <span class="font-medium text-gray-900 ml-1">3-5 days</span>
                        </div>
                    </div>
                </div>

                <!-- Cash on Delivery -->
                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-hand-holding-usd text-orange-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Cash on Delivery</h4>
                                <p class="text-sm text-gray-500">Pay upon delivery</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Processing Fee:</span>
                            <span class="font-medium text-gray-900 ml-1">Free</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Settlement:</span>
                            <span class="font-medium text-gray-900 ml-1">On delivery</span>
                        </div>
                    </div>
                </div>

                <!-- Digital Wallets -->
                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all opacity-60">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-mobile-alt text-gray-400 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-500">Digital Wallets</h4>
                                <p class="text-sm text-gray-400">Apple Pay, Google Pay, Samsung Pay</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                Inactive
                            </span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                    <div class="mt-3 flex space-x-2">
                        <button class="px-3 py-1.5 bg-gray-100 text-gray-500 rounded-lg text-sm">
                            <i class="fas fa-plus mr-1"></i>Setup
                        </button>
                    </div>
                </div>

                <!-- Cryptocurrency -->
                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all opacity-60">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                <i class="fab fa-bitcoin text-gray-400 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-500">Cryptocurrency</h4>
                                <p class="text-sm text-gray-400">Bitcoin, Ethereum, etc.</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                Inactive
                            </span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                    <div class="mt-3 flex space-x-2">
                        <button class="px-3 py-1.5 bg-gray-100 text-gray-500 rounded-lg text-sm">
                            <i class="fas fa-plus mr-1"></i>Setup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Settings -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-6">Payment Processing Settings</h3>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- General Settings -->
            <div>
                <h4 class="font-medium text-gray-800 mb-4">General Settings</h4>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Default Currency</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>USD - US Dollar</option>
                            <option>EUR - Euro</option>
                            <option>GBP - British Pound</option>
                            <option>CAD - Canadian Dollar</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Order Amount</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2.5 text-gray-400">$</span>
                            <input type="number" value="10.00" class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Maximum Order Amount</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2.5 text-gray-400">$</span>
                            <input type="number" value="10000.00" class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Settings -->
            <div>
                <h4 class="font-medium text-gray-800 mb-4">Security Settings</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <h5 class="font-medium text-gray-800">3D Secure Authentication</h5>
                            <p class="text-sm text-gray-600">Enhanced security for card payments</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <h5 class="font-medium text-gray-800">Fraud Detection</h5>
                            <p class="text-sm text-gray-600">Automatic fraud prevention</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <h5 class="font-medium text-gray-800">SSL Encryption</h5>
                            <p class="text-sm text-gray-600">Secure payment processing</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-lock mr-1"></i>Enabled
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <button class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Cancel
            </button>
            <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-save mr-2"></i>Save Settings
            </button>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">Recent Transactions</h3>
            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All →</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Transaction ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Method</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                    $transactions = [
                        ['id' => 'TXN-2024-001', 'customer' => 'Sarah Johnson', 'method' => 'Stripe', 'amount' => 249.99, 'status' => 'Success', 'date' => '2024-12-15 10:30'],
                        ['id' => 'TXN-2024-002', 'customer' => 'Mike Chen', 'method' => 'PayPal', 'amount' => 399.99, 'status' => 'Success', 'date' => '2024-12-15 09:15'],
                        ['id' => 'TXN-2024-003', 'customer' => 'Emily Rodriguez', 'method' => 'Bank Transfer', 'amount' => 179.50, 'status' => 'Pending', 'date' => '2024-12-14 16:45'],
                        ['id' => 'TXN-2024-004', 'customer' => 'David Wilson', 'method' => 'Stripe', 'amount' => 567.25, 'status' => 'Failed', 'date' => '2024-12-14 14:20'],
                        ['id' => 'TXN-2024-005', 'customer' => 'Lisa Parker', 'method' => 'Cash on Delivery', 'amount' => 89.99, 'status' => 'Success', 'date' => '2024-12-13 11:10']
                    ];
                    @endphp

                    @foreach($transactions as $transaction)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-blue-600">{{ $transaction['id'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $transaction['customer'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $transaction['method'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">${{ number_format($transaction['amount'], 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusClasses = [
                                    'Success' => 'bg-green-100 text-green-800',
                                    'Pending' => 'bg-yellow-100 text-yellow-800',
                                    'Failed' => 'bg-red-100 text-red-800'
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses[$transaction['status']] }}">
                                {{ $transaction['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($transaction['date'])->format('M d, Y H:i') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- JavaScript for Interactive Features -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle switches for payment methods
        document.querySelectorAll('input[type="checkbox"]').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const card = this.closest('.border');
                const statusBadge = card.querySelector('.bg-green-100, .bg-gray-100');
                
                if (this.checked) {
                    card.classList.remove('opacity-60');
                    if (statusBadge) {
                        statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800';
                        statusBadge.textContent = 'Active';
                    }
                    showNotification('Payment method activated successfully!', 'success');
                } else {
                    card.classList.add('opacity-60');
                    if (statusBadge) {
                        statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500';
                        statusBadge.textContent = 'Inactive';
                    }
                    showNotification('Payment method deactivated', 'info');
                }
            });
        });

        // Configure buttons
        document.querySelectorAll('button').forEach(btn => {
            if (btn.textContent.includes('Configure')) {
                btn.addEventListener('click', function() {
                    showNotification('Configuration panel would open here', 'info');
                });
            }
            
            if (btn.textContent.includes('Analytics')) {
                btn.addEventListener('click', function() {
                    showNotification('Analytics dashboard would open here', 'info');
                });
            }
            
            if (btn.textContent.includes('Setup')) {
                btn.addEventListener('click', function() {
                    showNotification('Setup wizard would open here', 'info');
                });
            }
        });

        // Save settings
        document.querySelector('button[class*="bg-blue-600"]').addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
            this.disabled = true;

            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-save mr-2"></i>Save Settings';
                this.disabled = false;
                showNotification('Payment settings saved successfully!', 'success');
            }, 2000);
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
