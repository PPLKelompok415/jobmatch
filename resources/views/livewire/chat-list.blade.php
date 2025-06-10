<div>
    <!-- Chat Container -->
    <div class="chat-container">
        <!-- Chat Header -->
        <div class="chat-header">
            <div class="d-flex align-items-center gap-3">
                <i class="fas fa-comments fa-2x"></i>
                <div>
                    <h2>Messages</h2>
                    <small class="opacity-75">Stay connected with potential employers</small>
                </div>
            </div>
            <div class="chat-search">
                <i class="fas fa-search search-icon"></i>
                <input type="text" 
                       placeholder="Search conversations..." 
                       wire:model.live="searchTerm"
                       class="form-control">
            </div>
        </div>

        <!-- Chat List -->
        <div class="chat-list" id="chatList">
            @forelse($conversations as $conversation)
                <a href="{{ route('chat.show', [$conversation['user']->id, $conversation['job_id']]) }}" class="chat-item {{ $conversation['unread_count'] > 0 ? 'unread' : '' }}">
                    <div class="chat-avatar {{ $conversation['user']->hasRole('company') ? 'company' : 'recruiter' }}">
                        <span>{{ strtoupper(substr($conversation['user']->name, 0, 2)) }}</span>
                        @if($conversation['user']->isOnline ?? false)
                            <div class="online-indicator"></div>
                        @endif
                    </div>
                    <div class="chat-content">
                        <div class="chat-meta">
                            <h5 class="chat-name">{{ $conversation['user']->name }}</h5>
                            <span class="chat-time">{{ $conversation['last_message_time'] }}</span>
                        </div>
                        <p class="chat-company">
                            {{ $conversation['user']->company->company_name ?? 'Applicant' }}, {{ $conversation['job_title'] ?? '-' }} application
                        </p>
                        <p class="chat-preview {{ $conversation['unread_count'] > 0 ? 'unread' : '' }}">
                            {{ Str::limit($conversation['last_message'], 100) }}
                        </p>
                        @if($conversation['unread_count'] > 0 || $conversation['is_priority'])
                            <div class="chat-badges">
                                @if($conversation['unread_count'] > 0)
                                    <span class="unread-count">{{ $conversation['unread_count'] }}</span>
                                @endif
                                @if($conversation['is_priority'])
                                    <span class="priority-badge">Priority</span>
                                @endif
                            </div>
                        @endif
                    </div>
                </a>
            @empty
                <!-- Empty State -->
                <div class="empty-state">
                    <i class="fas fa-comments"></i>
                    <h3>No conversations yet</h3>
                    <p>Start applying to jobs to begin conversations with employers.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>