@extends('frontend.layouts.app')

@php
    $pageTitle = 'Order Invoice';
@endphp

@section('content')
<div class="container mx-auto px-4 py-12 min-h-[400px]">
    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-4xl mx-auto">
        <!-- Success Message -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-[#1D293D] mb-2">Order Placed Successfully!</h1>
            <p class="text-gray-600">Thank you for your order. Here's your invoice:</p>
        </div>

        <!-- Invoice Details -->
        <div class="border border-gray-200 rounded-xl p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-[#1D293D]">Invoice</h2>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Order ID</p>
                    <p class="text-lg font-bold text-[#ec4642]">#{{ $order->id }}</p>
                </div>
            </div>

            <!-- Customer Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="font-semibold text-[#1D293D] mb-3">Customer Information</h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Name:</span> {{ $order->name }}</p>
                        <p><span class="font-medium">Email:</span> {{ $order->email }}</p>
                        <p><span class="font-medium">Phone:</span> {{ $order->phone }}</p>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-[#1D293D] mb-3">Delivery Information</h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Address:</span> {{ $order->address }}</p>
                        <p><span class="font-medium">Delivery:</span> {{ $order->delivery_option }}</p>
                        <p><span class="font-medium">Status:</span> 
                            <span class="inline-block px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                {{ $order->status }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="mb-6">
                <h3 class="font-semibold text-[#1D293D] mb-4">Order Items</h3>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="border border-gray-200 px-4 py-3 text-left text-sm font-semibold text-gray-700">Product</th>
                                <th class="border border-gray-200 px-4 py-3 text-center text-sm font-semibold text-gray-700">Qty</th>
                                <th class="border border-gray-200 px-4 py-3 text-right text-sm font-semibold text-gray-700">Price</th>
                                <th class="border border-gray-200 px-4 py-3 text-right text-sm font-semibold text-gray-700">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-200 px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-10 h-10 object-cover rounded">
                                        @endif
                                        <span class="font-medium">{{ $item->product->name ?? 'Product Deleted' }}</span>
                                    </div>
                                </td>
                                <td class="border border-gray-200 px-4 py-3 text-center">{{ $item->quantity }}</td>
                                <td class="border border-gray-200 px-4 py-3 text-right">TK {{ number_format($item->price, 2) }}</td>
                                <td class="border border-gray-200 px-4 py-3 text-right font-semibold">TK {{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order Total -->
            <div class="border-t border-gray-200 pt-4">
                <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-[#1D293D]">Total Amount:</span>
                    <span class="text-2xl font-bold text-[#ec4642]">TK {{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('dashboard') }}" class="bg-[#1D293D] hover:bg-[#ec4642] text-white px-8 py-3 rounded-xl font-bold text-center transition-all duration-300">
                Continue Shopping
            </a>
            <button onclick="window.print()" class="bg-gray-600 hover:bg-gray-700 text-white px-8 py-3 rounded-xl font-bold transition-all duration-300">
                Print Invoice
            </button>
        </div>
    </div>
</div>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    .container, .container * {
        visibility: visible;
    }
    .container {
        position: absolute;
        left: 0;
        top: 0;
    }
    button {
        display: none !important;
    }
}
</style>
@endsection
