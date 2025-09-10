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
                <span class="text-white font-medium">Customer Management</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-white mb-1">👥 Customer Management</h1>
                    <p class="text-gray-200">Manage customers who have placed orders</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('customers.reviews') }}"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-star"></i>
                        Customer Reviews
                    </a>
                    <button onclick="exportCustomers()"
                        class="px-6 py-3 bg-gradient-to-r from-[#ec4642] to-red-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-download"></i>
                        Export Data
                    </button>
                </div>
            </div>

            <!-- Customer Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-blue-300">{{ $users->count() }}</div>
                    <div class="text-sm text-gray-300">Total Customers</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-green-300">{{ $users->where('created_at', '>=', now()->subDays(30))->count() }}</div>
                    <div class="text-sm text-gray-300">Active (30 days)</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-purple-300">{{ $users->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                    <div class="text-sm text-gray-300">New This Month</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    @php
                        $totalOrders = \App\Models\Order::whereIn('user_id', $users->pluck('id'))->count();
                    @endphp
                    <div class="text-2xl font-bold text-orange-300">{{ $totalOrders }}</div>
                    <div class="text-sm text-gray-300">Total Orders</div>
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
                        placeholder="Search customers by name, email, or username..."
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
                    <h3 class="text-lg font-semibold text-white">Customer List</h3>
                    <div class="text-sm text-gray-300">
                        <span>Showing {{ $users->count() }} customers</span>
                    </div>
                </div>
            </div>

            @if($users->count() > 0)
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
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-24">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-user text-[#1D293D] text-xs"></i>
                                    <span>Customer</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-24">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-envelope text-[#1D293D] text-xs"></i>
                                    <span>Contact Info</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-20">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-user-tag text-[#1D293D] text-xs"></i>
                                    <span>Role</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-20">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-calendar text-[#1D293D] text-xs"></i>
                                    <span>Join Date</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-14">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-shopping-cart text-[#1D293D] text-xs"></i>
                                    <span>Orders</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider w-28">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-money-bill text-[#1D293D] text-xs"></i>
                                    <span>Total Spent</span>
                                </div>
                            </th>
                            <th class="px-3 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider w-32">
                                <div class="flex items-center justify-center gap-1">
                                    <i class="fas fa-cogs text-[#1D293D] text-xs"></i>
                                    <span>Actions</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                        @php
                            $userOrders = \App\Models\Order::where('user_id', $user->id)->get();
                            $totalSpent = $userOrders->sum('total');
                            $orderCount = $userOrders->count();
                            $lastOrder = $userOrders->sortByDesc('created_at')->first();
                        @endphp
                        <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group">
                            {{-- Customer ID --}}
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="w-8 h-8 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded-lg flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-200">
                                    <span class="text-white font-bold text-xs">{{ $user->id }}</span>
                                </div>
                            </td>

                            {{-- Customer Info --}}
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <div class="relative flex-shrink-0">
                                        <div class="h-12 w-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-md border border-white group-hover:scale-105 transition-transform duration-200">
                                            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        @if($lastOrder && $lastOrder->created_at >= now()->subDays(7))
                                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-gray-900 group-hover:text-[#1D293D] transition-colors duration-200 truncate" title="{{ $user->name }}">
                                            {{ $user->name ?? 'Unknown' }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Contact Info --}}
                            <td class="px-3 py-3">
                                <div class="space-y-1">
                                    <div class="text-xs text-gray-600 flex items-center">
                                        <i class="fas fa-envelope text-blue-500 mr-2 text-xs"></i>
                                        <span class="truncate" title="{{ $user->email }}">{{ Str::limit($user->email ?? 'No email', 25) }}</span>
                                    </div>
                                    <div class="text-xs text-gray-600 flex items-center">
                                        <i class="fas fa-calendar text-purple-500 mr-2 text-xs"></i>
                                        @if($lastOrder)
                                        <span>Last order: {{ $lastOrder->created_at->diffForHumans() }}</span>
                                        @else
                                        <span class="text-gray-400">No orders yet</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Role --}}
                            <td class="px-3 py-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200 shadow-sm group-hover:shadow-md transition-shadow duration-200">
                                    <i class="fas fa-user mr-1 text-xs"></i>
                                    {{ ucfirst($user->role ?? $user->user_type ?? 'Customer') }}
                                </span>
                            </td>

                            {{-- Join Date --}}
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-center">
                                    <div class="text-xs font-medium text-gray-900">
                                        {{ $user->created_at ? $user->created_at->format('M d, Y') : 'Unknown' }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $user->created_at ? $user->created_at->diffForHumans() : '' }}
                                    </div>
                                </div>
                            </td>

                            {{-- Orders --}}
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-center space-y-1">
                                    @if($orderCount > 0)
                                    <div class="text-sm font-bold text-blue-600 group-hover:text-blue-700 transition-colors duration-200">
                                        {{ $orderCount }}
                                    </div>
                                    <div class="flex items-center justify-center text-xs text-gray-600">
                                        <i class="fas fa-shopping-bag text-[#1D293D] mr-1 text-xs"></i>
                                        <span>orders</span>
                                    </div>
                                    @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 border border-gray-200 shadow-sm">
                                        No orders
                                    </span>
                                    @endif
                                </div>
                            </td>

                            {{-- Total Spent --}}
                            <td class="px-3 py-3 whitespace-nowrap">
                                <div class="text-center">
                                    @if($totalSpent > 0)
                                    <div class="text-sm font-bold text-green-600 group-hover:text-green-700 transition-colors duration-200">
                                        TK: {{ number_format($totalSpent, 0) }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        Avg: TK {{ $orderCount > 0 ? number_format($totalSpent / $orderCount, 0) : 0 }}
                                    </div>
                                    @else
                                    <span class="text-xs text-gray-400">TK: 0</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Actions --}}
                            <td class="px-3 py-3 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center space-x-1">
                                    {{-- View Customer Details --}}
                                    <button onclick="viewCustomer({{ $user->id }})"
                                        class="w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-md flex items-center justify-center transition-all duration-200 transform hover:scale-110 shadow-sm hover:shadow-md"
                                        title="View Customer Details">
                                        <i class="fas fa-eye text-xs"></i>
                                    </button>

                                    {{-- View Orders --}}
                                    @if($orderCount > 0)
                                    <a href="{{ route('orders') }}?customer={{ $user->id }}"
                                        class="w-8 h-8 bg-gradient-to-r from-[#1D293D] to-gray-700 hover:from-gray-700 hover:to-[#1D293D] text-white rounded-md flex items-center justify-center transition-all duration-200 transform hover:scale-110 shadow-sm hover:shadow-md"
                                        title="View Customer Orders">
                                        <i class="fas fa-shopping-bag text-xs"></i>
                                    </a>
                                    @endif

                                    {{-- Contact Customer --}}
                                    <button onclick="contactCustomer('{{ $user->email }}')"
                                        class="w-8 h-8 bg-gradient-to-r from-[#ec4642] to-red-600 hover:from-red-600 hover:to-[#ec4642] text-white rounded-md flex items-center justify-center transition-all duration-200 transform hover:scale-110 shadow-sm hover:shadow-md"
                                        title="Contact Customer">
                                        <i class="fas fa-envelope text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            {{-- Enhanced Empty State --}}
            <div class="p-16 text-center">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-blue-100 rounded-full flex items-center justify-center mb-8 relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full opacity-20 animate-ping"></div>
                        <i class="fas fa-users text-6xl text-transparent bg-gradient-to-r from-gray-400 to-blue-500 bg-clip-text relative z-10"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-transparent bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text mb-4">No Customers Found</h3>
                    <p class="text-gray-500 mb-8 text-lg max-w-md">
                        @if(request('search'))
                        No customers match your search criteria. Try adjusting your search terms.
                        @else
                        No customers have registered or placed orders yet. They will appear here once they start using your platform.
                        @endif
                    </p>
                    @if(request('search'))
                    <a href="{{ route('customers.list') }}"
                        class="px-6 py-3 bg-gradient-to-r from-[#1D293D] to-gray-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-users"></i>
                        View All Customers
                    </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Customer Details Modal --}}
