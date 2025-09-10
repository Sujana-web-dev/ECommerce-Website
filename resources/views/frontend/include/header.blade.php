@php
// safe default for $cart to avoid "Undefined variable $cart"
if (! isset($cart)) {
if (auth()->check()) {
$cart = \App\Models\CartItem::where('user_id', auth()->id())->with('product')->get();
} else {
$cart = collect(session('cart', []));
}
}
@endphp

<!-- Notification Bar -->
<div id="notification" class="notification hidden fixed top-0 left-0 right-0 bg-gradient-to-r from-blue-900 to-blue-800 text-white py-3 px-4 text-center z-50">
    <p class="text-sm font-medium">Free shipping on orders over $50! Use code: FREESHIP</p>
</div>


<!-- Header -->
<header class="bg-white shadow-lg sticky top-0 z-50"> <!-- Changed background color -->
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard')}}">
                    <h1 class="text-2xl font-bold text-[#1D293D]">EasyCart</h1>
                </a>
            </div>

            <!-- Search Bar - Desktop -->
            <div class="hidden md:flex flex-1 max-w-lg mx-8 mb-3">
                <div class="relative w-full">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#ec4642] focus:border-transparent">
                </div>
            </div>

            <!-- Icons -->
            <div class="flex items-center space-x-4">
                <button class="text-gray-600 hover:text-gray-900 transition md:hidden">
                    <i class="fas fa-search text-xl"></i>
                </button>

                <!-- User Dropdown -->
                <div class="relative">
                    <button id="userDropdownToggle" class="text-gray-600 hover:text-gray-900 transition flex items-center">
                        <i class="fas fa-user text-xl"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        @auth
                        <div class="px-4 py-2 border-b">
                            <p class="text-sm font-medium text-gray-900">Welcome, {{ Auth::user()->name }}</p>
                        </div>
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                        <a href="{{ route('orders.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-shopping-bag mr-2"></i> My Orders
                        </a>
                        <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-shopping-cart mr-2"></i> My Cart
                        </a>
                        <div class="border-t my-1"></div>
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                        @else
                        <div class="px-4 py-2 border-b">
                            <p class="text-sm font-medium text-gray-900">Welcome, Guest</p>
                        </div>
                        <a href="#" id="loginBtn" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                        </a>
                        <a href="#" id="signupBtn" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user-plus mr-2"></i> Sign Up
                        </a>
                        @endauth
                    </div>
                </div>

                <!-- Cart Badge -->
                <button id="cartToggle" class="relative">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span id="cartCount" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        {{ count($cart) }}
                    </span>
                </button>

                <button id="mobileMenuToggle" class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Navigation - Desktop -->
        <nav class="hidden md:block border-t border-gray-200">
            <div class="flex items-center justify-center space-x-8 py-2">
                <a href="{{ route('electronics') }}" class="text-[#1D293D] hover:text-[#ec4642]">Electronics</a>
                <a href="{{ route('fashion') }}" class="text-[#1D293D] hover:text-[#ec4642]">Fashion</a>
                <a href="{{ route('home_garden') }}" class="text-[#1D293D] hover:text-[#ec4642]">Home & Garden</a>
                <a href="{{ route('sports') }}" class="text-[#1D293D] hover:text-[#ec4642]">Sports</a>
                <a href="{{ route('beauty') }}" class="text-[#1D293D] hover:text-[#ec4642]">Beauty</a>
                <a href="{{ route('books') }}" class="text-[#1D293D] hover:text-[#ec4642]">Books</a>
            </div>
        </nav>

    </div>
</header>





<!-- Login Modal -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Login to Your Account</h3>
                <button id="closeLoginModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>


            <!-- ✅ Success Popup -->
            @if(session('success'))
            <div class="fixed top-0 left-0 right-0 z-50 bg-green-100 border border-green-400 text-green-800 px-4 py-3 text-center">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                {{ $errors->first() }}
            </div>
            @endif


            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="login" class="block text-gray-700 font-medium mb-2">Username or Email</label>
                    <input type="text" name="login" id="login" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" placeholder="Username or Email" required>
                    @error('login')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent" placeholder="••••••••" required>
                    @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                </div>

                <button type="submit" class="w-full btn-secondary text-white px-8 py-2 rounded-lg font-medium gradient-bg">
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="#" id="switchToSignup" class="font-medium text-[#ec4642]">Sign up</a>
                </p>
            </div>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-3">
                    <button class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fab fa-google text-red-500"></i>
                    </button>
                    <button class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fab fa-facebook-f text-blue-600"></i>
                    </button>
                    <button class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fab fa-twitter text-blue-400"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ✅ Signup Modal -->
