<script>
    // Global Modal Image Error Prevention
    document.addEventListener('DOMContentLoaded', function() {
        // Add null check protection for all modalMainImage references
        const originalGetElementById = document.getElementById;
        document.getElementById = function(id) {
            const element = originalGetElementById.call(this, id);
            if (id === 'modalMainImage' && !element) {
                console.warn('modalMainImage element not found, creating placeholder');
                return {
                    classList: {
                        add: () => {},
                        remove: () => {},
                        toggle: () => {},
                        contains: () => false
                    },
                    src: '',
                    alt: '',
                    style: {}
                };
            }
            return element;
        };
    });
</script>

<!-- Premium JavaScript Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Premium UI Enhancement Scripts -->



<script>
    // Initialize AOS (Animate On Scroll)
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-out-cubic'
        });
    });

    // Premium Modal Controls
    function showModal(modalId) {
        const modal = document.getElementById(modalId);
        const overlay = document.getElementById('overlay');
        
        if (modal && overlay) {
            modal.style.display = 'flex';
            overlay.style.display = 'block';
            
            setTimeout(() => {
                modal.classList.remove('opacity-0', 'invisible');
                modal.classList.add('opacity-100', 'visible');
                modal.querySelector('.transform').classList.remove('scale-95');
                modal.querySelector('.transform').classList.add('scale-100');
                overlay.classList.remove('opacity-0', 'invisible');
                overlay.classList.add('opacity-100', 'visible');
            }, 10);
        }
    }

    function hideModal(modalId) {
        const modal = document.getElementById(modalId);
        const overlay = document.getElementById('overlay');
        
        if (modal && overlay) {
            modal.classList.add('opacity-0', 'invisible');
            modal.classList.remove('opacity-100', 'visible');
            modal.querySelector('.transform').classList.add('scale-95');
            modal.querySelector('.transform').classList.remove('scale-100');
            overlay.classList.add('opacity-0', 'invisible');
            overlay.classList.remove('opacity-100', 'visible');
            
            setTimeout(() => {
                modal.style.display = 'none';
                overlay.style.display = 'none';
            }, 300);
        }
    }

    // User Dropdown
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.getElementById('userDropdownToggle');
        const dropdown = document.getElementById('userDropdown');
        
        if (dropdownToggle && dropdown) {
            dropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (dropdown.classList.contains('opacity-0')) {
                    dropdown.classList.remove('opacity-0', 'invisible', 'scale-95');
                    dropdown.classList.add('opacity-100', 'visible', 'scale-100');
                } else {
                    dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                    dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
                }
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function() {
                dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                dropdown.classList.remove('opacity-100', 'visible', 'scale-100');
            });
        }
    });

    // Mobile Menu
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        
        function openMobileMenu() {
            if (mobileMenu) {
                mobileMenu.classList.remove('-translate-x-full');
                mobileMenu.classList.add('translate-x-0');
            }
        }
        
        function closeMobileMenuFunc() {
            if (mobileMenu) {
                mobileMenu.classList.add('-translate-x-full');
                mobileMenu.classList.remove('translate-x-0');
            }
        }
        
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', openMobileMenu);
        }
        
        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
        }
    });

    // Back to Top Button
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopButton = document.getElementById('backToTop');
        
        if (backToTopButton) {
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.remove('opacity-0', 'invisible');
                    backToTopButton.classList.add('opacity-100', 'visible');
                } else {
                    backToTopButton.classList.add('opacity-0', 'invisible');
                    backToTopButton.classList.remove('opacity-100', 'visible');
                }
            });
            
            backToTopButton.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    });

    // Login/Signup Modal Controls
    document.addEventListener('DOMContentLoaded', function() {
        // Login Modal
        const loginBtn = document.getElementById('loginBtn');
        const mobileLoginBtn = document.getElementById('mobileLoginBtn');
        const closeLoginModal = document.getElementById('closeLoginModal');
        
        if (loginBtn) loginBtn.addEventListener('click', (e) => {
            e.preventDefault();
            showModal('loginModal');
        });
        
        if (mobileLoginBtn) mobileLoginBtn.addEventListener('click', (e) => {
            e.preventDefault();
            showModal('loginModal');
        });
        
        if (closeLoginModal) closeLoginModal.addEventListener('click', () => hideModal('loginModal'));
        
        // Signup Modal
        const signupBtn = document.getElementById('signupBtn');
        const mobileSignupBtn = document.getElementById('mobileSignupBtn');
        const switchToSignup = document.getElementById('switchToSignup');
        const closeSignupModal = document.getElementById('closeSignupModal');
        
        if (signupBtn) signupBtn.addEventListener('click', (e) => {
            e.preventDefault();
            showModal('signupModal');
        });
        
        if (mobileSignupBtn) mobileSignupBtn.addEventListener('click', (e) => {
            e.preventDefault();
            showModal('signupModal');
        });
        
        if (switchToSignup) switchToSignup.addEventListener('click', (e) => {
            e.preventDefault();
            hideModal('loginModal');
            setTimeout(() => showModal('signupModal'), 300);
        });
        
        if (closeSignupModal) closeSignupModal.addEventListener('click', () => hideModal('signupModal'));
        
        // Close modals when clicking overlay
        const overlay = document.getElementById('overlay');
        if (overlay) {
            overlay.addEventListener('click', function() {
                hideModal('loginModal');
                hideModal('signupModal');
            });
        }
    });

    // Password Toggle
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Cart functionality is handled in header.blade.php

    // Cart Functions
    function updateCart(id, quantity) {
        if (quantity < 1) quantity = 1;
        
        fetch('{{ route("cart.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: id,
                quantity: quantity
            })
        }).then(res => res.json()).then(data => {
            if (data.success) {
                // Show success notification
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'Cart updated successfully',
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
                location.reload();
            }
        });
    }

    function removeCart(id) {
        Swal.fire({
            title: 'Remove Item?',
            text: 'Are you sure you want to remove this item from your cart?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('{{ route("cart.remove") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: id
                    })
                }).then(res => res.json()).then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Removed!',
                            text: 'Item removed from cart',
                            timer: 2000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                        location.reload();
                    }
                });
            }
        });
    }

    // Premium Animations
    function addPremiumAnimations() {
        // Add shimmer effect to loading elements
        const shimmerElements = document.querySelectorAll('.shimmer');
        shimmerElements.forEach(el => {
            el.innerHTML += '<div class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-20 animate-shimmer"></div>';
        });
        
        // Add floating animation to product cards
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    }

    // Initialize premium animations on page load
    document.addEventListener('DOMContentLoaded', addPremiumAnimations);
