@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-slate-50 to-red-50">
    <!-- Header Section with Custom Color -->
    <div class="bg-gradient-to-r from-[#1D293D] to-gray-900 shadow-2xl">
        <div class="px-4 py-4">
            {{-- Breadcrumb --}}
            <div class="flex items-center text-sm text-gray-300 mb-3">
                <span class="hover:text-white transition-colors cursor-pointer">Dashboard</span>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-white font-medium">Cancelled Orders</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-semibold text-white mb-1">
                        ❌ Cancelled Orders ({{ $orders->count() }})
                    </h1>
                    <p class="text-sm text-gray-200">Review and manage cancelled orders</p>
                </div>
                <div class="text-white text-sm bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2">
                    Total Lost Revenue:
                    <span class="font-bold">
                        TK: {{ number_format($orders->sum('total'), 0) }}
                    </span>
                </div>
            </div>

            <!-- Order Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <div class="text-lg font-bold text-red-300">
                        {{ $orders->count() }}
                    </div>
                    <div class="text-xs text-gray-300">Cancelled Orders</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <div class="text-lg font-bold text-orange-300">
                        TK: {{ number_format($orders->sum('total'), 0) }}
                    </div>
                    <div class="text-xs text-gray-300">Lost Revenue</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <div class="text-lg font-bold text-pink-300">
                        {{ $orders->sum(function($order) { return $order->items->count(); }) }}
                    </div>
                    <div class="text-xs text-gray-300">Cancelled Items</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <div class="text-lg font-bold text-cyan-300">
                        {{ $orders->where('updated_at', '>=', now()->startOfDay())->count() }}
                    </div>
                    <div class="text-xs text-gray-300">Today's Cancellations</div>
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
                <a href="{{ route('orders.shipping') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2 text-sm">
                    <i class="fas fa-shipping-fast"></i> Shipping
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
                <h2 class="text-lg font-medium text-white flex items-center gap-2">
                    <i class="fas fa-times-circle text-red-300"></i>
                    Cancelled Orders Management
                </h2>
            </div>

            @if($orders->count() > 0)
            {{-- Table Container --}}
            <div class="overflow-hidden">
                <div class="overflow-x-auto max-h-[600px]" style="scrollbar-width: thin; scrollbar-color: #ef4444 transparent;">
                    <table class="w-full table-fixed">
                        <thead class="bg-gradient-to-r from-red-50 to-rose-50 sticky top-0 z-10">
                            <tr>
                                <th class="w-20 px-4 py-3 text-left text-xs font-medium text-gray-600 border-b border-gray-200">
                                    Order ID
                                </th>
                                <th class="w-44 px-4 py-3 text-left text-xs font-medium text-gray-600 border-b border-gray-200">
                                    Customer & Contact
                                </th>
                                <th class="w-56 px-4 py-3 text-left text-xs font-medium text-gray-600 border-b border-gray-200">
                                    Products
                                </th>
                                <th class="w-28 px-4 py-3 text-left text-xs font-medium text-gray-600 border-b border-gray-200">
                                    Total Amount
                                </th>
                                <th class="w-24 px-4 py-3 text-left text-xs font-medium text-gray-600 border-b border-gray-200">
                                    Status
                                </th>
                                <th class="w-32 px-4 py-3 text-left text-xs font-medium text-gray-600 border-b border-gray-200">
                                    Cancelled Date
                                </th>
                                <th class="w-40 px-4 py-3 text-left text-xs font-medium text-gray-600 border-b border-gray-200">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($orders as $order)
                            <tr class="group hover:bg-red-50/30 transition-colors duration-200">
                                {{-- Order ID --}}
                                <td class="px-4 py-3">
                                    <div class="text-sm font-semibold text-red-700 bg-red-50 px-2 py-1 rounded-lg inline-block">
                                        #{{ $order->id }}
                                    </div>
                                </td>

                                {{-- Customer & Contact --}}
                                <td class="px-4 py-3">
                                    <div class="space-y-1">
                                        <div class="text-sm font-medium text-gray-900 truncate">
                                            {{ $order->name }}
                                        </div>
                                        <div class="text-xs text-gray-500 truncate">
                                            <i class="fas fa-user text-gray-400"></i>
                                            {{ $order->user->name ?? 'Guest' }}
                                        </div>
                                        <div class="text-xs text-gray-500 truncate">
                                            <i class="fas fa-envelope text-gray-400"></i>
                                            {{ $order->email }}
                                        </div>
                                        <div class="text-xs text-gray-500 truncate">
                                            <i class="fas fa-phone text-gray-400"></i>
                                            {{ $order->phone }}
                                        </div>
                                    </div>
                                </td>

                                {{-- Products --}}
                                <td class="px-4 py-3">
                                    <div class="space-y-1">
                                        @foreach($order->items->take(2) as $item)
                                            <div class="flex items-center gap-2">
                                                <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                                    {{ $item->quantity }}x
                                                </span>
                                                <span class="text-sm text-gray-600 truncate">
                                                    {{ Str::limit($item->product->name, 25) }}
                                                </span>
                                            </div>
                                        @endforeach
                                        @if($order->items->count() > 2)
                                            <div class="text-xs text-gray-400 italic">
                                                +{{ $order->items->count() - 2 }} more items
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                {{-- Total Amount --}}
                                <td class="px-4 py-3">
                                    <div class="text-lg font-bold text-red-700">
                                        TK: {{ number_format($order->total, 0) }}
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center gap-1 bg-gradient-to-r from-red-100 to-rose-100 text-red-700 text-xs font-medium px-3 py-1 rounded-full border border-red-200">
                                        <i class="fas fa-times-circle"></i>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                {{-- Cancelled Date --}}
                                <td class="px-4 py-3">
                                    <div class="text-sm text-gray-600">
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-calendar text-gray-400"></i>
                                            {{ $order->updated_at->format('M d, Y') }}
                                        </div>
                                        <div class="flex items-center gap-1 text-xs text-gray-500">
                                            <i class="fas fa-clock text-gray-400"></i>
                                            {{ $order->updated_at->format('g:i A') }}
                                        </div>
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('orders.show', $order->id) }}" 
                                           class="inline-flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200">
                                            <i class="fas fa-eye"></i>
                                            View
                                        </a>
                                        
                                        {{-- Restore Order Option --}}
                                        <button onclick="restoreOrder('{{ $order->id }}')" 
                                                class="inline-flex items-center gap-1 bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200">
                                            <i class="fas fa-undo"></i>
                                            Restore
                                        </button>

                                        {{-- Delete Permanently --}}
                                        <button onclick="deleteOrder('{{ $order->id }}')" 
                                                class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm font-medium transition-colors duration-200">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            {{-- Empty State --}}
            <div class="text-center py-16">
                <div class="text-6xl mb-4 animate-bounce">❌</div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Cancelled Orders</h3>
                <p class="text-gray-500 mb-4">No orders have been cancelled.</p>
                <a href="{{ route('orders') }}" class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl font-medium transition-colors duration-200">
                    <i class="fas fa-list"></i>
                    View All Orders
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Custom Scrollbar Styles --}}
<style>
/* Custom scrollbar */
.overflow-x-auto::-webkit-scrollbar {
    height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #ef4444;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #dc2626;
}

/* Table fixed layout improvements */
.table-fixed {
    table-layout: fixed;
}

.table-fixed td, .table-fixed th {
    word-wrap: break-word;
    overflow-wrap: break-word;
}
</style>

<script>
function restoreOrder(orderId) {
    if (confirm('Are you sure you want to restore this cancelled order to pending?')) {
        fetch(`/orders/${orderId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: 'pending' })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to restore order');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to restore order');
        });
    }
}

function deleteOrder(orderId) {
    if (confirm('Are you sure you want to permanently delete this order? This action cannot be undone.')) {
        fetch(`/orders/${orderId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to delete order');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to delete order');
        });
    }
}
</script>
@endsection
