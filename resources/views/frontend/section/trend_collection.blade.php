<!-- Premium Categories Section -->
<section class="py-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-20 left-10 w-72 h-72 bg-primary-500/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-luxury-gold/10 rounded-full blur-3xl animate-float-delayed"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-radial from-primary-500/5 to-transparent rounded-full"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="text-luxury-gold font-medium text-sm uppercase tracking-wider">Premium Selection</span>
            <h2 class="text-5xl lg:text-6xl font-bold text-white mt-4 mb-6 font-serif">
                Trending Collections
            </h2>
            <p class="text-gray-300 text-lg max-w-3xl mx-auto leading-relaxed">
                Discover our meticulously curated collections where luxury meets innovation. 
                Each category represents the pinnacle of quality and style.
            </p>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Electronics Category -->
            <div class="group relative" data-aos="fade-up" data-aos-delay="100">
                <a href="{{ route('electronics') }}" class="block cursor-pointer" aria-label="Browse Electronics Category">
                    <div class="category-card relative rounded-2xl overflow-hidden shadow-2xl h-80 transform group-hover:scale-105 transition-all duration-500">
                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1399&q=80" 
                             alt="Electronics" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        
                        <!-- Enhanced Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent group-hover:from-primary-900/90 transition-all duration-500"></div>
                        
                        <!-- Hover Effect Border -->
                        <div class="absolute inset-0 border-2 border-transparent group-hover:border-luxury-gold rounded-2xl transition-all duration-500"></div>
                        
                        <!-- Floating Icon -->
                        <div class="absolute top-6 right-6 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center group-hover:bg-luxury-gold/90 transition-all duration-500">
                            <i class="fas fa-laptop text-white group-hover:text-gray-900 transition-colors duration-300"></i>
                        </div>
                        
                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="transform group-hover:-translate-y-2 transition-transform duration-500">
                                <h3 class="text-white text-2xl font-bold mb-2 group-hover:text-luxury-gold transition-colors duration-300">Electronics</h3>
                                <div class="flex items-center justify-between">
                                    <p class="text-white/80 text-sm">120+ Premium Products</p>
                                    <div class="w-8 h-8 bg-luxury-gold rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-gray-900 text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Fashion Category -->
            <div class="group relative" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('fashion') }}" class="block cursor-pointer" aria-label="Browse Fashion Category">
                    <div class="category-card relative rounded-2xl overflow-hidden shadow-2xl h-80 transform group-hover:scale-105 transition-all duration-500">
                        <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" 
                             alt="Fashion" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent group-hover:from-pink-900/90 transition-all duration-500"></div>
                        <div class="absolute inset-0 border-2 border-transparent group-hover:border-luxury-gold rounded-2xl transition-all duration-500"></div>
                        
                        <div class="absolute top-6 right-6 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center group-hover:bg-luxury-gold/90 transition-all duration-500">
                            <i class="fas fa-tshirt text-white group-hover:text-gray-900 transition-colors duration-300"></i>
                        </div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="transform group-hover:-translate-y-2 transition-transform duration-500">
                                <h3 class="text-white text-2xl font-bold mb-2 group-hover:text-luxury-gold transition-colors duration-300">Fashion</h3>
                                <div class="flex items-center justify-between">
                                    <p class="text-white/80 text-sm">250+ Luxury Items</p>
                                    <div class="w-8 h-8 bg-luxury-gold rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-gray-900 text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Home & Garden Category -->
            <div class="group relative" data-aos="fade-up" data-aos-delay="300">
                <a href="{{ route('home_garden') }}" class="block cursor-pointer" aria-label="Browse Home & Garden Category">
                    <div class="category-card relative rounded-2xl overflow-hidden shadow-2xl h-80 transform group-hover:scale-105 transition-all duration-500">
                        <img src="https://images.unsplash.com/photo-1490474418585-ba9bad8fd0ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" 
                             alt="Home & Garden" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent group-hover:from-green-900/90 transition-all duration-500"></div>
                        <div class="absolute inset-0 border-2 border-transparent group-hover:border-luxury-gold rounded-2xl transition-all duration-500"></div>
                        
                        <div class="absolute top-6 right-6 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center group-hover:bg-luxury-gold/90 transition-all duration-500">
                            <i class="fas fa-home text-white group-hover:text-gray-900 transition-colors duration-300"></i>
                        </div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="transform group-hover:-translate-y-2 transition-transform duration-500">
                                <h3 class="text-white text-2xl font-bold mb-2 group-hover:text-luxury-gold transition-colors duration-300">Home & Garden</h3>
                                <div class="flex items-center justify-between">
                                    <p class="text-white/80 text-sm">180+ Designer Pieces</p>
                                    <div class="w-8 h-8 bg-luxury-gold rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-gray-900 text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Sports Category -->
            <div class="group relative" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('sports') }}" class="block cursor-pointer" aria-label="Browse Sports Category">
                    <div class="category-card relative rounded-2xl overflow-hidden shadow-2xl h-80 transform group-hover:scale-105 transition-all duration-500">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" 
                             alt="Sports" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent group-hover:from-blue-900/90 transition-all duration-500"></div>
                        <div class="absolute inset-0 border-2 border-transparent group-hover:border-luxury-gold rounded-2xl transition-all duration-500"></div>
                        
                        <div class="absolute top-6 right-6 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center group-hover:bg-luxury-gold/90 transition-all duration-500">
                            <i class="fas fa-dumbbell text-white group-hover:text-gray-900 transition-colors duration-300"></i>
                        </div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="transform group-hover:-translate-y-2 transition-transform duration-500">
                                <h3 class="text-white text-2xl font-bold mb-2 group-hover:text-luxury-gold transition-colors duration-300">Sports</h3>
                                <div class="flex items-center justify-between">
                                    <p class="text-white/80 text-sm">95+ Performance Gear</p>
                                    <div class="w-8 h-8 bg-luxury-gold rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-arrow-right text-gray-900 text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-16" data-aos="fade-up" data-aos-delay="500">
            <p class="text-gray-300 mb-6">Can't find what you're looking for?</p>
            <a href="{{ route('all.products') }}" 
               class="inline-flex items-center space-x-2 px-8 py-4 bg-luxury-gold text-gray-900 font-semibold rounded-full hover:bg-yellow-400 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                <span>Explore All Categories</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Enhanced Styling for Clickable Cards -->