</script>



<!-- JS for Add to Cart with Stock Management -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create and show stock error popup
    function showStockErrorPopup(message, productName) {
        // Remove existing popup if any
        const existingPopup = document.getElementById('stock-error-popup');
        if (existingPopup) {
            existingPopup.remove();
        }

        // Create popup HTML
        const popup = document.createElement('div');
        popup.id = 'stock-error-popup';
        popup.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm';
        popup.innerHTML = `
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0">
                <div class="p-6">
                    <!-- Error Icon -->
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full">
                        <i class="fas fa-exclamation-triangle text-3xl text-red-500"></i>
                    </div>
                    
                    <!-- Title -->
                    <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Out of Stock</h3>
                    
                    <!-- Product Name -->
                    <p class="text-lg font-semibold text-gray-700 text-center mb-4">${productName}</p>
                    
                    <!-- Error Message -->
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <p class="text-red-700 text-center">${message}</p>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex space-x-3">
                        <button 
                            onclick="closeStockErrorPopup()" 
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-200"
                        >
                            Close
                        </button>
                        <button 
                            onclick="continueShopping()" 
                            class="flex-1 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-200"
                        >
                            Continue Shopping
                        </button>
                    </div>
                </div>
            </div>
        `;

        // Add to body
        document.body.appendChild(popup);

        // Animate in
        setTimeout(() => {
            const popupContent = popup.querySelector('.bg-white');
            popupContent.classList.remove('scale-95', 'opacity-0');
            popupContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        // Auto close after 8 seconds
        setTimeout(() => {
            closeStockErrorPopup();
        }, 8000);
    }

    // Close popup function
    window.closeStockErrorPopup = function() {
        const popup = document.getElementById('stock-error-popup');
        if (popup) {
            const popupContent = popup.querySelector('.bg-white');
            popupContent.classList.add('scale-95', 'opacity-0');
            popupContent.classList.remove('scale-100', 'opacity-100');
            
            setTimeout(() => {
                popup.remove();
            }, 300);
        }
    };

    // Continue shopping function
    window.continueShopping = function() {
        closeStockErrorPopup();
        // Optionally scroll to products or do other actions
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Success notification function
    function showSuccessNotification(message) {
        // Remove existing notification if any
        const existingNotification = document.getElementById('success-notification');
        if (existingNotification) {
            existingNotification.remove();
        }

        // Create notification
        const notification = document.createElement('div');
        notification.id = 'success-notification';
        notification.className = 'fixed top-4 right-4 z-50 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300';
        notification.innerHTML = `
            <div class="flex items-center space-x-3">
                <i class="fas fa-check-circle text-xl"></i>
                <span class="font-medium">${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        document.body.appendChild(notification);

        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 10);

        // Auto hide after 5 seconds
        setTimeout(() => {
            if (notification && notification.parentElement) {
                notification.classList.add('translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }
        }, 5000);
    }

    // Add to Cart Event Listeners
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const productPrice = this.getAttribute('data-product-price');
            const productImage = this.getAttribute('data-product-image');
            const productStock = parseInt(this.getAttribute('data-product-stock'));
            
            // Disable button during request
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Adding...';
            this.disabled = true;

            // Prepare form data
            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', 1); // Default quantity
            formData.append('_token', '{{ csrf_token() }}');

            // Send AJAX request
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Success - show notification
                    showSuccessNotification(data.message);
                    
                    // Update cart count if element exists
                    const cartCountElements = document.querySelectorAll('.cart-count, #cartItemCount');
                    cartCountElements.forEach(element => {
                        if (element) {
                            element.textContent = data.cart_count || 0;
                        }
                    });
                    
                    // Update stock display for this product
                    updateProductStock(data.product_id, data.remaining_stock, data.total_in_cart);
                    
                    // Optionally show cart offcanvas or update cart UI
                    // updateCartDisplay(data.cart);
                    
                } else if (data.stock_error) {
                    // Stock error - show custom popup
                    showStockErrorPopup(data.message, productName);
                } else {
                    // Other error - show simple alert
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while adding the product to cart. Please try again.');
            })
            .finally(() => {
                // Re-enable button
                this.innerHTML = originalText;
                this.disabled = false;
            });
        });
    });

    // Close popup when clicking outside
    document.addEventListener('click', function(e) {
        const popup = document.getElementById('stock-error-popup');
        if (popup && e.target === popup) {
            closeStockErrorPopup();
        }
    });

    // Close popup with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeStockErrorPopup();
        }
    });

    // Function to update product stock display in real-time
    function updateProductStock(productId, remainingStock, totalInCart) {
        console.log(`Updating stock for product ${productId}: remaining=${remainingStock}, inCart=${totalInCart}`);
        
        // Find all stock display elements for this product
        const stockElements = document.querySelectorAll(`[data-product-id="${productId}"]`).forEach(productContainer => {
            // Look for stock display elements within this product container
            const productCard = productContainer.closest('.product-card, .group, article, .bg-white');
            
            if (productCard) {
                // Update stock badge text
                const stockBadges = productCard.querySelectorAll('span');
                stockBadges.forEach(badge => {
                    if (badge.textContent.includes('Stock:') || badge.textContent.includes('in stock')) {
                        if (remainingStock > 0) {
                            badge.innerHTML = `<i class="fas fa-check-circle mr-1"></i>Stock: ${remainingStock}`;
                            badge.className = badge.className.replace(/text-red-\d+|bg-red-\d+/g, '').replace(/text-gray-\d+/g, '');
                            badge.className += ' text-green-700';
                            if (badge.parentElement && badge.parentElement.classList.contains('bg-red-50')) {
                                badge.parentElement.className = badge.parentElement.className.replace('bg-red-50', 'bg-green-50');
                            }
                        } else {
                            badge.innerHTML = `<i class="fas fa-times-circle mr-1"></i>Out of Stock`;
                            badge.className = badge.className.replace(/text-green-\d+|bg-green-\d+/g, '');
                            badge.className += ' text-red-600 font-bold';
                            if (badge.parentElement && badge.parentElement.classList.contains('bg-green-50')) {
                                badge.parentElement.className = badge.parentElement.className.replace('bg-green-50', 'bg-red-50');
                            }
                        }
                    }
                });

                // Update add to cart button and disable if out of stock
                const addToCartBtn = productCard.querySelector('.add-to-cart-btn');
                if (addToCartBtn) {
                    addToCartBtn.setAttribute('data-product-stock', remainingStock);
                    
                    if (remainingStock <= 0) {
                        addToCartBtn.disabled = true;
                        addToCartBtn.innerHTML = '<i class="fas fa-times mr-1"></i>Sold Out';
                        addToCartBtn.className = addToCartBtn.className.replace(/bg-gradient-to-r|from-\w+-\d+|to-\w+-\d+|hover:from-\w+-\d+|hover:to-\w+-\d+/g, '') + ' bg-gray-300 text-gray-500 cursor-not-allowed';
                    }
                }
            }
        });

        // Also update any standalone stock displays (like in product listings)
        document.querySelectorAll(`[data-product="${productId}"]`).forEach(element => {
            const stockDisplay = element.querySelector('.text-green-600, .text-red-600, .text-green-700, .text-red-500');
            if (stockDisplay && (stockDisplay.textContent.includes('Stock:') || stockDisplay.textContent.includes('in stock') || stockDisplay.textContent.includes('Out of'))) {
                if (remainingStock > 0) {
                    stockDisplay.innerHTML = `<i class="fas fa-check-circle mr-1"></i>Stock: ${remainingStock}`;
                    stockDisplay.className = stockDisplay.className.replace(/text-red-\d+/g, 'text-green-600');
                } else {
                    stockDisplay.innerHTML = `<i class="fas fa-times-circle mr-1"></i>Out of Stock`;
                    stockDisplay.className = stockDisplay.className.replace(/text-green-\d+/g, 'text-red-600');
                }
            }
        });

        // Update stock display in various product card formats
        updateStockInCards(productId, remainingStock);
    }

    // Helper function to update stock display in different card layouts
    function updateStockInCards(productId, remainingStock) {
        // Find product cards by data-product attribute
        document.querySelectorAll(`[data-product="${productId}"]`).forEach(productCard => {
            // Update stock badges with background colors
            const stockBadges = productCard.querySelectorAll('.bg-green-50 span, .bg-red-50 span');
            stockBadges.forEach(badge => {
                const parentBg = badge.parentElement;
                if (remainingStock > 0) {
                    badge.innerHTML = `<i class="fas fa-check-circle mr-1"></i>Stock: ${remainingStock}`;
                    badge.className = 'text-sm text-green-700 font-semibold';
                    if (parentBg) {
                        parentBg.className = parentBg.className.replace('bg-red-50', 'bg-green-50');
                    }
                } else {
                    badge.innerHTML = `<i class="fas fa-times-circle mr-1"></i>Out of Stock`;
                    badge.className = 'text-sm text-red-600 font-bold';
                    if (parentBg) {
                        parentBg.className = parentBg.className.replace('bg-green-50', 'bg-red-50');
                    }
                }
            });

            // Update Add to Cart buttons - Enhanced disabled state
            const addToCartBtns = productCard.querySelectorAll('.add-to-cart-btn');
            addToCartBtns.forEach(btn => {
                btn.setAttribute('data-product-stock', remainingStock);
                
                if (remainingStock <= 0) {
                    // Disable the button
                    btn.disabled = true;
                    
                    // Update button content
                    btn.innerHTML = '<i class="fas fa-ban mr-2"></i>Out of Stock';
                    
                    // Remove all existing color classes and apply disabled styling
                    btn.className = btn.className
                        .replace(/bg-gradient-to-r/g, '')
                        .replace(/from-[\w-]+/g, '')
                        .replace(/to-[\w-]+/g, '')
                        .replace(/hover:from-[\w-]+/g, '')
                        .replace(/hover:to-[\w-]+/g, '')
                        .replace(/text-white/g, '')
                        .replace(/hover:[\w-]+/g, '');
                    
                    // Apply comprehensive disabled styling
                    btn.className += ' bg-gray-400 text-gray-700 cursor-not-allowed opacity-60 pointer-events-none';
                    
                    // Add disabled styling attributes
                    btn.style.cursor = 'not-allowed';
                    btn.style.opacity = '0.6';
                    btn.style.pointerEvents = 'none';
                    
                    // Remove any click event listeners by cloning the element
                    const newBtn = btn.cloneNode(true);
                    btn.parentNode.replaceChild(newBtn, btn);
                    
                } else {
                    // Re-enable the button if it was disabled
                    btn.disabled = false;
                    btn.style.cursor = 'pointer';
                    btn.style.opacity = '1';
                    btn.style.pointerEvents = 'auto';
                    
                    // Restore original button styling (basic restoration)
                    if (btn.className.includes('bg-gray-400')) {
                        btn.className = btn.className
                            .replace(/bg-gray-400/g, '')
                            .replace(/text-gray-700/g, '')
                            .replace(/cursor-not-allowed/g, '')
                            .replace(/opacity-60/g, '')
                            .replace(/pointer-events-none/g, '');
                        
                        // Restore original styling - you may need to customize this based on your design
                        btn.className += ' bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white';
                        btn.innerHTML = '<i class="fas fa-cart-plus mr-1"></i>Add to Cart';
                    }
                }
            });

            // Also update any other "Add to Cart" style buttons that might not have the exact class
            const allButtons = productCard.querySelectorAll('button');
            allButtons.forEach(btn => {
                if (btn.textContent.includes('Add to Cart') || btn.textContent.includes('Add') || 
                    btn.getAttribute('data-product-id') == productId) {
                    
                    if (remainingStock <= 0 && !btn.disabled) {
                        btn.disabled = true;
                        btn.innerHTML = '<i class="fas fa-ban mr-2"></i>Sold Out';
                        btn.className = 'px-4 py-2 bg-gray-400 text-gray-700 rounded-xl font-semibold cursor-not-allowed opacity-60 pointer-events-none';
                        btn.style.cursor = 'not-allowed';
                        btn.style.pointerEvents = 'none';
                    }
                }
            });
        });

        // Broadcast stock update to all users (if you implement WebSocket/SSE later)
        console.log(`Product ${productId} stock updated: ${remainingStock} remaining`);
    }

    // Function to sync stock status across all products on page
    function syncAllProductStock() {
        const productIds = [];
        
        // Collect all product IDs on current page
        document.querySelectorAll('[data-product]').forEach(element => {
            const productId = element.getAttribute('data-product');
            if (productId && !productIds.includes(productId)) {
                productIds.push(productId);
            }
        });

        document.querySelectorAll('[data-product-id]').forEach(element => {
            const productId = element.getAttribute('data-product-id');
            if (productId && !productIds.includes(productId)) {
                productIds.push(productId);
            }
        });

        if (productIds.length > 0) {
            fetch('{{ route("cart.stock-status") }}?' + new URLSearchParams({ 
                product_ids: productIds.join(',')
            }), {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success && data.stock_status) {
                    data.stock_status.forEach(item => {
                        updateProductStock(item.product_id, item.remaining_stock, item.total_in_cart);
                    });
                    console.log('Stock status synchronized for all products');
                } else if (data.message) {
                    console.warn('Stock sync warning:', data.message);
                }
            })
            .catch(error => {
                console.warn('Stock sync temporarily unavailable:', error.message);
                // Don't show errors to users, just log for debugging
            });
        }
    }

    // Auto-sync stock every 30 seconds (optional - you can adjust or remove this)
    setInterval(syncAllProductStock, 30000);

    // Sync stock when page becomes visible again (user switches back to tab)
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            syncAllProductStock();
        }
    });
});
</script>

<!-- Original Cart JS (commented out to avoid conflicts) -->
<!-- JS for Add to Cart -->
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        let cartItems = [];

        function renderCart() {
            const cartContainer = document.getElementById("cart-items-container");
            cartContainer.innerHTML = "";

            if (cartItems.length === 0) {
                cartContainer.innerHTML = `<p class="text-muted">Your cart is empty.</p>`;
                updateSubtotal();
                return;
            }

            cartItems.forEach((item, index) => {
                cartContainer.innerHTML += `
                <div class="cart_item d-flex align-items-center mb-3" data-index="${index}">
                    <div class="cart_img me-3">
                        <img src="${item.image}" alt="${item.name}" width="60" height="60" style="object-fit:cover;">
                    </div>
                    <div class="cart_content flex-grow-1">
                        <h6 class="mb-1">${item.name}</h6>
                        <p class="mb-1">TK: ${item.price.toFixed(2)}</p>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-outline-secondary decrement-btn">-</button>
                            <span class="mx-2">${item.quantity}</span>
                            <button class="btn btn-sm btn-outline-secondary increment-btn">+</button>
                        </div>
                    </div>
                </div>
            `;
            });

            attachQuantityEvents();
            updateSubtotal();
        }

        function attachQuantityEvents() {
            document.querySelectorAll(".increment-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    const index = this.closest(".cart_item").dataset.index;
                    cartItems[index].quantity++;
                    renderCart();
                });
            });

            document.querySelectorAll(".decrement-btn").forEach(btn => {
                btn.addEventListener("click", function() {
                    const index = this.closest(".cart_item").dataset.index;
                    if (cartItems[index].quantity > 1) {
                        cartItems[index].quantity--;
                    } else {
                        cartItems.splice(index, 1);
                    }
                    renderCart();
                });
            });
        }

        function updateSubtotal() {
            const subtotal = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            document.getElementById("cart-subtotal").innerHTML = `Subtotal: TK:${subtotal.toFixed(2)}`;
        }

        document.querySelectorAll(".add-to-cart-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const price = parseFloat(this.dataset.price);
                const image = this.dataset.image;

                const existingItem = cartItems.find(item => item.id === id);
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    cartItems.push({
                        id,
                        name,
                        price,
                        image,
                        quantity: 1
                    });
                }

                renderCart();

                // Open your existing offcanvas
                const cartOffcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasScrolling'));
                cartOffcanvas.show();
            });
        });
    });
</script> -->


<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {

        function updateCartUI(cartHtml, subtotal) {
            document.getElementById('cart-items-container').innerHTML = cartHtml;
            document.getElementById('cart-subtotal').innerText = `Subtotal: TK:${subtotal}`;
        }

        // Add to Cart
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let data = {
                    id: this.dataset.id,
                    name: this.dataset.name,
                    price: this.dataset.price,
                    image: this.dataset.image,
                    _token: '{{ csrf_token() }}'
                };

                fetch('{{ route("cart.add") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(res => res.json())
                    .then(data => {
                        updateCartUI(data.html, data.subtotal);
                    });
            });
        });

        // Increment / Decrement Buttons
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('increment-btn') || e.target.classList.contains('decrement-btn')) {
                e.preventDefault();
                let id = e.target.dataset.id;
                let quantity = parseInt(e.target.closest('.cart_item').querySelector('.quantity').innerText);
                if (e.target.classList.contains('decrement-btn')) quantity--;
                if (quantity < 1) quantity = 1;

                fetch('{{ route("cart.update") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: id,
                            quantity: quantity
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        updateCartUI(data.html, data.subtotal);
                    });
            }
        });

    });
</script> -->



<script>
    // Show notification on page load
    window.addEventListener('DOMContentLoaded', () => {
        const notification = document.getElementById('notification');
        notification.classList.remove('hidden');

        // Hide notification after 5 seconds
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 5000);
    });

    // Additional cart functionality (if needed)
    // Cart offcanvas is already handled above

    // Mobile menu functionality
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuContent = document.getElementById('mobileMenuContent');
    const closeMobileMenu = document.getElementById('closeMobileMenu');

    mobileMenuToggle.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
        setTimeout(() => {
            mobileMenuContent.classList.remove('-translate-x-full');
        }, 10);
    });

    closeMobileMenu.addEventListener('click', () => {
        mobileMenuContent.classList.add('-translate-x-full');
        setTimeout(() => {
            mobileMenu.classList.add('hidden');
        }, 300);
    });

    // Close mobile menu when clicking outside
    mobileMenu.addEventListener('click', (e) => {
        if (e.target === mobileMenu) {
            mobileMenuContent.classList.add('-translate-x-full');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);
        }
    });
</script>