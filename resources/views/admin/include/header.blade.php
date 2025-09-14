<header class="bg-white border-b border-gray-200 px-4 py-3">
    <div class="flex items-center justify-between">
        <!-- Left Section - Menu + Search -->
        <div class="flex items-center gap-4 flex-1">
            <!-- Hamburger Menu -->
            <button id="sidebarToggle" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Search -->
            <div class="relative flex-1 max-w-md">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <input
                    type="text"
                    placeholder="Search..."
                    class="w-full pl-10 pr-4 py-2 bg-gray-50 border-0 rounded-lg text-sm placeholder-gray-500 
                           focus:bg-white focus:ring-2 focus:ring-[#1D293D] focus:outline-none transition-all" />
            </div>
        </div>

        <!-- Right Section -->
        <div class="flex items-center gap-3">

            <!-- Notifications -->
            <button class="relative p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 17h5l-1.405-1.405C18.21 15.21 18 14.702 18 14.17V11a6 6 0 
                             00-5-5.917V4a1 1 0 00-2 0v1.083A6 6 0 006 11v3.17c0 .531-.21 
                             1.04-.595 1.425L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>

            <!-- Profile Dropdown -->
            @auth
            <div class="relative" x-data="{ open: false }">
                <!-- Profile Button -->
                <button
                    @click="open = !open"
                    class="flex items-center gap-2 p-1 hover:bg-gray-100 rounded-lg transition-colors">
                    <img src="{{ Auth::user()->profile_image_url }}" 
                         alt="Profile Picture" 
                         class="w-8 h-8 rounded-full profile-avatar object-cover border border-gray-200"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="w-8 h-8 bg-[#1D293D] rounded-full flex items-center justify-center" style="display: none;">
                        <span class="text-white text-sm font-medium">{{ Auth::user()->avatar_initials }}</span>
                    </div>
                    <div class="text-left hidden sm:block">
                        <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <!-- (your dropdown code here) -->
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" @click.outside="open = false" x-cloak class="absolute right-0 top-full mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50"> <!-- Profile Info -->
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <img src="{{ Auth::user()->profile_image_url }}" 
                                 alt="Profile Picture" 
                                 class="w-10 h-10 rounded-full profile-avatar object-cover border border-gray-200"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="w-10 h-10 bg-[#1D293D] rounded-full flex items-center justify-center" style="display: none;">
                                <span class="text-white font-medium">{{ Auth::user()->avatar_initials }}</span>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                    </div> <!-- Links -->
                    <div class="py-2"> <a href="{{ route('settings.profile') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"> <i class="fas fa-user-cog"></i> Profile Settings </a> <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"> <i class="fas fa-bell"></i> Notifications </a>
                        <div class="border-t border-gray-100 mt-2 pt-2">
                            <form method="POST" action="{{ route('logout') }}"> @csrf <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50"> <i class="fas fa-sign-out-alt"></i> Sign Out </button> </form>
                        </div>
                    </div>
                </div>
                @endauth

                @guest
                <div>
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">Login</a>
                </div>
                @endguest

            </div>
        </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('sidebarToggle');
        const mainSidebar = document.getElementById('mainSidebar');

        toggleButton.addEventListener('click', function() {
            mainSidebar.classList.toggle('sidebar-collapsed');
        });
    });
</script>