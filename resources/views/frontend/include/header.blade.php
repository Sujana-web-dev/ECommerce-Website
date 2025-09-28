@php
// Use CartService for consistent cart handling
if (! isset($cart)) {
    $cartService = app(\App\Services\CartService::class);
    $cart = $cartService->get();
    $cartCount = $cartService->count();
} else {
    $cartCount = $cart->sum('quantity') ?? 0;
}
@endphp



<!-- Main Header -->
<header class="bg-white/95 backdrop-blur-md shadow-xl sticky top-0 z-50 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard')}}" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 premium-bg rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-gem text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-serif font-bold gradient-text">EasyCart</h1>
                        <p class="text-xs text-gray-500 -mt-1">Premium Shopping</p>
                    </div>
                </a>
            </div>

            <!-- Search Bar - Desktop -->
            <div class="hidden lg:flex flex-1 max-w-2xl mx-8">
                <form action="{{ route('products.search') }}" method="GET" class="relative w-full group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 group-focus-within:text-primary-600 transition-colors"></i>
                    </div>
                    <input type="text" 
                           id="searchInput"
                           name="query"
                           value="{{ request('query') }}"
                           placeholder="Search for luxury products..." 
                           class="w-full pl-12 pr-6 py-4 border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-primary-100 focus:border-primary-500 transition-all duration-300 bg-gray-50 hover:bg-white text-gray-900 placeholder-gray-500"
                           autocomplete="off">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                        <button type="submit" class="btn-premium text-white px-6 py-2 rounded-xl font-medium hover-lift">
                            Search
                        </button>
                    </div>
                    <!-- Search Suggestions Dropdown -->
                    <div id="searchSuggestions" class="absolute top-full left-0 right-0 bg-white border border-gray-200 rounded-xl mt-2 shadow-xl z-50 hidden max-h-96 overflow-y-auto">
                        <!-- Dynamic suggestions will be loaded here -->
                    </div>
                </form>
            </div>

            <!-- Desktop Navigation Icons -->
            <div class="hidden lg:flex items-center space-x-6">
                <!-- Wishlist -->
                <div class="relative">
                    <button id="wishlistToggle" class="relative group p-2 hover:bg-gray-100 rounded-xl transition-colors">
                        <i class="fas fa-heart text-xl text-gray-600 group-hover:text-red-500 transition-colors"></i>
                        <span id="wishlistCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center animate-pulse">0</span>
                    </button>
                    
                    <!-- Wishlist Dropdown -->
                    <div id="wishlistDropdown" class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-2xl py-4 z-50 border border-gray-100" style="display: none; visibility: hidden;">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-red-50 to-pink-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-pink-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-heart text-white"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">My Wishlist</h3>
                                    <p class="text-sm text-gray-600" id="wishlistSubtitle">Your favorite items</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="max-h-96 overflow-y-auto" id="wishlistItemsContainer">
                            <div class="text-center py-8 text-gray-400">
                                <div class="mb-3">
                                    <i class="fas fa-heart text-4xl opacity-30"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-600 mb-1">Your wishlist is empty</h3>
                                <p class="text-sm text-gray-500">Start adding items you love!</p>
                            </div>
                        </div>
                        
                        <div class="px-4 pt-4 border-t border-gray-200">
                            <button class="w-full bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white py-2 rounded-xl font-semibold text-sm shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                View All Wishlist
                            </button>
                        </div>
                    </div>
                </div>

                <!-- User Account -->
                <div class="relative">
                    <button id="userDropdownToggle" class="flex items-center space-x-2 p-2 hover:bg-gray-100 rounded-xl transition-colors group" onclick="toggleUserDropdown(event)">
                        @auth
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                                <span class="text-white text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span class="hidden xl:block font-medium text-gray-700 group-hover:text-gray-900">{{ Auth::user()->name }}</span>
                        @else
                            <i class="fas fa-user text-xl text-gray-600 group-hover:text-gray-900 transition-colors"></i>
                            <span class="hidden xl:block font-medium text-gray-700 group-hover:text-gray-900">Account</span>
                        @endauth
                        <i class="fas fa-chevron-down text-xs text-gray-400 group-hover:text-gray-600 transition-colors"></i>
                    </button>

                    <!-- Enhanced Dropdown Menu -->
                    <div id="userDropdown" class="absolute right-0 mt-2 w-72 bg-white rounded-2xl shadow-2xl py-4 z-50 opacity-0 invisible transform scale-95 transition-all duration-300 border border-gray-100">
                        @auth
                        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-primary-50 to-primary-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                                    <span class="text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                                <i class="fas fa-tachometer-alt mr-3 w-4"></i> Dashboard
                            </a>
                            <a href="{{ route('orders.history') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                                <i class="fas fa-shopping-bag mr-3 w-4"></i> My Orders
                            </a>
                            <a href="{{ route('cart.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                                <i class="fas fa-shopping-cart mr-3 w-4"></i> My Cart
                            </a>
                            <a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                                <i class="fas fa-cog mr-3 w-4"></i> Settings
                            </a>
                        </div>
                        <div class="border-t border-gray-100 pt-2">
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-6 py-3 text-red-600 hover:bg-red-50 transition-colors">
                                    <i class="fas fa-sign-out-alt mr-3 w-4"></i> Sign Out
                                </button>
                            </form>
                        </div>
                        @else
                        <div class="px-6 py-4 text-center border-b border-gray-100">
                            <h3 class="font-semibold text-gray-900 mb-1">Welcome to EasyCart</h3>
                            <p class="text-sm text-gray-600">Sign in to access your account</p>
                        </div>
                        <div class="py-2">
                            <a href="#" id="loginBtn" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-primary-600 transition-colors" onclick="console.log('🔑 Redirecting to login page...'); window.location.href='{{ route('login') }}'; return false;">
                                <i class="fas fa-sign-in-alt mr-3 w-4"></i> Sign In
                            </a>
                            <a href="#" id="signupBtn" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-primary-600 transition-colors" onclick="console.log('📝 Redirecting to register page...'); window.location.href='{{ route('register') }}'; return false;">
                                <i class="fas fa-user-plus mr-3 w-4"></i> Create Account
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>

                <!-- Cart -->
                <button id="cartToggle" class="relative group p-2 hover:bg-gray-100 rounded-xl transition-colors">
                    <i class="fas fa-shopping-bag text-xl text-gray-600 group-hover:text-primary-600 transition-colors"></i>
                    <span id="cartCount" class="absolute -top-1 -right-1 bg-primary-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold animate-bounce">
                        {{ $cartCount }}
                    </span>
                </button>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuToggle" class="lg:hidden p-2 hover:bg-gray-100 rounded-xl transition-colors">
                <i class="fas fa-bars text-xl text-gray-600"></i>
            </button>
        </div>

        <!-- Main Navigation - Desktop -->
        <nav class="hidden lg:block border-t border-gray-100 py-4">
            <div class="flex items-center justify-center space-x-12">
                <a href="{{ route('electronics') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors flex items-center space-x-2 group">
                    <i class="fas fa-laptop text-sm group-hover:text-primary-600"></i>
                    <span>Electronics</span>
                </a>
                <a href="{{ route('fashion') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors flex items-center space-x-2 group">
                    <i class="fas fa-tshirt text-sm group-hover:text-primary-600"></i>
                    <span>Fashion</span>
                </a>
                <a href="{{ route('home_garden') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors flex items-center space-x-2 group">
                    <i class="fas fa-home text-sm group-hover:text-primary-600"></i>
                    <span>Home & Garden</span>
                </a>
                <a href="{{ route('sports') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors flex items-center space-x-2 group">
                    <i class="fas fa-dumbbell text-sm group-hover:text-primary-600"></i>
                    <span>Sports</span>
                </a>
                <a href="{{ route('beauty') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors flex items-center space-x-2 group">
                    <i class="fas fa-spa text-sm group-hover:text-primary-600"></i>
                    <span>Beauty</span>
                </a>
                <a href="{{ route('books') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors flex items-center space-x-2 group">
                    <i class="fas fa-book text-sm group-hover:text-primary-600"></i>
                    <span>Books</span>
                </a>
                <a href="{{ route('all.products') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors flex items-center space-x-2 group">
                    <i class="fas fa-th-large text-sm group-hover:text-primary-600"></i>
                    <span>All Products</span>
                </a>
            </div>
        </nav>
    </div>
</header>

<!-- Simple User Dropdown Functions -->
<script>
// Simple user dropdown toggle function
function toggleUserDropdown(event) {
    console.log('🔄 toggleUserDropdown called');
    event.preventDefault();
    event.stopPropagation();
    
    const dropdown = document.getElementById('userDropdown');
    console.log('📋 Dropdown element:', dropdown);
    
    if (dropdown) {
        const isVisible = dropdown.classList.contains('opacity-100') && dropdown.classList.contains('visible');
        console.log('👁️ Current visibility:', isVisible);
        
        if (!isVisible) {
            // Show dropdown
            dropdown.classList.remove('opacity-0', 'invisible', 'scale-95');
            dropdown.classList.add('opacity-100', 'visible', 'scale-100');
            console.log('✅ Dropdown shown');
        } else {
            // Hide dropdown
            dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
            dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
            console.log('❌ Dropdown hidden');
        }
    } else {
        console.error('❌ Dropdown element not found!');
    }
}

