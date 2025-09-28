<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Premium eCommerce experience with luxury products and exceptional service">
    <meta name="keywords" content="ecommerce, luxury, premium, shopping, fashion, electronics">
    <title>{{ $pageTitle ?? 'EasyCart - Premium Shopping Experience' }}</title>
    
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
@include('frontend.include.css')
</head>
<body class="bg-gray-50 text-gray-900 overflow-x-hidden">
    @include('frontend.include.header')

    <!-- Custom Popup Notifications Container -->
    <div id="popup-container" class="fixed top-6 right-6 z-[9999] space-y-4 pointer-events-none"></div>

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('frontend.include.footer')

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 bg-primary-600 text-white p-3 rounded-full shadow-lg hover:bg-primary-700 transform hover:scale-110 transition-all duration-300 opacity-0 invisible z-40">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Overlay for modals and sidebars -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 opacity-0 invisible transition-all duration-300"></div>

    <!-- Custom Popup Notification System -->
    <script>
        // Global Popup Notification System
        window.showPopupNotification = function(message, type = 'success', duration = 5000) {
            const container = document.getElementById('popup-container');
            if (!container) return;

            // Create unique ID for popup
            const popupId = 'popup-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);

            // Create popup element
            const popup = document.createElement('div');
            popup.id = popupId;
            popup.className = `transform translate-x-full opacity-0 transition-all duration-500 ease-out pointer-events-auto max-w-sm w-full`;

            // Define popup styles based on type
            let bgClass, iconClass, textClass, icon;
            switch(type) {
                case 'success':
                    bgClass = 'bg-gradient-to-r from-green-500 to-emerald-600';
                    iconClass = 'text-white';
                    textClass = 'text-white';
                    icon = 'fas fa-check-circle';
                    break;
                case 'error':
                    bgClass = 'bg-gradient-to-r from-red-500 to-red-600';
                    iconClass = 'text-white';
                    textClass = 'text-white';
                    icon = 'fas fa-times-circle';
                    break;
                case 'warning':
                    bgClass = 'bg-gradient-to-r from-yellow-500 to-orange-500';
                    iconClass = 'text-white';
                    textClass = 'text-white';
                    icon = 'fas fa-exclamation-triangle';
                    break;
                case 'info':
                    bgClass = 'bg-gradient-to-r from-blue-500 to-blue-600';
                    iconClass = 'text-white';
                    textClass = 'text-white';
                    icon = 'fas fa-info-circle';
                    break;
                default:
                    bgClass = 'bg-gradient-to-r from-gray-600 to-gray-700';
                    iconClass = 'text-white';
                    textClass = 'text-white';
                    icon = 'fas fa-bell';
            }

            // Build popup HTML
            popup.innerHTML = `
                <div class="${bgClass} rounded-xl shadow-2xl overflow-hidden backdrop-blur-sm border border-white/20">
                    <div class="p-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 mt-0.5">
                                <i class="${icon} ${iconClass} text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="${textClass} font-medium text-sm leading-relaxed">${message}</p>
                            </div>
                            <div class="flex-shrink-0 ml-2">
                                <button onclick="removePopupNotification('${popupId}')" class="${textClass} hover:bg-white/20 rounded-full p-1 transition-colors duration-200">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Progress bar -->
                    <div class="h-1 bg-black/20 relative overflow-hidden">
                        <div class="progress-bar h-full bg-white/50 transform -translate-x-full transition-transform ease-linear" style="transition-duration: ${duration}ms;"></div>
                    </div>
                </div>
            `;

            // Add to container
            container.appendChild(popup);

            // Animate in
            setTimeout(() => {
                popup.classList.remove('translate-x-full', 'opacity-0');
                popup.classList.add('translate-x-0', 'opacity-100');
                
                // Start progress bar animation
                const progressBar = popup.querySelector('.progress-bar');
                if (progressBar) {
                    setTimeout(() => {
                        progressBar.classList.remove('-translate-x-full');
                        progressBar.classList.add('translate-x-0');
                    }, 100);
                }
            }, 10);

            // Auto remove
            setTimeout(() => {
                removePopupNotification(popupId);
            }, duration);

            return popupId;
        };

        // Remove specific popup
        window.removePopupNotification = function(popupId) {
            const popup = document.getElementById(popupId);
            if (popup) {
                popup.classList.remove('translate-x-0', 'opacity-100');
                popup.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    if (popup.parentNode) {
                        popup.parentNode.removeChild(popup);
                    }
                }, 500);
            }
        };

        // Show flash messages as popups when page loads
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showPopupNotification(`{!! addslashes(session('success')) !!}`, 'success');
            @endif

            @if(session('error'))
                showPopupNotification(`{!! addslashes(session('error')) !!}`, 'error');
            @endif

            @if(session('warning'))
                showPopupNotification(`{!! addslashes(session('warning')) !!}`, 'warning');
            @endif

            @if(session('info'))
                showPopupNotification(`{!! addslashes(session('info')) !!}`, 'info');
            @endif
        });
    </script>

@include('frontend.include.js')
</body>
</html>