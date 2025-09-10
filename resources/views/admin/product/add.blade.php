
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
                <span class="text-white font-medium">{{ $pageTitle ?? 'Products' }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-white mb-1">{{ $pageTitle ?? 'Products' }}</h1>
                    <p class="text-gray-200">{{ isset($product) ? 'Edit product information' : 'Add a new product to your inventory' }}</p>
                </div>
                <div class="hidden lg:block">
                    <div class="w-12 h-12 bg-gradient-to-r from-[#ec4642] to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas {{ isset($product) ? 'fa-edit' : 'fa-plus' }} text-white text-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white/90 backdrop-blur-lg shadow-2xl rounded-2xl overflow-hidden border border-white/20">
                
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

                <div class="p-6">
                    {{-- Edit Form --}}
                    @if(isset($product))
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded-lg flex items-center justify-center shadow-lg">
                                <i class="fas fa-edit text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-[#1D293D]">Edit Product</h3>
                                <p class="text-gray-600 text-sm">Update product information</p>
                            </div>
                        </div>

                        <form action="{{ route('product.edit.post') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                {{-- Name --}}
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-[#1D293D]">
                                        <i class="fas fa-tag text-[#ec4642] mr-2"></i>
                                        Product Name <span class="text-[#ec4642]">*</span>
                                    </label>
                                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md"
                                        placeholder="Enter product name" required>
                                </div>

                                {{-- Category --}}
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-[#1D293D]">
                                        <i class="fas fa-list text-[#ec4642] mr-2"></i>
                                        Category <span class="text-[#ec4642]">*</span>
                                    </label>
                                    <select name="cat_id"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md"
                                        required>
                                        <option value="">Select category</option>
                                        @foreach($category as $cat)
                                        <option value="{{ $cat->id }}" {{ $product->cat_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Amount --}}
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-[#1D293D]">
                                        <i class="fas fa-dollar-sign text-[#ec4642] mr-2"></i>
                                        Product Amount <span class="text-[#ec4642]">*</span>
                                    </label>
                                    <input type="text" name="amount" value="{{ old('amount', $product->amount) }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md"
                                        placeholder="Enter product amount" required>
                                </div>

                                {{-- Stock --}}
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-[#1D293D]">
                                        <i class="fas fa-boxes text-[#ec4642] mr-2"></i>
                                        Product Stock <span class="text-[#ec4642]">*</span>
                                    </label>
                                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md"
                                        placeholder="Enter product stock" required>
                                </div>
                            </div>

                            {{-- Details --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-[#1D293D]">
                                    <i class="fas fa-align-left text-[#ec4642] mr-2"></i>
                                    Product Details <span class="text-[#ec4642]">*</span>
                                </label>
                                <textarea name="details" rows="4"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md resize-none"
                                    placeholder="Enter product details" required>{{ old('details', $product->details) }}</textarea>
                            </div>

                            {{-- Image --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-[#1D293D]">
                                    <i class="fas fa-image text-[#ec4642] mr-2"></i>
                                    Upload Image
                                </label>
                                <div class="flex items-center gap-4">
                                    <input type="file" name="image"
                                        class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md">
                                    
                                    @if($product->image)
                                    <div class="w-16 h-16 rounded-xl overflow-hidden shadow-lg border-2 border-white">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full px-6 py-3 bg-gradient-to-r from-[#1D293D] to-gray-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.01] transition-all duration-300 flex items-center justify-center gap-2">
                                    <i class="fas fa-save"></i>
                                    Update Product
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Add Form --}}
                    @else
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-r from-[#ec4642] to-red-600 rounded-lg flex items-center justify-center shadow-lg">
                                <i class="fas fa-plus text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-[#1D293D]">Add Product</h3>
                                <p class="text-gray-600 text-sm">Create a new product entry</p>
                            </div>
                        </div>

                        <form action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                {{-- Name --}}
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-[#1D293D]">
                                        <i class="fas fa-tag text-[#ec4642] mr-2"></i>
                                        Product Name <span class="text-[#ec4642]">*</span>
                                    </label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md"
                                        placeholder="Enter product name" required>
                                </div>

                                {{-- Category --}}
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-[#1D293D]">
                                        <i class="fas fa-list text-[#ec4642] mr-2"></i>
                                        Category <span class="text-[#ec4642]">*</span>
                                    </label>
                                    <select name="cat_id"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md"
                                        required>
                                        <option value="">Select category</option>
                                        @foreach($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Amount --}}
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-[#1D293D]">
                                        <i class="fas fa-dollar-sign text-[#ec4642] mr-2"></i>
                                        Product Amount <span class="text-[#ec4642]">*</span>
                                    </label>
                                    <input type="text" name="amount" value="{{ old('amount') }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md"
                                        placeholder="Enter product amount" required>
                                </div>

                                {{-- Stock --}}
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-[#1D293D]">
                                        <i class="fas fa-boxes text-[#ec4642] mr-2"></i>
                                        Product Stock <span class="text-[#ec4642]">*</span>
                                    </label>
                                    <input type="number" name="stock" value="{{ old('stock') }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md"
                                        placeholder="Enter product stock" required>
                                </div>
                            </div>

                            {{-- Details --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-[#1D293D]">
                                    <i class="fas fa-align-left text-[#ec4642] mr-2"></i>
                                    Product Details <span class="text-[#ec4642]">*</span>
                                </label>
                                <textarea name="details" rows="4"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md resize-none"
                                    placeholder="Enter product details" required>{{ old('details') }}</textarea>
                            </div>

                            {{-- Image --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-[#1D293D]">
                                    <i class="fas fa-image text-[#ec4642] mr-2"></i>
                                    Upload Image
                                </label>
                                <input type="file" name="image"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/90 backdrop-blur-sm transition-all duration-300 shadow-sm hover:shadow-md">
                            </div>

                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full px-6 py-3 bg-gradient-to-r from-[#ec4642] to-red-600 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.01] transition-all duration-300 flex items-center justify-center gap-2">
                                    <i class="fas fa-plus"></i>
                                    Add Product
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle form submissions with custom confirmations
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            
            const action = form.getAttribute('action');
            const isEdit = action.includes('edit');
            const isCreate = action.includes('create');
            
            let confirmOptions = {};
            
            if (isEdit) {
                confirmOptions = {
                    type: 'edit',
                    title: 'Update Product',
                    subtitle: 'Save changes',
                    message: 'Are you sure you want to update this product with the new information?',
                    confirmText: 'Update Product'
                };
            } else if (isCreate) {
                confirmOptions = {
                    type: 'add',
                    title: 'Add Product',
                    subtitle: 'Create new product',
                    message: 'Are you sure you want to add this new product to your inventory?',
                    confirmText: 'Add Product'
                };
            }
            
            if (Object.keys(confirmOptions).length > 0) {
                const confirmed = await adminConfirm(confirmOptions);
                
                if (confirmed) {
                    // Show loading state
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const originalContent = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
                    submitBtn.disabled = true;
                    
                    // Submit the form
                    form.submit();
                }
            } else {
                // Submit normally if no confirmation needed
                form.submit();
            }
        });
    });
});
</script>

@endsection