// Open login modal
function openLoginModal(event) {
    event.preventDefault();
    const loginModal = document.getElementById('loginModal');
    if (loginModal) {
        loginModal.classList.remove('hidden');
    }
    // Close dropdown after opening modal
    const dropdown = document.getElementById('userDropdownMenu');
    if (dropdown) dropdown.classList.add('hidden');
}

// Open signup modal
function openSignupModal(event) {
    event.preventDefault();
    const signupModal = document.getElementById('signupModal');
    if (signupModal) {
        signupModal.classList.remove('hidden');
    }
    // Close dropdown after opening modal
    const dropdown = document.getElementById('userDropdown');
    if (dropdown) {
        dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
        dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const button = document.getElementById('userDropdownToggle');
    
    if (dropdown && button) {
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
            dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
        }
    }
});

// Add event listeners when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 User dropdown initialization started...');
    
    // User dropdown toggle
    const userDropdownToggle = document.getElementById('userDropdownToggle');
    const userDropdown = document.getElementById('userDropdown');
    
    console.log('📋 Elements found:', {
        userDropdownToggle: !!userDropdownToggle,
        userDropdown: !!userDropdown
    });
    
    if (userDropdownToggle) {
        userDropdownToggle.addEventListener('click', function(event) {
            console.log('🖱️ User dropdown button clicked via event listener');
            toggleUserDropdown(event);
        });
        console.log('✅ Event listener added to user dropdown toggle');
    } else {
        console.error('❌ userDropdownToggle not found');
    }

    // Login and signup buttons - redirect to Laravel routes
    const loginBtn = document.getElementById('loginBtn');
    const signupBtn = document.getElementById('signupBtn');
    
    console.log('🔑 Login/Signup buttons found:', {
        loginBtn: !!loginBtn,
        signupBtn: !!signupBtn
    });
    
    if (loginBtn) {
        loginBtn.addEventListener('click', function(event) {
            console.log('🔑 Login button clicked via event listener');
            event.preventDefault();
            // Redirect to Laravel login route
            window.location.href = "{{ route('login') }}";
        });
    }
    
    if (signupBtn) {
        signupBtn.addEventListener('click', function(event) {
            console.log('📝 Signup button clicked via event listener');
            event.preventDefault();
            // Redirect to Laravel register route
            window.location.href = "{{ route('register') }}";
        });
    }
    
    console.log('✅ User dropdown initialization complete');
});
</script>

<!-- Mobile Menu -->
<div id="mobileMenu" class="fixed top-0 left-0 w-full h-full bg-white z-50 transform -translate-x-full transition-transform duration-300 lg:hidden">
    <div class="flex justify-between items-center p-6 border-b">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 premium-bg rounded-lg flex items-center justify-center">
                <i class="fas fa-gem text-white text-sm"></i>
            </div>
            <h2 class="text-xl font-serif font-bold gradient-text">EasyCart</h2>
        </div>
        <button id="closeMobileMenu" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
            <i class="fas fa-times text-xl text-gray-600"></i>
        </button>
    </div>
    
    <div class="p-6">
        <!-- Mobile Search -->
        <form action="{{ route('products.search') }}" method="GET" class="relative mb-6">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input type="text" 
                   name="query" 
                   value="{{ request('query') }}"
                   placeholder="Search products..." 
                   class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                   autocomplete="off">
        </form>
        
        <!-- Mobile Navigation -->
        <nav class="space-y-4">
            <a href="{{ route('electronics') }}" class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                <i class="fas fa-laptop text-primary-600"></i>
                <span class="font-medium">Electronics</span>
            </a>
            <a href="{{ route('fashion') }}" class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                <i class="fas fa-tshirt text-primary-600"></i>
                <span class="font-medium">Fashion</span>
            </a>
            <a href="{{ route('home_garden') }}" class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                <i class="fas fa-home text-primary-600"></i>
                <span class="font-medium">Home & Garden</span>
            </a>
            <a href="{{ route('sports') }}" class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                <i class="fas fa-dumbbell text-primary-600"></i>
                <span class="font-medium">Sports</span>
            </a>
            <a href="{{ route('beauty') }}" class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                <i class="fas fa-spa text-primary-600"></i>
                <span class="font-medium">Beauty</span>
            </a>
            <a href="{{ route('books') }}" class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                <i class="fas fa-book text-primary-600"></i>
                <span class="font-medium">Books</span>
            </a>
        </nav>
        
        @auth
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                    <span class="text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div>
                    <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <i class="fas fa-tachometer-alt text-gray-600"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('orders.history') }}" class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <i class="fas fa-shopping-bag text-gray-600"></i>
                    <span>My Orders</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 p-3 hover:bg-red-50 rounded-xl transition-colors w-full text-left text-red-600">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="mt-8 pt-6 border-t border-gray-200 space-y-3">
            <button id="mobileLoginBtn" class="w-full btn-premium text-white py-3 rounded-xl font-medium">Sign In</button>
            <button id="mobileSignupBtn" class="w-full border-2 border-primary-600 text-primary-600 py-3 rounded-xl font-medium hover:bg-primary-50 transition-colors">Create Account</button>
        </div>
        @endauth
    </div>
</div>

    </div>
</header>





<!-- Login Modal (HIDDEN - Use direct login page instead) -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 opacity-0 invisible transition-all duration-300" style="display: none !important; visibility: hidden !important;">
    <div class="bg-white rounded-2xl luxury-shadow w-full max-w-md mx-4 transform scale-95 transition-transform duration-300">
        <!-- Modal Header -->
        <div class="premium-bg p-6 rounded-t-2xl text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-bold">Welcome Back</h3>
                    <p class="text-blue-100 mt-1">Sign in to your premium account</p>
                </div>
                <button id="closeLoginModal" class="text-white hover:text-gray-200 transition-colors p-2 hover:bg-white/10 rounded-lg">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>

        <div class="p-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl animate-fade-in">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl animate-fade-in">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    {{ $errors->first() }}
                </div>
            </div>
            @endif


            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="login" class="block text-sm font-medium text-gray-700">Username or Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" name="login" id="login" 
                               class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-primary-100 focus:border-primary-500 transition-all duration-300" 
                               placeholder="Enter your username or email" required>
                    </div>
                    @error('login')
                    <p class="text-red-600 text-sm flex items-center mt-1">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" id="password" 
                               class="w-full pl-10 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-primary-100 focus:border-primary-500 transition-all duration-300" 
                               placeholder="Enter your password" required>
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword('password')">
                            <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                    @error('password')
                    <p class="text-red-600 text-sm flex items-center mt-1">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Keep me signed in</label>
                    </div>
                    <a href="#" class="text-sm text-primary-600 hover:text-primary-700 font-medium">Forgot password?</a>
                </div>

                <button type="submit" class="w-full btn-premium text-white py-3 rounded-xl font-semibold text-lg hover-lift">
                    Sign In to EasyCart
                </button>
            </form>

            <div class="mt-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500 font-medium">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-4">
                    <button class="flex justify-center items-center py-3 border-2 border-gray-200 rounded-xl hover:border-gray-300 hover:bg-gray-50 transition-all duration-300 group">
                        <i class="fab fa-google text-xl text-red-500 group-hover:scale-110 transition-transform"></i>
                    </button>
                    <button class="flex justify-center items-center py-3 border-2 border-gray-200 rounded-xl hover:border-gray-300 hover:bg-gray-50 transition-all duration-300 group">
                        <i class="fab fa-facebook-f text-xl text-blue-600 group-hover:scale-110 transition-transform"></i>
                    </button>
                    <button class="flex justify-center items-center py-3 border-2 border-gray-200 rounded-xl hover:border-gray-300 hover:bg-gray-50 transition-all duration-300 group">
                        <i class="fab fa-apple text-xl text-gray-800 group-hover:scale-110 transition-transform"></i>
                    </button>
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="text-gray-600">
                    New to EasyCart? 
                    <button id="switchToSignup" class="font-semibold text-primary-600 hover:text-primary-700 transition-colors">Create an account</button>
                </p>
            </div>
        </div>
    </div>
</div>