<div id="customerModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95" id="modalContent">
            {{-- Modal Header --}}
            <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">Customer Details</h3>
                    <button onclick="closeCustomerModal()" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-colors duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            {{-- Modal Body --}}
            <div class="p-6" id="modalBody">
                <div class="text-center">
                    <i class="fas fa-spinner fa-spin text-4xl text-gray-400"></i>
                    <p class="text-gray-500 mt-4">Loading customer details...</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Compact Table Styles */
    .compact-table {
        font-size: 0.875rem;
    }

    .compact-table td,
    .compact-table th {
        padding: 0.75rem 0.5rem;
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

    /* Custom scrollbar styling */
    .scrollbar-thin {
        scrollbar-width: thin;
    }

    .scrollbar-thin::-webkit-scrollbar {
        height: 8px;
        width: 8px;
    }

    .scrollbar-thin::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
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
    // View Customer Details
    function viewCustomer(customerId) {
        const modal = document.getElementById('customerModal');
        const modalContent = document.getElementById('modalContent');
        const modalBody = document.getElementById('modalBody');

        // Show modal
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.add('modal-show');
        }, 10);

        // Show loading state
        modalBody.innerHTML = `
            <div class="text-center">
                <i class="fas fa-spinner fa-spin text-4xl text-gray-400"></i>
                <p class="text-gray-500 mt-4">Loading customer details...</p>
            </div>
        `;

        // Fetch customer data via AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
        
        fetch(`/customers/${customerId}/details`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const customer = data.customer;
                const orders = data.orders;
                const totalSpent = data.total_spent;
                const lastOrder = data.last_order;
                
                modalBody.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="text-center mb-4">
                                <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-2xl mx-auto mb-3 shadow-lg">
                                    ${customer.name ? customer.name.charAt(0).toUpperCase() : 'U'}
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">${customer.name || 'Unknown Customer'}</h3>
                                <p class="text-sm text-gray-500">Customer ID: #${customer.id}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-envelope text-blue-500 mr-2"></i>Email Address
                                </label>
                                <p class="text-gray-900 bg-gray-50 p-2 rounded">${customer.email || 'Not provided'}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-user text-green-500 mr-2"></i>Username
                                </label>
                                <p class="text-gray-900 bg-gray-50 p-2 rounded">${customer.username || 'Not set'}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-user-tag text-purple-500 mr-2"></i>Role
                                </label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                    ${customer.role || customer.user_type || 'Customer'}
                                </span>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-calendar text-orange-500 mr-2"></i>Join Date
                                </label>
                                <p class="text-gray-900 bg-gray-50 p-2 rounded">${customer.created_at ? new Date(customer.created_at).toLocaleDateString() : 'Unknown'}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200">
                                <label class="block text-sm font-medium text-blue-700 mb-2">
                                    <i class="fas fa-shopping-cart mr-2"></i>Order Statistics
                                </label>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-blue-600">${orders.length}</div>
                                        <div class="text-xs text-blue-500">Total Orders</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-green-600">TK ${totalSpent.toLocaleString()}</div>
                                        <div class="text-xs text-green-500">Total Spent</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-clock text-purple-500 mr-2"></i>Last Order
                                </label>
                                ${lastOrder ? `
                                    <div class="bg-gray-50 p-3 rounded border">
                                        <p class="text-sm font-medium text-gray-800">Order #${lastOrder.id}</p>
                                        <p class="text-xs text-gray-600">TK ${lastOrder.total.toLocaleString()}</p>
                                        <p class="text-xs text-gray-500">${new Date(lastOrder.created_at).toLocaleDateString()}</p>
                                    </div>
                                ` : `
                                    <p class="text-gray-500 bg-gray-50 p-3 rounded border">No orders placed yet</p>
                                `}
                            </div>
                            
                            ${orders.length > 0 ? `
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-list text-indigo-500 mr-2"></i>Recent Orders
                                    </label>
                                    <div class="max-h-32 overflow-y-auto space-y-2">
                                        ${orders.slice(0, 3).map(order => `
                                            <div class="bg-white border border-gray-200 p-2 rounded text-xs">
                                                <div class="flex justify-between items-center">
                                                    <span class="font-medium">#${order.id}</span>
                                                    <span class="text-green-600 font-bold">TK ${order.total.toLocaleString()}</span>
                                                </div>
                                                <div class="text-gray-500">${new Date(order.created_at).toLocaleDateString()}</div>
                                            </div>
                                        `).join('')}
                                    </div>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                    
                    <div class="mt-6 flex gap-3">
                        ${orders.length > 0 ? `
                            <a href="/orders?customer=${customer.id}" class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors text-center">
                                <i class="fas fa-shopping-bag mr-2"></i>View All Orders
                            </a>
                        ` : ''}
                        
                        <button onclick="contactCustomer('${customer.email}')" class="flex-1 bg-[#ec4642] text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-envelope mr-2"></i>Send Email
                        </button>
                        
                        <button onclick="closeCustomerModal()" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                            <i class="fas fa-times mr-2"></i>Close
                        </button>
                    </div>
                `;
            } else {
                modalBody.innerHTML = `
                    <div class="text-center text-red-600">
                        <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                        <p class="text-lg font-semibold mb-2">Error Loading Customer</p>
                        <p class="text-sm">${data.message || 'Unable to load customer details. Please try again.'}</p>
                        <button onclick="closeCustomerModal()" class="mt-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Close
                        </button>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            modalBody.innerHTML = `
                <div class="text-center text-red-600">
                    <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                    <p class="text-lg font-semibold mb-2">Connection Error</p>
                    <p class="text-sm">Unable to connect to the server. Please check your connection and try again.</p>
                    <button onclick="closeCustomerModal()" class="mt-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Close
                    </button>
                </div>
            `;
        });
    }

    // Close Customer Modal
    function closeCustomerModal() {
        const modal = document.getElementById('customerModal');
        const modalContent = document.getElementById('modalContent');

        modalContent.classList.remove('modal-show');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Contact Customer
    function contactCustomer(email) {
        // You can implement email functionality or open default email client
        window.open(`mailto:${email}?subject=Hello from ${window.location.hostname}&body=Hello,\n\nI hope you are doing well.\n\nBest regards,\nAdmin Team`);
    }

    // Export Customers
    function exportCustomers() {
        // Implement export functionality
        alert('Export functionality would be implemented here');
    }

    // Close modal when clicking outside
    document.getElementById('customerModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCustomerModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCustomerModal();
        }
    });

    // Search functionality (if needed for client-side filtering)
    document.addEventListener('DOMContentLoaded', function() {
        // Additional initialization code can go here
        console.log('Customer List Page Loaded');
    });
</script>
@endpush
@endsection