@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Get in Touch</h1>
            <p class="text-xl text-gray-600">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Send us a Message</h2>
                
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
                            <input type="text" name="name" id="name" value="{{ auth()->check() ? auth()->user()->name : old('name') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ auth()->check() ? auth()->user()->email : old('email') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Message Category</label>
                        <select name="category" id="category" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                required>
                            <option value="">Select a category</option>
                            <option value="general" {{ old('category') === 'general' ? 'selected' : '' }}>General Inquiry</option>
                            <option value="support" {{ old('category') === 'support' ? 'selected' : '' }}>Technical Support</option>
                            <option value="sales" {{ old('category') === 'sales' ? 'selected' : '' }}>Sales Inquiry</option>
                            <option value="complaint" {{ old('category') === 'complaint' ? 'selected' : '' }}>Complaint</option>
                            <option value="feedback" {{ old('category') === 'feedback' ? 'selected' : '' }}>Feedback</option>
                            <option value="refund" {{ old('category') === 'refund' ? 'selected' : '' }}>Refund Request</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               required>
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea name="message" id="message" rows="6" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg transition-colors duration-300 transform hover:scale-105">
                        <i class="fas fa-paper-plane mr-2"></i>Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl shadow-lg p-8 text-white">
                <h2 class="text-2xl font-bold mb-6">Contact Information</h2>
                
                <div class="space-y-6">
                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-lg mr-4">
                            <i class="fas fa-map-marker-alt text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Address</h3>
                            <p class="text-blue-100">123 E-Commerce Street<br>Digital City, DC 12345</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-lg mr-4">
                            <i class="fas fa-phone text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Phone</h3>
                            <p class="text-blue-100">+1 (555) 123-4567</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-lg mr-4">
                            <i class="fas fa-envelope text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Email</h3>
                            <p class="text-blue-100">support@easycart.com</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="bg-white/20 p-3 rounded-lg mr-4">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Business Hours</h3>
                            <p class="text-blue-100">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-white/20">
                    <h3 class="font-semibold mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-white/20 p-3 rounded-lg hover:bg-white/30 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-white/20 p-3 rounded-lg hover:bg-white/30 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-white/20 p-3 rounded-lg hover:bg-white/30 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-white/20 p-3 rounded-lg hover:bg-white/30 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
