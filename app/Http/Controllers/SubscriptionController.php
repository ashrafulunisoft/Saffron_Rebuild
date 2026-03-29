<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Handle newsletter subscription.
     */
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'You are already subscribed to our newsletter.',
        ]);

        // Create subscriber
        $subscriber = Subscriber::create([
            'email' => $validated['email'],
            'is_active' => true,
            'subscribed_at' => now(),
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing! You\'ll receive our sweet updates soon.'
        ]);
    }

    /**
     * Unsubscribe from newsletter.
     */
    public function unsubscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:subscribers,email',
        ]);

        $subscriber = Subscriber::where('email', $validated['email'])->first();
        $subscriber->update(['is_active' => false]);

        return response()->json([
            'success' => true,
            'message' => 'You have been unsubscribed successfully.'
        ]);
    }
}
