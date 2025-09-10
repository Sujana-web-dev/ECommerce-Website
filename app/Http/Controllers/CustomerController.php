<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Get customer details for modal display
     */
    public function getCustomerDetails($id)
    {
        try {
            // Get customer with orders
            $customer = User::where('id', $id)
                ->where(function($query) {
                    $query->where('role', '!=', 'admin')
                          ->orWhereNull('role');
                })
                ->where(function($query) {
                    $query->where('user_type', '!=', 'admin')
                          ->orWhereNull('user_type');
                })
                ->first();

            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer not found'
                ], 404);
            }

            // Get customer orders
            $orders = Order::where('user_id', $customer->id)
                ->orderBy('created_at', 'desc')
                ->get();

            // Calculate total spent
            $totalSpent = $orders->sum('total');

            // Get last order
            $lastOrder = $orders->first();

            return response()->json([
                'success' => true,
                'customer' => [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'username' => $customer->username,
                    'role' => $customer->role ?? $customer->user_type ?? 'customer',
                    'created_at' => $customer->created_at,
                ],
                'orders' => $orders->map(function($order) {
                    return [
                        'id' => $order->id,
                        'total' => $order->total,
                        'status' => $order->status,
                        'created_at' => $order->created_at,
                        'items_count' => $order->items->count()
                    ];
                }),
                'total_spent' => $totalSpent,
                'last_order' => $lastOrder ? [
                    'id' => $lastOrder->id,
                    'total' => $lastOrder->total,
                    'status' => $lastOrder->status,
                    'created_at' => $lastOrder->created_at,
                ] : null
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving customer details: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display customer list
     */
    public function index(Request $request)
    {
        $query = User::where(function($q) {
                    $q->where('role', '!=', 'admin')
                      ->orWhereNull('role');
                })
                ->where(function($q) {
                    $q->where('user_type', '!=', 'admin')
                      ->orWhereNull('user_type');
                });

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        return view('admin.customers.customerList', compact('users'));
    }
}
