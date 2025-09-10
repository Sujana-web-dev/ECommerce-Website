<!-- Hero Section -->
<!-- <section class="relative overflow-hidden">
    <div class="container mx-auto px-4 py-16 md:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                    Discover <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-red-600">Premium</span> Products
                </h1>
                <p class="text-lg text-gray-600 mb-8 max-w-lg">
                    Experience the finest selection of curated products with exceptional quality and design.
                </p>
                <div class="flex flex-wrap gap-4">
                    <button class="btn-primary text-white px-8 py-3 rounded-lg font-medium shadow-lg">
                        Shop Now
                    </button>
                    <button class="bg-white border border-gray-300 text-gray-800 px-8 py-3 rounded-lg font-medium hover:bg-gray-50 transition">
                        Explore Collection
                    </button>
                </div>
            </div>
            <div class="relative floating">
                <div class="relative z-10">
                    <img src="{{ asset('assets/images/card1.jpg') }}" alt="Premium Product" class="rounded-2xl shadow-xl">
                </div>
                <div class="absolute -top-6 -right-6 w-64 h-64 bg-red-500 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
                <div class="absolute -bottom-6 -left-6 w-64 h-64 bg-blue-900 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
            </div>
        </div>
    </div>
</section> -->


<!-- Hero Carousel Section -->
<section class="relative overflow-hidden gradient-bg">
    <div class="carousel-container relative">
        <!-- Slides -->
        <div class="carousel-track flex transition-transform duration-500 ease-in-out" id="carouselTrack">
            <!-- Slide 1 -->
            <div class="carousel-slide min-w-full">
                <div class="container mx-auto px-4 py-16 md:py-24">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div class="fade-in">
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                                Discover <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-red-600">Premium</span> Products
                            </h1>
                            <p class="text-lg text-gray-400 mb-8 max-w-lg">
                                Experience the finest selection of curated products with exceptional quality and design.
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <button class="btn-secondary text-white px-8 py-3 rounded-lg font-medium shadow-lg">
                                    Shop Now
                                </button>
                                <button class="bg-white border border-gray-300 text-gray-800 px-10 py-3 rounded-lg font-medium hover:bg-gray-50 transition">
                                    Explore Collection
                                </button>
                            </div>
                        </div>
                        <div class="relative floating">
                            <div class="relative z-10">
                                <img src="{{ asset('assets/images/card1.jpg') }}" alt="Premium Product" class="rounded-2xl shadow-xl">
                            </div>
                            <div class="absolute -top-6 -right-6 w-64 h-64 bg-red-500 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
                            <div class="absolute -bottom-6 -left-6 w-64 h-64 bg-blue-900 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 2 -->
            <div class="carousel-slide min-w-full">
                <div class="container mx-auto px-4 py-16 md:py-24">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div class="fade-in">
                            <div class="inline-block px-4 py-1 bg-red-100 text-red-600 rounded-full text-sm font-medium mb-4">
                                New Arrival
                            </div>
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                                Summer <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-blue-600">Collection</span> 2023
                            </h1>
                            <p class="text-lg text-gray-400 mb-8 max-w-lg">
                                Explore our latest summer collection with vibrant colors and comfortable designs.
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <button class="btn-secondary text-white px-8 py-3 rounded-lg font-medium shadow-lg">
                                    Shop Collection
                                </button>
                                <button class="bg-white border border-gray-300 text-gray-800 px-10 py-3 rounded-lg font-medium hover:bg-gray-50 transition">
                                    View Catalog
                                </button>
                            </div>
                        </div>
                        <div class="relative floating">
                            <div class="relative z-10">
                                <img src="{{ asset('assets/images/card2.avif') }}" alt="Summer Collection" class="rounded-2xl shadow-xl">
                            </div>
                            <div class="absolute -top-6 -right-6 w-64 h-64 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
                            <div class="absolute -bottom-6 -left-6 w-64 h-64 bg-red-900 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Slide 3 -->
            <div class="carousel-slide min-w-full">
                <div class="container mx-auto px-4 py-16 md:py-24">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div class="fade-in">
                            <div class="inline-block px-4 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-medium mb-4">
                                Limited Offer
                            </div>
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                                Up to <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-green-600">50% OFF</span> Selected Items
                            </h1>
                            <p class="text-lg text-gray-400 mb-8 max-w-lg">
                                Don't miss our biggest sale of the year. Premium products at unbeatable prices.
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <button class="btn-secondary text-white px-8 py-3 rounded-lg font-medium shadow-lg">
                                    Shop Sale
                                </button>
                                <button class="bg-white border border-gray-300 text-gray-800 px-10 py-3 rounded-lg font-medium hover:bg-gray-50 transition">
                                    Learn More
                                </button>
                            </div>
                        </div>
                        <div class="relative floating">
                            <div class="relative z-10">
                                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1399&q=80" alt="Sale Items" class="rounded-2xl shadow-xl">
                            </div>
                            <div class="absolute -top-6 -right-6 w-64 h-64 bg-green-500 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
                            <div class="absolute -bottom-6 -left-6 w-64 h-64 bg-purple-900 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
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
    });
</script>
