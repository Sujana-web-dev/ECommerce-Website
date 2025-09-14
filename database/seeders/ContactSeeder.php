<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some existing users from the database
        $users = User::limit(5)->get();
        
        $sampleContacts = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@email.com',
                'subject' => 'Issue with my recent order',
                'message' => 'Hi, I received my order yesterday but one of the items seems to be damaged. Could you please help me with a replacement? The order number is ORD-2024-001 and the damaged item is the Smart Watch Pro.',
                'category' => 'support',
                'status' => 'unread',
                'priority' => 'high',
                'created_at' => now()->subHours(2),
            ],
            [
                'name' => 'Mike Chen',
                'email' => 'mike.chen@email.com',
                'subject' => 'Product inquiry about Smart Watch Pro',
                'message' => 'Hello, I\'m interested in purchasing the Smart Watch Pro. Can you provide more details about battery life and water resistance? Also, do you offer any warranty?',
                'category' => 'sales',
                'status' => 'replied',
                'priority' => 'medium',
                'replied_at' => now()->subHours(5),
                'admin_response' => 'Hi Mike, thank you for your interest! The Smart Watch Pro has 7-day battery life and IP68 water resistance. We offer 2-year warranty. Would you like more details?',
                'created_at' => now()->subHours(8),
            ],
            [
                'name' => 'Emily Rodriguez',
                'email' => 'emily.r@email.com',
                'subject' => 'Refund request for cancelled order',
                'message' => 'I had to cancel my order due to personal reasons. When can I expect the refund to be processed? Order number is ORD-2024-018. Please let me know the timeline.',
                'category' => 'refund',
                'status' => 'pending',
                'priority' => 'high',
                'created_at' => now()->subDay(),
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson@email.com',
                'subject' => 'Great experience with your service!',
                'message' => 'Just wanted to say thank you for the excellent customer service. The delivery was fast and the product quality is amazing! I will definitely recommend your store to my friends.',
                'category' => 'feedback',
                'status' => 'replied',
                'priority' => 'low',
                'replied_at' => now()->subHours(12),
                'admin_response' => 'Thank you so much David! We really appreciate your kind words and are thrilled you had a great experience with us.',
                'created_at' => now()->subDays(2),
            ],
            [
                'name' => 'Lisa Parker',
                'email' => 'lisa.parker@email.com',
                'subject' => 'Complaint about delayed shipping',
                'message' => 'My order was supposed to arrive 3 days ago but it\'s still showing as "processing". This is very disappointing and I need the items urgently.',
                'category' => 'complaint',
                'status' => 'unread',
                'priority' => 'high',
                'created_at' => now()->subHours(6),
            ],
            [
                'name' => 'Alex Thompson',
                'email' => 'alex.thompson@email.com',
                'subject' => 'Technical support needed',
                'message' => 'I\'m having trouble setting up the Bluetooth connection on my new headphones. Could someone guide me through the process? I\'ve tried the manual but it\'s not clear.',
                'category' => 'support',
                'status' => 'pending',
                'priority' => 'medium',
                'created_at' => now()->subDays(1)->subHours(5),
            ],
            [
                'name' => 'Jennifer White',
                'email' => 'jennifer.white@email.com',
                'subject' => 'Question about bulk orders',
                'message' => 'We\'re interested in placing a bulk order for our company. Do you offer corporate discounts and what\'s the minimum quantity? We need about 50 units.',
                'category' => 'sales',
                'status' => 'replied',
                'priority' => 'medium',
                'replied_at' => now()->subDays(1),
                'admin_response' => 'Hi Jennifer! Yes, we do offer corporate discounts for bulk orders. For 50+ units, you get 15% discount. Let me connect you with our sales team.',
                'created_at' => now()->subDays(2)->subHours(8),
            ],
            [
                'name' => 'Robert Brown',
                'email' => 'robert.brown@email.com',
                'subject' => 'Website navigation feedback',
                'message' => 'The new website design looks great! However, I found it a bit difficult to find the search function. Maybe make it more prominent? Otherwise, great job!',
                'category' => 'feedback',
                'status' => 'unread',
                'priority' => 'low',
                'created_at' => now()->subDays(3)->subHours(2),
            ]
        ];

        // Create contacts and associate some with existing users
        foreach ($sampleContacts as $index => $contactData) {
            // Randomly assign some contacts to existing users
            if ($users->count() > 0 && rand(0, 1)) {
                $user = $users->random();
                $contactData['user_id'] = $user->id;
                $contactData['name'] = $user->name;
                $contactData['email'] = $user->email;
            }

            Contact::create($contactData);
        }
    }
}