<style>
    /* Ensure all card links are properly styled */
    .category-card-link {
        text-decoration: none !important;
        color: inherit;
        display: block;
        width: 100%;
        height: 100%;
    }
    
    .category-card-link:hover,
    .category-card-link:focus {
        text-decoration: none !important;
        color: inherit;
    }
    
    /* Enhanced cursor styles */
    .cursor-pointer {
        cursor: pointer !important;
    }
    
    /* Improved accessibility focus states */
    .category-card-link:focus {
        outline: 3px solid #F59E0B;
        outline-offset: 2px;
        border-radius: 1rem;
    }
    
    /* Smooth transitions for better UX */
    .category-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .category-card:hover {
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
    }
    
    /* Prevent text selection on cards */
    .category-card-link {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    
    /* Animation enhancements */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    @keyframes float-delayed {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-float-delayed {
        animation: float-delayed 8s ease-in-out infinite 2s;
    }
    
    /* Gradient radial utility */
    .bg-gradient-radial {
        background: radial-gradient(circle, var(--tw-gradient-stops));
    }
</style>

<!-- JavaScript for Enhanced Card Interactions -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add enhanced interactions to category cards
        const categoryCards = document.querySelectorAll('.group.relative');
        
        categoryCards.forEach(card => {
            const link = card.querySelector('a');
            if (link) {
                // Add keyboard navigation
                link.setAttribute('tabindex', '0');
                
                // Add click feedback
                link.addEventListener('click', function(e) {
                    // Visual feedback on click
                    const cardDiv = this.querySelector('.category-card');
                    if (cardDiv) {
                        cardDiv.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            cardDiv.style.transform = '';
                        }, 150);
                    }
                    
                    // Log for analytics (optional)
                    const categoryName = this.querySelector('h3').textContent.trim();
                    console.log(`Category clicked: ${categoryName}`);
                });
                
                // Enhanced keyboard support
                link.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
                
                // Add mouse enter/leave effects
                link.addEventListener('mouseenter', function() {
                    const cardDiv = this.querySelector('.category-card');
                    if (cardDiv) {
                        cardDiv.style.transform = 'scale(1.02)';
                    }
                });
                
                link.addEventListener('mouseleave', function() {
                    const cardDiv = this.querySelector('.category-card');
                    if (cardDiv) {
                        cardDiv.style.transform = '';
                    }
                });
            }
        });
        
        // Add touch support for mobile devices
        if ('ontouchstart' in window) {
            categoryCards.forEach(card => {
                const link = card.querySelector('a');
                if (link) {
                    link.addEventListener('touchstart', function() {
                        this.classList.add('touch-active');
                    });
                    
                    link.addEventListener('touchend', function() {
                        this.classList.remove('touch-active');
                    });
                }
            });
        }
    });
</script>