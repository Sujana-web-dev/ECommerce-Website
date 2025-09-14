<!-- Premium Sports Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-br from-orange-600 via-red-500 to-pink-600 pt-24">
    <!-- Hero Content -->
    <div class="relative z-10 py-20 px-6 text-center">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-center space-x-4 mb-8">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                    <i class="fas fa-dumbbell text-white text-2xl"></i>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold text-white">Sports & Fitness</h1>
            </div>
            <p class="text-white/90 text-xl max-w-3xl mx-auto mb-8 leading-relaxed">
                Elevate your performance with our premium sports and fitness collection
            </p>
            <div class="flex justify-center">
                <div class="px-6 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 text-white font-medium">
                    Premium Athletic Gear
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-32 translate-x-32"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-24 -translate-x-24"></div>
</section>

<!-- Premium Products Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Sports Equipment</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Professional-grade sports equipment and accessories for every athlete</p>
        </div>

        <!-- Category Filter -->
        <div class="flex justify-center mb-12">
            <div class="bg-white rounded-2xl p-2 shadow-lg border border-gray-100">
                <div class="flex flex-wrap justify-center gap-2">
                    @php
                    $categories = ['all' => 'All Sports', 'Football' => 'Football', 'Basketball' => 'Basketball', 'Tennis' => 'Tennis', 'Accessories' => 'Accessories', 'Wearables' => 'Fitness Wear'];
                    @endphp
                    @foreach($categories as $key => $label)
                    <button
                        onclick="filterByCategory('{{ $key }}')"
                        id="tab-{{ $key }}"
                        class="{{ $key == 'all' ? 'px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-semibold shadow-md' : 'px-6 py-3 text-gray-600 rounded-xl font-medium hover:bg-gray-50 transition-all' }}">
                        {{ $label }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10" id="productsGrid">
            @foreach($products as $product)
            <div class="relative bg-white/90 backdrop-blur-lg rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 group overflow-hidden border border-gray-100 product-card"
                data-category="{{ $product->category->name }}" data-product="{{ $product->id }}">

                <!-- Product Image -->
                <div class="relative overflow-hidden aspect-square">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-orange-200 to-red-200 flex items-center justify-center">
                        <i class="fas fa-dumbbell text-5xl text-orange-500"></i>
                    </div>
                    @endif

                    <!-- Badges -->
                    @if($product->available_stock <= 5 && $product->available_stock > 0)
                        <span class="absolute top-4 left-4 bg-orange-500 text-white px-3 py-1 text-xs font-bold rounded-full shadow-lg animate-pulse">
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
                    <span class="text-sm text-orange-600 font-semibold tracking-wide">{{ $product->category->name ?? 'Sports' }}</span>
                    <h3 class="text-lg font-bold text-gray-900 mt-1 line-clamp-2 group-hover:text-orange-600 transition">{{ $product->name }}</h3>
                    @if($product->details)
                    <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ Str::limit($product->details, 90) }}</p>
                    @endif
                </div>

                <!-- Price & Actions -->
                <div class="mt-4 flex items-center justify-between">
                    <div class="flex items-baseline space-x-2">
                        <span class="text-2xl font-extrabold text-gray-900">${{ number_format($product->amount, 2) }}</span>
                    </div>
                    
                    <!-- Stock Status & Add to Cart -->
                    <div class="flex flex-col items-end space-y-1">
                        @if($product->available_stock > 0)
                            <div class="bg-green-50 px-2 py-1 rounded-full">
                                <span class="text-xs text-green-700 font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i>Stock: {{ $product->stock }}
                                </span>
                            </div>
                            <button class="add-to-cart-btn px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl"
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
    <div id="noProductsFound" class="text-center py-12 hidden">
        <div class="bg-white rounded-3xl p-8 shadow-lg max-w-md mx-auto">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-search text-gray-400 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Products Found</h3>
            <p class="text-gray-600">Try selecting a different category.</p>
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">

                <!-- Product Image -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <img id="modalMainImage" src="" alt="Product Image" class="w-full h-80 object-cover rounded-lg">
                </div>

                <!-- Product Details -->
                <div class="flex flex-col">

                    <!-- Category Badge -->
                    <div class="mb-3">
                        <span id="modalCategory" class="inline-block px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-lg">Sports</span>
                    </div>

                    <!-- Product Title -->
                    <h2 id="modalTitle" class="text-2xl font-bold text-gray-900 mb-3">Product Title</h2>

                    <!-- Rating -->
                    <div id="modalRating" class="flex items-center mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                        </div>
                        <span class="text-gray-500 ml-2 text-sm">(4.8 - 124 reviews)</span>
                    </div>

                    <!-- Price -->
                    <div class="mb-6">
                        <div class="flex items-baseline space-x-2">
                            <span id="modalPrice" class="text-3xl font-bold text-gray-900">$0.00</span>
                            <span id="modalOriginalPrice" class="text-gray-500 line-through text-lg"></span>
                        </div>
                        <p class="text-green-600 text-sm font-medium mt-1">Free shipping on orders over $50</p>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-2">Description</h4>
                        <p id="modalDescription" class="text-gray-600 leading-relaxed text-sm">Premium sports equipment designed for peak performance and durability.</p>
                    </div>

                    <!-- Key Features -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-2">Key Features</h4>
                        <ul class="text-gray-600 text-sm space-y-1">
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Professional Grade Quality</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Durable Construction</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>1 Year Warranty</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Fast Delivery</li>
                        </ul>
                    </div>

                    <!-- Quantity & Actions -->
                    <div class="space-y-4 mt-auto">

                        <!-- Quantity Selector -->
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-gray-700">Quantity:</span>
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button onclick="decreaseQuantity()" class="px-3 py-2 hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-minus text-sm"></i>
                                </button>
                                <input type="number" id="quantity" value="1" min="1" max="10" class="w-12 text-center border-0 focus:ring-0 font-medium" readonly>
                                <button onclick="increaseQuantity()" class="px-3 py-2 hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-plus text-sm"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-3">
                            <button onclick="addToWishlist(currentProductId)" class="px-4 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                                <i class="far fa-heart mr-1"></i>Wishlist
                            </button>
                            <button onclick="addToCart(currentProductId)" class="px-4 py-3 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-lg font-medium transition-colors">
                                <i class="fas fa-cart-plus mr-1"></i>Add to Cart
                            </button>
                        </div>

                        <!-- Additional Info -->
                        <div class="pt-4 border-t border-gray-200 text-center">
                            <div class="flex items-center justify-center text-green-600 text-sm mb-2">
                                <i class="fas fa-truck mr-2"></i>Free shipping on orders over $50
                            </div>
                            <div class="flex items-center justify-center text-gray-500 text-sm">
                                <i class="fas fa-shield-alt mr-2"></i>30-day money-back guarantee
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    #quickViewModal {
        backdrop-filter: blur(4px);
    }

    /* Custom scrollbar for modal */
    #quickViewModal .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }

    #quickViewModal .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    #quickViewModal .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    #quickViewModal .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<script>
    // Global variables
    let currentQuantity = 1;
    let currentProductId = null;

    // Initialize functionality when page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Modal close on backdrop click
        const modal = document.getElementById('quickViewModal');
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeQuickView();
            });
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                closeQuickView();
            }
        });
    });

    // Category filter function
    function filterByCategory(category) {
        const productCards = document.querySelectorAll('.product-card');
        let visibleCount = 0;

        // Update active tab styling
        document.querySelectorAll('[id^="tab-"]').forEach(tab => {
            tab.className = 'px-6 py-3 text-gray-600 rounded-xl font-medium hover:bg-gray-50 transition-all';
        });

        const activeTab = document.getElementById(`tab-${category}`);
        if (activeTab) {
            activeTab.className = 'px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-semibold shadow-md';
        }

        // Show/hide products based on category
        productCards.forEach(card => {
            const cardCategory = card.getAttribute('data-category');
            if (category === 'all' || cardCategory === category) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Toggle "no products found" message
        const noProductsEl = document.getElementById('noProductsFound');
        if (noProductsEl) {
            noProductsEl.classList.toggle('hidden', visibleCount > 0);
        }
    }

    // Quick view modal functions
    function openQuickView(productId) {
        currentProductId = productId;
        const productCard = document.querySelector(`[data-product="${productId}"]`);

        if (!productCard) return;

        // Extract product details from card
        const title = productCard.querySelector('h3')?.textContent || 'Product Title';
        const price = productCard.querySelector('.text-2xl')?.textContent || '$0.00';
        const image = productCard.querySelector('img');
        const category = productCard.getAttribute('data-category') || 'Sports';

        // Update modal content
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalPrice').textContent = price;
        document.getElementById('modalCategory').textContent = category;
        document.getElementById('modalDescription').textContent = `Premium ${category.toLowerCase()} equipment designed for peak performance.`;

        if (image) {
            const modalImage = document.getElementById('modalMainImage');
            modalImage.src = image.src;
            modalImage.alt = title;
        }

        // Show modal
        const modal = document.getElementById('quickViewModal');
        modal.style.display = 'block';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeQuickView() {
        const modal = document.getElementById('quickViewModal');
        modal.style.display = 'none';
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';

        // Reset quantity
        document.getElementById('quantity').value = 1;
    }

    // Quantity control
    function increaseQuantity() {
        const input = document.getElementById('quantity');
        const current = parseInt(input.value);
        const max = parseInt(input.max);
        if (current < max) input.value = current + 1;
    }

    function decreaseQuantity() {
        const input = document.getElementById('quantity');
        const current = parseInt(input.value);
        const min = parseInt(input.min);
        if (current > min) input.value = current - 1;
    }

    // Add to cart function
    function addToCart(productId) {
        const quantity = document.getElementById('quantity')?.value || 1;

        if (window.addToCart) {
            window.addToCart(productId, quantity);
        } else {
            alert(`Added ${quantity} item(s) to cart!`);
        }

        // Close modal if open
        const modal = document.getElementById('quickViewModal');
        if (!modal.classList.contains('hidden')) {
            closeQuickView();
        }
    }

    function addToWishlist(productId) {
        const productCard = document.querySelector(`[data-product="${productId}"]`);
        const title = productCard?.querySelector('h3')?.textContent || 'Product';
        alert(`❤️ "${title}" added to wishlist!`);
    }
</script>