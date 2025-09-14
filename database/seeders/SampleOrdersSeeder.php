<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class SampleOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing users and products
        $users = User::all();
        $products = Product::all();
        
        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->warn('No users or products found. Please seed users and products first.');
            return;
        }

        // Create sample orders for the last 12 months
        for ($month = 11; $month >= 0; $month--) {
            $date = Carbon::now()->subMonths($month);
            
            // Create 3-15 orders per month
            $ordersCount = rand(3, 15);
            
            for ($i = 0; $i < $ordersCount; $i++) {
                // Random date within the month
                $orderDate = $date->copy()->addDays(rand(0, $date->daysInMonth - 1));
                
                $user = $users->random();
                
                $order = Order::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => fake()->phoneNumber(),
                    'address' => fake()->address(),
                    'status' => collect(['pending', 'processing', 'shipping', 'completed', 'cancelled'])->random(),
                    'total' => 0, // Will be calculated
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]);
                
                // Add 1-5 products to each order
                $itemsCount = rand(1, 5);
                $orderTotal = 0;
                
                for ($j = 0; $j < $itemsCount; $j++) {
                    $product = $products->random();
                    $quantity = rand(1, 3);
                    $price = $product->amount; // Using 'amount' field as price
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price,
                        'created_at' => $orderDate,
                        'updated_at' => $orderDate,
                    ]);
                    
                    $orderTotal += $quantity * $price;
                }
                
                // Update order total
                $order->update(['total' => $orderTotal]);
            }
        }
        
        $this->command->info('Sample orders created successfully!');
    }
}
