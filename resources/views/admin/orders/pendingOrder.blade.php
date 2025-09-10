@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-slate-50 to-blue-50">
    <!-- Header Section with Custom Color -->
    <div class="bg-gradient-to-r from-[#1D293D] to-gray-900 shadow-2xl">
        <div class="px-4 py-4">
            {{-- Breadcrumb --}}
            <div class="flex items-center text-sm text-gray-300 mb-3">
                <span class="hover:text-white transition-colors cursor-pointer">Dashboard</span>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-white font-medium">Pending Orders</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-semibold text-white mb-1">
                        ⏰ Pending Orders ({{ $orders->count() }})
                    </h1>
                    <p class="text-sm text-gray-200">Manage and approve pending orders</p>
                </div>
                <div class="text-white text-sm bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2">
                    Total Pending:
                    <span class="font-bold">
                        TK: {{ number_format($orders->sum('total'), 0) }}
                    </span>
                </div>
            </div>

            <!-- Order Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <div class="text-lg font-bold text-orange-300">
                        {{ $orders->count() }}
                    </div>
                    <div class="text-xs text-gray-300">Pending Orders</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <div class="text-lg font-bold text-blue-300">
                        TK: {{ number_format($orders->sum('total'), 0) }}
                    </div>
                    <div class="text-xs text-gray-300">Total Value</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <div class="text-lg font-bold text-green-300">
                        {{ $orders->sum(function($order) { return $order->items->count(); }) }}
                    </div>
                    <div class="text-xs text-gray-300">Total Items</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <div class="text-lg font-bold text-yellow-300">
                        {{ $orders->where('created_at', '>=', now()->startOfDay())->count() }}
                    </div>
                    <div class="text-xs text-gray-300">Today's Orders</div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-4 space-y-6">
        <!-- Quick Navigation -->
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-xl p-4">
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('orders') }}" class="px-4 py-2 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2 text-sm">
                    <i class="fas fa-list"></i> All Orders
                </a>
                <a href="{{ route('orders.pending') }}" class="px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2 text-sm">
                    <i class="fas fa-clock"></i> Pending
                </a>
                <a href="{{ route('orders.approved') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2 text-sm">
                    <i class="fas fa-check-circle"></i> Approved
                </a>
                <a href="{{ route('orders.processing') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2 text-sm">
                    <i class="fas fa-cogs"></i> Processing
                </a>
                <a href="{{ route('orders.out_for_delivery') }}" class="px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2 text-sm">
                    <i class="fas fa-shipping-fast"></i> Out for Delivery
                </a>
                <a href="{{ route('orders.completed') }}" class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2 text-sm">
                    <i class="fas fa-check-double"></i> Completed
                </a>
                <a href="{{ route('orders.cancelled') }}" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2 text-sm">
                    <i class="fas fa-times-circle"></i> Cancelled
                </a>
            </div>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 px-4 py-3 rounded-xl text-green-800 shadow-sm">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle text-green-600"></i>
                {{ session('success') }}
            </div>
        </div>
        @endif

        <!-- Orders Table -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20">
            {{-- Table Header --}}
            <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-4 py-3">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-white">Pending Orders List</h3>
                    <div class="text-xs text-gray-300">
                        <span>Showing {{ $orders->count() }} pending orders</span>
                    </div>
                </div>
            </div>

            @if($orders->count() > 0)
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gradient-to-r from-orange-50 to-yellow-50">
                        <tr>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-20">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-hashtag text-[#1D293D] text-xs"></i>
                                    <span>ID</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-48">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-user text-[#1D293D] text-xs"></i>
                                    <span>Customer</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-44">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-phone text-[#1D293D] text-xs"></i>
                                    <span>Contact</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-56">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-shopping-bag text-[#1D293D] text-xs"></i>
                                    <span>Products</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-28">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-money-bill text-[#1D293D] text-xs"></i>
                                    <span>Total</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-28">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-clock text-[#1D293D] text-xs"></i>
                                    <span>Status</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-32">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-calendar text-[#1D293D] text-xs"></i>
                                    <span>Date</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-32">
                                <div class="flex items-center justify-center gap-1">
                                    <i class="fas fa-cogs text-[#1D293D] text-xs"></i>
                                    <span>Actions</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gradient-to-r hover:from-orange-50 hover:to-yellow-50 transition-all duration-200 group">
                            <!-- Order ID -->
                            <td class="px-3 py-3 whitespace-nowrap w-20">
                                <div class="w-10 h-6 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-200">
                                    <span class="text-white font-bold text-xs">#{{ $order->id }}</span>
                                </div>
                            </td>

                            <!-- Customer -->
                            <td class="px-3 py-3 whitespace-nowrap w-48">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-yellow-500 rounded-full flex items-center justify-center shadow-md flex-shrink-0">
                                        <i class="fas fa-user text-white text-xs"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-gray-900 truncate" title="{{ $order->name }}">{{ Str::limit($order->name, 20) }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ $order->user->name ?? 'Guest Customer' }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Contact -->
                            <td class="px-3 py-3 w-44">
                                <div class="space-y-1">
                                    <div class="text-xs flex items-center gap-1">
                                        <i class="fas fa-envelope text-blue-500 text-xs flex-shrink-0"></i>
                                        <span class="text-gray-600 truncate" title="{{ $order->email }}">{{ Str::limit($order->email, 18) }}</span>
                                    </div>
                                    <div class="text-xs flex items-center gap-1">
                                        <i class="fas fa-phone text-green-500 text-xs flex-shrink-0"></i>
                                        <span class="text-gray-600 truncate">{{ $order->phone }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Products -->
                            <td class="px-3 py-3 w-56">
                                <div class="space-y-1">
                                    @foreach($order->items->take(2) as $item)
                                    <div class="text-xs text-gray-600 flex items-center gap-1">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800 flex-shrink-0">
                                            {{ $item->quantity }}x
                                        </span>
                                        <span class="truncate" title="{{ $item->product->name }}">{{ Str::limit($item->product->name, 25) }}</span>
                                    </div>
                                    @endforeach
                                    @if($order->items->count() > 2)
                                    <div class="text-xs text-orange-600 font-medium">
                                        +{{ $order->items->count() - 2 }} more items
                                    </div>
                                    @endif
                                </div>
                            </td>

                            <!-- Total -->
                            <td class="px-3 py-3 whitespace-nowrap w-28">
                                <div class="text-center">
                                    <div class="text-sm font-bold text-orange-600">
                                        TK: {{ number_format($order->total, 0) }}
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $order->items->count() }} items</div>
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="px-3 py-3 whitespace-nowrap text-center w-28">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800 border border-orange-200">
                                    <div class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-1 animate-pulse"></div>
                                    Pending
                                </span>
                            </td>

                            <!-- Date -->
                            <td class="px-3 py-3 whitespace-nowrap w-32">
                                <div class="text-xs text-gray-900 font-medium">
                                    {{ $order->created_at->format('M d, Y') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $order->created_at->format('g:i A') }}
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="px-3 py-3 whitespace-nowrap text-center w-32">
                                <div class="flex items-center justify-center space-x-1">
                                    <a href="{{ route('orders.show', $order->id) }}"
                                       class="w-6 h-6 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-md flex items-center justify-center transition-all duration-200 transform hover:scale-110 shadow-sm hover:shadow-md"
                                       title="View Details">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>

                                    <!-- Quick Status Update -->
                                    <div class="relative inline-block">
                                        <select onchange="updateOrderStatus('{{ $order->id }}', this.value)" 
                                                class="w-20 h-6 bg-orange-100 hover:bg-orange-200 text-orange-700 rounded-md text-xs border-0 focus:ring-2 focus:ring-orange-500 cursor-pointer">
                                            <option value="">Action</option>
                                            <option value="approved">✅ Approve</option>
                                            <option value="cancelled">❌ Cancel</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            {{-- Enhanced Empty State --}}
            <div class="p-12 text-center">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-orange-100 to-yellow-100 rounded-full flex items-center justify-center mb-6 relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-orange-400 to-yellow-400 rounded-full opacity-20 animate-ping"></div>
                        <i class="fas fa-clock text-4xl text-transparent bg-gradient-to-r from-orange-400 to-yellow-500 bg-clip-text relative z-10"></i>
                    </div>
                    <h3 class="text-xl font-bold text-transparent bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text mb-3">No Pending Orders</h3>
                    <p class="text-sm text-gray-500 mb-6 max-w-md">
                        All orders have been processed! New pending orders will appear here when customers place orders.
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
/* Custom scrollbar styling */
.scrollbar-thin {
    scrollbar-width: thin;
}

.scrollbar-thin::-webkit-scrollbar {
    height: 8px;
    width: 8px;
}

.scrollbar-thin::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

.scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

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

/* Better mobile responsiveness */
@media (max-width: 1024px) {
    .w-56 {
        width: 10rem;
    }
    .w-48 {
        width: 8rem;
    }
    .w-44 {
        width: 7rem;
    }
}

@media (max-width: 768px) {
    .px-3 {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }
}
</style>
@endpush

<script>
function updateOrderStatus(orderId, status) {
    if (!status) return;
    
    if (confirm(`Are you sure you want to change this order status to ${status}?`)) {
        fetch(`/orders/${orderId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update order status');
        });
    }
}
</script>
@endsection
