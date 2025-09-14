@extends('frontend.layouts.master')

@section('content')
<!-- Ultra-Modern Product Listing Hero Section -->
<section class="relative min-h-[40vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-blue-900 via-purple-900 to-pink-900">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-20 left-20 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-r from-blue-500/10 to-purple-500/10 rounded-full blur-3xl animate-spin-slow"></div>
    </div>

    <div class="container relative z-10">
        <div class="text-center text-white">
            <div class="space-y-6" data-aos="fade-up">
                <h1 class="text-5xl lg:text-7xl font-bold bg-gradient-to-r from-white via-blue-100 to-purple-100 bg-clip-text text-transparent mb-6 leading-tight">
                    Product Collection
                </h1>
                <div class="w-32 h-1 bg-gradient-to-r from-blue-400 to-purple-400 mx-auto rounded-full"></div>
                <p class="text-xl lg:text-2xl text-white/80 max-w-3xl mx-auto leading-relaxed font-light">
                    Discover our curated collection of premium products
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Modern Product Grid Section -->
<section class="py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-20 right-10 w-64 h-64 bg-gradient-to-br from-blue-100/50 to-purple-100/50 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-10 w-80 h-80 bg-gradient-to-br from-purple-100/50 to-pink-100/50 rounded-full blur-3xl"></div>
    </div>

    <div class="container relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center bg-gradient-to-r from-blue-100 to-purple-100 rounded-full px-6 py-2 mb-6">
                <i class="fas fa-shopping-bag text-blue-600 mr-2"></i>
                <span class="text-gray-700 font-semibold text-sm uppercase tracking-wider">Our Products</span>
            </div>
            <h2 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent mb-6 leading-tight">
                Explore Our 
                <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Collection</span>
            </h2>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($products as $index => $product)
            <div class="group perspective-1000" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                <div class="product-card-ultra bg-white rounded-3xl shadow-lg hover:shadow-2xl transform transition-all duration-700 hover:-translate-y-4 hover:rotate-y-3 relative overflow-hidden border border-gray-100/50">
                    <!-- Enhanced Product Image -->
                    <div class="relative h-64 overflow-hidden rounded-t-3xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-400/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                        
                        @if($product['image'])
                            <img src="{{ asset('storage/' . $product['image']) }}" 
                                 alt="{{ $product['name'] }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='flex';">
                            <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center" style="display:none;">
                                <i class="fas fa-image text-gray-500 text-4xl"></i>
                            </div>
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <i class="fas fa-image text-gray-500 text-4xl"></i>
                            </div>
                        @endif

                        <!-- Out of Stock Overlay -->
                        @if(isset($product['stock']) && $product['stock'] <= 0)
                        <div class="absolute inset-0 bg-black/70 flex items-center justify-center z-20">
                            <div class="text-center">
                                <div class="bg-red-600 text-white px-6 py-3 rounded-lg font-bold text-lg shadow-lg mb-2">
                                    <i class="fas fa-times-circle mr-2"></i>OUT OF STOCK
                                </div>
                                <p class="text-white text-sm">This item is currently unavailable</p>
                            </div>
                        </div>
                        @endif

                        <!-- Low Stock Badge -->
                        @if(isset($product['stock']) && $product['stock'] > 0 && $product['stock'] <= 5)
                        <div class="absolute top-4 left-4 z-10">
                            <span class="bg-orange-500 text-white px-3 py-1 text-xs font-bold rounded-full shadow-lg animate-pulse">
                                <i class="fas fa-exclamation-triangle mr-1"></i>Only {{ $product['stock'] }} left
                            </span>
                        </div>
                        @endif
                        
                        <!-- Floating Price Badge -->
                        <div class="absolute top-4 left-4">
                            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                {{ $product['price'] }} ৳
                            </div>
                        </div>
                        
                        <!-- Quick Action Buttons -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                            <div class="flex space-x-3">
                                <button class="w-12 h-12 bg-white/90 backdrop-blur-md rounded-full shadow-xl flex items-center justify-center text-gray-600 hover:text-red-500 hover:bg-white transform hover:scale-110 transition-all duration-300">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button class="w-12 h-12 bg-white/90 backdrop-blur-md rounded-full shadow-xl flex items-center justify-center text-gray-600 hover:text-blue-500 hover:bg-white transform hover:scale-110 transition-all duration-300">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Product Info -->
                    <div class="p-6 space-y-4">
                        <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2">
                            {{ $product['name'] }}
                        </h3>
                        
                        <!-- Product Features -->
                        <div class="flex items-center space-x-4 text-sm">
                            <div class="flex items-center text-green-600">
                                <i class="fas fa-check-circle mr-1"></i>
                                <span>Quality</span>
                            </div>
                            <div class="flex items-center text-blue-600">
                                <i class="fas fa-shipping-fast mr-1"></i>
                                <span>Fast Ship</span>
                            </div>
                        </div>
                        
                        <!-- Pricing and Action -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="space-y-1">
                                <div class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    {{ $product['price'] }} ৳
                                </div>
                                <!-- Stock Status -->
                                @if(isset($product['stock']) && $product['stock'] > 0)
                                    <div class="bg-green-50 px-2 py-1 rounded-full inline-block">
                                        <span class="text-xs text-green-600 font-semibold">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Stock: {{ $product['stock'] }}
                                        </span>
                                    </div>
                                @else
                                    <div class="bg-red-50 px-2 py-1 rounded-full inline-block">
                                        <span class="text-xs text-red-600 font-bold">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            Out of Stock
                                        </span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Enhanced Add to Cart Form -->
                            @if(isset($product['stock']) && $product['stock'] > 0)
                                <button 
                                    class="add-to-cart-btn btn-modern bg-gradient-to-r from-blue-500 to-purple-600 text-white hover:from-blue-600 hover:to-purple-700 px-6 py-3 text-sm font-bold shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center space-x-2"
                                    data-product-id="{{ $product['id'] }}"
                                    data-product-name="{{ $product['name'] }}"
                                    data-product-price="{{ $product['price'] }}"
                                    data-product-image="{{ $product['image'] ?? '' }}"
                                    data-product-stock="{{ $product['stock'] }}"
                                >
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>Add to Cart</span>
                                </button>
                            @else
                                <button 
                                    class="btn-modern bg-gray-400 text-white px-6 py-3 text-sm font-bold cursor-not-allowed flex items-center space-x-2"
                                    disabled
                                >
                                    <i class="fas fa-ban"></i>
                                    <span>Out of Stock</span>
                                </button>
                            @endif
                        </div>
                        
                        <!-- Product Rating -->
                        <div class="flex items-center justify-center pt-2">
                            <div class="flex text-yellow-400 text-sm">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="text-gray-500 text-sm ml-2">({{ rand(10, 50) }})</span>
                        </div>
                    </div>
                    
                    <!-- Hover effect overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-purple-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700 rounded-3xl"></div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if(count($products) == 0)
        <div class="text-center py-20" data-aos="fade-up">
            <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-shopping-bag text-gray-400 text-4xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">No Products Found</h3>
            <p class="text-gray-600 max-w-md mx-auto">
                We couldn't find any products at the moment. Please check back later or browse our other categories.
            </p>
        </div>
        @endif

        <!-- Load More Button -->
        @if(count($products) > 8)
        <div class="text-center mt-16" data-aos="fade-up">
            <button class="btn-modern bg-gradient-to-r from-gray-800 to-gray-900 text-white hover:from-gray-900 hover:to-black px-8 py-4 text-lg font-bold shadow-lg transform hover:scale-105 transition-all duration-300">
                <i class="fas fa-plus mr-2"></i>
                Load More Products
            </button>
        </div>
        @endif
    </div>
</section>
@endsection
