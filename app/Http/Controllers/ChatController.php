<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // public function create($id)
    // {
    //     $conversation = Conversation::firstOrCreate([
    //         'patient_id' => auth()->guard('patient')->id(),
    //         'doctor_id' => $id, // You can set this dynamically based on the doctor the patient wants to chat with
    //     ]);
    //     return redirect()->route('chat.show', $conversation->id);
    // }
    // public function show($id)
    // {
    //     $conversation = Conversation::findOrFail($id);

    //     $messages = Message::where('conversation_id', $id)->get();

    //     return view('front.chat', compact('conversation', 'messages'));
    // }

    public function FrontClinicChat($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $patient_id = $appointment->patient_id;
        $doctor_id = $appointment->doctor_id;
        $conversation = Conversation::firstOrCreate([
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
        ]);
        return redirect()->route('front.chat.show', $conversation->id);
    }

    public function frontShow($id)
    {
        $conversation = Conversation::findOrFail($id);
        $messages = Message::where('conversation_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();
        return view('front.chats.show', compact('conversation', 'messages'));
    }

    public function doctorClinicChat($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $patient_id = $appointment->patient_id;
        $doctor_id = $appointment->doctor_id;
        $conversation = Conversation::firstOrCreate([
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
        ]);
        return redirect()->route('chat.show', $conversation->id);
    }

    public function doctorShow($id)
    {
        $conversation = Conversation::findOrFail($id);
        $messages = Message::where('conversation_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();
        return view('dashboard.chats.show', compact('conversation', 'messages'));
    }


    public function send(Request $request)
    {
        Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => $request->sender_id,
            'sender_type' => $request->sender_type,
            'message' => $request->message
        ]);
        return response()->json(['status' => 'ok']);
    }

    public function fetchMessages(Request $request, $conversationId)
    {
        $query = Message::where('conversation_id', $conversationId);

        if ($request->last_id) {
            $query->where('id', '>', $request->last_id);
        }

        return $query->orderBy('id')->get();
    }
}
