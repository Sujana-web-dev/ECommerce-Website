<!-- Premium Electronics Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 pt-24">
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24"></div>
    
    <!-- Hero Content -->
    <div class="relative z-10 py-20 px-6 text-center">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-center space-x-4 mb-8">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                    <i class="fas fa-laptop text-white text-2xl"></i>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold text-white">Electronics</h1>
            </div>
            <p class="text-white/90 text-xl max-w-3xl mx-auto mb-8 leading-relaxed">
                Discover cutting-edge technology and premium electronic devices that enhance your digital lifestyle
            </p>
            <div class="flex justify-center">
                <div class="px-6 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 text-white font-medium">
                    Latest Technology • Premium Quality
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="container mx-auto px-6 relative z-10">
        <!-- Category Tabs -->
        <div class="flex justify-center mb-16">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-2 shadow-lg border border-white/50">
                <div class="flex flex-wrap gap-2">
                    @php
                    $categories = ['all' => 'All Products', 'smartphones' => 'Smartphones', 'laptops' => 'Laptops', 'tablets' => 'Tablets', 'accessories' => 'Accessories'];
                    @endphp
                    @foreach($categories as $key => $label)
                    <button onclick="filterByCategory('{{ $key }}')" id="tab-{{ $key }}" 
                            class="{{ $key == 'all' ? 'px-6 py-3 bg-blue-600 text-white rounded-xl font-semibold transition-all shadow-md' : 'px-6 py-3 text-gray-600 rounded-xl font-medium hover:bg-white/50 transition-all' }}">
                        {{ $label }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="productsGrid">
            @foreach($products as $product)
            <div class="relative bg-white/90 backdrop-blur-lg rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 group overflow-hidden border border-gray-100 product-card"
                data-category="{{ $product->category->name ?? 'electronics' }}" data-product="{{ $product->id }}">

                <!-- Product Image -->
                <div class="relative overflow-hidden aspect-square">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-200 to-indigo-200 flex items-center justify-center">
                        <i class="fas fa-laptop text-5xl text-blue-500"></i>
                    </div>
                    @endif

                    <!-- Badges -->
                    @if($product->available_stock <= 5 && $product->available_stock > 0)
                        <span class="absolute top-4 left-4 bg-blue-500 text-white px-3 py-1 text-xs font-bold rounded-full shadow-lg animate-pulse">
                            <i class="fas fa-exclamation-triangle mr-1"></i>Only {{ $product->available_stock }} left
                        </span>
                    @elseif($product->available_stock <= 0)
                        <div class="absolute inset-0 bg-black/70 flex items-center justify-center z-10">
                            <div class="text-center">
                                <div class="bg-red-600 text-white px-6 py-3 rounded-lg font-bold text-lg shadow-lg mb-2">
                                    <i class="fas fa-times-circle mr-2"></i>OUT OF STOCK
                                </div>
                                <p class="text-white text-sm">This item is currently unavailable</p>
                            </div>
                        </div>
                    @endif

                    <!-- Quick View -->
                    <div class="absolute inset-0 flex items-center justify-center bg-black/0 group-hover:bg-black/30 transition duration-500">
                        <button onclick="openQuickView({{ $product->id }})"
                            class="opacity-0 group-hover:opacity-100 px-5 py-2 bg-white/90 backdrop-blur-md text-gray-900 rounded-xl font-semibold shadow-md transition-all duration-500 transform translate-y-6 group-hover:translate-y-0">
                            <i class="fas fa-eye mr-2"></i>Quick View
                        </button>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-6 flex flex-col justify-between h-56">
                    <div>
                        <span class="text-sm text-blue-600 font-semibold tracking-wide">{{ $product->category->name ?? 'Electronics' }}</span>
                        <h3 class="text-lg font-bold text-gray-900 mt-1 line-clamp-2 group-hover:text-blue-600 transition">{{ $product->name }}</h3>
                        @if($product->details)
                        <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ Str::limit($product->details, 90) }}</p>
                        @endif
                    </div>

                    <!-- Price & Actions -->
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex items-baseline space-x-2">
                            <span class="text-2xl font-extrabold text-gray-900">TK {{ number_format($product->amount ?? 0, 2) }}</span>
                        </div>
                        
                        <!-- Stock Status & Add to Cart -->
                        <div class="flex flex-col items-end space-y-1">
                            @if($product->available_stock > 0)
                                <div class="bg-green-50 px-2 py-1 rounded-full">
                                    <span class="text-xs text-green-700 font-semibold">
                                        <i class="fas fa-check-circle mr-1"></i>Stock: {{ $product->stock }}
                                    </span>
                                </div>
                                <button class="add-to-cart-btn px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl"
                                        data-product-id="{{ $product->id }}" 
                                        data-product-name="{{ $product->name }}" 
                                        data-product-price="{{ $product->amount }}"
                                        data-product-stock="{{ $product->available_stock }}">
                                    <i class="fas fa-cart-plus mr-1"></i>Add
                                </button>
                            @else
                                <div class="bg-red-50 px-2 py-1 rounded-full">
                                    <span class="text-xs text-red-600 font-bold">
                                        <i class="fas fa-times-circle mr-1"></i>Out of Stock
                                    </span>
                                </div>
                                <button disabled class="px-4 py-2 bg-gray-300 text-gray-500 rounded-xl font-semibold cursor-not-allowed">
                                    <i class="fas fa-times mr-1"></i>Sold Out
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- No Products Found -->
        <div id="noProductsFound" class="text-center py-20 hidden">
            <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-12 shadow-xl border border-white/50 max-w-2xl mx-auto">
                <div class="mb-6">
                    <i class="fas fa-search text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">No Products Found</h3>
                    <p class="text-gray-600 text-lg">Sorry, we couldn't find any products in this category.</p>
                </div>
                <button onclick="filterByCategory('all')" class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg">
                    <i class="fas fa-arrow-left"></i>
                    <span>View All Products</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Premium Quick View Modal -->
