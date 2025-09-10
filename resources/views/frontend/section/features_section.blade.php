<!-- @extends('frontend.layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Your Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $id => $item)
            <tr>
                <td>
                    @if($item['image'])
                        <img src="{{ asset('storage/' . $item['image']) }}" width="60" alt="{{ $item['name'] ?? 'Product' }}"
                             onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='inline-block';">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light" style="display:none;width:60px;height:60px;">
                            <i class="fas fa-image text-muted"></i>
                        </div>
                    @else
                        <div class="d-inline-flex align-items-center justify-content-center bg-light" style="width:60px;height:60px;">
                            <i class="fas fa-image text-muted"></i>
                        </div>
                    @endif
                </td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ $item['price'] }} ৳</td>
                <td>{{ $item['price'] * $item['quantity'] }} ৳</td>
                <td>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Your cart is empty!</p>
    @endif
</div>
@endsection -->


<!-- Shopping Cart Sidebar -->
<!-- <div id="cartSidebar" class="fixed right-0 top-0 h-full w-full md:w-96 bg-white shadow-xl z-50 transform translate-x-full transition-transform duration-300">
    <div class="p-6 border-b">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-900">Your Cart</h3>
            <button id="closeCart" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
    </div> -->

    <!-- <div class="p-6 overflow-y-auto" style="height: calc(100% - 200px);">
       
        <div class="cart-item flex items-center mb-6 p-4 rounded-lg">
            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="Product" class="w-20 h-20 object-cover rounded-lg mr-4">
            <div class="flex-grow">
                <h4 class="font-bold text-gray-900">Premium Headphones</h4>
                <p class="text-gray-600 text-sm">$129.99</p>
            </div>
            <div class="flex items-center">
                <button class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-minus-circle"></i>
                </button>
                <span class="mx-2 font-medium">1</span>
                <button class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-plus-circle"></i>
                </button>
            </div>
            <button class="ml-4 text-gray-500 hover:text-red-500">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>

        
        <div class="cart-item flex items-center mb-6 p-4 rounded-lg">
            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="Product" class="w-20 h-20 object-cover rounded-lg mr-4">
            <div class="flex-grow">
                <h4 class="font-bold text-gray-900">Smart Watch Pro</h4>
                <p class="text-gray-600 text-sm">$249.99</p>
            </div>
            <div class="flex items-center">
                <button class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-minus-circle"></i>
                </button>
                <span class="mx-2 font-medium">1</span>
                <button class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-plus-circle"></i>
                </button>
            </div>
            <button class="ml-4 text-gray-500 hover:text-red-500">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>

        
        <div class="cart-item flex items-center mb-6 p-4 rounded-lg">
            <img src="https://images.unsplash.com/photo-1583394838336-acd977736f90?ixlib=rb-4.0.3&auto=format&fit=crop&w=1471&q=80" alt="Product" class="w-20 h-20 object-cover rounded-lg mr-4">
            <div class="flex-grow">
                <h4 class="font-bold text-gray-900">Wireless Earbuds</h4>
                <p class="text-gray-600 text-sm">$89.99</p>
            </div>
            <div class="flex items-center">
                <button class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-minus-circle"></i>
                </button>
                <span class="mx-2 font-medium">1</span>
                <button class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-plus-circle"></i>
                </button>
            </div>
            <button class="ml-4 text-gray-500 hover:text-red-500">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0 bg-white border-t p-6">
        <div class="flex justify-between mb-4">
            <span class="text-gray-600">Subtotal</span>
            <span class="font-bold text-gray-900">$469.97</span>
        </div>
        <div class="flex justify-between mb-6">
            <span class="text-gray-600">Shipping</span>
            <span class="font-bold text-gray-900">$0.00</span>
        </div>
        <div class="flex justify-between mb-6">
            <span class="text-lg font-bold text-gray-900">Total</span>
            <span class="text-lg font-bold text-gray-900">$469.97</span>
        </div>
        <button class="btn-primary text-white w-full py-3 rounded-lg font-medium shadow-lg mb-3">
            Proceed to Checkout
        </button>
        <button class="bg-white border border-gray-300 text-gray-800 w-full py-3 rounded-lg font-medium hover:bg-gray-50 transition">
            Continue Shopping
        </button>
    </div> -->
