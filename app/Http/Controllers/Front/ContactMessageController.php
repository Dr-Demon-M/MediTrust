<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{

    public function index()
    {
        return view('front.more.contact');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string',
            'message' => 'required|string|min:1',
        ]);

        try {
            ContactMessage::create($data);
            Mail::to('8eznooo@gmail.com')->queue(new ContactMail($data));
            return back()->with('success', 'Thank you! Your message has been sent to our medical team.');
        } catch (\Exception $e) {
            return back()->with('error', 'Message saved, but failed to send email notification.');
        }
    }
}
