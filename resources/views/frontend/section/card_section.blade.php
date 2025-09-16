    <section class="py-16 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 bg-gradient-to-r from-primary-50 to-luxury-gold/5"></div>
        <div class="absolute top-10 right-10 w-64 h-64 bg-primary-100 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute bottom-10 left-10 w-48 h-48 bg-luxury-gold/20 rounded-full opacity-30 blur-2xl"></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-primary-600 font-medium text-sm uppercase tracking-wider">Premium Collections</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mt-3 mb-4 font-serif">
                    Curated Excellence
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Discover our handpicked selections that define luxury and sophistication
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Lookbook Card -->
                <a href="{{ route('all.products') }}" 
                   class="card-container card-link group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-700 cursor-pointer block" 
                   data-aos="fade-right" 
                   data-aos-delay="100"
                   aria-label="Explore Fashion Collection - Lookbook 2025"
                   role="button">
                    <div class="aspect-[4/5] relative">
                        <img src="{{ asset('assets/images/card1.jpg') }}" 
                             class="card-image w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                             alt="Lookbook 2025">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent group-hover:from-black/70 transition-all duration-500"></div>
                        
                        <!-- Floating Elements -->
                        <div class="absolute top-6 right-6 w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                            <i class="fas fa-external-link-alt text-white text-xl"></i>
                        </div>
                        
                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 right-0 p-8">
                            <div class="space-y-3 transform group-hover:-translate-y-2 transition-transform duration-500">
                                <span class="inline-block px-4 py-2 bg-luxury-gold text-gray-900 font-semibold text-sm rounded-full">
                                    New Collection
                                </span>
                                <h3 class="text-3xl lg:text-4xl font-bold text-white font-serif">
                                    Lookbook 2025
                                </h3>
                                <p class="text-gray-200 text-lg">
                                    Make love this look
                                </p>
                                <span class="card-button card-interactive mt-4 px-6 py-3 bg-white text-gray-900 font-semibold rounded-full hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 inline-flex items-center space-x-2">
                                    <span>Explore Collection</span>
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Summer Sale Card -->
                <a href="{{ route('fashion') }}?sale=true" 
                   class="card-container card-link group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-700 cursor-pointer block" 
                   data-aos="fade-left" 
                   data-aos-delay="200"
                   aria-label="Shop Summer Sale - Up to 70% OFF"
                   role="button">
                    <div class="aspect-[4/5] relative">
                        <img src="{{ asset('assets/images/card2.avif') }}" 
                             class="card-image w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                             alt="Summer Sale">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-900/90 via-primary-600/40 to-transparent group-hover:from-primary-800/90 transition-all duration-500"></div>
                        
                        <!-- Animated Elements -->
                        <div class="absolute top-6 left-6 w-20 h-20 border-2 border-white/30 rounded-full animate-pulse"></div>
                        <div class="absolute top-8 left-8 w-16 h-16 border-2 border-luxury-gold rounded-full animate-spin-slow"></div>
                        
                        <!-- Sale Badge -->
                        <div class="absolute top-6 right-6 transform rotate-12 group-hover:rotate-0 transition-transform duration-500">
                            <div class="badge-pulse bg-red-500 text-white px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                                HOT SALE!
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="absolute bottom-0 left-0 right-0 p-8">
                            <div class="space-y-3 transform group-hover:-translate-y-2 transition-transform duration-500">
                                <span class="inline-block px-4 py-2 bg-red-500 text-white font-semibold text-sm rounded-full animate-pulse">
                                    Limited Time
                                </span>
                                <h3 class="text-2xl lg:text-3xl font-bold text-white">
                                    Summer Sale
                                </h3>
                                <div class="text-5xl lg:text-6xl font-bold text-luxury-gold font-serif">
                                    UP TO 70%
                                </div>
                                <p class="text-gray-200">
                                    Don't miss out on incredible savings
                                </p>
                                <span class="card-button card-interactive mt-4 px-6 py-3 bg-luxury-gold text-gray-900 font-semibold rounded-full hover:bg-yellow-400 transform hover:scale-105 transition-all duration-300 inline-flex items-center space-x-2">
                                    <span>Shop Now</span>
                                    <i class="fas fa-shopping-bag"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Additional Features with Navigation -->
            <div class="grid md:grid-cols-3 gap-8 mt-16" data-aos="fade-up" data-aos-delay="300">
                <a href="{{ route('all.products') }}" class="text-center group cursor-pointer card-interactive hover:bg-gray-50 p-6 rounded-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-200 group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-shipping-fast text-2xl text-primary-600"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors">Free Shipping</h4>
                    <p class="text-gray-600 text-sm">On orders over $100 worldwide</p>
                </a>
                
                <a href="{{ route('contact') }}" class="text-center group cursor-pointer card-interactive hover:bg-gray-50 p-6 rounded-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-luxury-gold/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-luxury-gold/30 group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-undo-alt text-2xl text-luxury-gold"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2 group-hover:text-luxury-gold transition-colors">Easy Returns</h4>
                    <p class="text-gray-600 text-sm">30-day money back guarantee</p>
                </a>
                
                <a href="{{ route('contact') }}" class="text-center group cursor-pointer card-interactive hover:bg-gray-50 p-6 rounded-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 group-hover:scale-110 transition-all duration-300">
                        <i class="fas fa-headset text-2xl text-green-600"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">24/7 Support</h4>
                    <p class="text-gray-600 text-sm">Dedicated customer service</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Enhanced Card Section Styles -->
    <style>
        /* Card hover effects */
        .card-link {
            text-decoration: none !important;
            color: inherit;
        }
        
        .card-link:hover {
            text-decoration: none !important;
            color: inherit;
        }
        
        /* Improved button hover effects */
        .card-button {
            position: relative;
            overflow: hidden;
            z-index: 10;
        }
        
        .card-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
            z-index: -1;
        }
        
        .card-button:hover::before {
            left: 100%;
        }
        
        /* Enhanced card scaling and shadow effects */
        .card-container:hover {
            transform: translateY(-5px);
        }
        
        .card-container:hover .card-image {
            filter: brightness(1.1);
        }
        
        /* Smooth transition for all interactive elements */
        .card-interactive {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Enhanced cursor styles */
        .cursor-pointer {
            cursor: pointer !important;
        }
        
        /* Add subtle glow effect on hover */
        .card-container:hover {
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25), 
                       0 0 50px rgba(255, 215, 0, 0.1);
        }
        
        /* Badge animations */
        @keyframes badge-pulse {
            0%, 100% { transform: scale(1) rotate(12deg); }
            50% { transform: scale(1.05) rotate(12deg); }
        }
        
        .badge-pulse:hover {
            animation: badge-pulse 2s ease-in-out infinite;
        }
        
        /* Prevent text selection on cards */
        .card-container {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        
        /* Enhanced ripple effect */
        .card-container {
            position: relative;
            overflow: hidden;
        }
        
        .card-container::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
            z-index: 1;
            pointer-events: none;
        }
        
        .card-container:hover::before {
            width: 300px;
            height: 300px;
        }
    </style>

    <!-- JavaScript for Enhanced Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add click tracking for analytics
            const cardLinks = document.querySelectorAll('.card-container');
            
            cardLinks.forEach(card => {
                card.addEventListener('click', function(e) {
                    // Add visual feedback
                    this.style.transform = 'translateY(-5px) scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                    
                    // Log card interaction (for analytics)
                    const cardType = this.querySelector('h3').textContent.trim();
                    console.log(`Card clicked: ${cardType}`);
                });
            });
            
            // Add keyboard navigation support
            cardLinks.forEach(card => {
                card.setAttribute('tabindex', '0');
                card.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });
        });
    </script>