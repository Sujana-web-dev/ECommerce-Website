@extends('frontend.layouts.app')

@php
    $pageTitle = 'Shopping Cart';
@endphp

@section('content')
@php
    // Get cart items for authenticated or guest user
    if (! isset($cart)) {
        if (auth()->check()) {
            $cart = \App\Models\CartItem::where('user_id', auth()->id())->with('product')->get();
        } else {
            $cart = collect(session('cart', []));
        }
    }
    $cartItems = $cart;
    $subtotal = 0;
    $itemCount = 0;
@endphp

<div class="container mx-auto px-4 py-12 min-h-[400px]">
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Product Table -->
            <div class="md:col-span-2">
                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-2xl font-bold text-[#1D293D]">My Shopping Cart</h1>
                    <span class="text-lg text-gray-500 font-semibold" id="cartItemCount">{{ $cartItems->count() }} Items</span>
                </div>
                @if($cartItems->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left" id="cartTable">
                        <thead>
                            <tr class="border-b border-gray-200 text-gray-400 text-xs uppercase tracking-wider">
                                <th class="py-3">Product Details</th>
                                <th class="py-3 text-center">Quantity</th>
                                <th class="py-3 text-center">Price</th>
                                <th class="py-3 text-center">Total</th>
                                <th class="py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                        @foreach($cartItems as $item)
                            @php
                                $product = isset($item->product) ? $item->product : (isset($item['product']) ? (object)$item['product'] : null);
                                $quantity = isset($item->quantity) ? $item->quantity : (isset($item['quantity']) ? $item['quantity'] : 1);
                                $itemCount += $quantity;
                                $lineTotal = $quantity * ($product ? $product->amount : 0);
                                $subtotal += $lineTotal;
                            @endphp
                            <tr class="align-middle" data-product-id="{{ $product?->id }}">
                                <td class="py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $product?->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/64x64/f8fafc/64748b?text=No+Image' }}" alt="{{ $product?->name }}" class="w-16 h-16 object-cover rounded-lg border">
                                        <div>
                                            <div class="font-semibold text-[#1D293D] text-base">{{ $product?->name }}</div>
                                            <div class="text-xs text-gray-400 mt-1">{{ $product?->category?->name ?? '' }}</div>
                                            <button class="text-[#ec4642] text-xs hover:underline mt-2 delete-btn" data-product-id="{{ $product?->id }}">Remove</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-[#ec4642] hover:text-white text-[#1D293D] rounded transition-all duration-200 text-base decrement-btn" data-product-id="{{ $product?->id }}" @if($quantity <= 1) disabled @endif>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="px-3 py-1 border rounded text-base font-semibold min-w-[2.5rem] text-center">{{ $quantity }}</span>
                                        <button class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-[#ec4642] hover:text-white text-[#1D293D] rounded transition-all duration-200 text-base increment-btn" data-product-id="{{ $product?->id }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="py-4 text-center text-base text-gray-700">TK {{ number_format($product?->amount, 2) }}</td>
                                <td class="py-4 text-center text-base text-gray-900 font-bold">TK {{ number_format($lineTotal, 2) }}</td>
                                <td class="py-4"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-8">
                    <a href="/" class="text-[#5a4bff] text-sm font-medium hover:underline flex items-center gap-1">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>
                @else
                <div class="text-center text-gray-400 py-12 bg-white rounded-xl shadow">
                    <i class="fas fa-shopping-cart text-5xl mb-4"></i>
                    <p class="text-lg">Your cart is empty.</p>
                    <p class="text-sm text-gray-500">Add products to see them here.</p>
                </div>
                @endif
            </div>
            <!-- Order Summary -->
            <div class="bg-gray-50 rounded-2xl shadow-lg p-8 flex flex-col gap-6 min-h-[320px]">
                <h3 class="text-xl font-bold text-[#1D293D] mb-4">Order Summary</h3>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-500">Items</span>
                    <span class="font-semibold" id="summaryItemCount">{{ $itemCount }}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-500">Delivery Option</span>
                    <select class="border rounded px-2 py-1 text-sm text-gray-700 bg-white">
                        <option>Cash On Delivery</option>
                        <option>Online Payment</option>
                    </select>
                </div>
                <div class="border-t border-gray-200 my-4"></div>
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold text-lg text-[#1D293D]">Total Cost</span>
                    <span class="font-bold text-lg text-[#1D293D]" id="summaryTotal">TK {{ number_format($subtotal, 2) }}</span>
                </div>
                <a href="{{ route('checkout') }}" class="w-full bg-[#1D293D] hover:bg-[#ec4642] text-white py-3 rounded-xl font-bold text-base shadow-lg transition-all duration-300 mt-2 text-center block">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        function updateCart(productId, quantity) {
            fetch("{{ route('cart.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ product_id: productId, quantity: quantity })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function removeCart(productId) {
            fetch("{{ route('cart.remove') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        document.querySelectorAll('.increment-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const row = this.closest('tr');
                const qtySpan = row.querySelector('span');
                let quantity = parseInt(qtySpan.textContent.trim()) || 1;
                updateCart(productId, quantity + 1);
            });
        });
        document.querySelectorAll('.decrement-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const row = this.closest('tr');
                const qtySpan = row.querySelector('span');
                let quantity = parseInt(qtySpan.textContent.trim()) || 1;
                if (quantity > 1) updateCart(productId, quantity - 1);
            });
        });
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-product-id');
                removeCart(productId);
            });
        });
    });
</script>
@endsection
