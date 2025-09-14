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
    <!-- Loading Screen -->
    <div id="loading-screen" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
        <div class="text-center">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-primary-600 mb-4"></div>
            <h2 class="text-2xl font-serif font-bold gradient-text">EasyCart</h2>
            <p class="text-gray-600 mt-2">Loading premium experience...</p>
        </div>
    </div>

    @include('frontend.include.header')

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

@include('frontend.include.js')
</body>
</html>