<!-- Signup Modal (HIDDEN - Use direct register page instead) -->
<div id="signupModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 opacity-0 invisible transition-all duration-300 overflow-y-auto p-4" style="display: none !important; visibility: hidden !important;">
    <div class="bg-white rounded-2xl luxury-shadow w-full max-w-lg mx-auto my-8 transform scale-95 transition-transform duration-300">
        <!-- Modal Header -->
        <div class="premium-bg p-6 rounded-t-2xl text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-bold">Join EasyCart</h3>
                    <p class="text-blue-100 mt-1">Create your premium account</p>
                </div>
                <button id="closeSignupModal" class="text-white hover:text-gray-200 transition-colors p-2 hover:bg-white/10 rounded-lg">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>

        <div class="p-8">

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-4">
                    <label for="signupName" class="block text-gray-700 font-medium mb-2">Full Name</label>
                    <input type="text" name="name" id="signupName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="John Doe" required>
                </div>

                <!-- ✅ Added Username Field -->
                <div class="mb-4">
                    <label for="signupUsername" class="block text-gray-700 font-medium mb-2">Username</label>
                    <input type="text" name="username" id="signupUsername" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="yourusername" required>
                </div>

                <div class="mb-4">
                    <label for="signupEmail" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" id="signupEmail" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="your@email.com" required>
                </div>

                <div class="mb-4">
                    <label for="signupPassword" class="block text-gray-700 font-medium mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="signupPassword" class="w-full px-4 py-2 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="••••••••" required>
                        <button type="button" id="toggleSignupPassword" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700">
                            <i id="signupEyeIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="mt-2 p-2 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-xs font-semibold text-blue-800 mb-1">🔒 Strong Password Required:</p>
                        <ul class="text-xs text-blue-700 space-y-1">
                            <li id="modal-length-check" class="flex items-center"><span class="mr-1">❌</span> 8+ characters</li>
                            <li id="modal-uppercase-check" class="flex items-center"><span class="mr-1">❌</span> Uppercase (A-Z)</li>
                            <li id="modal-lowercase-check" class="flex items-center"><span class="mr-1">❌</span> Lowercase (a-z)</li>
                            <li id="modal-number-check" class="flex items-center"><span class="mr-1">❌</span> Number (0-9)</li>
                            <li id="modal-special-check" class="flex items-center"><span class="mr-1">❌</span> Special (@$!%*#?&)</li>
                        </ul>
                        <p class="text-xs text-blue-600 mt-1 font-medium">💡 Use unique password to avoid security warnings.</p>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 pr-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="••••••••" required>
                        <button type="button" id="toggleSignupPasswordConfirm" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700">
                            <i id="signupEyeIconConfirm" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full btn-secondary text-white px-8 py-2 rounded-lg font-medium gradient-bg">
                    Sign Up
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account?
                    <a href="#" id="switchToLogin" class="font-medium text-[#ec4642]">Log in</a>
                </p>
            </div>
        </div>
    </div>
</div>


<!-- Shopping Cart Offcanvas -->
<div id="shoppingCart" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="fixed right-0 top-0 h-full w-96 bg-white shadow-xl transform transition-transform duration-300 translate-x-full" id="cartPanel">
        <!-- Cart Header -->
        <div class="bg-gray-900 text-white p-4 flex justify-between items-center">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-shopping-cart mr-2"></i>
                Shopping Cart
            </h3>
            <button onclick="closeCart()" class="text-white hover:text-gray-300 text-xl">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Cart Items -->
        <div id="cartItems" class="flex-1 overflow-y-auto p-4 h-[calc(100vh-180px)]">
            <!-- Cart items will be dynamically added here -->
            <div id="emptyCart" class="text-center py-12 text-gray-500">
                <i class="fas fa-shopping-cart text-4xl mb-4 opacity-50"></i>
                <p class="text-lg mb-2">Your cart is empty</p>
                <p class="text-sm">Add some items to get started!</p>
            </div>
        </div>

        <!-- Cart Footer -->
        <div class="border-t p-4 bg-gray-50">
            <div class="flex justify-between items-center mb-4">
                <span class="text-lg font-semibold">Total:</span>
                <span id="cartTotal" class="text-lg font-bold text-green-600">TK 0.00</span>
            </div>
            <button onclick="goToCheckout()" class="w-full  text-white py-3 rounded-lg font-semibold bg-[#1D293D] hover:bg-[#ec4642] transition-colors">
                view cart
            </button>
        </div>
    </div>
</div>

<script>
// Add CSS for smooth cart animations
const cartStyles = `
    <style>
    .cart-item {
        transition: all 0.3s ease;
    }
    .cart-item:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .cart-button {
        transition: all 0.2s ease;
    }
    .cart-button:hover {
        transform: scale(1.05);
    }
    .cart-button:active {
        transform: scale(0.95);
    }
    .quantity-badge {
        transition: all 0.2s ease;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
    }
    .quantity-badge.updating {
        background: #fef3c7;
        border-color: #f59e0b;
        transform: scale(1.1);
    }
    </style>
`;

// Inject styles
if (!document.getElementById('cart-styles')) {
    const styleElement = document.createElement('div');
    styleElement.id = 'cart-styles';
    styleElement.innerHTML = cartStyles;
    document.head.appendChild(styleElement);
}

// New Shopping Cart System - Global scope
let cartData = [];

// Cart functionality - Define as global functions
window.openCart = function() {
    console.log('🛒 openCart() function called');
    
    const cartOverlay = document.getElementById('shoppingCart');
    const cartPanel = document.getElementById('cartPanel');
    
    console.log('🛒 Elements found:', {
        cartOverlay: !!cartOverlay,
        cartPanel: !!cartPanel
    });
    
    if (!cartOverlay || !cartPanel) {
        console.error('❌ Cart elements not found!', {
            cartOverlay: !!cartOverlay,
            cartPanel: !!cartPanel
        });
        return;
    }
    
    loadCartData();
    
    console.log('🛒 Opening cart overlay and panel...');
    cartOverlay.classList.remove('hidden');
    setTimeout(() => {
        cartPanel.classList.remove('translate-x-full');
        console.log('🛒 Cart panel should now be visible');
    }, 10);
};

window.closeCart = function() {
    const cartOverlay = document.getElementById('shoppingCart');
    const cartPanel = document.getElementById('cartPanel');
    
    cartPanel.classList.add('translate-x-full');
    setTimeout(() => {
        cartOverlay.classList.add('hidden');
    }, 300);
};

// Load cart data from server
window.loadCartData = function() {
    fetch("{{ route('cart.index') }}", {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('🛒 Cart data received:', data);
        if (data && data.cart) {
            cartData = data.cart;
            console.log('🛒 Cart items:', cartData);
            // Log first item details for debugging
            if (cartData.length > 0) {
                console.log('🛒 First item structure:', {
                    item: cartData[0],
                    product: cartData[0].product,
                    image: cartData[0].product?.image,
                    name: cartData[0].product?.name
                });
            }
            updateCartDisplay();
        }
    })
    .catch(error => {
        console.error('Error loading cart:', error);
        cartData = [];
        updateCartDisplay();
    });
}

// Update cart display
window.updateCartDisplay = function() {
    console.log('🎨 === UPDATE CART DISPLAY CALLED ===');
    console.log('Current cartData:', cartData);
    
    const cartItems = document.getElementById('cartItems');
    const emptyCart = document.getElementById('emptyCart');
    const cartTotal = document.getElementById('cartTotal');
    const cartCount = document.getElementById('cartCount');
    
    console.log('DOM Elements:', {
        cartItems: !!cartItems,
        emptyCart: !!emptyCart,
        cartTotal: !!cartTotal,
        cartCount: !!cartCount
    });
    
    if (!cartItems) {
        console.error('❌ cartItems element not found!');
        return;
    }
    
    if (cartData.length === 0) {
        emptyCart.style.display = 'block';
        cartTotal.textContent = 'TK 0.00';
        cartCount.textContent = '0';
        return;
    }
    
    emptyCart.style.display = 'none';
    let total = 0;
    let itemCount = 0;
    let cartHTML = '';
    
    cartData.forEach(item => {
        const product = item.product || item;
        const quantity = item.quantity || 1;
        const price = parseFloat(item.price || product.amount || 0);
        const itemTotal = quantity * price;
        
        total += itemTotal;
        itemCount += quantity;
        
        cartHTML += `
            <div class="bg-white rounded-lg p-4 mb-4 shadow-sm border">
                <div class="flex items-center space-x-3">
                    <img src="${product.image ? '/storage/' + product.image : '/images/no-image.png'}" 
                         alt="${product.name}" 
                         class="w-16 h-16 object-cover rounded-lg border border-gray-200"
                         onerror="this.src='/images/no-image.png'">>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-900 text-sm">${product.name}</h4>
                        <p class="text-gray-600 text-xs">${product.category?.name || 'Product'}</p>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center space-x-2">
                                <button onclick="updateCartQuantity(${product.id}, ${quantity - 1})" 
                                        class="w-6 h-6 bg-gray-200 text-gray-700 rounded-full text-xs hover:bg-red-500 hover:text-white transition-colors duration-200 ${quantity <= 1 ? 'opacity-50 cursor-not-allowed' : ''}"
                                        ${quantity <= 1 ? 'disabled' : ''}>-</button>
                                <span class="text-sm font-medium px-2 py-1 bg-gray-50 rounded min-w-[2rem] text-center">${quantity}</span>
                                <button onclick="updateCartQuantity(${product.id}, ${quantity + 1})" 
                                        class="w-6 h-6 bg-gray-200 text-gray-700 rounded-full text-xs hover:bg-green-500 hover:text-white transition-colors duration-200">+</button>
                            </div>
                            <span class="text-green-600 font-semibold text-sm">TK ${itemTotal.toFixed(2)}</span>
                        </div>
                    </div>
                    <button onclick="removeFromCart(${product.id})" 
                            class="text-red-500 hover:text-red-700 text-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
    });
    
    cartItems.innerHTML = cartHTML;
    cartTotal.textContent = `TK ${total.toFixed(2)}`;
    cartCount.textContent = itemCount.toString();
}

// Add to cart function
window.addToCart = function(productId, quantity = 1) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    fetch("{{ route('cart.add') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadCartData(); // Reload cart data
            openCart(); // Show cart
            showNotification('Product added to cart!', 'success');
        } else {
            showNotification(data.message || 'Failed to add product', 'error');
        }
    })
    .catch(error => {
        console.error('Error adding to cart:', error);
        showNotification('Something went wrong!', 'error');
    });
}

// Update cart quantity
window.updateCartQuantity = function(productId, newQuantity) {
    console.log('🛒 === UPDATE CART QUANTITY CALLED ===');
    console.log('Product ID:', productId, 'New Quantity:', newQuantity);
    console.log('Current cartData:', cartData);
    
    if (newQuantity <= 0) {
        console.log('❌ Quantity is 0 or less, calling removeFromCart');
        removeFromCart(productId);
        return;
    }
    
    // 1. IMMEDIATE UI UPDATE - Update local cart data and display
    console.log('🔍 Looking for cart item with product ID:', productId);
    const cartItem = cartData.find(item => {
        const itemProductId = item.product?.id || item.product_id;
        console.log('Checking item:', item, 'Product ID:', itemProductId);
        return itemProductId == productId; // Use == for loose comparison
    });
    
    if (cartItem) {
        console.log('✅ Found cart item:', cartItem);
        const oldQuantity = cartItem.quantity;
        cartItem.quantity = newQuantity;
        console.log('📝 Updated quantity from', oldQuantity, 'to', newQuantity);
        
        console.log('🔄 Calling updateCartDisplay...');
        updateCartDisplay(); // Update UI immediately
        console.log('✅ UI should be updated now');
    } else {
        console.error('❌ Cart item not found for product ID:', productId);
        console.log('Available cart items:');
        cartData.forEach((item, index) => {
            console.log(`Item ${index}:`, {
                product_id: item.product_id,
                productId: item.product?.id,
                quantity: item.quantity,
                product: item.product
            });
        });
    }
    
    // 2. BACKGROUND SERVER UPDATE
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    console.log('🌐 Sending update to server...');
    fetch("{{ route('cart.update') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('✅ Server updated successfully');
            showNotification('Cart updated!', 'success');
        } else {
            console.error('❌ Server update failed, reloading cart');
            showNotification(data.message || 'Failed to update cart', 'error');
            loadCartData(); // Only reload if server update failed
        }
    })
    .catch(error => {
        console.error('❌ Error updating cart:', error);
        showNotification('Update failed, reloading cart', 'error');
        loadCartData(); // Reload on error to ensure consistency
    });
}

// Remove from cart
window.removeFromCart = function(productId) {
    console.log('🛒 Removing product', productId, 'from cart');
    
    // 1. IMMEDIATE UI UPDATE - Remove from local cart data and update display
    const itemIndex = cartData.findIndex(item => (item.product?.id || item.product_id) === productId);
    if (itemIndex !== -1) {
        cartData.splice(itemIndex, 1); // Remove item from local cart
        updateCartDisplay(); // Update UI immediately
        console.log('✅ Item removed from UI immediately');
    }
    
    // 2. BACKGROUND SERVER UPDATE
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    fetch("{{ route('cart.remove') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('✅ Server removal successful');
            showNotification('Item removed from cart', 'success');
        } else {
            console.error('❌ Server removal failed, reloading cart');
            showNotification(data.message || 'Failed to remove item', 'error');
            loadCartData(); // Reload on failure to ensure consistency
        }
    })
    .catch(error => {
        console.error('❌ Error removing from cart:', error);
        showNotification('Removal failed, reloading cart', 'error');
        loadCartData(); // Reload on error to ensure consistency
    });
}

// Go to checkout
window.goToCheckout = function() {
    window.location.href = "{{ route('cart.index') }}";
}

// Show notifications
window.showNotification = function(message, type = 'info') {
    // Use the existing popup system if available
    if (window.showPopupNotification) {
        window.showPopupNotification(message, type);
    } else {
        // Simple fallback notification
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg text-white z-50 ${type === 'error' ? 'bg-red-500' : 'bg-green-500'}`;
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
}

// Close cart when clicking outside
document.addEventListener('click', function(e) {
    const cartOverlay = document.getElementById('shoppingCart');
    if (e.target === cartOverlay) {
        closeCart();
    }
});

// Attach cart button click event after DOM loads
document.addEventListener('DOMContentLoaded', function() {
    console.log('🛒 Setting up cart button event listener...');
    const cartToggle = document.getElementById('cartToggle');
    if (cartToggle) {
        cartToggle.addEventListener('click', function() {
            console.log('🛒 Cart button clicked!');
            openCart();
        });
        console.log('✅ Cart button event listener attached');
    } else {
        console.error('❌ Cart button not found!');
    }
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('=== CART INITIALIZATION ===');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const cartOffcanvas = document.getElementById('cartOffcanvas');
        const cartItemsContainer = document.getElementById('cartItemsContainer');
        const cartCountEl = document.getElementById('cartCount');
        const cartSubtotalEl = document.getElementById('cartSubtotal');

        console.log('CSRF Token:', csrfToken ? 'Found' : 'NOT FOUND');
        console.log('cartOffcanvas:', cartOffcanvas ? 'Found' : 'NOT FOUND');
        console.log('cartItemsContainer:', cartItemsContainer ? 'Found' : 'NOT FOUND');
        console.log('cartCountEl:', cartCountEl ? 'Found' : 'NOT FOUND');
        console.log('cartSubtotalEl:', cartSubtotalEl ? 'Found' : 'NOT FOUND');
        console.log('==============================');

        if (!cartItemsContainer) {
            console.error('CRITICAL: cartItemsContainer not found!');
            return;
        }

        if (!cartOffcanvas) {
            console.error('CRITICAL: cartOffcanvas not found!');
            return;
        }

        // Render cart items + subtotal + badge
        window.renderCart = function(cart) {
            console.log('🛒 renderCart called with:', cart);
            console.log('🛒 Cart type:', typeof cart, 'Array:', Array.isArray(cart), 'Length:', cart ? cart.length : 'N/A');
            
            if (!cartItemsContainer) {
                console.error('❌ cartItemsContainer not found!');
                return;
            }
            
            cartItemsContainer.innerHTML = '';
            let subtotal = 0;
            let totalCount = 0;

            if (!cart || cart.length === 0) {
                console.log('🛒 Cart is empty, showing empty state');
                cartItemsContainer.innerHTML = `
                    <div class="text-center py-16 text-gray-400">
                        <div class="mb-4">
                            <i class="fas fa-shopping-cart text-6xl opacity-30"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-600 mb-2">Your cart is empty</h3>
                        <p class="text-sm text-gray-500">Add some amazing products to get started!</p>
                        <button onclick="document.getElementById('cartOffcanvas').classList.add('translate-x-full')" 
                                class="mt-4 px-6 py-2 bg-[#1D293D] hover:bg-[#ec4642] text-white rounded-full text-sm hover:shadow-lg transition-all duration-300">
                            Continue Shopping
                        </button>
                    </div>
                `;
                if (cartSubtotalEl) cartSubtotalEl.innerText = `TK 0.00`;
                if (cartCountEl) cartCountEl.innerText = '0';
                return;
            }

            console.log('🛒 Processing', cart.length, 'cart items');
            cart.forEach((item, index) => {
                console.log(`🛒 Item ${index}:`, item);
                
                // Handle different cart data structures (session vs database)
                const product = item.product || item;
                const quantity = item.quantity || 1;
                const price = item.price || product.amount || 0;
                const lineTotal = quantity * parseFloat(price);
                
                console.log('🛒 Processed:', { product_name: product.name, quantity, price });
                
                subtotal += lineTotal;
                totalCount += quantity;

                const div = document.createElement('div');
                div.className = 'bg-white rounded-xl p-4 mb-3 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-[#ec4642]/20';
                div.innerHTML = `
                    <div class="flex items-start gap-3">
                        <!-- Product Image -->
                        <div class="flex-shrink-0">
                            <img src="${product.image ? '/storage/' + product.image : 'https://via.placeholder.com/64x64/f8fafc/64748b?text=No+Image'}" 
                                 alt="${product.name}" 
                                 class="w-16 h-16 object-cover rounded-lg border">
                        </div>
                        
                        <!-- Product Details -->
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-semibold text-[#1D293D] text-sm leading-tight truncate pr-2">${product.name}</h4>
                                <button onclick="removeFromCart(${product.id || item.product_id})" 
                                        class="text-red-400 hover:text-red-600 transition-colors p-1">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                            
                            <div class="text-xs text-gray-500 mb-2">${product.category || 'Electronics'}</div>
                            
                            <div class="flex justify-between items-center">
                                <div class="text-[#ec4642] font-bold text-sm">TK ${parseFloat(price).toFixed(2)}</div>
                                <div class="text-[#1D293D] font-bold text-sm">TK ${lineTotal.toFixed(2)}</div>
                            </div>
                            
                            <!-- Quantity Controls -->
                            <div class="flex items-center justify-between mt-3">
                                <div class="flex items-center gap-2">
                                    <button onclick="updateCartQuantity(${product.id || item.product_id}, ${quantity - 1})" 
                                            class="w-7 h-7 flex items-center justify-center bg-gray-100 hover:bg-[#ec4642] hover:text-white text-[#1D293D] rounded transition-all duration-200 text-xs"
                                            ${quantity <= 1 ? 'disabled' : ''}>
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <span class="px-3 py-1 border rounded text-xs font-semibold min-w-[2rem] text-center">${quantity}</span>
                                    <button onclick="updateCartQuantity(${product.id || item.product_id}, ${quantity + 1})" 
                                            class="w-7 h-7 flex items-center justify-center bg-gray-100 hover:bg-[#ec4642] hover:text-white text-[#1D293D] rounded transition-all duration-200 text-xs">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <button onclick="removeFromCart(${product.id || item.product_id})" 
                                        class="text-[#ec4642] text-xs hover:underline">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                
                cartItemsContainer.appendChild(div);
            });

            console.log('🛒 Cart rendered:', totalCount, 'items, TK', subtotal.toFixed(2));
            if (cartSubtotalEl) cartSubtotalEl.innerText = `TK ${subtotal.toFixed(2)}`;
            if (cartCountEl) cartCountEl.innerText = totalCount;
        }

        // Add to cart
        // Cart Success Popup Function
        window.showCartPopup = function(message, type = 'success') {
            // Use the global popup notification system
            if (window.showPopupNotification) {
                window.showPopupNotification(message, type);
            } else {
                // Fallback to console log if popup system not loaded
                console.log('Cart:', message);
            }
        }

        window.addToCart = function(productId, quantity = 1) {
            console.log('=== ADD TO CART CALLED ===');
            console.log('Product ID:', productId, 'Quantity:', quantity);
            
            // Check if quantity is being specified from a modal
            const quantityInput = document.getElementById('quantity');
            const modal = document.getElementById('quickViewModal');
            
            if (quantityInput && modal && modal.style.display !== 'none') {
                quantity = parseInt(quantityInput.value) || 1;
                console.log('Quantity from modal:', quantity);
            }
            
            console.log('Sending request to cart.add...');
            fetch("{{ route('cart.add') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                })
                .then(res => {
                    console.log('Response status:', res.status);
                    return res.json();
                })
                .then(data => {
                    console.log('🛒 Add to cart response:', data);
                    
                    if (data.success) {
                        console.log('🛒 Product added successfully');
                        
                        // Always refresh cart from server after adding item
                        loadCartFromServer().then(() => {
                            console.log('🛒 Cart refreshed, opening offcanvas');
                            // Show offcanvas after cart is loaded
                            if (cartOffcanvas) {
                                cartOffcanvas.classList.remove('translate-x-full');
                            } else {
                                console.error('❌ cartOffcanvas element not found!');
                            }
                        });
                        
                        // Show success popup
                        showCartPopup('Successfully added item to cart!', 'success');
                        
                        // Close modal if it's open
                        if (modal && modal.style.display !== 'none' && typeof closeQuickView === 'function') {
                            closeQuickView();
                        }
                    } else {
                        console.error('❌ Add to cart failed:', data);
                        showCartPopup(data.message || 'Failed to add product', 'error');
                    }
                })
                .catch(error => {
                    console.error('Cart error:', error);
                    showCartPopup('Something went wrong. Please try again.', 'error');
                });
        }

        // OLD updateCart function - REPLACED by instant updateCartQuantity function above
        // Commenting out to prevent conflicts with the new instant update system
        /*
        window.updateCart = function(productId, quantity) {
            if (quantity < 1) return removeCart(productId);
            // ... old code that causes page reloads
        }
        */

        // Remove item
        window.removeCart = function(productId) {
            fetch("{{ route('cart.remove') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        console.log('🛒 Item removed successfully');
                        loadCartFromServer(); // Refresh cart display
                        showCartPopup('Item removed from cart!', 'success');
                    } else {
                        showCartPopup(data.message || 'Failed to remove item', 'error');
                    }
                })
                .catch(error => {
                    console.error('Remove cart error:', error);
                    showCartPopup('Something went wrong. Please try again.', 'error');
                });
        }

        // Open Cart Offcanvas Function
        window.openCartOffcanvas = function() {
            console.log('🛒 Opening cart offcanvas...');
            
            // Load fresh cart data when opening
            loadCartFromServer().then(() => {
                console.log('🛒 Cart loaded, opening offcanvas');
                if (cartOffcanvas) {
                    cartOffcanvas.classList.remove('translate-x-full');
                } else {
                    console.error('❌ cartOffcanvas element not found!');
                }
            }).catch(error => {
                console.error('❌ Failed to load cart:', error);
                // Still open the offcanvas even if loading fails
                if (cartOffcanvas) {
                    cartOffcanvas.classList.remove('translate-x-full');
                }
            });
        }

        // Cart toggle button - refresh cart when opening
        // (Event listener is now handled above in the initialization section)

        // Close button
        document.querySelector('#cartOffcanvas button[text="✕"]').addEventListener('click', function() {
            cartOffcanvas.classList.add('translate-x-full');
        });

        // Initial load: fetch cart
        console.log('🛒 Loading initial cart data...');
        
        // Function to load cart from server - Simplified and More Reliable
        function loadCartFromServer() {
            console.log('🛒 Loading cart from server...');
            
            // Show a simple loading indicator
            cartItemsContainer.innerHTML = `
                <div class="text-center py-8 text-gray-400" id="tempLoadingState">
                    <i class="fas fa-spinner fa-spin text-2xl text-[#1D293D] mb-2"></i>
                    <p class="text-sm">Loading...</p>
                </div>
            `;
            
            return fetch("{{ route('cart.index') }}", {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('🛒 Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('🛒 Response data:', data);
                
                // Always clear the container first
                cartItemsContainer.innerHTML = '';
                
                // Check if we have cart data
                if (data && data.cart && Array.isArray(data.cart) && data.cart.length > 0) {
                    console.log('🛒 Found', data.cart.length, 'cart items - rendering...');
                    renderCart(data.cart);
                } else {
                    console.log('🛒 No cart items found - showing empty state');
                    renderCart([]);
                }
                
                return data; // Return data for promise chain
            })
            .catch(error => {
                console.error('❌ Cart loading error:', error);
                cartItemsContainer.innerHTML = '';
                renderCart([]);
                throw error; // Re-throw for promise chain
            });
        }
        
        // Load cart immediately when page loads
        console.log('🛒 Initializing cart...');
        
        // Load cart data
        loadCartFromServer();
        
        // Make refresh function available globally
        window.refreshCart = loadCartFromServer;
        
        // Also load cart when offcanvas is opened
        document.getElementById('cartToggle').addEventListener('click', function() {
            console.log('🛒 Cart opened - refreshing...');
            loadCartFromServer();
        });
        
        // Debug function to test cart rendering (can be called from browser console)
        window.testCartRender = function() {
            console.log('🛒 Testing cart rendering...');
            console.log('Elements:', {
                cartItemsContainer: !!cartItemsContainer,
                cartOffcanvas: !!cartOffcanvas,
                cartCountEl: !!cartCountEl,
                cartSubtotalEl: !!cartSubtotalEl
            });
            loadCartFromServer();
        }
        
        // QUICK TEST FUNCTIONS FOR DEBUGGING
        window.testCartSystem = function() {
            console.log('=== TESTING CART SYSTEM ===');
            console.log('1. Testing openCartOffcanvas()...');
            openCartOffcanvas();
            
            setTimeout(() => {
                console.log('2. Testing addToCart() with product ID 1...');
                addToCart(1);
                
                setTimeout(() => {
                    console.log('3. Opening cart again to see results...');
                    openCartOffcanvas();
                }, 2000);
            }, 2000);
        }
        
        // Quick Add to Cart Test
        window.quickAddTest = function(productId = 1) {
            console.log('🛒 Quick test: Adding product', productId, 'to cart');
            addToCart(productId);
        }
            });
            
            const testCart = [
                {
                    product_id: 1,
                    product: {
                        id: 1,
                        name: 'Test Product',
                        image: 'test-product.jpg',
                        amount: 99.99
                    },
                    quantity: 2,
                    price: 99.99
                }
            ];
            console.log('🛒 Test cart data:', testCart);
            renderCart(testCart);
            if (cartOffcanvas) {
                cartOffcanvas.classList.remove('translate-x-full');
            }
        };
        
        // Manual test for adding to cart (use a known product ID)
        window.testAddToCart = function(productId = 1) {
            console.log('🛒 Testing add to cart with product ID:', productId);
            addToCart(productId, 1);
        };
        
        // Debug function to manually refresh cart
        window.debugRefreshCart = function() {
            console.log('🛒 Debug: Manually refreshing cart...');
            if (window.refreshCart) {
                window.refreshCart();
            } else {
                console.error('❌ refreshCart function not available');
            }
        };
        
        // ENHANCED DEBUG FUNCTIONS
        
        // Check current cart state
        window.checkCartState = function() {
            console.log('=== CART STATE DEBUG ===');
            console.log('cartItemsContainer:', !!cartItemsContainer);
            console.log('cartOffcanvas:', !!cartOffcanvas);
            console.log('cartCountEl:', !!cartCountEl);
            console.log('cartSubtotalEl:', !!cartSubtotalEl);
            console.log('Container HTML length:', cartItemsContainer?.innerHTML?.length || 0);
            console.log('Current cart HTML preview:', (cartItemsContainer?.innerHTML || '').substring(0, 200));
            console.log('========================');
        };
        
        // Force show test cart with real-looking data
        window.showTestCart = function() {
            console.log('🛒 Showing test cart...');
            const testCart = [
                {
                    product_id: 1,
                    product: {
                        id: 1,
                        name: 'Samsung Galaxy S21',
                        image: 'samsung-s21.jpg',
                        amount: 699.99,
                        category: 'Electronics'
                    },
                    quantity: 1,
                    price: 699.99
                },
                {
                    product_id: 2,
                    product: {
                        id: 2,
                        name: 'Nike Air Max 90',
                        image: 'nike-airmax.jpg',
                        amount: 120.00,
                        category: 'Fashion'
                    },
                    quantity: 2,
                    price: 120.00
                }
            ];
            
            cartItemsContainer.innerHTML = '';
            renderCart(testCart);
            
            // Open cart to show results
            cartOffcanvas.classList.remove('translate-x-full');
            
            console.log('✅ Test cart displayed');
            return 'Test cart with 2 items displayed';
        };
        
        // Test the actual API endpoint
        window.testAPI = function() {
            console.log('🛒 Testing API endpoint...');
            fetch("{{ route('cart.index') }}", {
                method: 'GET',
                headers: { 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                console.log('🛒 API Response:', data);
                return data;
            })
            .catch(err => {
                console.error('❌ API Error:', err);
                return err;
            });
        };
        
        // Force refresh cart
        window.forceRefresh = function() {
            console.log('🛒 Force refreshing cart...');
            loadCartFromServer();
            return 'Cart refresh initiated';
        };
        
        // Test adding product and showing cart
        window.testAddAndShowCart = function(productId = 1) {
            console.log('🛒 Testing add to cart and show offcanvas...');
            addToCart(productId, 1);
            return 'Add to cart initiated';
        };
        
        // Manual test for adding to cart (use a known product ID)
        window.testAddToCart = function() {
            console.log('Testing add to cart with product ID 1...');
            addToCart(1, 1);
        };
        
        // Force render a test cart to verify display works
        window.forceTestCart = function() {
            console.log('Force testing cart display...');
            if (!cartItemsContainer) {
                console.error('cartItemsContainer not found!');
                return;
            }
            
            // Manually create a cart item
            cartItemsContainer.innerHTML = `
                <div class="group bg-white rounded-xl p-6 mb-4 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-[#ec4642]/20">
                    <div class="flex items-center space-x-4">
                        <div class="relative overflow-hidden rounded-lg">
                            <img src="https://via.placeholder.com/80x80/f8fafc/64748b?text=Test" class="w-20 h-20 object-cover rounded-lg">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-[#1D293D] text-base">Test Product</h4>
                            <p class="text-[#ec4642] font-bold text-base">TK 99.99</p>
                            <div class="flex items-center space-x-3">
                                <span class="bg-gradient-to-r from-[#1D293D] to-[#ec4642] text-white px-4 py-2 rounded-full text-sm font-bold">1</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Update totals
            if (cartSubtotalEl) cartSubtotalEl.innerText = 'TK 99.99';
            if (cartCountEl) cartCountEl.innerText = '1';
            
            // Open cart
            if (cartOffcanvas) {
                cartOffcanvas.classList.remove('translate-x-full');
                console.log('Cart offcanvas opened with test data');
            }
        };
    });
</script>

<!-- Wishlist Functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('=== WISHLIST INITIALIZATION ===');
        const wishlistToggle = document.getElementById('wishlistToggle');
        const wishlistDropdown = document.getElementById('wishlistDropdown');
        const wishlistItemsContainer = document.getElementById('wishlistItemsContainer');
        const wishlistCountEl = document.getElementById('wishlistCount');
        const wishlistSubtitle = document.getElementById('wishlistSubtitle');

        console.log('Wishlist elements:', {
            toggle: !!wishlistToggle,
            dropdown: !!wishlistDropdown,
            container: !!wishlistItemsContainer,
            count: !!wishlistCountEl
        });

        // Wishlist data stored in localStorage
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

        // Show wishlist popup notification
        window.showWishlistPopup = function(message, type = 'success') {
            // Use the global popup notification system
            if (window.showPopupNotification) {
                window.showPopupNotification(message, type);
            } else {
                // Fallback to console log if popup system not loaded
                console.log('Wishlist:', message);
            }
        };

        // Render wishlist items
        window.renderWishlist = function() {
            if (!wishlistItemsContainer) return;

            wishlistItemsContainer.innerHTML = '';
            
            if (wishlist.length === 0) {
                wishlistItemsContainer.innerHTML = `
                    <div class="text-center py-8 text-gray-400">
                        <div class="mb-3">
                            <i class="fas fa-heart text-4xl opacity-30"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-600 mb-1">Your wishlist is empty</h3>
                        <p class="text-sm text-gray-500">Start adding items you love!</p>
                    </div>
                `;
                if (wishlistCountEl) wishlistCountEl.textContent = '0';
                if (wishlistSubtitle) wishlistSubtitle.textContent = 'Your favorite items';
                return;
            }

            wishlist.forEach(item => {
                const div = document.createElement('div');
                div.className = 'flex items-center space-x-3 p-4 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-b-0';
                div.innerHTML = `
                    <div class="flex-shrink-0">
                        <img src="${item.image}" alt="${item.name}" class="w-12 h-12 object-cover rounded-lg">
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-semibold text-gray-900 truncate">${item.name}</h4>
                        <p class="text-xs text-gray-600">${item.category}</p>
                        <p class="text-sm font-bold text-red-600">${item.price}</p>
                    </div>
                    <div class="flex-shrink-0 flex space-x-1">
                        <button onclick="addToCart('${item.id}')" class="w-8 h-8 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center transition-colors" title="Add to Cart">
                            <i class="fas fa-shopping-cart text-xs"></i>
                        </button>
                        <button onclick="removeFromWishlist('${item.id}')" class="w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center transition-colors" title="Remove">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                    </div>
                `;
                wishlistItemsContainer.appendChild(div);
            });

            if (wishlistCountEl) wishlistCountEl.textContent = wishlist.length;
            if (wishlistSubtitle) wishlistSubtitle.textContent = `${wishlist.length} item${wishlist.length !== 1 ? 's' : ''} saved`;
        };

        // Add to wishlist
        window.addToWishlist = function(productId, productData = null) {
            console.log('Adding to wishlist:', productId);
            
            // Check if already in wishlist
            const existingIndex = wishlist.findIndex(item => item.id == productId);
            if (existingIndex !== -1) {
                // Item already in wishlist - remove it
                removeFromWishlist(productId);
                return;
            }

            // If productData is provided, use it; otherwise extract from DOM
            let itemData = productData;
            if (!itemData) {
                const productCard = document.querySelector(`[data-product="${productId}"]`);
                if (productCard) {
                    const image = productCard.querySelector('img').src;
                    const name = productCard.querySelector('h3').textContent.trim();
                    const priceElement = productCard.querySelector('.text-xl.font-black');
                    const price = priceElement ? priceElement.textContent : 'TK 0';
                    const category = productCard.getAttribute('data-category') || 'Electronics';
                    
                    itemData = { id: productId, name, image, price, category };
                } else {
                    console.error('Product card not found for ID:', productId);
                    return;
                }
            }

            wishlist.push(itemData);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            renderWishlist();
            updateWishlistButtonState(productId, true);
            showWishlistPopup(`${itemData.name} added to wishlist!`, 'success');
        };

        // Remove from wishlist
        window.removeFromWishlist = function(productId) {
            const index = wishlist.findIndex(item => item.id == productId);
            if (index !== -1) {
                const removedItem = wishlist.splice(index, 1)[0];
                localStorage.setItem('wishlist', JSON.stringify(wishlist));
                renderWishlist();
                updateWishlistButtonState(productId, false);
                showWishlistPopup(`${removedItem.name} removed from wishlist!`, 'success');
            }
        };

        // Update wishlist button state
        window.updateWishlistButtonState = function(productId, isInWishlist) {
            const button = document.querySelector(`.wishlist-btn[data-product-id="${productId}"]`);
            if (button) {
                const icon = button.querySelector('.wishlist-icon');
                if (isInWishlist) {
                    button.classList.add('added');
                    if (icon) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                    }
                    button.title = 'Remove from Wishlist';
                } else {
                    button.classList.remove('added');
                    if (icon) {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                    }
                    button.title = 'Add to Wishlist';
                }
            }
        };

        // Toggle wishlist dropdown
        if (wishlistToggle && wishlistDropdown) {
            wishlistToggle.onclick = function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const isHidden = wishlistDropdown.style.display === 'none' || 
                               wishlistDropdown.style.display === '' || 
                               window.getComputedStyle(wishlistDropdown).display === 'none';
                
                if (isHidden) {
                    wishlistDropdown.style.display = 'block';
                    wishlistDropdown.style.visibility = 'visible';
                } else {
                    wishlistDropdown.style.display = 'none';
                    wishlistDropdown.style.visibility = 'hidden';
                }
            };

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (wishlistDropdown && wishlistToggle) {
                    if (!wishlistToggle.contains(e.target) && !wishlistDropdown.contains(e.target)) {
                        wishlistDropdown.style.display = 'none';
                        wishlistDropdown.style.visibility = 'hidden';
                    }
                }
            });
        }

        // Initialize wishlist on page load
        renderWishlist();
        console.log('Wishlist initialized with', wishlist.length, 'items');
    });
