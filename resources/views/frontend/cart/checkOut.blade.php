@extends('frontend.layouts.app')

@php
    $pageTitle = 'Checkout';
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

@section('content')
<div class="container mx-auto px-4 py-12 min-h-[400px]">
    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-[#1D293D] mb-8">Checkout</h1>
        
        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Shipping & Payment Form -->
            <div>
                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Full Name *</label>
                        <input type="text" name="name" class="w-full border rounded px-4 py-2 @error('name') border-red-500 @enderror" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email *</label>
                        <input type="email" name="email" class="w-full border rounded px-4 py-2 @error('email') border-red-500 @enderror" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Shipping Address *</label>
                        <textarea name="address" class="w-full border rounded px-4 py-2 @error('address') border-red-500 @enderror" rows="3" required>{{ old('address') }}</textarea>
                        @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Phone Number *</label>
                        <input type="text" name="phone" class="w-full border rounded px-4 py-2 @error('phone') border-red-500 @enderror" value="{{ old('phone') }}" required>
                        @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Delivery Option *</label>
                        <select name="delivery" class="w-full border rounded px-4 py-2 @error('delivery') border-red-500 @enderror" required>
                            <option value="">Select Delivery Option</option>
                            <option value="Cash On Delivery" {{ old('delivery') == 'Cash On Delivery' ? 'selected' : '' }}>Cash On Delivery</option>
                            <option value="Online Payment" {{ old('delivery') == 'Online Payment' ? 'selected' : '' }}>Online Payment</option>
                        </select>
                        @error('delivery')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-[#1D293D] hover:bg-[#ec4642] text-white py-3 rounded-xl font-bold text-base shadow-lg transition-all duration-300 mt-2">
                        Place Order
                    </button>
                </form>
            </div>
            <!-- Order Summary -->
            <div class="bg-gray-50 rounded-2xl shadow-lg p-8 flex flex-col gap-6 min-h-[320px]">
                <h3 class="text-xl font-bold text-[#1D293D] mb-4">Order Summary</h3>
                <div class="divide-y divide-gray-200 mb-4">
                    @foreach($cartItems as $item)
                        @php
                            $product = isset($item->product) ? $item->product : (isset($item['product']) ? (object)$item['product'] : null);
                            $quantity = isset($item->quantity) ? $item->quantity : (isset($item['quantity']) ? $item['quantity'] : 1);
                            $itemCount += $quantity;
                            $lineTotal = $quantity * ($product ? $product->amount : 0);
                            $subtotal += $lineTotal;
                        @endphp
                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $product?->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/48x48/f8fafc/64748b?text=No+Image' }}" alt="{{ $product?->name }}" class="w-12 h-12 object-cover rounded border">
                                <div>
                                    <div class="font-semibold text-[#1D293D] text-sm">{{ $product?->name }}</div>
                                    <div class="text-xs text-gray-400">x{{ $quantity }}</div>
                                </div>
                            </div>
                            <div class="font-bold text-[#ec4642]">TK {{ number_format($lineTotal, 2) }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-500">Items</span>
                    <span class="font-semibold">{{ $itemCount }}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-500">Delivery</span>
                    <span class="font-semibold">Included</span>
                </div>
                <div class="border-t border-gray-200 my-4"></div>
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold text-lg text-[#1D293D]">Total Cost</span>
                    <span class="font-bold text-lg text-[#1D293D]">TK {{ number_format($subtotal, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
