<!-- Modern Books Section -->
<section class=" relative overflow-hidden">
    <!-- Premium Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-[#1D293D]/80 via-[#1D293D]/60 to-[#ec4642]/70"></div>

    <!-- Header Content -->
    <div class="relative z-20 py-16 px-6 text-center">
        <div class="container mx-auto">
            <div class="inline-flex items-center space-x-6 mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-[#ec4642] to-[#1D293D] rounded-3xl flex items-center justify-center shadow-2xl border-2 border-white/20">
                    <span class="text-white text-4xl">📚</span>
                </div>
                <h1 class="text-7xl font-black text-white tracking-tight drop-shadow-2xl">Books</h1>
            </div>
            <p class="text-white/90 text-2xl max-w-4xl mx-auto font-light mb-8 drop-shadow-lg leading-relaxed">Discover premium literary collections with our curated book showcase</p>
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
                    $categories = ['all' => 'All', 'Fiction' => 'Fiction', 'Non-Fiction' => 'Non-Fiction', 'Science' => 'Science', 'History' => 'History', 'Biography' => 'Biography'];
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
            <div class="group relative bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-700 h-[450px] flex flex-col product-card transform hover:-translate-y-3 hover:scale-105" data-category="{{ $product->category->name }}" data-product="{{ $product->id }}">

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
                                        <span class=" text-xl font-black text-[#1D293D]">TK {{ number_format($product->amount ?? 0) }}</span>
                                        <span class="text-gray-400 line-through text-lg">TK {{ number_format($product->amount * 1.2) }}</span>
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
                    <img id="modalMainImage" src="" alt="Product Image" class="rounded-2xl object-cover w-full h-[400px]">
                </div>

                <!-- Product Info -->
                <div class="flex flex-col justify-between">
                    <div>
                        <!-- Category Badge -->
                        <div class="mb-4">
                            <span id="modalCategory" class="inline-block px-3 py-1 bg-[#1D293D] text-white text-xs font-semibold rounded-full uppercase tracking-wider">BOOKS</span>
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
                            <span id="modalPrice" class="text-3xl font-bold text-[#1D293D]">TK: 0</span>
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
                        <div class="text-center pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-truck mr-1"></i>Free shipping on orders over TK 500
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                <i class="fas fa-shield-alt mr-1"></i>Secure payment & money-back guarantee
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






    <!-- Custom CSS and JavaScript -->
    <style>
        /* Sliding Book Images Animations */
        @keyframes slide-right-slow {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(0%);
            }
        }

        @keyframes slide-left-medium {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        @keyframes slide-right-fast {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(0%);
            }
        }

        /* Apply sliding animations */
        .animate-slide-right-slow {
            animation: slide-right-slow 30s linear infinite;
        }

        .animate-slide-left-medium {
            animation: slide-left-medium 25s linear infinite;
        }

        .animate-slide-right-fast {
            animation: slide-right-fast 20s linear infinite;
        }

        /* Custom animations for enhanced product cards */
        @keyframes shimmer {
            0% {
                transform: translateX(-100%) rotate(12deg);
            }

            100% {
                transform: translateX(300%) rotate(12deg);
            }
        }

        .animate-shimmer {
            animation: shimmer 0.8s ease-out;
        }

        /* Enhanced hover effects */
        .product-card:hover {
            box-shadow: 0 25px 50px -12px rgba(29, 41, 61, 0.25);
        }

        /* Line clamp utility */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-clamp: 2;
        }

        /* Modal scrolling fixes */
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

        /* Performance optimizations for smooth animations */
        .animate-slide-right-slow,
        .animate-slide-left-medium,
        .animate-slide-right-fast {
            will-change: transform;
            backface-visibility: hidden;
        }
    </style>

    <script>
        // Global variables
        let currentQuantity = 1;
        let currentProductId = null;

        // Debug function to check if elements exist
        function debugModal() {
            console.log('Modal elements check:');
            console.log('quickViewModal:', document.getElementById('quickViewModal'));
            console.log('modalTitle:', document.getElementById('modalTitle'));
            console.log('modalPrice:', document.getElementById('modalPrice'));
            console.log('modalMainImage:', document.getElementById('modalMainImage'));
        }

        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded, checking modal elements...');
            debugModal();

            // Add click outside to close modal functionality
            const modal = document.getElementById('quickViewModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    // Close modal if clicking on the backdrop (not the modal content)
                    if (e.target === modal) {
                        closeQuickView();
                    }
                });
            }

            // Add escape key to close modal
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const modal = document.getElementById('quickViewModal');
                    if (modal && modal.style.display !== 'none' && !modal.classList.contains('hidden')) {
                        closeQuickView();
                    }
                }
            });
        });

        // Filter function
        function filterByCategory(category) {
            console.log('Filtering by category:', category);
            const productCards = document.querySelectorAll('.product-card');
            let visibleCount = 0;

            // Update active tab
            document.querySelectorAll('[id^="tab-"]').forEach(tab => {
                tab.classList.remove('bg-[#1D293D]', 'text-white', 'shadow-md');
                tab.classList.add('text-gray-600', 'hover:bg-white/50');
            });

            const activeTab = document.getElementById(`tab-${category}`);
            if (activeTab) {
                activeTab.classList.remove('text-gray-600', 'hover:bg-white/50');
                activeTab.classList.add('bg-[#1D293D]', 'text-white', 'shadow-md');
            }

            productCards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                if (category === 'all' || cardCategory === category) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const noProductsEl = document.getElementById('noProductsFound');
            if (noProductsEl) {
                noProductsEl.classList.toggle('hidden', visibleCount > 0);
            }
            console.log('Visible products:', visibleCount);
        }

        // Quick view function
        function openQuickView(productId) {
            console.log('openQuickView called with ID:', productId);
            currentProductId = productId;
            const productCard = document.querySelector(`[data-product="${productId}"]`);

            if (!productCard) {
                console.error('Product card not found for ID:', productId);
                return;
            }

            console.log('Opening quick view for product:', productId);

            // Extract product details from the card
            const titleElement = productCard.querySelector('h3');
            const title = titleElement ? titleElement.innerText.trim() : 'Product Title';

            // Try multiple selectors for price
            let priceElement = productCard.querySelector('.text-xl.font-black');
            if (!priceElement) {
                priceElement = productCard.querySelector('[class*="text-xl"][class*="font-black"]');
            }
            if (!priceElement) {
                priceElement = productCard.querySelector('.text-xl');
            }
            const price = priceElement ? priceElement.innerText.trim() : 'TK 0';

            const originalPriceEl = productCard.querySelector('.line-through');
            const originalPrice = originalPriceEl ? originalPriceEl.innerText.trim() : '';

            const imgElement = productCard.querySelector('img');
            const imgSrc = imgElement ? imgElement.src : '';
            const imgAlt = imgElement ? imgElement.alt : 'Product Image';

            const category = productCard.getAttribute('data-category') || 'Books';

            // Get rating
            const ratingStars = productCard.querySelectorAll('.fas.fa-star').length || 5;
            const ratingTextEl = productCard.querySelector('.text-gray-500.text-sm');
            const ratingText = ratingTextEl ? ratingTextEl.innerText.trim() : '(4.8)';

            console.log('Extracted data:', {
                title,
                price,
                originalPrice,
                category,
                ratingStars
            });

            // Update modal content
            const modalTitle = document.getElementById('modalTitle');
            const modalPrice = document.getElementById('modalPrice');
            const modalOriginalPrice = document.getElementById('modalOriginalPrice');
            const modalMainImage = document.getElementById('modalMainImage');

            if (modalTitle) modalTitle.innerText = title;
            if (modalPrice) modalPrice.innerText = price;
            if (modalOriginalPrice) modalOriginalPrice.innerText = originalPrice;
            if (modalMainImage) {
                modalMainImage.src = imgSrc;
                modalMainImage.alt = imgAlt;
            }

            // Update category display
            const categoryElement = document.getElementById('modalCategory');
            if (categoryElement) {
                categoryElement.innerText = category.toUpperCase();
            }

            // Update rating display
            const ratingElement = document.getElementById('modalRating');
            if (ratingElement) {
                let starsHTML = '';
                for (let i = 1; i <= 5; i++) {
                    starsHTML += `<i class="fas fa-star ${i <= ratingStars ? 'text-yellow-400' : 'text-gray-300'}"></i>`;
                }
                ratingElement.innerHTML = starsHTML + ` <span class="text-gray-500 ml-2">${ratingText}</span>`;
            }

            // Update description
            const descriptionElement = document.getElementById('modalDescription');
            if (descriptionElement) {
                descriptionElement.innerText = `This ${category.toLowerCase()} "${title}" is part of our premium collection. Perfect for readers who appreciate quality content and exceptional storytelling. Available now with fast shipping and excellent customer support.`;
            }

            // Show the modal
            const modal = document.getElementById('quickViewModal');
            if (modal) {
                modal.style.display = 'block';
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                console.error('Modal element not found!');
            }
        }

        function closeQuickView() {
            const modal = document.getElementById('quickViewModal');
            if (modal) {
                modal.style.display = 'none';
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';

                // Reset quantity to 1 when closing modal
                const quantityInput = document.getElementById('quantity');
                if (quantityInput) {
                    quantityInput.value = 1;
                }

                console.log('Quick view modal closed');
            }
        }

        // Quantity control functions
        function increaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            if (quantityInput) {
                const currentQty = parseInt(quantityInput.value) || 1;
                const maxQty = parseInt(quantityInput.getAttribute('max')) || 10;

                if (currentQty < maxQty) {
                    quantityInput.value = currentQty + 1;
                }
            }
        }

        function decreaseQuantity() {
            const quantityInput = document.getElementById('quantity');
            if (quantityInput) {
                const currentQty = parseInt(quantityInput.value) || 1;
                const minQty = parseInt(quantityInput.getAttribute('min')) || 1;

                if (currentQty > minQty) {
                    quantityInput.value = currentQty - 1;
                }
            }
        }

        function addToCart(productId) {
            let quantity = 1;

            // If called from modal, get quantity from modal
            const quantityInput = document.getElementById('quantity');
            const modal = document.getElementById('quickViewModal');

            if (quantityInput && modal && modal.style.display !== 'none' && !modal.classList.contains('hidden')) {
                quantity = quantityInput.value;
            }

            // Use the global addToCart function from header
            if (window.addToCart) {
                window.addToCart(productId, quantity);
            } else {
                // Fallback if global function not available
                console.log('Adding to cart:', { productId, quantity });
                alert(`🛒 Added to cart! Quantity: ${quantity}`);
            }

            // Close modal if it's open
            if (modal && modal.style.display !== 'none' && !modal.classList.contains('hidden')) {
                closeQuickView();
            }
        }

        function addToWishlist(productId) {
            let productName = 'Product';

            const productCard = document.querySelector(`[data-product="${productId}"]`);
            if (productCard) {
                const titleElement = productCard.querySelector('h3');
                productName = titleElement ? titleElement.innerText.trim() : 'Product';
            }

            console.log('Adding to wishlist:', {
                productId,
                productName
            });

            alert(`❤️ Added to wishlist!\n\nProduct: ${productName}\n\n✅ You can view your wishlist anytime from your account.`);
        }

        function buyNow(productId) {
            const quantityInput = document.getElementById('quantity');
            const quantity = quantityInput ? quantityInput.value : 1;

            const productCard = document.querySelector(`[data-product="${productId}"]`);
            const titleElement = productCard ? productCard.querySelector('h3') : null;
            const productName = titleElement ? titleElement.innerText.trim() : 'Product';

            alert(`⚡ Buy Now!\n\nProduct: ${productName}\nQuantity: ${quantity}\n\nRedirecting to checkout...`);

            // Close modal and redirect to checkout
            closeQuickView();
            // window.location.href = '/checkout?product=' + productId + '&qty=' + quantity;
        }
    </script>