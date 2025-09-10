<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - EasyCart eCommerce</title>
    
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a'
                        },
                        accent: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706'
                        }
                    }
                }
            }
        }
    </script>

    <script src="//unpkg.com/alpinejs" defer></script>

    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <style>
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }
        
        .gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-accent {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .gradient-success {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-item {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .sidebar-item:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: #f59e0b;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .sidebar-item:hover:before,
        .sidebar-item.active:before {
            transform: scaleY(1);
        }
        
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
        
        .animate-slide-up {
            animation: slideInUp 0.6s ease forwards;
        }
        
        .chart-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 24px;
            color: white;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-100 via-white to-slate-100 min-h-screen">



    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('admin.include.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @include('admin.include.header')
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Admin Success Popup -->
    @if(session('success'))
    <div id="admin-success-popup" class="fixed top-6 right-6 z-[9999] transform translate-x-full opacity-0 transition-all duration-500 ease-out">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-2xl max-w-sm">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold">Admin Login Success!</p>
                    <p class="text-xs opacity-90 mt-1">{{ session('success') }}</p>
                </div>
                <button onclick="closeAdminPopup()" class="flex-shrink-0 ml-3 hover:bg-white/20 rounded-full p-1 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Error Popup -->
    @if(session('error'))
    <div id="admin-error-popup" class="fixed top-6 right-6 z-[9999] transform translate-x-full opacity-0 transition-all duration-500 ease-out">
        <div class="bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-4 rounded-xl shadow-2xl max-w-sm">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold">Error</p>
                    <p class="text-xs opacity-90 mt-1">{{ session('error') }}</p>
                </div>
                <button onclick="closeAdminErrorPopup()" class="flex-shrink-0 ml-3 hover:bg-white/20 rounded-full p-1 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Custom Admin Confirmation Modal -->
    <div id="admin-confirm-modal" class="fixed inset-0 z-[9999] hidden bg-black/50 backdrop-blur-sm">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div id="admin-confirm-content" class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform scale-95 opacity-0 transition-all duration-300">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex items-center space-x-4 mb-6">
                        <div id="admin-confirm-icon" class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center">
                            <!-- Icon will be set by JavaScript -->
                        </div>
                        <div>
                            <h3 id="admin-confirm-title" class="text-lg font-bold text-gray-900">Confirm Action</h3>
                            <p id="admin-confirm-subtitle" class="text-sm text-gray-500">Please confirm your action</p>
                        </div>
                    </div>
                    
                    <!-- Message -->
                    <div class="mb-6">
                        <p id="admin-confirm-message" class="text-gray-700 text-sm leading-relaxed">
                            Are you sure you want to proceed with this action?
                        </p>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex space-x-3">
                        <button id="admin-confirm-cancel" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                            Cancel
                        </button>
                        <button id="admin-confirm-action" class="flex-1 px-4 py-2.5 text-sm font-medium text-white rounded-lg transition-all duration-200">
                            Confirm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Admin Action Success Modal -->
    <div id="admin-action-success" class="fixed top-6 right-6 z-[9999] transform translate-x-full opacity-0 transition-all duration-500 ease-out">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-2xl max-w-sm">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p id="admin-success-title" class="text-sm font-semibold">Action Successful!</p>
                    <p id="admin-success-message" class="text-xs opacity-90 mt-1">Your action has been completed successfully.</p>
                </div>
                <button onclick="closeAdminActionSuccess()" class="flex-shrink-0 ml-3 hover:bg-white/20 rounded-full p-1 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Smooth transitions
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation delays to cards
            const cards = document.querySelectorAll('.animate-slide-up');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Admin popup animations
            const successPopup = document.getElementById('admin-success-popup');
            const errorPopup = document.getElementById('admin-error-popup');
            
            if (successPopup) {
                setTimeout(() => {
                    successPopup.classList.remove('translate-x-full', 'opacity-0');
                    successPopup.classList.add('translate-x-0', 'opacity-100');
                }, 100);

                // Auto-hide after 4 seconds
                setTimeout(() => {
                    closeAdminPopup();
                }, 4000);
            }

            if (errorPopup) {
                setTimeout(() => {
                    errorPopup.classList.remove('translate-x-full', 'opacity-0');
                    errorPopup.classList.add('translate-x-0', 'opacity-100');
                }, 100);

                // Auto-hide after 5 seconds
                setTimeout(() => {
                    closeAdminErrorPopup();
                }, 5000);
            }
        });

        // Admin popup functions
        function closeAdminPopup() {
            const popup = document.getElementById('admin-success-popup');
            if (popup) {
                popup.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    popup.remove();
                }, 500);
            }
        }

        function closeAdminErrorPopup() {
            const popup = document.getElementById('admin-error-popup');
            if (popup) {
                popup.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    popup.remove();
                }, 500);
            }
        }

        // Custom Admin Confirmation System
        window.adminConfirm = function(options = {}) {
            return new Promise((resolve) => {
                const modal = document.getElementById('admin-confirm-modal');
                const content = document.getElementById('admin-confirm-content');
                const icon = document.getElementById('admin-confirm-icon');
                const title = document.getElementById('admin-confirm-title');
                const subtitle = document.getElementById('admin-confirm-subtitle');
                const message = document.getElementById('admin-confirm-message');
                const cancelBtn = document.getElementById('admin-confirm-cancel');
                const actionBtn = document.getElementById('admin-confirm-action');

                // Set content based on action type
                const type = options.type || 'warning';
                const configs = {
                    delete: {
                        icon: '🗑️',
                        iconBg: 'bg-red-100',
                        title: 'Delete Confirmation',
                        subtitle: 'This action cannot be undone',
                        buttonClass: 'bg-red-500 hover:bg-red-600',
                        buttonText: 'Delete'
                    },
                    edit: {
                        icon: '✏️',
                        iconBg: 'bg-blue-100',
                        title: 'Edit Confirmation',
                        subtitle: 'Modify existing data',
                        buttonClass: 'bg-blue-500 hover:bg-blue-600',
                        buttonText: 'Edit'
                    },
                    add: {
                        icon: '➕',
                        iconBg: 'bg-green-100',
                        title: 'Add Confirmation',
                        subtitle: 'Create new entry',
                        buttonClass: 'bg-green-500 hover:bg-green-600',
                        buttonText: 'Add'
                    },
                    status: {
                        icon: '🔄',
                        iconBg: 'bg-orange-100',
                        title: 'Status Change',
                        subtitle: 'Update status',
                        buttonClass: 'bg-orange-500 hover:bg-orange-600',
                        buttonText: 'Update'
                    },
                    warning: {
                        icon: '⚠️',
                        iconBg: 'bg-yellow-100',
                        title: 'Warning',
                        subtitle: 'Please confirm',
                        buttonClass: 'bg-yellow-500 hover:bg-yellow-600',
                        buttonText: 'Proceed'
                    }
                };

                const config = configs[type] || configs.warning;

                // Set modal content
                icon.innerHTML = `<span class="text-2xl">${config.icon}</span>`;
                icon.className = `flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center ${config.iconBg}`;
                title.textContent = options.title || config.title;
                subtitle.textContent = options.subtitle || config.subtitle;
                message.textContent = options.message || 'Are you sure you want to proceed?';
                
                actionBtn.textContent = options.confirmText || config.buttonText;
                actionBtn.className = `flex-1 px-4 py-2.5 text-sm font-medium text-white rounded-lg transition-all duration-200 ${config.buttonClass}`;

                // Show modal
                modal.classList.remove('hidden');
                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);

                // Handle actions
                function cleanup() {
                    content.classList.add('scale-95', 'opacity-0');
                    content.classList.remove('scale-100', 'opacity-100');
                    setTimeout(() => {
                        modal.classList.add('hidden');
                    }, 300);
                }

                cancelBtn.onclick = () => {
                    cleanup();
                    resolve(false);
                };

                actionBtn.onclick = () => {
                    cleanup();
                    resolve(true);
                };

                // Close on backdrop click
                modal.onclick = (e) => {
                    if (e.target === modal) {
                        cleanup();
                        resolve(false);
                    }
                };
            });
        };

        // Show success notification
        window.showAdminSuccess = function(title, message) {
            const popup = document.getElementById('admin-action-success');
            const titleEl = document.getElementById('admin-success-title');
            const messageEl = document.getElementById('admin-success-message');

            titleEl.textContent = title;
            messageEl.textContent = message;

            // Show popup
            popup.classList.remove('translate-x-full', 'opacity-0');
            popup.classList.add('translate-x-0', 'opacity-100');

            // Auto-hide after 3 seconds
            setTimeout(() => {
                closeAdminActionSuccess();
            }, 3000);
        };

        function closeAdminActionSuccess() {
            const popup = document.getElementById('admin-action-success');
            if (popup) {
                popup.classList.add('translate-x-full', 'opacity-0');
                popup.classList.remove('translate-x-0', 'opacity-100');
            }
        }

        // Enhanced confirm function that replaces browser confirm
        window.customConfirm = async function(message, type = 'warning', options = {}) {
            return await adminConfirm({
                message: message,
                type: type,
                ...options
            });
        };
    </script>
    
    @stack('scripts')
</body>
</html>