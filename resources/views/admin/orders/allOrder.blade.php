@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-slate-50 to-blue-50">
    <!-- Header Section with Custom Color -->
    <div class="bg-gradient-to-r from-[#1D293D] to-gray-900 shadow-2xl">
        <div class="px-6 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center text-sm text-gray-300 mb-3">
                <span class="hover:text-white transition-colors cursor-pointer">Dashboard</span>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-white font-medium">All Orders</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-white mb-1">
                        📋 All Orders ({{ $orders->count() }})
                    </h1>
                    <p class="text-gray-200">Manage all your orders and track their status</p>
                </div>
                <div class="text-white text-sm bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2">
                    Total Revenue:
                    <span class="font-bold">
                        TK: {{ number_format($orders->sum('total'), 0) }}
                    </span>
                </div>
            </div>

            <!-- Order Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-orange-300">
                        {{ $orders->where('status', 'pending')->count() }}
                    </div>
                    <div class="text-sm text-gray-300">Pending Orders</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-blue-300">
                        {{ $orders->where('status', 'shipping')->count() }}
                    </div>
                    <div class="text-sm text-gray-300">Shipping</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-green-300">
                        {{ $orders->where('status', 'completed')->count() }}
                    </div>
                    <div class="text-sm text-gray-300">Completed</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-red-300">
                        {{ $orders->where('status', 'cancelled')->count() }}
                    </div>
                    <div class="text-sm text-gray-300">Cancelled</div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 space-y-6">
        <!-- Quick Navigation -->
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-xl p-6">
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('orders') }}" class="px-6 py-3 bg-gradient-to-r from-[#1D293D] to-gray-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-list"></i> All Orders
                </a>
                <a href="{{ route('orders.pending') }}" class="px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-clock"></i> Pending
                </a>
                <a href="{{ route('orders.shipping') }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-shipping-fast"></i> Shipping
                </a>
                <a href="{{ route('orders.completed') }}" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> Completed
                </a>
                <a href="{{ route('orders.cancelled') }}" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-times-circle"></i> Cancelled
                </a>
            </div>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 px-6 py-4 rounded-xl text-green-800 shadow-sm">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle text-green-600"></i>
                {{ session('success') }}
            </div>
        </div>
        @endif

        <!-- Orders Table -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20">
            {{-- Table Header --}}
            <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white">Orders List</h3>
                    <div class="text-sm text-gray-300">
                        <span>Showing {{ $orders->count() }} orders</span>
                    </div>
                </div>
            </div>

            @if($orders->count() > 0)
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
                            <th class="px-2 py-2 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-24">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-calendar text-[#1D293D] text-xs"></i>
                                    <span>Date</span>
                                </div>
                            </th>
                            <th class="px-2 py-2 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-16">
                                <div class="flex items-center justify-center gap-1">
                                    <i class="fas fa-cogs text-[#1D293D] text-xs"></i>
                                    <span>Actions</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
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

                            <!-- Date -->
                            <td class="px-2 py-2 whitespace-nowrap w-24">
                                <div class="text-xs text-gray-900 font-medium">
                                    {{ $order->created_at->format('M d, Y') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $order->created_at->format('g:i A') }}
                                </div>
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
                    <h3 class="text-3xl font-bold text-transparent bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text mb-4">No Orders Found</h3>
                    <p class="text-gray-500 mb-8 text-lg max-w-md">
                        No orders have been placed yet. Orders will appear here once customers start purchasing.
                    </p>
                </div>
            </div>
            @endif
        </div>
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
