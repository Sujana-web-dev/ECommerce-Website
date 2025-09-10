@extends('admin.layouts.app')

@section('title', 'Customer Reviews Management')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-slate-50 to-blue-50">
    <!-- Header Section with Custom Color -->
    <div class="bg-gradient-to-r from-[#1D293D] to-gray-900 shadow-2xl">
        <div class="px-6 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center text-sm text-gray-300 mb-3">
                <span class="hover:text-white transition-colors cursor-pointer">Dashboard</span>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-white font-medium">Customer Reviews</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-semibold text-white mb-1">💬 Customer Reviews (2,847)</h1>
                    <p class="text-gray-200">Monitor and manage all customer reviews and feedback</p>
                </div>
                <div class="flex items-center gap-3">
                    <button class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-download"></i>
                        Export Reviews
                    </button>
                    <button class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-chart-bar"></i>
                        Analytics
                    </button>
                </div>
            </div>

            <!-- Review Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-purple-300">2,847</div>
                    <div class="text-sm text-gray-300">Total Reviews</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-yellow-300">4.6</div>
                    <div class="text-sm text-gray-300">Avg Rating</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-orange-300">124</div>
                    <div class="text-sm text-gray-300">Pending</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-green-300">186</div>
                    <div class="text-sm text-gray-300">This Week</div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 space-y-6">

        <!-- Quick Navigation -->
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-xl p-6">
            <div class="flex flex-wrap gap-3">
                <a href="#" class="px-6 py-3 bg-gradient-to-r from-[#1D293D] to-gray-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-comments"></i> All Reviews
                </a>
                <a href="#" class="px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-star"></i> 5 Stars
                </a>
                <a href="#" class="px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-clock"></i> Pending
                </a>
                <a href="#" class="px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> Published
                </a>
                <a href="#" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-times-circle"></i> Rejected
                </a>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-xl p-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="relative">
                        <input type="text" id="reviewSearch" placeholder="Search reviews..." 
                               class="pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D293D] focus:border-transparent w-80">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Filter by Rating -->
                    <select class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D293D]">
                        <option>All Ratings</option>
                        <option>5 Stars</option>
                        <option>4 Stars</option>
                        <option>3 Stars</option>
                        <option>2 Stars</option>
                        <option>1 Star</option>
                    </select>

                    <!-- Filter by Status -->
                    <select class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D293D]">
                        <option>All Status</option>
                        <option>Published</option>
                        <option>Pending</option>
                        <option>Rejected</option>
                    </select>
                </div>

                <div class="flex items-center space-x-3">
                    <button class="px-4 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all">
                        <i class="fas fa-filter mr-2"></i>More Filters
                    </button>
                    <button class="px-4 py-3 bg-blue-100 text-blue-700 rounded-xl hover:bg-blue-200 transition-all">
                        <i class="fas fa-sync-alt mr-2"></i>Refresh
                    </button>
                </div>
            </div>
        </div>

        <!-- Reviews Container -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20">
            {{-- Table Header --}}
            <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white">Customer Reviews</h3>
                    <div class="text-sm text-gray-300">
                        <span>Showing 5 of 2,847 reviews</span>
                    </div>
                </div>
            </div>

            <!-- Reviews List -->
            <div class="p-6 space-y-6 max-h-screen overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
        @php
        $sampleReviews = [
            [
                'id' => 1,
                'customer_name' => 'Sarah Johnson',
                'customer_email' => 'sarah.johnson@email.com',
                'product_name' => 'Wireless Bluetooth Headphones',
                'rating' => 5,
                'title' => 'Excellent sound quality!',
                'comment' => 'These headphones exceeded my expectations. The sound quality is amazing and the battery life is fantastic. Highly recommended!',
                'date' => '2024-12-15',
                'status' => 'published',
                'helpful_votes' => 23
            ],
            [
                'id' => 2,
                'customer_name' => 'Mike Chen',
                'customer_email' => 'mike.chen@email.com',
                'product_name' => 'Smart Watch Pro',
                'rating' => 4,
                'title' => 'Great features, minor issues',
                'comment' => 'Love the fitness tracking features and the display is crisp. However, the battery could be better and sometimes the touch response is slow.',
                'date' => '2024-12-14',
                'status' => 'published',
                'helpful_votes' => 15
            ],
            [
                'id' => 3,
                'customer_name' => 'Emily Rodriguez',
                'customer_email' => 'emily.r@email.com',
                'product_name' => 'Laptop Stand Adjustable',
                'rating' => 5,
                'title' => 'Perfect for work from home!',
                'comment' => 'This laptop stand has improved my posture significantly. Very sturdy and easy to adjust. Worth every penny!',
                'date' => '2024-12-13',
                'status' => 'pending',
                'helpful_votes' => 8
            ],
            [
                'id' => 4,
                'customer_name' => 'David Wilson',
                'customer_email' => 'david.wilson@email.com',
                'product_name' => 'Gaming Mouse RGB',
                'rating' => 3,
                'title' => 'Average performance',
                'comment' => 'The mouse is okay for casual gaming but not great for competitive play. The RGB lighting is nice though.',
                'date' => '2024-12-12',
                'status' => 'published',
                'helpful_votes' => 5
            ],
            [
                'id' => 5,
                'customer_name' => 'Lisa Parker',
                'customer_email' => 'lisa.parker@email.com',
                'product_name' => 'Portable Charger 10000mAh',
                'rating' => 2,
                'title' => 'Disappointing battery life',
                'comment' => 'Expected more from this charger. It doesnt hold charge as advertised and takes forever to charge devices.',
                'date' => '2024-12-11',
                'status' => 'pending',
                'helpful_votes' => 3
            ]
        ];
        @endphp

                @foreach($sampleReviews as $review)
                <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-white/40 group">
                    <div class="p-4 space-y-4">
                        <!-- Header Row -->
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <!-- Customer Avatar -->
                                <div class="w-8 h-8 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md group-hover:scale-105 transition-transform duration-200">
                                    {{ strtoupper(substr($review['customer_name'], 0, 1)) }}
                                </div>
                                
                                <!-- Customer Info -->
                                <div>
                                    <h3 class="font-medium text-gray-900 text-sm">{{ $review['customer_name'] }}</h3>
                                    <p class="text-xs text-gray-500">{{ $review['customer_email'] }}</p>
                                    <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($review['date'])->format('M d, Y') }}</p>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="flex items-center space-x-3">
                                @if($review['status'] === 'published')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1"></div>
                                        Published
                                    </span>
                                @elseif($review['status'] === 'pending')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200">
                                        <div class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-1 animate-pulse"></div>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                        <div class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1"></div>
                                        Rejected
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-3 bg-gradient-to-r from-gray-50 to-blue-50 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900 text-sm">{{ $review['product_name'] }}</p>
                                    <p class="text-xs text-gray-600">Product ID: #{{ str_pad($review['id'], 4, '0', STR_PAD_LEFT) }}</p>
                                </div>
                                <!-- Rating Stars -->
                                <div class="flex items-center space-x-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-xs {{ $i <= $review['rating'] ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    @endfor
                                    <span class="ml-2 text-xs font-medium text-gray-700">{{ $review['rating'] }}/5</span>
                                </div>
                            </div>
                        </div>

                        <!-- Review Content -->
                        <div class="space-y-2">
                            <h4 class="font-medium text-sm text-gray-900">{{ $review['title'] }}</h4>
                            <p class="text-sm text-gray-700 leading-relaxed">{{ $review['comment'] }}</p>
                        </div>

                        <!-- Review Stats and Actions -->
                        <div class="flex items-center justify-between border-t border-gray-200 pt-3">
                            <div class="flex items-center space-x-4 text-xs text-gray-500">
                                <span class="flex items-center gap-1">
                                    <i class="fas fa-thumbs-up"></i>
                                    {{ $review['helpful_votes'] }} helpful
                                </span>
                                <span class="flex items-center gap-1">
                                    <i class="fas fa-eye"></i>
                                    {{ rand(50, 200) }} views
                                </span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-1">
                                @if($review['status'] === 'pending')
                                    <button class="px-3 py-1 bg-green-100 text-green-700 rounded-md hover:bg-green-200 transition-all text-xs font-medium">
                                        <i class="fas fa-check mr-1"></i>Approve
                                    </button>
                                    <button class="px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-all text-xs font-medium">
                                        <i class="fas fa-times mr-1"></i>Reject
                                    </button>
                                @endif
                                
                                <button class="px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-all text-xs font-medium">
                                    <i class="fas fa-reply mr-1"></i>Reply
                                </button>
                                
                                <div class="relative">
                                    <button class="px-2 py-1 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-all text-xs" 
                                            data-dropdown="{{ $review['id'] }}">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div id="dropdown-{{ $review['id'] }}" class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border hidden z-10">
                                        <a href="#" class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-50">View Details</a>
                                        <a href="#" class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-50">Edit Review</a>
                                        <a href="#" class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-50">Flag as Spam</a>
                                        <a href="#" class="block px-3 py-2 text-xs text-red-600 hover:bg-gray-50">Delete Review</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gradient-to-r from-gray-50 to-blue-50">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Showing 1 to 5 of 2,847 reviews
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-100 transition-colors">
                            Previous
                        </button>
                        <button class="px-4 py-2 bg-[#1D293D] text-white rounded-lg text-sm hover:bg-gray-700 transition-colors">
                            1
                        </button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-100 transition-colors">
                            2
                        </button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-100 transition-colors">
                            3
                        </button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-100 transition-colors">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Interactions -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('reviewSearch');
        searchInput.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const reviews = document.querySelectorAll('.bg-white\\/80');
            
            reviews.forEach(review => {
                const text = review.textContent.toLowerCase();
                if (text.includes(filter)) {
                    review.style.display = '';
                } else {
                    review.style.display = 'none';
                }
            });
        });

        // Dropdown toggle function
        document.querySelectorAll('[data-dropdown]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const reviewId = this.getAttribute('data-dropdown');
                const dropdown = document.getElementById(`dropdown-${reviewId}`);
                const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');
                
                // Hide all other dropdowns
                allDropdowns.forEach(dd => {
                    if (dd.id !== `dropdown-${reviewId}`) {
                        dd.classList.add('hidden');
                    }
                });
                
                // Toggle current dropdown
                dropdown.classList.toggle('hidden');
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('[data-dropdown]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });

        // Action button handlers
        document.addEventListener('click', function(event) {
            if (event.target.closest('.bg-green-100')) {
                alert('Review approved successfully!');
            }
            
            if (event.target.closest('.bg-red-100')) {
                if (confirm('Are you sure you want to reject this review?')) {
                    alert('Review rejected!');
                }
            }
            
            if (event.target.closest('.bg-blue-100')) {
                alert('Reply functionality would be implemented here');
            }
        });
    });
</script>

@push('styles')
<style>
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

/* Backdrop blur fallback */
@supports not (backdrop-filter: blur(12px)) {
    .backdrop-blur-sm {
        background-color: rgba(255, 255, 255, 0.9);
    }
}

/* Better mobile responsiveness */
@media (max-width: 768px) {
    .px-6 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .w-80 {
        width: 100%;
    }
}
</style>
@endpush

@endsection
