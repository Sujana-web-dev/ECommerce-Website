<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'delivery' => 'required|string'
        ]);

        $user = Auth::user();

        // Get cart items
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
        if ($cartItems->isEmpty()) {
            return back()->with('error','Your cart is empty.');
        }

        // Calculate total
        $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->amount);

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'delivery_option' => $request->delivery,
            'total' => $total,
            'status' => 'pending', // Set initial status as pending
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'price' => $item->product->amount,
            ]);
        }

        // Clear cart
        CartItem::where('user_id', $user->id)->delete();

        // Redirect to invoice page
        return redirect()->route('cart.invoice', $order->id)->with('success', 'Order placed successfully!');
    }

    public function invoice($id)
    {
        $order = Order::with(['items.product'])->findOrFail($id);
        return view('frontend.cart.invoice', compact('order'));
    }
}
