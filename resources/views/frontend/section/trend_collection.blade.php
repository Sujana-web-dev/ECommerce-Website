<!-- Categories Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Shop by Category</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Explore our carefully curated categories designed to meet your every need</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Category 1 -->
            <div class="category-card relative rounded-xl overflow-hidden shadow-lg h-64">
                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1399&q=80" alt="Electronics" class="w-full h-full object-cover">
                <div class="category-overlay absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                    <div>
                        <a href="{{ route('electronics') }}"><h3 class="text-white text-xl font-bold mb-1">Electronics</h3></a>
                        <p class="text-white/80 text-sm">120+ Products</p>
                    </div>
                </div>
            </div>

            <!-- Category 2 -->
            <div class="category-card relative rounded-xl overflow-hidden shadow-lg h-64">
                <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="Fashion" class="w-full h-full object-cover">
                <div class="category-overlay absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                    <div>
                        <a href="{{ route('fashion') }}"><h3 class="text-white text-xl font-bold mb-1">Fashion</h3></a>
                        <p class="text-white/80 text-sm">250+ Products</p>
                    </div>
                </div>
            </div>

            <!-- Category 3 -->
            <div class="category-card relative rounded-xl overflow-hidden shadow-lg h-64">
                <img src="https://images.unsplash.com/photo-1490474418585-ba9bad8fd0ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="Home & Living" class="w-full h-full object-cover">
                <div class="category-overlay absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                    <div>
                        <a href="{{ route('home_garden') }}"><h3 class="text-white text-xl font-bold mb-1">Home & Garden</h3></a>
                        <p class="text-white/80 text-sm">180+ Products</p>
                    </div>
                </div>
            </div>

            <!-- Category 4 -->
            <div class="category-card relative rounded-xl overflow-hidden shadow-lg h-64">
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="Sports" class="w-full h-full object-cover">
                <div class="category-overlay absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                    <div>
                        <a href="{{ route('sports') }}"><h3 class="text-white text-xl font-bold mb-1">Sports</h3></a>
                        <p class="text-white/80 text-sm">95+ Products</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>