@extends('frontend.layouts.app')

@php
    $pageTitle = 'Shopping Cart';
@endphp

@section('content')
@php
    // Cart data is now passed from CartController which uses CartService
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
                                // Handle CartService data structure
                                $product = $item['product'] ?? null;
                                $quantity = $item['quantity'] ?? 1;
                                $price = $item['price'] ?? ($product->amount ?? 0);
                                $itemCount += $quantity;
                                $lineTotal = $quantity * $price;
                                $subtotal += $lineTotal;
                            @endphp
                            <tr class="align-middle" data-product-id="{{ $product?->id ?? $item['product_id'] }}" data-stock="{{ $product?->stock ?? 0 }}">
                                <td class="py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $product?->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/64x64/f8fafc/64748b?text=No+Image' }}" alt="{{ $product?->name }}" class="w-16 h-16 object-cover rounded-lg border">
                                        <div>
                                            <div class="font-semibold text-[#1D293D] text-base">{{ $product?->name }}</div>
                                            <div class="text-xs text-gray-400 mt-1">{{ $product?->category?->name ?? '' }}</div>
                                            @if($product?->stock ?? 0 > 0)
                                                <div class="text-xs text-green-600 mt-1">
                                                    <i class="fas fa-check-circle"></i> {{ $product?->stock ?? 0 }} in stock
                                                </div>
                                            @else
                                                <div class="text-xs text-red-600 mt-1">
                                                    <i class="fas fa-exclamation-triangle"></i> Out of stock
                                                </div>
                                            @endif
                                            @if(isset($item['options']) && !empty($item['options']))
                                                <div class="text-xs text-gray-500 mt-1">
                                                    @foreach($item['options'] as $key => $value)
                                                        <span class="inline-block bg-gray-100 px-2 py-1 rounded mr-1">{{ $key }}: {{ $value }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <button class="text-[#ec4642] text-xs hover:underline mt-2 delete-btn" data-product-id="{{ $product?->id ?? $item['product_id'] }}">Remove</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-[#ec4642] hover:text-white text-[#1D293D] rounded transition-all duration-200 text-base decrement-btn" data-product-id="{{ $product?->id ?? $item['product_id'] }}" @if($quantity <= 1) disabled @endif>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="px-3 py-1 border rounded text-base font-semibold min-w-[2.5rem] text-center quantity-display">{{ $quantity }}</span>
                                        <button class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-[#ec4642] hover:text-white text-[#1D293D] rounded transition-all duration-200 text-base increment-btn" 
                                                data-product-id="{{ $product?->id ?? $item['product_id'] }}" 
                                                data-stock="{{ $product?->stock ?? 0 }}" 
                                                @if($quantity >= ($product?->stock ?? 0)) disabled title="Maximum stock reached" @endif>
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="py-4 text-center text-base text-gray-700">TK {{ number_format($price, 2) }}</td>
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

<!-- Stock Alert Modal -->
<div id="stockAlert" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95" id="stockAlertModal">
            <div class="p-6 text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Stock Limit Reached</h3>
                <p class="text-gray-600 mb-6" id="stockAlertMessage">
                    Sorry, we only have <span id="availableStock">0</span> units available for this product.
                </p>
                <div class="flex gap-3 justify-center">
                    <button onclick="closeStockAlert()" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-medium">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Stock alert popup functions
        function showStockAlert(availableStock, productName = '') {
            const modal = document.getElementById('stockAlert');
            const modalContent = document.getElementById('stockAlertModal');
            const stockSpan = document.getElementById('availableStock');
            const message = document.getElementById('stockAlertMessage');
            
            stockSpan.textContent = availableStock;
            if (productName) {
                message.innerHTML = `Sorry, we only have <span class="font-semibold">${availableStock}</span> units available for <span class="font-semibold">${productName}</span>.`;
            }
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        window.closeStockAlert = function() {
            const modal = document.getElementById('stockAlert');
            const modalContent = document.getElementById('stockAlertModal');
            
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Close modal when clicking outside
        document.getElementById('stockAlert').addEventListener('click', function(e) {
            if (e.target === this) {
                closeStockAlert();
            }
        });

        function updateCart(productId, quantity) {
            // Get the row element to access stock data
            const row = document.querySelector(`tr[data-product-id="${productId}"]`);
            const availableStock = parseInt(row.getAttribute('data-stock')) || 0;
            const productName = row.querySelector('.font-semibold').textContent;
            
            // Check stock before updating
            if (quantity > availableStock) {
                showStockAlert(availableStock, productName);
                return;
            }

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
                } else if (data.message && data.message.includes('stock')) {
                    showStockAlert(availableStock, productName);
                }
            })
            .catch(error => {
                console.error('Error updating cart:', error);
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

        // Update button states based on stock
        function updateButtonStates() {
            document.querySelectorAll('tr[data-product-id]').forEach(row => {
                const stock = parseInt(row.getAttribute('data-stock')) || 0;
                const quantitySpan = row.querySelector('.quantity-display');
                const currentQuantity = parseInt(quantitySpan.textContent) || 0;
                const incrementBtn = row.querySelector('.increment-btn');
                const decrementBtn = row.querySelector('.decrement-btn');
                
                // Update increment button state
                if (currentQuantity >= stock) {
                    incrementBtn.disabled = true;
                    incrementBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    incrementBtn.title = 'Maximum stock reached';
                } else {
                    incrementBtn.disabled = false;
                    incrementBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    incrementBtn.title = '';
                }
                
                // Update decrement button state
                if (currentQuantity <= 1) {
                    decrementBtn.disabled = true;
                    decrementBtn.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    decrementBtn.disabled = false;
                    decrementBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            });
        }

        // Initialize button states
        updateButtonStates();

        document.querySelectorAll('.increment-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.disabled) return;
                
                const productId = this.getAttribute('data-product-id');
                const stock = parseInt(this.getAttribute('data-stock')) || 0;
                const row = this.closest('tr');
                const qtySpan = row.querySelector('.quantity-display');
                let quantity = parseInt(qtySpan.textContent.trim()) || 1;
                
                if (quantity >= stock) {
                    const productName = row.querySelector('.font-semibold').textContent;
                    showStockAlert(stock, productName);
                    return;
                }
                
                updateCart(productId, quantity + 1);
            });
        });

        document.querySelectorAll('.decrement-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.disabled) return;
                
                const productId = this.getAttribute('data-product-id');
                const row = this.closest('tr');
                const qtySpan = row.querySelector('.quantity-display');
                let quantity = parseInt(qtySpan.textContent.trim()) || 1;
                
                if (quantity > 1) {
                    updateCart(productId, quantity - 1);
                }
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
