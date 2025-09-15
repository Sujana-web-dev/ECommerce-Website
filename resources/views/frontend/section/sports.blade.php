<!-- Modern Sports Section -->
<section class="relative overflow-hidden">
    <!-- Premium Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#1D293D]/80 via-[#1D293D]/60 to-[#ec4642]/70"></div>

    <!-- Header Content -->
    <div class="relative z-20 py-16 px-6 text-center">
        <div class="container mx-auto">
            <div class="inline-flex items-center space-x-6 mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-[#ec4642] to-[#1D293D] rounded-3xl flex items-center justify-center shadow-2xl border-2 border-white/20">
                    <span class="text-white text-4xl">🏅</span>
                </div>
                <h1 class="text-7xl font-black text-white tracking-tight drop-shadow-2xl">Sports & Fitness</h1>
            </div>
            <p class="text-white/90 text-2xl max-w-4xl mx-auto font-light mb-8 drop-shadow-lg leading-relaxed">Elevate your performance with our premium sports and fitness collection</p>
            <div class="flex justify-center items-center space-x-8 mb-8">
                <div class="w-40 h-1 bg-gradient-to-r from-transparent via-white/60 to-transparent rounded-full"></div>
                <span class="text-white text-lg font-bold tracking-widest px-6 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/30">PREMIUM COLLECTION</span>
                <div class="w-40 h-1 bg-gradient-to-r from-transparent via-white/60 to-transparent rounded-full"></div>
            </div>
        </div>
    </div>
</section>


