@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-slate-50 to-blue-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('orders.history') }}" 
               class="inline-flex items-center bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                ← Back to Order History
            </a>
        </div>

        <!-- Order Header -->
        <div class="bg-gradient-to-r from-[#1D293D] to-gray-900 rounded-2xl shadow-2xl mb-8">
            <div class="px-8 py-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">Order #{{ $order->id }}</h1>
                        <p class="text-gray-300">Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    <div class="mt-4 lg:mt-0">
                        @if($order->status == 'pending')
                            <span class="px-6 py-3 rounded-full bg-orange-100 text-orange-800 border border-orange-300 font-bold text-lg">
                                ⏰ Pending
                            </span>
                        @elseif($order->status == 'approved')
                            <span class="px-6 py-3 rounded-full bg-blue-100 text-blue-800 border border-blue-300 font-bold text-lg">
                                ✅ Approved
                            </span>
                        @elseif($order->status == 'processing')
                            <span class="px-6 py-3 rounded-full bg-indigo-100 text-indigo-800 border border-indigo-300 font-bold text-lg">
                                🔄 Processing
                            </span>
                        @elseif($order->status == 'out_for_delivery')
                            <span class="px-6 py-3 rounded-full bg-purple-100 text-purple-800 border border-purple-300 font-bold text-lg">
                                🚚 Out for Delivery
                            </span>
                        @elseif($order->status == 'delivered')
                            <span class="px-6 py-3 rounded-full bg-green-100 text-green-800 border border-green-300 font-bold text-lg">
                                📦 Delivered
                            </span>
                        @elseif($order->status == 'cancelled')
                            <span class="px-6 py-3 rounded-full bg-red-100 text-red-800 border border-red-300 font-bold text-lg">
                                ❌ Cancelled
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2">
                <!-- Order Items -->
                <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">📦 Order Items</h2>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            @if($item->product && $item->product->image)
                                <img src="{{ $item->product->image }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-20 h-20 object-cover rounded-lg mr-4">
                            @else
                                <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center mr-4">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            @endif
                            
                            <div class="flex-grow">
                                <h3 class="font-semibold text-gray-800">{{ $item->product->name ?? 'Product Deleted' }}</h3>
                                <p class="text-gray-600">Quantity: {{ $item->quantity }}</p>
                                <p class="text-gray-600">Unit Price: TK {{ number_format($item->price, 2) }}</p>
                            </div>
                            
                            <div class="text-right">
                                <div class="text-xl font-bold text-[#ec4642]">
                                    TK {{ number_format($item->quantity * $item->price, 2) }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-gray-800">Total Amount:</span>
                            <span class="text-2xl font-bold text-[#ec4642]">TK {{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Order Timeline -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">📅 Order Timeline</h2>
                    <div class="space-y-6">
                        @php
                            $statuses = [
                                'pending' => ['icon' => '⏰', 'title' => 'Order Placed', 'color' => 'orange'],
                                'approved' => ['icon' => '✅', 'title' => 'Order Approved', 'color' => 'blue'],
                                'processing' => ['icon' => '🔄', 'title' => 'Order Processing', 'color' => 'indigo'],
                                'out_for_delivery' => ['icon' => '🚚', 'title' => 'Out for Delivery', 'color' => 'purple'],
                                'delivered' => ['icon' => '📦', 'title' => 'Order Delivered', 'color' => 'green']
                            ];
                            
                            $currentIndex = array_search($order->status, array_keys($statuses));
                        @endphp
                        
                        @foreach($statuses as $status => $info)
                            @php
                                $statusIndex = array_search($status, array_keys($statuses));
                                $isCompleted = $statusIndex <= $currentIndex;
                                $isCurrent = $status === $order->status;
                            @endphp
                            
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center {{ $isCompleted ? 'bg-'.$info['color'].'-100 border-2 border-'.$info['color'].'-500' : 'bg-gray-100 border-2 border-gray-300' }}">
                                    <span class="text-xl">{{ $info['icon'] }}</span>
                                </div>
                                <div class="ml-4 flex-grow">
                                    <div class="font-semibold {{ $isCurrent ? 'text-'.$info['color'].'-600' : ($isCompleted ? 'text-gray-800' : 'text-gray-400') }}">
                                        {{ $info['title'] }}
                                    </div>
                                    @if($isCurrent)
                                        <div class="text-sm text-{{ $info['color'] }}-500">Current Status</div>
                                    @elseif($isCompleted)
                                        <div class="text-sm text-gray-500">Completed</div>
                                    @else
                                        <div class="text-sm text-gray-400">Pending</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Customer Information -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">👤 Customer Information</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Name</label>
                            <div class="font-semibold text-gray-800">{{ $order->name }}</div>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Email</label>
                            <div class="font-semibold text-gray-800">{{ $order->email }}</div>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Phone</label>
                            <div class="font-semibold text-gray-800">{{ $order->phone }}</div>
                        </div>
                    </div>
                </div>

                <!-- Delivery Information -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">🚚 Delivery Information</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Delivery Address</label>
                            <div class="font-semibold text-gray-800">{{ $order->address }}</div>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Delivery Option</label>
                            <div class="font-semibold text-gray-800 capitalize">{{ str_replace('_', ' ', $order->delivery_option) }}</div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">📋 Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('cart.invoice', $order->id) }}" 
                           class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg font-medium transition-colors text-center block" 
                           target="_blank">
                            📄 Download Invoice
                        </a>
                        
                        @if(in_array($order->status, ['delivered']))
                            <button class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                                ⭐ Rate This Order
                            </button>
                        @endif

                        @if(in_array($order->status, ['pending', 'approved']))
                            <button onclick="cancelOrder('{{ $order->id }}')" 
                                    class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-lg font-medium transition-colors">
                                ❌ Cancel Order
                            </button>
                        @endif
                    </div>
                </div>
            </div>
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
