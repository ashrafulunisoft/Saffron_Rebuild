<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Submit contact form.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Create contact record
        $contact = Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? 'No Subject',
            'message' => $validated['message'],
        ]);

        // Send email notification (optional)
        // Mail::to('info@saffronsweets.com.bd')->send(new NewContactMail($contact));

        return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
