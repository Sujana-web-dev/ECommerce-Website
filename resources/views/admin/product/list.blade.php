@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-slate-50 to-blue-50">
    <!-- Header Section with Custom Color -->
    <div class="bg-gradient-to-r from-[#1D293D] to-gray-900 shadow-2xl">
        <div class="px-6 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center text-sm text-gray-300 mb-3">
                <span class="hover:text-white transition-colors">Dashboard</span>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-white font-medium">{{ $pageTitle ?? 'Products' }}</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-white mb-1">{{ $pageTitle ?? 'Products' }}</h1>
                    <p class="text-gray-200">Manage your product inventory</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('product.add') }}"
                        class="px-6 py-3 bg-gradient-to-r from-[#ec4642] to-red-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        Add New Product
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 space-y-6">
        {{-- Search Box --}}
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-xl p-6">
            <form method="GET" class="flex items-center gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products by name, category, or details..."
                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/80 backdrop-blur-sm transition-all duration-200" />
                </div>
                <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-[#1D293D] to-gray-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                    Search
                </button>
            </form>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 px-6 py-4 rounded-xl text-green-800 shadow-sm">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle text-green-600"></i>
                {{ session('success') }}
            </div>
        </div>
        @endif

        {{-- Enhanced Table Layout --}}
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20">
            {{-- Table Header --}}
            <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white">Products List</h3>
                    <div class="text-sm text-gray-300">
                        <span>Showing {{ $products->count() }} of {{ $products->total() }} products</span>
                    </div>
                </div>
            </div>

            @if($products->count() > 0)
            {{-- Compact Table --}}
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                        <tr>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-16">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-hashtag text-[#1D293D] text-xs"></i>
                                    <span>ID</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-72">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-cube text-[#1D293D] text-xs"></i>
                                    <span>Product</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-24">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-tags text-[#1D293D] text-xs"></i>
                                    <span>Category</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-20">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-money-bill text-[#1D293D] text-xs"></i>
                                    <span>Price</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-20">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-boxes text-[#1D293D] text-xs"></i>
                                    <span>Stock</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-48">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-info-circle text-[#1D293D] text-xs"></i>
                                    <span>Details</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-28">
                                <div class="flex items-center justify-center gap-1">
                                    <i class="fas fa-cogs text-[#1D293D] text-xs"></i>
                                    <span>Actions</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($products as $index => $product)
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                            {{-- Product ID --}}
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="w-8 h-8 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded-lg flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-200">
                                    <span class="text-white font-bold text-xs">{{ $product->id }}</span>
                                </div>
                            </td>

                            {{-- Product Info (Compact) --}}
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <div class="relative flex-shrink-0">
                                        @if($product->image)
                                            <img class="h-12 w-12 rounded-lg object-cover shadow-md border border-white group-hover:scale-105 transition-transform duration-200"
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='flex';"
                                                loading="lazy">
                                            <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center shadow-md border border-white group-hover:scale-105 transition-transform duration-200" style="display:none;">
                                                <i class="fas fa-image text-gray-500 text-lg"></i>
                                            </div>
                                        @else
                                            <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center shadow-md border border-white group-hover:scale-105 transition-transform duration-200">
                                                <i class="fas fa-image text-gray-500 text-lg"></i>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-gray-900 group-hover:text-[#1D293D] transition-colors duration-200 truncate" title="{{ $product->name }}">
                                            {{ Str::limit($product->name, 25) }}
                                        </p>
                                        <div class="flex items-center mt-0.5">
                                            <div class="flex text-yellow-400 text-xs">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= 4 ? '' : 'opacity-30' }}" style="font-size: 10px;"></i>
                                                    @endfor
                                            </div>
                                            <span class="ml-1 text-xs text-gray-500">(4.0)</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Category (Compact) --}}
                            <td class="px-3 py-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 border border-purple-200 shadow-sm group-hover:shadow-md transition-shadow duration-200" title="{{ $product->category->name ?? 'N/A' }}">
                                    <i class="fas fa-tag mr-1 text-xs"></i>
                                    {{ Str::limit($product->category->name ?? 'N/A', 12) }}
                                </span>
                            </td>

                            {{-- Price (Compact) --}}
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-center">
                                    <div class="text-sm font-bold text-green-600 group-hover:text-green-700 transition-colors duration-200">
                                        TK: {{ number_format($product->amount, 0) }}
                                    </div>
                                    <div class="text-xs text-gray-500 line-through">TK: {{ number_format($product->amount * 1.2, 0) }}</div>
                                </div>
                            </td>

                            {{-- Stock Status (Compact) --}}
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-center space-y-1">
                                    @if($product->stock > 10)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1 animate-pulse"></div>
                                        Available
                                    </span>
                                    @elseif($product->stock > 0)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200 shadow-sm">
                                        <div class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1 animate-pulse"></div>
                                        Low
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200 shadow-sm">
                                        <div class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1"></div>
                                        Out
                                    </span>
                                    @endif
                                    <div class="flex items-center justify-center text-xs text-gray-600">
                                        <i class="fas fa-boxes text-[#ec4642] mr-1 text-xs"></i>
                                        <span class="font-medium">{{ $product->stock }}</span>
                                    </div>
                                </div>
                            </td>

                            {{-- Details (Compact) --}}
                            <td class="px-3 py-3">
                                <div class="max-w-xs">
                                    <p class="text-xs text-gray-600 line-clamp-2 leading-tight" title="{{ $product->details }}">
                                        {{ Str::limit($product->details, 50) }}
                                    </p>
                                    @if(strlen($product->details) > 50)
                                    <button onclick="showFullDetails('{{ addslashes($product->details) }}')"
                                        class="text-xs text-blue-600 hover:text-blue-800 font-medium mt-0.5 transition-colors duration-200">
                                        More...
                                    </button>
                                    @endif
                                </div>
                            </td>

                            {{-- Actions (Compact) --}}
                            <td class="px-3 py-3 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center space-x-1">
                                    {{-- Quick View Button --}}
                                    <button onclick="quickView({{ $product->id }})"
                                        class="w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-md flex items-center justify-center transition-all duration-200 transform hover:scale-110 shadow-sm hover:shadow-md"
                                        title="Quick View">
                                        <i class="fas fa-eye text-xs"></i>
                                    </button>

                                    {{-- Edit Button --}}
                                    <a href="{{ route('product.edit', $product->id) }}"
                                        class="w-8 h-8 bg-gradient-to-r from-[#1D293D] to-gray-700 hover:from-gray-700 hover:to-[#1D293D] text-white rounded-md flex items-center justify-center transition-all duration-200 transform hover:scale-110 shadow-sm hover:shadow-md"
                                        title="Edit Product">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>

                                    {{-- Delete Button --}}
                                    <a href="{{ route('product.delete', $product->id) }}"
                                        class="w-8 h-8 bg-gradient-to-r from-[#ec4642] to-red-600 hover:from-red-600 hover:to-[#ec4642] text-white rounded-md flex items-center justify-center transition-all duration-200 transform hover:scale-110 shadow-sm hover:shadow-md"
                                        onclick="return handleDelete(event, '{{ $product->name }}', '{{ route('product.delete', $product->id) }}')"
                                        title="Delete Product">
                                        <i class="fas fa-trash text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            
            {{-- Enhanced Pagination --}}
            @if($products->hasPages())
            <div class="mt-8 flex justify-center">
                <div class="bg-white rounded-xl shadow-lg p-2">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>

            @else
            {{-- Enhanced Empty State --}}
            <div class="p-16 text-center">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-blue-100 rounded-full flex items-center justify-center mb-8 relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full opacity-20 animate-ping"></div>
                        <i class="fas fa-box-open text-6xl text-transparent bg-gradient-to-r from-gray-400 to-blue-500 bg-clip-text relative z-10"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-transparent bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text mb-4">No Products Found</h3>
                    <p class="text-gray-500 mb-8 text-lg max-w-md">
                        @if(request('search'))
                        No products match your search criteria. Try adjusting your search terms.
                        @else
                        Get started by adding your first product to showcase your inventory.
                        @endif
                    </p>
                    <div class="flex gap-4">
                        @if(request('search'))
                        <a href="{{ route('product.list') }}"
                            class="px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                            <i class="fas fa-list"></i>
                            View All Products
                        </a>
                        @endif
                        <a href="{{ route('product.add') }}"
                            class="px-6 py-3 bg-gradient-to-r from-[#ec4642] to-red-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Add Your First Product
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Quick View Modal --}}
<div id="quickViewModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95" id="modalContent">
            {{-- Modal Header --}}
            <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">Product Details</h3>
                    <button onclick="closeQuickView()" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-colors duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            {{-- Modal Body --}}
            <div class="p-6" id="modalBody">
                <div class="text-center">
                    <i class="fas fa-spinner fa-spin text-4xl text-gray-400"></i>
                    <p class="text-gray-500 mt-4">Loading product details...</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Details Modal --}}
