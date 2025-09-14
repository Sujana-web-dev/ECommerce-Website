<!-- Premium Footer -->
<footer class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white pt-20 pb-8 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-luxury-gold/10 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Newsletter Section -->
        <!-- <div class="text-center mb-16 pb-16 border-b border-gray-700">
            <h2 class="text-4xl lg:text-5xl font-serif font-bold mb-6 gradient-text">Stay in the Loop</h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                Subscribe to our newsletter and be the first to know about exclusive deals, new arrivals, and luxury collections.
            </p>
            <div class="max-w-md mx-auto">
                <div class="flex rounded-2xl overflow-hidden luxury-shadow">
                    <input type="email" placeholder="Enter your email address" class="flex-1 px-6 py-4 text-gray-900 focus:outline-none">
                    <button class="btn-luxury text-gray-900 px-8 py-4 font-semibold hover-lift">
                        Subscribe
                    </button>
                </div>
                <p class="text-sm text-gray-400 mt-3">Join 50,000+ premium shoppers. No spam, unsubscribe anytime.</p>
            </div>
        </div> -->

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <!-- Brand Column -->
            <div class="lg:col-span-1">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-12 h-12 premium-bg rounded-xl flex items-center justify-center">
                        <i class="fas fa-gem text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-serif font-bold gradient-text">EasyCart</h3>
                        <p class="text-xs text-gray-400 -mt-1">Premium Shopping</p>
                    </div>
                </div>
                <p class="text-gray-300 mb-8 leading-relaxed">
                    Your premier destination for luxury products, exceptional quality, and unparalleled shopping experiences since 2020.
                </p>
                
                <!-- Social Media -->
                <div class="flex space-x-4">
                    <a href="#" class="w-12 h-12 bg-gray-800 hover:bg-primary-600 rounded-xl flex items-center justify-center transition-all duration-300 hover-lift group">
                        <i class="fab fa-facebook-f text-gray-400 group-hover:text-white transition-colors"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-gray-800 hover:bg-primary-600 rounded-xl flex items-center justify-center transition-all duration-300 hover-lift group">
                        <i class="fab fa-twitter text-gray-400 group-hover:text-white transition-colors"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-gray-800 hover:bg-primary-600 rounded-xl flex items-center justify-center transition-all duration-300 hover-lift group">
                        <i class="fab fa-instagram text-gray-400 group-hover:text-white transition-colors"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-gray-800 hover:bg-primary-600 rounded-xl flex items-center justify-center transition-all duration-300 hover-lift group">
                        <i class="fab fa-linkedin-in text-gray-400 group-hover:text-white transition-colors"></i>
                    </a>
                </div>
            </div>

            <!-- Shop Categories -->
            <div>
                <h3 class="text-xl font-bold mb-6 text-white">Shop Categories</h3>
                <ul class="space-y-4">
                    <li><a href="{{route('electronics')}}" class="text-gray-300 hover:text-luxury-gold transition-colors flex items-center group">
                        <i class="fas fa-laptop mr-3 text-primary-400 group-hover:text-luxury-gold transition-colors"></i>
                        Electronics
                    </a></li>
                    <li><a href="{{route('fashion')}}" class="text-gray-300 hover:text-luxury-gold transition-colors flex items-center group">
                        <i class="fas fa-tshirt mr-3 text-primary-400 group-hover:text-luxury-gold transition-colors"></i>
                        Fashion
                    </a></li>
                    <li><a href="{{route('home_garden')}}" class="text-gray-300 hover:text-luxury-gold transition-colors flex items-center group">
                        <i class="fas fa-home mr-3 text-primary-400 group-hover:text-luxury-gold transition-colors"></i>
                        Home & Garden
                    </a></li>
                    <li><a href="{{route('sports')}}" class="text-gray-300 hover:text-luxury-gold transition-colors flex items-center group">
                        <i class="fas fa-dumbbell mr-3 text-primary-400 group-hover:text-luxury-gold transition-colors"></i>
                        Sports
                    </a></li>
                    <li><a href="{{route('beauty')}}" class="text-gray-300 hover:text-luxury-gold transition-colors flex items-center group">
                        <i class="fas fa-spa mr-3 text-primary-400 group-hover:text-luxury-gold transition-colors"></i>
                        Beauty
                    </a></li>
                    <li><a href="{{route('books')}}" class="text-gray-300 hover:text-luxury-gold transition-colors flex items-center group">
                        <i class="fas fa-book mr-3 text-primary-400 group-hover:text-luxury-gold transition-colors"></i>
                        Books
                    </a></li>
                </ul>
            </div>

            <!-- Customer Support -->
            <div>
                <h3 class="text-xl font-bold mb-6 text-white">Customer Support</h3>
                <ul class="space-y-4">
                    <li><a href="{{route('contact')}}" class="text-gray-300 hover:text-luxury-gold transition-colors flex items-center group">
                        <i class="fas fa-headset mr-3 text-primary-400 group-hover:text-luxury-gold transition-colors"></i>
                        Contact Us
                    </a></li>
                    <li><a href="#" class="text-gray-300 hover:text-luxury-gold transition-colors flex items-center group">
                        <i class="fas fa-question-circle mr-3 text-primary-400 group-hover:text-luxury-gold transition-colors"></i>
                        FAQs
                    </a></li>
                    <li><a href="#" class="text-gray-300 hover:text-luxury-gold transition-colors flex items-center group">
                        <i class="fas fa-shipping-fast mr-3 text-primary-400 group-hover:text-luxury-gold transition-colors"></i>
                        Shipping Info
                    </a></li>
                    <li><a href="#" class="text-gray-300 hover:text-luxury-gold transition-colors flex items-center group">
                        <i class="fas fa-undo mr-3 text-primary-400 group-hover:text-luxury-gold transition-colors"></i>
                        Returns
                    </a></li>
                    <li><a href="#" class="text-gray-300 hover:text-luxury-gold transition-colors flex items-center group">
                        <i class="fas fa-shield-alt mr-3 text-primary-400 group-hover:text-luxury-gold transition-colors"></i>
                        Privacy Policy
                    </a></li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div>
                <h3 class="text-xl font-bold mb-6 text-white">Get in Touch</h3>
                <div class="space-y-4">
                    <div class="flex items-start group">
                        <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center mr-4 group-hover:bg-primary-600 transition-colors">
                            <i class="fas fa-map-marker-alt text-primary-400 group-hover:text-white transition-colors"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium">Visit Our Store</p>
                            <p class="text-gray-300 text-sm leading-relaxed">Road 12, Sector 10, Uttara Model Town, Dhaka, Bangladesh</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center group">
                        <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center mr-4 group-hover:bg-primary-600 transition-colors">
                            <i class="fas fa-phone-alt text-primary-400 group-hover:text-white transition-colors"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium">Call Us</p>
                            <p class="text-gray-300 text-sm">+880 123 456 7890</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center group">
                        <div class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center mr-4 group-hover:bg-primary-600 transition-colors">
                            <i class="fas fa-envelope text-primary-400 group-hover:text-white transition-colors"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium">Email Us</p>
                            <p class="text-gray-300 text-sm">support@easycart.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright & Legal -->
        <div class="border-t border-gray-700 pt-8 flex flex-col lg:flex-row justify-between items-center">
            <div class="text-center lg:text-left mb-4 lg:mb-0">
                <p class="text-gray-400">&copy; 2025 EasyCart Premium Store. All rights reserved.</p>
                <p class="text-gray-500 text-sm mt-1">Crafted with ❤️ for luxury shopping experience</p>
            </div>
            
            <div class="flex items-center space-x-6 text-sm">
                <a href="#" class="text-gray-400 hover:text-luxury-gold transition-colors">Terms of Service</a>
                <span class="text-gray-600">|</span>
                <a href="#" class="text-gray-400 hover:text-luxury-gold transition-colors">Privacy Policy</a>
                <span class="text-gray-600">|</span>
                <a href="#" class="text-gray-400 hover:text-luxury-gold transition-colors">Cookie Policy</a>
                <span class="text-gray-600">|</span>
                <a href="{{route('contact')}}" class="text-gray-400 hover:text-luxury-gold transition-colors">Support</a>
            </div>
        </div>
    </div>
</footer>