
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
                    <p class="text-gray-200">Manage your product categories</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('category.add') }}"
                        class="px-6 py-3 bg-gradient-to-r from-[#ec4642] to-red-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        New Category
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 space-y-6">
        {{-- Search Box with Enhanced Design --}}
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
                        placeholder="Search categories by name..."
                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/80 backdrop-blur-sm transition-all duration-200" />
                </div>
                <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-[#1D293D] to-gray-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                    Search
                </button>
            </form>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white/80 backdrop-blur-sm shadow-2xl rounded-2xl overflow-hidden">
            {{-- Success Message --}}
            @if(session('success'))
            <div class="mx-6 mt-6 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 px-6 py-4 text-green-800 shadow-sm">
                <div class="flex items-center gap-2">
                    <i class="fas fa-check-circle text-green-600"></i>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-100 to-gray-200">
                                <th class="px-6 py-4 text-left font-medium text-[#1D293D] uppercase tracking-wider rounded-tl-xl">ID</th>
                                <th class="px-6 py-4 text-left font-medium text-[#1D293D] uppercase tracking-wider">Category Name</th>
                                <th class="px-6 py-4 text-left font-medium text-[#1D293D] uppercase tracking-wider rounded-tr-xl">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($categories as $category)
                            <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-gradient-to-r from-[#1D293D] to-gray-700 text-white text-sm font-medium rounded-full">
                                        {{ $category->id }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-[#1D293D] group-hover:text-blue-700 transition-colors">
                                        {{ $category->name }}
                                    </div>
                                    @if($category->details)
                                    <div class="text-sm text-gray-500 mt-1">{{ Str::limit($category->details, 50) }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#1D293D] to-gray-700 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                            <i class="fas fa-edit mr-1"></i>
                                            Edit
                                        </a>
                                        <a href="{{ route('category.delete', $category->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#ec4642] to-red-600 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200"
                                            onclick="return handleCategoryDelete(event, '{{ $category->name }}', '{{ route('category.delete', $category->id) }}')"
                                            <i class="fas fa-trash mr-1"></i>
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-16">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-folder-open text-4xl text-gray-400"></i>
                                        </div>
                                        <p class="text-xl font-medium text-gray-600 mb-2">No categories found</p>
                                        <p class="text-gray-500">Create your first category to get started</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Enhanced Pagination --}}
                @if($categories->hasPages())
                <div class="mt-8 flex justify-center">
                    <div class="bg-white rounded-xl shadow-lg p-2">
                        {{ $categories->appends(request()->query())->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// Custom category delete handler
async function handleCategoryDelete(event, categoryName, deleteUrl) {
    event.preventDefault();
    
    const confirmed = await adminConfirm({
        type: 'delete',
        title: 'Delete Category',
        subtitle: 'This action cannot be undone',
        message: `Are you sure you want to delete "${categoryName}"? This will permanently remove the category and may affect associated products.`,
        confirmText: 'Delete Category'
    });

    if (confirmed) {
        // Show loading state
        const button = event.target.closest('a');
        const originalContent = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Deleting...';
        button.style.pointerEvents = 'none';
        
        try {
            window.location.href = deleteUrl;
        } catch (error) {
            console.error('Delete error:', error);
            button.innerHTML = originalContent;
            button.style.pointerEvents = 'auto';
            showAdminSuccess('Error', 'Failed to delete category. Please try again.');
        }
    }
    
    return false;
}
</script>

@endsection
