@extends('admin.layouts.app')

@section('title', 'Inbox - Messages')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-slate-50 to-blue-50">
    <!-- Header Section with Custom Color -->
    <div class="bg-gradient-to-r from-[#1D293D] to-gray-900 shadow-2xl">
        <div class="px-6 py-6">
            {{-- Breadcrumb --}}
            <div class="flex items-center text-sm text-gray-300 mb-3">
                <span class="hover:text-white transition-colors cursor-pointer">Dashboard</span>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-white font-medium">Inbox - Messages</span>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-white mb-1">📧 Inbox</h1>
                    <p class="text-gray-200">Manage customer messages and support requests</p>
                </div>
                <div class="flex items-center gap-3">
                    <button class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        Compose Message
                    </button>
                    <button class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-sync-alt"></i>
                        Refresh
                    </button>
                </div>
            </div>

            <!-- Key Metrics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-blue-300">{{ isset($totalMessages) ? number_format($totalMessages) : 0 }}</div>
                    <div class="text-sm text-gray-300">Total Messages</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-red-300">{{ isset($unreadMessages) ? $unreadMessages : 0 }}</div>
                    <div class="text-sm text-gray-300">Unread Messages</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-green-300">{{ isset($todayMessages) ? $todayMessages : 0 }}</div>
                    <div class="text-sm text-gray-300">Today's Messages</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold text-purple-300">{{ isset($responseRate) ? $responseRate : 0 }}%</div>
                    <div class="text-sm text-gray-300">Response Rate</div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 space-y-6">

        <!-- Message Filters and Search -->
        <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-xl p-6 mb-6 border border-white/20">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="relative">
                        <input type="text" id="messageSearch" placeholder="Search messages..." 
                               class="pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/80 backdrop-blur-sm transition-all duration-200 w-80">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Filter by Status -->
                    <select id="statusFilter" class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/80 backdrop-blur-sm transition-all duration-200">
                        <option value="all">All Messages</option>
                        <option value="unread">Unread</option>
                        <option value="replied">Replied</option>
                        <option value="pending">Pending</option>
                        <option value="closed">Closed</option>
                    </select>

                    <!-- Filter by Category -->
                    <select id="categoryFilter" class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1D293D]/20 focus:border-[#1D293D] bg-white/80 backdrop-blur-sm transition-all duration-200">
                        <option value="all">All Categories</option>
                        <option value="support">Support</option>
                        <option value="sales">Sales Inquiry</option>
                        <option value="complaint">Complaint</option>
                        <option value="feedback">Feedback</option>
                        <option value="refund">Refund Request</option>
                    </select>
                </div>

                <div class="flex items-center space-x-3">
                    <button id="markAllRead" class="px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 font-medium">
                        <i class="fas fa-check-double mr-2"></i>Mark All Read
                    </button>
                    <button id="deleteSelected" class="px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 font-medium">
                        <i class="fas fa-trash mr-2"></i>Delete Selected
                    </button>
                </div>
            </div>
        </div>

        <!-- Messages List -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20">
            <div class="bg-gradient-to-r from-[#1D293D] to-gray-800 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <h3 class="text-lg font-semibold text-white">Messages</h3>
                        <span class="text-sm text-gray-300">(<span id="messageCount">{{ isset($contacts) ? $contacts->count() : 0 }}</span> messages)</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="px-3 py-1 text-xs bg-white/20 text-white rounded-full backdrop-blur-sm border border-white/30">Priority</button>
                        <button class="px-3 py-1 text-xs bg-white/10 text-gray-300 rounded-full backdrop-blur-sm border border-white/20">Date</button>
                        <button class="px-3 py-1 text-xs bg-white/10 text-gray-300 rounded-full backdrop-blur-sm border border-white/20">Status</button>
                    </div>
                </div>
            </div>

            <div class="divide-y divide-gray-200" id="messagesList">
                @if(isset($contacts) && $contacts->count() > 0)
                    @foreach($contacts as $contact)
                    <div class="message-item p-6 hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50 transition-all duration-200 cursor-pointer {{ $contact->status === 'unread' ? 'bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-[#1D293D]' : 'bg-white' }}" 
                         data-status="{{ $contact->status }}" 
                         data-category="{{ $contact->category }}"
                         data-priority="{{ $contact->priority }}"
                         onclick="openMessage({{ $contact->id }})">
                        
                        <div class="flex items-start space-x-4">
                            <!-- Checkbox and Avatar -->
                            <div class="flex items-center space-x-3">
                                <input type="checkbox" class="message-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" onclick="event.stopPropagation()">
                                <div class="w-12 h-12 bg-gradient-to-r from-[#1D293D] to-gray-700 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ $contact->avatar_initials }}
                                </div>
                            </div>

                            <!-- Message Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-3">
                                        <h4 class="font-semibold text-gray-900 {{ $contact->status === 'unread' ? 'font-bold' : '' }}">
                                            {{ $contact->sender_name }}
                                        </h4>
                                        <span class="text-sm text-gray-500">{{ $contact->sender_email }}</span>
                                        
                                        <!-- Priority Badge -->
                                        @if($contact->priority === 'high')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-200">
                                                <i class="fas fa-exclamation-circle mr-1"></i>High
                                            </span>
                                        @elseif($contact->priority === 'medium')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-200">
                                                <i class="fas fa-minus-circle mr-1"></i>Medium
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-gray-100 to-gray-200 text-gray-600 border border-gray-200">
                                                <i class="fas fa-circle mr-1"></i>Low
                                            </span>
                                        @endif

                                        <!-- Category Badge -->
                                        @php
                                            $categoryColors = [
                                                'support' => 'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border-blue-200',
                                                'sales' => 'bg-gradient-to-r from-green-100 to-green-200 text-green-800 border-green-200',
                                                'complaint' => 'bg-gradient-to-r from-red-100 to-red-200 text-red-800 border-red-200',
                                                'feedback' => 'bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 border-purple-200',
                                                'refund' => 'bg-gradient-to-r from-orange-100 to-orange-200 text-orange-800 border-orange-200',
                                                'general' => 'bg-gradient-to-r from-gray-100 to-gray-200 text-gray-600 border-gray-200'
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $categoryColors[$contact->category] }} border">
                                            {{ ucfirst($contact->category) }}
                                        </span>
                                    </div>

                                    <div class="flex items-center space-x-3">
                                        <!-- Status -->
                                        @if($contact->status === 'unread')
                                            <span class="w-3 h-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full shadow-sm"></span>
                                        @elseif($contact->status === 'replied')
                                            <i class="fas fa-reply text-green-500"></i>
                                        @elseif($contact->status === 'pending')
                                            <i class="fas fa-clock text-yellow-500"></i>
                                        @else
                                            <i class="fas fa-check-circle text-gray-400"></i>
                                        @endif

                                        <!-- Date -->
                                        <span class="text-sm text-gray-500">
                                            {{ $contact->created_at->format('M d, H:i') }}
                                        </span>

                                        <!-- Actions -->
                                        <div class="flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-200" title="Reply" onclick="event.stopPropagation(); replyToMessage({{ $contact->id }})">
                                                <i class="fas fa-reply text-sm"></i>
                                            </button>
                                            <button class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200" title="Delete" onclick="event.stopPropagation(); deleteMessage({{ $contact->id }})">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="font-medium text-gray-900 mb-2 {{ $contact->status === 'unread' ? 'font-semibold' : '' }}">
                                    {{ $contact->subject }}
                                </h5>
                                <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ $contact->message }}</p>
                                
                                @if($contact->admin_response)
                                    <div class="mt-3 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-300 rounded-lg shadow-sm">
                                        <p class="text-xs text-green-600 font-medium mb-1">Admin Response:</p>
                                        <p class="text-sm text-green-700 mb-2">{{ $contact->admin_response }}</p>
                                        <p class="text-xs text-green-500">Replied: {{ $contact->replied_at->format('M d, Y H:i') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="p-16 text-center text-gray-500">
                        <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-inbox text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-medium mb-2 text-gray-700">No messages yet</h3>
                        <p class="text-gray-500">When customers send messages, they will appear here.</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        @if(isset($contacts) && $contacts->count() > 0)
                            Showing 1 to {{ $contacts->count() }} of {{ $contacts->count() }} messages
                        @else
                            No messages to display
                        @endif
                    </div>
                    @if(isset($contacts) && $contacts->count() > 10)
                        <div class="flex space-x-2">
                            <button class="px-4 py-2 border border-gray-300 rounded-xl text-sm hover:bg-white hover:shadow-md transition-all duration-200 bg-white/80 backdrop-blur-sm">
                                Previous
                            </button>
                            <button class="px-4 py-2 bg-gradient-to-r from-[#1D293D] to-gray-700 text-white rounded-xl text-sm hover:shadow-lg transition-all duration-200 shadow-md">
                                1
                            </button>
                            <button class="px-4 py-2 border border-gray-300 rounded-xl text-sm hover:bg-white hover:shadow-md transition-all duration-200 bg-white/80 backdrop-blur-sm">
                                Next
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Interactive Features -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('messageSearch');
        const statusFilter = document.getElementById('statusFilter');
        const categoryFilter = document.getElementById('categoryFilter');

        function filterMessages() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusValue = statusFilter.value;
            const categoryValue = categoryFilter.value;
            const messages = document.querySelectorAll('.message-item');
            let visibleCount = 0;

            messages.forEach(message => {
                const text = message.textContent.toLowerCase();
                const status = message.dataset.status;
                const category = message.dataset.category;

                const matchesSearch = searchTerm === '' || text.includes(searchTerm);
                const matchesStatus = statusValue === 'all' || status === statusValue;
                const matchesCategory = categoryValue === 'all' || category === categoryValue;

                if (matchesSearch && matchesStatus && matchesCategory) {
                    message.style.display = '';
                    visibleCount++;
                } else {
                    message.style.display = 'none';
                }
            });

            document.getElementById('messageCount').textContent = visibleCount;
        }

        searchInput.addEventListener('keyup', filterMessages);
        statusFilter.addEventListener('change', filterMessages);
        categoryFilter.addEventListener('change', filterMessages);

        // Select All functionality
        const selectAllCheckbox = document.getElementById('selectAll');
        const messageCheckboxes = document.querySelectorAll('.message-checkbox');

        selectAllCheckbox.addEventListener('change', function() {
            messageCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        messageCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const checkedBoxes = document.querySelectorAll('.message-checkbox:checked');
                selectAllCheckbox.checked = checkedBoxes.length === messageCheckboxes.length;
                selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < messageCheckboxes.length;
            });
        });

        // Mark all read
        document.getElementById('markAllRead').addEventListener('click', function() {
            const unreadMessages = document.querySelectorAll('.message-item[data-status="unread"]');
            unreadMessages.forEach(message => {
                message.classList.remove('bg-blue-50', 'border-l-4', 'border-blue-500');
                message.dataset.status = 'replied';
                const statusIcon = message.querySelector('.fa-circle, .w-3');
                if (statusIcon) {
                    statusIcon.outerHTML = '<i class="fas fa-check-circle text-gray-400"></i>';
                }
            });
            showNotification('All messages marked as read', 'success');
        });

        // Delete selected
        document.getElementById('deleteSelected').addEventListener('click', async function() {
            const selectedMessages = document.querySelectorAll('.message-checkbox:checked');
            if (selectedMessages.length === 0) {
                showNotification('Please select messages to delete', 'error');
                return;
            }
            
            const confirmed = await adminConfirm({
                type: 'delete',
                title: 'Delete Messages',
                subtitle: 'Bulk deletion cannot be undone',
                message: `Are you sure you want to delete ${selectedMessages.length} message(s)? This action cannot be undone.`,
                confirmText: 'Delete All'
            });
            
            if (confirmed) {
                selectedMessages.forEach(checkbox => {
                    checkbox.closest('.message-item').remove();
                });
                showNotification(`${selectedMessages.length} message(s) deleted`, 'success');
                filterMessages(); // Update count
            }
        });
    });

    // Message actions
    function openMessage(id) {
        // Mark as read when opened
        updateMessageStatus(id, 'replied');
        showNotification(`Opening message #${id}`, 'info');
        // Here you would typically navigate to a detailed message view
    }

    function replyToMessage(id) {
        showNotification(`Reply to message #${id}`, 'info');
        // Here you would open a reply modal or navigate to reply page
    }

    async function deleteMessage(id) {
        const confirmed = await adminConfirm({
            type: 'delete',
            title: 'Delete Message',
            subtitle: 'This action cannot be undone',
            message: 'Are you sure you want to delete this message? This action cannot be undone.',
            confirmText: 'Delete Message'
        });
        
        if (confirmed) {
            try {
                const response = await fetch(`/inbox/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                });
                
                if (response.ok) {
                    document.querySelector(`[onclick="openMessage(${id})"]`).remove();
                    showNotification('Message deleted', 'success');
                    
                    // Update count
                    const currentCount = parseInt(document.getElementById('messageCount').textContent);
                    document.getElementById('messageCount').textContent = currentCount - 1;
                } else {
                    showNotification('Failed to delete message', 'error');
                }
            } catch (error) {
                showNotification('Error deleting message', 'error');
            }
        }
    }

    // Update message status
    async function updateMessageStatus(id, status) {
        try {
            const response = await fetch(`/inbox/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: status })
            });
            
            if (response.ok) {
                const messageElement = document.querySelector(`[onclick="openMessage(${id})"]`);
                if (messageElement) {
                    messageElement.dataset.status = status;
                    if (status === 'replied') {
                        messageElement.classList.remove('bg-blue-50', 'border-l-4', 'border-blue-500');
                        const statusIcon = messageElement.querySelector('.w-3.h-3, .fas.fa-clock');
                        if (statusIcon) {
                            statusIcon.outerHTML = '<i class="fas fa-reply text-green-500"></i>';
                        }
                    }
                }
            }
        } catch (error) {
            console.error('Error updating message status:', error);
        }
    }

    // Show notification function
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
        
        notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .message-item:hover .opacity-0 {
        opacity: 1;
    }

    .message-item {
        transition: all 0.3s ease;
    }

    .message-item:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }

    /* Custom scrollbar for message content */
    .message-content::-webkit-scrollbar {
        width: 4px;
    }

    .message-content::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 2px;
    }

    .message-content::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 2px;
    }

    .message-content::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection
