<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Job;
use App\Models\Message; 
use Livewire\Component;

class Chat extends Component
{
    public User $user;
    public $jobId;
    public $messageContent = ''; 

    public function mount(User $user, $job)
    {
        $this->user = $user;
        $this->jobId = $job;
    }

    public function render()
    {
        $senderId = auth()->id();
        $receiverId = $this->user->id;
        $jobId = $this->jobId;
        $userRole = auth()->user()->role;
        $company_name = $this->user->company->company_name ?? 'Unknown Company';
        $job = Job::find($jobId);

        $layout = 'components.layouts.dashboardapplicant';
        if ($userRole == 'company') {
            $layout = 'components.layouts.dashboardcompany';
        }
        $messages = Message::where(function($query) use ($senderId, $receiverId, $jobId) {
                        $query->where('sender_id', $senderId)
                            ->where('receiver_id', $receiverId)
                            ->where('job_id', $jobId);
                    })
                    ->orWhere(function($query) use ($senderId, $receiverId, $jobId) {
                        $query->where('sender_id', $receiverId)
                            ->where('receiver_id', $senderId)
                            ->where('job_id', $jobId);
                    })
                    ->exists();
                    
        if (!$messages) {
            $messageContent = "Good Afternoon! Previously, let me introduce myself, my name is {$this->user->name}, I am glad you can match with our company. We're excited to discuss this opportunity with you. How can I assist you today?";
            Message::create([
                'sender_id' => $this->user->id,
                'receiver_id' => auth()->id(),
                'job_id' => $this->jobId,
                'message' => $messageContent,
            ]);
        }
        return view('livewire.chat', [
            'messages' => Message::where(function($query) use ($senderId, $receiverId, $jobId) {
                            $query->where('sender_id', $senderId)
                                ->where('receiver_id', $receiverId)
                                ->where('job_id', $jobId);
                        })
                        ->orWhere(function($query) use ($senderId, $receiverId, $jobId) {
                            $query->where('sender_id', $receiverId)
                                ->where('receiver_id', $senderId)
                                ->where('job_id', $jobId);
                        })
                        ->orderBy('created_at', 'asc')
                        ->get(),
            'company_name' => $company_name,
            'job_title' => $job->title ?? 'Unknown Job Title',
        ])
            ->extends($layout)
            ->section('content');
    }

    public function sendMessage()
    {
        $this->validate([
            'messageContent' => 'required|string|max:500',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->user->id,
            'job_id' => $this->jobId,
            'message' => $this->messageContent,
        ]);

        $this->messageContent = '';
    }

    public function endChat()
    {
        $senderId = auth()->id();
        $receiverId = $this->user->id;
        $jobId = $this->jobId;

        Message::where(function($query) use ($senderId, $receiverId, $jobId) {
                        $query->where('sender_id', $senderId)
                            ->where('receiver_id', $receiverId)
                            ->where('job_id', $jobId);
                    })
                    ->orWhere(function($query) use ($senderId, $receiverId, $jobId) {
                        $query->where('sender_id', $receiverId)
                            ->where('receiver_id', $senderId)
                            ->where('job_id', $jobId);
                    })
                    ->delete();

        return redirect()->route('chat.index');
    }
}
