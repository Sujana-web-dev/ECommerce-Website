<!-- Sidebar -->
<div id="mainSidebar" class="sidebar w-64 shadow-2xl border-r border-gray-200 flex flex-col bg-gradient-to-b from-slate-900 to-slate-800 text-white transition-all duration-300">
    <!-- Logo -->
    <div class="p-6 border-b border-white/10">
        <div class="text-center">
            <h1 class="sidebar-text text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">EasyCart</h1>
            <p class="sidebar-text text-sm text-gray-300 uppercase tracking-wider mt-1">Admin Panel</p>
        </div>
    </div>

    <!-- Navigation (Scrollable) -->
    <nav class="flex-1 p-4 space-y-3 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('admindashboard') }}"
            class="flex items-center px-4 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 transition-all duration-300 shadow-lg transform hover:scale-105">
            <span class="sidebar-text font-semibold text-white">🏠 Dashboard</span>
        </a>

        <!-- Catalog Section -->
        <div class="pt-4">
            <h3 class="sidebar-text text-xs uppercase tracking-wider font-bold mb-3 px-4 text-gray-300 border-l-2 border-blue-400 pl-2">Catalog Management</h3>

            <!-- Products Dropdown -->
            <div class="mb-2">
                <button type="button"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-white/5 hover:bg-white/10 transition-all duration-300 border border-white/10 hover:border-white/20 dropdown-toggle"
                    data-target="productsMenu">
                    <span class="sidebar-text font-medium text-white">📦 Products</span>
                    <span class="sidebar-text text-gray-400 text-sm dropdown-arrow">▼</span>
                </button>
                <div id="productsMenu" class="sidebar-submenu mt-2 ml-4 space-y-1" style="display: none;">
                    <a href="{{route('product.add')}}" class="block px-4 py-2 rounded-lg text-sm hover:bg-blue-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-blue-400">+ Add Product</a>
                    <a href="{{route('product.list')}}" class="block px-4 py-2 rounded-lg text-sm hover:bg-blue-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-blue-400">📋 Product List</a>
                </div>
            </div>

            <!-- Categories Dropdown -->
            <div class="mb-2">
                <button type="button"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-white/5 hover:bg-white/10 transition-all duration-300 border border-white/10 hover:border-white/20 dropdown-toggle"
                    data-target="categoriesMenu">
                    <span class="sidebar-text font-medium text-white">🏷️ Categories</span>
                    <span class="sidebar-text text-gray-400 text-sm dropdown-arrow">▼</span>
                </button>
                <div id="categoriesMenu" class="sidebar-submenu mt-2 ml-4 space-y-1" style="display: none;">
                    <a href="{{route('category.add')}}" class="block px-4 py-2 rounded-lg text-sm hover:bg-green-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-green-400">+ Add Category</a>
                    <a href="{{route('category.list')}}" class="block px-4 py-2 rounded-lg text-sm hover:bg-green-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-green-400">📂 Category List</a>
                </div>
            </div>
        </div>

        <!-- Sales Section -->
        <div class="pt-4">
            <h3 class="sidebar-text text-xs uppercase tracking-wider font-bold mb-3 px-4 text-gray-300 border-l-2 border-purple-400 pl-2">Sales & Orders</h3>

            <!-- Orders Dropdown -->
            <div class="mb-2">
                <button type="button"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-white/5 hover:bg-purple-600/20 transition-all duration-300 border border-white/10 hover:border-purple-400 dropdown-toggle"
                    data-target="ordersMenu">
                    <span class="sidebar-text font-medium text-white">🛒 Orders</span>
                    <div class="flex items-center gap-2">
                        <span class="sidebar-text bg-red-500 text-white text-xs px-2 py-1 rounded-full font-bold shadow-lg">23</span>
                        <span class="sidebar-text text-gray-400 text-sm dropdown-arrow">▼</span>
                    </div>
                </button>
                <div id="ordersMenu" class="sidebar-submenu mt-2 ml-4 space-y-1" style="display: none;">
                    <a href="{{ route('orders') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-purple-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-purple-400">📋 All Orders</a>
                    <a href="{{ route('orders.pending') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-purple-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-purple-400">⏰ Pending Orders</a>
                    <a href="{{ route('orders.approved') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-purple-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-purple-400">✅ Approved Orders</a>
                    <a href="{{ route('orders.processing') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-purple-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-purple-400">🔄 Processing Orders</a>
                    <a href="{{ route('orders.out_for_delivery') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-purple-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-purple-400">🚚 Out for Delivery</a>
                    <a href="{{ route('orders.completed') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-purple-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-purple-400">📦 Delivered</a>
                    <a href="{{ route('orders.cancelled') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-purple-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-purple-400">❌ Cancelled Orders</a>
                </div>
            </div>

            <!-- Customers Dropdown -->
            <div class="mb-2">
                <button type="button"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-white/5 hover:bg-purple-600/20 transition-all duration-300 border border-white/10 hover:border-purple-400 dropdown-toggle"
                    data-target="customersMenu">
                    <span class="sidebar-text font-medium text-white">👥 Customers</span>
                    <span class="sidebar-text text-gray-400 text-sm dropdown-arrow">▼</span>
                </button>
                <div id="customersMenu" class="sidebar-submenu mt-2 ml-4 space-y-1" style="display: none;">
                    <a href="{{ route('customers.list') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-purple-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-purple-400">👤 All Customers</a>
                    <a href="{{ route('customers.reviews') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-purple-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-purple-400">💬 Reviews</a>
                </div>
            </div>
        </div>

        <!-- Marketing Section -->
        <div class="pt-4">
            <h3 class="sidebar-text text-xs uppercase tracking-wider font-bold mb-3 px-4 text-gray-300 border-l-2 border-orange-400 pl-2">Marketing Tools</h3>

            <!-- Campaigns Dropdown -->
            <div class="mb-2">
                <button type="button"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-white/5 hover:bg-orange-600/20 transition-all duration-300 border border-white/10 hover:border-orange-400 dropdown-toggle"
                    data-target="campaignsMenu">
                    <span class="sidebar-text font-medium text-white">📢 Campaigns</span>
                    <span class="sidebar-text text-gray-400 text-sm dropdown-arrow">▼</span>
                </button>
                <div id="campaignsMenu" class="sidebar-submenu mt-2 ml-4 space-y-1" style="display: none;">
                    <a href="#" class="block px-4 py-2 rounded-lg text-sm hover:bg-orange-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-orange-400">📱 Social Media</a>
                </div>
            </div>

            <!-- Analytics Dropdown -->
            <div class="mb-2">
                <button type="button"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-white/5 hover:bg-orange-600/20 transition-all duration-300 border border-white/10 hover:border-orange-400 dropdown-toggle"
                    data-target="analyticsMenu">
                    <span class="sidebar-text font-medium text-white">📊 Analytics</span>
                    <span class="sidebar-text text-gray-400 text-sm dropdown-arrow">▼</span>
                </button>
                <div id="analyticsMenu" class="sidebar-submenu mt-2 ml-4 space-y-1" style="display: none;">
                    <a href="{{ route('analytics.sales') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-orange-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-orange-400">📈 Sales Reports</a>
                </div>
            </div>
        </div>

        <!-- System Tools Section -->
        <div class="pt-4 pb-4">
            <h3 class="sidebar-text text-xs uppercase tracking-wider font-bold mb-3 px-4 text-gray-300 border-l-2 border-teal-400 pl-2">System Tools</h3>

            <!-- Inbox Dropdown -->
            <div class="mb-2">
                <button type="button"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-white/5 hover:bg-teal-600/20 transition-all duration-300 border border-white/10 hover:border-teal-400 dropdown-toggle"
                    data-target="inboxMenu">
                    <span class="sidebar-text font-medium text-white">📧 Inbox</span>
                    <div class="flex items-center gap-2">
                        <span class="sidebar-text bg-blue-500 text-white text-xs px-2 py-1 rounded-full font-bold shadow-lg">5</span>
                        <span class="sidebar-text text-gray-400 text-sm dropdown-arrow">▼</span>
                    </div>
                </button>
                <div id="inboxMenu" class="sidebar-submenu mt-2 ml-4 space-y-1" style="display: none;">
                    <a href="{{ route('inbox.messages') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-teal-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-teal-400">📨 All Messages</a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="mb-2">
                <button type="button"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl bg-white/5 hover:bg-teal-600/20 transition-all duration-300 border border-white/10 hover:border-teal-400 dropdown-toggle"
                    data-target="settingsMenu">
                    <span class="sidebar-text font-medium text-white">⚙️ Settings</span>
                    <span class="sidebar-text text-gray-400 text-sm dropdown-arrow">▼</span>
                </button>
                <div id="settingsMenu" class="sidebar-submenu mt-2 ml-4 space-y-1" style="display: none;">
                    <a href="{{ route('settings.payment-methods') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-teal-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-teal-400">💳 Payment Methods</a>
                    <a href="{{ route('settings.profile') }}" class="block px-4 py-2 rounded-lg text-sm hover:bg-teal-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-teal-400">👤 Profile</a>
                    <a href="#" class="block px-4 py-2 rounded-lg text-sm hover:bg-teal-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-teal-400">🔒 Security</a>
                    <a href="#" class="block px-4 py-2 rounded-lg text-sm hover:bg-teal-600/20 text-gray-300 hover:text-white transition-all duration-200 border-l-2 border-transparent hover:border-teal-400">🔔 Notifications</a>
                </div>
            </div>

        </div>
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const targetId = this.getAttribute('data-target');
                const targetMenu = document.getElementById(targetId);
                const targetArrow = this.querySelector('.dropdown-arrow');

                // Get current display state
                const isCurrentlyOpen = targetMenu.style.display === 'block';

                // Close ALL dropdowns first
                document.querySelectorAll('.sidebar-submenu').forEach(menu => {
                    menu.style.display = 'none';
                });

                // Reset ALL arrows
                document.querySelectorAll('.dropdown-arrow').forEach(arrow => {
                    arrow.textContent = '▼';
                });

                // If current menu was closed, open it
                if (!isCurrentlyOpen) {
                    targetMenu.style.display = 'block';
                    targetArrow.textContent = '▲';
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown-toggle')) {
                document.querySelectorAll('.sidebar-submenu').forEach(menu => {
                    menu.style.display = 'none';
                });
                document.querySelectorAll('.dropdown-arrow').forEach(arrow => {
                    arrow.textContent = '▼';
                });
            }
        });
    });
</script>

<style>
    /* Sidebar collapse styles - Fully close sidebar */
    .sidebar {
        transition: all 0.3s ease-in-out;
        transform: translateX(0);
    }

    .sidebar.sidebar-collapsed {
        width: 0;
        transform: translateX(-100%);
        overflow: hidden;
    }

    /* Custom scrollbar for sidebar */
    .w-64 nav::-webkit-scrollbar {
        width: 8px;
    }

    .w-64 nav::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
    }

    .w-64 nav::-webkit-scrollbar-thumb {
        background: #1C398E;
        border-radius: 4px;
    }

    .w-64 nav::-webkit-scrollbar-thumb:hover {
        background: #153074;
    }

    .w-64 nav {
        scrollbar-width: thin;
        scrollbar-color: #1C398E rgba(255, 255, 255, 0.1);
    }

    /* Smooth transition for submenu */
    .sidebar-submenu {
        transition: all 0.3s ease-in-out;
        overflow: hidden;
    }
</style>