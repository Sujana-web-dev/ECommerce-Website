<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * Get quantity of specific product in cart
     */
    public function getProductQuantityInCart($productId)
    {
        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();
            return $cartItem ? $cartItem->quantity : 0;
        } else {
            $cart = session('cart', []);
            $key = $this->getSessionKey($productId, []);
            return isset($cart[$key]) ? $cart[$key]['quantity'] : 0;
        }
    }

    /**
     * Add product to cart (session for guest, database for authenticated user)
     */
    public function add($productId, $qty = 1, $options = [])
    {
        $product = Product::findOrFail($productId);

        if (Auth::check()) {
            // For authenticated users, store in database
            return $this->addToDatabase($product, $qty, $options);
        } else {
            // For guest users, store in session
            return $this->addToSession($product, $qty, $options);
        }
    }

    /**
     * Get all cart items for current user (session or database)
     */
    public function get()
    {
        if (Auth::check()) {
            return $this->getDatabaseCart();
        } else {
            return $this->getSessionCart();
        }
    }

    /**
     * Get cart count
     */
    public function count()
    {
        $cart = $this->get();
        return $cart->sum('quantity');
    }

    /**
     * Get cart total
     */
    public function total()
    {
        $cart = $this->get();
        return $cart->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });
    }

    /**
     * Merge session cart to user database cart when user logs in
     */
    public function mergeSessionToUser($user)
    {
        $sessionCart = session('cart', []);
        
        if (empty($sessionCart)) {
            return;
        }

        foreach ($sessionCart as $key => $item) {
            // Extract the actual product_id from the item data, not the session key
            $productId = $item['product_id'];
            $product = Product::find($productId);
            if (!$product) {
                continue;
            }

            // Check if product already exists in user's database cart
            $existingItem = CartItem::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();

            if ($existingItem) {
                // If exists, increase quantity
                $existingItem->quantity += $item['quantity'];
                $existingItem->save();
            } else {
                // If doesn't exist, create new cart item
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        // Clear session cart after merging
        session()->forget('cart');
    }

    /**
     * Update cart item quantity
     */
    public function update($productId, $quantity, $options = [])
    {
        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        } else {
            $cart = session('cart', []);
            $key = $this->getSessionKey($productId, $options);
            
            if (isset($cart[$key])) {
                $cart[$key]['quantity'] = $quantity;
                session()->put('cart', $cart);
            }
        }
    }

    /**
     * Remove item from cart
     */
    public function remove($productId, $options = [])
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();
        } else {
            $cart = session('cart', []);
            $key = $this->getSessionKey($productId, $options);
            
            if (isset($cart[$key])) {
                unset($cart[$key]);
                session()->put('cart', $cart);
            }
        }
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }
    }

    /**
     * Add product to database cart
     */
    private function addToDatabase($product, $qty, $options)
    {
        $existingItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingItem) {
            $existingItem->quantity += $qty;
            $existingItem->save();
            return $existingItem;
        } else {
            return CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $qty,
            ]);
        }
    }

    /**
     * Add product to session cart
     */
    private function addToSession($product, $qty, $options)
    {
        $cart = session('cart', []);
        $key = $this->getSessionKey($product->id, $options);

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $qty;
        } else {
            $cart[$key] = [
                'product_id' => $product->id,
                'product' => $product->toArray(),
                'quantity' => $qty,
                'price' => $product->amount,
                'options' => $options,
            ];
        }

        session()->put('cart', $cart);
        return $cart[$key];
    }

    /**
     * Get database cart items
     */
    private function getDatabaseCart()
    {
        return CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get()
            ->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'product' => $item->product,
                    'quantity' => $item->quantity,
                    'price' => $item->product->amount ?? 0, // Use product price since we don't have price column yet
                    'options' => [], // Empty array since we don't have options column yet
                ];
            });
    }

    /**
     * Get session cart items
     */
    private function getSessionCart()
    {
        $cart = session('cart', []);
        return collect($cart)->map(function ($item) {
            // Convert product array back to object for consistent interface
            if (is_array($item['product'])) {
                $item['product'] = (object) $item['product'];
            }
            return $item;
        })->values();
    }

    /**
     * Generate unique key for session cart based on product ID and options
     */
    private function getSessionKey($productId, $options)
    {
        return $productId . '_' . md5(json_encode($options));
    }
}
