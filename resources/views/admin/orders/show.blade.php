@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-slate-50 to-blue-50">
    <!-- Header Section with Custom Color -->
    <div class="bg-gradient-to-r from-[#1D293D] to-gray-900 shadow-2xl">
        <div class="px-6 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center text-sm text-gray-300 mb-3">
                <a href="{{ route('orders') }}" class="hover:text-white transition-colors cursor-pointer">All Orders</a>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-white font-medium">Order Details</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-white mb-1">
                        📋 Order Details #{{ $order->id }}
                    </h1>
                    <p class="text-gray-200">Placed on {{ $order->created_at->format('M d, Y h:i A') }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('orders') }}" 
                       class="bg-[#ec4642] hover:bg-red-600 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 shadow-lg hover:shadow-xl">
                        ← Back to Orders
                    </a>
                    @if($order->status == 'completed')
                        <a href="{{ route('cart.invoice', $order->id) }}" 
                           class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 shadow-lg hover:shadow-xl" 
                           target="_blank">
                           📄 Invoice
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Order Details Cards Section -->
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Customer Information -->
            <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded-lg flex items-center justify-center mr-3">
                        <span class="text-white text-lg">👤</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#1D293D]">Customer Information</h3>
                </div>
                <div class="space-y-4">
                    <div class="border-l-4 border-[#ec4642] pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Full Name</label>
                        <p class="font-semibold text-gray-800 text-lg">{{ $order->name }}</p>
                    </div>
                    <div class="border-l-4 border-blue-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Email Address</label>
                        <p class="font-semibold text-gray-800">{{ $order->email }}</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Phone Number</label>
                        <p class="font-semibold text-gray-800">{{ $order->phone }}</p>
                    </div>
                    <div class="border-l-4 border-purple-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">User Account</label>
                        <p class="font-semibold text-gray-800">{{ $order->user->name ?? 'Guest User' }}</p>
                    </div>
                </div>
            </div>

            <!-- Delivery Information -->
            <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded-lg flex items-center justify-center mr-3">
                        <span class="text-white text-lg">🚚</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#1D293D]">Delivery Information</h3>
                </div>
                <div class="space-y-4">
                    <div class="border-l-4 border-[#ec4642] pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Delivery Address</label>
                        <p class="font-semibold text-gray-800">{{ $order->address }}</p>
                    </div>
                    <div class="border-l-4 border-blue-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Delivery Option</label>
                        <p class="font-semibold text-gray-800 capitalize">{{ $order->delivery_option }}</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Order Status</label>
                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="bg-white border-2 border-gray-300 focus:border-[#ec4642] focus:outline-none rounded-lg px-4 py-2 w-full font-medium transition-all duration-200" onchange="this.form.submit()">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏰ Pending</option>
                                <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }}>✅ Approved</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>🔄 Processing</option>
                                <option value="out_for_delivery" {{ $order->status == 'out_for_delivery' ? 'selected' : '' }}>🚚 Out for Delivery</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>📦 Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded-lg flex items-center justify-center mr-3">
                        <span class="text-white text-lg">📊</span>
                    </div>
                    <h3 class="text-lg font-bold text-[#1D293D]">Order Summary</h3>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600 font-medium">Total Items</span>
                        <span class="font-bold text-[#1D293D] text-lg">{{ $order->items->sum('quantity') }} items</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600 font-medium">Delivery Charge</span>
                        <span class="font-bold text-green-600">Free</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600 font-medium">Order Date</span>
                        <span class="font-semibold text-gray-800">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="bg-gradient-to-r from-[#1D293D] to-gray-700 rounded-xl p-4 mt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-white">Grand Total</span>
                            <span class="text-2xl font-bold text-[#ec4642] bg-white px-4 py-1 rounded-lg">TK: {{ number_format($order->total, 0) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items Table -->
        <div class="bg-white shadow-xl rounded-xl p-6 mt-6 border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded-lg flex items-center justify-center mr-3">
                    <span class="text-white text-lg">📦</span>
                </div>
                <h3 class="text-lg font-bold text-[#1D293D]">Order Items Details</h3>
            </div>
            
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
                <table class="table-fixed w-full border-collapse min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-[#1D293D] to-gray-700">
                            <th class="w-2/5 text-left text-white font-semibold px-6 py-4 border border-gray-600">Product Details</th>
                            <th class="w-1/6 text-center text-white font-semibold px-6 py-4 border border-gray-600">Quantity</th>
                            <th class="w-1/6 text-center text-white font-semibold px-6 py-4 border border-gray-600">Unit Price</th>
                            <th class="w-1/6 text-center text-white font-semibold px-6 py-4 border border-gray-600">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr class="hover:bg-gray-50 border-b border-gray-200 transition-all duration-200">
                            <td class="px-6 py-4 border-r border-gray-200">
                                <div class="flex items-center gap-4">
                                    @if($item->product && $item->product->image)
                                    <img src="{{ asset('images/products/' . $item->product->image) }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200 shadow-sm">
                                    @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <span class="text-gray-400 text-2xl">📷</span>
                                    </div>
                                    @endif
                                    <div>
                                        <div class="font-semibold text-gray-800 text-lg" title="{{ $item->product->name ?? 'Product Deleted' }}">
                                            {{ Str::limit($item->product->name ?? 'Product Deleted', 30) }}
                                        </div>
                                        @if($item->product)
                                        <div class="text-sm text-gray-500 mt-1">Product ID: #{{ $item->product->id }}</div>
                                        <div class="text-xs text-[#ec4642] font-medium">{{ $item->product->productCategory->name ?? 'No Category' }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">
                                <span class="inline-block bg-[#ec4642] text-white px-4 py-2 rounded-full font-bold text-lg">
                                    {{ $item->quantity }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">
                                <span class="font-semibold text-gray-800 text-lg">TK: {{ number_format($item->price, 0) }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-bold text-[#1D293D] text-xl">TK: {{ number_format($item->price * $item->quantity, 0) }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                    <!-- Table Footer with Total -->
                    <tfoot>
                        <tr class="bg-gradient-to-r from-[#1D293D] to-gray-700">
                            <td colspan="3" class="px-6 py-4 text-right text-white font-bold text-lg border border-gray-600">
                                Grand Total:
                            </td>
                            <td class="px-6 py-4 text-center border border-gray-600">
                                <span class="inline-block bg-[#ec4642] text-white px-6 py-2 rounded-lg font-bold text-xl">
                                    TK: {{ number_format($order->total, 0) }}
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Action Buttons Section -->
        <div class="mt-6 bg-white shadow-xl rounded-xl p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-red-600 to-red-700 rounded-lg flex items-center justify-center mr-3">
                        <span class="text-white text-lg">⚠️</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-[#1D293D]">Danger Zone</h3>
                        <p class="text-sm text-gray-600">Permanently delete this order and all associated data</p>
                    </div>
                </div>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('⚠️ WARNING: Are you sure you want to permanently delete this order?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-8 py-3 rounded-lg font-bold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        🗑️ Delete Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Apply the #1D293D color theme */
    .bg-\[#1D293D\] {
        background-color: #1D293D !important;
    }
    
    .text-\[#1D293D\] {
        color: #1D293D !important;
    }
    
    .bg-\[#ec4642\] {
        background-color: #ec4642 !important;
    }
    
    .text-\[#ec4642\] {
        color: #ec4642 !important;
    }
    
    .border-\[#ec4642\] {
        border-color: #ec4642 !important;
    }
    
    .focus\:border-\[#ec4642\]:focus {
        border-color: #ec4642 !important;
    }
    
    /* Gradient backgrounds */
    .bg-gradient-to-r.from-\[#1D293D\] {
        background: linear-gradient(to right, #1D293D, #374151) !important;
    }
    
    /* Custom scrollbar styling */
    .scrollbar-thin::-webkit-scrollbar {
        height: 8px;
    }
    
    .scrollbar-thin::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #1D293D, #374151);
        border-radius: 10px;
    }
    
    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #ec4642, #dc2626);
    }
    
    /* Hover effects */
    .bg-white:hover {
        box-shadow: 0 10px 30px rgba(29, 41, 61, 0.15) !important;
        transform: translateY(-2px);
    }
    
    tbody tr:hover {
        background-color: #f9fafb !important;
        transform: scale(1.005);
        box-shadow: 0 4px 12px rgba(29, 41, 61, 0.1);
    }
    
    /* Button hover effects */
    .bg-\[#ec4642\]:hover {
        background: linear-gradient(45deg, #ec4642, #dc2626) !important;
    }
    
    select:focus {
        transform: scale(1.02);
        box-shadow: 0 0 20px rgba(236, 70, 66, 0.3) !important;
    }
</style>
@endpush

@endsection
