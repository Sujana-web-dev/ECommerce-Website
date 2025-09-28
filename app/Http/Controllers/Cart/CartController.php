<?php
namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->get();
        $cartCount = $this->cartService->count();
        $cartTotal = $this->cartService->total();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'cart' => array_values($cart->toArray()), // Ensure indexed array for JavaScript
                'cart_count' => $cartCount,
                'cart_total' => $cartTotal
            ]);
        }

        return view('frontend.cart.index', compact('cart', 'cartCount', 'cartTotal'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'options' => 'sometimes|array'
        ]);

        try {
            // Check if product exists and get it
            $product = Product::findOrFail($request->product_id);
            
            // Check if product is in stock
            if (!$product->isInStock()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, this product is currently out of stock.',
                    'stock_error' => true,
                    'product_name' => $product->name
                ], 400);
            }
            
            // Check if requested quantity is available
            if ($product->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => "Sorry, only {$product->stock} items are available in stock.",
                    'stock_error' => true,
                    'available_stock' => $product->stock,
                    'product_name' => $product->name
                ], 400);
            }

            // Check current cart to see if adding more would exceed stock
            $currentCartQuantity = $this->cartService->getProductQuantityInCart($request->product_id);
            $totalQuantity = $currentCartQuantity + $request->quantity;
            
            if ($totalQuantity > $product->stock) {
                $availableToAdd = $product->stock - $currentCartQuantity;
                if ($availableToAdd <= 0) {
                    return response()->json([
                        'success' => false,
                        'message' => "You already have the maximum available quantity ({$product->stock}) of this product in your cart.",
                        'stock_error' => true,
                        'product_name' => $product->name
                    ], 400);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => "You can only add {$availableToAdd} more of this item to your cart (you already have {$currentCartQuantity} in cart, stock available: {$product->stock}).",
                        'stock_error' => true,
                        'available_to_add' => $availableToAdd,
                        'product_name' => $product->name
                    ], 400);
                }
            }

            $this->cartService->add(
                $request->product_id,
                $request->quantity,
                $request->options ?? []
            );

            $cart = $this->cartService->get();
            $cartCount = $this->cartService->count();
            
            // Debug: Log the cart structure
            Log::info('Cart structure in add method:', [
                'cart_type' => get_class($cart),
                'cart_data' => $cart->toArray(),
                'count' => $cartCount
            ]);
            
            // Get updated product information for stock display
            $updatedProduct = Product::find($request->product_id);
            $totalInCart = $this->cartService->getProductQuantityInCart($request->product_id);
            $remainingStock = max(0, $updatedProduct->stock - $totalInCart);

            // Ensure proper array structure for JavaScript
            $cartArray = $cart->toArray();

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart' => array_values($cartArray), // Ensure indexed array for JavaScript
                'cart_count' => $cartCount,
                'product_id' => $request->product_id,
                'total_in_cart' => $totalInCart,
                'remaining_stock' => $remainingStock,
                'original_stock' => $updatedProduct->stock
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'options' => 'sometimes|array'
        ]);

        try {
            $this->cartService->update(
                $request->product_id,
                $request->quantity,
                $request->options ?? []
            );

            $cart = $this->cartService->get();
            $cartCount = $this->cartService->count();

            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully!',
                'cart' => $cart->toArray(), // Convert collection to array for JavaScript
                'cart_count' => $cartCount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'options' => 'sometimes|array'
        ]);

        try {
            $this->cartService->remove(
                $request->product_id,
                $request->options ?? []
            );

            $cart = $this->cartService->get();
            $cartCount = $this->cartService->count();

            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart successfully!',
                'cart' => $cart->toArray(), // Convert collection to array for JavaScript
                'cart_count' => $cartCount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove product from cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function clear()
    {
        try {
            $this->cartService->clear();

            return response()->json([
                'success' => true,
                'message' => 'Cart cleared successfully!',
                'cart' => [],
                'cart_count' => 0
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getStockStatus(Request $request)
    {
        try {
            $productIds = $request->get('product_ids', []);
            
            // Convert string to array if needed
            if (is_string($productIds)) {
                $productIds = explode(',', $productIds);
            }
            
            // Filter out empty values and ensure integers
            $productIds = array_filter(array_map('intval', $productIds));
            
            if (empty($productIds)) {
                return response()->json([
                    'success' => true,
                    'stock_status' => []
                ]);
            }

            // Get specific products
            $products = Product::whereIn('id', $productIds)->get();

            $stockStatus = [];
            
            foreach ($products as $product) {
                $totalInCart = $this->cartService->getProductQuantityInCart($product->id);
                $remainingStock = max(0, $product->stock - $totalInCart);
                
                $stockStatus[] = [
                    'product_id' => $product->id,
                    'original_stock' => $product->stock,
                    'total_in_cart' => $totalInCart,
                    'remaining_stock' => $remainingStock,
                    'is_available' => $remainingStock > 0
                ];
            }

            return response()->json([
                'success' => true,
                'stock_status' => $stockStatus
            ]);

        } catch (\Exception $e) {
            Log::error('Stock status error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to get stock status: ' . $e->getMessage()
            ], 500);
        }
    }
}
