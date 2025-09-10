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
                <input type="text" name="name" class="w-full border rounded px-4 py-2" value="{{ old('name') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" class="w-full border rounded px-4 py-2" value="{{ old('email') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Password</label>
                <input type="password" name="password" class="w-full border rounded px-4 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full border rounded px-4 py-2" required>
            </div>
            <button type="submit" class="w-full bg-[#1D293D] hover:bg-[#ec4642] text-white py-2 rounded font-bold transition-all duration-300">
                Sign Up
            </button>
        </form>

        <p class="mt-4 text-sm text-gray-500 text-center">
            Already have an account? 
            <a href="#" id="openLoginModal" class="text-[#5a4bff] hover:underline">Log in</a>
        </p>
    </div>
</div>

<script>
document.getElementById('openLoginModal')?.addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('signupModal')?.classList.add('hidden');
    document.getElementById('loginModal')?.classList.remove('hidden');
});
</script>
@endsection
