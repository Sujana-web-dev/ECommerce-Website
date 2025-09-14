<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'category' => 'required|in:support,sales,complaint,feedback,refund,general',
        ]);

        $contactData = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'category' => $request->category,
            'priority' => $this->determinePriority($request->category, $request->message),
            'status' => 'unread',
        ];

        // If user is authenticated, associate the message with the user
        if (Auth::check()) {
            $contactData['user_id'] = Auth::id();
        }

        Contact::create($contactData);

        return redirect()->back()->with('success', 'Your message has been sent successfully. We will get back to you soon!');
    }

    private function determinePriority($category, $message)
    {
        // Auto-determine priority based on category and keywords
        $highPriorityKeywords = ['urgent', 'emergency', 'broken', 'damaged', 'refund', 'complaint', 'issue', 'problem'];
        $lowPriorityKeywords = ['feedback', 'suggestion', 'thank', 'great', 'good', 'excellent'];

        $messageWords = strtolower($message);

        if ($category === 'complaint' || $category === 'refund') {
            return 'high';
        }

        if ($category === 'feedback') {
            return 'low';
        }

        foreach ($highPriorityKeywords as $keyword) {
            if (strpos($messageWords, $keyword) !== false) {
                return 'high';
            }
        }

        foreach ($lowPriorityKeywords as $keyword) {
            if (strpos($messageWords, $keyword) !== false) {
                return 'low';
            }
        }

        return 'medium';
    }
}