<div id="signupModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden overflow-y-auto p-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-auto my-auto max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Create an Account</h3>
                <button id="closeSignupModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

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



<!-- Offcanvas Cart -->
<div id="cartOffcanvas" class="fixed top-0 right-0 w-96 h-full bg-gradient-to-br from-white to-gray-50 shadow-2xl transform translate-x-full transition-all duration-500 ease-in-out z-50 flex flex-col">

    <!-- Header with gradient background -->
    <div class="bg-[#1D293D] p-6 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <div class="bg-white/20 p-2 rounded-full">
                <i class="fas fa-shopping-bag text-white text-lg"></i>
            </div>
            <h2 class="font-bold text-xl text-white">My Shopping Cart</h2>
        </div>
        <button onclick="document.getElementById('cartOffcanvas').classList.add('translate-x-full')"
            class="text-white/80 hover:text-white hover:bg-white/20 p-2 rounded-full transition-all duration-300 text-xl">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Cart Items Container with custom scrollbar -->
    <div class="flex-1 overflow-y-auto p-4 cart-scroll" id="cartItemsContainer" style="scrollbar-width: thin; scrollbar-color: #ec4642 #f1f1f1;">
        <!-- JS will populate -->
        <div class="text-center py-16 text-gray-400">
            <div class="mb-4">
                <i class="fas fa-shopping-cart text-6xl opacity-30"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-600 mb-2">Your cart is empty</h3>
            <p class="text-sm text-gray-500">Add some amazing products to get started!</p>
        </div>
    </div>

    <!-- Modern Subtotal Section -->
    <div class="border-t border-gray-200 bg-white">
        <div class="p-3">
            <div class="flex justify-between items-center mb-1">
                <span class="text-gray-600 font-medium text-sm">Subtotal:</span>
                <span id="cartSubtotal" class="text-lg font-bold text-[#1D293D]">TK 0</span>
            </div>
            <div class="text-xs text-gray-500">Shipping calculated at checkout</div>
        </div>
    </div>

    <!-- Modern Checkout Button -->
    <div class="p-4 bg-white space-y-3">
        <!-- View Cart Button (shows full shopping cart page) -->
        <a href="{{ route('cart.index') }}" class="w-full block text-center bg-[#1D293D] hover:bg-[#ec4642] text-white py-3 rounded-xl font-semibold text-base shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden group">
            <span class="absolute inset-0 bg-white/10 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-500"></span>
            <span class="relative flex items-center justify-center space-x-2">
                <i class="fas fa-shopping-cart"></i>
                <span>View Cart</span>
            </span>
        </a>
        <!-- Only one button needed, both actions go to cart.index -->

        <div class="text-center mt-3">
            <span class="text-xs text-gray-500">
                <i class="fas fa-lock mr-1"></i>
                Secure checkout guaranteed
            </span>
        </div>
    </div>
</div>

<!-- Custom CSS for cart scrollbar -->
<style>
    .cart-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .cart-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .cart-scroll::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #1D293D, #ec4642);
        border-radius: 10px;
    }

    .cart-scroll::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #ec4642, #1D293D);
    }
</style>

