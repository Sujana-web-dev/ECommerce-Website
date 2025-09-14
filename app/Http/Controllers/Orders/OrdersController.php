<?php

namespace App\Http\Controllers\Orders;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    // Admin Methods
    public function index()
    {
        $orders = Order::with(['user','items.product'])->orderBy('created_at','desc')->get();
        return view('admin.orders.allOrder', compact('orders'));
    }

    public function pending()
    {
        $orders = Order::with(['user','items.product'])
                      ->where('status', 'pending')
                      ->orderBy('created_at','desc')
                      ->get();
        return view('admin.orders.pendingOrder', compact('orders'));
    }

    public function approved()
    {
        $orders = Order::with(['user','items.product'])
                      ->where('status', 'approved')
                      ->orderBy('created_at','desc')
                      ->get();
        return view('admin.orders.approvedOrder', compact('orders'));
    }

    public function processing()
    {
        $orders = Order::with(['user','items.product'])
                      ->where('status', 'processing')
                      ->orderBy('created_at','desc')
                      ->get();
        return view('admin.orders.processingOrder', compact('orders'));
    }

    public function outForDelivery()
    {
        $orders = Order::with(['user','items.product'])
                      ->where('status', 'out_for_delivery')
                      ->orderBy('created_at','desc')
                      ->get();
        return view('admin.orders.outForDeliveryOrder', compact('orders'));
    }

    public function completed()
    {
        $orders = Order::with(['user','items.product'])
                      ->where('status', 'delivered')
                      ->orderBy('created_at','desc')
                      ->get();
        return view('admin.orders.completeOrder', compact('orders'));
    }

    public function cancelled()
    {
        $orders = Order::with(['user','items.product'])
                      ->where('status', 'cancelled')
                      ->orderBy('created_at','desc')
                      ->get();
        return view('admin.orders.cancelledOrder', compact('orders'));
    }

    public function shipping()
    {
        $orders = Order::with(['user','items.product'])
                      ->whereIn('status', ['processing', 'out_for_delivery'])
                      ->orderBy('created_at','desc')
                      ->get();
        return view('admin.orders.shipping', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user','items.product.category'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,processing,out_for_delivery,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully!'
        ]);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        
        return back()->with('success', 'Order deleted successfully!');
    }

    // User Methods
    public function userOrderHistory()
    {
        $orders = Order::with(['items.product'])
                      ->where('user_id', Auth::id())
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        return view('frontend.cart.orderHistory', compact('orders'));
    }

    public function userOrderDetails($id)
    {
        $order = Order::with(['items.product'])
                     ->where('user_id', Auth::id())
                     ->findOrFail($id);
        
        return view('frontend.cart.orderDetails', compact('order'));
    }

    public function cancelOrder(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())
                     ->where('id', $id)
                     ->whereIn('status', ['pending', 'approved'])
                     ->firstOrFail();
        
        $order->status = 'cancelled';
        $order->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Order cancelled successfully!'
        ]);
    }
}
