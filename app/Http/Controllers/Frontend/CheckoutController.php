<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function checkout(Request $request)
    {
        $user = $request->user();

        // Validate and process the order...
        $total = 0; // Calculate the total amount
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        foreach ($cartItems as $item) {
            $total += $item->product->amount * $item->quantity;
        }

        $newOrder = Order::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'delivery_option' => $request->delivery,
            'total' => $total,
        ]);

        foreach($cartItems as $item){
            OrderItem::create([
                'order_id' => $newOrder->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'price' => $item->product->amount,
            ]);
        }

        // Clear cart
        CartItem::where('user_id', $user->id)->delete();

        // Fetch order with items for invoice
        $order = Order::with(['items.product'])->find($newOrder->id);
        return redirect()->route('cart.invoice')->with('order', $order);
    }
}