</script>












<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Login Modal
        const loginBtn = document.getElementById('loginBtn');
        const loginModal = document.getElementById('loginModal');
        const closeLoginModal = document.getElementById('closeLoginModal');

        // REMOVED: Modal event listener - now using direct route redirect
        /*
        if (loginBtn && loginModal && closeLoginModal) {
            loginBtn.addEventListener('click', function(e) {
                e.preventDefault();
                loginModal.classList.remove('hidden');
                if (userDropdown) userDropdown.classList.add('hidden');
            });

            closeLoginModal.addEventListener('click', function() {
                loginModal.classList.add('hidden');
            });
        }
        */

        // Signup Modal
        const signupBtn = document.getElementById('signupBtn');
        const signupModal = document.getElementById('signupModal');
        const closeSignupModal = document.getElementById('closeSignupModal');

        // REMOVED: Modal event listener - now using direct route redirect
        /*
        if (signupBtn && signupModal && closeSignupModal) {
            signupBtn.addEventListener('click', function(e) {
                e.preventDefault();
                signupModal.classList.remove('hidden');
                if (userDropdown) userDropdown.classList.add('hidden');
            });

            closeSignupModal.addEventListener('click', function() {
                signupModal.classList.add('hidden');
            });
        }
        */

        // Switch between Login and Signup
        const switchToSignup = document.getElementById('switchToSignup');
        const switchToLogin = document.getElementById('switchToLogin');

        if (switchToSignup && switchToLogin && loginModal && signupModal) {
            switchToSignup.addEventListener('click', function(e) {
                e.preventDefault();
                loginModal.classList.add('hidden');
                signupModal.classList.remove('hidden');
            });

            switchToLogin.addEventListener('click', function(e) {
                e.preventDefault();
                signupModal.classList.add('hidden');
                loginModal.classList.remove('hidden');
            });
        }

        // Cart Offcanvas
        const cartToggle = document.getElementById('cartToggle');
        const cartOffcanvas = document.getElementById('cartOffcanvas');
        const closeCartOffcanvas = document.getElementById('closeCartOffcanvas');

        if (cartToggle && cartOffcanvas) {
            cartToggle.addEventListener('click', function() {
                cartOffcanvas.classList.remove('translate-x-full');
            });
        }

        if (closeCartOffcanvas && cartOffcanvas) {
            closeCartOffcanvas.addEventListener('click', function() {
                cartOffcanvas.classList.add('translate-x-full');
            });
        }

        // Close modals when clicking outside
        if (loginModal) {
            loginModal.addEventListener('click', function(e) {
                if (e.target === loginModal) {
                    loginModal.classList.add('hidden');
                }
            });
        }

        if (signupModal) {
            signupModal.addEventListener('click', function(e) {
                if (e.target === signupModal) {
                    signupModal.classList.add('hidden');
                }
            });
        }
        
        // Mobile Menu
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        
        if (mobileMenuToggle && mobileMenu) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenu.classList.remove('-translate-x-full');
            });
        }
        
        if (closeMobileMenu && mobileMenu) {
            closeMobileMenu.addEventListener('click', function() {
                mobileMenu.classList.add('-translate-x-full');
            });
        }
    });
