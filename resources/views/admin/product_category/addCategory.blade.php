
@extends('admin.layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-slate-50 to-blue-50">
    <!-- Header Section with Custom Color -->
    <div class="bg-gradient-to-r from-[#1D293D] to-gray-900 shadow-2xl">
        <div class="px-6 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center text-sm text-gray-300 mb-3">
                <span class="hover:text-white transition-colors cursor-pointer">Dashboard</span>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-white font-medium">{{ $pageTitle ?? 'Categories' }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-white mb-1">{{ $pageTitle ?? 'Categories' }}</h1>
                    <p class="text-gray-200">{{ isset($category) ? 'Edit category information' : 'Add a new category to organize products' }}</p>
                </div>
                <div class="hidden lg:block">
                    <div class="w-12 h-12 bg-gradient-to-r from-[#ec4642] to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas {{ isset($category) ? 'fa-edit' : 'fa-plus' }} text-white text-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white/90 backdrop-blur-lg shadow-2xl rounded-2xl overflow-hidden border border-white/20">
                
                {{-- Success Message --}}
                @if (session('success'))
                <div class="mx-6 mt-6 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 px-6 py-4 text-green-800 shadow-sm">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-600"></i>
                        {{ session('success') }}
                    </div>
                </div>
                @endif

                {{-- Errors --}}
                @if ($errors->any())
                <div class="mx-6 mt-6 rounded-xl bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-[#ec4642] px-6 py-4 text-red-800 shadow-lg">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-6 h-6 bg-[#ec4642] rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                        </div>
                        <span class="font-medium">Please fix the following errors:</span>
                    </div>
                    <ul class="ml-8 space-y-1">
                        @foreach ($errors->all() as $error)
                        <li class="flex items-center gap-2 text-sm">
                            <div class="w-1 h-1 bg-[#ec4642] rounded-full"></div>
                            {{ $error }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-12 h-12 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas {{ isset($category) ? 'fa-edit' : 'fa-plus' }} text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-[#1D293D]">
                                {{ isset($category) ? 'Edit Category' : 'Add Category' }}
                            </h3>
                            <p class="text-gray-600 text-sm">{{ isset($category) ? 'Update category information' : 'Create a new category' }}</p>
                        </div>
                    </div>

                    <form action="{{ isset($category) ? route('category.update') : route('category.create') }}" method="POST" class="space-y-6">
                        @csrf
                        @if(isset($category))
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        @endif

                        {{-- Category Name --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-[#1D293D]">
                                <i class="fas fa-tag text-[#ec4642] mr-2"></i>
                                Category Name <span class="text-[#ec4642]">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md"
                                placeholder="Enter category name" required>
                        </div>

                        {{-- Category Details --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-[#1D293D]">
                                <i class="fas fa-align-left text-[#ec4642] mr-2"></i>
                                Category Details
                            </label>
                            <textarea name="details" rows="4"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md resize-none"
                                placeholder="Enter category details (optional)">{{ old('details', $category->details ?? '') }}</textarea>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full px-6 py-3 bg-gradient-to-r from-[#1D293D] to-gray-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.01] transition-all duration-300 flex items-center justify-center gap-2">
                                <i class="fas {{ isset($category) ? 'fa-save' : 'fa-plus' }}"></i>
                                {{ isset($category) ? 'Update Category' : 'Add Category' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection