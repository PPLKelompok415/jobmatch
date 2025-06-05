<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Message; 
use Livewire\Component;

class Chat extends Component
{
    public User $user;
    public $messageContent = ''; // Properti untuk menyimpan konten pesan

    public function mount(User $user)
    {
        $this->user = $user; // Inisialisasi user yang akan di-chat
    }
    public function render()
    {
        $senderId = auth()->id();
        $receiverId = $this->user->id;
        $company_name = $this->user->company->company_name ?? 'Unknown Company';

        $messages = Message::where(function($query) use ($senderId, $receiverId) {
                        $query->where('sender_id', $senderId)
                            ->where('receiver_id', $receiverId);
                    })
                    ->orWhere(function($query) use ($senderId, $receiverId) {
                        $query->where('sender_id', $receiverId)
                            ->where('receiver_id', $senderId);
                    })
                    ->exists();
        if (!$messages) {
            $messageContent = "Good Afternoon! Previously, let me introduce myself, my name is {$this->user->name}, I am glad you can match with our company. We're excited to discuss this opportunity with you. How can I assist you today?";
            Message::create([
                'sender_id' => $this->user->id,
                'receiver_id' => auth()->id(),
                'message' => $messageContent,
            ]);
        }
        return view('livewire.chat', [
            'messages' => Message::where(function($query) use ($senderId, $receiverId) {
                            $query->where('sender_id', $senderId)
                                ->where('receiver_id', $receiverId);
                        })
                        ->orWhere(function($query) use ($senderId, $receiverId) {
                            $query->where('sender_id', $receiverId)
                                ->where('receiver_id', $senderId);
                        })
                        ->orderBy('created_at', 'asc')
                        ->get(),
            'company_name' => $company_name,
        ])
            ->extends('components.layouts.app')
            ->section('content');
    }

    public function sendMessage()
    {
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->user->id,
            'message' => $this->messageContent,
        ]);

        $this->messageContent = '';
    }
}
