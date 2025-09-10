<?php
namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
         // Load products from DB if user is logged in OR from session for guest
        if (Auth::check()) {
            $cart = \App\Models\CartItem::where('user_id', Auth::id())->with('product')->get();
        } else {
            $cart = collect(session('cart', []));
        }
        // $cart = collect(session()->get('cart', []));
        return view('frontend.cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (Auth::check()) {
            // For authenticated users, store in database
            $cartItem = \App\Models\CartItem::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                \App\Models\CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                ]);
            }

            // Get updated cart items for response
            $cartItems = \App\Models\CartItem::where('user_id', Auth::id())->with('product')->get();
            $cart = $cartItems->map(function($item) {
                return [
                    'product' => $item->product,
                    'quantity' => $item->quantity
                ];
            })->toArray();
        } else {
            // For guest users, store in session
            $cart = session()->get('cart', []);

            if(isset($cart[$product->id])){
                $cart[$product->id]['quantity'] += $request->quantity;
            } else {
                $cart[$product->id] = [
                    'product' => $product,
                    'quantity' => $request->quantity
                ];
            }

            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'cart_count' => count($cart),
            'message' => 'Product added to cart'
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        if (Auth::check()) {
            // For authenticated users, update in database
            $cartItem = \App\Models\CartItem::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity = $request->quantity;
                $cartItem->save();
            }

            // Get updated cart items for response
            $cartItems = \App\Models\CartItem::where('user_id', Auth::id())->with('product')->get();
            $cart = $cartItems->map(function($item) {
                return [
                    'product' => $item->product,
                    'quantity' => $item->quantity
                ];
            })->toArray();
        } else {
            // For guest users, update in session
            $cart = session()->get('cart', []);
            $id = $request->product_id;

            if(isset($cart[$id])){
                $cart[$id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
            }
        }

        return response()->json([
            'success' => true,
            'cart' => array_values($cart),
            'cart_count' => count($cart)
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        if (Auth::check()) {
            // For authenticated users, remove from database
            \App\Models\CartItem::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->delete();

            // Get updated cart items for response
            $cartItems = \App\Models\CartItem::where('user_id', Auth::id())->with('product')->get();
            $cart = $cartItems->map(function($item) {
                return [
                    'product' => $item->product,
                    'quantity' => $item->quantity
                ];
            })->toArray();
        } else {
            // For guest users, remove from session
            $cart = session()->get('cart', []);
            if(isset($cart[$request->product_id])){
                unset($cart[$request->product_id]);
                session()->put('cart', $cart);
            }
        }

        return response()->json([
            'success' => true, 
            'message' => 'Product removed from cart.',
            'cart' => array_values($cart),
            'cart_count' => count($cart)
        ]);
    }
}
