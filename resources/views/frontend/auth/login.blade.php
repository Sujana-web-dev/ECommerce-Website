@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12 min-h-[400px] flex justify-center items-center">
    <div class="max-w-md w-full bg-white shadow-lg rounded-xl p-6">
        <h1 class="text-2xl font-bold text-center mb-6">Login to Your Account</h1>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = "{{ route('checkout') }}";
                }, 1200);
            </script>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Email or Username</label>
                <input type="text" name="login" class="w-full border rounded px-4 py-2" value="{{ old('login') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="loginPassword" class="w-full border rounded px-4 py-2 pr-12" required>
                    <button type="button" id="toggleLoginPassword" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700">
                        <i id="loginEyeIcon" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-[#1D293D] border-gray-300 rounded">
                    <label class="ml-2 text-sm text-gray-700">Remember me</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-sm text-[#ec4642] hover:underline">Forgot password?</a>
            </div>
            <button type="submit" class="w-full bg-[#1D293D] hover:bg-[#ec4642] text-white py-2 rounded font-bold transition-all duration-300">
                Sign In
            </button>
        </form>

        <p class="mt-4 text-sm text-gray-500 text-center">
            Don't have an account? 
            <a href="#" id="openSignupModal" class="text-[#5a4bff] hover:underline">Sign Up</a>
        </p>
    </div>
</div>

<!-- Optional: Include JS to trigger signup modal like your header -->
<script>
document.getElementById('openSignupModal')?.addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('loginModal')?.classList.add('hidden');
    document.getElementById('signupModal')?.classList.remove('hidden');
});

// Login password toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const toggleLoginPassword = document.getElementById('toggleLoginPassword');
    const loginPasswordField = document.getElementById('loginPassword');
    const loginEyeIcon = document.getElementById('loginEyeIcon');

    if (toggleLoginPassword) {
        toggleLoginPassword.addEventListener('click', function() {
            if (loginPasswordField.type === 'password') {
                loginPasswordField.type = 'text';
                loginEyeIcon.classList.remove('fa-eye');
                loginEyeIcon.classList.add('fa-eye-slash');
            } else {
                loginPasswordField.type = 'password';
                loginEyeIcon.classList.remove('fa-eye-slash');
                loginEyeIcon.classList.add('fa-eye');
            }
        });
    }
});
</script>
@endsection
