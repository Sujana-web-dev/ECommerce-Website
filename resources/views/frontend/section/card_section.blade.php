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
                <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-700" data-aos="fade-right" data-aos-delay="100">
                    <div class="aspect-[4/5] relative">
                        <img src="{{ asset('assets/images/card1.jpg') }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                             alt="Lookbook 2025">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent group-hover:from-black/70 transition-all duration-500"></div>
                        
                        <!-- Floating Elements -->
                        <div class="absolute top-6 right-6 w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                            <i class="fas fa-eye text-white text-xl"></i>
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
                                <button class="mt-4 px-6 py-3 bg-white text-gray-900 font-semibold rounded-full hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 inline-flex items-center space-x-2">
                                    <span>Explore Collection</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summer Sale Card -->
                <div class="group relative overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-700" data-aos="fade-left" data-aos-delay="200">
                    <div class="aspect-[4/5] relative">
                        <img src="{{ asset('assets/images/card2.avif') }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                             alt="Summer Sale">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-900/90 via-primary-600/40 to-transparent group-hover:from-primary-800/90 transition-all duration-500"></div>
                        
                        <!-- Animated Elements -->
                        <div class="absolute top-6 left-6 w-20 h-20 border-2 border-white/30 rounded-full animate-pulse"></div>
                        <div class="absolute top-8 left-8 w-16 h-16 border-2 border-luxury-gold rounded-full animate-spin-slow"></div>
                        
                        <!-- Sale Badge -->
                        <div class="absolute top-6 right-6 transform rotate-12 group-hover:rotate-0 transition-transform duration-500">
                            <div class="bg-red-500 text-white px-4 py-2 rounded-full font-bold text-sm shadow-lg">
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
                                <button class="mt-4 px-6 py-3 bg-luxury-gold text-gray-900 font-semibold rounded-full hover:bg-yellow-400 transform hover:scale-105 transition-all duration-300 inline-flex items-center space-x-2">
                                    <span>Shop Now</span>
                                    <i class="fas fa-shopping-bag"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Features -->
            <div class="grid md:grid-cols-3 gap-8 mt-16" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center group">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-200 transition-colors duration-300">
                        <i class="fas fa-shipping-fast text-2xl text-primary-600"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2">Free Shipping</h4>
                    <p class="text-gray-600 text-sm">On orders over $100 worldwide</p>
                </div>
                
                <div class="text-center group">
                    <div class="w-16 h-16 bg-luxury-gold/20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-luxury-gold/30 transition-colors duration-300">
                        <i class="fas fa-undo-alt text-2xl text-luxury-gold"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2">Easy Returns</h4>
                    <p class="text-gray-600 text-sm">30-day money back guarantee</p>
                </div>
                
                <div class="text-center group">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors duration-300">
                        <i class="fas fa-headset text-2xl text-green-600"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2">24/7 Support</h4>
                    <p class="text-gray-600 text-sm">Dedicated customer service</p>
                </div>
            </div>
        </div>
    </section>