<script>
    const cartAddUrl = "{{ route('cart.add') }}";
    const cartUpdateUrl = "{{ route('cart.update') }}";
    const cartRemoveUrl = "{{ route('cart.remove') }}";
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const cartOffcanvas = document.getElementById('cartOffcanvas');
        const cartItemsContainer = document.getElementById('cartItemsContainer');
        const cartCountEl = document.getElementById('cartCount');
        const cartSubtotalEl = document.getElementById('cartSubtotal');

        // Render cart items + subtotal + badge
        function renderCart(cart) {
            cartItemsContainer.innerHTML = '';
            let subtotal = 0;

            if (cart.length === 0) {
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
                cartSubtotalEl.innerText = `TK 0.00`;
                cartCountEl.innerText = '0';
                return;
            }

            cart.forEach(item => {
                subtotal += item.quantity * parseFloat(item.product.amount);

                const div = document.createElement('div');
                div.className = 'group bg-white rounded-xl p-6 mb-4 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-[#ec4642]/20';
                div.innerHTML = `
                    <div class="flex items-center space-x-4">
                        <div class="relative overflow-hidden rounded-lg">
                            <img src="${item.product.image ? '/storage/' + item.product.image : 'https://via.placeholder.com/80x80/f8fafc/64748b?text=No+Image'}" class="w-20 h-20 object-cover rounded-lg group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-[#1D293D] text-base truncate group-hover:text-[#ec4642] transition-colors duration-300 mb-2">${item.product.name}</h4>
                            <p class="text-[#ec4642] font-bold text-base mb-3">TK ${parseFloat(item.product.amount).toFixed(2)}</p>
                            <div class="flex items-center space-x-3">
                                <button onclick="updateCart(${item.product.id}, ${item.quantity - 1})" 
                                        class="w-9 h-9 flex items-center justify-center bg-[#1D293D] hover:bg-[#ec4642] text-white rounded-full transition-all duration-300 text-sm">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="bg-gradient-to-r from-[#1D293D] to-[#ec4642] text-white px-4 py-2 rounded-full text-sm font-bold min-w-[3rem] text-center">${item.quantity}</span>
                                <button onclick="updateCart(${item.product.id}, ${item.quantity + 1})" 
                                        class="w-9 h-9 flex items-center justify-center bg-[#1D293D] hover:bg-[#ec4642] text-white rounded-full transition-all duration-300 text-sm">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <button onclick="removeCart(${item.product.id})" 
                                    class="w-9 h-9 flex items-center justify-center bg-red-100 text-red-500 hover:bg-red-500 hover:text-white rounded-full transition-all duration-300">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                `;
                cartItemsContainer.appendChild(div);
            });

            cartSubtotalEl.innerText = `TK ${subtotal.toFixed(2)}`;
            cartCountEl.innerText = cart.length;
        }

        // Add to cart
        // Cart Success Popup Function
        window.showCartPopup = function(message, type = 'success') {
            // Remove existing popup if any
            const existingPopup = document.getElementById('cart-popup');
            if (existingPopup) {
                existingPopup.remove();
            }

            // Create popup element
            const popup = document.createElement('div');
            popup.id = 'cart-popup';
            popup.className = `fixed top-6 right-6 z-[9999] px-6 py-4 rounded-xl shadow-2xl text-white font-semibold transform transition-all duration-500 ease-out translate-x-full opacity-0 ${
                type === 'success' ? 'bg-gradient-to-r from-green-500 to-green-600' : 
                type === 'error' ? 'bg-gradient-to-r from-red-500 to-red-600' : 
                'bg-gradient-to-r from-blue-500 to-blue-600'
            }`;
            
            popup.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        ${type === 'success' ? 
                            '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' :
                            type === 'error' ?
                            '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>' :
                            '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
                        }
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">${message}</p>
                    </div>
                    <button onclick="document.getElementById('cart-popup').remove()" class="flex-shrink-0 ml-3 hover:bg-white/20 rounded-full p-1 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            `;

            document.body.appendChild(popup);

            // Animate in
            setTimeout(() => {
                popup.classList.remove('translate-x-full', 'opacity-0');
                popup.classList.add('translate-x-0', 'opacity-100');
            }, 10);

            // Auto remove after 4 seconds
            setTimeout(() => {
                if (popup && popup.parentNode) {
                    popup.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => {
                        if (popup && popup.parentNode) {
                            popup.remove();
                        }
                    }, 500);
                }
            }, 4000);
        }

        window.addToCart = function(productId, quantity = 1) {
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
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        renderCart(data.cart); // Update badge + offcanvas
                        cartOffcanvas.classList.remove('translate-x-full'); // Show offcanvas
                        
                        // Show success popup
                        showCartPopup('Successfully added item to cart!', 'success');
                    } else {
                        showCartPopup(data.message || 'Failed to add product', 'error');
                    }
                })
                .catch(error => {
                    console.error('Cart error:', error);
                    showCartPopup('Something went wrong. Please try again.', 'error');
                });
        }

        // Update quantity
        window.updateCart = function(productId, quantity) {
            if (quantity < 1) return removeCart(productId);

            fetch("{{ route('cart.update') }}", {
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
                .then(res => res.json())
                .then(data => {
                    if (data.success) renderCart(data.cart);
                });
        }

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
                    if (data.success) renderCart(data.cart);
                });
        }

        // Cart toggle button
        document.getElementById('cartToggle').addEventListener('click', function() {
            cartOffcanvas.classList.remove('translate-x-full');
        });

        // Close button
        document.querySelector('#cartOffcanvas button[text="✕"]').addEventListener('click', function() {
            cartOffcanvas.classList.add('translate-x-full');
        });

        // Initial load: fetch cart
        fetch("{{ route('cart.index') }}")
            .then(res => res.json())
            .then(data => {
                if (data.success) renderCart(data.cart);
            });
    });
</script>












