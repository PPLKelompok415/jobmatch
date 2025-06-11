<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Message;
use App\Models\Job;
use Livewire\Component;
use Carbon\Carbon;

class ChatList extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $currentUserId = auth()->id();
        $userRole = auth()->user()->role;
        $conversations = collect();
        
        $layout = 'components.layouts.dashboardapplicant';
        if ($userRole == 'company') {
            $layout = 'components.layouts.dashboardcompany';
        }
        // Ambil semua kombinasi lawan chat dan job_id
        $messageCombos = Message::where(function($query) use ($currentUserId) {
                $query->where('sender_id', $currentUserId)
                    ->orWhere('receiver_id', $currentUserId);
            })
            ->select('sender_id', 'receiver_id', 'job_id')
            ->get()
            ->map(function($msg) use ($currentUserId) {
                // Tentukan lawan bicara
                $otherId = $msg->sender_id == $currentUserId ? $msg->receiver_id : $msg->sender_id;
                return [
                    'user_id' => $otherId,
                    'job_id' => $msg->job_id,
                ];
            })
            ->unique(function($item) {
                return $item['user_id'].'-'.$item['job_id'];
            });

        foreach($messageCombos as $combo) {
            $user = User::with('company')->find($combo['user_id']);
            if (!$user) continue;

            $job = Job::find($combo['job_id']);
            if (!$job) continue;
            
            // Filter search
            if ($this->searchTerm && 
                !str_contains(strtolower($user->name), strtolower($this->searchTerm)) &&
                !str_contains(strtolower($user->company->company_name ?? ''), strtolower($this->searchTerm)) &&
                !str_contains(strtolower($job->title ?? ''), strtolower($this->searchTerm))) {
                continue;
            }

            $lastMessage = Message::where(function($query) use ($currentUserId, $combo) {
                                    $query->where('sender_id', $currentUserId)
                                        ->where('receiver_id', $combo['user_id'])
                                        ->where('job_id', $combo['job_id']);
                                })
                                ->orWhere(function($query) use ($currentUserId, $combo) {
                                    $query->where('sender_id', $combo['user_id'])
                                        ->where('receiver_id', $currentUserId)
                                        ->where('job_id', $combo['job_id']);
                                })
                                ->orderBy('created_at', 'desc')
                                ->first();

            if (!$lastMessage) continue;

            // Hitung pesan belum dibaca
            $unreadCount = Message::where('sender_id', $combo['user_id'])
                                ->where('receiver_id', $currentUserId)
                                ->where('job_id', $combo['job_id'])
                                ->whereNull('read_at')
                                ->count();

            $conversations->push([
                'user' => $user,
                'job_id' => $combo['job_id'],
                'job_title' => $job ? $job->title : '-',
                'last_message' => $lastMessage->message,
                'last_message_time' => $this->formatTime($lastMessage->created_at),
                'unread_count' => $unreadCount,
                'is_priority' => $unreadCount > 3,
                'sort_time' => $lastMessage->created_at,
            ]);
        }

        $conversations = $conversations->sortByDesc('sort_time');

        return view('livewire.chat-list', [
            'conversations' => $conversations
        ])->extends($layout)->section('content');

    }

    private function formatTime($timestamp)
    {
        $carbon = Carbon::parse($timestamp);
        $now = Carbon::now();

        if ($carbon->isToday()) {
            if ($carbon->diffInMinutes($now) < 60) {
                $minutes = round($carbon->diffInMinutes($now));
                return $minutes <= 1 ? 'Just now' : $minutes . ' min ago';
            }
            return $carbon->format('H:i');
        } elseif ($carbon->isYesterday()) {
            return 'Yesterday';
        } elseif ($carbon->diffInDays($now) <= 7) {
            return round($carbon->diffInDays($now)) . ' days ago';
        } else {
            return $carbon->format('M j');
        }
    }
}