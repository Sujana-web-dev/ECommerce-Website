@extends('admin.layouts.app')

@section('title', 'Inbox - Messages')

@section('content')
<div class="flex-1 p-8 bg-gradient-to-br from-gray-50 to-white min-h-screen">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">📧 Inbox</h1>
                <p class="text-gray-600">Manage customer messages and support requests</p>
            </div>
            <div class="flex space-x-3">
                <button class="px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>Compose Message
                </button>
                <button class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <i class="fas fa-sync-alt mr-2"></i>Refresh
                </button>
            </div>
        </div>
    </div>

    <!-- Message Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Messages -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Messages</p>
                    <p class="text-3xl font-bold">1,247</p>
                    <p class="text-blue-100 text-xs mt-1">📬 All time messages</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Unread Messages -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm font-medium">Unread Messages</p>
                    <p class="text-3xl font-bold">23</p>
                    <p class="text-red-100 text-xs mt-1">⚠️ Needs attention</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-exclamation-circle text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Today's Messages -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Today's Messages</p>
                    <p class="text-3xl font-bold">18</p>
                    <p class="text-green-100 text-xs mt-1">📅 Received today</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-calendar-day text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Response Rate -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Response Rate</p>
                    <p class="text-3xl font-bold">94%</p>
                    <p class="text-purple-100 text-xs mt-1">⚡ Avg response time: 2h</p>
                </div>
                <div class="bg-white/20 p-3 rounded-xl">
                    <i class="fas fa-reply text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Filters and Search -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center space-x-4">
                <!-- Search -->
                <div class="relative">
                    <input type="text" id="messageSearch" placeholder="Search messages..." 
                           class="pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-80">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>

                <!-- Filter by Status -->
                <select id="statusFilter" class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">All Messages</option>
                    <option value="unread">Unread</option>
                    <option value="replied">Replied</option>
                    <option value="pending">Pending</option>
                    <option value="closed">Closed</option>
                </select>

                <!-- Filter by Category -->
                <select id="categoryFilter" class="px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">All Categories</option>
                    <option value="support">Support</option>
                    <option value="sales">Sales Inquiry</option>
                    <option value="complaint">Complaint</option>
                    <option value="feedback">Feedback</option>
                    <option value="refund">Refund Request</option>
                </select>
            </div>

            <div class="flex items-center space-x-3">
                <button id="markAllRead" class="px-4 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all">
                    <i class="fas fa-check-double mr-2"></i>Mark All Read
                </button>
                <button id="deleteSelected" class="px-4 py-3 bg-red-100 text-red-700 rounded-xl hover:bg-red-200 transition-all">
                    <i class="fas fa-trash mr-2"></i>Delete Selected
                </button>
            </div>
        </div>
    </div>

    <!-- Messages List -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <h3 class="text-lg font-semibold text-gray-800">Messages</h3>
                <span class="text-sm text-gray-500">(<span id="messageCount">15</span> messages)</span>
            </div>
            <div class="flex items-center space-x-2">
                <button class="px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-lg">Priority</button>
                <button class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-lg">Date</button>
                <button class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-lg">Status</button>
            </div>
        </div>

        <div class="divide-y divide-gray-200" id="messagesList">
            @php
            $messages = [
                [
                    'id' => 1,
                    'sender' => 'Sarah Johnson',
                    'email' => 'sarah.johnson@email.com',
                    'subject' => 'Issue with my recent order #ORD-2024-001',
                    'preview' => 'Hi, I received my order yesterday but one of the items seems to be damaged. Could you please help me with a replacement?',
                    'category' => 'Support',
                    'status' => 'unread',
                    'priority' => 'high',
                    'date' => '2024-12-15 10:30',
                    'avatar' => 'SJ'
                ],
                [
                    'id' => 2,
                    'sender' => 'Mike Chen',
                    'email' => 'mike.chen@email.com',
                    'subject' => 'Product inquiry about Smart Watch Pro',
                    'preview' => 'Hello, I\'m interested in purchasing the Smart Watch Pro. Can you provide more details about battery life and water resistance?',
                    'category' => 'Sales',
                    'status' => 'replied',
                    'priority' => 'medium',
                    'date' => '2024-12-14 15:45',
                    'avatar' => 'MC'
                ],
                [
                    'id' => 3,
                    'sender' => 'Emily Rodriguez',
                    'email' => 'emily.r@email.com',
                    'subject' => 'Refund request for cancelled order',
                    'preview' => 'I had to cancel my order #ORD-2024-018 due to personal reasons. When can I expect the refund to be processed?',
                    'category' => 'Refund',
                    'status' => 'pending',
                    'priority' => 'high',
                    'date' => '2024-12-14 09:20',
                    'avatar' => 'ER'
                ],
                [
                    'id' => 4,
                    'sender' => 'David Wilson',
                    'email' => 'david.wilson@email.com',
                    'subject' => 'Great experience with your service!',
                    'preview' => 'Just wanted to say thank you for the excellent customer service. The delivery was fast and the product quality is amazing!',
                    'category' => 'Feedback',
                    'status' => 'replied',
                    'priority' => 'low',
                    'date' => '2024-12-13 16:15',
                    'avatar' => 'DW'
                ],
                [
                    'id' => 5,
                    'sender' => 'Lisa Parker',
                    'email' => 'lisa.parker@email.com',
                    'subject' => 'Complaint about delayed shipping',
                    'preview' => 'My order was supposed to arrive 3 days ago but it\'s still showing as "processing". This is very disappointing.',
                    'category' => 'Complaint',
                    'status' => 'unread',
                    'priority' => 'high',
                    'date' => '2024-12-13 11:30',
                    'avatar' => 'LP'
                ],
                [
                    'id' => 6,
                    'sender' => 'Alex Thompson',
                    'email' => 'alex.thompson@email.com',
                    'subject' => 'Technical support needed',
                    'preview' => 'I\'m having trouble setting up the Bluetooth connection on my new headphones. Could someone guide me through the process?',
                    'category' => 'Support',
                    'status' => 'pending',
                    'priority' => 'medium',
                    'date' => '2024-12-12 14:22',
                    'avatar' => 'AT'
                ],
                [
                    'id' => 7,
                    'sender' => 'Jennifer White',
                    'email' => 'jennifer.white@email.com',
                    'subject' => 'Question about bulk orders',
                    'preview' => 'We\'re interested in placing a bulk order for our company. Do you offer corporate discounts and what\'s the minimum quantity?',
                    'category' => 'Sales',
                    'status' => 'replied',
                    'priority' => 'medium',
                    'date' => '2024-12-12 08:45',
                    'avatar' => 'JW'
                ],
                [
                    'id' => 8,
                    'sender' => 'Robert Brown',
                    'email' => 'robert.brown@email.com',
                    'subject' => 'Website navigation feedback',
                    'preview' => 'The new website design looks great! However, I found it a bit difficult to find the search function. Maybe make it more prominent?',
                    'category' => 'Feedback',
                    'status' => 'unread',
                    'priority' => 'low',
                    'date' => '2024-12-11 19:30',
                    'avatar' => 'RB'
                ]
            ];
            @endphp

            @foreach($messages as $message)
            <div class="message-item p-6 hover:bg-gray-50 transition-colors cursor-pointer {{ $message['status'] === 'unread' ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}" 
                 data-status="{{ $message['status'] }}" 
                 data-category="{{ strtolower($message['category']) }}"
                 data-priority="{{ $message['priority'] }}"
                 onclick="openMessage({{ $message['id'] }})">
                
                <div class="flex items-start space-x-4">
                    <!-- Checkbox and Avatar -->
                    <div class="flex items-center space-x-3">
                        <input type="checkbox" class="message-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" onclick="event.stopPropagation()">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                            {{ $message['avatar'] }}
                        </div>
                    </div>

                    <!-- Message Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-3">
                                <h4 class="font-semibold text-gray-900 {{ $message['status'] === 'unread' ? 'font-bold' : '' }}">
                                    {{ $message['sender'] }}
                                </h4>
                                <span class="text-sm text-gray-500">{{ $message['email'] }}</span>
                                
                                <!-- Priority Badge -->
                                @if($message['priority'] === 'high')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-exclamation-circle mr-1"></i>High
                                    </span>
                                @elseif($message['priority'] === 'medium')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-minus-circle mr-1"></i>Medium
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        <i class="fas fa-circle mr-1"></i>Low
                                    </span>
                                @endif

                                <!-- Category Badge -->
                                @php
                                    $categoryColors = [
                                        'Support' => 'bg-blue-100 text-blue-800',
                                        'Sales' => 'bg-green-100 text-green-800',
                                        'Complaint' => 'bg-red-100 text-red-800',
                                        'Feedback' => 'bg-purple-100 text-purple-800',
                                        'Refund' => 'bg-orange-100 text-orange-800'
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $categoryColors[$message['category']] }}">
                                    {{ $message['category'] }}
                                </span>
                            </div>

                            <div class="flex items-center space-x-3">
                                <!-- Status -->
                                @if($message['status'] === 'unread')
                                    <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                @elseif($message['status'] === 'replied')
                                    <i class="fas fa-reply text-green-500"></i>
                                @elseif($message['status'] === 'pending')
                                    <i class="fas fa-clock text-yellow-500"></i>
                                @else
                                    <i class="fas fa-check-circle text-gray-400"></i>
                                @endif

                                <!-- Date -->
                                <span class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($message['date'])->format('M d, H:i') }}
                                </span>

                                <!-- Actions -->
                                <div class="flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="p-1 text-gray-400 hover:text-blue-600" title="Reply" onclick="event.stopPropagation(); replyToMessage({{ $message['id'] }})">
                                        <i class="fas fa-reply text-sm"></i>
                                    </button>
                                    <button class="p-1 text-gray-400 hover:text-red-600" title="Delete" onclick="event.stopPropagation(); deleteMessage({{ $message['id'] }})">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <h5 class="font-medium text-gray-900 mb-1 {{ $message['status'] === 'unread' ? 'font-semibold' : '' }}">
                            {{ $message['subject'] }}
                        </h5>
                        <p class="text-sm text-gray-600 line-clamp-2">{{ $message['preview'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Showing 1 to 8 of 15 messages
                </div>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-100 transition-colors">
                        Previous
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition-colors">
                        1
                    </button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-100 transition-colors">
                        2
                    </button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-100 transition-colors">
                        Next
                    </button>
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
            document.querySelector(`[onclick="openMessage(${id})"]`).remove();
            showNotification('Message deleted', 'success');
            
            // Update count
            const currentCount = parseInt(document.getElementById('messageCount').textContent);
            document.getElementById('messageCount').textContent = currentCount - 1;
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
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .message-item:hover .opacity-0 {
        opacity: 1;
    }
</style>
@endsection