<script>
    document.addEventListener('DOMContentLoaded', function() {
        // User Dropdown
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');

        userDropdownToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            userDropdown.classList.add('hidden');
        });

        // Login Modal
        const loginBtn = document.getElementById('loginBtn');
        const loginModal = document.getElementById('loginModal');
        const closeLoginModal = document.getElementById('closeLoginModal');

        loginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            loginModal.classList.remove('hidden');
            userDropdown.classList.add('hidden');
        });

        closeLoginModal.addEventListener('click', function() {
            loginModal.classList.add('hidden');
        });

        // Signup Modal
        const signupBtn = document.getElementById('signupBtn');
        const signupModal = document.getElementById('signupModal');
        const closeSignupModal = document.getElementById('closeSignupModal');

        signupBtn.addEventListener('click', function(e) {
            e.preventDefault();
            signupModal.classList.remove('hidden');
            userDropdown.classList.add('hidden');
        });

        closeSignupModal.addEventListener('click', function() {
            signupModal.classList.add('hidden');
        });

        // Switch between Login and Signup
        const switchToSignup = document.getElementById('switchToSignup');
        const switchToLogin = document.getElementById('switchToLogin');

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

        // Cart Offcanvas
        const cartToggle = document.getElementById('cartToggle');
        const cartOffcanvas = document.getElementById('cartOffcanvas');
        const closeCartOffcanvas = document.getElementById('closeCartOffcanvas');

        cartToggle.addEventListener('click', function() {
            cartOffcanvas.classList.remove('translate-x-full');
        });

        closeCartOffcanvas.addEventListener('click', function() {
            cartOffcanvas.classList.add('translate-x-full');
        });

        // Close modals when clicking outside
        loginModal.addEventListener('click', function(e) {
            if (e.target === loginModal) {
                loginModal.classList.add('hidden');
            }
        });

        signupModal.addEventListener('click', function(e) {
            if (e.target === signupModal) {
                signupModal.classList.add('hidden');
            }
        });
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
    function addToCart(productId) {
        let quantity = 1;
        const quantityInput = document.getElementById('quantity');
        const modal = document.getElementById('quickViewModal');

        if (quantityInput && modal && modal.style.display !== 'none') {
            quantity = parseInt(quantityInput.value) || 1;
        }

        fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const container = document.getElementById('cartItemsContainer');
                    container.innerHTML = '';
                    let subtotal = 0;

                    data.cart.forEach(item => {
                        subtotal += item.product.amount * item.quantity;

                        const div = document.createElement('div');
                        div.className = 'group bg-white rounded-xl p-6 mb-4 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-[#ec4642]/20';
                        div.innerHTML = `
                            <div class="flex items-center space-x-4">
                                <div class="relative overflow-hidden rounded-lg">
                                    <img src="${item.product.image ? '/storage/' + item.product.image : 'https://via.placeholder.com/80x80/f8fafc/64748b?text=No+Image'}" alt="${item.product.name}" class="w-20 h-20 object-cover rounded-lg group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-semibold text-[#1D293D] text-base truncate group-hover:text-[#ec4642] transition-colors duration-300 mb-2">${item.product.name}</h3>
                                    <p class="text-[#ec4642] font-bold text-base mb-3">TK ${parseFloat(item.product.amount).toFixed(2)}</p>
                                    <div class="flex items-center space-x-3">
                                        <button onclick="updateCart(${item.product.id}, ${item.quantity - 1})" 
                                                class="w-9 h-9 flex items-center justify-center bg-[#1D293D] hover:bg-[#ec4642] text-white rounded-full transition-all duration-300 text-sm">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="bg-gradient-to-r from-[#1D293D] to-[#ec4642] text-white px-4 py-2 rounded-full text-sm font-bold min-w-[3rem] text-center">${item.quantity}</span>
                                        <button onclick="updateCart(${item.product.id}, ${item.quantity + 1})" 
                                                class="w-9 h-9 flex items-center justify-center bg-[#1D293D] hover:bg-[#ec4642] text-white rounded-full transition-all duration-300 text-sm">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <button onclick="removeCart(${item.product.id})" 
                                            class="w-9 h-9 flex items-center justify-center bg-red-100 text-red-500 hover:bg-red-500 hover:text-white rounded-full transition-all duration-300">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                        container.appendChild(div);
                    });

                    document.getElementById('cartSubtotal').innerText = `TK ${subtotal.toFixed(2)}`;

                    // Show offcanvas
                    document.getElementById('cartOffcanvas').classList.remove('translate-x-full');
                    
                    // Show success popup
                    showCartPopup('Successfully added item to cart!', 'success');

                    if (modal && modal.style.display !== 'none') closeQuickView();
                } else {
                    showCartPopup(data.message || 'Failed to add product', 'error');
                }
            })
            .catch(err => console.error(err));
    }

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