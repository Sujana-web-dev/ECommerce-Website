@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Page Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}!</h1>
                    <p class="text-gray-600 mt-1">Manage your account and view your orders</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Member since</p>
                    <p class="font-medium">{{ Auth::user()->created_at->format('M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Orders -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-shopping-bag text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">{{ Auth::user()->orders()->count() }}</p>
                        <p class="text-gray-600 text-sm">Total Orders</p>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">{{ Auth::user()->orders()->where('status', 'pending')->count() }}</p>
                        <p class="text-gray-600 text-sm">Pending Orders</p>
                    </div>
                </div>
            </div>

            <!-- Completed Orders -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">{{ Auth::user()->orders()->where('status', 'completed')->count() }}</p>
                        <p class="text-gray-600 text-sm">Completed</p>
                    </div>
                </div>
            </div>

            <!-- Total Spent -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-dollar-sign text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-2xl font-bold text-gray-900">TK {{ number_format(Auth::user()->orders()->sum('total_amount'), 2) }}</p>
                        <p class="text-gray-600 text-sm">Total Spent</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Information -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Profile Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ Auth::user()->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ Auth::user()->username ?? 'Not set' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ Auth::user()->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Account Type</label>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-lg capitalize">{{ Auth::user()->role ?? 'User' }}</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-edit mr-2"></i>Edit Profile
                        </button>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Recent Orders</h2>
                        <a href="{{ route('orders.history') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All Orders</a>
                    </div>
                    
                    @php
                        $recentOrders = Auth::user()->orders()->latest()->take(5)->get();
                    @endphp
                    
                    @if($recentOrders->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentOrders as $order)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="font-medium text-gray-900">Order #{{ $order->id }}</h3>
                                            <p class="text-sm text-gray-600">{{ $order->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-semibold text-gray-900">TK {{ number_format($order->total_amount, 2) }}</p>
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                @if($order->status == 'completed') bg-green-100 text-green-800
                                                @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('orders.details', $order->id) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                            View Details →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-shopping-bag text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">No orders yet</p>
                            <a href="{{ url('/') }}" class="mt-3 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                                Start Shopping
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="space-y-6">
                <!-- Quick Actions Card -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Quick Actions</h2>
                    <div class="space-y-3">
                        <a href="{{ route('orders.history') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <i class="fas fa-history text-blue-600 mr-3"></i>
                            <span>Order History</span>
                        </a>
                        <a href="{{ route('cart.index') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <i class="fas fa-shopping-cart text-green-600 mr-3"></i>
                            <span>View Cart</span>
                        </a>
                        <a href="{{ url('/') }}" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <i class="fas fa-store text-purple-600 mr-3"></i>
                            <span>Continue Shopping</span>
                        </a>
                    </div>
                </div>

                <!-- Account Security -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Account Security</h2>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium">Password</p>
                                <p class="text-sm text-gray-600">Last updated {{ Auth::user()->updated_at->diffForHumans() }}</p>
                            </div>
                            <button class="text-blue-600 hover:text-blue-700 text-sm font-medium">Change</button>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium">Email</p>
                                <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                            </div>
                            <span class="text-green-600 text-sm font-medium">Verified</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection