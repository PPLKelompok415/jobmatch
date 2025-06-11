<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// app/Http/Controllers/ChatController.php
class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->orderBy('created_at')
            ->get();

        $receiver = User::where('role', 'admin')->first(); // contoh penerima

        return view('chat', compact('messages', 'receiver'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return redirect()->back();
    }
}

