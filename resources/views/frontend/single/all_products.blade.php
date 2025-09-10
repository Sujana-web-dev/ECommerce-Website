@extends('frontend.layouts.app')
@section('content')

<!-- All Products Section -->
<section class="py-20 bg-gradient-to-br from-slate-100 via-gray-50 to-zinc-100 relative overflow-hidden min-h-screen">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-gradient-to-r from-purple-400/20 to-pink-400/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-r from-blue-400/20 to-cyan-400/20 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center space-x-6 mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-[#ec4642] to-[#1D293D] rounded-3xl flex items-center justify-center shadow-2xl border-2 border-white/20">
                    <span class="text-white text-4xl">🛍️</span>
                </div>
                <div>
                    <h1 class="text-6xl font-black text-[#1D293D] tracking-tight mb-2">All Products</h1>
                    <p class="text-gray-600 text-xl">Discover our complete product collection</p>
                </div>
            </div>
            <div class="w-24 h-1 bg-gradient-to-r from-[#ec4642] to-[#1D293D] rounded-full mx-auto"></div>
        </div>

        @if(isset($products) && $products->count() > 0)
        <!-- Products Count -->
        <div class="mb-8 text-center">
            <p class="text-lg text-gray-600">
                Showing <span class="font-bold text-[#1D293D]">{{ $products->count() }}</span> 
                of <span class="font-bold text-[#1D293D]">{{ $products->total() }}</span> products
            </p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($products as $product)
            <article class="group relative bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-700 transform hover:-translate-y-2 hover:scale-105">
                <!-- Animated Border Glow -->
                <div class="absolute -inset-0.5 bg-gradient-to-r from-[#1D293D] via-purple-500 to-pink-500 rounded-3xl opacity-0 group-hover:opacity-75 blur-sm transition-all duration-700"></div>
                
                <!-- Card Content -->
                <div class="relative bg-white rounded-3xl overflow-hidden">
                    <!-- Product Image -->
                    <div class="relative overflow-hidden h-64 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
                        <img src="{{ $product->image ?? 'https://via.placeholder.com/400x300/f8fafc/64748b?text=Product' }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 filter group-hover:brightness-110">
                        
                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-[#1D293D] to-[#243447] text-white shadow-lg">
                                {{ $product->category->name ?? 'Product' }}
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="absolute top-4 right-4 flex flex-col space-y-2">
                            <button onclick="addToWishlist('{{ $product->id }}')" 
                                    class="w-10 h-10 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 hover:bg-white transition-all shadow-lg transform hover:scale-110 duration-300"
                                    title="Add to Wishlist">
                                <i class="far fa-heart text-sm"></i>
                            </button>
                            <button onclick="quickView('{{ $product->id }}')" 
                                    class="w-10 h-10 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center text-gray-600 hover:text-[#1D293D] hover:bg-white transition-all shadow-lg transform hover:scale-110 duration-300"
                                    title="Quick View">
                                <i class="fas fa-eye text-sm"></i>
                            </button>
                        </div>

                        <!-- Add to Cart Button - Slides up on hover -->
                        <div class="absolute inset-x-4 bottom-4 transform translate-y-8 group-hover:translate-y-0 transition-all duration-500 opacity-0 group-hover:opacity-100">
                            <button onclick="addToCart('{{ $product->id }}')" 
                                    class="w-full bg-gradient-to-r from-[#ec4642] to-[#c0392b] text-white py-3 rounded-2xl font-bold text-sm shadow-xl hover:from-[#d63031] hover:to-[#a93226] transition-all duration-300 transform hover:scale-105">
                                <div class="flex items-center justify-center space-x-2">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>Add to Cart</span>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-[#1D293D] transition-colors duration-300 line-clamp-2 leading-tight">
                                    {{ $product->name }}
                                </h3>
                            </div>
                        </div>

                        <!-- Rating -->
                        <div class="flex items-center space-x-1 mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }} text-xs"></i>
                            @endfor
                            <span class="text-gray-500 text-xs ml-2">(4.{{ rand(5,9) }})</span>
                        </div>

                        <!-- Price Section -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-baseline space-x-2">
                                <span class="text-xl font-black text-[#1D293D]">
                                    TK {{ number_format($product->amount ?? 0) }}
                                </span>
                                @if($product->original_price ?? false)
                                <span class="text-sm text-gray-400 line-through">
                                    TK {{ number_format($product->original_price) }}
                                </span>
                                @endif
                            </div>
                            <span class="text-xs font-semibold {{ $product->stock > 0 ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100' }} px-2 py-1 rounded-full">
                                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>

                        <!-- Quick Action Bar -->
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <div class="flex items-center space-x-3">
                                <span class="text-xs text-gray-500">Free Shipping</span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span class="text-xs text-gray-500">24h Delivery</span>
                            </div>
                            <button onclick="addToCompare('{{ $product->id }}')" 
                                    class="text-xs text-[#1D293D] hover:text-[#ec4642] font-semibold transition-colors duration-300">
                                Compare
                            </button>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $products->links('pagination::tailwind') }}
        </div>

        @else
        <!-- No Products Available -->
        <div class="text-center py-20">
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-12 shadow-xl max-w-2xl mx-auto">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-box-open text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">No Products Available</h3>
                <p class="text-gray-600 text-lg mb-8">Check back soon for our latest products!</p>
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-[#1D293D] to-[#243447] text-white rounded-xl font-semibold hover:from-[#ec4642] hover:to-[#d63031] transition-all">
                    <span>Back to Home</span>
                    <i class="fas fa-home"></i>
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-clamp: 2;
    }
</style>

<script>
    // Product interaction functions
    function addToCart(productId) {
        console.log('Adding product to cart:', productId);
        showMessage('Product added to cart!', 'success');
    }

    function addToWishlist(productId) {
        console.log('Adding product to wishlist:', productId);
        showMessage('Product added to wishlist!', 'info');
    }

    function quickView(productId) {
        console.log('Opening quick view for product:', productId);
        showMessage('Opening quick view...', 'info');
    }

    function addToCompare(productId) {
        console.log('Adding product to compare:', productId);
        showMessage('Product added to compare list!', 'info');
    }

    function showMessage(message, type = 'success') {
        const alert = document.createElement('div');
        alert.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white font-medium transform transition-all duration-300 ${
            type === 'success' ? 'bg-green-500' : 
            type === 'error' ? 'bg-red-500' : 
            'bg-blue-500'
        }`;
        alert.innerHTML = `
            <div class="flex items-center space-x-2">
                <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'exclamation' : 'info'}-circle"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(alert);
        
        setTimeout(() => {
            if (alert) {
                alert.style.transform = 'translateX(100%)';
                setTimeout(() => alert.remove(), 300);
            }
        }, 3000);
    }
</script>

@endsection