<div id="detailsModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl max-w-lg w-full transform transition-all duration-300 scale-95">
            <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-white">Product Details</h3>
                    <button onclick="closeDetailsModal()" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-colors duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-700 leading-relaxed" id="fullDetails"></p>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Compact Table Styles */
    .compact-table {
        font-size: 0.875rem;
    }

    .compact-table td,
    .compact-table th {
        padding: 0.75rem 0.5rem;
    }

    .compact-table .action-btn {
        width: 2rem;
        height: 2rem;
        font-size: 0.75rem;
    }

    /* Fixed column widths to prevent overflow */
    table {
        table-layout: fixed;
        width: 100%;
    }

    /* Animation for modal */
    .modal-show {
        transform: scale(1) !important;
    }

    /* Responsive adjustments */
    @media (max-width: 1280px) {
        .compact-table {
            font-size: 0.8125rem;
        }
    }

    @media (max-width: 1024px) {
        .compact-table {
            font-size: 0.75rem;
        }

        .compact-table td,
        .compact-table th {
            padding: 0.5rem 0.375rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Quick View Modal Functions
    function quickView(productId) {
        const modal = document.getElementById('quickViewModal');
        const modalContent = document.getElementById('modalContent');
        const modalBody = document.getElementById('modalBody');

        // Show modal
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.add('modal-show');
        }, 10);

        // Simulate loading product data (replace with actual AJAX call)
        setTimeout(() => {
            modalBody.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <img src="/path/to/product/image" class="w-full h-64 object-cover rounded-xl" alt="Product Image">
                </div>
                <div class="space-y-4">
                    <h4 class="text-xl font-bold text-[#1D293D]">Product Name</h4>
                    <p class="text-gray-600">Product details and description...</p>
                    <div class="flex items-center gap-4">
                        <span class="text-2xl font-bold text-green-600">TK: 1,500</span>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">In Stock</span>
                    </div>
                </div>
            </div>
        `;
        }, 500);
    }

    function closeQuickView() {
        const modal = document.getElementById('quickViewModal');
        const modalContent = document.getElementById('modalContent');

        modalContent.classList.remove('modal-show');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Details Modal Functions
    function showFullDetails(details) {
        const modal = document.getElementById('detailsModal');
        const fullDetailsElement = document.getElementById('fullDetails');

        fullDetailsElement.textContent = details;
        modal.classList.remove('hidden');
    }

    function closeDetailsModal() {
        const modal = document.getElementById('detailsModal');
        modal.classList.add('hidden');
    }

    // Close modals when clicking outside
    document.getElementById('quickViewModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeQuickView();
        }
    });

    document.getElementById('detailsModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetailsModal();
        }
    });

    // Close modals with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeQuickView();
            closeDetailsModal();
        }
    });

    // Custom delete handler
    async function handleDelete(event, productName, deleteUrl) {
        event.preventDefault();
        
        const confirmed = await adminConfirm({
            type: 'delete',
            title: 'Delete Product',
            subtitle: 'This action cannot be undone',
            message: `Are you sure you want to delete "${productName}"? This will permanently remove the product and all associated data.`,
            confirmText: 'Delete Product'
        });

        if (confirmed) {
            // Show loading state
            event.target.innerHTML = '<i class="fas fa-spinner fa-spin text-xs"></i>';
            event.target.style.pointerEvents = 'none';
            
            try {
                window.location.href = deleteUrl;
            } catch (error) {
                console.error('Delete error:', error);
                showAdminSuccess('Error', 'Failed to delete product. Please try again.');
            }
        }
        
        return false;
    }
</script>
@endpush
@endsection