</script>



<!-- ✅ Modal Toggle Script -->
<script>
    const loginModal = document.getElementById('loginModal');
    const signupModal = document.getElementById('signupModal');

    document.getElementById('switchToSignup').addEventListener('click', (e) => {
        e.preventDefault();
        loginModal.classList.add('hidden');
        signupModal.classList.remove('hidden');
    });

    document.getElementById('switchToLogin').addEventListener('click', (e) => {
        e.preventDefault();
        signupModal.classList.add('hidden');
        loginModal.classList.remove('hidden');
    });

    document.getElementById('closeLoginModal').addEventListener('click', () => loginModal.classList.add('hidden'));
    document.getElementById('closeSignupModal').addEventListener('click', () => signupModal.classList.add('hidden'));
</script>




<!-- Scripts -->
<script>
    // Use the existing window.addToCart function instead of this duplicate

    // Modal Password Validation
    document.addEventListener('DOMContentLoaded', function() {
        const modalPasswordInput = document.getElementById('signupPassword');
        if (modalPasswordInput) {
            modalPasswordInput.addEventListener('input', function() {
                const password = this.value;

                // Check length
                const lengthCheck = document.getElementById('modal-length-check');
                if (password.length >= 8) {
                    lengthCheck.innerHTML = '<span class="mr-1">✅</span> 8+ characters';
                    lengthCheck.classList.remove('text-red-600');
                    lengthCheck.classList.add('text-green-600');
                } else {
                    lengthCheck.innerHTML = '<span class="mr-1">❌</span> 8+ characters';
                    lengthCheck.classList.remove('text-green-600');
                    lengthCheck.classList.add('text-red-600');
                }

                // Check uppercase
                const uppercaseCheck = document.getElementById('modal-uppercase-check');
                if (/[A-Z]/.test(password)) {
                    uppercaseCheck.innerHTML = '<span class="mr-1">✅</span> Uppercase (A-Z)';
                    uppercaseCheck.classList.remove('text-red-600');
                    uppercaseCheck.classList.add('text-green-600');
                } else {
                    uppercaseCheck.innerHTML = '<span class="mr-1">❌</span> Uppercase (A-Z)';
                    uppercaseCheck.classList.remove('text-green-600');
                    uppercaseCheck.classList.add('text-red-600');
                }

                // Check lowercase
                const lowercaseCheck = document.getElementById('modal-lowercase-check');
                if (/[a-z]/.test(password)) {
                    lowercaseCheck.innerHTML = '<span class="mr-1">✅</span> Lowercase (a-z)';
                    lowercaseCheck.classList.remove('text-red-600');
                    lowercaseCheck.classList.add('text-green-600');
                } else {
                    lowercaseCheck.innerHTML = '<span class="mr-1">❌</span> Lowercase (a-z)';
                    lowercaseCheck.classList.remove('text-green-600');
                    lowercaseCheck.classList.add('text-red-600');
                }

                // Check number
                const numberCheck = document.getElementById('modal-number-check');
                if (/[0-9]/.test(password)) {
                    numberCheck.innerHTML = '<span class="mr-1">✅</span> Number (0-9)';
                    numberCheck.classList.remove('text-red-600');
                    numberCheck.classList.add('text-green-600');
                } else {
                    numberCheck.innerHTML = '<span class="mr-1">❌</span> Number (0-9)';
                    numberCheck.classList.remove('text-green-600');
                    numberCheck.classList.add('text-red-600');
                }

                // Check special character
                const specialCheck = document.getElementById('modal-special-check');
                if (/[@$!%*#?&]/.test(password)) {
                    specialCheck.innerHTML = '<span class="mr-1">✅</span> Special (@$!%*#?&)';
                    specialCheck.classList.remove('text-red-600');
                    specialCheck.classList.add('text-green-600');
                } else {
                    specialCheck.innerHTML = '<span class="mr-1">❌</span> Special (@$!%*#?&)';
                    specialCheck.classList.remove('text-green-600');
                    specialCheck.classList.add('text-red-600');
                }
            });
        }

        // Modal Password toggle functionality
        const toggleSignupPassword = document.getElementById('toggleSignupPassword');
        const signupPasswordField = document.getElementById('signupPassword');
        const signupEyeIcon = document.getElementById('signupEyeIcon');

        if (toggleSignupPassword) {
            toggleSignupPassword.addEventListener('click', function() {
                if (signupPasswordField.type === 'password') {
                    signupPasswordField.type = 'text';
                    signupEyeIcon.classList.remove('fa-eye');
                    signupEyeIcon.classList.add('fa-eye-slash');
                } else {
                    signupPasswordField.type = 'password';
                    signupEyeIcon.classList.remove('fa-eye-slash');
                    signupEyeIcon.classList.add('fa-eye');
                }
            });
        }

        // Modal Confirm password toggle functionality
        const toggleSignupPasswordConfirm = document.getElementById('toggleSignupPasswordConfirm');
        const signupPasswordConfirmField = document.getElementById('password_confirmation');
        const signupEyeIconConfirm = document.getElementById('signupEyeIconConfirm');

        if (toggleSignupPasswordConfirm) {
            toggleSignupPasswordConfirm.addEventListener('click', function() {
                if (signupPasswordConfirmField.type === 'password') {
                    signupPasswordConfirmField.type = 'text';
                    signupEyeIconConfirm.classList.remove('fa-eye');
                    signupEyeIconConfirm.classList.add('fa-eye-slash');
                } else {
                    signupPasswordConfirmField.type = 'password';
                    signupEyeIconConfirm.classList.remove('fa-eye-slash');
                    signupEyeIconConfirm.classList.add('fa-eye');
                }
            });
        }
    });
</script>

<!-- Enhanced Search Functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const searchSuggestions = document.getElementById('searchSuggestions');
        const mobileSearchInput = document.querySelector('input[name="query"]');
        
        // Search suggestions for desktop
        if (searchInput && searchSuggestions) {
            let searchTimeout;
            
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                
                // Clear previous timeout
                if (searchTimeout) {
                    clearTimeout(searchTimeout);
                }
                
                if (query.length >= 2) {
                    // Show loading state
                    searchSuggestions.innerHTML = `
                        <div class="p-4 text-center">
                            <i class="fas fa-spinner fa-spin text-gray-400"></i>
                            <span class="ml-2 text-gray-600">Searching...</span>
                        </div>
                    `;
                    searchSuggestions.classList.remove('hidden');
                    
                    // Debounce search requests
                    searchTimeout = setTimeout(() => {
                        fetchSearchSuggestions(query);
                    }, 300);
                } else {
                    if (searchSuggestions) {
                        searchSuggestions.classList.add('hidden');
                    }
                }
            });
            
            // Hide suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (searchSuggestions && !searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
                    searchSuggestions.classList.add('hidden');
                }
            });
            
            // Handle keyboard navigation
            searchInput.addEventListener('keydown', function(e) {
                const suggestions = searchSuggestions.querySelectorAll('.suggestion-item');
                const activeSuggestion = searchSuggestions.querySelector('.suggestion-item.active');
                
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    if (activeSuggestion) {
                        activeSuggestion.classList.remove('active');
                        const next = activeSuggestion.nextElementSibling;
                        if (next && next.classList.contains('suggestion-item')) {
                            next.classList.add('active');
                        } else {
                            suggestions[0]?.classList.add('active');
                        }
                    } else {
                        suggestions[0]?.classList.add('active');
                    }
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    if (activeSuggestion) {
                        activeSuggestion.classList.remove('active');
                        const prev = activeSuggestion.previousElementSibling;
                        if (prev && prev.classList.contains('suggestion-item')) {
                            prev.classList.add('active');
                        } else {
                            suggestions[suggestions.length - 1]?.classList.add('active');
                        }
                    }
                } else if (e.key === 'Enter') {
                    if (activeSuggestion) {
                        e.preventDefault();
                        activeSuggestion.click();
                    }
                } else if (e.key === 'Escape') {
                    if (searchSuggestions) {
                        searchSuggestions.classList.add('hidden');
                    }
                }
            });
        }
        
        // Enhanced mobile search
        if (mobileSearchInput) {
            mobileSearchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const query = this.value.trim();
                    if (!query) {
                        e.preventDefault();
                        alert('Please enter a search term');
                    }
                }
            });
        }
    });
    
    // Fetch search suggestions
    function fetchSearchSuggestions(query) {
        const searchSuggestions = document.getElementById('searchSuggestions');
        
        if (!searchSuggestions) {
            console.error('Search suggestions container not found');
            return;
        }
        
        // Updated suggestions based on actual categories and products
        const smartSuggestions = [
            'Books',      // Will find Fiction, History, Non-Fiction, Science
            'Electronics', // Will find Laptops
            'Fashion',    // Will find Women, Men, Kids
            'Beauty',     // Will find Makeup
            'Sports',     // Will find Football, Basketball
            'Home',       // Will find Indoor Plants, Garden Tools, Home Decor, Outdoor, Furnitures
            'Garden',     // Will find garden-related items
            'Fiction',    // Direct category match
            'History',    // Direct category match
            'Science',    // Direct category match
            'Laptops',    // Direct category match
            'Makeup',     // Direct category match
            'Football',   // Direct category match
            'Basketball', // Direct category match
        ];
        
        const filteredSuggestions = smartSuggestions.filter(item => 
            item.toLowerCase().includes(query.toLowerCase())
        );
        
        if (filteredSuggestions.length > 0) {
            let suggestionsHTML = '';
            filteredSuggestions.forEach(suggestion => {
                const highlightedSuggestion = suggestion.replace(
                    new RegExp(query, 'gi'),
                    `<mark class="bg-yellow-200 px-1 rounded">$&</mark>`
                );
                suggestionsHTML += `
                    <div class="suggestion-item p-3 hover:bg-gray-50 cursor-pointer flex items-center space-x-3 border-b border-gray-100 last:border-b-0" 
                         onclick="selectSuggestion('${suggestion}')">
                        <i class="fas fa-search text-gray-400"></i>
                        <span>${highlightedSuggestion}</span>
                    </div>
                `;
            });
            
            suggestionsHTML += `
                <div class="p-3 bg-gray-50 border-t border-gray-200">
                    <button onclick="searchFor('${query}')" 
                            class="text-primary-600 hover:text-primary-700 font-medium text-sm">
                        <i class="fas fa-arrow-right mr-2"></i>Search for "${query}"
                    </button>
                </div>
            `;
            
            searchSuggestions.innerHTML = suggestionsHTML;
        } else {
            searchSuggestions.innerHTML = `
                <div class="p-4 text-center text-gray-600">
                    <i class="fas fa-search text-gray-400 mb-2"></i>
                    <p>No suggestions found</p>
                    <button onclick="searchFor('${query}')" 
                            class="mt-2 text-primary-600 hover:text-primary-700 font-medium text-sm">
                        Search anyway
                    </button>
                </div>
            `;
        }
        
        searchSuggestions.classList.remove('hidden');
    }
    
    // Select a suggestion
    function selectSuggestion(suggestion) {
        const searchInput = document.getElementById('searchInput');
        const searchSuggestions = document.getElementById('searchSuggestions');
        
        if (searchInput && searchSuggestions) {
            searchInput.value = suggestion;
            searchSuggestions.classList.add('hidden');
            searchInput.form.submit();
        }
    }
    
    // Search for a specific term
    function searchFor(query) {
        const searchInput = document.getElementById('searchInput');
        const searchSuggestions = document.getElementById('searchSuggestions');
        
        if (searchInput && searchSuggestions) {
            searchInput.value = query;
            searchSuggestions.classList.add('hidden');
            searchInput.form.submit();
        }
    }

    // Debug function to test cart opening
    window.testOpenCart = function() {
        console.log('🛒 Test function called');
        try {
            if (typeof openCart === 'function') {
                console.log('🛒 openCart function exists, calling it...');
                openCart();
            } else {
                console.error('❌ openCart function not found!');
            }
        } catch (error) {
            console.error('❌ Error calling openCart:', error);
        }
    };

    // Manual cart opening for testing
    window.forceOpenCart = function() {
        console.log('🛒 Force opening cart...');
        const cartOverlay = document.getElementById('shoppingCart');
        const cartPanel = document.getElementById('cartPanel');
        
        console.log('Elements:', { cartOverlay: !!cartOverlay, cartPanel: !!cartPanel });
        
        if (cartOverlay && cartPanel) {
            cartOverlay.classList.remove('hidden');
            cartPanel.classList.remove('translate-x-full');
            console.log('✅ Cart should be visible now');
        } else {
            console.error('❌ Cart elements not found');
        }
    };

    // Make sure openCart is globally accessible
    window.openCart = openCart;
    window.closeCart = closeCart;
    
    // Test function for instant cart updates
    window.testInstantUpdate = function() {
        console.log('🧪 Testing instant cart updates...');
        console.log('Current cart data:', cartData);
        
        if (cartData.length > 0) {
            const firstItem = cartData[0];
            const productId = firstItem.product?.id || firstItem.product_id;
            const currentQuantity = firstItem.quantity || 1;
            const newQuantity = currentQuantity + 1;
            
            console.log('Testing update for:');
            console.log('- Product ID:', productId);
            console.log('- Current quantity:', currentQuantity);  
            console.log('- New quantity:', newQuantity);
            
            updateCartQuantity(productId, newQuantity);
        } else {
            console.log('❌ No items in cart to test with. Add some items first.');
        }
    };
    
    // Manual test function to verify elements exist
    window.checkCartElements = function() {
        console.log('🔍 Checking cart elements...');
        const elements = {
            shoppingCart: document.getElementById('shoppingCart'),
            cartPanel: document.getElementById('cartPanel'),
            cartItems: document.getElementById('cartItems'),
            emptyCart: document.getElementById('emptyCart'),
            cartTotal: document.getElementById('cartTotal'),
            cartCount: document.getElementById('cartCount')
        };
        
        Object.entries(elements).forEach(([name, element]) => {
            console.log(`${name}:`, element ? '✅ Found' : '❌ NOT FOUND');
        });
        
        console.log('Cart data length:', cartData.length);
        return elements;
    };
    
    // Force refresh cart data and display
    window.forceRefreshCart = function() {
        console.log('🔄 Force refreshing cart...');
        loadCartData();
    };
    
    // Debug function to verify which functions are available
    window.debugCartFunctions = function() {
        console.log('🔍 Available cart functions:');
        console.log('- updateCartQuantity:', typeof window.updateCartQuantity);
        console.log('- removeFromCart:', typeof window.removeFromCart);
        console.log('- updateCart (old):', typeof window.updateCart);
        console.log('- removeCart (old):', typeof window.removeCart);
        console.log('- cartData length:', cartData.length);
        
        if (cartData.length > 0) {
            console.log('🛒 Sample cart item:', cartData[0]);
        }
    };
</script>