@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12 min-h-[400px] flex justify-center items-center">
    <div class="max-w-md w-full bg-white shadow-lg rounded-xl p-6">
        <h1 class="text-2xl font-bold text-center mb-6">Create an Account</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Full Name</label>
                <input type="text" name="name" class="w-full border rounded px-4 py-2" value="{{ old('name') }}" autocomplete="name" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Username</label>
                <input type="text" name="username" class="w-full border rounded px-4 py-2" value="{{ old('username') }}" autocomplete="username" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" class="w-full border rounded px-4 py-2" value="{{ old('email') }}" autocomplete="email" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="register-password" class="w-full border rounded px-4 py-2 pr-12" autocomplete="new-password" required>
                    <button type="button" id="toggleRegisterPassword" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700">
                        <i id="registerEyeIcon" class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="mt-2 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-sm font-semibold text-blue-800 mb-1">🔒 Create a Strong & Unique Password:</p>
                    <ul class="text-xs text-blue-700 space-y-1">
                        <li id="length-check" class="flex items-center"><span class="mr-1">❌</span> At least 8 characters</li>
                        <li id="uppercase-check" class="flex items-center"><span class="mr-1">❌</span> One uppercase letter (A-Z)</li>
                        <li id="lowercase-check" class="flex items-center"><span class="mr-1">❌</span> One lowercase letter (a-z)</li>
                        <li id="number-check" class="flex items-center"><span class="mr-1">❌</span> One number (0-9)</li>
                        <li id="special-check" class="flex items-center"><span class="mr-1">❌</span> One special character (@$!%*#?&)</li>
                    </ul>
                    <p class="text-xs text-blue-600 mt-2 font-medium">💡 Use a unique password you haven't used elsewhere to avoid security warnings.</p>
                </div>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Confirm Password</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="register-password-confirmation" class="w-full border rounded px-4 py-2 pr-12" autocomplete="new-password" required>
                    <button type="button" id="toggleRegisterPasswordConfirm" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700">
                        <i id="registerEyeIconConfirm" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="w-full bg-[#1D293D] hover:bg-[#ec4642] text-white py-2 rounded font-bold transition-all duration-300">
                Sign Up
            </button>
        </form>

        <p class="mt-4 text-sm text-gray-500 text-center">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-[#5a4bff] hover:underline">Log in</a>
        </p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('register-password');
    const lengthCheck = document.getElementById('length-check');
    const uppercaseCheck = document.getElementById('uppercase-check');
    const lowercaseCheck = document.getElementById('lowercase-check');
    const numberCheck = document.getElementById('number-check');
    const specialCheck = document.getElementById('special-check');

    passwordInput.addEventListener('input', function() {
        const password = this.value;

        // Check length (at least 8 characters)
        if (password.length >= 8) {
            lengthCheck.innerHTML = '<span class="mr-1">✅</span> At least 8 characters';
            lengthCheck.classList.remove('text-red-600');
            lengthCheck.classList.add('text-green-600');
        } else {
            lengthCheck.innerHTML = '<span class="mr-1">❌</span> At least 8 characters';
            lengthCheck.classList.remove('text-green-600');
            lengthCheck.classList.add('text-red-600');
        }

        // Check uppercase
        if (/[A-Z]/.test(password)) {
            uppercaseCheck.innerHTML = '<span class="mr-1">✅</span> One uppercase letter (A-Z)';
            uppercaseCheck.classList.remove('text-red-600');
            uppercaseCheck.classList.add('text-green-600');
        } else {
            uppercaseCheck.innerHTML = '<span class="mr-1">❌</span> One uppercase letter (A-Z)';
            uppercaseCheck.classList.remove('text-green-600');
            uppercaseCheck.classList.add('text-red-600');
        }

        // Check lowercase
        if (/[a-z]/.test(password)) {
            lowercaseCheck.innerHTML = '<span class="mr-1">✅</span> One lowercase letter (a-z)';
            lowercaseCheck.classList.remove('text-red-600');
            lowercaseCheck.classList.add('text-green-600');
        } else {
            lowercaseCheck.innerHTML = '<span class="mr-1">❌</span> One lowercase letter (a-z)';
            lowercaseCheck.classList.remove('text-green-600');
            lowercaseCheck.classList.add('text-red-600');
        }

        // Check number
        if (/[0-9]/.test(password)) {
            numberCheck.innerHTML = '<span class="mr-1">✅</span> One number (0-9)';
            numberCheck.classList.remove('text-red-600');
            numberCheck.classList.add('text-green-600');
        } else {
            numberCheck.innerHTML = '<span class="mr-1">❌</span> One number (0-9)';
            numberCheck.classList.remove('text-green-600');
            numberCheck.classList.add('text-red-600');
        }

        // Check special character
        if (/[@$!%*#?&]/.test(password)) {
            specialCheck.innerHTML = '<span class="mr-1">✅</span> One special character (@$!%*#?&)';
            specialCheck.classList.remove('text-red-600');
            specialCheck.classList.add('text-green-600');
        } else {
            specialCheck.innerHTML = '<span class="mr-1">❌</span> One special character (@$!%*#?&)';
            specialCheck.classList.remove('text-green-600');
            specialCheck.classList.add('text-red-600');
        }
    });
});

// Password toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('toggleRegisterPassword');
    const passwordField = document.getElementById('register-password');
    const eyeIcon = document.getElementById('registerEyeIcon');

    togglePassword.addEventListener('click', function() {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });

    // Confirm password toggle functionality
    const togglePasswordConfirm = document.getElementById('toggleRegisterPasswordConfirm');
    const passwordConfirmField = document.getElementById('register-password-confirmation');
    const eyeIconConfirm = document.getElementById('registerEyeIconConfirm');

    togglePasswordConfirm.addEventListener('click', function() {
        if (passwordConfirmField.type === 'password') {
            passwordConfirmField.type = 'text';
            eyeIconConfirm.classList.remove('fa-eye');
            eyeIconConfirm.classList.add('fa-eye-slash');
        } else {
            passwordConfirmField.type = 'password';
            eyeIconConfirm.classList.remove('fa-eye-slash');
            eyeIconConfirm.classList.add('fa-eye');
        }
    });
});
</script>
@endsection
