<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




<script>
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
            if (data.success) location.reload();
        });
    }

    function removeCart(id) {
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
            if (data.success) location.reload();
        });
    }
</script>



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

    // Cart functionality
    const cartToggle = document.getElementById('cartToggle');
    const cartSidebar = document.getElementById('cartSidebar');
    const closeCart = document.getElementById('closeCart');

    cartToggle.addEventListener('click', () => {
        cartSidebar.classList.remove('translate-x-full');
    });

    closeCart.addEventListener('click', () => {
        cartSidebar.classList.add('translate-x-full');
    });

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