<section class="py-20 bg-white relative overflow-hidden">
    <div class="container mx-auto px-6 relative z-10">
        <!-- Category Tabs -->
        <div class="flex justify-center mb-16">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-2 shadow-lg border border-white/50">
                <div class="flex space-x-2">
                    @php
                    $categories = ['all' => 'All', 'Football' => 'Football', 'Basketball' => 'Basketball', 'Tennis' => 'Tennis', 'Accessories' => 'Accessories', 'Wearables' => 'Fitness Wear'];
                    @endphp
                    @foreach($categories as $key => $label)
                    <button onclick="filterByCategory('{{ $key }}')" id="tab-{{ $key }}" class="{{ $key == 'all' ? 'px-6 py-3 bg-[#1D293D] text-white rounded-xl font-semibold transition-all hover:bg-[#243447] shadow-md' : 'px-6 py-3 text-gray-600 rounded-xl font-medium hover:bg-white/50 transition-all' }}">{{ $label }}</button>
                    @endforeach
                </div>
            </div>
        </div>


        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="productsGrid">
            @foreach($products as $product)
            <div class="group relative bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-700 h-[450px] flex flex-col product-card transform hover:-translate-y-3 hover:scale-105" data-category="{{ $product->category->name ?? 'Sports' }}" data-product="{{ $product->id }}">
                <!-- Animated Border Glow -->
                <div class="absolute -inset-0.5 bg-gradient-to-r from-[#1D293D] via-blue-500 to-purple-600 rounded-3xl opacity-0 group-hover:opacity-75 blur-sm transition-all duration-700 animate-pulse"></div>

                <!-- Card Content -->
                <div class="relative bg-white rounded-3xl h-full flex flex-col">
                    <!-- Image Section with Overlay Effects -->
                    <div class="relative overflow-hidden h-72 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50 rounded-t-3xl">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300/f8fafc/64748b?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 filter group-hover:brightness-110">

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Out of Stock Overlay -->
                        @if($product->available_stock <= 0)
                        <div class="absolute inset-0 bg-black/70 flex items-center justify-center z-10">
                            <div class="text-center">
                                <div class="bg-red-600 text-white px-6 py-3 rounded-lg font-bold text-lg shadow-lg mb-2">
                                    <i class="fas fa-times-circle mr-2"></i>OUT OF STOCK
                                </div>
                                <p class="text-white text-sm">This item is currently unavailable</p>
                            </div>
                        </div>
                        @endif

                        <!-- Low Stock Badge -->
                        @if($product->available_stock > 0 && $product->available_stock <= 5)
                        <div class="absolute top-4 left-4">
                            <span class="bg-orange-500 text-white px-3 py-1 text-xs font-bold rounded-full shadow-lg animate-pulse">
                                <i class="fas fa-exclamation-triangle mr-1"></i>Only {{ $product->available_stock }} left
                            </span>
                        </div>
                        @endif

                        <!-- Floating Action Buttons with Animations -->
                        <div class="absolute top-4 right-4 flex flex-col space-y-3">
                            <button onclick="addToWishlist('{{ $product->id }}')" class="w-12 h-12 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 hover:bg-white transition-all shadow-xl transform hover:scale-125 hover:rotate-12 duration-300 border-2 border-transparent hover:border-red-200" title="Add to Wishlist">
                                <i class="far fa-heart text-lg"></i>
                            </button>
                            <button onclick="openQuickView('{{ $product->id }}')" class="w-12 h-12 bg-gradient-to-br from-[#1D293D] to-[#243447] text-white rounded-full flex items-center justify-center hover:from-[#243447] hover:to-[#2a3f57] transition-all shadow-xl transform hover:scale-125 hover:rotate-12 duration-300" title="Quick View">
                                <i class="fas fa-eye text-lg"></i>
                            </button>
                        </div>

                        <!-- Enhanced Discount Badge -->
                        @if($product->discount)
                        <div class="absolute top-4 left-4">
                            <div class="relative">
                                <span class="bg-gradient-to-r from-red-500 via-pink-500 to-red-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-2xl animate-bounce">
                                    🔥 {{ $product->discount }}% OFF
                                </span>
                                <div class="absolute inset-0 bg-red-400 rounded-full blur opacity-40 animate-ping"></div>
                            </div>
                        </div>
                        @endif

                        <!-- New Arrival Badge -->
                        <div class="absolute bottom-4 left-4">
                            <span class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                                ✨ NEW
                            </span>
                        </div>
                    </div>

                    <!-- Content Section with Enhanced Typography -->
                    <div class="p-6 flex-1 flex flex-col justify-between relative">
                        <!-- Decorative Element -->
                        <div class="absolute top-0 left-6 w-12 h-1 bg-gradient-to-r from-[#1D293D] to-purple-600 rounded-full transform -translate-y-1"></div>

                        <div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#1D293D] transition-colors duration-300 line-clamp-2 leading-tight mb-2">
                                    {{ $product->name }}
                                </h3>
                                <!-- Rating Stars -->
                                <div class="flex items-center space-x-1 mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-yellow-400 text-[10px]"></i>
                                        @endfor
                                        <span class="text-gray-500 text-sm ml-2">(4.8)</span>
                                </div>
                            </div>

                            <!-- Enhanced Price Section -->
                            <div class="mb-3">
                                <div class="flex items-baseline justify-between">
                                    <div class="flex items-baseline space-x-3">
                                        <span class=" text-xl font-black text-[#1D293D]">${{ number_format($product->amount ?? 0) }}</span>
                                        @if($product->original_price)
                                        <span class="text-gray-400 line-through text-lg">${{ number_format($product->original_price) }}</span>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <span class="text-green-600 text-sm font-semibold">Save 20%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced CTA Button -->
                        @if($product->available_stock > 0)
                        <button class="add-to-cart-btn relative w-full bg-gradient-to-r from-[#1D293D] to-[#2a3f57] text-white py-3 rounded-2xl font-bold text-lg hover:from-[#ec4642] hover:to-[#c0392b] transition-all group/btn"
                                data-product-id="{{ $product->id }}" 
                                data-product-name="{{ $product->name }}" 
                                data-product-price="{{ $product->amount }}"
                                data-product-stock="{{ $product->available_stock }}">

                            <!-- Button Content -->
                            <span class="relative flex items-center justify-center space-x-3">
                                <i class="fas fa-shopping-cart text-lg transform group-hover/btn:scale-110 transition-transform duration-300"></i>
                                <span class="transform group-hover/btn:scale-105 transition-transform duration-300">Add to Cart</span>
                                <i class="fas fa-arrow-right transform translate-x-0 group-hover/btn:translate-x-1 transition-transform duration-300"></i>
                            </span>

                            <!-- Shimmer Effect -->
                            <div class="absolute inset-0 -top-full bg-gradient-to-b from-transparent via-white/20 to-transparent transform rotate-12 group-hover/btn:animate-shimmer"></div>
                        </button>
                        <div class="mt-2 text-center">
                            <div class="bg-green-50 px-3 py-1 rounded-full inline-block">
                                <span class="text-sm text-green-700 font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i>Stock: {{ $product->stock }}
                                </span>
                            </div>
                        </div>
                        @else
                        <button disabled class="relative w-full bg-gray-400 text-gray-700 py-3 rounded-2xl font-bold text-lg cursor-not-allowed opacity-60 pointer-events-none border-2 border-gray-300">
                            <span class="relative flex items-center justify-center space-x-3">
                                <i class="fas fa-ban text-lg"></i>
                                <span>Out of Stock</span>
                            </span>
                            <!-- Strikethrough effect -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-3/4 h-0.5 bg-red-500 transform rotate-12 opacity-50"></div>
                            </div>
                        </button>
                        <div class="mt-2 text-center">
                            <div class="bg-red-50 px-3 py-1 rounded-full inline-block">
                                <span class="text-sm text-red-600 font-bold">
                                    <i class="fas fa-times-circle mr-1"></i>Out of Stock
                                </span>
                            </div>
                        </div>
                        @endif
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
                <button onclick="filterByCategory('all')" class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-[#1D293D] to-[#243447] text-white rounded-xl font-semibold hover:from-[#ec4642] hover:to-[#d63031] transition-all shadow-lg">
                    <i class="fas fa-arrow-left"></i>
                    <span>View All Products</span>
                </button>
            </div>
        </div>

    </div>
</section>



<!-- Quick View Modal -->
<div id="quickViewModal" class="fixed inset-0 bg-black/50 hidden z-50 p-4" style="display: none;">
    <div class="flex items-center justify-center min-h-screen py-4">
        <div class="bg-white rounded-3xl shadow-xl max-w-4xl w-full relative overflow-hidden max-h-[90vh] overflow-y-auto">
            <!-- Close Button -->
            <button onclick="closeQuickView()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-2xl font-bold">&times;</button>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                <!-- Product Image -->
                <div class="flex justify-center items-center">
                    <img id="modalMainImage" src="" alt="Product Image" class="w-full h-80 object-cover rounded-lg">
                </div>

                <!-- Product Info -->
                <div class="flex flex-col justify-between">
                    <div>
                        <span id="modalCategory" class="inline-block px-3 py-1 bg-orange-100 text-orange-600 text-sm font-medium rounded-lg mb-2">Sports</span>
                        <h2 id="modalTitle" class="text-2xl font-bold text-gray-900 mb-3">Product Title</h2>
                        <div class="mb-4">
                            <span id="modalPrice" class="text-3xl font-bold text-gray-900">$0.00</span>
                            <span id="modalOriginalPrice" class="text-gray-500 line-through text-lg"></span>
                        </div>
                        <p id="modalDescription" class="text-gray-600 leading-relaxed text-sm mb-4">Premium sports equipment for your active lifestyle.</p>
                    </div>
                    <div class="flex space-x-4 mt-6">
                        <button class="px-6 py-2 bg-gradient-to-r from-orange-600 to-red-600 text-white rounded-xl font-semibold shadow-md hover:from-orange-700 hover:to-red-700 transition-all">Add to Cart</button>
                        <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-xl font-semibold shadow-md hover:bg-gray-300 transition-all">Wishlist</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Custom CSS for Sports Section -->
    <style>
        /* Animated border glow */
        @keyframes shimmer {
            0% { transform: translateX(-100%) rotate(12deg); }
            100% { transform: translateX(300%) rotate(12deg); }
        }
        .animate-shimmer {
            animation: shimmer 0.8s ease-out;
        }
        .product-card:hover {
            box-shadow: 0 25px 50px -12px rgba(249, 115, 22, 0.25);
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-clamp: 2;
        }
        #quickViewModal {
            backdrop-filter: blur(4px);
        }
        #quickViewModal .bg-white {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 #f7fafc;
        }
        #quickViewModal .bg-white::-webkit-scrollbar {
            width: 6px;
        }
        #quickViewModal .bg-white::-webkit-scrollbar-track {
            background: #f7fafc;
            border-radius: 3px;
        }
        #quickViewModal .bg-white::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 3px;
        }
        #quickViewModal .bg-white::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
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
        <!-- Quick View Modal -->
        <div id="quickViewModal" class="fixed inset-0 bg-black/50 hidden z-50 p-4" style="display: none;">
            <div class="flex items-center justify-center min-h-screen py-4">
                <div class="bg-white rounded-3xl shadow-xl max-w-4xl w-full relative overflow-hidden max-h-[90vh] overflow-y-auto">
                    <!-- Close Button -->
                    <button onclick="closeQuickView()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-2xl font-bold">&times;</button>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                        <!-- Product Image -->
                        <div class="flex justify-center items-center">
                            <img id="modalMainImage" src="" alt="Product Image" class="rounded-2xl object-cover w-full h-[400px]">
                        </div>

                        <!-- Product Info -->
                        <div class="flex flex-col justify-between">
                            <div>
                                <!-- Category Badge -->
                                <div class="mb-4">
                                    <span id="modalCategory" class="inline-block px-3 py-1 bg-[#1D293D] text-white text-xs font-semibold rounded-full uppercase tracking-wider">SPORTS</span>
                                </div>

                                <h2 id="modalTitle" class="text-3xl font-bold text-gray-900 mb-4">Product Title</h2>

                                <!-- Rating Section -->
                                <div id="modalRating" class="flex items-center mb-4">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <span class="text-gray-500 ml-2">(4.8)</span>
                                </div>

                                <!-- Price Section -->
                                <div class="flex items-baseline space-x-3 mb-6">
                                    <span id="modalPrice" class="text-3xl font-bold text-[#1D293D]">$: 0</span>
                                    <span id="modalOriginalPrice" class="text-gray-500 line-through text-xl"></span>
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm font-semibold">Save 20%</span>
                                </div>

                                <!-- Enhanced Description -->
                                <div class="mb-6">
                                    <h4 class="font-semibold text-gray-900 mb-2">Description:</h4>
                                    <p id="modalDescription" class="text-gray-700 leading-relaxed">This is a brief description of the product. You can replace it with dynamic product details from your database.</p>
                                </div>

                                <!-- Product Features -->
                                <div class="mb-6">
                                    <h4 class="font-semibold text-gray-900 mb-2">Features:</h4>
                                    <ul class="text-gray-700 text-sm space-y-1">
                                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> High Quality Content</li>
                                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Fast Delivery</li>
                                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> Money Back Guarantee</li>
                                        <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i> 24/7 Customer Support</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Quantity & Buttons -->
                            <div class="space-y-4">
                                <!-- Quantity Selector -->
                                <div class="flex items-center justify-between bg-gray-50 rounded-xl p-4">
                                    <span class="font-semibold text-gray-800">Quantity:</span>
                                    <div class="flex items-center bg-white rounded-lg border-2 border-gray-200">
                                        <button onclick="decreaseQuantity()" class="px-4 py-2 hover:bg-gray-100 rounded-l-lg transition-colors font-bold text-gray-600">
                                            <i class="fas fa-minus text-sm"></i>
                                        </button>
                                        <input type="number" id="quantity" value="1" min="1" max="10" class="w-16 text-center border-0 focus:ring-0 font-semibold text-gray-800" readonly>
                                        <button onclick="increaseQuantity()" class="px-4 py-2 hover:bg-gray-100 rounded-r-lg transition-colors font-bold text-gray-600">
                                            <i class="fas fa-plus text-sm"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="space-y-3">
                                    <button onclick="addToCart(currentProductId)" class="w-full bg-gradient-to-r from-[#1D293D] to-[#243447] text-white py-3 rounded-xl font-bold text-lg hover:from-[#ec4642] hover:to-[#d63031] transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1 duration-300">
                                        <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                                    </button>

                                    <button onclick="addToWishlist(currentProductId)" class="w-full border-2 border-gray-300 text-gray-700 py-3 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-400 transition-all duration-300">
                                        <i class="far fa-heart mr-2"></i>Add to Wishlist
                                    </button>
                                </div>

                                <!-- Additional Info -->
                                <div class="pt-4 border-t border-gray-200 text-center">
                                    <div class="flex items-center justify-center text-green-600 text-sm mb-2">
                                        <i class="fas fa-truck mr-2"></i>Free shipping on orders over $100
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