<div id="quickViewModal" class="fixed inset-0 bg-black/50 hidden z-50 p-4" style="display: none;">
    <div class="flex items-center justify-center min-h-screen py-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full relative overflow-hidden max-h-[90vh] overflow-y-auto">
            
            <!-- Close Button -->
            <button onclick="closeQuickView()" class="absolute top-4 right-4 z-10 w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors">
                <i class="fas fa-times text-gray-600"></i>
            </button>

            <!-- Modal Content -->
            <div id="quickViewContent" class="p-8">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
// Category filtering
function filterByCategory(category) {
    const products = document.querySelectorAll('.product-card');
    const tabs = document.querySelectorAll('[id^="tab-"]');
    
    // Update tab styles
    tabs.forEach(tab => {
        if (tab.id === `tab-${category}`) {
            tab.className = 'px-6 py-3 bg-blue-600 text-white rounded-xl font-semibold transition-all shadow-md';
        } else {
            tab.className = 'px-6 py-3 text-gray-600 rounded-xl font-medium hover:bg-white/50 transition-all';
        }
    });
    
    let visibleCount = 0;
    products.forEach(product => {
        const productCategory = product.dataset.category;
        if (category === 'all' || productCategory === category) {
            product.style.display = 'block';
            visibleCount++;
        } else {
            product.style.display = 'none';
        }
    });
    
    // Show/hide "No Products Found" message
    document.getElementById('noProductsFound').classList.toggle('hidden', visibleCount > 0);
}

// Quick View Modal
function openQuickView(productId) {
    document.getElementById('quickViewModal').style.display = 'block';
    document.getElementById('quickViewModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Load product details (you can fetch via AJAX here)
    document.getElementById('quickViewContent').innerHTML = `
        <div class="text-center py-8">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
            <p class="text-gray-600">Loading product details...</p>
        </div>
    `;
}

function closeQuickView() {
    document.getElementById('quickViewModal').style.display = 'none';
    document.getElementById('quickViewModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Add to Cart
function addToCart(productId) {
    // Add your cart logic here
    alert('Product added to cart!');
}

// Add to Wishlist
function addToWishlist(productId) {
    // Add your wishlist logic here
    alert('Product added to wishlist!');
}

// Close modal when clicking outside
document.getElementById('quickViewModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeQuickView();
    }
});
</script>

<!-- Essential Styles -->
<style>
    /* Line clamp utility for text truncation */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Modal backdrop blur */
    .modal-backdrop {
        backdrop-filter: blur(8px);
    }

    /* Custom scrollbar for modal */
    .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Animation for product cards */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-card {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Hover effects */
    .product-card:hover {
        transform: translateY(-8px);
    }
</style>