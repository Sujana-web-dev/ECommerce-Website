


<!-- Auto-Sliding Carousel Banner -->
<section class="relative min-h-screen overflow-hidden">
    <!-- Carousel Container -->
    <div class="carousel-container relative min-h-screen">
        <!-- Carousel Track -->
        <div id="carouselTrack" class="flex transition-transform duration-700 ease-in-out min-h-screen">
            
            <!-- Slide 1 - Premium Shopping -->
            <div class="carousel-slide min-w-full min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-slate-800 to-gray-900">
                <!-- Background Elements -->
                <div class="absolute inset-0">
                    <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-primary-500/10 rounded-full"></div>
                    <div class="absolute bottom-1/3 right-1/4 w-48 h-48 bg-luxury-gold/10 rounded-full"></div>
                </div>

                <div class="container mx-auto px-4 py-20 relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <!-- Left Column -->
                        <div class="text-center lg:text-left">
                            <div class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-white/90 text-sm font-medium mb-6">
                                ✨ Premium Collection 2025
                            </div>
                            
                            <h1 class="text-5xl lg:text-7xl font-bold text-white leading-tight mb-6">
                                <span class="block">Premium</span>
                                <span class="block text-luxury-gold">Shopping</span>
                            </h1>
                            
                            <p class="text-xl text-gray-200 max-w-2xl mb-8">
                                Discover quality products at great prices. Shop with confidence and enjoy fast, secure delivery.
                            </p>
                            
                            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                <a href="{{ route('all.products') }}" class="bg-luxury-gold hover:bg-yellow-400 text-gray-900 px-8 py-3 rounded-lg font-semibold transition-colors">
                                    Shop Now
                                </a>
                                <!-- <button class="bg-white/10 text-white px-8 py-3 rounded-lg font-semibold border border-white/20 hover:bg-white/20 transition-colors">
                                    Learn More
                                </button> -->
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="relative">
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                                <div class="aspect-square rounded-xl overflow-hidden mb-4 relative">
                                    <img src="{{ asset('assets/images/card1.jpg') }}" alt="Premium Product" class="w-full h-full object-cover">
                                    <div class="absolute top-3 right-3 bg-luxury-gold text-gray-900 px-2 py-1 rounded-full text-xs font-medium">
                                        New
                                    </div>
                                </div>
                                
                                <div class="text-center space-y-4">
                                    <div class="inline-block bg-luxury-gold/20 text-luxury-gold px-4 py-2 rounded-full text-sm font-medium">
                                        Featured Product
                                    </div>
                                    <div class="space-y-2">
                                        <h3 class="text-2xl font-bold text-white">Premium Collection</h3>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 2 - Summer Collection -->
            <div class="carousel-slide min-w-full min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-indigo-800 to-purple-900">
                <!-- Background Elements -->
                <div class="absolute inset-0">
                    <div class="absolute top-1/4 right-1/4 w-80 h-80 bg-blue-500/10 rounded-full"></div>
                    <div class="absolute bottom-1/4 left-1/4 w-64 h-64 bg-red-500/10 rounded-full"></div>
                </div>

                <div class="container mx-auto px-4 py-20 relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div class="text-center lg:text-left">
                            <div class="inline-block px-4 py-2 bg-red-100 text-red-600 rounded-full text-sm font-medium mb-6">
                                New Arrival
                            </div>
                            <h1 class="text-5xl lg:text-7xl font-bold text-white leading-tight mb-6">
                                Summer <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-600">Collection</span>
                            </h1>
                            <p class="text-xl text-gray-200 mb-8 max-w-2xl">
                                Explore our latest summer collection with vibrant colors and comfortable designs.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                <a href="{{ route('all.products') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                                    Shop Collection
                                </a>
                                <!-- <button class="bg-white/10 text-white px-8 py-3 rounded-lg font-semibold border border-white/20 hover:bg-white/20 transition-colors">
                                    View Catalog
                                </button> -->
                            </div>
                        </div>
                        <div class="relative">
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                                <div class="aspect-square rounded-xl overflow-hidden mb-4 relative">
                                    <img src="{{ asset('assets/images/card2.avif') }}" alt="Summer Collection" class="w-full h-full object-cover">
                                    <div class="absolute top-3 right-3 bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                        Hot
                                    </div>
                                </div>
                                <div class="text-center space-y-4">
                                    <div class="inline-block bg-blue-500/20 text-blue-400 px-4 py-2 rounded-full text-sm font-medium">
                                        Summer Vibes
                                    </div>
                                    <div class="space-y-2">
                                        <h3 class="text-2xl font-bold text-white">Fashion Forward</h3>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3 - Sale Offer -->
            <div class="carousel-slide min-w-full min-h-screen flex items-center justify-center bg-gradient-to-br from-green-900 via-emerald-800 to-teal-900">
                <!-- Background Elements -->
                <div class="absolute inset-0">
                    <div class="absolute top-1/4 left-1/3 w-72 h-72 bg-green-500/10 rounded-full"></div>
                    <div class="absolute bottom-1/4 right-1/3 w-56 h-56 bg-purple-500/10 rounded-full"></div>
                </div>

                <div class="container mx-auto px-4 py-20 relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div class="text-center lg:text-left">
                            <div class="inline-block px-4 py-2 bg-green-100 text-green-600 rounded-full text-sm font-medium mb-6">
                                Limited Offer
                            </div>
                            <h1 class="text-5xl lg:text-7xl font-bold text-white leading-tight mb-6">
                                Up to <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">20% OFF</span>
                            </h1>
                            <p class="text-xl text-gray-200 mb-8 max-w-2xl">
                                Don't miss our biggest sale of the year. Premium products at unbeatable prices.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                                <a href="{{ route('all.products') }}" class="bg-green-600 hover:bg-green-500 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                                    Shop Sale
                                </a>
                                <!-- <button class="bg-white/10 text-white px-8 py-3 rounded-lg font-semibold border border-white/20 hover:bg-white/20 transition-colors">
                                    Learn More
                                </button> -->
                            </div>
                        </div>
                        <div class="relative">
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                                <div class="aspect-square rounded-xl overflow-hidden mb-4 relative">
                                    <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1399&q=80" alt="Sale Items" class="w-full h-full object-cover">
                                    <div class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                        50% OFF
                                    </div>
                                </div>
                                <div class="text-center space-y-4">
                                    <div class="inline-block bg-red-500/20 text-red-400 px-4 py-2 rounded-full text-sm font-medium">
                                        Mega Sale
                                    </div>
                                    <div class="space-y-2">
                                        <h3 class="text-2xl font-bold text-white">Electronics Deal</h3>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navigation Arrows -->
        <button id="prevSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full p-3 shadow-lg z-10 transition">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button id="nextSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full p-3 shadow-lg z-10 transition">
            <i class="fas fa-chevron-right"></i>
        </button>
        
        <!-- Indicators -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
            <button class="carousel-indicator w-3 h-3 rounded-full bg-white/80 hover:bg-white transition" data-slide="0"></button>
            <button class="carousel-indicator w-3 h-3 rounded-full bg-white/50 hover:bg-white transition" data-slide="1"></button>
            <button class="carousel-indicator w-3 h-3 rounded-full bg-white/50 hover:bg-white transition" data-slide="2"></button>
        </div>
    </div>
