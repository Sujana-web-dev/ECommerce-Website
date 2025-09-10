@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-slate-50 to-blue-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Page Header -->
        <div class="bg-gradient-to-r from-[#1D293D] to-gray-900 rounded-2xl shadow-2xl mb-8">
            <div class="px-8 py-6">
                <h1 class="text-3xl font-bold text-white mb-2">📋 My Order History</h1>
                <p class="text-gray-300">Track all your orders and their current status</p>
            </div>
        </div>

        <!-- Order Statistics -->
        @if($orders->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 text-center border-l-4 border-orange-500">
                <div class="text-2xl font-bold text-orange-600">{{ $orders->where('status', 'pending')->count() }}</div>
                <div class="text-gray-600 text-sm">Pending Orders</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center border-l-4 border-blue-500">
                <div class="text-2xl font-bold text-blue-600">{{ $orders->whereIn('status', ['approved', 'processing'])->count() }}</div>
                <div class="text-gray-600 text-sm">In Progress</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center border-l-4 border-purple-500">
                <div class="text-2xl font-bold text-purple-600">{{ $orders->where('status', 'out_for_delivery')->count() }}</div>
                <div class="text-gray-600 text-sm">Out for Delivery</div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 text-center border-l-4 border-green-500">
                <div class="text-2xl font-bold text-green-600">{{ $orders->where('status', 'delivered')->count() }}</div>
                <div class="text-gray-600 text-sm">Delivered</div>
            </div>
        </div>
        @endif

        <!-- Orders List -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            @if($orders->count() > 0)
                @foreach($orders as $order)
                <div class="border-b border-gray-100 last:border-b-0">
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <!-- Order Header -->
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-4">
                            <div class="flex items-center mb-4 lg:mb-0">
                                <div class="bg-[#1D293D] text-white px-4 py-2 rounded-lg font-bold">
                                    #{{ $order->id }}
                                </div>
                                <div class="ml-4">
                                    <div class="font-semibold text-gray-800">Order Date: {{ $order->created_at->format('M d, Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $order->created_at->format('g:i A') }}</div>
                                </div>
                            </div>
                            
                            <!-- Order Status -->
                            <div class="flex items-center space-x-4">
                                @if($order->status == 'pending')
                                    <span class="px-4 py-2 rounded-full bg-orange-100 text-orange-800 border border-orange-300 font-medium">
                                        ⏰ Pending
                                    </span>
                                @elseif($order->status == 'approved')
                                    <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-800 border border-blue-300 font-medium">
                                        ✅ Approved
                                    </span>
                                @elseif($order->status == 'processing')
                                    <span class="px-4 py-2 rounded-full bg-indigo-100 text-indigo-800 border border-indigo-300 font-medium">
                                        🔄 Processing
                                    </span>
                                @elseif($order->status == 'out_for_delivery')
                                    <span class="px-4 py-2 rounded-full bg-purple-100 text-purple-800 border border-purple-300 font-medium">
                                        🚚 Out for Delivery
                                    </span>
                                @elseif($order->status == 'delivered')
                                    <span class="px-4 py-2 rounded-full bg-green-100 text-green-800 border border-green-300 font-medium">
                                        📦 Delivered
                                    </span>
                                @elseif($order->status == 'cancelled')
                                    <span class="px-4 py-2 rounded-full bg-red-100 text-red-800 border border-red-300 font-medium">
                                        ❌ Cancelled
                                    </span>
                                @endif
                                
                                <div class="text-right">
                                    <div class="text-lg font-bold text-[#ec4642]">TK {{ number_format($order->total, 2) }}</div>
                                    <div class="text-sm text-gray-500">{{ $order->items->count() }} items</div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items Preview -->
                        <div class="mb-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($order->items->take(3) as $item)
                                    <div class="bg-gray-100 px-3 py-1 rounded-lg text-sm">
                                        {{ $item->quantity }}x {{ Str::limit($item->product->name ?? 'Product Deleted', 25) }}
                                    </div>
                                @endforeach
                                @if($order->items->count() > 3)
                                    <div class="bg-gray-200 px-3 py-1 rounded-lg text-sm text-gray-600">
                                        +{{ $order->items->count() - 3 }} more items
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Order Progress Bar -->
                        @php
                            $statuses = ['pending', 'approved', 'processing', 'out_for_delivery', 'delivered'];
                            $currentIndex = array_search($order->status, $statuses);
                            $progressPercentage = $currentIndex !== false ? (($currentIndex + 1) / count($statuses)) * 100 : 0;
                        @endphp
                        
                        <div class="mb-4">
                            <div class="flex justify-between text-xs text-gray-500 mb-2">
                                <span class="{{ $order->status == 'pending' ? 'font-bold text-orange-600' : '' }}">Pending</span>
                                <span class="{{ $order->status == 'approved' ? 'font-bold text-blue-600' : '' }}">Approved</span>
                                <span class="{{ $order->status == 'processing' ? 'font-bold text-indigo-600' : '' }}">Processing</span>
                                <span class="{{ $order->status == 'out_for_delivery' ? 'font-bold text-purple-600' : '' }}">Out for Delivery</span>
                                <span class="{{ $order->status == 'delivered' ? 'font-bold text-green-600' : '' }}">Delivered</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-orange-500 via-blue-500 to-green-500 h-2 rounded-full transition-all duration-500" 
                                     style="width: {{ $progressPercentage }}%"></div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('orders.details', $order->id) }}" 
                               class="bg-[#1D293D] hover:bg-gray-800 text-white px-6 py-2 rounded-lg font-medium transition-colors text-center">
                                👁️ View Details
                            </a>
                            
                            <a href="{{ route('cart.invoice', $order->id) }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors text-center" 
                               target="_blank">
                                📄 Download Invoice
                            </a>

                            @if(in_array($order->status, ['delivered']))
                                <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                                    ⭐ Rate Order
                                </button>
                            @endif

                            @if(in_array($order->status, ['pending', 'approved']))
                                <button onclick="cancelOrder('{{ $order->id }}')" 
                                        class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                                    ❌ Cancel Order
                                </button>
                            @endif
                        </div>

                        <!-- Status Messages -->
                        @if($order->status == 'approved')
                            <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <div class="flex items-center">
                                    <div class="text-blue-600 mr-2">ℹ️</div>
                                    <div class="text-blue-800">Great news! Your order has been approved and will be processed soon.</div>
                                </div>
                            </div>
                        @elseif($order->status == 'processing')
                            <div class="mt-4 bg-indigo-50 border border-indigo-200 rounded-lg p-3">
                                <div class="flex items-center">
                                    <div class="text-indigo-600 mr-2">🔄</div>
                                    <div class="text-indigo-800">Your order is being processed and will be ready for delivery soon.</div>
                                </div>
                            </div>
                        @elseif($order->status == 'out_for_delivery')
                            <div class="mt-4 bg-purple-50 border border-purple-200 rounded-lg p-3">
                                <div class="flex items-center">
                                    <div class="text-purple-600 mr-2">🚚</div>
                                    <div class="text-purple-800">Your order is out for delivery! It should arrive soon.</div>
                                </div>
                            </div>
                        @elseif($order->status == 'delivered')
                            <div class="mt-4 bg-green-50 border border-green-200 rounded-lg p-3">
                                <div class="flex items-center">
                                    <div class="text-green-600 mr-2">🎉</div>
                                    <div class="text-green-800">Congratulations! Your order has been delivered successfully.</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">🛍️</div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No Orders Yet</h3>
                    <p class="text-gray-500 mb-6">Start shopping to see your orders here!</p>
                    <a href="{{ route('dashboard') }}" 
                       class="bg-[#1D293D] hover:bg-gray-800 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function cancelOrder(orderId) {
    if (confirm('Are you sure you want to cancel this order? This action cannot be undone.')) {
        fetch(`/orders/${orderId}/cancel`, {
            method: 'POST',
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
                alert('Failed to cancel order. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
}
</script>
@endsection
