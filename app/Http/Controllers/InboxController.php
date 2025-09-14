<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {
        try {
            // Check if Contact model exists and table is accessible
            if (!class_exists('App\Models\Contact')) {
                throw new \Exception('Contact model not found');
            }

            // Fetch all contacts with user relationships
            $contacts = Contact::with('user')->orderBy('created_at', 'desc')->get();
            
            // Calculate statistics
            $totalMessages = $contacts->count();
            $unreadMessages = $contacts->where('status', 'unread')->count();
            $todayMessages = $contacts->filter(function($contact) {
                return $contact->created_at && $contact->created_at->isToday();
            })->count();
            $repliedMessages = $contacts->where('status', 'replied')->count();
            $responseRate = $totalMessages > 0 ? round(($repliedMessages / $totalMessages) * 100, 1) : 0;
            
        } catch (\Exception $e) {
            // If contacts table doesn't exist or other error, return empty data
            $contacts = collect();
            $totalMessages = 0;
            $unreadMessages = 0;
            $todayMessages = 0;
            $responseRate = 0;
        }

        return view('admin.inbox.messageList', compact(
            'contacts', 
            'totalMessages', 
            'unreadMessages', 
            'todayMessages', 
            'responseRate'
        ));
    }

    public function updateStatus(Contact $contact, Request $request)
    {
        $request->validate([
            'status' => 'required|in:unread,replied,pending,closed'
        ]);

        $contact->update([
            'status' => $request->status,
            'replied_at' => $request->status === 'replied' ? now() : null
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json(['success' => true]);
    }
}