</section>

<style>
    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.getElementById('carouselTrack');
        const slides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.carousel-indicator');
        const prevButton = document.getElementById('prevSlide');
        const nextButton = document.getElementById('nextSlide');
        
        let currentSlide = 0;
        const totalSlides = slides.length;
        
        // Set initial positions
        function updateCarousel() {
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
            
            // Update indicators
            indicators.forEach((indicator, index) => {
                if (index === currentSlide) {
                    indicator.classList.remove('bg-white/50');
                    indicator.classList.add('bg-white/80');
                } else {
                    indicator.classList.remove('bg-white/80');
                    indicator.classList.add('bg-white/50');
                }
            });
        }
        
        // Next slide
        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }
        
        // Previous slide
        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }
        
        // Go to specific slide
        function goToSlide(slideIndex) {
            currentSlide = slideIndex;
            updateCarousel();
        }
        
        // Event listeners
        nextButton.addEventListener('click', nextSlide);
        prevButton.addEventListener('click', prevSlide);
        
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => goToSlide(index));
        });
        
        // Auto-play carousel
        let autoplayInterval = setInterval(nextSlide, 5000);
        
        // Pause autoplay when hovering over carousel
        const carouselContainer = document.querySelector('.carousel-container');
        carouselContainer.addEventListener('mouseenter', () => {
            clearInterval(autoplayInterval);
        });
        
        // Resume autoplay when mouse leaves
        carouselContainer.addEventListener('mouseleave', () => {
            autoplayInterval = setInterval(nextSlide, 5000);
        });

        // Animated Counter for Stats
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const increment = target / 100;
                let current = 0;
                
                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        if (target === 99) {
                            counter.textContent = Math.ceil(current) + '%';
                        } else {
                            counter.textContent = Math.ceil(current).toLocaleString() + '+';
                        }
                        requestAnimationFrame(updateCounter);
                    } else {
                        if (target === 99) {
                            counter.textContent = target + '%';
                        } else {
                            counter.textContent = target.toLocaleString() + '+';
                        }
                    }
                };
                
                updateCounter();
            });
        }

        // Trigger counters when visible
        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                    entry.target.classList.add('animated');
                    animateCounters();
                }
            });
        }, observerOptions);

        const statsSection = document.querySelector('.grid.grid-cols-3');
        if (statsSection) {
            observer.observe(statsSection);
        }
    });
</script>

<!-- Enhanced CSS Animations -->
<style>
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes spin-slow {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes gradient-shift {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }

    .animate-slideInUp {
        animation: slideInUp 0.8s ease-out;
    }

    .animate-spin-slow {
        animation: spin-slow 8s linear infinite;
    }

    .gradient-shift {
        background-size: 200% 200%;
        animation: gradient-shift 4s ease infinite;
    }

    /* Gradient radial utility */
    .bg-gradient-radial {
        background: radial-gradient(circle, var(--tw-gradient-stops));
    }

    /* Enhanced hover effects */
    .luxury-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    }

    /* Floating animation enhancement */
    @keyframes float-enhanced {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        33% {
            transform: translateY(-10px) rotate(1deg);
        }
        66% {
            transform: translateY(-5px) rotate(-1deg);
        }
    }

    .animate-float {
        animation: float-enhanced 6s ease-in-out infinite;
    }

    /* Product card hover effects */
    .luxury-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Button hover effects */
    .btn-luxury {
        position: relative;
        overflow: hidden;
    }

    .btn-luxury::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-luxury:hover::before {
        left: 100%;
    }
</style>
